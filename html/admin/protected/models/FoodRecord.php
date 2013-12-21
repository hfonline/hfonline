<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Food
 *
 * @author jackey
 */
class FoodRecord extends CActiveRecord {
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function tableName() {
    return "food";
  }
  
  public function primaryKey() {
    return "food_id";
  }
  
  public function rules() {
    return array(
        array("name, price, status", "required"),
        array("uid", "isValidUid"),
        array("summary, description, weight, star", 'safe'),
    );
  }
  
  public function isValidUid($attribute, $params) {
    if ($this->hasErrors()) {
      return ;
    }
    if (!$this->{$attribute}) {
      //$this->addError($attribute, Yii::t("strings", "Uid is not valid"));
    }
    else {
      return ;
    }
  }
}
