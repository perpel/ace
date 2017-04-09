<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yiip\ace\web\AceAsset;
use yii\helpers\Html;
use common\widgets\ace\Breadcrumbs;
use common\libs\cache\AdminCache;

AceAsset::register($this);

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

<?php
    // 页面顶部缓存区域
    if ($this->beginCache(AdminCache::ADMIN_NAVBAR_KEY, ['duration' => 10])) {
        echo \common\widgets\ace\Navbar::widget();
        $this->endCache();
    }
?>

<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>

	<?php
		// 缓存 key = 菜单栏前缀 + 用户登录ID，有效时间 3600 * 12
		if ($this->beginCache(AdminCache::ADMIN_SIDERBAR_KEY)) {
			// 导航侧边栏
			echo \common\widgets\ace\SiderBar::widget();
			$this->endCache();
		}
	?>

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
                <?= \common\widgets\Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>	
	</div>		

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
