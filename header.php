<?php 
  global $emp;
  global $ath_options; 
?>
<!DOCTYPE HTML>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="ie ie9"<?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $ath_options['brand_favicon']['url'];?>">
	<link rel="icon" type="image/x-icon" href="<?php echo $ath_options['brand_favicon']['url'];?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $ath_options['brand_favicon']['url'];?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $ath_options['brand_favicon']['url'];?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $ath_options['brand_favicon']['url'];?>">
	
	<?php ath_appearance(); ?>
	<?php 
    if( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) && !is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {
      get_template_part( 'template-parts/ath', 'seo' );
    }
  ?>
  <?php echo $ath_options['script_header']; ?>
  <?php if(is_page() or is_single() or is_singular()){
      global $post;
      echo get_field('single_scripts_header',$post->ID);
  }?>
	<?php wp_head(); ?>

  </head>
<body <?php body_class(); ?> data-url="<?php echo get_bloginfo('url'); ?>" data-site-name="<?php echo get_bloginfo('name'); ?>" data-url="<?php echo get_bloginfo('url'); ?>" data-mobile="<?php echo is_phone() ? 'is-phone':''; ?><?php echo is_tablet() ? 'is-tablet':''; ?>" data-device="<?php echo ath_get_device(); ?>">
<?php get_template_part( 'template-parts/ath', 'overlay' ); ?>
<?php if ( is_single() ) get_template_part( 'template-parts/ath-cta', 'footer-bar' ); ?>