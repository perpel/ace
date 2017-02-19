<?php

namespace backend\modules\basis\models;

use Yii;

/**
 * This is the model class for table "sidebar".
 *
 * @property integer $id
 * @property string $title
 * @property string $href
 * @property integer $parent_id
 * @property string $language
 * @property string $icon
 * @property integer $active
 * @property integer $sort
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Sidebar extends \common\models\ace\Sidebar
{
}
