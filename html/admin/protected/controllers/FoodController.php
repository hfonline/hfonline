<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FoodController
 *
 * @author jackey
 */
class FoodController extends Controller{
  
  /**
   * 添加菜单
   */
  function actionAdd() {
    $request = Yii::app()->getRequest();
    if (!$request->isPostRequest) {
      $this->responseError(Yii::t("strings", "Only allow POST"));
    }
    else {
      print_r($_POST);
      die();
      $this->responseJSON($_SERVER. "loaded food");
    }
  }
  
  // 返回菜单
  public function actionGet() {
      $this->responseJSON(array(
          "name" => "Sample food",
          "price" => 12,
          "star" => 2,
          "content" => "Sample content",
          "summary" => "Sample summary",
      ), "loaded food");
  }
}
