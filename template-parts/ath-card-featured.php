<?php $mob = new Mobile_Detect; ?>
<a href="<?php echo $post->card->permalink; ?>" class="no-decoration">
  <?php 
      $thumbnail  = ( !empty($post->card->thumbnail) ? $post->card->thumbnail_medium[0] : '' );
      $background = ( $post->card->thumbnail_type == 'fill' ? 'data-bg="url('. $thumbnail .')" style="no-repeat center center '. $post->card->color .'; background-size: cover;"' : 'style="background-color:'.$post->card->color.'"' );
   ?>
  <article class="ath-card simple-color horizontal lazy" <?php echo $background; ?> >
    <div class="wrapper">
      <span><?php echo $post->card->categories[0]->name; ?></span>
      <h5><?php echo $post->card->title; ?></h5>
    </div>
    <?php if ( $post->card->thumbnail && $post->card->thumbnail_type !== 'fill' ) : ?>
    <div class="wrapper">
      <img class="lazy" src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $post->card->thumbnail_medium[0]; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>">
    </div>
    <?php endif; ?>
  </article>
</a>
