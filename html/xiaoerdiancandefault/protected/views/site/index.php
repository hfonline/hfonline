<?php
/* @var $this SiteController */

$this->pageTitle = Yii::t('strings', Yii::app()->name);
?>
<div class="block" id="index-main-block">
  <div id="detail-buy-container"  style="display:none">
    <div class="title">订餐详情</div>
    <div class="form-order">
      <form action="" name="detail-buy">
        <div class="row">
          <label for="">加辣</label><input type="checkbox" name="more_spicy" />
        </div>
        <div><label for="">特别留言</label><textarea cols="20" rows="6" name="note"></textarea></div>
        <div class="row"><input type="button" value="好了" name="buy-detail-ok-btn" /></div>
        <input type="hidden" value="0" name="food_id" />
      </form>
    </div>
  </div>
  <div class="title">
    <h3><?php echo Yii::t("strings", "Here is food we suggestion today") ?></h3>
    <div class="filter">
      <input type="button" name="filter" id="toglle_filter" value="<?php echo Yii::t("strings", "Filter")?>" />
      <form action="" class="clearfix title">
        <select name="seat_type">
          <option value="">菜系</option>
          <option value="benbangcai">本帮菜</option>
          <option value="xiangcai">湘菜</option>
          <option value="anhuicai">安徽小炒</option>
        </select>
        <select name="start_num">
          <option value="">星星排名</option>
          <option value="1">一颗星</option>
          <option value="2">二颗星</option>
          <option value="3">三颗星</option>
        </select>
        <select name="price">
          <option value="">价格区间</option>
          <option value="1">10-15</option>
          <option value="2">16-20</option>
          <option value="3">21-35</option>
          <option value="4">35以上</option>
        </select>
        <input type="button" value="查找" />
      </form>
    </div>
  </div>
  <div class="content">
    <div class="food-items clearfix">
      <?php foreach ($food_list as $food) :?>
       <div class="item">
        <?php echo $food["field_image_thumbnail"]?>
        <h3><?php echo $food["node_title"]?></h3>
        <div class="star-price"><span class="star star-5-5"></span>
        <span class="symbol-rmb price"><?php echo $food["field_price"]?></span></div>
        <input type="button" value="Order" class="index-list-order-button" />
        <input type="hidden" value="<?php echo $food["nid"]?>" name="food_id" />
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>

