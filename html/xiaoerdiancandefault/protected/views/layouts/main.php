<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?v=<?php echo time()?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css?v=<?php echo time()?>" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::t('strings', Yii::app()->name)); ?></div>
	</div><!-- header -->

	<div id="mainmenu" class="clearfix">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=> Yii::t('strings' ,'Home'), 'url'=>array('/site/index')),
				array('label'=> Yii::t('strings', 'Food Wiki'), 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=> Yii::t('strings', 'Coupons'), 'url'=>array('/site/contact')),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by 上海博思信息技术有限公司.<br/>
		All Rights Reserved.<br/>
		<?php echo Chtml::link("BoSi Technique", "http://bosiweb.com", array("target" => "blank")); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
