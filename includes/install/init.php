<?php


function ath_theme_activation() {

  include_once('pages.php');
  include_once('menus.php');
  include_once('content.php');

}

add_action( 'after_switch_theme', 'ath_theme_activation' );


// function ath_theme_setup() {}
// add_action( 'after_setup_theme', 'ath_theme_setup' );