<?php
/*
Plugin Name: BFG Project Content
Plugin URI:
Description: Post type personalizado para el contenido de tipo proyectos
Version:     2.0
Author:      Beforget
Author URI:  https://beforget.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit;

require_once plugin_dir_path(__FILE__) . 'includes/bfg-project-style-register.php';
require_once plugin_dir_path(__FILE__) . 'includes/bfg-project-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/bfg-project-display-profile.php';
require_once plugin_dir_path(__FILE__) . 'includes/bfg-project-register-scripts.php';
require_once plugin_dir_path(__FILE__) . 'includes/bfg-project-rest-api.php';
register_activation_hook(__FILE__, 'rewrite_flush');