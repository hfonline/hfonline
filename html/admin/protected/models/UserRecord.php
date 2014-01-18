<?php

class UserRecord extends CActiveRecord {
  const ACTIVE = 1;
  const DELETED = 3;
  const DISABLED = 2;
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
        "role" => self::ROLE_AUTH,
    ));
    
    return TRUE;
  }
  
  public function afterSave() {
    // 注册后，发送一封邮件
    $mailler = new YiiMailer();
    $mailler->setView("register");
    $mailler->setFrom("jziwenchen@gmail.com", "Jackey");
    $mailler->setTo("jziwenchen@gmail.com");
    $mailler->setSubject("Test Mail from Yii");
    $mailler->send();
    
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
  
  public function findAllUserInRole($role) {
    if (!$role) {
      return array();
    }
    
    if (!in_array($role, array(self::ROLE_AUTH, self::ROLE_ADMIN, self::ROLE_ORDER_MANAGER))) {
      return array();
    }
    
    $query = new CDbCriteria();
    $query->addCondition("role = :role");
    $query->params[":role"] = $role;
    $query->params[":status"] = self::ACTIVE;
    
    return $this->findAll($query);
  }
  
  /**
   * 复写父级删除方法；用户涉及到的数据很多，比如表单等；删除用户 在后台做的处理其实是禁用用户
   * @param type $v 主键值
   */
  public function deleteByPk($v) {
    $data = array('status' => self::DELETED);
    return $this->updateByPk($v, $data);
  }
  
}
