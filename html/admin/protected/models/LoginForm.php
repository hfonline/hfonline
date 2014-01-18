<?php

class LoginForm extends CFormModel {
  
  public $name = '';
  public $pass = '';
  
  public function rules() {
    return array(
        array("name, pass", "safe"),
    );
  }
  
  private $userIdentify = NULL;
  
  public function init() {
    $this->userIdentify = new UserIdentity("", "");
  }
  
  public function login() {
    if (!$this->name || !$this->pass) {
      return FALSE;
    }
    $this->userIdentify->authenticate();
    $err = $this->userIdentify->errorCode;
    if ($err == CUserIdentity::ERROR_NONE) {
      Yii::app()->user->login($this->getUserIdentify());
      return TRUE;
    }
    else {
      if ($err == CUserIdentity::ERROR_PASSWORD_INVALID) {
        $this->addError("pass", "user or password wrong");
      }
      else if ($err == CUserIdentity::ERROR_USERNAME_INVALID) {
        $this->addError("pass", "user or password wrong");
      }
      else {
        $this->addError("name", "system unknown error");
      }
    }
    
    return FALSE;
  }
  
  public function getUserIdentify() {
    return $this->userIdentify;
  }
  
  public function setAttributes($values, $safeOnly = true) {
    parent::setAttributes($values, $safeOnly);
    
    if ($this->name) {
      $this->userIdentify->name = $this->name;
    }
    
    if ($this->pass) {
      $this->userIdentify->pass = $this->pass;
    }
  }
}

