<?php

class OrderController extends Controller {
  
  /**
   * @food_id 
   * @more_spicy
   * @note
   */
  public function actionAddOneItem() {
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      //return $this->responseError("http error");
    }
    
    $food_id = $request->getPost("food_id");
    $note = $request->getPost("note");
    $more_spicy = $request->getPost("more_spicy");
    
    if (!$food_id) {
      return $this->responseError("missed request params");
    }
    
    $items = Yii::app()->session["order_items"];
    if (!$items) {
      $items = array();
    }
    
    $items[] = array(
        "food_id" => $food_id,
        "note" => $note,
        "more_spicy" => $more_spicy
    );
    
    Yii::app()->session["order_items"] = $items;
    
    $this->responseJSON($items, "success");
  }
  
  public function actionSubmitOrder() {
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      //return $this->responseError("http error");
    }
    $items = Yii::app()->session["order_items"];
    
    if (empty($items)) {
      return $this->responseError("order items is empty");
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
          "field_more_spicy" => $more_spicy,
      );
    }
    
    $order = array(
        "title" => "sample",
        "body" =>  "I am just a sample",
        "type" => "order",
        "field_operator" => 1,
        "field_delivery_status" => 1,
        "field_order_items" => $field_orders,
    );
    
    $base_url = Yii::app()->params["api_url"];
    $url = $base_url."/food/front/node";
    
    $data = $this->postTo($url, $this->wrapper($order));
    
    Yii::app()->session["order_items"] = array();
    
    $this->responseJSON($data, "success");
  }
  
  public function actionOrderItems() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      //return $this->responseError("http error");
    }
    
    return $this->responseJSON(FoodAR::orderItems(), "success");
  }
  
}

