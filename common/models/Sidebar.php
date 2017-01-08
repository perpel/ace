<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sidebar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $src
 * @property integer $parent_id
 * @property string $language
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Sidebar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sidebar}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at', 'sort'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['src'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 36],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'src' => 'Src',
            'parent_id' => 'higher level, 0 for the top',
            'language' => 'Language',
            'sort' => 'Sort',
            'icon' => 'Icon',
            'status' => 'set the sidebar status, the default 1 is active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
    * 
    */
    protected function sidebarRootNode()
    {
        return $this->find()->where(['parent_id'=>0])->orderBy('sort desc')->asArray()->all();
    }

    public function sidebarTree()
    {
        $trees = array();
        $root = $this->sidebarRootNode();
        foreach ($root as $key => $node) {
            $trees[$key] = $node;
            if ($this->hasChildrenNode($node['id'])) {
                $this->getChildrenNode($trees[$key]);
            }
        }
        return $trees;
    }

    protected function getChildrenNode(&$partenNode)
    {
        $nodes = $this->find()->where(['parent_id'=>$partenNode['id']])->orderBy('sort desc')->asArray()->all();
        foreach ($nodes as $key => $node) {

            $partenNode['children'][$key] = $node;

            if ($this->hasChildrenNode($node['id'])) {
                $this->getChildrenNode($partenNode['children'][$key]);
            }
        }
    }

    protected function hasChildrenNode($parendID)
    {
        if ($this->find()->where(['parent_id'=>$parendID])->one()) return true;
        else return false;
    }

}
