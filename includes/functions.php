<?php

global $pagenow;
define('ATH_LAZY', get_template_directory_uri().'/assets/images/lazy.png');


/*
 *
 * INCLUDES
 *
 */

require __DIR__ . '/vendor/composer/vendor/autoload.php';
include_once('colors.php');
include_once('install/empty.php');

if(!class_exists('MailChimp')){
  require_once('vendor/mailchimp/class.php');
}

if(!class_exists('ActiveCampaign')){
  require_once('vendor/activecampaign/includes/ActiveCampaign.class.php');
}

if(!class_exists('ConvertKit_API')){
  require_once('vendor/convertkit/src/ConvertKitAPI.php');
}

if(!class_exists('ML_Subscribers')){
  include_once('vendor/mailerlite/ML_Subscribers.php');
}

if(!class_exists('GetResponse')){
  include_once('vendor/getresponse/class.php');
}

if(!class_exists('RDStationAPI')){
  include_once('vendor/rdstation/rdstation.php');
}



/*
 *
 * SUPORTES
 *
 */

add_theme_support( 'title-tag' );
add_theme_support( 'align-wide' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support( 'html5', array(
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption',
) );



/*
 *
 * CURL
 *
 */

function curl($url, $post = "", $headers = "")
 {
   $curl = curl_init();
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    curl_setopt($curl, CURLOPT_URL, $url);
    if ($post != "") {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    else {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    }
    if ($headers != "") {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    else {
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
    }
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    $contents = curl_exec($curl);
    curl_close($curl);
    return $contents;
 }



/*
 *
 * THEME
 *
 */

function ath_theme($info){

  $theme  = wp_get_theme();
  $folder = explode('/',get_template_directory_uri());
  $infos  = array(
    "name"=> $theme->get('Name'),
    "folder"=> end($folder),
    "version"=> $theme->get('Version')
  );

  if(array_key_exists($info,$infos)){
    return $infos[$info];
  }else{
    return 0;
  }

}



/*
 *
 * BLOCKS
 *
 */

function register_acf_block_types() {

  include_once('blocks.php');

}
add_action('acf/init', 'register_acf_block_types');

function ath_block_category( $categories, $post ) {
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'athblocks',
        'title' => __( 'Athena', 'ath-options' ),
      ),
    )
  );
}
add_filter( 'block_categories', 'ath_block_category', 10, 2);


/*
 *
 * MENU
 *
 */

register_nav_menus(
  array(
    'topo' => __( 'Menu do topo' ),
    // 'rodape' => __( 'Menu do rodapé' )
  )
);



/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */

function ath_theme_updater() {
  require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'ath_theme_updater' );


/**
* INCLUDES
*/

include_once('forms.php');
include_once('plugins/acf-sync/acf-sync.php');
define('ACF_FIELDS_VERSION', '1.0.0');


/**
 * CSS E JS
 */

function ath_scripts() {

  $dir_path = get_stylesheet_directory();
  $dir_uri  = get_stylesheet_directory_uri();

  // Styles

  wp_enqueue_style( 'ath-icon',$dir_uri . '/assets/ui/semantic.min.css',array(), filemtime( $dir_path . '/assets/ui/semantic.min.css' ) );
  wp_enqueue_style( 'ath-vendor',$dir_uri . '/assets/css/vendor.css',array(), filemtime( $dir_path . '/assets/css/vendor.css' ) );
  wp_enqueue_style( 'ath-theme',$dir_uri . '/assets/css/theme.css',array(), filemtime( $dir_path . '/assets/css/theme.css' ) );

  // Scripts

  wp_enqueue_script('jquery');
  wp_enqueue_script( 'ath-semantic',$dir_uri . '/assets/ui/semantic.min.js',array(), filemtime( $dir_path . '/assets/ui/semantic.min.js' ), true );
  wp_enqueue_script( 'ath-vendor',$dir_uri . '/assets/js/vendor.js',array(), filemtime( $dir_path . '/assets/js/vendor.js' ), true );
  wp_enqueue_script( 'ath-theme',$dir_uri . '/assets/js/theme.js',array( 'jquery' ), filemtime( $dir_path . '/assets/js/theme.js' ), true );

  // Carrosel

  if(is_front_page() or is_home()){
    wp_enqueue_script( 'ath-owl', $dir_uri . '/assets/js/vendor/owl.js', array(), filemtime( $dir_path . '/assets/js/vendor/owl.js' ), true );
  }

  // Ajax

  ath_ajax_register( 'ath-theme' );


}
add_action( 'wp_enqueue_scripts', 'ath_scripts' );


/**
 * STYLE VARIABLES
 */

function ath_appearance() {
  global $ath_options;
  include_once('options/variables.php');
  wp_register_style('ath-pallete', get_template_directory_uri() . '/assets/css/pallete.css');
  wp_enqueue_style('ath-pallete');
}


function ath_get_current_url(){
  $current_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  return $current_link;
}


/**
 * ADMIN STYLES
 */
function ath_admin_styles() {

  wp_register_style('ath-admin-css', get_template_directory_uri() . '/assets/css/admin.css');
  wp_enqueue_style('ath-admin-css');

  wp_register_style('ath-mp-css', get_template_directory_uri() . '/assets/css/vendor/mp.css');
  wp_enqueue_style('ath-mp-css');

  wp_register_style('ath-ui-transition', get_template_directory_uri() . '/assets/ui/transition.min.css');
  wp_enqueue_style('ath-ui-transition');

  wp_register_style('ath-ui-dimmer', get_template_directory_uri() . '/assets/ui/dimmer.min.css');
  wp_enqueue_style('ath-ui-dimmer');

  wp_register_style('ath-ui-modal', get_template_directory_uri() . '/assets/ui/modal.min.css');
  wp_enqueue_style('ath-ui-modal');

  wp_register_style('ath-ui-progress', get_template_directory_uri() . '/assets/ui/progress.min.css');
  wp_enqueue_style('ath-ui-progress');

  wp_register_style('ath-ui-button', get_template_directory_uri() . '/assets/ui/button.min.css');
  wp_enqueue_style('ath-ui-button');

  wp_register_style('ath-ui-icon', get_template_directory_uri() . '/assets/ui/icon.min.css');
  wp_enqueue_style('ath-ui-icon');

  wp_register_style('ath-animate', get_template_directory_uri() . '/assets/css/vendor/animate.css');
  wp_enqueue_style('ath-animate');

}
add_action('admin_print_styles', 'ath_admin_styles');




/**
 * ADMIN SCRIPTS
 */
function ath_admin_scripts() {

  wp_register_script('ath-admin-js', get_template_directory_uri() . '/assets/js/admin.js');
  wp_enqueue_script('ath-admin-js');

  wp_register_script('ath-ui-transition-js', get_template_directory_uri() . '/assets/ui/transition.min.js');
  wp_enqueue_script('ath-ui-transition-js');

  wp_register_script('ath-ui-dimmer-js', get_template_directory_uri() . '/assets/ui/dimmer.min.js');
  wp_enqueue_script('ath-ui-dimmer-js');

  wp_register_script('ath-ui-modal-js', get_template_directory_uri() . '/assets/ui/modal.min.js');
  wp_enqueue_script('ath-ui-modal-js');

  wp_register_script('ath-ui-progress-js', get_template_directory_uri() . '/assets/ui/progress.min.js');
  wp_enqueue_script('ath-ui-progress-js');

  wp_enqueue_script( 'wp-color-picker' );

  ath_ajax_register('ath-admin-js');

}

add_action('admin_enqueue_scripts', 'ath_admin_scripts');



/**
 * WIDGETS AREA
 */
function ath_widgets_init() {
  // for ( $i = 1; $i <= 1; $i++ ) {
    register_sidebar( array(
      'name'          => 'Rodapé',
      'id'            => 'footer',
      'description'   => esc_html__( 'Insira algum widget aqui.' ),
      'before_widget' => '<div class="ath-list vertical border-bottom">',
      'after_widget'  => '</div>',
      'before_title'  => '<h6>',
      'after_title'   => '</h6>',
    ) );
  // }
}
add_action( 'widgets_init', 'ath_widgets_init' );



/**
 * Filters the HTML list content for navigation menus.
 */
function ath_nav_menu_items( $items ) {
  return str_replace( array( '<li ', '</li>' ), array( '<span ', '</span>' ), $items );
}
add_filter( 'wp_nav_menu_items', 'ath_nav_menu_items' );



/**
 * Add banners custom column title in the admin.
 */
function ath_banner_columns( $columns ) {
  /*$columns = array(
  'cb'        => '<input type="checkbox" />',
  'title'     => 'Title',
  'author'    => 'Author',
  'date'      => 'Date',
  );*/
  foreach ( $columns as $key => $value ) {
    $_columns[ $key ] = $value;
    if ( 'cb' == $key ) {
      $_columns['banner_id'] = 'ID';
    } elseif ( 'date' == $key ) {
      $_columns['banner_end'] = 'Desativação';
    }
  }
  return $_columns;
}
add_filter( 'manage_banner_posts_columns', 'ath_banner_columns' );




/**
 * Add banners custom column data in the admin.
 */
function ath_banner_custom_column( $column ) {
  global $post;
  if ( 'banner_id' == $column ) {
    echo $post->ID;
  } elseif ( 'banner_end' == $column ) {
    if ( get_field( 'banner_end' ) ) {
      echo date( 'd/m/Y H:i:s', strtotime( get_field( 'banner_end' ) ) );
    } else {
      echo '&mdash;';
    }
  }
}
add_action( 'manage_banner_posts_custom_column', 'ath_banner_custom_column' );




/**
 * Add banners sortable columns.
 */
/*function ath_banner_sortable_columns( $columns ) {
  $columns['banner_end'] = 'banner_end';
  return $columns;
}
add_filter( 'manage_edit-banner_sortable_columns', 'ath_banner_sortable_columns' );*/




/**
 * Add posts custom column title in the admin.
 */
function ath_post_columns( $columns ) {
  $post_types = array( 'post', 'tool', 'banner' );
  $post_type  = get_post_type();

  if ( in_array( $post_type, $post_types ) ) {
    $columns["{$post_type}_featured"] = 'Destaque';
  }
  return $columns;
}
add_filter( 'manage_posts_columns', 'ath_post_columns' );
// add_filter( 'manage_tool_columns', 'ath_post_columns' );
// add_filter( 'manage_banner_columns', 'ath_post_columns' );




/**
 * Add posts custom column data in the admin.
 */
function ath_post_custom_column( $column ) {
  $post_types = array( 'post', 'tool', 'banner' );
  $post_type  = get_post_type();
  // global $post;
  if ( in_array( $post_type, $post_types ) && "{$post_type}_featured" == $column ) {
    if ( get_field( "{$post_type}_featured" ) ) {
      echo '<span class="dashicons dashicons-yes"></span>';
    } else {
      echo '&mdash;';
    }
  }
}
add_action( 'manage_posts_custom_column', 'ath_post_custom_column' );
// add_action( 'manage_tool_custom_column', 'ath_post_custom_column' );
// add_action( 'manage_banner_custom_column', 'ath_post_custom_column' );




/**
 * Add posts sortable columns.
 */
/*function ath_post_sortable_columns( $columns ) {
  $columns['post_featured'] = 'post_featured';
  return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'ath_post_sortable_columns' );*/




/**
 * Add custom column style in the admin.
 */
function ath_custom_admin_head() {
  echo '<style>
    .fixed .column-banner_id, .fixed .column-banner_end, .fixed .column-post_featured, .fixed .column-tool_featured, .fixed .column-banner_featured { width: 10%; }
    .fixed .column-post_featured .dashicons-yes, .fixed .column-tool_featured .dashicons-yes, .fixed .column-banner_featured .dashicons-yes { color: green; font-size: 2em; }
    </style>';
}
add_action( 'admin_head', 'ath_custom_admin_head' );




/**
 * Get slider content.
 */
function ath_get_slider_content() {
  global $post;
  if ( have_rows( 'slider' ) ) {
    $post->banners = array();
    $i = 0;
    while ( have_rows( 'slider' ) ) {
      the_row();
      $banner                 = new StdClass();
      $banner->start          = get_sub_field( 'banner_start' );
      $banner->end            = get_sub_field( 'banner_end' );
      $banner->active         = false == ath_check_date_is_active( $banner ) ? false : get_sub_field( 'banner_active' );
      $banner->title          = get_sub_field( 'banner_title' );
      $banner->subtitle       = get_sub_field( 'banner_subtitle' );
      $banner->description    = get_sub_field( 'banner_description' );
      $banner->cta_link       = get_sub_field( 'banner_cta_link' );
      $banner->cta_text       = get_sub_field( 'banner_cta_text' );
      $banner->color1         = get_sub_field( 'banner_color1' );
      $banner->color2         = get_sub_field( 'banner_color2' );
      $banner->image          = get_sub_field( 'banner_image' );
      $banner->image_bg       = get_sub_field( 'banner_image_bg' );
      $post->banners[ $i++ ]  = $banner;
    }
    return $post->banners;
  }
}




/**
 * Get featured header content.
 */
function ath_get_featured_header_content() {
  global $post;
  $banner                 = new StdClass();
  $banner->start          = get_field( 'header_start' );
  $banner->end            = get_field( 'header_end' );
  $banner->active         = false == ath_check_date_is_active( $banner ) ? false : get_field( 'header_active' );
  $banner->title          = get_field( 'header_title' );
  $banner->subtitle       = get_field( 'header_subtitle' );
  $banner->description    = get_field( 'header_description' );
  $banner->cta_link       = get_field( 'header_cta_link' );
  $banner->cta_text       = get_field( 'header_cta_text' );
  $banner->color1         = get_field( 'header_color1' );
  $banner->color2         = get_field( 'header_color2' );
  $banner->image          = get_field( 'header_image' );
  $banner->image_bg       = get_field( 'header_image_bg' );
  $post->banner           = $banner;
  return $post->banner;
}




/**
 * Check if date is active.
 */
function ath_check_date_is_active( $item ) {
  if ( ! empty( $item->start ) ) {
    $start = strtotime( $item->start );
    if ( time() < $start ) {
      return false;
    }
  }
  if ( ! empty( $item->end ) ) {
    $end = strtotime( $item->end );
    if ( time() > $end ) {
      return false;
    }
  }
  return true;
}




/**
 * Replace every "hr" tag by a custom divider in the content.
 */
function ath_content_divider( $content = '' ) {
  return str_replace( array( '<hr>', '<hr/>', '<hr />' ), '<div class="ath-divider diamonds"></div>', $content );
}
add_filter( 'the_content', 'ath_content_divider' );




/**
 * Trim text to a certain number of characters.
 */
function ath_trim_text( $text, $num_chars = 100, $more = '&hellip;', $break_words = false ) {
  $text = wp_trim_words( $text, $num_chars, '' );
  if ( strlen( $text ) > $num_chars ) {
    $text = substr( $text, 0, $num_chars + 1 );
    $last_space = strrpos( $text, ' ' );
    if ( $break_words || false === $last_space ) {
      $text = substr( $text, 0, $num_chars );
    } else {
      $text = substr( $text, 0, $last_space );
    }
    $text .= $more;
  }
  return $text;
}




/**
 * Clean archive titles from WP labels
 */
function ath_archive_title( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = get_the_author();
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
}
add_filter( 'get_the_archive_title', 'ath_archive_title' );




/**
 * Organize the cards, according to their featured custom post meta value.
 */
function ath_organize_cards( $posts, $limit = 16, $columns = 4 ) {
  $limit   = min( $limit, count( $posts ) );
  for ( $i = 0, $j = 0; $j < $limit; $i++ ) {
    if ( $posts[ $i ]->featured ) {
      $f[ $j ] = $posts[ $i ];
      $j += 2;
    } else {
      $d[ $j ] = $posts[ $i ];
      $j++;
    }
  }
  for ( $i = 0, $l = 0, $c = 0; $i <= $j; $i++ ) {
    if ( 0 == $c % 2 ) {

      if ( @$f[ $i ] ) {
        $list[ $l ][] = $f[ $i ];
        unset( $f[ $i ] );
        $c += 2;

      } elseif ( @$f[ $i + 1 ] ) {
        $list[ $l ][] = $f[ $i + 1 ];
        unset( $f[ $i + 1 ] );
        $c += 2;
        $i--;

      } elseif ( @$d[ $i ] ) {
        $list[ $l ][] = $d[ $i ];
        unset( $d[ $i ] );
        $c++;
      }

    } elseif ( @$d[ $i ] ) {
      $list[ $l ][] = $d[ $i ];
      unset( $d[ $i ] );
      $c++;

    } elseif ( @$d[ $i + 1 ] ) {
      $list[ $l ][] = $d[ $i + 1 ];
      unset( $d[ $i + 1 ] );
      $c++;
      $i--;

    } elseif ( empty( $d ) ) {
      $c++;
    }

    if ( $c >= $columns ) {
      $c = 0;
      $l++;
    }
  }
  return $list;
}




/**
 * Add extra fields to optin forms
 */
function ath_get_extra_fields( $post = false, $type = 'general' ) {
  if ( false == $post ) {
    global $post;
  }

  $output = apply_filters( 'ath_get_extra_fields', '', $post, $type );
  if ( '' != $output ) {
    return $output;
  }

  ob_start(); ?>

  <input type="hidden" name="list" value="<?php echo esc_attr( get_field( 'mc_main_list', 'option' ) ); ?>">

  <?php if ( 'general' == $type ) : ?>

    <input type="hidden" name="fields[SIGNUP]" value="Form">
    <!-- <input type="hidden" name="fields[POSITION]" value="home-header"> -->
    <input type="hidden" name="fields[TIPO]" value="Espontâneo">
    <!-- <input type="hidden" name="fields[ONBOARDING]" value="Fase 1"> -->
    <!-- <input type="hidden" name="fields[OB_STATUS]" value="In Progress"> -->

  <?php elseif ( 'material' == $type ) : ?>

    <!-- Página de Materiais -->
    <input type="hidden" name="groups[]" value="88f16ece6e">
    <?php
    $groups = array(
      'ebook'        => '0f32799e6b',
      'infografico'  => 'c5490f6cb2',
    );
    $type = $post->banner->types[0]->slug;
    // if ( $group = $groups[ $type ] ) :

    ?>
    <!-- Conteúdos de Interesse -->
    <input type="hidden" name="groups[<?php echo $type; ?>]" value="<?php echo $group; ?>">
    <?php endif; ?>
    <input type="hidden" name="fields[URL]" value="<?php the_permalink( $post ); ?>">
    <input type="hidden" name="fields[SIGNUP]" value="LPs (Materiais Educativos)">
    <input type="hidden" name="fields[TIPO]" value="Forçado">
    <input type="hidden" name="fields[ONBOARDING]" value="Fase 1">
    <input type="hidden" name="fields[OB_STATUS]" value="In Progress">

  <?php //endif;

  $output = ob_get_clean();
  return $output;
}




/**
 * Get gravatar from email
 */
function ath_get_gravatar( $email, $size = 128, $default = 'mm' ) {
  // Docs here: http://pt.gravatar.com/site/implement/images/
  return $url = 'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $email ) ) ) . '?d=' . $default . '&s=' . $size;
}




/**
 * Get a page by page template
 */
function ath_get_page_by_page_template( $template = 'index.php', $return = 'link' ) {
  $page = get_posts(array(
    'post_type'     => 'page',
    'post_per_page' => 1,
    'meta_query'    => array(
      array(
        'key'     => '_wp_page_template',
        'value'   => $template,
      )
    )
  ));
  if ( $page && ! is_wp_error( $page ) ) {
    if ( 'link' == $return ) {
      return get_permalink( $page[0]->ID );
    } elseif ( 'object' == $return ) {
      return $page[0];
    } else {
      return $page[0]->ID;
    }
  }
  return false;
}




/**
 * Get home
 */
function ath_get_home() {
  return ath_get_page_by_page_template( 'index.php', 'object' );
}




/**
 * Get blog / posts archive link
 */
function ath_get_blog_link() {
  return ath_get_page_by_page_template( 'home.php', 'link' );
}




/**
 * Set custom args for widget nav menu
 */
function ath_widget_nav_menu_args( $args ) {
  $args['container']    = false;
  $args['fallback_cb']  = false;
  $args['items_wrap']   = '<nav>%3$s</nav>';
  $args['depth']        = 1;
  // $args['walker']          = new ath_Walker_Nav_Menu;
  return $args;
}
add_filter( 'widget_nav_menu_args', 'ath_widget_nav_menu_args' );




/**
 * Check if a post is updated
 */
function ath_updated_post( $date = null ) {
  if ( null == $date ) {
    global $post;
    $date = get_the_modified_date( 'Y-m-d H:i:s', $post->ID );
  }
  return strtotime( $date ) >= strtotime( '2017-07-30' );
}




/**
 * Show pagination links
 */
function ath_pagination_links( $cards, $posts_per_page = 8, $number_of_pages = 3 ) {
  if ( $cards && $cards[0]->found_posts > $posts_per_page ) {
    $pages = min( $number_of_pages, floor( $cards[0]->found_posts / $posts_per_page ) );
    if ( $pages > 1 ) {
      for ( $i = 1; $i <= $pages; $i++ ) {
        echo '<a href="#" class="pagination-link' . ( 1 == $i ? ' active' : '' ) . '"><span style="">' . $i . '</span></a> ';
      }
    }
  }
}




/**
 * Turn YouTube videos responsive
 */
function ath_responsive_videos( $content ) {
  return preg_replace( '/<iframe[^>]+src="[^"]+youtu[^<]+<\/iframe>/', '<div class="responsive-video">$0</div>', $content );
}
add_filter( 'the_content', 'ath_responsive_videos' );




/**
 *  Ajax cards pagination
 */
function ath_reference_tag() {

    echo '<meta id="reference" data-admin-ajax="'.admin_url('admin-ajax.php').'" data-url="'.get_bloginfo('url').'" />';

}
add_action( 'wp_enqueue_scripts', 'ath_reference_tag' );





/**
 *  ACF
 */

add_filter('acf/settings/path', 'ath_acf_settings_path');
function ath_acf_settings_path( $path ) {

    $path = get_stylesheet_directory() . '/includes/plugins/acf/';
    return $path;

}

add_filter('acf/settings/dir', 'ath_acf_settings_dir');
function ath_acf_settings_dir( $dir ) {

    $dir = get_stylesheet_directory_uri() . '/includes/plugins/acf/';
    return $dir;

}
// add_filter('acf/settings/show_admin', '__return_false');
include_once( get_stylesheet_directory() . '/includes/plugins/acf/acf.php' );


add_filter('acf/settings/save_json', 'ath_acf_json_save_point');
function ath_acf_json_save_point( $path ) {

    $path = get_stylesheet_directory() . '/includes/plugins/acf-json';
    return $path;

}


add_filter('acf/settings/load_json', 'ath_acf_json_load_point');
function ath_acf_json_load_point( $paths ) {

    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/includes/plugins/acf-json';
    return $paths;

}



/**
 * ACF hide Athena groups
 */

function ath_acf_hide_groups( $query ) {

   if( is_admin() && $query->is_main_query() && !empty( $_GET['post_type'] ) && $_GET['post_type'] == 'acf-field-group' ) {

      $ath_groups = array(
        'group_5a44e7628c37c',
        'group_5bd9e25404865',
        'group_5bdc8fa82370d',
        'group_5bdc81860c58b',
        'group_5be32cfd89a30',
        'group_5bec3293c7d5d',
        'group_59f9c984ecb85',
        'group_59fc64c5ed764',
        'group_5877acd400d78',
        'group_5961acc9847f1',
        'group_59768eeb8c0c7',
        'group_595103f5ae1a1',
        'group_5bffce50ad298',
        'group_5c2f5ae0f0192',
        'group_5d153c3fa9dc2', //Bloco - Tópicos
        'group_5d160e417ed06', //Bloco - Captura
        'group_5db87114ea736', //Bloco - Materiais
        'group_5d1df5524f5ad', //Page Buiders
        'group_5d30861529cbc', //Vitrine de Links
        'group_5d37a51d78a0c', //
        'group_58ab1c517422a', //
        'group_5e358af61b4c9', //Scripts
      );
      if(count($ath_groups) > 0){
        $acf_ids = get_posts(array(
          'post_name__in' => $ath_groups,
          'nopaging' => true,
          'post_type' => 'acf-field-group',
          'fields' => 'ids',
        ));
        $query->set( 'post__not_in', $acf_ids );
      }

   }

}
add_action( 'pre_get_posts', 'ath_acf_hide_groups' );



function ath_acf_display_control(){
  if(!is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) && !is_plugin_active( 'advanced-custom-fields/acf.php' )){
    echo '<style>#toplevel_page_edit-post_type-acf-field-group{display:none !important;}</style>';
  }
}
add_action('admin_print_styles', 'ath_acf_display_control');



/**
 * Disable Gutenberg by posttype
 */

function ath_disable_gutenberg_per_ptt($is_enabled, $post_type) {

  if ($post_type === 'banner') return false;
  if ($post_type === 'material') return false;
  return $is_enabled;

}
add_filter('use_block_editor_for_post_type', 'ath_disable_gutenberg_per_ptt', 10, 2);



/**
 * Disable Gutenberg by template
 *
 */

function ath_disable_editor( $id = false ) {
  $excluded_templates = array(
    'initial.php',
    'contact.php'
  );
  $excluded_ids = array(
    // get_option( 'page_on_front' )
  );
  if( empty( $id ) )
    return false;
  $id = intval( $id );
  $template = get_page_template_slug( $id );
  return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

function ath_disable_gutenberg_per_template( $can_edit, $post_type ) {
  if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
    return $can_edit;
  if( ath_disable_editor( $_GET['post'] ) )
    $can_edit = false;
  return $can_edit;
}
add_filter( 'gutenberg_can_edit_post_type', 'ath_disable_gutenberg_per_template', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ath_disable_gutenberg_per_template', 10, 2 );



/**
 * Disable Classic Editor by template
 *
 */

function ath_disable_classic_editor() {
  $screen = get_current_screen();
  if( 'page' !== $screen->id || ! isset( $_GET['post']) )
    return;
  if( ath_disable_editor( $_GET['post'] ) ) {
    remove_post_type_support( 'page', 'editor' );
  }
}
add_action( 'admin_head', 'ath_disable_classic_editor' );



/**
 * Category Colors
 */

function ath_term_colors() {

  $file = __FILE__;
  include dirname( $file ) . '/vendor/term-meta.php';
  include dirname( $file ) . '/vendor/term-colors.php';
  new WP_Term_Colors( $file );

}
add_action('init', 'ath_term_colors', 99);



/**
 * Singles
 */

function ath_on_singles(){

  if(is_singular('material')){

    $single = apply_filters( 'get_material_content', false );

    // Ebooks Landing

    if($single->types[0]->slug == 'ebooks' or $single->types[0]->slug == 'infograficos'){
      echo '<style>';
      echo 'body{background:'. $single->color .' !important;}';
      echo '#ath-header.jumbo.primary{background-color:'. $single->color .' !important;}';
      echo '#ath-header.jumbo.primary{background-image: none !important;}';
      // echo '#ath-header.land-ebook{background: transparent !important; height:100%;}';
      // echo '@media only screen and (min-width : 768px){';
      // echo '#ath-header.land-ebook .wrapper-mobile+.row{position:absolute;top:50%;transform:translateY(-50%);}';
      // echo '}';
      // if(!is_tablet() and !is_phone()):
      // echo '#ath-header.land-ebook .wrapper-mobile+.row{min-width:1166px;}';
      // else:
      // echo '#ath-header.land-ebook .wrapper-mobile+.row{min-width:98%;}';
      // endif;
      echo '</style>';
    }
  }

}
add_action('wp_head','ath_on_singles');



/**
 * Idiomas
 */

load_theme_textdomain( 'ath-lang', get_template_directory() . '/language' );



/**
 * Onboard
 */

function ath_onboard(){
  include_once('install/onboard.php');
}
add_action( 'admin_footer', 'ath_onboard' );



/**
 * Admin Tag
 */

function ath_admin_tag_reference(){

    $user    = wp_get_current_user();
    $user_id = get_current_user_id();
    echo '<span id="ath-ref" data-user-role="'. $user->roles[0] .'" data-url="'. get_bloginfo('url') .'"></span>';

}

add_action('admin_head','ath_admin_tag_reference');



/**
 * Ajax Register
 */

function ath_nonce_key(){
  return 'ath-ajax-superdupermegapower-nonce';
}

function ath_verify_nonce( $nonce = false ) {
  return wp_verify_nonce( $nonce, ath_nonce_key() );
}

function ath_ajax_register($slug){
  wp_localize_script( $slug, 'ATH_Ajax', array(
    'url'    => str_replace( [ 'https:', 'http:' ], '', admin_url( 'admin-ajax.php' ) ),
    'nonce'  => wp_create_nonce( ath_nonce_key() ),
  ));
}



/**
 * SVG Mime Type
 */

function ath_theme_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'ath_theme_mime_types');



/**
 * Login
 */

function ath_theme_scripts_login() {

  global $ath_options;

  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() .'/assets/css/vendor/animate.css" />';
  echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() .'/assets/css/admin.css" />';
  echo '<style>.login h1 a{background-image:url("'. $ath_options['brand']['url'] .'") !important;}</style>';
  remove_action('login_head', 'wp_shake_js', 12);

}
add_action( 'login_head', 'ath_theme_scripts_login');

function ath_login_logo_url() {
  return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'ath_login_logo_url' );

function ath_login_logo_url_title() {
  return get_bloginfo('name');
}

add_filter( 'login_headertext', 'ath_login_logo_url_title' );

function ath_nav_top_fixed_options(){

   $options = '<span class="btn-search">
                  <a href="#">
                    <span class="btn-search">
                      <i class="icon search hidden-xs"></i>
                      <span class="visible-xs">Pesquisar</span>
                    </span>
                  </a>
                </span>';

    return $options;
}



/**
 * No Thumbnail
 */

 function ath_no_thumb($model='',$transparent=false){
   return get_template_directory_uri().'/assets/images/thumb'. ($model != '' ? '-'.$model : '') .'.'. ($transparent == true ? 'png':'jpg');
 }



 /**
 * Comments Form
 */

function ath_comments_form_remove_field($fields){
  if(isset($fields['url']))
  unset($fields['url']);
  return $fields;
}
add_filter('comment_form_default_fields', 'ath_comments_form_remove_field');



 /**
 * Usuário - Campos personalizados
 */

function ath_user_fields($contact_methods){
  $contact_methods['whatsapp_profile'] = 'Whatsapp';
  $contact_methods['instagram_profile'] = 'Instagram';
  $contact_methods['facebook_profile'] = 'Facebook';
  $contact_methods['linkedin_profile'] = 'Linkedin';
  $contact_methods['twitter_profile'] = 'Twitter';
  $contact_methods['youtube_profile'] = 'Youtube';
  $contact_methods['pinterest_profile'] = 'Pinterest';
  return $contact_methods;
}
add_filter( 'user_contactmethods', 'ath_user_fields', 10, 1);



 /**
 * Usuário - Links das redes sociais
 */

function ath_user_links($user){
  if(!empty($user)){
    $field = 'whatsapp_profile';
    $icon  = 'icon whatsapp';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'instagram_profile';
    $icon  = 'icon instagram';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'facebook_profile';
    $icon  = 'icon facebook square';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'twitter_profile';
    $icon  = 'icon twitter';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'linkedin_profile';
    $icon  = 'icon linkedin';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'youtube_profile';
    $icon  = 'icon youtube play';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }

    $field = 'pinterest_profile';
    $icon  = 'icon pinterest';
    if(!empty(get_user_meta($user,$field)[0])){
      echo '<a href="'. get_user_meta($user,$field)[0] .'" target="_blank"><i class="'. $icon .'"></i></a>';
    }
  }
}



/**
 * Comments - Custom template
 */

function ath_comment( $comment, $args, $depth ) {
  // $GLOBALS['comment'] = $comment;
  $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>

  <<?php echo esc_html( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( array( 'clearfix', empty( $args['has_children'] ) ? '' : 'parent' ) ); ?>>
    <div class="grid-comment">
      <div class="avatar-container">
        <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      </div>
      <div class="comment-content">
        <div class="comment-inner pb-4 pl-4">
          <cite class="comment-author vcard">
            <?php echo get_comment_author_link(); ?>
            <time datetime="<?php comment_time( 'c' ); ?>">
              , <?php printf( esc_html_x( '%1$s às %2$s', '1: date, 2: time' , 'ath-options' ), get_comment_date(), get_comment_time() ); ?>
            </time>
          </cite>
          <div class="comment-text my-3">
            <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation"><?php esc_html_e( 'Seu comentário está aguardando moderação.' , 'ath-options' ); ?></p>
            <?php endif; ?>

            <?php comment_text(); ?>
          </div>
          <div class="comment-metadata">
            <?php comment_reply_link( array_merge( $args, array(
              'depth' => $depth,
              'before' => '  '
            ) ) ); ?>
            <?php edit_comment_link( esc_html__( 'Edit' , 'ath-options' ), ' / ' ); ?>
          </div>
        </div>

  <?php
}


function end_ath_comment( $comment, $args ) {
  $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
    </div>
  </div>
<?php
  echo "</{$tag}><!-- #comment-{$comment->comment_ID} -->\n";
}


function ath_comment_post_redirect( $location, $commentdata ) {
  if ( ! isset( $commentdata ) || empty( $commentdata->comment_post_ID ) ) {
    return $location;
  }
  return wp_get_referer() . ( empty( $commentdata->comment_approved ) ? '?waitingforapproval=' . $commentdata->comment_ID : '' ) . '#comment-' . $commentdata->comment_ID;
}
add_filter( 'comment_post_redirect', 'ath_comment_post_redirect', 10, 2 );


function ath_thread_comments_depth() {
  $depth = get_option( 'thread_comments_depth', 0 );
  if ( $depth > 2 ) {
    update_option( 'thread_comments_depth', min( 2, $depth ) );
  }
}
add_action( 'after_setup_theme', 'ath_thread_comments_depth' );


function ath_comments_template_query_args( $comment_args ) {
  if ( ! empty( $_GET['waitingforapproval'] ) ) {
    $comment = get_comment( $_GET['waitingforapproval'] );

    if ( $comment && ! is_wp_error( $comment ) ) {
      $comment_args['include_unapproved'][] = $comment->comment_author_email;

      $_comments = new WP_Comment_Query([
        'post_id'         => $comment->comment_post_ID,
        'author_email'    => $comment->comment_author_email,
        'status'          => 'all',
        'comment__not_in' => [ $comment->comment_ID ],
      ]);

      if ( $_comments ) {
        $not_in = [];

        foreach ( $_comments as $_comment ) {
          if ( empty( $_comment->comment_approved ) ) {
            $not_in[] = $_comment->comment_ID;
          }
        }

        $comment_args['comment__not_in'] = array_merge( (array) $comment_args['comment__not_in'], $not_in );
      }
    }
  }

  return $comment_args;
}
add_filter( 'comments_template_query_args', 'ath_comments_template_query_args' );


/**
 * Redux
 */

function ath_rdx_changed(){

  global $ath_options;

  // $file   = fopen(dirname(dirname(__FILE__)).'/assets/css/ath-custom.css', "w");
  // $output = '#ath-header:before,.overlay-wrapper:before{
  //   background-image: linear-gradient(120deg,'. $ath_options['color_primary'] .','. $ath_options['color_secondary'] .') !important;
  // }';
  // $output .= '.ath-banner.default{
  //   background-image: linear-gradient(120deg,'. $ath_options['color_primary'] .','. $ath_options['color_secondary'] .');
  // }';
  // $output .= '.ath-banner.default .infos h1,.ath-banner.default .infos h3,.ath-banner.default .infos h4,.ath-banner.default .infos p{
  //   color: white !important;
  // }';

  // $return = fwrite($file,$output);
  // return $return;
  

}
add_action ('redux/options/ath_options/saved', 'ath_rdx_changed');
add_action( 'redux/customizer/live_preview', 'ath_rdx_changed');
add_action('customize_save_after','ath_rdx_changed');



/**
 * Widgets - Desabilitar
 */

function ath_disable_widgets(){
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_RSS');
}
add_action('widgets_init','ath_disable_widgets');



/**
 * Mobile Control
 */

function is_phone(){

  $mob = new Mobile_Detect;
  if($mob->isMobile() && !$mob->isTablet()){
    return true;
  }
}

function is_tablet(){

  $mob = new Mobile_Detect;
  if($mob->isMobile() && $mob->isTablet()){
    return true;
  }
}

function ath_get_device(){

  $mob   = new Mobile_Detect;
  $class = array();

  if($mob->isiOS()){

    array_push($class,'ios');
    if(is_phone()){
      array_push($class,'phone');
      array_push($class, $mob->version('iPhone'));
    }
    if(is_tablet()){
      array_push($class,'tablet');
      array_push($class, $mob->version('iPad'));
    }
  }

  if($mob->isAndroidOS()){

    array_push($class,'android');
    if(is_phone()){
      array_push($class,'phone');
      array_push($class, $mob->version('Android'));
    }
    if(is_tablet()){
      array_push($class,'tablet');
      array_push($class, $mob->version('Android'));
    }
  }

  $output = '';

  if(!empty($class)){

    foreach ($class as $k => $v){
      $output .= $v.'-';
    }
  }

  return $output;

}



/*
 *
 * Thumbnail
 *
 */


// add_image_size( 'ath-thumb-mega', 1920, 1080, array( 'left', 'top' ) );
// add_image_size( 'ath-thumb-large', 1280, 720, array( 'left', 'top' ) );
// add_image_size( 'ath-thumb-medium', 894, 502, array( 'left', 'top' ) );
// add_image_size( 'ath-thumb-small', 556, 313, array( 'left', 'top' ) );
// add_image_size( 'ath-thumb-square', 450, 450, array( 'left', 'top' ) );

add_image_size( 'ath-thumb-mega', 1920, 1080 );
add_image_size( 'ath-thumb-large', 1280, 720);
add_image_size( 'ath-thumb-medium', 894, 502);
add_image_size( 'ath-thumb-small', 556, 313);
add_image_size( 'ath-thumb-square', 450, 450);


function ath_get_better_thumbnail($attach_id, $size, $default='medium'){
  $attach = wp_get_attachment_metadata($attach_id);
  if(isset($attach['sizes'][$size])){
    return wp_get_attachment_image_src($attach_id,$size)[0];
  }else{
    return wp_get_attachment_image_src($attach_id,$default)[0];
  }
}



/*
 *
 * LICENSE
 *
 */

function ath_check_license($key){
  
  $store_url = 'https://athena.viverdeblog.com';
  $item_name = ATH_THEME_NAME;
  $api_params = array(
    'edd_action' => 'check_license',
    'license' => $key,
    'item_name' => urlencode( $item_name ),
    'url' => home_url()
  );
  $response = wp_remote_post( $store_url, array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
  
  if ( is_wp_error( $response ) ) {
    return false;
  }

  $license_data = json_decode( wp_remote_retrieve_body( $response ) );

  if(isset($license_data->license)){
    if( $license_data->license == 'valid' or $license_data->license == 'inactive' ) {
      return true;
      exit;
    } else {
      return false;
      exit;
    }
  }else{
    return false;
    exit;
  }

}


function ath_update_alert(){

  global $pagenow;
  $license = get_option('vdb-athena_license_key');

  if ($pagenow != 'themes.php'){
     if(!empty($license)){
       if(!ath_check_license($license)){
        function ath_invalid_notice(){
          echo '<div class="notice notice-error">
                 <p>Ative sua licença para receber as atualizações do tema. <a href="'. get_bloginfo('url') .'/wp-admin/themes.php?page=vdb-athena-license">Clique aqui</a></p>
             </div>';
        }
        add_action('admin_notices','ath_invalid_notice');
       }
     }
  }
}

add_action('admin_init', 'ath_update_alert');



/*
 *
 * SUPPORT
 *
 */


function ath_support_beacon(){

  global $pagenow;
  $license = get_option('vdb-athena_license_key');

  if ($pagenow == 'index.php'){
    if(!empty($license)){
      if(ath_check_license($license)){
        echo '<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script><script type="text/javascript">window.Beacon(\'init\', \'b4fed1bb-4368-4a86-9f37-4749b1478bfc\')</script>';

      }
    }
  }

}

add_action('admin_head','ath_support_beacon');



/*
 *
 * CUSTOMIZER
 *
 */


function ath_customize_scripts( $wp_customize ){
  wp_enqueue_script( 'ath-customize-preview', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20141216', true );
}
add_action('customize_controls_enqueue_scripts', 'ath_customize_scripts');


/*
 *
 * PAGE BUILDERS
 *
 */


function ath_landing_builder(){

  if(is_page_template('builders.php')){

    global $post;
    global $ath_options;

    $qo = get_queried_object();
    $page_builder_header = get_field('landing_builder_header',$qo->ID);
    $page_builder_footer = get_field('landing_builder_footer',$qo->ID);

    echo "<style>";
    echo $page_builder_header === FALSE ? '#ath-header{display:none !important;}':'';
    echo $page_builder_footer === FALSE ? '.ath-footer,.ath-home-lists{display:none !important;}':'';
    echo "</style>";
  }

}
add_action('wp_head','ath_landing_builder');



/*
 *
 * BODY CLASS
 *
 */

function ath_body_classes( $classes ) {
 
    global $ath_options;

     $classes[] = ( $ath_options['color_mode'] == 'light' ? 'ath-pal-light' : 'ath-pal-dark' ); 
     $classes[] = ( $ath_options['color_type'] == 'custom' ? 'ath-pal-custom' : 'ath-pal-pallete' );
     
    return $classes;
     
}
add_filter( 'body_class','ath_body_classes' );



/*
 *
 * YOAST
 *
 */

function ath_yoast_title(){

  global $post;

  if(is_home() or is_front_page()){
    // return get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
    return $post->ID;
  }

}



/*
 *
 * HAS SEO PLUGINS
 *
 */

function ath_has_seo_plugins(){

  $has = false;

  if (is_plugin_active( 'wordpress-seo/wp-seo.php' )){$has = true;}
  if (is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' )){$has = true;}
  return $has;

}

