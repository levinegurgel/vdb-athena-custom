<header id="ath-header" class="jumbo campaign" style="background:linear-gradient(-175deg, <?php echo get_field('header_bg_color1'); ?> 0%, <?php echo get_field('header_bg_color2'); ?> 99%);">

  <div class="cover hidden-xs" style="background:url('<?php echo get_field('header_bg_image'); ?>') repeat-x bottom left;"></div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php get_template_part( 'template-parts/ath-header', 'mobile-nav' ); ?>
      </div>
    </div>
  </div>

  <div class="container">
    <?php get_template_part( 'template-parts/ath-header', 'nav' ); ?>
    <div class="row">
      <div class="col-md-5 col-sm-6">

        <div class="cta animated fadeIn">
          <div class="wrapper">
            <?php if ( get_field( 'header_subtitle' ) ) : ?>
              <h3><?php the_field( 'header_subtitle' ); ?></h3>
            <?php endif; ?>
            <?php if ( get_field( 'header_title' ) ) : ?>
              <h1><?php the_field( 'header_title' ); ?></h1>
            <?php endif; ?>
            <?php if ( get_field( 'header_description' ) ) : ?>
              <p><?php the_field( 'header_description' ); ?></p>
            <?php endif; ?>
            <?php if ( get_field( 'header_cta_link' ) && get_field( 'header_cta_text' ) ) : ?>
              <a href="<?php the_field( 'header_cta_link' ); ?>" class="button outline white rpp medium"><?php the_field( 'header_cta_text' ); ?></a>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <div class="col-md-7 col-sm-6">
        <?php if ( get_field( 'header_image' ) ) : ?>
          <div class="animation">
            <div class="wrapper">
              <img src="<?php the_field( 'header_image' ); ?>" class="animated fadeIn" alt="<?php echo esc_attr( get_bloginfo( 'title', 'display' ) ); ?>">
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row relative">
      <div class="col-md-12">

        <?php get_template_part( 'template-parts/ath-cta', 'header' ); ?>

      </div>
    </div>
  </div>

</header>