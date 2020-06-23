<?php 
  global $ath_options;
  $mob = new Mobile_Detect;
  $header_class = '';
  $header_type = $ath_options['header_type'];
  if(is_home() or is_front_page()){
    $header_class = $header_type != 'full' ? 'pt-4':'';
  }
?>
<div class="row ath-header-nav <?php echo is_tablet() ? $header_class : ''; ?>">
  <div class="<?php echo is_phone() ? 'col-md-12' : 'col-md-3'; ?> col-xs-12 col-sm-2">
    <a class="ath-go-home" href="<?php echo home_url( '/' );?>">
      <?php
        if((is_front_page() && $header_type == 'full')){
          $brand = ( $ath_options['color_mode'] == 'light' ? 'brand' : 'brand_mono' );
        }else if(!is_front_page()){
          $brand = ( $ath_options['color_mode'] == 'light' ? 'brand' : 'brand_mono' );
        }else{
          $brand = 'brand_mono';
        }
        if(is_singular('material')){
          $qo = get_queried_object();
          if(!empty($qo->banner->types)){
            if($qo->banner->types[0]->slug == 'ebooks' or $qo->banner->types[0]->slug == 'infograficos'){
              $brand = 'brand_mono';
            }
          }
        }
      ?>
      <figure class="brand">
        <?php if(!empty($ath_options[$brand]['url'])): ?>
          <img <?php echo empty($image) ? ath_no_thumb('') : $image; ?> src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $ath_options[$brand]['url']; ?>" alt="<?php echo get_bloginfo('name'); ?>" class="lazy"> 
        <?php else: ?>
          <h5><?php echo get_bloginfo('name'); ?></h5>
        <?php endif; ?>
      </figure>
    </a>
    <!-- MENU MOBILE  -->
    <?php 
      // if($header_type == 'transparent'):
        get_template_part( 'template-parts/ath-header', 'mobile-nav' );
      // endif; 
    ?>
  </div>
  <div class="col-md-7 col-md-offset-2 col-sm-10 hidden-xs">
    <div class="nav-wrapper">
      <?php 
        if(has_nav_menu('topo')){
          wp_nav_menu(array(
            'theme_location'  => 'topo',
            'menu_class'      => 'ui menu secondary',
            'items_wrap'      => '<nav id="%1$s" class="%2$s">%3$s '. ath_nav_top_fixed_options() .'</nav>',
            'depth'           => 3,
            'walker'          => new \semantic\walker\nav_menu
          ));
        }
      ?>
    </div>
  </div>
</div>