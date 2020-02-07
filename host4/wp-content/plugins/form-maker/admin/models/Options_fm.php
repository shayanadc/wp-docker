<?php

/**
 * Class FMModelOptions_fm
 */
class FMModelOptions_fm extends FMAdminModel {
  /**
   * Save data to DB.
   */
  public function save_db() {
    $option_key = WDFMInstance(self::PLUGIN)->handle_prefix . '_settings';
    $fm_settings = WDFMInstance(self::PLUGIN)->fm_settings;
    $public_key = WDW_FM_Library(self::PLUGIN)->get('public_key', '', 'sanitize_text_field');
    $private_key = WDW_FM_Library(self::PLUGIN)->get('private_key', '', 'sanitize_text_field');
    $recaptcha_score = WDW_FM_Library(self::PLUGIN)->get('recaptcha_score', '', 'sanitize_text_field');
    $csv_delimiter = WDW_FM_Library(self::PLUGIN)->get('csv_delimiter') != '' ? WDW_FM_Library(self::PLUGIN)->get('csv_delimiter','','sanitize_text_field') : ',';
    $fm_shortcode = (isset($_POST['fm_shortcode']) ? "old" : '');
    $fm_advanced_layout = WDW_FM_Library(self::PLUGIN)->get('fm_advanced_layout', '0', 'sanitize_text_field');
    $fm_enable_wp_editor = WDW_FM_Library(self::PLUGIN)->get('fm_enable_wp_editor', '1', 'sanitize_text_field');
    $fm_antispam = WDW_FM_Library(self::PLUGIN)->get('fm_antispam', '0', 'sanitize_text_field');
    $fm_ajax_submit = WDW_FM_Library(self::PLUGIN)->get('fm_ajax_submit', '0', 'sanitize_text_field');
    $fm_developer_mode = WDW_FM_Library(self::PLUGIN)->get('fm_developer_mode', '0', 'sanitize_text_field');
    $map_key = WDW_FM_Library(self::PLUGIN)->get('map_key', '', 'sanitize_text_field');
	  update_option( $option_key, array(
      'public_key' => $public_key,
      'private_key' => $private_key,
      'recaptcha_score' => $recaptcha_score,
      'csv_delimiter' => $csv_delimiter,
      'map_key' => $map_key,
      'fm_shortcode' => $fm_shortcode,
      'fm_advanced_layout' => $fm_advanced_layout,
      'fm_enable_wp_editor' => $fm_enable_wp_editor,
      'fm_antispam' => $fm_antispam,
      'fm_ajax_submit' => $fm_ajax_submit,
      'fm_developer_mode' => $fm_developer_mode,
      'ajax_export_per_page' => !empty($fm_settings['ajax_export_per_page']) ? $fm_settings['ajax_export_per_page'] : 1000
    ));

    return 8;
  }
}

