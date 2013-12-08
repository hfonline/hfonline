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
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/scripts/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/scripts/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/scripts/underscore.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/scripts/backbone.js"></script>
    <script language="javascript" src="http://webapi.amap.com/maps?v=1.2&key=20980ecb729e7a0fb5e3e32717b81ecd"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/scripts/script.js"></script>

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
            <div class="title"><h3><?php echo Yii::t('strings', "Your Order") ?></h3></div>
            <div class="content">
              <div class="user-info">
                <span>未登陆</span>
              </div>
              <div class="order-items">
                <div class="items">
                  <span>咖喱鸡肉饭简餐</span>
                  <span class="symbol-rmb"></span><span>14</span>
                  <span>2</span><span>份</span>
                </div>
                <div class="items">
                  <span>咖喱鸡肉饭简餐</span>
                  <span class="symbol-rmb"></span><span>14</span>
                  <span>2</span><span>份</span>
                </div>
                <div class="items">
                  <span>咖喱鸡肉饭简餐</span>
                  <span class="symbol-rmb"></span><span>14</span>
                  <span>2</span><span>份</span>
                </div>
                <div class="items">
                  <span>咖喱鸡肉饭简餐</span>
                  <span class="symbol-rmb"></span><span>14</span>
                  <span>2</span><span>份</span>
                </div>
                <div class="items">
                  <span>咖喱鸡肉饭简餐</span>
                  <span class="symbol-rmb"></span><span>14</span>
                  <span>2</span><span>份</span>
                </div>
                <div class="order-button"><input type="button" value="<?php echo Yii::t("strings", "Pay now")?>" /></div>
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
