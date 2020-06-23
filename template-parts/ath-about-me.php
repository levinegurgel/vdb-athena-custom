<?php   
  global $emp;
  $mob = new Mobile_Detect;
  $salut  = get_field('home_about_salutation');
  $text   = get_field('home_about_text');
  $text_color = get_field('home_about_text_color');
  $background = get_field('home_about_bg');
  $image  = !empty(get_field('home_about_image')) ? get_field('home_about_image')['sizes']['ath-thumb-large'] : $emp['home_about_image'];
  $assign = get_field('home_about_assign');
?>
<style>.ath-home-about p{color: <?php echo $text_color; ?> !important;}</style>
<section class="ath-section ath-home-about col-2 gray py-0 <?php echo $mob->isMobile() && !$mob->isTablet() ? 'mt-6':''; ?>" style="background-color: <?php echo $background; ?>;" >
  <div class="columns">
    <div class="wrapper <?php echo ( is_phone() or is_tablet() ) ? 'px-5 py-6':'px-8 py-6'; ?>">
      <h2 class="ath-font-serif font-28 mb-3" style="color: <?php echo $text_color; ?>;"><?php echo empty($salut) ? 'Olá' : $salut; ?></h2>
      <?php if (!empty($text)): ?>
        <p><?php echo $text; ?></p>
      <?php else: ?>
        <p>Insira algum texto de apresentação sobre você ou seu projeto.</p>
      <?php endif ?>
      <hr style="color: <?php echo $text_color; ?>;">
      <h6 style="color: <?php echo $text_color; ?>;"><?php echo empty($assign) ? 'Sua assinatura aqui' : $assign; ?></h6>
    </div>
  </div>
  <div class="lazy columns ath-background no-repeat dyn-bg position-<?php echo empty($image) ? 'center' : 'top'; ?>-center size-cover" data-bg="url(<?php echo empty($image) ? ath_no_thumb('') : $image; ?>)">
    <div class="wrapper"></div>
  </div>
</section>