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
  
  public function responseError($message) {
         $this->_renderjson($this->wrapperDataInRest(NULL, $message, TRUE));
    }

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
    
    public function postTo($url, $data) {
      $req = curl_init();
      curl_setopt($req, CURLOPT_URL, $url);
      curl_setopt($req, CURLOPT_POST, 1);
      curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($req, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
      curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($data));
      
      $res = curl_exec($req);
      curl_close($req);
      //return json_decode($data);
      return $res;
    }
    
    public function wrapper($data) {
      $lang_key = 'und';
      foreach ($data as $key => $d) {
        if (!is_numeric($key) && strpos($key, "field_") !== FALSE) {
          if (is_array($d)) {
            $d = $this->wrapper($d);
          }
          $data[$key] = array($lang_key => $d);
        }
        else if (is_numeric($key)) {
            if (is_array($d)) {
              foreach ($d as $dd_key => $ddd) {
                if (!is_numeric($dd_key) && strpos($dd_key, "field_") !== FALSE) {
                  $d[$dd_key] = array('und' => $ddd);
                }
              }
            }
            $data[$key] = $d;
          }
      }
      return $data;
    }
}