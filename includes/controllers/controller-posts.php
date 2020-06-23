<?php
class Controller_Posts {

  public function __construct( $add_filters = false ) {
    if ( $add_filters ) {
      add_filter( 'get_posts_content', array( $this, 'get_posts_content' ) );
      add_filter( 'get_posts_categories', array( $this, 'get_posts_categories' ) );
      add_filter( 'get_posts_formats', array( $this, 'get_posts_formats' ) );
      add_filter( 'get_post_content', array( $this, 'get_post_content' ) );
      add_filter( 'get_post_categories', array( $this, 'get_post_categories' ) );
    }
  }

  public function get_posts_content( $args = array(), $raw_data = false ) {
    $defaults = array(
      'taxonomy'          => false,
      'term'              => false,
      'posts_per_page'    => 8,
      'post_status'       => 'publish',
      'post_type'         => 'post',
    );
    $args = wp_parse_args( $args, $defaults );

    if ( $args['taxonomy'] && $args['term'] ) {
      if ( 'category' == $args['taxonomy'] ) {
        $args['category_name'] = $args['term'];
      } elseif ( 'post_tag' == $args['taxonomy'] ) {
        $args['tag'] = $args['term'];
      } else {
        $args['tax_query'][] = array(
          'taxonomy'  => $args['taxonomy'],
          'field'     => 'slug',
          'terms'     => $args['term'],
        );
      }
    }
    if ( ! empty( $args['featured'] ) ) {
      $args['meta_query'][] = array(
        'key'       => ( $args['post_type'] ? $args['post_type'] : 'post' ) . '_featured',
        'value'     => '1',
        'type'      => 'NUMERIC',
      );
    }
    unset( $args['taxonomy'], $args['term'], $args['featured'] );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
      foreach ( $query->posts as $post ) {
        $post->found_posts = $query->found_posts;
        if ( $raw_data ) {
          $posts[] = $post;
        } else {
          $posts[] = $this->get_post_content( $post );
        }
      }
      return $posts;
    } else {
      return false;
    }
  }

  protected function get_posts_terms( $args ) {
    $defaults = array(
      'taxonomy'          => 'category',
      'number'            => 0,
    );
    $args = wp_parse_args( $args, $defaults );

    $terms = get_terms( $args );
    if ( $terms && ! is_wp_error( $terms ) ) {
      return $terms;
    }
    return false;
  }

  protected function get_categories_custom_fields( $terms, $limit = 0 ) {
    if ( $terms ) {
      $terms = 1 == $limit ? array( $terms ) : $terms;
      foreach ( $terms as $key => $term ) {
        $terms[ $key ]->subtitle  = get_field( 'category_subtitle', 'category_' . $term->term_id );
        $terms[ $key ]->color     = !empty(get_term_meta($term->term_id, 'color', true )) ? get_term_meta($term->term_id, 'color', true ) : '#b5bfc9';
        // $terms[ $key ]->color     = get_field( 'category_color', 'category_' . $term->term_id );
      }
      $terms = 1 == $limit ? $terms[0] : $terms;
    }
    return $terms;
  }

  public function get_posts_categories( $args = array() ) {
    $args['taxonomy'] = 'category';
    $terms = $this->get_posts_terms( $args );
    $terms = $this->get_categories_custom_fields( $terms );
    return $terms;
  }

  public function get_posts_formats( $args = array() ) {
    $args['taxonomy'] = 'content_format';
    return $this->get_posts_terms( $args );
  }

  public function get_post_better_thumbnail( $attach_id, $size, $post_id ){

    $attach = wp_get_attachment_metadata($attach_id);

    if(isset($attach['sizes'])){
      if(array_key_exists($size,$attach['sizes']) === TRUE){
        return wp_get_attachment_image_src(get_post_thumbnail_id($post_id),$size);
      }else{
        return wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large');
      }
    }else{
      return wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'large');
    }

  }

  protected function get_post_default_content( $post = false ) {
    if ( false == $post ) {
      global $post;
    }
    $post_content                       = new StdClass();
    $post_content->ID                   = $post->ID;
    $post_content->title                = $post->post_title;
    $post_content->permalink            = get_permalink( $post->ID );
    $post_content->date                 = get_the_date( '', $post->ID );
    $post_content->modified_date        = get_the_modified_date( 'Y-m-d H:i:s', $post->ID );
    $post_content->content              = apply_filters( 'the_content', $post->post_content );
    $post_content->thumbnail            = has_post_thumbnail( $post->ID ) ? wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),'medium') : false;
    $post_content->thumbnail_id         = get_post_thumbnail_id($post->ID);
    $post_content->thumbnail_small      = $this->get_post_better_thumbnail(get_post_thumbnail_id($post->ID),'ath-thumb-small',$post->ID);
    $post_content->thumbnail_medium     = $this->get_post_better_thumbnail(get_post_thumbnail_id($post->ID),'ath-thumb-medium',$post->ID);
    $post_content->thumbnail_large      = $this->get_post_better_thumbnail(get_post_thumbnail_id($post->ID),'ath-thumb-large',$post->ID);
    $post_content->thumbnail_mega       = $this->get_post_better_thumbnail(get_post_thumbnail_id($post->ID),'ath-thumb-mega',$post->ID);
    $post_content->thumbnail_square     = $this->get_post_better_thumbnail(get_post_thumbnail_id($post->ID),'ath-thumb-square',$post->ID);
    $post_content->thumbnail_type       = !empty($ath_options['layout_thumbnails']) ? $ath_options['layout_thumbnails'] : 'transparent';
    $post_content->author               = $this->get_author_data( $post->post_author );
    $post_content->author_avatar        = $this->get_author_data( $post->post_author, 'avatar' );
    $post_content->author_link          = get_author_posts_url($post->post_author);
    $post_content->found_posts          = $post->found_posts;
    return $post_content;
  }

  public function get_post_content( $post = false ) {
    if ( false == $post ) {
      global $post;
    }
    global $ath_options;

    $post_content                       = $this->get_post_default_content( $post );
    $post_content->categories           = $this->get_post_categories( $post->ID );
    $post_content->formats              = $this->get_post_terms( $post->ID, 'content_format' );
    $post_content->featured             = boolval( get_field( 'post_featured', $post->ID ) );
    $post_content->thumbnail_type       = !empty($ath_options['layout_thumbnails']) ? $ath_options['layout_thumbnails'] : 'transparent';
    $post_content->color                = $ath_options['color_primary'];
    if ( $post_content->categories && ! is_wp_error( $post_content->categories ) ) {
      $post_content->color              = $post_content->categories[0]->color;
    }
    return $post_content;
  }

  protected function get_post_terms( $post_id, $taxonomy, $limit = 0 ) {
    $terms = get_the_terms( $post_id, $taxonomy );
    if ( $terms && ! is_wp_error( $terms ) ) {
      if ( 1 == $limit ) {
        return $terms[0];
      } elseif ( ! empty( $limit ) && 0 < $limit ) {
        return array_slice( $terms, 0, $limit );
      } else {
        return $terms;
      }
    }
    return false;
  }

  public function get_post_categories( $post_id, $limit = 0 ) {
    $terms = $this->get_post_terms( $post_id, 'category', $limit );
    $terms = $this->get_categories_custom_fields( $terms, $limit );
    return $terms;
  }

  protected function get_author_data( $user_id, $field = 'display_name' ) {
    $user = get_user_by( 'id', $user_id );
    if ( $user && ! is_wp_error( $user ) ) {
      if ( 'avatar' == $field ) {
        $data = ath_get_gravatar( $user->user_email, 128 );
      } else {
        $data = $user->$field;
      }
      return $data;
    }
    return false;
  }

}

new Controller_Posts( 'add_filters' );