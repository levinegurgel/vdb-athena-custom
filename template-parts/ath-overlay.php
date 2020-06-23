<?php
global $ath_options;
$keyword = ! empty( $_REQUEST['s'] ) ? $_REQUEST['s'] : false;
$args = array(
  'post_type'       => 'post',
  'posts_per_page'  => is_tablet() ? 3 : 4,
);
if ( $keyword ) {
  $args['post_type']  = array( 'post', 'material' );
  $args['s']          = $keyword;
} else {
  $keyword = false;
}
$results = apply_filters( 'get_posts_content', $args );
$is_ajax = isset( $_POST['nonce'], $_POST['action'] );

if ( ! $is_ajax ) : ?>

<div class="ath-overlay search">
  <!-- Adicione a classe "result" abaixo para mudar o comportamento da página -->
  <div class="overlay-wrapper <?php echo $results && $keyword ? '' : 'no-'; ?>result">
    <div class="overlay-brand">
      <a href="<?php echo home_url( '/' );?>">
        <?php if(!empty($ath_options['brand']['url'])): ?>
          <figure class="brand"></figure>
        <?php else: ?>
          <figure class="brand">
            <h5 class="<?php echo is_phone() ? 'mt-2':''; ?>"><?php echo get_bloginfo('name'); ?></h5>
          </figure>
        <?php endif; ?>
      </a>
    </div>
    <div class="overlay-close">
      <i class="icon close push-right" id="btn-overlay-close"></i>
    </div>
    <div class="container">
      <div class="row relative z-index">
        <div class="col-md-8 col-centered margin-top form-wrapper">
          <form action="" name="formsearch" class="ath-form no-radius-medium form-search">
            <div class="field icon search">
              <input type="text" name="s" id="search-query" autocomplete="off" placeholder="<?php echo $ath_options['search_placeholder']; ?>" <?php echo $keyword ? 'value="' . sanitize_text_field( $keyword ) . '"' : ''; ?> required>
              <input type="submit" class="btnSend" value="Enviar">
            </div>
          </form>
        </div>
      </div>
      <div class="row relative z-index">
        <div class="col-md-12 overlay-content margin-top-20">

<?php endif; // ! is_ajax ?>

          <?php if ( $results && ! $keyword ) : ?>

          <div class="overlay-result-box overlay-initial-search">
            <div class="ath-showcase col-4 <?php echo !is_phone() ? 'd-flex jc-center':''; ?>">

              <?php
                $max = 1;
                foreach ( $results as $card ) {
                  if($max <= 4):
              ?>
                <article class="ath-card simple <?php echo $card->thumbnail_type == 'transparent' ? 'thumb-transparent':'thumb-full'; ?>">
                  <span><a href="<?php echo $card->permalink; ?>"><?php echo $card->categories[0]->name; ?></a></span>
                  <h4><a href="<?php echo $card->permalink; ?>" title="<?php echo esc_attr( $card->title ); ?>"><?php echo ath_trim_text( $card->title, 100 ); ?></a></h4>
                </article>
              <?php
                  endif;
                  $max++;
                }
              ?>

            </div>
          </div><!-- result box -->

          <?php elseif ( $keyword ) : ?>

          <div class="overlay-result-box">
            <div class="ath-call horizontal margin-bottom-20">
              <div class="row">
                <div class="col-md-7 col-sm-12">
                  <!-- <h3><strong>Infográficos</strong></h3> -->
                  <?php if ( $results ) : ?>
                  <p>Encontramos <?php echo $results[0]->found_posts; ?> resultado(s) sobre <strong><?php echo $keyword; ?></strong></p>
                  <?php else : ?>
                  <p>Nenhum resultado encontrado sobre <strong><?php echo $keyword; ?></strong>. Quem sabe se tentar ou palavra-chave?</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <?php
            if ( $results ) :

              $types = array(
                array(
                  'title' => 'Artigos',
                  'card'  => 'default',
                  'hook'  => 'posts_content',
                  'args'  => array(
                    'post_type'       => 'post',
                    'posts_per_page'  => 8,
                  ),
                ),
                array(
                  'title' => 'Ebooks',
                  'card'  => 'ebook',
                  'hook'  => 'materials_content',
                  'args'  => array(
                    'post_type'       => 'material',
                    'taxonomy'        => 'material_type',
                    'term'            => 'ebook',
                    'posts_per_page'  => 8,
                  ),
                ),
                array(
                  'title' => 'Infográficos',
                  'card'  => 'infographic',
                  'hook'  => 'materials_content',
                  'args'  => array(
                    'post_type'       => 'material',
                    'taxonomy'        => 'material_type',
                    'term'            => 'infografico',
                    'posts_per_page'  => 6,
                  ),
                ),
                array(
                  'title' => 'Podcasts',
                  'card'  => 'podcast',
                  'hook'  => 'materials_content',
                  'args'  => array(
                    'post_type'       => 'material',
                    'taxonomy'        => 'material_type',
                    'term'            => 'podcast',
                    'posts_per_page'  => 5,
                  ),
                ),
                array(
                  'title' => 'Vídeos',
                  'card'  => 'video',
                  'hook'  => 'materials_content',
                  'args'  => array(
                    'post_type'       => 'material',
                    'taxonomy'        => 'material_type',
                    'term'            => 'video',
                    'posts_per_page'  => 6,
                  ),
                ),
              );

              foreach ( $types as $type ) :

                $type['args']['post__not_in'] = array( $post->ID );
                $type['args']['s'] = $keyword;
                $posts_per_page = $type['args']['posts_per_page'];
                $type['args']['posts_per_page'] = $posts_per_page * 3;

                $cards = apply_filters( 'get_' . $type['hook'], $type['args'] );

                if ( $cards ) : ?>

                <section class="ath-section padding-top-0 padding-bottom-0">
                  <div class="<?php echo is_tablet() ? 'container-fluid':'container'; ?>">
                    <div class="row">
                      <div class="col-md-12">

                        <article class="ath-call horizontal">
                          <div class="row">
                            <div class="col-md-7 col-sm-7">
                              <h3 class="margin-bottom-30 margin-bottom-20-xs margin-top-40-xs"><strong><?php echo $type['title']; ?></strong></h3>
                            </div>
                          </div>
                        </article>

                      </div>
                    </div>
                    <div class="row">
                      <?php
                      if ( 'podcast' == $type['card'] ) {
                        $class = '';
                      } else {
                        $class = 'ath-showcase col-';
                        if ( in_array( $type['card'], array( 'video', 'infographic' ) ) ) {
                          $class .= '3';
                        } else {
                          $class .= '4';
                        }
                      }
                      ?>
                      <div class="<?php echo $class; ?>">
                        <div class="margin-bottom-0 ath-pagination-content">

                          <?php
                          $pages_found = floor( count( $cards ) / $posts_per_page );
                          $cards_to_show = $pages_found > 0 ? $pages_found * $posts_per_page : count( $cards );
                          $i = $j = 0;
                          foreach ( $cards as $card ) :
                            if ( $i == $cards_to_show ) continue;
                            if ( 0 == $i++ % $posts_per_page ) : ?>
                              <div class="ath-pagination-content-page <?php echo $j > 0 ? 'hidden' : ''; ?>" data-page="<?php echo ++$j; ?>">
                            <?php endif;

                              $post->card = $card;
                              get_template_part( 'template-parts/ath-card', $type['card'] );

                            if ( 0 == $i % $posts_per_page || $i == $cards_to_show ) : ?>
                              </div>
                            <?php endif;
                          endforeach;
                          ?>

                        </div>
                      </div>
                    </div>

                    <?php if ( $cards[0]->found_posts > $posts_per_page ) : ?>

                    <div class="row">
                      <div class="col-md-12 margin-top-30 margin-bottom-60">
                        <div class="col-md-4 col-md-offset-4">

                          <?php
                          $search_url  = home_url( '/' );
                          $search_url .= 'post' == $type['args']['post_type'] ? 'blog' : 'materiais/' . $type['args']['term'];
                          $search_url .= '/' . ( $keyword ? '?search=' . $keyword : '' );
                          ?>

                          <nav class="ath-navigation default circle center hidden-xs ath-pagination-links">
                            <?php echo ath_pagination_links( $cards, $posts_per_page ); ?>
                            <?php if ( $cards[0]->found_posts > $cards_to_show ) : ?>
                            <a href="<?php echo $search_url; ?>" style="padding-right: 30px;">mais <i class="angle right icon" style="right: 2px;top: 5px;"></i></a>
                            <?php endif; ?>
                          </nav>

                          <?php if ( $cards[0]->found_posts > ( 3 * $cards_to_show ) ) : ?>
                          <a href="<?php echo $search_url; ?>" class="button outline primary visible-xs center-xs">Ver mais</a>
                          <?php endif; ?>

                        </div>
                      </div>
                    </div>

                    <?php endif; ?>

                  </div>
                </section>

                <?php endif; ?>

              <?php endforeach; ?>

            <?php endif; ?>

          </div><!-- result box -->


          <?php endif; ?>

<?php if ( ! $is_ajax ) : ?>

        </div>
      </div>

      <!-- LOADER -->
      <div class="row margin-top-30 margin-bottom-30 hidden">
        <div class="col-md-12">
          <div class="ath-loader">
             <p>Pesquisando...</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php endif; // ! is_ajax ?>