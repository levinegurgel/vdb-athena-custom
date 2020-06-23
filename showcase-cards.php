<?php
/* Template Name: Vitrine de links */
get_header();
get_template_part( 'template-parts/ath-header', 'internal' );
?>

<?php
  global $ath_options;
  $single       = apply_filters( 'get_post_content', false );
  $title        = get_field( 'page_title' ) ? get_field( 'page_title' ) : $single->title;
  $subtitle     = get_field( 'page_subtitle' );
  $description  = get_field( 'page_description' );
  $classes      = array();
  $banner_classes = '';
  $feature = count(get_field('feature'));

  if($ath_options['capture_header_status'] == FALSE){
    array_push($classes,' mb-5 ');
  }

  foreach ($classes as $c) {
    $banner_classes .= $banner_classes .' '. $c;
  }

?>

<?php

  if($feature > 0):

  if ( have_rows( 'feature' ) ) :
    while ( have_rows( 'feature' ) ) : the_row();
?>
  
  <div class="ath-banner green col-2" data-color-ref="#ffc46a">
    <div class="background" style="background:linear-gradient(-175deg, <?php echo get_sub_field('color1'); ?> 0%, <?php echo get_sub_field('color2'); ?> 99%);"></div>
    <div class="background repeat-x position-bottom-center"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 visible-xs">
          <div class="wrapper" style="height: initial !important;">
            <div class="vertical-middle">
              <img src="<?php echo get_sub_field('image')['sizes']['ath-thumb-medium']; ?>" alt="<?php echo get_sub_field('title'); ?> " style="max-height: 180px;">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="wrapper" style="<?php echo is_phone() ? 'height: initial !important;':'float:left;'; ?>">
            <div class="vertical-middle">
                <h2><?php echo get_sub_field('title'); ?></h2>
                <p><?php echo get_sub_field('description'); ?></p>
                <?php $button_label = get_sub_field('button_label'); ?>
                <?php if (!empty($button_label)): ?>
                  <a href="<?php echo get_sub_field('button_url'); ?>" class="button outline white rpp medium"><?php echo get_sub_field('button_label'); ?></a>
                <?php endif ?>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 hidden-xs">
          <div class="wrapper">
            <div class="vertical-middle">
              <img src="<?php echo get_sub_field('image')['sizes']['ath-thumb-medium']; ?>" alt="<?php echo get_sub_field('title'); ?> " style="max-height: 280px; width: auto;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

<?php 
    endwhile;
  endif;

  else:
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


<?php
  endif;

?>

<section class="ath-section <?php echo ( $feature == 0 ? 'pt-0':'' ); ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="ath-courses-showcase">

          <div class="ath-showcase col-3">

              <?php
              if ( have_rows( 'courses' ) ) :
                while ( have_rows( 'courses' ) ) : the_row();

                  $title = get_sub_field( 'course_name' );
                  $description = get_sub_field( 'course_description' );
                  $thumbnail = get_sub_field( 'course_thumb' );
                  $thumbnail_type = get_sub_field( 'course_thumb_type' );
                  $link_label = get_sub_field( 'course_link_label' );
                  $link  = get_sub_field( 'course_link' );
                  $color1 = get_sub_field('course_color1');
                  $color2 = get_sub_field('course_color2');
                  $status = get_sub_field('course_status');

                  if(!empty($thumbnail)){
                    $thumbnail = $thumbnail['sizes']['ath-thumb-small'];
                  }

                   $card_style  = $thumbnail_type == 'transparent' ? 'background: linear-gradient(-175deg, '. $color1 .' 0%, '. $color2 .' 99%);' : 'background: url('. (!empty($thumbnail) ? $thumbnail : ath_no_thumb('',true)) .') no-repeat center center '. $color1 .'; background-size: cover;';
                  
                  if($status):
              ?>

                  <article class="ath-card paper rounded relative">
                    <?php if (!empty($link)): ?>
                       <a href="<?php echo $link; ?>"><div class="coverlink"></div></a>
                    <?php endif ?>

                    <div class="overlay video hide-overlay inherit" style="<?php echo $card_style; ?> cursor: pointer;">
                      <div class="wrapper">
                        <?php if($thumbnail_type == 'transparent'): ?>
                          <img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>" style="max-width: 50%;">
                        <?php endif; ?>
                      </div>
                    </div>

                    <h4><?php echo $title; ?></h4>
                    <p><?php echo $description; ?></p>
                    <?php if (!empty($link)): ?>
                      <a class="button full green rpp"><?php echo $link_label; ?></a>
                    <?php endif; ?>
                  
                  </article>

                <?php
                 endif;
                endwhile;
              endif;
              ?>

          </div>

        </div>

      </div>
    </div>
  </div>
</section>



<section class="ath-section no-padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Classes a adicionar: purple col-2 ad-full rounded <-->
        <?php // get_template_part( 'includes/components/ath-banner', 'ad-full' ); ?>
        <?php echo apply_filters( 'the_content', $post->post_content ); ?>
      </div>
    </div>
  </div>
</section>


<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>