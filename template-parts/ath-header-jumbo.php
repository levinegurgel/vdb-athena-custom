<?php 
    
    global $emp;
    global $ath_options;

    $mob = new Mobile_Detect;

    $header_type       = $ath_options['header_type'];
    $header_content    = $ath_options['header_content'];
    $header_color1     = $ath_options['header_color']['from'];
    $header_color2     = $ath_options['header_color']['to'];

    $header_image      = ( strpos($ath_options['header_image']['url'], '/assets/images/header-image') !== false ? $ath_options['header_image']['url'] : wp_get_attachment_image_src($ath_options['header_image']['id'],'ath-thumb-large')[0] );

    $header_bg_image   = !is_customize_preview() ? $header_image : $emp['home_header_img'];
    $header_bg         = !empty($ath_options['header_image']['url']) ? $header_bg_image : $emp['home_header_img'];
    $header_bg_type    = $ath_options['header_bg'];
    $header_title      = $ath_options['header_title'];
    $header_subtitle   = $ath_options['header_subtitle'];
    $header_button     = $ath_options['header_button'];
    $header_button_url = $ath_options['header_button_url'];

 ?>

<?php if ($header_type == 'full'): ?>
<?php get_template_part( 'template-parts/ath-header', 'internal' ); ?>
<?php endif; ?>

<header id="ath-header" class="jumbo <?php echo $header_type .' '. $header_content; ?> <?php echo ( $mob->isMobile() ? 'pt-0':'' );  ?> <?php echo ($header_content == 'posts' && $header_type != 'transparent') ? 'py-0':'pb-0'; ?>" style="background:linear-gradient(-175deg, <?php echo $header_color1;  ?> 0%, <?php echo $header_color2; ?> 99%); <?php echo (is_phone() && $header_bg_type == 'full') ? 'background: url('. $header_bg_image .') no-repeat center center !important; background-size: cover !important;' : ''; ?>">

  <?php if($header_content == 'posts'): 
      $n = 1;
      $args = array('posts_per_page' => ( $mob->isMobile() && !$mob->isTablet() ? 1 : 2 ));
      $featured = apply_filters( 'get_posts_content', $args );
      if($featured[0]->found_posts > 0):
  ?>

    <?php if ($header_type == 'transparent' && $mob->isMobile() && !is_tablet()): ?>
      <?php //get_template_part( 'template-parts/ath-header', 'nav' ); ?>
    <?php endif ?>
    
    <div class="recents-posts <?php echo $header_type == 'transparent' ? 'header-transparent':''; ?>">

    <?php foreach ( $featured as $card ) :  
      $post->card = $card;
      if($ath_options['layout_thumbnails'] == 'transparent'):
    ?> 
          
      <article <?php echo $post->card->color ? 'style="background-color: ' . $post->card->color . ';"' : ''; ?>>
        <?php if(!$mob->isMobile()): ?>
          <a href="<?php echo $post->card->permalink; ?>"><div class="coverpost"></div></a>
        <?php endif; ?>
        <div class="wrapper">
          <div class="wrapper-content <?php echo $n == 2 ? 'left pl-5': ($mob->isMobile() && !$mob->isTablet() ? 'right pr-5 pl-5' : 'right pr-5' ) ; ?>">
            
          <?php  ?>
            <?php if($n == 1): ?>
              <div class="column">
                <?php if ( $post->card->thumbnail ) : ?>
                <img src="<?php echo $post->card->thumbnail_medium[0];; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>" class="<?php echo $post->card->thumbnail_type; ?> hidden-sm">
                <?php endif; ?>
              </div>
              <div class="column">
                <div class="wrapper-column">
                  <h5 class="font-uppercase font-13 ath-color-white ath-font-text-weight"><?php echo $post->card->categories[0]->name; ?></h5>
                  <h2 class=" mt-2 mb-5 ath-font-header ath-font-header-weight font-28 lh-33 ath-color-white"><?php echo ath_trim_text( $post->card->title, 100 ); ?></h2>
                  <a href="<?php echo $post->card->permalink; ?>" class="button outline small white px-4">Leia mais</a>
                </div>
              </div>
            <?php endif; ?>

            <?php if($n == 2): ?>
              <div class="column">
                <div class="wrapper-column">
                  <h5 class="font-uppercase font-13 ath-color-white ath-font-text-weight"><?php echo $post->card->categories[0]->name; ?></h5>
                  <h2 class=" mt-2 mb-5 ath-font-header ath-font-header-weight font-28 lh-33 ath-color-white"><?php echo ath_trim_text( $post->card->title, 100 ); ?></h2>
                  <a href="<?php echo $post->card->permalink; ?>" class="button outline small white px-4">Leia mais</a>
                </div>
              </div>
              <div class="column">
                <?php if ( $post->card->thumbnail ) : ?>
                <img src="<?php echo $post->card->thumbnail_medium[0];; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>" class="<?php echo $post->card->thumbnail_type; ?> hidden-sm">
                <?php endif; ?>
              </div>
            <?php endif; ?>
                
          </div>
        </div>
      </article>

    <?php else: ?>
    
      <article class="ath-background position-top-center size-cover has-overlay" style="background-image: url(<?php echo $post->card->thumbnail_medium[0];; ?>);">
        <?php if(!$mob->isMobile()): ?>
          <a href="<?php echo $post->card->permalink; ?>"><div class="coverpost"></div></a>
        <?php endif; ?>
        <div class="wrapper">
          <div class="wrapper-content <?php echo $n == 2 ? 'left pl-5' : ($mob->isMobile() && !$mob->isTablet() ? 'right pr-5 pl-5' : 'right pr-5' ) ; ?>">          
            
          <?php if($n == 1): ?>
            <div class="column hidden-sm"></div>         
            <div class="column">
              <div class="wrapper-column pr-4 <?php echo is_tablet() ? 'pl-4':''; ?>">
                <h5 class="font-uppercase font-13 ath-color-white ath-font-text-weight"><?php echo $post->card->categories[0]->name; ?></h5>
                <h2 class=" mt-2 mb-4 ath-font-header ath-font-header-weight font-28 lh-33 lh-30-xs ath-color-white"><?php echo ath_trim_text( $post->card->title, 100 ); ?></h2>
                <a href="<?php echo $post->card->permalink; ?>" class="button outline small white px-4">Leia mais</a>
              </div>
            </div>
          <?php endif; ?>

           <?php if($n == 2): ?>
            <div class="column">
              <div class="wrapper-column pr-4">
                <h5 class="font-uppercase font-13 ath-color-white ath-font-text-weight"><?php echo $post->card->categories[0]->name; ?></h5>
                <h2 class=" mt-2 mb-4 ath-font-header ath-font-header-weight font-28 lh-33 lh-30-xs ath-color-white"><?php echo ath_trim_text( $post->card->title, 100 ); ?></h2>
                <a href="<?php echo $post->card->permalink; ?>" class="button outline small white px-4">Leia mais</a>
              </div>
            </div>
            <div class="column hidden-sm"></div>      
          <?php endif; ?>
          
          </div>
        </div>
      </article> 

    <?php 
      endif;
      $n++;
      endforeach; 
    ?>
    
    
    </div>
  
    <?php endif; ?>
  <?php endif; ?>

  <?php if(!empty($header_bg) && $header_content != 'posts' && !is_phone()): ?>
    <div class="cover <?php echo $header_bg_type == 'picture' ? 'picture':' full'; ?>">
      <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $header_bg; ?>" class="lazy animated fadeIn" alt="<?php echo esc_attr( get_bloginfo( 'title', 'display' ) ); ?>">
    </div>
  <?php endif ?>

  <?php if ($header_type == 'transparent'): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php //get_template_part( 'template-parts/ath-header', 'mobile-nav' ); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="container">
    <?php if ($header_type == 'transparent'): ?>
      <?php get_template_part( 'template-parts/ath-header', 'nav' ); ?>
    <?php endif ?>
    <?php if ($header_content == 'feature'): ?>
      <!-- TOPO DETAQUE -->
      <div class="row">
        <div class="col-md-5 col-sm-6">
          <div class="cta animated fadeIn <?php echo is_phone() ? 'mt-6 mb-5':''; ?>">
            <div class="wrapper">
              <?php if ($header_subtitle) : ?>
                <h3><?php echo $header_subtitle; ?></h3>
              <?php endif; ?>
              <?php if ($header_title) : ?>
                <h1><?php echo $header_title; ?></h1>
              <?php endif; ?>
              <?php if ( !empty($header_button) && !empty($header_button_url) ) : ?>
                <a href="<?php echo $header_button_url; ?>" class="button outline white rpp medium"><?php echo $header_button; ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-7 col-sm-6">
          <?php if(!empty($header_bg) && $header_content != 'posts' && is_phone() && $header_bg_type != 'full'): ?>
            <div class="featured-image-mobile">
              <img src="<?php echo $header_bg; ?>" class="animated fadeIn" alt="<?php echo esc_attr( get_bloginfo( 'title', 'display' ) ); ?>">
            </div>
          <?php endif ?>        
        </div>
      </div>
    <?php else: ?>
      <!-- TOPO POSTS RECENTES -->
        <div class="row <?php echo ( $header_content == 'posts' && ($mob->isMobile() && !$mob->isTablet()) ? 'hidden-xs' : '' ); ?>">
          <div class="col-md-12">
            <div class="cta">
              <div class="wrapper">
              </div>
            </div>
          </div>
        </div>
    <?php endif ?>
    <div class="row relative">
      <div class="col-md-12">
        <?php get_template_part( 'template-parts/ath-cta', 'header' ); ?>
      </div>
    </div>
  </div>
</header>