<?php 
  global $ath_options; 
  $color_mode = $ath_options['color_mode'];

?>

<div class="ath-social-links <?php echo ( $color_mode == 'dark' ? 'light' : '' ); ?>">
	<?php if(!empty($ath_options['social_whatsapp'])): ?>
	<a href="<?php echo $ath_options['social_whatsapp']; ?>" target="_blank"><i class="icon whatsapp"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_youtube'])): ?>
	<a href="<?php echo $ath_options['social_youtube']; ?>" target="_blank"><i class="icon youtube play"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_facebook'])): ?>
	<a href="<?php echo $ath_options['social_facebook']; ?>" target="_blank"><i class="icon facebook square"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_instagram'])): ?>
	<a href="<?php echo $ath_options['social_instagram']; ?>" target="_blank"><i class="icon instagram"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_twitter'])): ?>
	<a href="<?php echo $ath_options['social_twitter']; ?>" target="_blank"><i class="icon twitter"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_linkedin'])): ?>
	<a href="<?php echo $ath_options['social_linkedin']; ?>" target="_blank"><i class="icon linkedin"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_googleplus'])): ?>
	<a href="<?php echo $ath_options['social_googleplus']; ?>" target="_blank"><i class="icon google plus"></i></a>
	<?php endif; ?>
	<?php if(!empty($ath_options['social_pinterest'])): ?>
	<a href="<?php echo $ath_options['social_pinterest']; ?>" target="_blank"><i class="icon pinterest square"></i></a>
	<?php endif; ?>	
</div>