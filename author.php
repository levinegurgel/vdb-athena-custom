<?php
	get_header();
	get_template_part( 'template-parts/ath-header', 'internal' );
	$qo = get_queried_object();
	$mob = new Mobile_Detect;
?>

<div class="ath-banner default default-color pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<h4>Autores</h4>
				<h1><?php echo $qo->data->display_name; ?></h1>
				<p></p>
				<div class="social-links font-23 <?php echo is_phone() ? 'mt-3':'mt-7'; ?>">
					<nav class="<?php echo is_phone() ? 'ta-c':''; ?>"><?php ath_user_links($qo->data->ID); ?></nav>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="floated-image author-avatar <?php echo is_phone() ? 'mt-5':''; ?>">
				<?php if($avatar = get_avatar(get_the_author_meta('ID')) !== FALSE): ?>
        <?php
        	echo get_avatar($qo->data->ID,'500','','',array('class' => array())); ?>
        <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="ath-section <?php echo is_phone() ? 'mt-8':''; ?> <?php echo is_tablet() ? 'pb-0':''; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-12">
				<!-- <h3 class="ath-color-gray-dark font-19 lh-26 mb-4"></h3> -->
				<p class="ath-author-description ath-font-text ath-font-text-weight ath-color-gray-dark font-16 font-16-xs lh-26 lh-23-xs <?php echo is_phone() ? 'mt-3 px-3':''; ?>">
					<?php echo get_the_author_meta('description'); ?>
				</p>
			</div>
			<div class="col-md-7 col-sm-7 hidden-sm"></div>
		</div>
	</div>
</section>

<section class="ath-section <?php echo is_phone() ? 'px-3 mb-5':'pb-0 mb-7'; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="ath-author-title ath-font-header ath-font-header-weight font-28 mb-3">Artigos publicados</h3>
				<p class="ath-author-subtitle ath-font-text ath-font-text-weight ath-color-gray-dark"><?php echo $qo->data->display_name; ?> escreveu <?php echo count_user_posts( (int) $author, 'post', 'public' ); ?> artigos<!--  nos últimos 12 meses -->.</p>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/ath', 'wall' ); ?>

<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>