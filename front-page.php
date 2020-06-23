<?php
/* Template Name: Inicial */
global $emp;
global $ath_options;

get_header();
$mob = new Mobile_Detect;
if ( is_search() ) {
  global $post;
  $post = ath_get_home();
}
?>


<!-- CABEÇALHO -->

<?php get_template_part( 'template-parts/ath-header', 'jumbo' ); ?>


<!-- CHAMADAS -->
<?php if($ath_options['home_type'] == 'company'): ?>
<?php $class_home_calls = is_tablet() ? 'pt-9 pb-5':'pt-8'; ?>
<section class="ath-home-calls ath-section gray push bottom top medium dyn-bg ath-background no-repeat position-bottom-center size-contain <?php echo $ath_options['capture_header_status'] == true ? ' has-capture '. $class_home_calls : ''; ?>">
  <div class="container">
    <div class="row <?php echo $ath_options['capture_header_name_status'] == true ? 'has-name' : ''; ?> <?php echo $ath_options['capture_header_status'] == true ? '' : 'mt-0'; ?>">

        <div class="col-md-5 col-sm-5">
          
          <?php 
            $call_left = get_field('home_call_left');
            if($call_left):
          ?>
            <article class="ath-call vertical right margin-top-50">
                <?php if (!empty($call_left['title'])) : ?>
                <h3 class="lh-30-xs mb-3 <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-2':''; ?>"><?php echo $call_left['title']; ?>
                  
                </h3>
                <?php endif; ?>
                <?php if (!empty($call_left['description'])) : ?>
                <p class="font-19"><?php echo $call_left['description']; ?></p>
                <?php endif; ?>
                <?php if ( !empty($call_left['button']) && !empty($call_left['button_url']) ) : ?>
                <a href="<?php echo $call_left['button_url']; ?>" class="button medium rpp full primary"> <?php echo $call_left['button']; ?></a>
                <?php endif; ?>
            </article>
          <?php endif; ?>

        </div>

        <div class="col-md-2 col-sm-2">
          <div class="ath-divider vertical circle or margin-top-50"></div>
        </div>

        <div class="col-md-5 col-sm-5">

          <?php 
            $call_right = get_field('home_call_right');
            if($call_right):
          ?>
            <article class="ath-call vertical left margin-top-50">
                <?php if (!empty($call_right['title'])) : ?>
                <h3 class="mb-3"><?php echo $call_right['title']; ?></h3>
                <?php endif; ?>
                <?php if (!empty($call_right['description'])) : ?>
                <p class="font-19"><?php echo $call_right['description']; ?></p>
                <?php endif; ?>
                <?php if ( !empty($call_right['button']) && !empty($call_right['button_url']) ) : ?>
                <a href="<?php echo $call_right['button_url']; ?>" class="button medium rpp full primary"> <?php echo $call_right['button']; ?></a>
                <?php endif; ?>
            </article>
          <?php endif; ?>

        </div>


    </div>
  </div>
</section>
<?php endif; ?>


<!-- VITRINE DE ARTIGOS -->
<?php if($ath_options['home_type'] == 'company'): ?>
<section class="ath-section pb-0 pt-7">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <article class="ath-call horizontal ath-home-title-articles">
          <div class="row">
            <div class="col-md-7 col-sm-7 <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-0 mb-3':''; ?>">
              <?php if ( get_field( 'home_articles_title' ) ) : ?>
              <h3><?php the_field( 'home_articles_title' ); ?></h3>
              <?php endif; ?>
              <?php if ( get_field( 'home_articles_title' ) ) : ?>
              <p><?php the_field( 'home_articles_description' ); ?></p>
              <?php endif; ?>
            </div>
            <div class="col-md-5 col-sm-5">

              <?php if ( have_rows( 'home_articles_numbers' ) ) : ?>
              <div class="ath-numbers inline hidden-xs">
                  <ul class="push-right">
                    <?php while ( have_rows( 'home_articles_numbers' ) ) : the_row(); ?>
                    <li>
                      <?php 
                        $number = get_sub_field('number');
                        if(!empty($number)):
                          $number = str_replace('[','<small>',$number);
                          $number = str_replace(']','</small>',$number);
                        endif;
                      ?>
                      <?php if(!empty($number)): ?>
                        <span><?php echo $number; ?></span>
                        <span><?php the_sub_field( 'label' ); ?></span>
                      <?php endif; ?>
                    </li>
                    <?php endwhile; ?>
                  </ul>
              </div>
              <?php endif; ?>

            </div>
          </div>
        </article>

      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if($ath_options['home_type'] == 'company'): ?>
<?php get_template_part( 'template-parts/ath-showcase', 'articles' ); ?>
<?php endif; ?>

<!-- VITRINE MATERIAIS EBOOKS -->
<?php if($ath_options['home_type'] == 'company'): ?>
<?php get_template_part( 'template-parts/ath-showcase', 'ebooks' ); ?>
<?php endif; ?>

<!-- VITRINE SLIDER -->
<?php if($ath_options['home_type'] == 'company'): ?>
<?php get_template_part( 'template-parts/ath-slider', 'home' ); ?>
<?php endif; ?>

<!-- VITRINE DE VIDEOS -->
<?php if($ath_options['home_type'] == 'company'): ?>
<?php get_template_part( 'template-parts/ath-showcase', 'videos' ); ?>
<?php endif; ?>

<!-- SOBRE -->
<?php if($ath_options['home_type'] == 'company'): ?>
<?php get_template_part( 'template-parts/ath-about', 'me' ); ?>
<?php endif; ?>

<!-- BLOG -->
<?php if($ath_options['home_type'] == 'blog'): ?>
<?php 
  if(!is_phone()){
    $adjust = $ath_options['capture_header_status'] == TRUE ? 'mt-7' : 'mt-5';
  }else{
    $adjust = $ath_options['capture_header_status'] == TRUE ? 'mt-10' : 'mt-3';
  }
  echo '<div class="'. $adjust .'"></div>';
  get_template_part( 'template-parts/ath', 'wall' ); 
?>
<?php endif; ?>

<!-- PROMOÇÃO -->
<?php if($ath_options['home_type'] == 'blog'): ?>
<?php get_template_part( 'template-parts/ath', 'promotion' ); ?>
<?php endif; ?>

<!-- FOOTER CTA -->
<?php get_template_part( 'template-parts/ath-cta', 'footer' ); ?>


<?php get_footer(); ?>