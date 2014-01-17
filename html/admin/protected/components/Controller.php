<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    /**
     *
     * @var CHttpRequest
     */
    public $request = NULL;
    
    /**
     * 返回错误到客户端
     * @param type $message
     */
    public function responseError($message) {
      $this->_renderjson($this->wrapperDataInRest(NULL, $message, TRUE));
    }
    
    /**
     * 返回数据到客户端
     * @param array $data 返回的Table 数据
     * @param type $message 返回的消息
     * @param type $ext 额外的数据 如 total: 12
     */
    public function responseJSON($data, $message, $ext = array()) {
      $this->_renderjson($this->wrapperDataInRest($data, $message, FALSE, $ext));
    }
    
    public function wrapperDataInRest($data, $message = '', $error = FALSE, $ext = array()) {
      $json = array(
          "success" => !$error,
          "message" => $message,
          "data" => $data
      );
      
      if (!empty($ext)) {
        $json += $ext;
      }
      
      return $json;
    }
    
    private function _renderjson($data) {
      header("Content-Type: application/json; charset=UTF-8");
      print CJavaScript::jsonEncode($data);
      die();
    }
    
    public function getExtPostData() {
      $data = file_get_contents("php://input");
      $data = json_decode($data,TRUE);
      
      if (is_array($data)) {
        return $data;
      }
      else {
        return array();
      }
    }
}