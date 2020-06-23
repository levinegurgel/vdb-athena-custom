<?php

class Controller_Banners extends Controller_Posts {

  public function __construct( $add_hooks = false ) {
    if ( $add_hooks ) {
      add_filter( 'get_banners_content',  array( $this, 'get_banners_content' ), 10, 2 );
      add_filter( 'get_banner_content',   array( $this, 'get_banner_content' ) );
      add_filter( 'get_banner_featured',  array( $this, 'get_banner_featured' ) );
    }
  }

  public function get_banners_content( $args = array(), $raw_data = false ) {
    $defaults = array(
      'post_type'         => 'banner',
      'post_status'       => 'publish',
    );
    $args  = wp_parse_args( $args, $defaults );
    $posts = parent::get_posts_content( $args, true );

    if ( $posts && false == $raw_data ) {
      foreach ( $posts as $post ) {
        $_posts[] = $this->get_banner_content( $post );
      }
      $posts = $_posts;
    }
    return $posts;
  }

  public function get_banner_content( $post = false ) {
    if ( false == $post ) {
      global $post;
    }
    $post_content                       = parent::get_post_default_content( $post );
    $post_content->categories           = parent::get_post_categories( $post->ID );
    $post_content->subtitle             = get_field( 'banner_subtitle', $post->ID );
    $post_content->cta_link             = get_field( 'banner_cta_link', $post->ID );
    $post_content->cta_text             = get_field( 'banner_cta_text', $post->ID );
    $post_content->color1               = get_field( 'banner_color1', $post->ID );
    $post_content->color2               = get_field( 'banner_color2', $post->ID );
    $post_content->image                = get_field( 'banner_image', $post->ID );
    $post_content->image_bg             = get_field( 'banner_image_bg', $post->ID );
    $post_content->end                  = get_field( 'banner_end', $post->ID );
    $post_content->active               = $post_content->end ? ( time() <= strtotime( $post_content->end ) ) : true;
    return $post_content;
  }

  public function get_banner_featured() {
    global $ath_banner_featured;

    if ( ! empty( $ath_banner_featured ) || false === $ath_banner_featured ) {
      return $ath_banner_featured;
    }

    $args = array(
      'post_type'       => 'banner',
      'posts_per_page'  => 1,
      'meta_query'      => array(
        array(
          'key'       => 'banner_featured',
          'value'     => '1',
          'type'      => 'NUMERIC',
        ),
        array(
          'relation'      => 'OR',
          array(
            'key'         => 'banner_end',
            'compare'     => 'NOT EXISTS',
          ),
          array(
            array(
              'key'         => 'banner_end',
              'compare'     => 'EXISTS',
            ),
            array(
              'key'         => 'banner_end',
              'value'       => '',
            ),
          ),
          array(
            array(
              'key'         => 'banner_end',
              'compare'     => 'EXISTS',
            ),
            array(
              'key'         => 'banner_end',
              'value'       => date( 'Y-m-d H:i:s' ),
              'compare'     => '>=',
              'type'        => 'DATETIME',
            ),
          ),
        ),
      ),
    );
    $posts = parent::get_posts_content( $args, true );

    $ath_banner_featured = $posts ? $posts[0] : false;

    return $ath_banner_featured;
  }

}

new Controller_Banners( 'add_hooks' );