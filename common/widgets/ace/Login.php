<?php
namespace common\widgets\ace;

use yii\base\Widget;

class Login extends Widget
{

    public function run()
    {
        return $this->render('login/index', [
        		'login' => $this->login(),
        		'register' => $this->register(),
        		'forgot' => $this->forgot(),
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
    	return $this->render('login/register');
    }

    // 忘记密码
    protected function forgot()
    {
    	return $this->render('login/forgot');
    }

}
