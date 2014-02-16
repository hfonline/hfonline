<?php

class SiteController extends Controller


{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
    $food = FoodAR::loadFood(1);
		$this->render('index', array(
        "food_list" => $food["list"],
        "pager" => $food["pager"],
    ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
  
  public function actionDestroyCache() {
    Yii::app()->session->destroy();
  }
    
  public function actionAddress() {
    $this->render("address");
  }

  public function actionConfirm() {
    $request = Yii::app()->getRequest();
    
    if ($request->getParam("address") == "") {
      $this->responseError("Hello WORLD");
      //$this->redirect("site/address");
    }
    
    $this->render("confirm");
  }
  
  public function actionSubmit() {
    $request = Yii::app()->getRequest();
    
    $address = $request->getPost("address");
    $region = $request->getPost("region");
    $foods = FoodAR::orderItems();
    $lat = $request->getPost("lat");
    $lng = $request->getPost("lng");
    
    $body = $request->getPost("memo");
    $phone = $request->getPost("phone");
    
    $title = "用户订单-日期 " . date("Y-m-d h:m:s") . " 电话 " . $phone;
    
    if (!$request->isPostRequest) {
      return $this->redirect(array("index"));
    }
    
    $items = FoodAR::orderItems();
    if (empty($items)) {
      return $this->redirect(array("index"));
    }
    
    // Step1, Get field orders array
    $field_orders = array();
    foreach ($items as  $item) {
      $food_id = $item["food_id"];
      $note = $item["note"];
      $more_spicy = $item["more_spicy"];
      $field_orders[] = array (
          "field_reference_food" => $food_id,
          "field_item_note" => $note,
          "field_more_spicy" => $more_spicy == "on" ? 1 : 0,
      );
    }
    
    $order = array(
        "title" => $title,
        "body" => $body,
        "type" => "order",
        "field_operator" => 1,
        "field_delivery_status" => 0,
        "field_customer_phone" => $phone,
        "field_order_items" => $field_orders,
        "field_delivery_address" => $address,
        "field_delivery_region" => $region,
    );
    
    $base_url = Yii::app()->params["api_url"];
    $url = $base_url."/food/front/node";
    
    $data = $this->postTo($url, $this->wrapper($order));
    
    $data = json_decode($data, TRUE);
    
    //FoodAR::clearOrderItems();
    if (isset($data["nid"])) {
      return $this->redirect(array("order/status", "order_id" => $data["nid"]));
    }
    else {
      $this->render("submit", array(
          "data" => $data
      ));
    }
  }
}