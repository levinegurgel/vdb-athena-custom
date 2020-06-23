<?php
/* Template Name: Blog */
get_header();
?>

<?php
  get_template_part( 'template-parts/ath-header', 'internal' );
  get_template_part( 'template-parts/ath-banner', 'default-cta' );
  get_template_part( 'template-parts/ath', 'wall' );
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>