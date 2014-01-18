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
    if (!$request->isPostRequest && FALSE) {
      $this->responseError(Yii::t("strings", "Only allow POST"));
    }
    else {
      $data = $this->getExtPostData();
      $mFood = new FoodRecord();
      $mFood->attributes = $data;
      $food_id = $mFood->save();
      if ($mFood->getErrors()) {
        $error = array_shift($mFood->getErrors());
        $this->responseError(implode(",", $error));
      }
      else {
        $this->responseJSON($data, Yii::t("strings", "food saved"));
      }
    }
  }
  
  // 返回菜单
  public function actionGet() {
      $totalcount = FoodRecord::model()->count();
      $request = Yii::app()->getRequest();
      $page = $request->getQuery("page");
      $limit = $request->getQuery("limit");
      $offset = ($page - 1) * $limit;
      $criteria = new CDbCriteria(array(
          "limit" => $limit,
          "offset" => $offset,
          "order" => "created DESC"
      ));
      $foods = FoodRecord::model()->findAll($criteria);
      $data = array();
      //print_r($foods);
      if ($foods) {
        foreach ($foods as $food) {
          $data[] = $food;
        }
      }
      return $this->responseJSON($data, "Load success", array("total" => $totalcount));
  }
  
  public function actionUpdate() {
    $request = Yii::app()->getRequest();
    if (!$request->isPostRequest) {
      return $this->responseError(Yii::t("strings", "Only allow POST"));
    }
    else {
      $data = $this->getExtPostData();
      if ($data["food_id"]) {
        $food = FoodRecord::model()->findByPk($data["food_id"]);
        $food->attributes = $data;
        if ($food->validate()) {
          $food->update();
          return $this->responseJSON($data, Yii::t("strings", "Updated Success"));
        }
        else {
          $error = array_shift($food->getErrors());
          return $this->responseError(implode(",", $error));
        }
      }
      else {
        $mFood = new FoodRecord();
        $mFood->attributes = $data;
        if ($mFood->validate()) {
          $food_id = $mFood->save();
          $this->responseJSON($data, Yii::t("strings","Food save success"));
        }
        else {
          $error = array_shift($mFood->getErrors());
          return $this->responseError(Yii::t("strings", implode(",", $error)));
        }
      }
    }
  }
  
  public function actionDelete() {
    $request = Yii::app()->getRequest();
    if ($request->isPostRequest) {
      $data = $this->getExtPostData();
      if ($data["food_id"]) {
        $food = FoodRecord::model()->findByPk($data["food_id"]);
        $food->delete();
        return $this->responseJSON($data, Yii::t("strings", "Delete success"));
      }
      else {
        return $this->responseError(Yii::t("strings", "food id is missed"));
      }
    }
    else {
      $this->responseError("Post method only allowed");
    }
  }
  
  public function actionUploadimage() {
    $request = Yii::app()->getRequest();
    if ($request->isPostRequest) {
      $photo = $_FILES["photo"];
      $food_id = $_POST["food_id"];
      $mediaRecord = new MediaRecord();
      $media_id = $mediaRecord->saveMedia($photo);
      
      print $media_id;
    }
  }
  
  public function actionTest() {
    print "HELLO";
  }
}
