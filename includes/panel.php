<?php 

  require_once('redux/loader.php' );
  require_once('redux/ReduxCore/framework.php' );

  if ( ! class_exists( 'Redux' ) ) {
      return;
  }

  $opt_name = "ath_options";
  $theme = wp_get_theme();

  $args = array(

      'opt_name'             => $opt_name,
      'display_name'         => $theme->get( 'Name' ),
      'display_version'      => $theme->get( 'Version' ),
      'menu_type'            => 'menu',
      'allow_sub_menu'       => true,
      'menu_title'           => __( 'Painel', 'ath-options' ),
      'page_title'           => __( 'Painel', 'ath-options' ),
      // 'google_api_key'       => '',
      'google_update_weekly' => false,
      'async_typography'     => true,
      'disable_google_fonts_link' => false,
      'admin_bar'            => true,
      'admin_bar_icon'       => 'dashicons-list-view',
      'admin_bar_priority'   => 50,
      'global_variable'      => '',
      'dev_mode'             => false,
      'update_notice'        => false,
      'customizer'           => true,
      'page_priority'        => null,
      'page_parent'          => 'themes.php',
      'page_permissions'     => 'manage_options',
      'menu_icon'            => 'dashicons-list-view',
      'last_tab'             => '',
      'page_icon'            => 'icon-themes',
      'page_slug'            => '',
      'save_defaults'        => true,
      'default_show'         => false,
      'default_mark'         => '',
      'show_import_export'   => false,
      'transient_time'       => 60 * MINUTE_IN_SECONDS,
      'output'               => true,
      'output_tag'           => true,
      'database'             => '',
      'use_cdn'              => true,
      'hints'                => array(
          'icon'          => 'el el-question-sign',
          'icon_position' => 'right',
          'icon_color'    => 'lightgray',
          'icon_size'     => 'normal',
          'tip_style'     => array(
              'color'   => 'red',
              'shadow'  => true,
              'rounded' => false,
              'style'   => '',
          ),
          'tip_position'  => array(
              'my' => 'top left',
              'at' => 'bottom right',
          ),
          'tip_effect'    => array(
              'show' => array(
                  'effect'   => 'slide',
                  'duration' => '300',
                  'event'    => 'mouseover',
              ),
              'hide' => array(
                  'effect'   => 'slide',
                  'duration' => '300',
                  'event'    => 'click mouseleave',
              ),
          ),
      )
  );


  Redux::setArgs( $opt_name, $args );
  
  include_once('options/capture.php');
  include_once('options/appearance.php');
  include_once('options/layout.php');
  include_once('options/marketing.php');
  include_once('options/social.php');
  include_once('options/integration.php');


?>