<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MediaEntityRecord extends CActiveRecord {
  public function getPrimaryKey() {
    return "media_entity_id";
  }
  
  public function tableName() {
    return "media_entity";
  }
  
  public function rules() {
    return array(
        array("media_id, entity_id, field_name", "required"),
    );
  }
}

/**
 * Description of MediaRecord
 *
 * @author jackey
 */
class MediaRecord extends CActiveRecord{
  
  /**
   *
   * @var MediaEntityRecord
   */
  private $mediaEntityRecord;
  
  public function init() {
    $this->mediaEntityRecord = new MediaEntityRecord();
  }
  
  public static function model() {
    return parent::model();
  }
  
  public function getPrimaryKey() {
    return "media_id";
  }
  
  public function tableName() {
    return "media";
  }
  
  public function rules() {
    return array(
        array("media_id, uri, mime, name, updated, created", "required"),
    );
  }
  
  /**
   * 
   * @param array $file File object from $_FILES global var
   * @return int $media_id
   */
  public function saveMedia($file) {
    $dir = ROOT_PATH."/upload";
    $save_to = $dir."/".time(). $file["name"];
    if (!is_dir($dir)) {
      mkdir($dir, "744");
    }
    if (is_file($save_to)) {
      $save_to = $dir."/".uniqid().$file["name"];
    }
    // TODO:: 在这里检查文件合法性
    move_uploaded_file($file["tmp_name"], $save_to);
    
    $data = array(
        "uri" => str_replace(ROOT_PATH, "", $save_to),
        "mime" => $file["type"],
        "name" => $file["name"],
        "updated" => time(),
        "created0" => time(),
    );
    
    $this->attributes = $data;
    return $this->save();
  }
  
  /**
   * 
   * @param CActiveRecord $record
   * @param type $fieldName
   */
  public function loadMediaWithEntity($record, $fieldName) {
    $attributes = $record->attributes;
    
    // Entity Id 查询条件
    $entity_id = $attributes[$record->getPrimaryKey()];
    $cond = new CDbCriteria();
    $cond->addCondition("entity_id = :entity_id");
    $cond->params[":entity_id"] = $entity_id;
    
    // Field name 查询条件
    $cond->addCondition("field_name = :fieldname");
    $cond->params[":field_name"] = $fieldName;
    
    $cond->select = $this->getPrimaryKey();
    
    // 查询出所有的media_id
    $allMediaIds = $this->mediaEntityRecord->findAll($cond);
    
    print_r($allMediaIds->together());
  }
  
  public function addMediaWithEntity($record, $fieldName) {
    
  }
  
  public function deleteMediaWithEntity($record, $media_id) {
    
  }
}
