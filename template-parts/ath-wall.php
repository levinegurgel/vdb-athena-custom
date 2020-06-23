
<?php
  global $ath_options;
  $mob = new Mobile_Detect;
  if(!is_date()){
    $category_obj = get_queried_object();
    $category_id = $category_obj->term_id;
  }
  $phone_classes = $ath_options['capture_header_name_status'] == TRUE ? 'mt-7' : 'mt-5';
?>
<section class="ath-section ath-home-articles pb-2 pt-0">
  <div class="container">
    <?php $categories = apply_filters( 'get_posts_categories', false ); ?>
    <?php if ( ! is_post_type_archive() && ! is_author() &&  $categories ) : ?>
    <div class="row">
      <div class="col-md-12">
        <div class="ath-navigation pills <?php echo is_tablet() ? 'mb-0 pb-4':'mb-5'; ?> <?php echo is_phone() ? $phone_classes :''; ?>">
          <nav>
            <div class="trail">
              <a href="<?php echo ath_get_blog_link(); ?>" class="rpp has-ripple default-color <?php echo is_phone() ? 'mb-2':'mb-2'; ?>">Todos</a>
              <?php foreach ( $categories as $category ) : ?>
              <?php $cat_color = get_term_meta($category->term_id, 'color', true); ?>
              <a href="<?php echo get_term_link( $category->term_id ); ?>" class="rpp has-ripple <?php if($category->term_id == (int) $category_id){echo "active";} ?> <?php echo is_phone() ? 'mb-2':'mb-2'; ?> <?php echo ( empty($cat_color) ? 'default-color':''); ?>" style="background-color: <?php echo $category->color; ?>;"><?php echo $category->name; ?></a>
              <?php endforeach; ?>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <?php if ( is_tax() || is_category() || is_tag() ) $term = get_queried_object(); ?>
      <?php $class_tablet = $ath_options['capture_header_name_status'] == TRUE ? 'mt-5':'mt-4'; ?>
      <div class="col-md-12 col-sm-12 col-xs-10 col-centered-xs infinite-scroll-wrapper <?php echo is_phone() ? 'px-0':''; ?> 
      <?php echo is_tablet() ? $class_tablet :''; ?>"
        <?php echo ! empty( $_GET['search'] ) ? 'data-search="' . $_GET['search'] . '"' : ''; ?>
        <?php echo ! empty( $term->taxonomy ) ? 'data-taxonomy="' . $term->taxonomy . '"' : ''; ?>
        <?php echo ! empty( $term->slug ) ? 'data-term="' . $term->slug . '"' : ''; ?>
        <?php echo is_author() && ! empty( $author ) ? 'data-author="' . $author . '"' : ''; ?>
        <?php echo is_date() && ! empty( get_query_var( 'year' ) ) ? 'data-year="' . get_query_var( 'year' ) . '"' : ''; ?>
        <?php echo is_date() && ! empty( get_query_var( 'monthnum' ) ) ? 'data-monthnum="' . get_query_var( 'monthnum' ) . '"' : ''; ?>
        <?php echo is_date() && ! empty( get_query_var( 'day' ) ) ? 'data-day="' . get_query_var( 'day' ) . '"' : ''; ?>
        >

        <?php
        $args = array( /*'featured' => true, */'posts_per_page' => 2 );
        if ( ! empty( $_GET['search'] ) ) {
          $args['s'] = $_GET['search'];
        }

        $featured = apply_filters( 'get_posts_content', $args );

        if ( is_page() && $featured && 2 == count( $featured ) ) : ?>

          <!-- MOSAICO DE DUAS COLUNAS -->

          <div class="row mb-6 featured-posts" data-featured="<?php echo $featured[0]->ID, ',', $featured[1]->ID; ?>">

            <?php foreach ( $featured as $card ) : ?>
            <div class="col-md-6 col-sm-12">
              <?php
              $post->card = $card;
              get_template_part( 'template-parts/ath-card', 'featured' );
              ?>
            </div>
            <?php endforeach; ?>

          </div>

          <?php
          $post->featured = array( $featured[0]->ID, $featured[1]->ID );

        else :

          $post = new \stdClass();
          $post->featured = false;

        endif; ?>

        <?php get_template_part( 'template-parts/ath-archive', 'cards' ); ?>

        <?php get_template_part( 'template-parts/ath-archive', 'banner' ); ?>

      </div>
    </div>

    <!-- LOADER -->
    <div class="row margin-top-30 margin-bottom-30">
      <div class="col-md-12">
        <div class="ath-loader">
           <p>Carregando mais conteúdo...</p>
        </div>
      </div>
    </div>

  </div>
</section>