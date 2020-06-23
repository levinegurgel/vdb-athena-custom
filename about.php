<?php
/* Template Name: Sobre */
get_header();
get_template_part( 'template-parts/ath-header', 'internal' );
$background  = get_the_post_thumbnail_url( null, 'full' );
$mob = new Mobile_Detect;

global $post;
$label = get_field('about_label');
$title = get_field('about_title');
$image = get_field('about_image');
$description = get_field('about_description');

?>

<div class="ath-header-medium">
  <div class="columns">
		<div class="column">
			<div class="wrapper">
				<div class="column-content">	
					<div class="infos push-right" >
						<h5 class="ath-font-text ath-font-text-weight font-uppercase font-18 mb-3"><?php echo $label; ?></h5>
						<h1 class="ath-font-header ath-font-header-weight font-45 mb-4"><?php echo $title; ?></h1>
						<p class="ath-font-text ath-font-text-weight font-18 lh-27 mb-4"><?php echo $description; ?></p>
						<div class="social font-20">
							<?php get_template_part( 'template-parts/ath', 'social-links' ) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="column ath-background no-repeat lazy position-<?php echo empty($image) ? 'center' : 'top'; ?>-center size-cover" data-bg="url(<?php echo empty($image) ? ath_no_thumb('') : ath_get_better_thumbnail($image['ID'],'ath-thumb-large','large'); ?>)">
			<div class="wrapper">
				<div class="column-content">
				</div>
			</div>
		</div>
	</div> 
</div>

<section class="ath-section <?php echo is_phone() ? 'pt-0' : ''; ?> <?php echo is_tablet() ? 'pt-0 pb-5':''; ?> <?php echo !is_tablet() and !is_phone() ? 'py-7':''; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-centered">
				 <!-- Início do conteúdo -->
	          <div class="ath-article single">
				   <?php
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
					?>
	          </div>
	          <!-- Fim do artigo -->
			</div>
		</div>
	</div>

  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-10 col-centered mt-7">
        <?php get_template_part( 'template-parts/ath', 'comments' ); ?>
      </div>
    </div>
  </div>

</section>

<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>