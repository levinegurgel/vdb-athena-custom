<?php
  $args  = array( 'taxonomy' => 'material_type', 'term' => 'videos', 'posts_per_page' => 6);
  if(is_single()){
    global $post;
    $args['post__not_in'] = array($post->ID);
  }
  $cards = apply_filters( 'get_materials_content', $args );
  $args  = array(
    'args' => $args,
    'card' => 'video',
    'hook' => 'materials_content',
  );

  if($cards):

?>

<section class="ath-section ath-home-ebooks">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <article class="ath-call horizontal">
          <div class="row">
            <div class="col-md-7 col-sm-7">
              <h3 class="margin-bottom-20-xs margin-top-40-xs"><strong>Assista também</strong></h3>
              <p></p>
            </div>
          </div>
        </article>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="ath-showcase col-3">
          <div class="trail ath-pagination-content" data-pagination-args="<?php echo esc_attr( json_encode( $args ) ); ?>">
            
            <?php
            if ( $cards ) :
              foreach ( $cards as $card ) :
                $post->card = $card;
                get_template_part( 'template-parts/ath-card', 'video' );
              endforeach;
            endif;
            ?>
          </div>

        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12 margin-top-60">
        <div class="col-md-4 col-md-offset-4">
          <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
            <?php echo ath_pagination_links( $cards, 4 ); ?>
            <a href="<?php echo home_url( '/materiais-tipo/videos/' ); ?>" style="padding-right: 30px;">mais <i class="angle right icon" style="right: 2px;top: 5px;"></i></a>
          </nav>
          <a href="<?php echo home_url( '/materiais-tipo/videos/' ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>