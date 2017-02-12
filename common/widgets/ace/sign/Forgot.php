<?php
namespace common\widgets\ace\sign;
use yii\base\Widget;

class Forgot extends Widget
{

    public $model;

    public function run()
    {
        return $this->render('index', [
            'view' => 'forgot',
            'model' => $this->model,
        ]);
    }

}