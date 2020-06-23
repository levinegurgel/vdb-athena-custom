<?php
  /* Template Name: Landing - Artigo */
  global $ath_options;
  get_header(); 
  get_template_part( 'template-parts/ath-header', 'countdown' );
?>

<header id="ath-header" class="default primary landing" style="background-image: linear-gradient(120deg,<?php echo get_field('landing_color1');?>,<?php echo get_field('landing_color2');?>);">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if (!empty(get_field('landing_brand'))): ?>
        	<img src="<?php echo get_field('landing_brand'); ?>" style="max-height:50px;" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php else: ?>
        	<img src="<?php echo $ath_options['brand_mono']['url']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        <?php endif ?>
      </div>
    </div>
  </div>
</header>

<main class="ath-section margin-top-0">

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-centered">

        <!-- Início do artigo -->
        <div class="ath-article single">
		    <?php
					while ( have_posts() ) : the_post();
          	the_content();						
					endwhile;
				?>
        </div>
        <!-- Fim do artigo -->

      </div>
    </div>
  </div>

</main>


<footer class="ath-footer default padding-bottom-80">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <figure></figure><!-- Logo VDB -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 margin-top-20 margin-bottom-30">
      	<?php if ( $copyright = get_field( 'footer_copyright', 'option' ) ) : ?>
        <p><?php echo do_shortcode( $copyright ); ?></p>
    	  <?php endif; ?>
      </div>
    </div>
  </div>
</footer>

<?php if(!empty(get_field('landing_color1'))): ?>
	<style type="text/css">
		a.button,
		input[type="submit"]{
			color: white;
			background-color: <?php echo get_field('landing_color1'); ?> !important;
		}
		a.button:hover,
		input[type="submit"]:hover{
			color: white !important;
			background-color: <?php echo get_field('landing_color1'); ?> !important;
		}
	</style>
<?php endif; ?>



<?php 
	wp_footer();
	get_template_part( 'template-parts/ath', 'footer-scripts' );
?>


	</body>
</html>