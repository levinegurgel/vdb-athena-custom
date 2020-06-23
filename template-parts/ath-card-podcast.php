<?php
  $thumb_type  = get_field('material_thumbnail_type',$post->card->ID);
  $thumb_image = get_field('material_thumbnail',$post->card->ID);
  if(!empty($thumb_image)){
   $thumb_image = $thumb_image['sizes']['ath-thumb-square'];
  } 
?>
<article class="ath-card linear border-bottom p-relative">
  <a href="<?php echo $post->card->permalink; ?>">
    <div class="coverlink"></div>
  </a>
  <div class="overlay primary audio">
    <a href="<?php echo $post->card->permalink; ?>">
      <?php if (!empty($thumb_image)): ?>
        <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $thumb_image; ?>" class="lazy animate fadeIn" alt="<?php echo $post->card->title; ?>">
      <?php else: ?>
        <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo ath_no_thumb('square'); ?>" alt="<?php echo $post->card->title; ?>" class="lazy">
      <?php endif; ?>
    </a>
  </div>
  <h4><a href="<?php echo $post->card->permalink; ?>"><?php echo $post->card->title; ?></a></h4>
</article>