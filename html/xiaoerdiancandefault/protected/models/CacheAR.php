<?php

class CacheAR {
  public static function get($key, $default = array()) {
    if (Yii::app()->params["enable_cache"] == FALSE) return $default;
    $data = Yii::app()->session[$key];
    return $data ? $data: $default;
  }
  
  public static function set($key, $data) {
    if (Yii::app()->params["enable_cache"] == FALSE) return $data;
    Yii::app()->session[$key] = $data;
    return $data;
  }
  
  public static function reset($key) {
    Yii::app()->session[$key] = NULL;
  }
  
  public function destroy() {
    
  }
}

