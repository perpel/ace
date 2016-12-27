<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\assets\AceAsset;
use yii\helpers\Html;
use common\widgets\ace\Breadcrumbs;

AceAsset::initAcePage($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class='no-skin'>
<?php $this->beginBody() ?>

<?= \common\widgets\ace\Navbar::widget();?>

<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>
	<?= \common\widgets\ace\SiderBar::widget();?>

	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<?= Breadcrumbs::widget([
					'homeLink' => false,
		            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		        ]) ?><!-- /.breadcrumb -->
		        <?php if(isset($this->params['nav-search']) && $this->params['nav-search'] === true):?>
    				<?= \common\widgets\ace\NavSearch::widget();?>
    			<?php endif;?>
				
			</div>

			<div class="page-content">

				<?= \common\widgets\ace\Setting::widget();?>

				<div class="page-header">
					<h1>
						Dashboard
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							overview &amp; stats
						</small>
					</h1>
				</div><!-- /.page-header -->			
				<?= $content ?>
			</div>
		</div>	
	</div>		

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
