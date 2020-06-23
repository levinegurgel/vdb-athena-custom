

<div class="ath-banner purple col-2 ad-full rounded">
  <div class="background" style="background:linear-gradient(-175deg, <?php echo $post->banner->color1; ?> 0%, <?php echo $post->banner->color2; ?> 99%);"></div>
  <div class="background no-repeat position-bottom-center" <?php echo $post->banner->image_bg ? 'style="background-image: url(' . $post->banner->image_bg . ');"' : ''; ?>></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 visible-xs">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->image ) : ?>
            <img src="<?php echo $post->banner->image; ?>" class="animated fadeIn" alt="<?php echo esc_attr( $post->banner->title ); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-md-offset-1 col-sm-6">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->subtitle ) : ?>
            <h3><?php echo $post->banner->subtitle; ?></h3>
            <?php endif; ?>
            <?php if ( $post->banner->title ) : ?>
            <h2><?php echo $post->banner->title; ?></h2>
            <?php endif; ?>
            <?php if ( $post->banner->cta_link && $post->banner->cta_text ) : ?>
            <a href="<?php echo $post->banner->cta_link; ?>" class="button medium outline white rpp margin-top-40-xs"><?php $post->banner->cta_text; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-5 hidden-xs">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->image ) : ?>
            <img src="<?php echo $post->banner->image; ?>" class="animated flipInY" alt="<?php echo esc_attr( $post->banner->title ); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>