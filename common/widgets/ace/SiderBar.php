<?php
namespace common\widgets\ace;

use yii\base\Widget;
use yii\helpers\Html;

class SiderBar extends Widget
{

	protected function arr()
	{
		return [
			['id'=>1, 'parent_id'=>0, 'href'=>'index.html', 'active'=>true, 'icon'=>'fa-tachometer', 'title'=>'Dashboard'],
			['id'=>5, 'parent_id'=>0, 'href'=>'#', 'active'=>false, 'icon'=>'fa-desktop', 'title'=>'UI &amp; Elements'],
			['id'=>6, 'parent_id'=>0, 'href'=>'#', 'active'=>false, 'icon'=>'fa-desktop', 'title'=>'666'],
			['id'=>3, 'parent_id'=>5, 'href'=>'#', 'active'=>false, 'icon'=>'fa-desktop', 'title'=>'333'],
			['id'=>2, 'parent_id'=>1, 'href'=>'#', 'active'=>false, 'icon'=>'', 'title'=>'222'],
			['id'=>4, 'parent_id'=>1, 'href'=>'#', 'active'=>false, 'icon'=>'', 'title'=>'444'],
		];
	}

	public $tree = [];

	/**
	* 生成树形结构数据
	*/
	protected function generateTreeArr()
	{
		$arr = $this->arr();
		foreach ($arr as $v) {
			$parent_id = $v['parent_id'];
			$this->tree[$parent_id][] = $v;
		}
	}

	/**
	* 是否存在子节点
	*/
	protected function hasChildren($nodeid)
	{
		if (isset($this->tree[$nodeid])) return true;
		else return false;
	}

	/**
	* 获取子节点
	*/
	protected function getChildren($parentid)
	{
		return $this->tree[$parentid];
	}

	protected $htmlTree = '';

	protected $menuQueue;

    public function run()
    {
    	$this->generateTreeArr();
    	$this->menuQueue = new \SplQueue();
    	$this->generateTreeHtml($this->tree[0]);
        return $this->render('sider-bar', ['menu'=>$this->htmlTree]);
    }

    protected function generateTreeHtml($roots = array())
    {
    	foreach ($roots as $root) {
    		if ($this->hasChildren($root['id'])) {
    			$this->pushChildrenLi($root);
				$this->menuQueue->enqueue('<ul class="submenu">');
				$this->generateTreeHtml($this->getChildren($root['id']));
				$this->menuQueue->enqueue('</ul>');	
    			$this->menuQueue->enqueue('</li>');	
    		} else {
    			$this->pushAloneLi($root);
    		}
    		$this->popLi();
    	}
    }


    protected function pushChildrenLi($node)
    {
    	if ($node['active']) $this->menuQueue->enqueue('<li class="active">');
    	else $this->menuQueue->enqueue('<li class="">');

    	// href
    	$this->menuQueue->enqueue('<a href="#" class="dropdown-toggle">');

    	// icon
    	if (empty($node['icon'])) $this->menuQueue->enqueue('<i class="menu-icon fa fa-caret-right">');
    	else $this->menuQueue->enqueue('<i class="menu-icon fa ' . $node['icon'] . '">');
    	$this->menuQueue->enqueue('</i>');

    	// span
    	$this->menuQueue->enqueue('<span class="menu-text"> ' . $node['title']);
    	$this->menuQueue->enqueue(' </span>');

    	$this->menuQueue->enqueue('</a>');
    	// b
    	$this->menuQueue->enqueue('<b class="arrow">');
    	$this->menuQueue->enqueue('</b>');

    }


    protected function pushAloneLi($node)
    {
    	if ($node['active']) $this->menuQueue->enqueue('<li class="active">');
    	else $this->menuQueue->enqueue('<li class="">');

    	// href
    	if (empty($node['href'])) $this->menuQueue->enqueue('<a href="#">');
    	else $this->menuQueue->enqueue('<a href="' . $node['href'] . '">');

    	// icon
    	if (empty($node['icon'])) $this->menuQueue->enqueue('<i class="menu-icon fa fa-caret-right">');
    	else $this->menuQueue->enqueue('<i class="menu-icon fa ' . $node['icon'] . '">');
    	$this->menuQueue->enqueue('</i>');

    	// span
    	$this->menuQueue->enqueue('<span class="menu-text"> ' . $node['title']);
    	$this->menuQueue->enqueue(' </span>');

    	$this->menuQueue->enqueue('</a>');
    	// b
    	$this->menuQueue->enqueue('<b class="arrow">');
    	$this->menuQueue->enqueue('</b>');

    	$this->menuQueue->enqueue('</li>');	
    }

    protected function popLi()
    {
    	while ($this->menuQueue->count() > 0) {
    		$this->htmlTree .= $this->menuQueue->dequeue();
    	}
    }

}