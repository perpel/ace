<?php
namespace common\widgets\ace;

use common\models\ace\Sidebar;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class SiderBar extends Widget
{

	protected $tree = [[]];

	/**
	* 生成树形结构数据
	*/
	protected function generateTreeArr()
	{

	    $nodes = Sidebar::find()
            ->select(['id', 'parent_id', 'title', 'href', 'icon', 'active', 'sort'])
            ->asArray()->all();

		foreach ($nodes as $v) {
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
        ArrayHelper::multisort($this->tree[$parentid], 'sort', SORT_DESC);
		return $this->tree[$parentid];
	}

	protected $htmlTree = '';

	protected $menuQueue;

    public function run()
    {
    	$this->generateTreeArr();
    	$this->menuQueue = new \SplQueue();
        ArrayHelper::multisort($this->tree[0], 'sort', SORT_DESC);
    	$this->generateTreeHtml($this->tree[0]);
        return $this->render('sider-bar', ['menu'=>$this->htmlTree]);
    }



    /**
     * @param array $roots
     * 生成 html tree
     */
    protected function generateTreeHtml($roots = [])
    {
    	foreach ($roots as $root) {
    		if ($this->hasChildren($root['id'])) {
    			$this->pushList($root, true);
				$this->menuQueue->enqueue('<ul class="submenu">');
				$this->generateTreeHtml($this->getChildren($root['id']));
				$this->menuQueue->enqueue('</ul>');
    		} else {
    			$this->pushList($root);
    		}
            $this->menuQueue->enqueue('</li>');
    		$this->popList();
    	}
    }

    protected function pushList($node, $ischildren = false)
    {
        if ($node['active']) $this->menuQueue->enqueue('<li class="active">');
        else $this->menuQueue->enqueue('<li class="">');

        // href
        if ($ischildren) {
            $this->menuQueue->enqueue('<a href="#" class="dropdown-toggle">');
        } else {
            if (empty($node['href'])) $this->menuQueue->enqueue('<a href="#">');
            else $this->menuQueue->enqueue('<a href="' . $node['href'] . '">');
        }

        // icon
        if (empty($node['icon'])) $this->menuQueue->enqueue('<i class="menu-icon fa fa-caret-right">');
        else $this->menuQueue->enqueue('<i class="menu-icon fa ' . $node['icon'] . '">');
        $this->menuQueue->enqueue('</i>');

        // span
        $this->menuQueue->enqueue('<span class="menu-text"> ' . $node['title']);
        $this->menuQueue->enqueue(' </span>');

        // arrow
        if ($ischildren) {
            $this->menuQueue->enqueue('<b class="arrow fa fa-angle-down">');
        } else {
            $this->menuQueue->enqueue('<b class="arrow">');
        }

        $this->menuQueue->enqueue('</a>');

        $this->menuQueue->enqueue('</b>');
    }


    protected function popList()
    {
    	while ($this->menuQueue->count() > 0) {
    		$this->htmlTree .= $this->menuQueue->dequeue();
    	}
    }

}