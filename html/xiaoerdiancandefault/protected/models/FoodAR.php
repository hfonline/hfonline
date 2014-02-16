<?php

/**
 * @author jackey <jziwenchen@gmail.com>
 */
class FoodAR {
  
  const KEY_FOODS = "foods";
  
  /**
   * Load food with pager
   * @param type $page
   * @param type $num
   */
  public static function loadFood($page = 1, $num = 10) {
    $uri = Yii::app()->params["api_url"] . "/food/front/front-food-index?page={$page}";
    $cached_foods = CacheAR::get($uri);
    if (empty($cached_foods)) {
      $cached_foods = self::loadJSON($uri);
      CacheAR::set($uri, $cached_foods);
    }
    
    $pager = array_pop($cached_foods);
    $food_list = $cached_foods;
    
    return array("list" => $food_list, "pager" => $pager);
  }
  
  public static function loadJSON($url) {
    $content = file_get_contents($url);
    return json_decode($content, TRUE);
  }
  
  public static function orderItems() {
    $items = Yii::app()->session["order_items"];
    if (!$items) {
      $items = array();
    }
    
    foreach ($items as $key => $item) {
      $food_id = $item["food_id"];
      $cache_key = "food_". $food_id;
      $cached_food = CacheAR::get($cache_key);
      if (empty($cached_food)) {
        $cached_food = self::loadJSON(Yii::app()->params["api_url"]."/food/front/node/{$food_id}");
        CacheAR::set($cache_key, $cached_food);
      }
      $items[$key]["food"] = $cached_food;
    }
    return $items;
  }
  
  public static function clearOrderItems() {
    unset(Yii::app()->session["order_items"]);
  }
}

