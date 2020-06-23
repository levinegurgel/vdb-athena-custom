<?php

define( 'ATH_THEME_VERSION',  '10.2' );
define( 'ATH_THEME_NAME',     'VDB Athena' );
define( 'ATH_THEME_SLUG',     'vdb-athena' );
$inc = __DIR__ . '/';



/*
 *
 * Functions
 *
 */

require_once( $inc . 'functions.php' );


/*
 *
 * Panel Options
 *
 */

include_once( $inc . 'panel.php');


/*
 *
 * Shortcodes
 *
 */

require_once( $inc . 'shortcodes/capture.php' );
require_once( $inc . 'shortcodes/material.php' );


/*
 *
 * Controllers
 *
 */

require_once( $inc . 'controllers/controller-posts.php' );
require_once( $inc . 'controllers/controller-materials.php' );
require_once( $inc . 'controllers/controller-tools.php' );
require_once( $inc . 'controllers/controller-banners.php' );


/*
 *
 * Vendors
 *
 */

require_once( $inc . 'vendor/walker/abstract_base.php' );
require_once( $inc . 'vendor/walker/abstract_nav_menu.php' );
require_once( $inc . 'vendor/walker/nav_menu.php' );
require_once( $inc . 'vendor/mobile.php' );


/*
 *
 * Email
 *
 */

require_once( $inc . 'email/email.php' );


/*
 *
 * General
 *
 */

require_once( $inc . 'cpts.php' );
require_once( $inc . 'menu.php' );
require_once( $inc . 'ajax.php' );



/*
 *
 * Theme Install
 *
 */

require_once( $inc . 'install/init.php' );
