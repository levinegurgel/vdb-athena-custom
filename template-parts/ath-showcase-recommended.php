
<section class="ath-section ath-home-articles padding-top-80 mb-0 pb-0">

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ath-navigation tabs margin-bottom-20">
            <nav>
              <div class="trail">
                <a id="artigos-relacionados" href="#artigos-relacionados" class="rpp has-ripple active default-color">Artigos Relacionados</a>
                <?php
                $formats = apply_filters( 'get_posts_formats', false );
                if ( $formats ) : $i = 0; ?>
                  <?php foreach ( $formats as $format ) : ?>
                  <!-- <a href="#<?php echo $format->slug; ?>" class="<?php echo 0 == $i++ ? 'active ' : ''; ?>rpp has-ripple"><?php echo $format->name; ?></a> -->
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="ath-showcase col-4">

            <?php
            $posts_per_page = 4;
            // $cards = apply_filters( 'get_posts_content', array( 'taxonomy' => 'content_format', 'term' => $formats[0]->slug, 'posts_per_page' => 4 ) );
            if ( $post->categories ) {
              $args = array( 'taxonomy' => 'category', 'term' => $post->categories[0]->slug );
            }
            $args['posts_per_page'] = $posts_per_page * 3;
            $args['post__not_in']   = array( $post->ID );
            $cards = apply_filters( 'get_posts_content', $args );
            ?>
            <div class="trail ath-pagination-content">
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
                    get_template_part( 'template-parts/ath-card', 'default' );

                    // if(count($cards) < 4){
                    //   for($x=1;$x<=(4 - count($cards));$x++){
                    //     echo '<article class="ath-card simple thumb-full">
                    //           <a href=""><div class="wrapper " style="background-color: #f1f1f1;">                                  
                    //           </div></a><span><div style="width:100%;height:18px;background: #f1f1f1;"></div></span>
                    //           <h4><div style="width:100%;height:18px;background: #f1f1f1; margin-bottom:12px;"></div>
                    //           <div style="width:100%;height:18px;background: #f1f1f1; margin-bottom:12px;"></div>
                    //           <div style="width:100%;height:18px;background: #f1f1f1;"></div></h4>
                    //           </article>';
                    //   }
                    // }

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
        
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <nav class="ath-navigation default circle center margin-top-40 hidden-xs ath-pagination-links">
            <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
            <a href="<?php echo get_term_link( $post->categories[0]->term_id ); ?>" style="padding-right: 30px;">mais <i class="angle right icon" style="right: 2px;top: 5px;"></i></a>
          </nav>
          <a href="<?php echo get_term_link( $post->categories[0]->term_id ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
        </div>
      </div>
    </div>

</section>