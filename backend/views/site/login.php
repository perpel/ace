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
    <title>用户登录</title>
    <?php $this->head() ?>
</head>
<body class='login-layout'>
<?php $this->beginBody() ?>
   
<div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    

                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.main-content -->
</div><!-- /.main-container -->

<?php
$js = <<<JS
    $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');//hide others
        $(target).addClass('visible');//show target
    });

    //you don't need this, just used for changing background
    $('#btn-login-dark').on('click', function(e) {
        $('body').attr('class', 'login-layout');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'blue');
        e.preventDefault();
    });
    $('#btn-login-light').on('click', function(e) {
        $('body').attr('class', 'login-layout light-login');
        $('#id-text2').attr('class', 'grey');
        $('#id-company-text').attr('class', 'blue');
        e.preventDefault();
    });
    $('#btn-login-blur').on('click', function(e) {
        $('body').attr('class', 'login-layout blur-login');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'light-blue');
        e.preventDefault();
    });
JS;

echo $this->registerJS($js);

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>