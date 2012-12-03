<?php
/**
 * @file
 * hfonline_food.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function hfonline_food_taxonomy_default_vocabularies() {
  return array(
    'food_promotion' => array(
      'name' => '推荐',
      'machine_name' => 'food_promotion',
      'description' => '推荐类型',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
    ),
    'food_time' => array(
      'name' => '餐品区段',
      'machine_name' => 'food_time',
      'description' => '餐品的食用时间区段，如早餐/甜点',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
    ),
    'food_type' => array(
      'name' => '菜系',
      'machine_name' => 'food_type',
      'description' => '餐品的菜系，如湘菜，川菜',
      'hierarchy' => '0',
      'module' => 'taxonomy',
      'weight' => '0',
    ),
  );
}
