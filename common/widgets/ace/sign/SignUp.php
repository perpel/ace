<?php
namespace common\widgets\ace\sign;
use yii\base\Widget;

class SignUp extends Widget
{

    public $model;

    public function run()
    {
        return $this->render('index', [
            'view' => 'register',
            'model' => $this->model,
        ]);
    }

}