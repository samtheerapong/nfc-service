<?php

namespace app\modules\itms;

/**
 * itms module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\itms\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        // $this->layout = 'main';
        // custom initialization code goes here
    }
}
