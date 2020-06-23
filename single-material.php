<?php

  global $post;
  get_header();
  $single = apply_filters( 'get_material_content', false );
  switch ($single->types[0]->slug) {
    
    case 'ebooks':
      get_template_part( 'template-parts/ath-material', 'ebook' );
    break;

    case 'videos':
      get_template_part( 'template-parts/ath-material', 'video' );
    break;
    
    case 'podcasts':
      get_template_part( 'template-parts/ath-material', 'podcast' );
    break;

    case 'infograficos':
      get_template_part( 'template-parts/ath-material', 'ebook' );
    break;
  
  }

?>


<?php  
  wp_footer();
  get_template_part( 'template-parts/ath', 'footer-scripts' );
  if(!empty(get_field('single_scripts_footer',$post->ID))){
    echo get_field('single_scripts_footer',$post->ID);
  }
?>

</body>
</html>