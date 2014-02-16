<?php

class OrderAR  {
  
  public static function loadOrder($order_id) {
    $cached_data = CacheAR::get("order_". $order_id);
    if ($cached_data) {
      return $cached_data;
    }
    $url = Yii::app()->params["api_url"]. "food/front/node/". $order_id;
    $data = file_get_contents($url);
    $data = json_decode($data, TRUE);
    // 缓存
    CacheAR::set("order_". $order_id, $data);
    
    return $data;
  }
}

