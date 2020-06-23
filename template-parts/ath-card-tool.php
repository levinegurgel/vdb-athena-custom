<article class="ath-card simple-color rounded" <?php echo $post->card->color ? 'style="background-color: ' . $post->card->color . '"' : ''; ?>>
  <a href="<?php echo $post->card->link; ?>">
    <img src="<?php echo $post->card->thumbnail; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>">
    <span><?php echo $post->card->categories[0]->name; ?></span>
    <h5><?php echo $post->card->title; ?></h5>
  </a>
</article>