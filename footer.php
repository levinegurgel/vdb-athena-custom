		<?php global $ath_options; ?>
		<?php $mob = new Mobile_Detect; ?>
		<?php get_template_part( 'template-parts/ath', 'share' ); ?>		


		<?php if ( is_active_sidebar( 'footer' ) ): ?>
      <?php  
        $widgets = wp_get_sidebars_widgets();
        $n_widgets = count($widgets['footer']);
        if($n_widgets > 0): 
      ?>
			<section class="ath-section ath-home-lists push bottom small <?php echo ( $ath_options['capture_footer_status'] == false ? 'mt-7':'' ); ?>">
			  <div class="container">
			    <div class="row">
			        <div class="col-md-12">
                <?php 
                  if($n_widgets == 0){$class_col = 'default';}
                  if($n_widgets > 0 && $n_widgets <= 3){$class_col = 'col-3';}
                  if($n_widgets > 3 && $n_widgets <= 4){$class_col = 'col-4';}
                  if($n_widgets > 4){$class_col = 'col-5';}
                ?>
				       	<div class="ath-list-wrapper <?php echo $class_col; ?> <?php echo (( is_home() or is_front_page() ) ? 'pt-0 pb-3' : 'pt-6 pb-3'); ?> <?php echo $mob->isMobile() && !$mob->isTablet() ? '':''; ?>">
	                <?php
	                	if ( is_active_sidebar( 'footer' ) ) :
		                 dynamic_sidebar( 'footer' );
		                endif;
	                ?>
				         </div>
			        </div>
			    </div>
			  </div>
			</section>
      <?php endif; ?>
		<?php endif; ?>
		
		<footer class="ath-footer default padding-bottom-80 <?php echo !is_active_sidebar( 'footer' ) ? 'mt-4':''; ?>">
		  <div class="container">
		    <div class="row">
		      <div class="col-md-12">
		        <figure></figure>
		      </div>
		    </div>
		    <div class="row">
		      <div class="col-md-12 my-4">
		      	<p><?php echo $ath_options['footer_copyright']; ?></p>
		      </div>
		    </div>
		    <div class="row">
		      <div class="col-md-4 col-md-offset-4">
					<div class="social pt-3 pb-5">
						<?php get_template_part( 'template-parts/ath', 'social-links' ) ?>
					</div>
		      </div>
		    </div>
		  </div>
		</footer>


		<?php 
			wp_footer();
			get_template_part( 'template-parts/ath', 'footer-scripts' );
      if(is_page() or is_single() or is_singular()){
        global $post;
        echo get_field('single_scripts_footer',$post->ID);
      }
		?>

	</body>
</html>