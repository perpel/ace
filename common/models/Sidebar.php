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
            [['parent_id', 'status', 'active', 'created_at', 'updated_at', 'sort'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['href'], 'string', 'max' => 128],
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
            'href' => 'Href',
            'parent_id' => 'higher level, 0 for the top',
            'language' => 'Language',
            'sort' => 'Sort',
            'icon' => 'Icon',
            'active' => 'Active',
            'status' => 'set the sidebar status, the default 1 is active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
