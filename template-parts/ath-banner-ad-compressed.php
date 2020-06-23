<?php
$bg = array_filter(array(
  $post->banner->image_bg ? 'url(' . $post->banner->image_bg . ') repeat-x center bottom' : '',
  $post->banner->color1 ? 'linear-gradient(-175deg, ' . $post->banner->color1 . ' 0%, ' . ( $post->banner->color2 ? $post->banner->color2 : $post->banner->color1 ) . ' 99%)' : '',
));
if ( ! empty( $bg ) ) {
  $bg = 'style="background: ' . implode( ', ', $bg ) . ';"';
} else {
  $bg = false;
}
?>

<div class="compress">

  <!-- INICIO BANNER -->
  <div class="ath-cta horizontal-2col-form mini-color ad-banner-compressed pointer" <?php echo $bg ? $bg : ''; ?> data-link="<?php echo $post->banner->cta_link; ?>">
    <div class="row">
      <div class="col-md-9 col-sm-12">
        <div class="wrapper">
          <div class="content">
            <?php if ( $post->banner->subtitle ) : ?>
            <h5><?php echo $post->banner->subtitle; ?></h5>
            <?php endif; ?>
            <?php if ( $post->banner->title ) : ?>
            <h3><?php echo $post->banner->title; ?></h3>
            <?php endif; ?>
            <?php if ( $post->banner->cta_link && $post->banner->cta_text ) : ?>
            <a href="<?php echo $post->banner->cta_link; ?>" class="button outline white rpp margin-top-10"><?php echo $post->banner->cta_text; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="wrapper">
          <div class="content">
            <?php if ( $post->banner->image ) : ?>
            <img src="<?php echo $post->banner->image; ?>" alt="<?php echo esc_attr( $post->banner->title ); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FIM BANNER -->

</div>