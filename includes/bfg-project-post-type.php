<?php

function bfg_project_post_type() {

  // Etiquetas para el Post Type
    $labels = array(
      'name'                => _x( 'Proyectos', 'Post Type General Name', 'bfg-plataform' ),
      'singular_name'       => _x( 'Proyecto', 'Post Type Singular Name', 'bfg-plataform' ),
      'menu_name'           => __( 'Proyectos', 'bfg-plataform' ),
      'parent_item_colon'   => __( 'Proyecto Padre', 'bfg-plataform' ),
      'all_items'           => __( 'Todos los Proyectos', 'bfg-plataform' ),
      'view_item'           => __( 'Ver Proyecto', 'bfg-plataform' ),
      'add_new_item'        => __( 'Agregar Nuevo Proyecto', 'bfg-plataform' ),
      'add_new'             => __( 'Agregar Nuevo Proyecto', 'bfg-plataform' ),
      'edit_item'           => __( 'Editar Proyecto', 'bfg-plataform' ),
      'update_item'         => __( 'Actualizar Proyecto', 'bfg-plataform' ),
      'search_items'        => __( 'Buscar Proyecto', 'bfg-plataform' ),
      'not_found'           => __( 'No encontrado', 'bfg-plataform' ),
      'not_found_in_trash'  => __( 'No encontrado en la papelera', 'bfg-plataform' ),
    );
  
  // Otras opciones para el post type
  
    $args = array(
      'labels'              => $labels,
      'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions'),
      /* Un Post Type hierarchical es como las paginas y puede tener padres e hijos.
      * Uno sin hierarchical es como los posts
      */
      'hierarchical'        => true,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'rewrite'             => array( 'slug' => 'proyectos' ),
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-admin-page',
      'can_export'          => true,
      'has_archive'         => false,
      'exclude_from_search' => true,
      'publicly_queryable'  => true,
      'capability_type'    => array('project', 'projects'),
      'map_meta_cap'       => true,
    );
  
    // Por ultimo registramos el post type
    register_post_type( 'proyectos', $args );
  
  }
  add_action( 'init', 'bfg_project_post_type' );


  function bfg_ods_proyectos() {
    $labels = array(
      'name'              => _x( 'ODS', 'taxonomy general name' ),
      'singular_name'     => _x( 'ODS', 'taxonomy singular name' ),
      'search_items'      => __( 'Buscar ODS' ),
      'all_items'         => __( 'Todos los ODS' ),
      'parent_item'       => __( 'ODS Padre' ),
      'parent_item_colon' => __( 'ODS Padre:' ),
      'edit_item'         => __( 'Editar ODS' ),
      'update_item'       => __( 'Actualizar ODS' ),
      'add_new_item'      => __( 'Agregar Nuevo ODS' ),
      'new_item_name'     => __( 'Nuevo ODS' ),
      'menu_name'         => __( 'ODS' ),
    );
  
    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite' => array( 'slug' => 'ods' ),
    );
  
    register_taxonomy( 'ods', array('proyectos' ), $args );
  }
  add_action( 'init', 'bfg_ods_proyectos' );