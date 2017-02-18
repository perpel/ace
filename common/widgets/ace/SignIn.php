<?php
namespace common\widgets\ace;

use backend\models\SignupForm;
use yii\base\Widget;

class SignIn extends Widget
{

    public $signup;

    public function run()
    {
        return $this->render('login/index', [
            'login' => $this->login(),
            'signup' => $this->register(),
            'forget' => $this->forgot(),
        ]);
    }

    // 登录
    protected function login() 
    {
    	return $this->render('login/login');
    }

    // 注册用户
    protected function register()
    {
    	return $this->render('login/register', [
    	    'signup' => $this->signup,
            'prefix' => "<span class=\"block input-icon input-icon-right\">{input}\n<i class=\"ace-icon fa ",
            'suffix' => "\"></i></span>\n{hint}\n{error}"
        ]);
    }

    // 忘记密码
    protected function forgot()
    {
    	return $this->render('login/forgot');
    }

}
