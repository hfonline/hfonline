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
      <?php foreach (FoodAR::orderItems() as $item): ?>
        <div class="item">
          <span class="food"><?php echo $item["food"]["title"]?>&nbsp;</span>
          <span class="star-price">
            <span class="symbol-rmb price"><?php echo $item["food"]["field_price"]["und"][0]["value"]?></span>
          </span>
          <span class="operate-edit"><a href="#">Edit</a></span>
          <span class="operate-rm"><a href="#">Remove</a></span>
        </div>
      <?php endforeach;?>
    </div>
    
    <div class="memo">
      <form action="<?php echo Yii::app()->getController()->createUrl("submit")?>" method="POST">
        <textarea name="memo" id="" cols="80" rows="5" placeholder="您还有其他的要求可以写在这里哦"></textarea>
        <div><input type="text" placeholder="电话号码"  name="phone"/></div>
        <div><input type="submit"  value="确定"/></div>
        <input type="hidden" value="<?php echo Yii::app()->getRequest()->getParam("address")?>" name="address" />
        <input type="hidden" name="region" value="<?php echo Yii::app()->getRequest()->getParam("region")?>"/>
        <input type="hidden" name="lat" value="<?php echo Yii::app()->getRequest()->getParam("lat")?>"/>
        <input type="hidden" name="lng" value="<?php echo Yii::app()->getRequest()->getParam("lng")?>"/>
      </form>
    </div>
  </div>
</div>

