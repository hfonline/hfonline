<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('strings', Yii::app()->name);
?>
<div class="block" id="adress-main-block">
  <div class="title">
    <form action="">
      <select name="region" id="region">
        <option value="">区</option>
        <option value="">静安区</option>
        <option value="">普陀区</option>
        <option value="">黄浦区</option>
        <option value="">闸北区</option>
        <option value="">长宁区</option>
      </select>
      <input type="text" name="address" class="address-address" placeholder="所属街道门牌号楼层（如:xxx）"/>
      <input type="button" value="确定地址">
    </form>
  </div>
  <div class="content">
    <div id="address_map"></div>
  </div>
</div>

