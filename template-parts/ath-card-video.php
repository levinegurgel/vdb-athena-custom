<?php
  $thumb_type  = get_field('material_thumbnail_type',$post->card->ID);
  $thumb_image = get_field('material_thumbnail',$post->card->ID);

 if(!empty($thumb_image)){
  $thumb_image = $thumb_image['sizes']['ath-thumb-small'];
 } 

  $card_style  = $thumb_type == 'transparent' ? 'background-color:'.$post->card->color.';' : 'background: url('. (!empty($thumb_image) ? $thumb_image : ath_no_thumb('',true)) .') no-repeat center center '. $post->card->color .'; background-size: cover;';

?>

<article class="ath-card paper rounded">
  <a href="<?php echo $post->card->permalink; ?>">
    <div class="overlay video inherit" style="<?php echo $card_style; ?>">
      <div class="wrapper">
        <?php if ($thumb_type == 'transparent'): ?>
          <img src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $thumb_image; ?>" class="mw-60 lazy" alt="<?php echo $post->card->title; ?>"> 
        <?php endif ?>
      </div>
    </div>
  </a>
  <div class="title w-100 p-relative">
    <a href="<?php echo $post->card->permalink; ?>">
      <span class="covertitle"></span>
    </a>
    <h4><?php echo $post->card->title; ?></h4>
  </div>
</article>