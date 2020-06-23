<?php get_header(); ?>
<?php get_template_part( 'template-parts/ath-header', 'internal' ); ?>

<?php
  global $ath_options;
  $single       = apply_filters( 'get_post_content', false );
  $title        = get_field( 'page_title' ) ? get_field( 'page_title' ) : $single->title;
  $subtitle     = get_field( 'page_subtitle' );
  $description  = get_field( 'page_description' );
  $classes      = array();
  $banner_classes = '';

  if($ath_options['capture_header_status'] == FALSE){
    array_push($classes,' mb-5 ');
  }

  foreach ($classes as $c) {
    $banner_classes .= $banner_classes .' '. $c;
  }

?>



<div class="ath-banner default has-absolute <?php echo $banner_classes; ?>" style="background:linear-gradient(-175deg, <?php echo $ath_options['color_primary']; ?> 0%, <?php echo $ath_options['color_secondary']; ?> 99%);">
 <?php if ( $single->thumbnail ) : ?>
    <div class="thumbnail hidden-xs hidden-sm">
      <img src="<?php echo $single->thumbnail_large[0]; ?>" alt="<?php echo esc_attr( $single->title ); ?>">
    </div>
    <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 infos">
        <?php if ( $subtitle ) : ?>
          <h4><?php echo $subtitle; ?></h4>
        <?php endif; ?>
        <h1><?php echo $title; ?></h1>
        <?php if ( $description ) : ?>
        <p><?php echo $description; ?></p>
        <?php endif; ?>
      </div>
      <div class="row relative">
        <div class="col-md-12">
          <?php get_template_part( 'template-parts/ath-cta', 'header' ); ?>
        </div>
      </div>
    </div>
  </div>
</div>


  <main class="ath-section padding-top-0 margin-bottom-70 margin-top-170-xs">

    <div class="container">
      <div class="row">
        <div class="col-md-10 col-centered">

          <!-- Início do artigo -->
          <div class="ath-article single">
            <?php if (have_posts()) : while (have_posts()) : the_post(); 
              the_content();
              endwhile;
              endif; 
            ?>
          </div>
          <!-- Fim do artigo -->

        </div>
      </div>
      <div class="row">
        <div class="col-md-7 col-sm-10 col-centered margin-top-100">
          <?php get_template_part( 'template-parts/ath', 'comments' ); ?>
        </div>
      </div>
    </div>

  </main>




<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>