<?php
  if ( post_password_required() ) {
    return;
  }
?>

<div id="comments" class="comments-area ath-comments mt-5">


  <?php
  add_filter( 'cancel_comment_reply_link', '__return_false' );

  comment_form(array(
    'title_reply'         => '',
    'title_reply_to'      => '',
    'title_reply_before'  => '',
    'title_reply_after'   => '',
    'cancel_reply_before' => '',
    'cancel_reply_after'  => '',
    'cancel_reply_link'   => '',
    'class_submit'        => 'button medium rpp full blue has-ripple',
    'class_form'          => 'p-4 mb-5',
    'fields'              => array(
      'author'  => '<input id="author" placeholder="Seu nome?" name="author" type="text" value="" size="30" maxlength="245" required="required">',
      'email'   => '<input id="email" placeholder="Seu email?" name="email" type="email" value="" size="30" maxlength="100" required="required">',
    ),
    'comment_field' => '<textarea id="comment" class="p-3" name="comment" cols="45" rows="4" maxlength="65525" required="required" placeholder="Escreva seu comentário..."></textarea><div class="grid-fields mt-3">',
    'submit_button' => '<input name="submit" type="submit" id="submit" class="button small full blue has-ripple" value="Postar"></div>',
    'submit_field'  => '%1$s %2$s',
    'format'        => 'xhtml',
  ));



  // You can start editing here -- including this comment!
  if ( have_comments() ) : ?>
    <h2 class="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ( '1' === $comments_number ) {
        /* translators: %s: post title */
        printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'ath-options' ), get_the_title() );
      } else {
        printf(
          /* translators: 1: number of comments, 2: post title */
          _nx(
            '%1$s Reply to &ldquo;%2$s&rdquo;',
            '%1$s Replies to &ldquo;%2$s&rdquo;',
            $comments_number,
            'comments title',
            'ath-options'
          ),
          number_format_i18n( $comments_number ),
          get_the_title()
        );
      }
      ?>
    </h2>

    <?php
    $infinite_scroll_args = json_encode([
      'page'      => get_query_var( 'cpage' ),
      'order_by'  => get_option( 'default_comments_page', 'newest' ),
      'post_id'   => get_the_ID(),
    ]);
    ?>

    <div class="comment-list infinite-scroll-wrapper" data-infinite-scroll-args="<?php echo esc_attr( $infinite_scroll_args ); ?>">
      <?php
        wp_list_comments( array(
          'avatar_size'   => 70,
          'style'         => 'div',
          'format'        => 'html5',
          'callback'      => 'ath_comment',
          'end-callback'  => 'end_ath_comment',
        ) );
      ?>
    </div>

    <?php
    /*the_comments_pagination( array(
      'prev_text' => '<span class="screen-reader-text">' . __( 'Anterior', 'ath-options' ) . '</span>',
      'next_text' => '<span class="screen-reader-text">' . __( 'Próximo', 'ath-options' ) . '</span>',
    ) );*/

  endif; // Check for have_comments().

  // If comments are closed and there are comments, let's leave a little note, shall we?
  if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <p class="no-comments"><?php _e( 'Os comentários estão desativados para esta publicação.', 'ath-options' ); ?></p>
  <?php
  endif;
  ?>

</div>