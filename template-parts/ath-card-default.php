<?php $nothumb = ( $post->card->thumbnail_type == 'transparent' ? ' no-thumb transparent ': ' no-thumb ' ); ?>
<article class="ath-card simple <?php echo $post->card->thumbnail_type == 'transparent' ? 'thumb-transparent':'thumb-full'; ?>">
  <a href="<?php echo $post->card->permalink; ?>">
    <div class="wrapper <?php echo $post->card->thumbnail ? '' : $nothumb; ?>" <?php echo $post->card->color ? 'style="background-color: ' . $post->card->color . ' !important;"' : ''; ?>>
      <?php if ( $post->card->thumbnail ) : ?>
      <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $post->card->thumbnail_small[0]; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>" class="lazy <?php echo $post->card->thumbnail_type; ?>">
      <?php endif; ?>
    </div>
  </a>
  <span><a href="<?php echo $post->card->permalink; ?>"><?php echo $post->card->categories[0]->name; ?></a></span>
  <h4><a href="<?php echo $post->card->permalink; ?>" title="<?php echo esc_attr( $post->card->title ); ?>"><?php echo ath_trim_text( $post->card->title, 100 ); ?></a></h4>
</article>