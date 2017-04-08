<?php
namespace common\widgets\ace;

use yii\base\Widget;

class Navbar extends Widget
{

    public function run()
    {
        return $this->render('navbar', [
        		'tools'=> [
        			'tasks'=>$this->tasks()
        		],
        		'personal' => $this->personal()
        	]);
    }


    protected function tasks() 
    {
    	return $this->render('navbar/tasks');
    }

    protected function bell() 
    {
    	return $this->render('navbar/bell');
    }

    protected function message() 
    {
    	return $this->render('navbar/message');
    }

    protected function personal() 
    {
        $avatar = \Yii::$app->user->identity->avatar;
        $username = \Yii::$app->user->identity->username;
    	return $this->render('navbar/personal', [
    	    'avatar' => empty($avatar) ? 'default.png' : $avatar,
    	    'username' => empty($username) ? 'AceAdmin' : $username,
        ]);
    }

}