<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('strings', Yii::app()->name);
?>
<div class="block" id="confirm-main-block">
  <div class="title">
    <h3><?php echo Yii::t("strings", "Confirm your order please") ?></h3>
  </div>
  <div class="content">
    <div class="order-items clearfix">
      <h6>您的用餐:</h6>
      <div class="item">
        <span class="food">回锅肉饭简餐&nbsp;</span>
        <span class="star-price">
          <span class="symbol-rmb price">14</span>
        </span>
        <span class="operate">Edit</span>
      </div>
      <div class="item">
        <span class="food">咖喱鸡肉饭简餐&nbsp;</span>
        <span class="star-price">
          <span class="symbol-rmb price">14</span>
        </span>
        <span class="operate">Edit</span>
      </div>
      <div class="item">
        <span class="food">糖醋带鱼饭简餐&nbsp;</span>
        <span class="star-price">
          <span class="symbol-rmb price">14</span>
        </span>
        <span class="operate">Edit</span>
      </div>
      <div class="item">
        <span class="food">土烧啤酒鸭饭简餐&nbsp;</span>
        <span class="star-price">
          <span class="symbol-rmb price">14</span>
        </span>
        <span class="operate">Edit</span>
      </div>
      <div class="item">
        <span class="food">红烧狮子头饭简餐&nbsp;</span>
        <span class="star-price">
          <span class="symbol-rmb price">14</span>
        </span>
        <span class="operate">Edit</span>
      </div>
    </div>
    
    <div class="memo">
      <form action="">
        <textarea name="memo" id="" cols="80" rows="5" placeholder="您还有其他的要求可以写在这里哦"></textarea>
        <div><input type="text" placeholder="联系号码" /></div>
        <div><input type="button"  value="确定" /></div>
      </form>
    </div>
  </div>
</div>

