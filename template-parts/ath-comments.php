<?php 
  global $ath_options;
  $mob = new Mobile_Detect; 
?>
<?php if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) : ?>

<div id="ath-comments" class="ath-call horizontal <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-3':''; ?>">
  <h3 class="ath-font-header font-30"><?php echo $ath_options['article_comments_title'] ?></h3>
  <p class="ath-font-serif font-21"><?php echo $ath_options['article_comments_description'] ?></p>
</div>

<div class="ath-comments">
  <?php 
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
  ?>
</div>

<?php endif; ?>