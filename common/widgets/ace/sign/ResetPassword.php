<?php
namespace common\widgets\ace\sign;
use yii\base\Widget;

class ResetPassword extends Widget
{

    public $model;

    public function run()
    {
        return $this->render('index', [
            'view' => 'reset_password',
            'model' => $this->model,
        ]);
    }

}