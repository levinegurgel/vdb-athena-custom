<?php
  global $emp;   
  $bg         = get_field('home_promo_bg');
  $image      = !empty(get_field('home_promo_image')) ? get_field('home_promo_image')['sizes']['ath-thumb-medium'] : $emp['home_about_image'];
  $header     = get_field('home_promo_header');
  $text       = get_field('home_promo_text');
  $button     = get_field('home_promo_button');
  $button_url = get_field('home_promo_button_url');
?>
<section class="ath-section ath-home-about col-2 gray py-0" >
  <div class="columns" style="background-color:<?php echo $bg; ?>;">
    <div class="wrapper <?php echo !is_phone() && !is_tablet() ? 'px-8':''; ?> <?php echo is_phone() ? 'px-5':''; ?> <?php echo is_tablet() ? 'px-4':''; ?>">
      <h2 class="ath-font-header font-30 <?php echo is_phone() ? 'lh-50':'lh-35'; ?> mb-3 ath-color-white"><?php echo $header; ?></h2>
      <h3 class="ath-font-header font-24 <?php echo is_phone() ? 'lh-50':'lh-35'; ?> mb-3 ath-color-white"><?php echo $text; ?></h3>
      <a class="button outline medium rpp white mt-3" href="<?php echo $button_url; ?>"><?php echo $button; ?></a>
    </div>
  </div>
  <div class="columns ath-background no-repeat position-<?php echo empty($image) ? 'center' : 'top'; ?>-center size-cover lazy" data-bg="url(<?php echo empty($image) ? ath_no_thumb('') : $image; ?>)">
    <div class="wrapper"></div>
  </div>
</section>