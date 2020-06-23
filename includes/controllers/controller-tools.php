<?php
class Controller_Tools extends Controller_Posts {

  public function __construct( $add_filters = false ) {
    if ( $add_filters ) {
      add_filter( 'get_tools_content', array( $this, 'get_tools_content' ) );
      add_filter( 'get_tools_categories', array( $this, 'get_tools_categories' ) );
      add_filter( 'get_tool_content', array( $this, 'get_tool_content' ) );
    }
  }

  public function get_tools_content( $args = array(), $raw_data = false ) {
    $defaults = array(
      'post_type'         => 'tool',
      'post_status'       => 'publish',
      // 'orderby'           => 'rand',
    );
    $args  = wp_parse_args( $args, $defaults );
    $posts = parent::get_posts_content( $args, true );

    if ( $posts && false == $raw_data ) {
      foreach ( $posts as $post ) {
        $_posts[] = $this->get_tool_content( $post );
      }
      $posts = $_posts;
    }
    return $posts;
  }

  public function get_tools_categories( $args = array() ) {
    $defaults = array(
      'meta_query'      => array(
        'relation'        => 'OR',
        array(
          'key'           => 'tool_category_order',
          'compare'       => 'NOT EXISTS',
        ),
        array(
          'key'           => 'tool_category_order',
          'value'         => 0,
          'compare'       => '>=',
          'type'          => 'NUMERIC',
        ),
      ),
      'orderby'         => 'meta_value',
    );
    $args = wp_parse_args( $args, $defaults );
    $args['taxonomy'] = 'tool_category';
    return parent::get_posts_terms( $args );
  }

  public function get_tool_content( $post = false ) {
    if ( false == $post ) {
      global $post;
    }
    $post_content                       = parent::get_post_default_content( $post );
    $post_content->categories           = parent::get_post_terms( $post->ID, 'tool_category' );
    // Delete this line after all thumbnails become "featured image" instead of ACF.
    // $post_content->thumbnail            = $post_content->thumbnail ? $post_content->thumbnail : get_field( 'tool_thumb', $post->ID );
    $post_content->color                = get_field( 'tool_color', $post->ID );
    $post_content->link                 = get_field( 'tool_link', $post->ID );
    $post_content->pretty_url           = get_field( 'tool_pretty_url', $post->ID );
    $post_content->description          = get_field( 'tool_description', $post->ID );
    $post_content->coupon               = get_field( 'tool_coupon', $post->ID );
    $post_content->coupon_text          = get_field( 'tool_coupon_text', $post->ID );
    $post_content->coupon_tiny          = get_field( 'tool_coupon_tiny', $post->ID );
    $post_content->featured             = get_field( 'post_featured', $post->ID );
    return $post_content;
  }

}

new Controller_Tools( 'add_filters' );