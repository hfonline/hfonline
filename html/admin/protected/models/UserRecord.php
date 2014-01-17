<?php

class UserRecord extends CActiveRecord {
  const ACTIVE = 1;
  const ROLE_AUTH = 1;
  const ROLE_ORDER_MANAGER=2;
  const ROLE_ADMIN = 3;
  
  public $status = 1;
  
  public function primaryKey() {
    return "uid";
  }
  
  public function tableName() {
    return "user";
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function toArray() {
    $allow_fields = array(
        "name", "mail", "phone", "status", "created", "updated", "lastlogin", "avater"
    );
    
    $data = array();
    foreach ($allow_fields as $field) {
      $data[$field] = $this->{$field}; 
    }
    
    return $data;
  }
  
  public function rules() {
    return array(
        array("name, pass, mail, phone", "required"),
        array("name", "length", 'min' => 3),
        array("pass", 'length', 'min' => 3),
        array('mail', 'email'),
        array("mail", "IsUnique"),
        array("name", "IsUnique"),
        array("phone", "IsUnique"),
        array('status,created, updated, lastlogin, avatar, role', 'safe'),
    );
  }
  
  public function beforeValidate() {
    if (!$this->name) {
      $this->name = $this->mail;
    }
    if ($this->mail  && !$this->phone) {
      $this->phone = "000000000";
    }
    else if ($this->phone && !$this->mail) {
      $this->mail = "xxx@xxx.com";
    }
    return parent::beforeValidate();
  }
  
  public function beforeSave() {
    $this->setAttributes(array(
        "status" => self::ACTIVE,// 注册或添加新用户时，用户自动生效
        "created" => time(),
        "updated" => time(),
        // 0 就是从来没有登陆过
        "lastlogin" => time(), 
        "pass" => md5($this->getAttribute("pass")),
        "role" => self::ROLE_ADMIN,
    ));
    
    return TRUE;
  }
  
  public function afterSave() {
    $mailler = new YiiMailer();
    $mailler->setView("register");
    $mailler->setFrom("jziwenchen@gmail.com", "Jackey");
    $mailler->setTo("jziwenchen@gmail.com");
    $mailler->setSubject("Test Mail from Yii");
    $mailler->send();
    print_r($mailler->getError());
    die();
    return parent::afterSave();
  }


  /**
   * validation for unique
   */
  public function IsUnique($attribute, $params) {
    $value = $this->{$attribute};
    
    $obj = self::model()->findByAttributes(array("$attribute" => $value));
    if (!empty($obj)) {
      $this->addError($attribute, "$attribute has existed already");
      return FALSE;
    }
    return TRUE;
  }
  
  
}

