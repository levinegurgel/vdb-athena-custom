<?php get_header(); ?>
<?php get_template_part( 'template-parts/ath-header', 'internal' ); ?>

<?php
  global $post;
  global $ath_options;
  $mob = new Mobile_Detect;
  $thumb = $ath_options['layout_thumbnails'];
  $has_thumb = $ath_options['article_thumbnail'];
  $single = apply_filters( 'get_post_content', false );
  $banner_classes = $ath_options['capture_header_status'] == TRUE ? 'pb-0 mb-6 thumbnail' : 'pb-0 mb-6 thumbnail';
  $cat_color = get_term_meta($single->categories[0]->term_id, 'color', true);
  $transparent_border = $ath_options['capture_header_status'] == TRUE ? 'thumb-transparent' : '';
  $thumb_full = $has_thumb == TRUE ? 'thumb-full' : 'thumb-transparent';
?>

  <section class="ath-banner article has-absolute blue <?php echo ( empty($cat_color) ? 'default-color':''); ?> <?php echo $thumb == 'transparent' ? $transparent_border : $thumb_full; ?>  <?php echo ( !empty(get_the_post_thumbnail_url(get_the_ID())) ? $banner_classes :'' ); ?>" style="background-color: <?php echo $single->color; ?>;">
    <?php if($thumb == 'transparent' && $has_thumb == TRUE): ?>
      <div class="coverthumb">
        <?php if (!empty(get_the_post_thumbnail_url(get_the_ID()))): ?>
          <div class="wrapper-thumb">
            <img src="<? echo ATH_LAZY; ?>" data-src="<?php echo $single->thumbnail_large[0]; ?>" class="mt-5 lazy" alt="<?php echo $post->post_title; ?>">
          </div>
        <?php endif ?>
      </div>
    <?php endif;?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-10 col-centered">
          <div class="title">
            <h4><?php echo $single->categories[0]->name; ?></h4>
            <h1><?php echo $single->title; ?></h1>
          </div>
          <div class="tools <?php echo $mob->isMobile() && !$mob->isTablet() ? 'px-3' : ''; ?>">

              <div class="profile" style="<?php echo $ath_options['article_author'] == false ?  'grid-template-columns: 100%':''; ?>">
                <?php if($ath_options['article_author']): ?>
                  <div class="column">
                    <img src="<? echo ATH_LAZY; ?>" data-src="<?php echo $single->author_avatar; ?>" class="ath-image circle lazy" alt="<?php echo esc_attr( $single->author ); ?>">
                  </div>
                <?php endif; ?>
                <div class="column">
                  <?php if($ath_options['article_author']): ?>
                    <span>Escrito por <a href="<?php echo $single->author_link; ?>"><b><?php echo $single->author; ?></b></a></span>
                  <?php endif; ?>
                  <?php if($ath_options['article_date']): ?>
                    <span style="<?php echo $ath_options['article_author'] == false ?  'margin-left:0px;':''; ?>"><?php echo $ath_options['article_author'] == true ? 'em ' : ''; ?> <?php echo $single->date; ?></span>
                  <?php endif; ?>
                  <?php if(!empty(get_field('post_read_time')) && ( $mob->isMobile() && !$mob->isTablet())): ?>
                    <span class="mt-3">
                      <i class="clock outline icon push-left mt-1"></i>
                      <span class="font-15 font-13-xs ml-1 mt-1"><?php echo get_field('post_read_time'); ?> min de leitura</span>
                    </span>
                  <?php endif; ?>
                </div>
              </div>

            <div class="icons <?php echo $ath_options['article_author'] == false ? 'ta-l':''; ?>">
              <?php if(!empty(get_field('post_read_time')) && !$mob->isMobile()): ?>
                <span>
                  <i class="clock outline icon mb-1"></i>
                  <span class="font-15"><?php echo get_field('post_read_time'); ?> min de leitura</span>
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row relative">
        <div class="col-md-12 col-sm-11 col-xs-12 col-centered">
          <div class="ath-single-thumb-wrapper">
            <div class="ath-single-thumb">
              <?php if($thumb != 'transparent' && $has_thumb == TRUE): ?>
                <?php if (!empty(get_the_post_thumbnail_url(get_the_ID()))): ?>
                  <img src="<? echo ATH_LAZY; ?>" data-src="<?php echo $single->thumbnail_large[0]; ?>" class="mt-5 lazy" alt="<?php echo $post->post_title; ?>">
                <?php endif ?>
              <?php else: ?>
              <div class="mt-6"></div>
              <?php endif; ?>
            </div>
            <?php get_template_part( 'template-parts/ath-cta', 'header' ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>


  <main class="ath-section padding-top-0 margin-bottom-70">

    <div class="container-fluid p-0 ov-h">
      <div class="row">
        <div class="col-md-12 <?php echo is_phone() ? ( has_post_thumbnail() ? 'mt-4' : 'mt-8' ) :''; ?>">

          <!-- Início do artigo -->
          <div class="ath-article single">
            <?php echo $single->content; ?>

            <?php if($ath_options['article_tags']): ?>
              <div class="ath-single-tags mt-7 mb-2">
                <!-- TAGS -->
                <?php
                 $tags = wp_get_post_terms($post->ID, 'post_tag');
                 $n_tags = count($tags);
                 if($n_tags >= 1 && !is_phone()): ?> 
                  <span class="ath-font-header ath-font-header-height mr-2">TAGS:</span>
                  <?php foreach ($tags as $t): ?>
                    <?php if(strlen($t->name <= 50)): ?>
                     <a class="small ui button ath-font-text ath-font-text-weight default-color" href="<?php echo get_term_link($t->term_id); ?>">
                      <?php echo substr($t->name,0,50); ?>
                    </a>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
                <!-- FIM TAGS -->
              </div>
            <?php endif; ?>
          </div>
          <!-- Fim do artigo -->

        </div>
      </div>
      <?php if($ath_options['article_related_posts'] and wp_count_posts('post')->publish > 1): ?>
        <div class="row">
          <div class="col-md-12">
            <?php
            $post->categories = $single->categories;
            get_template_part( 'template-parts/ath-showcase', 'recommended' );
            ?>
          </div>
        </div>
      <?php endif; ?>

    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-10 col-centered mt-7">
          <?php get_template_part( 'template-parts/ath', 'comments' ); ?>
        </div>
      </div>
    </div>

  </main>


<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>