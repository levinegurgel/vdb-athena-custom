<?php
$cards_per_page = 16;
$cards_per_line = 4;

$args = array( 'posts_per_page' => $cards_per_page, 'offset' => 0 );

if ( ! empty( $_GET['search'] ) ) {
  $args['s'] = $_GET['search'];
}

if ( ! empty( $_POST['search'] ) ) {
  $args['s'] = $_POST['search'];
}

if ( $post->featured ) {
  $args['post__not_in'] = $post->featured;
}

if ( ! empty( $_POST['taxonomy'] ) && ! empty( $_POST['term'] ) ) {
  $args['taxonomy'] = $_POST['taxonomy'];
  $args['term']     = $_POST['term'];
} elseif ( is_tax() || is_category() || is_tag() ) {
  $term             = get_queried_object();
  $args['taxonomy'] = $term->taxonomy;
  $args['term']     = $term->slug;
}

if ( ! empty( $_POST['offset'] ) ) {
  $args['offset']  += intval( $_POST['offset'] );
  $args['offset']  -= $post->featured ? count( $post->featured ) : 0;
}

if ( is_author() && ! empty( $author ) ) {
  $args['author'] = (int) $author;
} elseif ( ! empty( $_POST['author'] ) ) {
  $args['author'] = (int) $_POST['author'];
}

if ( ! empty( $_POST['year'] ) ) {
  $args['year'] = $_POST['year'];
} elseif ( $year = get_query_var( 'year' ) ) {
  $args['year'] = $year;
}

if ( ! empty( $_POST['monthnum'] ) ) {
  $args['monthnum'] = $_POST['monthnum'];
} elseif ( $monthnum = get_query_var( 'monthnum' ) ) {
  $args['monthnum'] = $monthnum;
}

if ( ! empty( $_POST['day'] ) ) {
  $args['day'] = $_POST['day'];
} elseif ( $day = get_query_var( 'day' ) ) {
  $args['day'] = $day;
}

$cards = apply_filters( 'get_posts_content', $args );

if ( $cards ) : $i = 0;

  $lines      = ath_organize_cards( $cards, $cards_per_page, $cards_per_line );
  $last_line  = $lines[ count( $lines ) - 1 ];
  if ( $cards_per_line > count( $last_line ) ) {
    if ( ( $cards_per_page + $args['offset'] ) < $cards[0]->found_posts ) {
      array_pop( $lines );
    }
  }

  foreach ( $lines as $line ) : $i++; ?>

  <!-- INÍCIO DA LINHA  -->
  <div class="row">

    <?php foreach ( $line as $card ) : $post->card = $card; ?>

      <?php if ( $card->featured ) : ?>
      <div class="col-md-6 col-sm-12">
        <?php get_template_part( 'template-parts/ath-card', 'featured' ); ?>
      </div>
      <?php else : ?>
      <div class="col-md-3 col-sm-6">
        <?php get_template_part( 'template-parts/ath-card', 'default' ); ?>
      </div>
      <?php endif; ?>

    <?php endforeach; ?>

  </div>
  <!-- FIM DA LINHA -->

  <?php endforeach; ?>

<?php endif; ?>