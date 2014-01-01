<?php

class UserRecord extends CActiveRecord {
  const  ACTIVE = 1;
  public $status = 1;
  public function primaryKey() {
    return "user_id";
  }
  
  public function tableName() {
    return "user";
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function rules() {
    return array(
        array("name, pass, mail, , phone, avatar", "required"),
        array("name", "length", 'min' => 3, 'max' => 12),
        array("pass", 'length', 'min' => 3),
        array('mail', 'email'),
        array('status,created, updated, lastlogin', 'safe'),
    );
  }
  
  public function beforeSave() {
    $this->setAttributes(array(
        "status" => self::ACTIVE,
        "created" => time(),
        "updated" => time(),
        // 0 就是从来没有登陆过
        "lastlogin" => 0, 
        "pass" => md5($this->getAttribute("pass")),
    ));
    
    return TRUE;
  }
  
  
}

