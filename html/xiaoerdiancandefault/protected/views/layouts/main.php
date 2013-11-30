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

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?v=<?php echo time() ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css?v=<?php echo time() ?>" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>

  <body>

    <div class="container" id="page">

      <div id="fixed-top">
        <div id="mainmenu" class="clearfix">
          <?php
          $this->widget('zii.widgets.CMenu', array(
              'items' => array(
                  array('label' => Yii::t('strings', 'XiaoEr Order'), 'url' => array('/site/index')),
                  array('label' => Yii::t('strings', 'Food Wiki'), 'url' => array('/site/page', 'view' => 'about')),
                  array('label' => Yii::t('strings', 'Coupons'), 'url' => array('/site/contact')),
              ),
              'htmlOptions' => array('class' => "clearfix")
          ));
          ?>
        </div><!-- mainmenu -->

        <div id="header">
          <div id="logo"><?php echo CHtml::encode(Yii::t('strings', Yii::app()->name)); ?></div>
        </div><!-- header -->
      </div>

      <div id="main" class="clearfix">
        <div id="left-sidebar">
          <div class="block">
            <div class="title"><h3><?php echo Yii::t("strings", "Login") ?></h3></div>
            <div class="content">
              <?php
              $form = $this->beginWidget("CActiveForm", array(
                  "id" => "loginForm",
                      ))
              ?>
              <div class="row clearfix">
                <label for="name"><?php echo Yii::t("strings", "Name") ?>:</label>
                <input type="text" name="name" class="loginform-input loginform-username"/>
              </div>

              <div class="row clearfix">
                <label for="password"><?php echo Yii::t("strings", "Password") ?>:</label>
                <input type="text" name="password" class="loginform-input loginform-password" />
              </div>

              <div class="row clearfix">
                <input type="button" value="<?php echo Yii::t("strings", "Login") ?>" class="loginform-input loginform-submit"/>
              </div>

<?php $this->endWidget(); ?>
            </div>
          </div>
          <div class="block">
            <div class="title"><h3><?php echo Yii::t('strings', "Promotion") ?></h3></div>
            <div class="content">
              <div class="item promotion">
                <img src="/uploads/images/bebe8169eb24a433f2e7941e659cajpeg_size_240_180.jpeg" alt="" />
                <h3>咖喱鸡肉饭简餐</h3>
                <span class="star star-5-5"></span>
                <span class="symbol-rmb price">14</span>
                <input type="button" value="Order" />
              </div>
            </div>
          </div>
        </div>

<?php echo $content; ?>
      </div>



      <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by 上海博思信息技术有限公司.<br/>
        All Rights Reserved.<br/>
<?php echo Chtml::link("BoSi Technique", "http://bosiweb.com", array("target" => "blank")); ?>
      </div><!-- footer -->

    </div><!-- page -->

  </body>
</html>
