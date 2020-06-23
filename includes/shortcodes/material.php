<?php 

  // [ath_material]
  
  add_shortcode('ath_material', 'ath_material');
  function ath_material($attr){
      
      global $ath_options;
      global $post;
      
      // Attributes
      $atts = shortcode_atts(
        array(
          'id'      => false,
          'rtl'     => false,
          'header'  => false,
        ),
        $atts,
        'ath_material'
      );
      $item_id = intval( $atts['id'] );


      if ( empty( $item_id ) ) {
        $item_id = get_field( 'material_related', $post->ID );
        if ( empty( $item_id ) ) {
          return;
        }
      }

      $item = get_post( $item_id );

      if ( $item ) {
        $item = apply_filters( 'get_material_content', $item );

        if ( $item->file ) {

          if ( $title = get_field( 'material_title', $post->ID ) ) {
            $item->title = $title;
          }
          $item->subtitle = get_field( 'material_subtitle', $post->ID );
          $item->email    = get_field( 'material_email', $post->ID );
          $item->btn_text = get_field( 'material_btn_text', $post->ID );
          $item->rtl      = (bool) $atts['rtl'];
          $item->header   = (bool) $atts['header'];
          $item->thumb    = has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : false;

          $post->banner   = $item;

          ob_start();
          get_template_part( 'template-parts/vdb-cta', 'material' );
          $output = ob_get_clean();
          return $output;
        }
      }

 } ?>