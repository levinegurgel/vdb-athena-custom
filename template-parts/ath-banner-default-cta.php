<?php
  
  global $ath_options;
  $color1 = '';
  $color2 = '';
  $description = '';
  $cat_color = '';

  if ( is_archive() ) {
    $title        = get_the_archive_title();
    $subtitle     = get_the_archive_description();
    $term         = get_queried_object();
    if ( is_category() or is_tag() or is_date()) {
      $title        = '';
      $subtitle     = get_the_archive_title();
      $description  = isset($term->description) ? $term->description : '';
      if(isset($term)){
        $color1 = !empty(get_term_meta($term->term_id, 'color', true )) ? get_term_meta($term->term_id, 'color', true ) : '#b5bfc9';
        $color2 = $color1;
      }else{
        $color1 = '#b5bfc9';
        $color2 = '#b5bfc9';
      }
    }
    $cat_color = get_term_meta($term->term_id, 'color', true );
    $cat_color = empty($cat_color) ? 'default-color':'';
  } else {
    $title        = get_field( 'page_title' );
    $subtitle     = get_field( 'page_subtitle' );
    $description  = get_field( 'page_description' );
    $color1       = $ath_options['color_primary'];
    $color2       = $ath_options['color_secondary'];
  }

  $banner_classes = $ath_options['capture_header_status'] == TRUE ? 'has-capture' : 'mb-5';
  

?>

<div class="ath-banner default has-absolute <?php echo $cat_color; ?> <?php echo $banner_classes; ?>" <?php echo $color1 ? 'style="background:linear-gradient(-175deg, ' . $color1 . ' 0%, ' . $color2 . ' 99%);"' : ''; ?>>
  <?php if ( is_page() && has_post_thumbnail() ) : ?>
  <div class="thumbnail hidden-xs hidden-sm">
    <?php $thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' ); ?>
    <img src="<?php echo $thumbnail; ?>" alt="<?php echo esc_attr( $title ); ?>">
  </div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-8 infos">
        <h4><?php echo $title; ?></h4>
        <?php if ( $subtitle ) : ?>
        <h1><?php echo $subtitle; ?></h1>
        <?php endif; ?>
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