<?php 
  $mob = new Mobile_Detect;
?>
<header id="ath-header" class="internal default border-top <?php echo ( $mob->isMobile() && !$mob->isTablet() ? 'px-2' : ''); ?>">
  <div class="container">
    <?php get_template_part( 'template-parts/ath-header', 'nav' ); ?>
  </div>
</header>