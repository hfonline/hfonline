<?php
/**
 * @file
 * hfonline_food.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function hfonline_food_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function hfonline_food_node_info() {
  $items = array(
    'food' => array(
      'name' => t('餐品'),
      'base' => 'node_content',
      'description' => t('餐品'),
      'has_title' => '1',
      'title_label' => t('餐品名称'),
      'help' => '',
    ),
  );
  return $items;
}
