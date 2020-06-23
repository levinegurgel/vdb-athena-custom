<?php
class Controller_Materials extends Controller_Posts {

  public function __construct( $add_filters = false ) {
    if ( $add_filters ) {
      add_filter( 'get_materials_content', array( $this, 'get_materials_content' ) );
      add_filter( 'get_materials_types', array( $this, 'get_materials_types' ) );
      add_filter( 'get_material_content', array( $this, 'get_material_content' ) );
    }
  }

  public function get_materials_content( $args = array(), $raw_data = false ) {
    $defaults = array(
      'post_type'         => 'material',
      'post_status'       => 'publish',
    );
    $args  = wp_parse_args( $args, $defaults );
    $posts = parent::get_posts_content( $args, true );

    if ( $posts && false == $raw_data ) {
      foreach ( $posts as $post ) {
        $_posts[] = $this->get_material_content( $post );
      }
      $posts = $_posts;
    }
    return $posts;
  }

  public function get_materials_types( $args = array() ) {
    $defaults = array(
      'meta_query'      => array(
        'relation'        => 'OR',
        array(
          'key'           => 'material_type_order',
          'compare'       => 'NOT EXISTS',
        ),
        array(
          'key'           => 'material_type_order',
          'value'         => 0,
          'compare'       => '>=',
          'type'          => 'NUMERIC',
        ),
      ),
      'orderby'         => 'meta_value',
    );
    $args = wp_parse_args( $args, $defaults );
    $args['taxonomy'] = 'material_type';
    return parent::get_posts_terms( $args );
  }

   public function get_material_better_thumbnail( $attach_id, $size, $post_id ){

    $attach = wp_get_attachment_metadata($attach_id);
    if(isset($attach['sizes'][$size])){
      return wp_get_attachment_image_src($attach_id,$size);
    }else{
      return wp_get_attachment_image_src($attach_id,'medium');
    }

  }

  public function get_material_content( $post = false ) {
    if ( false == $post ) {
      global $post;
    }
    $post_content                       = parent::get_post_default_content( $post );
    $post_content->types                = parent::get_post_terms( $post->ID, 'material_type' );
    $post_content->categories           = parent::get_post_categories( $post->ID );
    $post_content->description          = get_field( 'material_description', $post->ID );
    $post_content->color                = get_field( 'material_color', $post->ID );
    $post_content->thumbnail_low        = get_field( 'material_thumbnail' );
    $post_content->thumbnail            = $this->get_material_better_thumbnail(get_field( 'material_thumbnail', $post->ID)['ID'],'ath-thumb-large',$post->ID);
    $post_content->thumbnail_type       = get_field( 'material_thumbnail_type', $post->ID );
    if ( empty( $post_content->color ) && $post_content->categories && ! is_wp_error( $post_content->categories ) ) {
      $post_content->color              = $post_content->categories[0]->color;
    }
    $post_content->ebook_file           = get_field( 'material_ebook_file', $post->ID );
    $post_content->infographic_file      = get_field( 'material_infographic_file', $post->ID );
    return $post_content;
  }

  public function get_material_slider( $post_id ) {
    if ( have_rows( 'material_slider', $post_id ) ) {
      while ( have_rows( 'material_slider', $post_id ) ) {
        the_row();
        $slides[] = get_sub_field( 'slider_image' );
      }
      return $slides;
    }
    return false;
  }

}

new Controller_Materials( 'add_filters' );