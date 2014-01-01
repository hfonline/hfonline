<?php

class UserController extends Controller {
  
  public function actionIndex() {
    $this->responseError("not support yet");
  }
  
  public function actionList() {
    $userAr = new UserRecord();
    
    $res = $userAr->findAll();
    $retdata = array();
    
    foreach ($res as $user) {
      $retdata[] = $user->attributes;
    }
    
    $this->responseJSON($retdata, "success", array("total" => count($res)));
  }
  
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
  
  public function actionDelete() {
    
  }
}
