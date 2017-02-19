<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\basis\models\Sidebar */

$this->title = 'Create Sidebar';
$this->params['breadcrumbs'][] = ['label' => 'Sidebars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sidebar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
