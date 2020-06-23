<div class="ath-banner green col-2" data-color-ref="<?php echo $post->banner->color1; ?>">
  <div class="background" style="background:linear-gradient(-175deg, <?php echo $post->banner->color1; ?> 0%, <?php echo $post->banner->color2; ?> 99%);"></div>
  <div class="background repeat-x position-bottom-center" <?php echo $post->banner->image_bg ? 'style="background-image: url(' . $post->banner->image_bg . ');"' : ''; ?>></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 visible-xs">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->image ) : ?>
            <img src="<?php echo $post->banner->image; ?>"  alt="<?php echo esc_attr( $post->banner->title ); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->subtitle ) : ?>
            <h3><?php echo $post->banner->subtitle; ?></h3>
            <?php endif; ?>
            <?php if ( $post->banner->title ) : ?>
            <h2><?php echo $post->banner->title; ?></h2>
            <?php endif; ?>
            <?php if ( $post->banner->description ) : ?>
            <p><?php echo $post->banner->description; ?></p>
            <?php endif; ?>
            <?php if ( $post->banner->cta_link && $post->banner->cta_text ) : ?>
            <a href="<?php echo $post->banner->cta_link; ?>" class="button outline white rpp medium"><?php echo $post->banner->cta_text; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 hidden-xs">
        <div class="wrapper">
          <div class="vertical-middle">
            <?php if ( $post->banner->image ) : ?>
            <img src="<?php echo $post->banner->image; ?>" alt="<?php echo esc_attr( $post->banner->title ); ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>