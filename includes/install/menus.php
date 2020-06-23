<?php


  /**
   * Menus
   */


  $menu_name = 'Topo';
  $menu_exists = wp_get_nav_menu_object( $menu_name );

  if ( ! $menu_exists ) {

    $menu_id = wp_create_nav_menu( $menu_name );

    $page = get_page_by_title( 'Sobre' );
    if($page != NULL){
      wp_update_nav_menu_item( $menu_id, 0, [
        'menu-item-title'     => __( 'Sobre' ),
        'menu-item-classes'   => 'about',
        'menu-item-object-id' => $page->ID,
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish',
      ]);
    }

    $page = get_page_by_title( 'Blog' );
    if($page != NULL){
      wp_update_nav_menu_item( $menu_id, 0, [
        'menu-item-title'     => __( 'Blog' ),
        'menu-item-object-id' => $page->ID,
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish',
      ]);
    }

    $page = get_page_by_title( 'Contato' );
    if($page != NULL){
      wp_update_nav_menu_item( $menu_id, 0, [
        'menu-item-title'     => __( 'Contato' ),
        'menu-item-object-id' => $page->ID,
        'menu-item-object'    => 'page',
        'menu-item-type'      => 'post_type',
        'menu-item-status'    => 'publish',
      ]);
    }

    $menu_object = wp_get_nav_menu_object( $menu_id );
    $locations = get_theme_mod( 'nav_menu_locations' );
    $locations['topo'] = $menu_object->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );

  }
