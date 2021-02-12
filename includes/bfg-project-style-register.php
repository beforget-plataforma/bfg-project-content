<?
if ( ! defined( 'ABSPATH' ) ) exit;

function bfg_register_plugin_styles_prject() {
	wp_register_style( 'bfg-style-post', plugins_url( '/bfg-project-content/includes/assets/css/bfg-styles.css', true ) );
	wp_enqueue_style( 'bfg-style-post' );
}
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'bfg_register_plugin_styles_prject' );