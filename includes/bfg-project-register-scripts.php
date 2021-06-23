<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function bfg_project_tab_script() {
  $profileUserID = bp_displayed_user_id();
  $current_user = wp_get_current_user();
 

  wp_register_script('bfgProject', esc_url(plugins_url('/frontend/tab/tab-proyecto-profile.js', dirname(__FILE__) )), time(), false);
  wp_localize_script('bfgProject', 'bpRestApi', array(
    'nonce' => wp_create_nonce( 'wp_rest' ),
    'sessionUserID' => $current_user->ID,
    'profileUserID' => $profileUserID,
  ));

  wp_enqueue_script('bfgProject');

}
function bfg_project_filter_script() {
  $termsOdsCategory = get_terms( array(
    'taxonomy' => 'ods',
    'order' => 'DESC',
  ));
  wp_register_script('bfgProject', esc_url(plugins_url('/frontend/dist/bundle.js', dirname(__FILE__) )), true);
  wp_localize_script('bfgProject', 'bfg_pageviews_ajax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce( 'bfg-pageviews-nonce' ),
    'taxOdsCategory' => $termsOdsCategory,
    'is_user_logged_in' => is_user_logged_in()
  ));

  wp_enqueue_script('bfgProject');

}
add_action( 'bfg_filter_proyecto_script', 'bfg_project_filter_script' );

function bfg_project_script_slick() {
  $profileUserID = bp_displayed_user_id();
  $current_user = wp_get_current_user();
  $termsType = get_terms( array(
    'taxonomy' => 'tipo-sesion',
     'order' => 'DESC',
  ));
  $termsCategory = get_terms( array(
      'taxonomy' => 'categoria-sesion',
      'order' => 'DESC',
  ));

  wp_register_script('bfgProyectosSlick', esc_url(plugins_url('/frontend/dist/loadSlickCarrusel.js', dirname(__FILE__) )), true);
  wp_localize_script('bfgProyectosSlick', 'wp_pageviews_ajax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce( 'wp-pageviews-nonce' ),
    'taxSesionesType' => $termsType,
    'taxSesionesCat' => $termsCategory,
    'is_user_logged_in' => is_user_logged_in()
  ));

  wp_enqueue_script('bfgProyectosSlick');
}

add_action( 'bfg_filter_proyectos_slick_script', 'bfg_project_script_slick' );