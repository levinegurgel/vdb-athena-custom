<?php 
  
  global $ath_options;
  
  $mob = new Mobile_Detect;
  $status = $ath_options['capture_footer_status'];
  $subtitle = $ath_options['capture_footer_subtitle'];
  $headline = $ath_options['capture_footer_title'];
  $field_name_status = $ath_options['capture_footer_name_status'];
  $field_name = $ath_options['capture_footer_name'];
  $field_mail = $ath_options['capture_footer_mail'];
  $service = $ath_options['capture_footer_service'];
  $style   = '';
  $classes = array();

  if(!is_front_page()){
    array_push($classes,'gray');
  }
  if(is_front_page()){
    array_push($classes,( $mob->isMobile() && !$mob->isTablet() ? 'my-5' : 'py-8' ));
  }
  if(is_page() or is_archive()){
    array_push($classes,( $mob->isMobile() && !$mob->isTablet() ? 'my-5' : '' ));
  }
  foreach ($classes as $k => $v) {
    $style .= ' '.$v.' ';
  }

  if($status == TRUE):?>
<section class="ath-section ath-home-cta ath-cta-footer push bottom top medium <?php echo $style; ?>">
  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 <?php echo is_tablet() ? 'col-sm-9 col-centered':''; ?> <?php echo is_phone() ? 'px-0':''; ?>">
          <div class="ath-cta vertical center <?php echo is_phone() ? 'px-0':''; ?>">
            <?php if (!empty($headline)): ?>
              <h3 class="lh-35 lh-33-xs"><?php echo $headline; ?></h3>
            <?php endif; ?>
            <?php if (!empty($subtitle)): ?>
              <p class="ath-font-primary font-19 font-16-xs"><?php echo $subtitle; ?></p>
            <?php endif; ?>
            <?php echo !$mob->isMobile() ? '<div class="ghost mb-3"></div>':'<div class="ghost mb-2"></div>'; ?>
            <?php echo is_tablet()  ? '<div class="ghost mb-4"></div>':''; ?>
            <?php echo ath_capture_form($service,'footer',false,'ath-cta-capture-footer'); ?>
          </div>
        </div>
    </div>
  </div>
</section>
<?php 
  endif;
?>