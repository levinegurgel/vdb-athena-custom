<?php
  /* Template Name: Materiais */
  get_header(); ?>
<?php $mob = new Mobile_Detect; ?>
<?php get_template_part( 'template-parts/ath-header', 'internal' ); ?>
<?php get_template_part( 'template-parts/ath-banner', 'default' ); ?>

<?php
$material_types = get_terms( array(
    'taxonomy' => 'material_type',
    'hide_empty' => true,
) );

if ( $material_types ) :
  foreach ( $material_types as $material_type ) : ?>

  <section class="ath-section">
    <div class="container">
      <?php if ( is_archive() ) : ?>
      <div class="row">
        <div class="col-md-12">
          <div class="ath-call horizontal margin-bottom-20">
            <div class="row">
              <div class="col-md-7 col-sm-6 <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-0':''; ?>">
                <h3><strong><?php echo str_replace('Videos', 'Vídeos',$material_type->name); ?></strong></h3>
                <p><?php echo $material_type->description; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-md-12">

          <?php
          $posts_per_page = array(
            'ebooks'       => 8,
            'videos'       => 6,
            'podcasts'     => 5,
            'infograficos' => 6,
          );

          $posts_per_page = is_archive() ? $posts_per_page[ $material_type->slug ] : 12;

          $args = array(
            'taxonomy'        => 'material_type',
            'term'            => $material_type->slug,
            'posts_per_page'  => $posts_per_page * 3,
          );

          if ( ! empty( $_GET['search'] ) ) {
            $args['s'] = $_GET['search'];
          }

          $cards = apply_filters( 'get_materials_content', $args );

          if ( $cards ) :

            $card_type = array(
              'ebooks'       => 'ebook',
              'videos'       => 'video',
              'podcasts'     => 'podcast',
              'infograficos' => 'infographic',
            );
            $card_type = $card_type[ $material_type->slug ];

            $pages_found = floor( count( $cards ) / $posts_per_page );
            $cards_to_show = $pages_found > 0 ? $pages_found * $posts_per_page : count( $cards );
            $i = $j = 0;

            ob_start();
            foreach ( $cards as $card ) :
              if ( $i == $cards_to_show ) continue;
              if ( 0 == $i++ % $posts_per_page ) : ?>
                <div class="ath-pagination-content-page <?php echo $j > 0 ? 'hidden' : ''; ?>" data-page="<?php echo ++$j; ?>">
              <?php endif;

                $post->card = $card;
                get_template_part( 'template-parts/ath-card', $card_type );

              if ( 0 == $i % $posts_per_page || $i == $cards_to_show ) : ?>
                </div>
              <?php endif;
            endforeach;
            $content = ob_get_clean();

            if ( 'ebooks' == $material_type->slug ) : ?>

              <div class="ath-materials-ebooks">
                <div class="ath-showcase col-4 ath-pagination-content">
                  <?php echo $content; ?>
                </div>
              </div>

            <?php elseif ( 'videos' == $material_type->slug ) : ?>

              <div class="ath-materials-videos">
                <div class="ath-showcase col-3 ath-pagination-content materials-videos">
                  <div class="trail">
                    <?php echo $content; ?>
                  </div>
                </div>
              </div>

            <?php elseif ( 'podcasts' == $material_type->slug ) : ?>

                <div class="ath-materials-podcasts margin-bottom-30 margin-bottom-30-xs ath-pagination-content">
                  <?php echo $content; ?>
                </div>

            <?php elseif ( 'infograficos' == $material_type->slug ) : ?>

              <div class="ath-materials-info">
                <div class="ath-showcase col-3 ath-pagination-content">
                  <?php echo $content; ?>
                </div>
              </div>

            <?php endif; ?>

          <?php endif; ?>

        </div>
      </div>
      <?php if ( is_archive() ) : ?>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <nav class="ath-navigation default circle center margin-top-40 hidden-xs ath-pagination-links">
            <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
            <?php 
              $max_cards = $material_type->slug == 'ebooks' ? 4 : 3;
              if (count($cards) > $max_cards): 
            ?>
              <a href="<?php echo get_term_link( $material_type->term_id ); ?>" style="padding-right: 30px;">mais <i class="angle right icon" style="right: 2px;top: 5px;"></i></a>
            <?php endif; ?>
             <a href="<?php echo get_term_link( $material_type->term_id ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>            
          </nav>

        </div>
      </div>
      <?php else: ?>
        <!-- LOADER -->
        <div class="row margin-top-60 margin-bottom-30">
          <div class="col-md-12">
            <div class="ath-loader" style="display:none;">
               <p>Carregando mais conteúdo...</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-centered margin-top-50" style="visibility: hidden;">
            <a href="#" id="btn-pagination-more" data-page="1" class="button medium rpp full blue centered">Carregar mais</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>


  <?php
  endforeach;
endif;
?>


<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>