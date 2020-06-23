


<section class="ath-section ath-home-tools">
  <div class="container">
    <div class="row">

      <article class="ath-call horizontal">
        <div class="row">
          <div class="col-md-7 col-sm-7">
            <?php if ( get_field( 'tools_title' ) ) : ?>
            <h3 class="margin-bottom-20-xs margin-top-40-xs"><?php the_field( 'tools_title' ); ?></h3>
            <?php endif; ?>
            <?php if ( get_field( 'tools_title' ) ) : ?>
            <p><?php the_field( 'tools_description' ); ?></p>
            <?php endif; ?>
          </div>
          <?php /*
          <div class="col-md-5 col-sm-5 ">

            <?php if ( have_rows( 'tools_numbers' ) ) : ?>
            <div class="ath-numbers inline hidden-xs">
                <ul class="push-right">
                  <?php while ( have_rows( 'tools_numbers' ) ) : the_row(); ?>
                  <li>
                    <span><?php the_sub_field( 'number' ); ?></span>
                    <span class="right"><?php the_sub_field( 'legend' ); ?></span>
                  </li>
                  <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>

          </div>
          */ ?>
        </div>
      </article>

    </div>
    <div class="row">

      <div class="ath-showcase col-4 margin-top-40 margin-bottom-40">

          <?php
          $posts_per_page = 4;
          $args  = array( 'posts_per_page' => $posts_per_page * 3, 'featured' => true );
          $cards = apply_filters( 'get_tools_content', $args );
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
                  get_template_part( 'template-parts/ath-card', 'tool' );

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
      <div class="col-md-12">

        <div class="col-md-4 col-md-offset-4">
          <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
            <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
            <a href="<?php echo home_url( '/ferramentas/' ); ?>">mais <i class="angle right icon"></i></a>
          </nav>
            <a href="<?php echo home_url( '/ferramentas/' ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
        </div>

      </div>
    </div>
  </div>
</section>