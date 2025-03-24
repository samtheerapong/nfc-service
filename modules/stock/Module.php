<?php

namespace app\modules\stock;

/**
 * stock module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\stock\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main';

        // custom initialization code goes here
    }
}
