<?php
  get_header();
  get_template_part( 'template-parts/ath-header', 'internal' );
  get_template_part( 'template-parts/ath-banner', 'default' );
?>


  <section class="ath-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php
        	$material_type = get_queried_object();

          $posts_per_page = array(
            'ebooks'       => 8,
            'videos'       => 6,
            'podcasts'     => 10,
            'infograficos' => 6,
          );
          $posts_per_page = $posts_per_page[ $material_type->slug ];

          $args = array(
            'taxonomy'        => 'material_type',
            'term'            => $material_type->slug,
            'posts_per_page'  => $posts_per_page ? $posts_per_page : 12,
          );

          $cards = apply_filters( 'get_materials_content', $args );

          if ( $cards ) :
            $i = 0;

            $card_type = array(
              'ebooks'       => 'ebook',
              'videos'       => 'video',
              'podcasts'     => 'podcast',
              'infograficos' => 'infographic',
            );
            $card_type = $card_type[ $material_type->slug ];

            $args = array(
              'args' => $args,
              'hook' => 'materials_content',
              'card' => $card_type ? $card_type : 'default',
            );

            global $post;
            $post = $post ?: new StdClass;

            ob_start();
            foreach ( $cards as $card ) :
              $post->card = $card;
              get_template_part( 'template-parts/ath-card', $args['card'] );
            endforeach;
            $content = ob_get_clean();

            $data_args = esc_attr( json_encode( $args ) );

            if ( 'ebooks' == $material_type->slug ) : ?>

              <div class="ath-materials-ebooks">
                <div class="ath-showcase col-4 infinite-scroll-wrapper" data-infinite-scroll-args="<?php echo $data_args; ?>">
                  <?php echo $content; ?>
                </div>
              </div>

            <?php elseif ( 'videos' == $material_type->slug ) : ?>

              <div class="ath-materials-videos">
                <div class="ath-showcase col-3">
                  <div class="trail infinite-scroll-wrapper" data-infinite-scroll-args="<?php echo esc_attr( json_encode( $args ) ); ?>">
                    <?php echo $content; ?>
                  </div>
                </div>
              </div>

            <?php elseif ( 'podcasts' == $material_type->slug ) : ?>

              <div class="ath-materials-podcasts margin-bottom-30 infinite-scroll-wrapper" data-infinite-scroll-args="<?php echo esc_attr( json_encode( $args ) ); ?>">
                <?php echo $content; ?>
              </div>

            <?php elseif ( 'infograficos' == $material_type->slug ) : ?>

              <div class="ath-materials-info">
                <div class="ath-showcase col-3 infinite-scroll-wrapper" data-infinite-scroll-args="<?php echo esc_attr( json_encode( $args ) ); ?>">
                  <?php echo $content; ?>
                </div>
              </div>

            <?php endif; ?>

          <?php endif; ?>

        </div>
      </div>

      <!-- LOADER -->
      <div class="row margin-top-60 margin-bottom-30">
        <div class="col-md-12">
          <div class="ath-loader">
             <p>Carregando mais conteúdo...</p>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-md-12 col-centered margin-top-50" style="visibility: hidden;">
          <a href="#" id="btn-pagination-more" data-page="1" class="button medium rpp full blue centered">Carregar mais</a>
        </div>
      </div> -->
    </div>
  </section>


<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>
