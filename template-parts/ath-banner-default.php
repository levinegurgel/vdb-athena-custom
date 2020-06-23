<?php
  global $ath_options;
  $title        = get_field( 'page_title' ) ? get_field( 'page_title' ) : get_the_title();
  $subtitle     = get_field( 'page_subtitle' );
  $description  = get_field( 'page_description' );
  $color1       = '';

  if ( is_tax() ) {

    $title       = single_term_title( '', false );
    $description = get_queried_object()->description;
    // $color1      = get_term_meta(get_queried_object()->term_id, 'color', true );
    $color1      = $ath_options['color_primary'];
    $color2      = $ath_options['color_secondary'];
  }

  if( is_archive() ){
    $title        = get_the_archive_title();
    $description  = get_the_archive_description();
    $color1      = $ath_options['color_primary'];
    $color2      = $ath_options['color_secondary'];
  }
?>

<div class="ath-banner default default-color" <?php echo $color1 ? 'style="background:linear-gradient(-175deg, ' . $color1 . ' 0%, ' . $color2 . ' 99%);"' : ''; ?>>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php if ( $subtitle ) : ?>
        <h4><?php echo $subtitle; ?></h4>
        <?php endif; ?>
        <?php if ( $title ) : ?>
        <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description ) : ?>
        <p><?php echo $description; ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>