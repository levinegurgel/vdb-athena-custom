<?php

    /* Template Name: Construtores */

    get_header();
    global $post;
    $postPageBuider = get_post($post->ID);
    
    if(get_field('landing_builder_header',$post->ID) === TRUE){
      get_template_part( 'template-parts/ath-header', 'internal' );
    }

    echo '<div id="ath-builder-wrapper" class="">';
      
      $content  = $postPageBuider->post_content;
      $content  = apply_filters('the_content', $content);
      $content  = str_replace(']]>', ']]&gt;', $content);
      echo $content;
    
    echo '</div>';

    get_footer();

?>