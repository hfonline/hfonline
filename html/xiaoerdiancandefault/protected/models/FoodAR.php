<?php

/**
 * @author jackey <jziwenchen@gmail.com>
 */
class FoodAR {
  
  /**
   * Load food with pager
   * @param type $page
   * @param type $num
   */
  public static function loadFood($page, $num = 10) {
    $food = self::loadJSON(Yii::app()->params["api_url"] . "/food/front/front-food-index");
    return $food;
  }
  
  public static function loadJSON($url) {
    $content = file_get_contents($url);
    return json_decode($content, TRUE);
  }
}

