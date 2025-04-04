<?php

use yii\web\Request;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$engineer = require __DIR__ . '/engineer.php';
$dbit = require __DIR__ . '/dbit.php';
$dbstock = require __DIR__ . '/dbstock.php';
$dbrawsauce = require __DIR__ . '/dbrawsauce.php';
$dbpm = require __DIR__ . '/dbpm.php';

$config = [
    'id' =>  env('ID'),
    'name' => env('NAME'),
    'language' => env('LANGUAGE'),
    'timezone' => env('TIMEZONE'),
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        [
            'class' => 'app\components\LanguageSelector',
            'supportedLanguages' => ['en-US', 'th-TH'], //กำหนดรายการภาษาที่ support หรือใช้ได้
        ]
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'tasks' => [
            'class' => 'app\modules\tasks\Module',
        ],
        'itms' => [
            'class' => 'app\modules\itms\Module',
        ],
        'stock' => [
            'class' => 'app\modules\stock\Module',
        ],
        'rawsauce' => [
            'class' => 'app\modules\rawsauce\Module',
        ],
        'maintenance' => [
            'class' => 'app\modules\maintenance\Module',
        ],
    ],
    'components' => [
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],

        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'th_TH', // Thai locale
            'calendar' => \IntlDateFormatter::TRADITIONAL, // Use Buddhist calendar
            'dateFormat' => 'php:d M Y', // Customize the date format if needed
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/admin/'
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'my-secret-key-nfc-service',
            'baseUrl' => str_replace('/web', '', (new Request())->getBaseUrl()), // ข้าม /web/', ใส่ .htasset ที่นอกสุดด้วย
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true, // เปิดใช้งาน Remember Me
            // 'authTimeout' => 120, // 2 นาที
            // 'identityCookie' => [
            //     'name' => '_identity', // ชื่อคุกกี้
            //     'httpOnly' => true,    // ป้องกันไม่ให้เข้าถึงคุกกี้ผ่าน JavaScript
            //     'sameSite' => 'Lax',   // เพิ่มความปลอดภัย (ป้องกัน Cross-Site Request Forgery)
            // ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => env('SMTP_HOST'),
                'username' => env('ADMIN_EMAIL'),
                'password' => env('ADMIN_EMAIL_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'engineer' => $engineer,
        'dbit' => $dbit,
        'dbstock' => $dbstock,
        'rawsauce' => $dbrawsauce,
        'dbpm' => $dbpm,
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    // 'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete', 'GET', 'HEAD', 'POST', 'OPTIONS'], 'pluralize' => false],
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],


    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
