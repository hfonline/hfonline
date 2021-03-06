<?php

class UserController extends Controller {
  
  public function actionIndex() {
    $this->responseError("not support yet");
  }
  
  /**
   * 用户列表
   * 用户列表分Role 列出，不能一次性全部列出
   */
  public function actionList() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      return $this->responseError("http error");
    }
    
    $role = $request->getParam("role");
    // 列表可以有管理员列表和普通会员列表
    $userAr = new UserRecord();
    
    $res = $userAr->findAllUserInRole($role);
    $retdata = array();
    
    foreach ($res as $user) {
      $retdata[] = $user->attributes;
    }
    
    $this->responseJSON($retdata, "success", array("total" => count($res)));
  }
  
  /**
   * 新用户注册
   */
  public function actionPost() {
    $userAr = new UserRecord();
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      $this->responseError("Http error");
    }
    $data = $_POST;
    $userAr->attributes = $data;
    
    if ($userAr->validate()) {
      $userAr->save();
      $this->responseJSON($userAr->attributes, "success");
    }
    else {
      // 只需要输出第一个错
      $errors = $userAr->getErrors();
      $error = array_shift($errors);
      $this->responseError(current($error));
    }
  }
  
  public function actionUser() {
    $request = Yii::app()->getRequest();
    $user_id = $request->getParam("user_id");
    // 如果没有传user_id参数，则获取当前用户
    if (!$user_id) {
      $user_id = Yii::app()->user->getId();
    }
    if (!$user_id) {
      return $this->responseError("invalid params");
    }
    $user = UserRecord::model()->findByPk($user_id);
    if ($user) {
      $data = $user->toArray();
      $this->responseJSON($data, "success");
    }
    else {
      return $this->responseError("invalid params");
    }
  }
  
  public function actionDelete() {
    $request = Yii::app()->getRequest();
    if (!$request->isPostRequest) {
      return $this->responseError("http error");
    }
    $user_id = $request->getPost("user_id");
    
    $user = UserRecord::model()->findByPk($user_id);
    if ($user) {
      UserRecord::model()->deleteByPk($user_id);
    }
    return $this->responseJSON(array(), "success");
  }
  
  public function actionTest() {
      return $this->responseError("error happend ". Yii::app()->user->getId());
  }
  
  public function actionLoginform() {
    if (Yii::app()->user->getId()) {
      return $this->redirect(array("site/index"));
    }
    $request = Yii::app()->getRequest();
    $loginform = new LoginForm();
    if ($request->isPostRequest) {
      $data = $_POST[get_class($loginform)];
      
      $loginform->attributes = $data;
      
      if ($loginform->login()) {
        return $this->redirect(array("site/index"));
      }
      else {
        // 这里没有其他可以处理了；页面会重新渲染一次，错误也会出现在页面上
      }
    }
    return $this->render("loginform", array("model" => $loginform));
  }
  
  public function actionLogout() {
    Yii::app()->user->logout();
    
    return $this->redirect(array("site/index"));
  }
  
  /**
   * 用户地址列表
   */
  public function actionAddress() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      return $this->responseError("http error");
    }
    
    $user_id = $request->getParam("user_id");
    if (!$user_id) {
      $user_id = Yii::app()->user->getId();
    }
    
    $user = UserRecord::model()->findByPk($user_id);
    if (!$user) {
      return $this->responseError("user not found");
    }
    
    $address = AddressRecord::model()->getUserAddress($user_id);
    if (!$address) {
      return $this->responseJSON(array(), "success");
    }
    
    $this->responseJSON($address, "success");
  }
  
  public function actionAddAddress() {
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      return $this->responseError("http error");
    }
    $address = $request->getPost("address");
    $user_id = $request->getPost("user_id");
    if (!$user_id) {
      $user_id = Yii::app()->user->getId();
    }
    
    $addressAr = new AddressRecord();
    $addressAr->addUserAddress($user_id, $address);
    if ($addressAr->getErrors()) {
      return $this->responseError(current(array_shift($addressAr->getErrors())));
    }
    else {
      return $this->responseJSON($addressAr->toArray(), "success");
    }
  }
  
  public function actionDeleteAddress() {
    $request = Yii::app()->getRequest();
    if (!$request->isPostRequest) {
      return $this->responseError("http error");
    }
    
    $ua_id = $request->getPost("ua_id");
    if (!$ua_id && !is_numeric($ua_id)) {
      return $this->responseError("invalid params");
    }
    
    // 地址是可以删掉的
    $addressAr = new AddressRecord();
    $addressAr->deleteByPk($ua_id);
    
    return $this->responseJSON(array(), "success");
  }
}
