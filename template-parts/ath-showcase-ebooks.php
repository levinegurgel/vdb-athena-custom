<?php
  $mob = new Mobile_Detect;
  $posts_per_page = 4;
  $args   = array( 'taxonomy' => 'material_type', 'term' => 'ebooks', 'posts_per_page' => $posts_per_page * 3 );
  $filter = apply_filters( 'get_materials_content', $args ); 
  $cards  = empty($filter) ? 0 : $filter;

  if($cards > 0):
?>
<section class="ath-section ath-home-ebooks">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <article class="ath-call horizontal <?php echo is_tablet() ? 'mb-4':''; ?> ath-home-title-ebooks">
          <div class="row">
            <div class="col-md-7 col-sm-7 <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-0 mb-3':''; ?>">
              <?php if ( get_field( 'home_ebooks_title' ) ) : ?>
              <h3 class="margin-bottom-20-xs margin-top-40-xs"><?php the_field( 'home_ebooks_title' ); ?></h3>
              <?php endif; ?>
              <?php if ( get_field( 'home_ebooks_title' ) ) : ?>
              <p><?php the_field( 'home_ebooks_description' ); ?></p>
              <?php endif; ?>
            </div>
            <div class="col-md-5 col-sm-5">

              <?php if ( have_rows( 'home_ebooks_numbers' ) ) : ?>
              <div class="ath-numbers inline hidden-xs">
                <ul class="push-right">
                  <?php while ( have_rows( 'home_ebooks_numbers' ) ) : the_row(); ?>
                  <?php
                    $number = get_sub_field('number');
                    if(!empty($number)):
                      $number = str_replace('[','<small>',$number);
                      $number = str_replace(']','</small>',$number);
                    endif;
                  ?>
                  <li>
                    <span><?php echo $number; ?></span>
                    <span><?php the_sub_field( 'label' ); ?></span>
                  </li>
                  <?php endwhile; ?>
                </ul>
              </div>
              <?php endif; ?>

            </div>
          </div>
        </article>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12">


        <div class="ath-showcase col-4">
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
                  get_template_part( 'template-parts/ath-card', 'ebook' );

                if ( 0 == $i % $posts_per_page || $i == $cards_to_show ) : ?>
                  </div>
                <?php endif;
              endforeach;
              ?>
              </div>
            <?php else:
              echo 'Nenhum ebook inserido até o momento.';
            endif;
            ?>
          </div>

        </div>


      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 <?php echo is_tablet() ? 'mt-6':'margin-top-60'; ?>">
        <div class="col-md-4 col-md-offset-4">
          <?php if(count($cards) > 4): ?>
            <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
              <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
              <a href="<?php echo home_url( '/materiais-tipo/ebooks/' ); ?>"> mais <i class="angle right icon"></i></a>
            </nav>
            <a href="<?php echo home_url( '/materiais-tipo/ebooks/' ); ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>