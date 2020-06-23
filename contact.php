<?php
/* Template Name: Contato */
get_header();

get_template_part( 'template-parts/ath-header', 'internal' );
$color  = get_field('contact_color');
// $color1 = get_field('contact_color_primary');
// $color2 = get_field('contact_color_secondary');
$error   = !empty(get_field('contact_form_error')) ? get_field('contact_form_error') : 'Opa, não conseguimos enviar seu contato neste momento. Tente novamente mais tarde.';
$success = !empty(get_field('contact_form_success')) ? get_field('contact_form_success') : 'Perfeito! Responderemos seu contato o mais breve possível.';
$background  = !empty(get_field('contact_bg')) ? get_field('contact_bg')['sizes']['ath-thumb-mega'] : get_template_directory_uri() . '/assets/images/contact.png';
$mob = new Mobile_Detect;
?>


<div class="ath-banner absolute no-repeat position-bottom-center size-contain no-background-xs" style="background:linear-gradient(-175deg, <?php echo $color1; ?> 0%, <?php echo $color2; ?> 99%);">
  <div class="cover-contact lazy" data-bg="url(<?php echo $background; ?>)" style="background: no-repeat center bottom; background-size: contain;">
    <!-- <img src="<?php echo $background; ?>" alt="Contato"> -->
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-9 col-centered">
        <?php if ( $title = get_field( 'contact_title' ) ) : ?>
        <h1 style="color:<?php echo $color; ?>"><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_field( 'contact_description' ) ) : ?>
        <p style="color:<?php echo $color; ?>"><?php echo $description; ?></p>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-8 col-centered">
        <div class="content rounded shadow-middle">
          <div class="ath-form-box">
            <div class="form-status hidden">
              <div class="success hidden">
                <i class="paper plane icon"></i>
                <h3 class="ath-font-header ath-font-header-weight"><?php echo $success;?></h3>
              </div>
              <div class="error hidden">
                <i class="window close icon"></i>
                <h3 class="ath-font-header ath-font-header-weight"><?php echo $error; ?></h3>
              </div>
            </div>
            <div class="form-header">
              <?php if ( $form_title = get_field( 'contact_form_title' ) ) : ?>
              <h5 class="<?php echo $mob->isMobile() && !$mob->isTablet() ? 'ta-c':''; ?>"><?php echo $form_title; ?></h5>
              <?php endif; ?>
            </div>

            <div class="form-content">
              
              <?php $form_output = apply_filters( 'ath_send_email', false ); ?>
              <form id="ath-contact" class="ui form min">
                
                <?php if ( isset( $_POST['form_ID'] ) ) : ?>
                  <?php if ( false === $form_output ) : ?>
                  <div id="response" class="button outline orange small output">Preencha os campos devidamente...</div>
                  <?php elseif ( 'error' == $form_output->status ) : ?>
                  <div id="response" class="button outline red small output"><?php echo $form_output->message; ?></div>
                  <?php elseif ( 'success' == $form_output->status ) : ?>
                  <div id="response" class="button outline green small output"><?php echo $form_output->message; ?></div>
                  <?php endif; ?>
                <?php endif ?>

                <input type="hidden" name="form_page" id="form_page" value="<?php echo $post->ID ?>">
                <input type="hidden" name="form_subject" id="form_subject" value="<?php echo esc_attr( get_field( 'contact_form_subject' ) ); ?>">
                <input type="hidden" name="form_nonce" id="form_nonce" value="<?php echo wp_create_nonce( ath_nonce_key() ); ?>">
                
                 <div class="ui error message"></div>
                 <?php if ( $form_name = get_field( 'contact_form_name' ) ) : ?>
                   <div class="field">
                    <input type="text" name="form_name" id="form_name" placeholder="<?php echo esc_attr( $form_name ); ?>">
                   </div>
                  <?php endif; ?>
                 <div class="field">
                  <input type="text" name="form_email" id="form_email" placeholder="<?php echo esc_attr( get_field( 'contact_form_email' ) ); ?>">
                 </div>
                 <div class="field">
                  <textarea rows="6" name="form_message" id="form_message" placeholder="<?php echo esc_attr( get_field( 'contact_form_message' ) ); ?>"></textarea>
                 </div>
                 <div class="field">
                  <button class="button full primary full-width submit" id="btnSubmitContact"><?php echo esc_attr( get_field( 'contact_form_submit' ) ); ?></button>
                 </div>
              
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="ath-section ath-contact-social <?php echo $mob->isMobile() && !$mob->isTablet() ? 'mt-4 mb-5' : 'mt-8 mb-5'; ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-sm-6 col-centered <?php echo is_tablet() ? 'mt-7':''; ?>">
        <div class="ath-call center horizontal">
          <?php if ( $social_title = get_field( 'contact_social_title' ) ) : ?>
          <h3><?php echo $social_title; ?></h3>
          <?php endif; ?>
          <?php if ( $social_description = get_field( 'contact_social_description' ) ) : ?>
          <p><?php echo $social_description; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 col-sm-6 col-centered">
          <div class="networks font-30">
            <?php get_template_part( 'template-parts/ath', 'social-links' ) ?>
          </div>
      </div>
    </div>
  </div>
</div>


<?php
  get_template_part( 'template-parts/ath-cta', 'footer' );
  get_footer();
?>
