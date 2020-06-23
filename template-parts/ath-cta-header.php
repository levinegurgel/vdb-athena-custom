<?php 
  
  global $ath_options;
  $mob = new Mobile_Detect;

  $status = $ath_options['capture_header_status'];
  $subtitle = $ath_options['capture_header_subtitle'];
  $headline = $ath_options['capture_header_title'];
  $field_name_status = $ath_options['capture_header_name_status'];
  $field_name = $ath_options['capture_header_name'];
  $field_mail = $ath_options['capture_header_mail'];
  $service = $ath_options['capture_header_service'];

  if($status == TRUE):
?>
<div class="ath-cta horizontal-2col-form <?php echo $field_name_status ==  true ? 'has-name':''; ?> <?php echo ( is_single() && !empty(get_the_post_thumbnail_url(get_the_ID())) ? 'mt-0 no-float':'' ); ?> <?php echo $mob->isMobile() && !$mob->isTablet() ? ( is_single() ? 'px-3' : 'pl-5' ) : ''; ?> <?php echo is_phone() ? ' pr-4 ':''; ?>">
  <div class="row">
    <?php if ( is_page_template( array( 'index.php', 'archive.php' ) ) ) : ?>
      <div class="<?php echo $field_name_status == true ? 'col-md-4':'col-md-6' ?> col-sm-5">
    <?php else: ?>
      <div class="<?php echo $field_name_status == true ? 'col-md-4':'col-md-6' ?>">
    <?php endif; ?>
      <?php if (!empty($subtitle)): ?>
        <h5><?php echo $subtitle ?></h5>
      <?php endif; ?>
      <?php if (!empty($headline)): ?>
        <h3 class="font-bold"><?php echo $headline; ?></h3>
      <?php endif; ?>
    </div>

    <?php if ( is_page_template( array( 'index.php', 'archive.php' ) ) ) : ?>
      <div class="<?php echo $field_name_status == true ? 'col-md-8':'col-md-6' ?> col-md-offset-1 col-sm-7 <?php echo !$mob->isMobile() ? 'col-form-relative':''; ?>">
    <?php else: ?>
      <div class="<?php echo $field_name_status == true ? 'col-md-8':'col-md-6' ?> <?php echo !$mob->isMobile() ? 'col-form-relative':''; ?>">
    <?php endif; ?>
      <?php echo ath_capture_form($service,'header',false,'ath-cta-capture-header'); ?>
    </div>
  </div>
</div>

<?php endif; ?>