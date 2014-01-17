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

    <link rel="stylesheet" type="text/css" href="/scripts/admin/css/desktop.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    
    <link rel="stylesheet" type="text/css" href="/scripts/extjs//resources/css/ext-all.css" />
    
    <script type="text/javascript" src="/scripts/extjs/ext-all-debug.js"></script>
    <script type="text/javascript" src="/scripts/extjs/locale/ext-lang-zh_CN.js"></script>
    
    <script type="text/javascript">
      Ext.Loader.setConfig({
          enabled: true
      });
      Ext.Loader.setPath({
          'Ext.ux.desktop': '/scripts/admin/js',
          'Ext.ux.model': "/scripts/admin/model",
          'Ext.ux.store': "/scripts/admin/store",
          "MyDesktop": '/scripts/admin'
      });
      Ext.require('MyDesktop.App');

      var myDesktopApp;
      Ext.onReady(function () {
          myDesktopApp = new MyDesktop.App();
      });
    </script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
  <?php echo $content;?>
</body>
</html>
