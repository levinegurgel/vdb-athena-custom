
<?php
  $posts_per_page = 5;
  $args  = array( 'taxonomy' => 'material_type', 'term' => 'podcasts', 'posts_per_page' => $posts_per_page * 3 );

  if(is_single()){
    global $post;
    $args['post__not_in'] = array($post->ID);
  }
  $cards = apply_filters( 'get_materials_content', $args );
  if($cards):
?>
<section class="ath-section ath-home-ebooks">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <article class="ath-call horizontal">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <h3 class="margin-bottom-20-xs margin-top-40-xs"><strong>Ouça também</strong></h3>
              <p></p>
            </div>
          </div>
        </article>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">         
          <div class="ath-materials-podcasts margin-bottom-30 ath-pagination-content">
            <?php
            if ( $cards ) :
              $pages_found = floor( count( $cards ) / $posts_per_page );
              $cards_to_show = $pages_found > 0 ? $pages_found * $posts_per_page : count( $cards );
              $i = $j = 0;
              foreach ( $cards as $card ) :
                if ( $i == $cards_to_show ) continue;
                if ( 0 == $i++ % $posts_per_page ) : ?>
                  <div class="ath-pagination-content-page <?php echo $j > 0 ? 'hidden' : ''; ?>" data-page="<?php echo ++$j; ?>">
                <?php endif;

                  $post->card = $card;
                  get_template_part( 'template-parts/ath-card', 'podcast' );

                if ( 0 == $i % $posts_per_page || $i == $cards_to_show ) : ?>
                  </div>
                <?php endif;
              endforeach;
              ?>
              </div>
            <?php endif; ?>
          </div>


      </div>
    </div>

  
    <div class="container">
    <div class="row">
      <div class="col-md-12 <?php echo is_tablet() ? 'mt-6':'margin-top-60'; ?>">
        <div class="col-md-4 col-md-offset-4">
          <?php if(count($cards) > 1): ?>
            <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
              <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
              <a href="<?php echo home_url( '/materiais-tipo/podcasts/' ); ?>"> mais <i class="angle right icon"></i></a>
            </nav>
            <a href="<?php echo home_url( '/materiais-tipo/podcasts/' ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>