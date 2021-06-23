<?
if ( ! defined( 'ABSPATH' ) ) exit;

function bfg_register_plugin_styles_prject() {
	wp_register_style( 'bfg-style-project', plugins_url( '/bfg-project-content/assets/css/bfg-styles.css') );
	wp_enqueue_style( 'bfg-style-project' );
}
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'bfg_register_plugin_styles_prject' );