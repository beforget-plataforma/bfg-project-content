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
// register_activation_hook(__FILE__, 'rewrite_flush');

function searchPostProyectos() {
  $searchOds = $_POST['searchOds'];
  $tipoOds = explode(",", $searchOds);
  $searchCategory = $_POST['searchCategory'];
  $tipoCategoria = explode(",", $searchCategory);

  $args = array(
      'post_type' => 'proyectos',
      'posts_per_page' => -1,
      'orderbyby' => 'ASC',
      'tax_query' => array( 
          array(
            'taxonomy' => 'categoria-sesion',
            'field'    => 'slug',
            'terms'    => $tipoCategoria,
          ),
        ),
    );
    $posts = get_posts($args);
    // var_dump($posts);
    foreach ( $posts as $post ) {
        setup_postdata( $post );
        $title = get_the_title();
        $short_title = wp_trim_words( $title, 12, '...' );

        $thumbID = get_post_thumbnail_id( $post->ID );
        $imgDestacada = wp_get_attachment_url( $thumbID );

        $logo2 = get_post_meta( $post->ID, 'logo_proyecto', true );
        $miembros = get_post_meta( $post->ID, 'miembros', true );
        $user_id = get_the_author_meta( 'ID' );

        $members = array();

        foreach($miembros as $userID){
          $userName = xprofile_get_field_data('1', $userID);
          $args2 = array( 
            'item_id' => $userID,
          ); 
          // echo bp_core_fetch_avatar($args2); 
          array_push($members, bp_core_fetch_avatar($args2));
        }

        // $logo =  get_post_meta( $post->ID, 'logo_proyecto' );

        $listado[] = array(
          'id'   => $post->ID,
          'ods' => get_the_terms( $post->ID, 'ods' ),
          'nombre' => $post->post_title,
          'excerpt' => $post->post_excerpt,
          'imagen' => $imgDestacada,
          'logo' => wp_get_attachment_url( $logo2, 'thumbnail' ),
          'member' => $members,
          'author' => get_author_name(),
          'content' => wp_trim_words( $post->post_content, 30, '...' ),
          'link' => get_permalink( $post->ID ),
          'get_template_directory_uri' => get_template_directory_uri(),
          'get_stylesheet_directory_uri' => get_stylesheet_directory_uri(),
        );
    }
    header("Content-type: application/json");
    echo json_encode( $listado);
    die;
  
}
add_action('wp_ajax_nopriv_searchPostProyectos', 'searchPostProyectos');
add_action('wp_ajax_searchPostProyectos', 'searchPostProyectos');