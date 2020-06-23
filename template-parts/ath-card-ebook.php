<?php
  $thumb_type  = get_field('material_thumbnail_type',$post->card->ID);
  $thumb_image = get_field('material_thumbnail',$post->card->ID);

  if(!empty($thumb_image)){
   $thumb_image = $thumb_image['sizes']['ath-thumb-small'];
  } 

  $card_style  = $thumb_type == 'transparent' ? 'background-color:'.$post->card->color.';' : 'background: url('. (!empty($thumb_image) ? $thumb_image : ath_no_thumb('portrait',true)) .') no-repeat top center '. $post->card->color .'; background-size: '. (!empty($thumb_image) ? 'cover' : 'contain').';';

?>
<article class="ath-card ebook" style="<?php echo $card_style; ?>">
  <a href="<?php echo $post->card->permalink; ?>" title="<?php echo esc_attr( $post->card->title ); ?>">
    <div class="wrapper">
      <div class="info">
        <?php if ($thumb_type != 'full'): ?>
          <h4><?php echo esc_attr( $post->card->title ); ?></h4>
        <?php endif ?>
      </div>
      <?php if ($thumb_type == 'transparent'): ?>
        <div class="background">
          <?php if (!empty($thumb_image)): ?>
            <img class="lazy" src="<?php echo ATH_LAZY; ?>" data-src="<?php echo $thumb_image; ?>" alt="<?php echo esc_attr( $post->card->title ); ?>">
          <?php endif ?>
        </div>
      <?php endif ?>
    </div>
  </a>
</article>