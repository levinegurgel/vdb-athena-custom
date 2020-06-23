<?php

/**
* Register custom post types
*/
function ath_register_cpt_and_tax() {

  
  /**
   * Formatos de Conteúdo
   */
  $pname  = 'Formatos';
  $sname  = 'Formato';
  $labels = array(
    'name'                  => $pname,
    'singular_name'         => $sname,
    'search_items'          => sprintf( 'Pesquisar %s', $pname ),
    'all_items'             => sprintf( 'Todos(as) %s', $pname ),
    'parent_item'           => sprintf( '%s Pai', $sname ),
    'parent_item_colon'     => sprintf( '%s Pai:', $sname ),
    'edit_item'             => sprintf( 'Editar %s', $sname ),
    'update_item'           => sprintf( 'Atualizar %s', $sname ),
    'add_new_item'          => sprintf( 'Adicionar Novo(a) %s', $sname ),
    'new_item_name'         => sprintf( 'Novo Nome do(a) %s', $sname ),
    'menu_name'             => $pname,
  );
  $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_nav_menus'     => false,
    'show_in_rest'          => false,
    'show_admin_column'     => true,
    'hierarchical'          => true,
    'query_var'             => 'formato',
    'rewrite'               => false,
  );
  // register_taxonomy( 'content_format', array( 'post' ), $args );

  
  /**
   * Banners
   */
  // $pname  = 'Banners';
  // $sname  = 'Banner';
  // $labels = array(
  //   'name'                  => $pname,
  //   'singular_name'         => $sname,
  //   'menu_name'             => $pname,
  //   'name_admin_bar'        => $sname,
  //   'add_new'               => 'Adicionar Novo(a)',
  //   'add_new_item'          => sprintf( 'Adicionar Novo(a) %s', $sname ),
  //   'new_item'              => sprintf( 'Novo(a) %s', $sname ),
  //   'edit_item'             => sprintf( 'Editar %s', $sname ),
  //   'view_item'             => sprintf( 'Ver %s', $sname ),
  //   'all_items'             => sprintf( 'Todos(as) %s', $pname ),
  //   'search_items'          => sprintf( 'Pesquisar %s', $pname ),
  //   'parent_item_colon'     => sprintf( '%s Pai:', $pname ),
  //   'not_found'             => sprintf( 'Nenhum(a) %s encontrado(a).', $pname ),
  //   'not_found_in_trash'    => sprintf( 'Nenhum(a) %s encontrado(a) na Lixeira.', $pname ),
  // );
  // $args = array(
  //   'labels'                => $labels,
  //   'public'                => true,
  //   'publicly_queryable'    => true,
  //   'show_ui'               => true,
  //   'show_in_menu'          => true,
  //   'show_in_nav_menus'     => false,
  //   'query_var'             => true,
  //   'rewrite'               => false,
  //   'capability_type'       => 'post',
  //   'has_archive'           => false,
  //   'hierarchical'          => false,
  //   'menu_position'         => null,
  //   'menu_icon'             => 'dashicons-format-image',
  //   'supports'              => array( 'title' ),
  //   'exclude_from_search'   => true,
  //   'taxonomies'            => array( 'category' ),
  // );
  // register_post_type( 'banner', $args );



  /**
   * Campanhas
   */
  // $pname  = 'Campanhas';
  // $sname  = 'Campanha';
  // $labels = array(
  //   'name'                  => $pname,
  //   'singular_name'         => $sname,
  //   'menu_name'             => $pname,
  //   'name_admin_bar'        => $sname,
  //   'add_new'               => 'Adicionar Novo(a)',
  //   'add_new_item'          => sprintf( 'Adicionar Novo(a) %s', $sname ),
  //   'new_item'              => sprintf( 'Novo(a) %s', $sname ),
  //   'edit_item'             => sprintf( 'Editar %s', $sname ),
  //   'view_item'             => sprintf( 'Ver %s', $sname ),
  //   'all_items'             => sprintf( 'Todos(as) %s', $pname ),
  //   'search_items'          => sprintf( 'Pesquisar %s', $pname ),
  //   'parent_item_colon'     => sprintf( '%s Pai:', $pname ),
  //   'not_found'             => sprintf( 'Nenhum(a) %s encontrado(a).', $pname ),
  //   'not_found_in_trash'    => sprintf( 'Nenhum(a) %s encontrado(a) na Lixeira.', $pname ),
  // );
  // $args = array(
  //   'labels'                => $labels,
  //   'public'                => true,
  //   'publicly_queryable'    => true,
  //   'show_ui'               => true,
  //   'show_in_menu'          => true,
  //   'show_in_nav_menus'     => false,
  //   'query_var'             => true,
  //   'rewrite'               => false,
  //   'capability_type'       => 'post',
  //   'has_archive'           => false,
  //   'hierarchical'          => false,
  //   'menu_position'         => null,
  //   'menu_icon'             => 'dashicons-megaphone',
  //   'supports'              => array( 'title' ),
  //   'exclude_from_search'   => true,
  //   // 'taxonomies'            => array( 'category' ),
  // );
  // register_post_type( 'campaign', $args );


  
  /**
   * Materiais Educativos
   */
  $pname  = 'Materiais';
  $sname  = 'Material';
  $labels = array(
    'name'                  => $pname,
    'singular_name'         => $sname,
    'menu_name'             => $pname,
    'name_admin_bar'        => $sname,
    'add_new'               => 'Adicionar Novo(a)',
    'add_new_item'          => sprintf( 'Adicionar Novo(a) %s', $sname ),
    'new_item'              => sprintf( 'Novo(a) %s', $sname ),
    'edit_item'             => sprintf( 'Editar %s', $sname ),
    'view_item'             => sprintf( 'Ver %s', $sname ),
    'all_items'             => sprintf( 'Todos(as) %s', $pname ),
    'search_items'          => sprintf( 'Pesquisar %s', $pname ),
    'parent_item_colon'     => sprintf( '%s Pai:', $pname ),
    'not_found'             => sprintf( 'Nenhum(a) %s encontrado(a).', $pname ),
    'not_found_in_trash'    => sprintf( 'Nenhum(a) %s encontrado(a) na Lixeira.', $pname ),
  );
  $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_nav_menus'     => false,
    'query_var'             => true,
    'rewrite'               => array('slug' => 'materiais'),
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => null,
    'menu_icon'             => 'dashicons-book',
    'supports'              => array( 'title', 'page-attributes', 'thumbnail', 'comments' ),
    'exclude_from_search'   => true,
    'taxonomies'            => array( 'category' ),
  );
  register_post_type( 'material', $args );

  
  $pname  = 'Tipos';
  $sname  = 'Tipo';
  $labels = array(
    'name'                  => $pname,
    'singular_name'         => $sname,
    'search_items'          => sprintf( 'Pesquisar %s', $pname ),
    'all_items'             => sprintf( 'Todos(as) %s', $pname ),
    'parent_item'           => sprintf( '%s Pai', $sname ),
    'parent_item_colon'     => sprintf( '%s Pai:', $sname ),
    'edit_item'             => sprintf( 'Editar %s', $sname ),
    'update_item'           => sprintf( 'Atualizar %s', $sname ),
    'add_new_item'          => sprintf( 'Adicionar Novo(a) %s', $sname ),
    'new_item_name'         => sprintf( 'Novo Nome do(a) %s', $sname ),
    'menu_name'             => $pname,
  );
  $args = array(
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_nav_menus'     => true,
    'show_in_rest'          => false,
    'show_admin_column'     => true,
    'hierarchical'          => true,
    'query_var'             => 'materiais-tipo',
    'rewrite'               => array( 'slug' => 'materiais-tipo' ),
  );
  register_taxonomy( 'material_type', array( 'material' ), $args );



  /**
   * Formatos de materiais padrões
   */
  wp_insert_term(
    'Ebooks',
    'material_type',
    array(
      'description' => '',
      'slug' => 'ebooks'
    )
  );

  wp_insert_term(
    'Infográficos',
    'material_type',
    array(
      'description' => '',
      'slug' => 'infograficos'
    )
  );

  wp_insert_term(
    'Podcasts',
    'material_type',
    array(
      'description' => '',
      'slug' => 'podcasts'
    )
  );

  wp_insert_term(
    'Videos',
    'material_type',
    array(
      'description' => '',
      'slug' => 'videos'
    )
  );


  /**
   * Bloqueado a edição das categorias padrões
   */


  function wpse16327_content_format_row_actions( $actions, $term ){      
      $terms = array('artigos','ebooks','infograficos','podcasts','videos');
      if(in_array($term->slug,$terms)){
        unset( $actions['view'] );
        // unset( $actions['edit'] );
        unset( $actions['inline hide-if-no-js'] );
        unset( $actions['delete'] );
      }
      return $actions;
  }
  add_filter( 'content_format_row_actions', 'wpse16327_content_format_row_actions', 10, 2 );
  add_filter( 'material_type_row_actions', 'wpse16327_content_format_row_actions', 10, 2 );


  /**
   * Removendo campos de edição das categorias padrões
   */

  function content_format_hide($term){
     $terms = array('artigos','ebooks','infograficos','podcasts','videos');
     if(in_array($term->slug,$terms)){
        echo '<style>.term-name-wrap,.term-slug-wrap,.term-parent-wrap,#delete-link{display:none !important;}</style>';
     }
  }
  add_action( 'content_format_edit_form_fields', 'content_format_hide', 10, 2 );
  add_action( 'material_type_edit_form_fields', 'content_format_hide', 10, 2 );


}
add_action( 'init', 'ath_register_cpt_and_tax' );