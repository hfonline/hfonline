<?php

/**
 * @author jackey <jziwenchen@gmail.com>
 */
class AddressRecord extends CActiveRecord {
  
  public function primaryKey() {
    return "ua_id";
  }
  
  public function tableName() {
    return "user_address";
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function rules() {
    return array(
        array("user_id", "userExist"),
        array("address", "required"),
        array("datetime, ud_id", "safe")
    );
  }
  
  public function userExist($attribute, $params = array()) {
    $value = $this->{$attribute};
    $user = UserRecord::model()->findByPk($value);
    if (!$user) {
      $this->addError($attribute, "user is not existed");
      return FALSE;
    }
    return TRUE;
  }


  /**
   * 返回用户的地址列表
   * @param type $user_id 用户ID
   */
  public function getUserAddress($user_id) {
    $query = new CDbCriteria();
    $query->addCondition("user_id=:user_id");
    $query->params[":user_id"] = $user_id;
    
    $res = $this->findAll($query);
    
    return $res;
  }
  
  public function toArray() {
    $data = array();
    $data = $this->attributes;
    return $data;
  }
  
  public  function addUserAddress($user_id, $address) {
    $data = array(
        "user_id" => $user_id,
        "address" => $address,
        "datetime" => time(),
    );
    
    $this->attributes = $data;
    if ($this->validate()) {
      $this->save();
      return $this;
    }
    else {
      return FALSE;
    }
  }
}

