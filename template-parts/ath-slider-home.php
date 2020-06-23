<?php 
  global $emp;
  $mob = new Mobile_Detect;
  $count = 1;
?>
<?php if ( have_rows( 'home_slides' ) ) : ?>
<section class="ath-slide jumbo owl-theme owl-carousel <?php echo ( $mob->isMobile() && !$mob->isTablet() ? 'mt-6 mb-5' : 'margin-top-50' ); ?>" data-morelink="<?php echo get_field('home_slides_more'); ?>">
  <?php while ( have_rows( 'home_slides' ) ) : the_row(); ?>
  <div class="item" id="ath-home-slider-slide-<?php echo $count;?>">
    
    <!-- INÍCIO SLIDE -->

    	<?php 
    		$bg 				  = get_sub_field('bg');
    		$title  		  = get_sub_field('title');
    		$subtitle 	  = get_sub_field('subtitle');
    		$description  = get_sub_field('description');
    		$button_label = empty(get_sub_field('button_label')) ? 'Saiba mais' : get_sub_field('button_label');
    		$button_url		= get_sub_field('button_url');
    		$color1 			= $bg == 'picture' ? '#3e464f' : get_sub_field('color1');
    		$color2 			= $bg == 'picture' ? '#3e464f' : get_sub_field('color2');
        $color3       = get_sub_field('color3');
        $bg_size      = is_phone() ? 'ath-thumb-medium' : 'ath-thumb-mega';
    		$image_bg			= !empty(get_sub_field('image')) ? get_sub_field('image')['sizes'][$bg_size] : $emp['home_slider_thumb'];
    		$image 				= !empty(get_sub_field('image')) ? get_sub_field('image')['sizes']['ath-thumb-medium'] : $emp['home_slider_thumb'];
    	?>

    <style>
      #ath-home-slider-slide-<?php echo $count;?> h3{color: <?php echo $color3; ?>;}
      #ath-home-slider-slide-<?php echo $count;?> h2{color: <?php echo $color3; ?>;}
      #ath-home-slider-slide-<?php echo $count;?> p{color: <?php echo $color3; ?>;}
      #ath-home-slider-slide-<?php echo $count;?> a{color: <?php echo $color3; ?>; border-color: <?php echo $color3; ?>;}
      #ath-home-slider-slide-<?php echo $count;?> a:hover{color: <?php echo $color3; ?>; border-color: <?php echo $color3; ?>;}
    </style>
		<div class="ath-banner green col-2" data-color-ref="<?php echo $bg == 'picture' ? $color3 : $color1; ?>">
		  <div class="background" style="background:linear-gradient(-175deg, <?php echo $color1; ?> 0%, <?php echo $color2; ?> 99%);"></div>
		  <?php if (!empty($image_bg) && $bg == 'picture'): ?>
		  	<div class="background no-repeat ath-background size-cover" <?php echo $image_bg ? 'style="background-image: url(' . $image_bg . ');"' : ''; ?>></div>
		  <?php endif; ?>
		  <div class="container">
		    <div class="row">
		      <?php if (!empty($image) && $bg == 'gradient' && !$mob->isMobile() ): ?>
		      <div class="col-md-6 visible-xs">
		        <div class="wrapper">
		          <div class="vertical-middle">
		            <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $image; ?>" class="lazy" alt="<?php echo esc_attr( $title ); ?>">
		          </div>
		        </div>
		      </div>
		      <?php endif; ?>
		      <div class="col-md-6 col-sm-6">
		        <div class="wrapper <?php echo !is_phone() ? 'no-margin':''; ?>">
		          <div class="vertical-middle">
                <?php if (!empty($image) && $bg == 'gradient' && $mob->isMobile() ): ?>
                <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $image; ?>" class="visible-xs lazy" alt="<?php echo esc_attr( $title ); ?>">
                <?php endif; ?>
		            <?php if ( $subtitle ) : ?>
		            <h3><?php echo $subtitle; ?></h3>
		            <?php endif; ?>
		            <?php if ( $title ) : ?>
		            <h2><?php echo $title; ?></h2>
		            <?php endif; ?>
		            <?php if ( $description ) : ?>
		            <p class="lh-35"><?php echo $description; ?></p>
		            <?php endif; ?>
		            <?php if ( $button_label && $button_url ) : ?>
		            <a href="<?php echo $button_url; ?>" class="button outline white rpp <?php echo is_phone() ? 'small':'medium'; ?>"><?php echo $button_label; ?></a>
		            <?php endif; ?>
		          </div>
		        </div>
		      </div>
		      <div class="col-md-6 col-sm-6 hidden-xs">
		        <div class="wrapper">
		          <div class="vertical-middle">
		            <?php if (!empty($image) && $bg == 'gradient'): ?>
		            <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $image; ?>" class="lazy" alt="<?php echo esc_attr( $title ); ?>">
		            <?php endif; ?>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>



    <!-- FIM SLIDE -->

  </div>
  <?php $count++; ?>
  <?php endwhile; ?>
</section>
<?php endif; ?>