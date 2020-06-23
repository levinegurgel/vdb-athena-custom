


<section class="ath-section ath-home-articles pt-0">
  <div class="container">
    <?php $formats = apply_filters( 'get_content_formats', false ); ?>
    <?php if ( $formats ) : $i = 0; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="ath-navigation tabs margin-bottom-20">
          <nav>
            <div class="trail">
              <?php foreach ( $formats as $format ) : ?>
              <a href="#<?php echo $format->slug; ?>" class="<?php echo 0 == $i++ ? 'active ' : '' ?>rpp has-ripple"><?php echo $format->name; ?></a>
              <?php endforeach; ?>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="ath-showcase col-4">

          <?php
          // $args  = array( 'taxonomy' => 'content_format','term' => $formats[0]->slug );
          $posts_per_page = 8;
          $args  = array( 'posts_per_page' => $posts_per_page * 3 );
          $cards = apply_filters( 'get_posts_content', $args );
          ?>
          <div class="trail ath-pagination-content">
            <?php if ( $cards ) :
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

                if ( 0 == $i % $posts_per_page || $i == $cards_to_show ) : ?>
                  </div>
                <?php endif;
              endforeach;
              ?>
              </div>
            <?php else:
              echo 'Nenhum artigo até o momento.';
            endif;
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-centered <?php echo is_tablet() ? 'mt-5':''; ?>">
        <?php if ( count($cards) > 8 ) : ?>
          <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
            <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
            <a href="<?php echo ath_get_blog_link(); ?>" style="padding-right: 30px;">mais <i class="angle right icon" style="right: 2px;top: 5px;"></i></a>
          </nav>
          <a href="<?php echo ath_get_blog_link(); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>