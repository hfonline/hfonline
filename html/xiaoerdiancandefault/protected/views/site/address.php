<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('strings', Yii::app()->name);
?>
<div class="block" id="adress-main-block">
  <div class="title">
    <form method="get" action="<?php echo Yii::app()->getController()->createUrl("confirm")?>" name="confirm_form">
      <select name="region" id="region">
        <option value="">区</option>
        <option value="静安区">静安区</option>
        <option value="普陀区">普陀区</option>
        <option value="黄浦区">黄浦区</option>
        <option value="闸北区">闸北区</option>
        <option value="长宁区">长宁区</option>
      </select>
      <input type="text" name="address" class="address-address" placeholder="所属街道门牌号楼层（如:xxx）"/>
      <input type="submit" value="确定地址" id="confirm_address_btn" />
      <input type="hidden" name="lat" value="0" />
      <input type="hidden" name="lng" value="0" />
    </form>
  </div>
  <div class="content">
    <div id="address_map"></div>
  </div>
</div>

