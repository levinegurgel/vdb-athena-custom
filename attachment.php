<?php
get_header();
get_template_part( 'template-parts/ath-header', 'internal' );
?>

<section class="ath-section py-7">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-centered">
			 	<!-- Início do conteúdo -->
          <div class="ath-article single">
						<div class="entry-attachment">
						 <?php $image_size = apply_filters( 'wporg_attachment_size', 'large' ); 
						  echo wp_get_attachment_image( get_the_ID(), $image_size ); ?>
							<?php if ( has_excerpt() ) : ?> 
							 <div class="entry-caption">
							  	<?php the_excerpt(); ?>
							 </div>
							<?php endif; ?>
						</div>
          </div>
        <!-- Fim do artigo -->
			</div>
		</div>
	</div>
</section>

<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>