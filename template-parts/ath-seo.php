<?php 
	global $post;
	global $ath_options;
?>


<!-- INICIAL E FRONTPPAGE -->

<?php if (is_home() or is_front_page()): ?>
	
	<title><?php echo get_bloginfo('description'); ?> &#8250; <?php echo get_bloginfo('name'); ?></title>
	
	<?php if(!ath_has_seo_plugins()): ?>
		<meta property="og:title" content="<?php echo $ath_options['header_title']; ?>">
	  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
	  <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
	  <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
	  <meta property="og:type" content="article">
	  <meta property="og:image" content="">
	<?php endif; ?>

<?php endif; ?>



<!-- PESQUISA-->

<?php if (is_single()): ?>
	
	<title><?php echo $post->post_title; ?> &#8250; <?php echo get_bloginfo('name'); ?></title>

	<?php if(!ath_has_seo_plugins()): ?>
		<meta property="og:title" content="<?php echo $post->post_title; ?>">
	  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
	  <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
	  <meta property="og:description" content="">
	  <meta property="og:type" content="article">
	  <?php if(has_post_thumbnail($post->ID)): ?>
	  	<meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID,'ath-thumb-small'); ?>">
	  <?php endif ?>
	<?php endif; ?>

<?php endif; ?>



<!-- LISTAGEM DE POSTS -->

<?php if (is_archive() && !is_author() && !is_date()):
	  $qo = get_queried_object();?>

  <title><?php echo ucfirst($qo->name); ?>  &#8250; <?php echo get_bloginfo('name'); ?></title>
	
	<?php if(!ath_has_seo_plugins()): ?>
		<meta property="og:title" content="<?php echo ucfirst($qo->name); ?>">
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo get_term_link($qo->term_id); ?>">
    <meta property="og:description" content="<?php echo $qo->description; ?>">
    <meta property="og:type" content="article">
	<?php endif; ?>

<?php endif; ?>



<!-- ARQUIVOS DE POSTS E AUTOR -->

<?php if (is_archive() && is_author()):
	  $qo = get_queried_object();
	  $author_id = $qo->ID; ?>
	
	<title><?php echo ucfirst($qo->display_name); ?>  &#8250; <?php echo get_bloginfo('name'); ?></title>

	<?php if(!ath_has_seo_plugins()): ?>
	<meta property="og:title" content="Artigos de <?php echo $qo->data->display_name; ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
  <meta property="og:description" content="Confira os melhores artigos de <?php echo $qo->data->display_name; ?> em <?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="article">
  <meta property="og:image" content="<?php echo get_avatar_url($author_id); ?>">
	<?php endif; ?>

<?php endif; ?>



<!-- PAGINAS E ARQUIVOS DE DATA -->

<?php if (is_page() or is_date()): ?>

	<title><?php wp_title(''); ?> &#8250; <?php echo get_bloginfo('name'); ?></title>

	<?php if(!ath_has_seo_plugins()): ?>
	<meta property="og:title" content="<?php echo $post->post_title; ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
  <meta property="og:description" content="">
  <meta property="og:type" content="article">
  <meta property="og:image" content="">
	<?php endif; ?>

<?php endif; ?>



<!-- PESQUISA -->

<?php if (is_search()): ?>
	<?php global $wp_query; ?>
	
	<title>(<?php echo $wp_query->found_posts; ?>) <?php echo $wp_query->found_posts <= 1 ? 'resultado encontrado':'resultados encontrados'; ?> &#8250; <?php echo get_bloginfo('name'); ?></title>
	
	<?php if(!ath_has_seo_plugins()): ?>
	<meta property="og:title" content="<?php echo $ath_options['header_title']; ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
  <meta property="og:description" content="Encontre os melhores artigos em <?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="article">
  <meta property="og:image" content="">
	<?php endif; ?>

<?php endif; ?>