<?php
global $ath_options;
global $single;
$single = apply_filters( 'get_material_content', false );
$post->banner = $single;
$type = $single->types[0]->slug == 'infograficos' ? 'material_infographic' : 'material_ebook' ;
$mail_service = get_field($type . '_mail_service');
$file_external = get_field($type . '_file_external');
$file_url = get_field($type . '_file_url');
$mob = new Mobile_Detect;
?>
<div class="ath-overlay overlay-col-2">
    <div class="overlay-wrapper overlay-material result">
        <div class="overlay-brand">
            <a href="<?php echo get_bloginfo('url'); ?>">
                <figure class="brand"></figure>
            </a>
        </div>
        <div class="grid">
            <div class="col ov-h" style="background-color:<?php echo $post->banner->color; ?>;">
                <?php if ( $single->thumbnail ) : ?>
                  <img src="<?php echo $single->thumbnail[0]; ?>" alt="<?php echo esc_attr( $single->title ); ?>" class="image-overlay">
                <?php endif; ?>
                <div class="content">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-sm-offset-3 col-md-offset-3">
                            <article class="vdb-card gratitude right transparent">
                                <h3 class="<?php echo is_phone() ? 'font-50 lh-60 px-3':'font-50 lh-45'; ?> ath-color-white">Seu arquivo está pronto.</h3>
                                <p class="margin-top-30 font-18 ath-font-primary"></p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col image">
                <div class="content"> 
                    <div class="row">
                        <div class="col-md-6 col-sm-8 col-centered">
                          
                          <h2 class="ath-font-header font-28 font-center margin-bottom-35 ath-color-gray-dark <?php echo is_tablet() ? 'mt-6':''; ?>">Baixe gratuitamente seu material</h2>

                          <?php if ($file_external == true): ?>
                            <a href="<?php echo $file_url; ?>" class="button medium rpp full blue full-width margin-bottom-40 margin-top-20 c-pointer">
                            <i class="arrow circle down icon"></i>Baixar</a>
                          <?php else: ?>
                            <a id="ath-download-material-overlay" data-file="<?php echo ( $single->types[0]->slug == 'infograficos' ? $single->infographic_file['url'] : $single->ebook_file['url'] ); ?>" class="button medium rpp full blue full-width margin-bottom-40 margin-top-20 c-pointer" target="_blank" rel="nofollow" ><i class="arrow circle down icon"></i>Baixar</a>
                          <?php endif ?>
                          
                          <h2 class="ath-font-header font-20 font-center mb-4 hidden-xs ath-color-gray-middle">Compartilhar é ajudar!</h2>
                          <p class="ath-font-text font-15 font-center mb-4 hidden-xs" style="line-height: 25px;">Mostre para uma pessoa querida que você se importa com ela. Compartilhe esse conhecimento.</p>

                          <div class="social hidden-xs" style="display: table; margin: auto;">
                              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" class="button outline small open-share-window" style="color: #3B5999 !important;" target="_blank">
                                <i class="icon facebook square"></i>Compartilhar</a>
                              <a href="https://twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>: &url=<?php echo urlencode( get_permalink() ); ?>" style="color: #2DB0EE !important;" class="button outline small open-share-window mx-3" target="_blank"><i class="icon twitter"></i>Tweet</a>
                              <a href="mailto:?subject=<?php the_title(); ?>&amp;body=Olha que material que incrível: <?php the_title(); ?> (<?php the_permalink(); ?>)" style="border-color: #b78a23 !important; color: #b78a23 !important;" class="button outline small secondary">
                                <i class="icon mail"></i>Enviar por email</a>
                          </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<header id="ath-header" class="jumbo full primary land-ebook" data-color="<?php echo $single->color; ?>">

  <div class="container">
    <div class="wrapper-mobile <?php echo is_phone() ? 'px-3':''; ?>">
      <?php get_template_part( 'template-parts/ath-header', 'nav' ); ?>
    </div>
    <div class="row">
      <div class="col-md-5 col-sm-6 <?php echo is_phone() ? 'px-5':''; ?>">

        <div class="cta animated fadeIn full w-100">
          <div class="wrapper">

            <?php if(is_phone()): ?>
              <div class="mt-5">
                <?php if ( $single->thumbnail ) : ?>
                  <img src="<?php echo $single->thumbnail[0]; ?>" class="center-this" alt="<?php echo esc_attr( $single->title ); ?>">
                <?php endif; ?>
              </div>
            <?php endif; ?>

            <h3 class="hidden-xs"><?php echo $single->types[0]->name; ?></h3>
            <h1 class="<?php echo is_phone() ? 'mt-4':''; ?>"><?php echo $single->title; ?></h1>
            <?php if ( $single->description ) : ?>
              <p style="<?php echo is_phone() ? 'width: 100%; line-height: 24px; text-align: center; margin-bottom: 23px;':''; ?>" class="<?php echo is_phone() ? '':'mb-5'; ?>"><?php echo $single->description; ?></p>
            <?php endif; ?>
            <div class="optin <?php echo is_phone() ? '':''; ?>" style="<?php echo is_phone() ? 'width: 100%;':''; ?>">
              <?php echo ath_capture_form($mail_service,false,true); ?>
              <span class="hidden open-overlay-material"></span>
            </div>

          </div>
        </div>

      </div>
      
      <?php if(!is_phone()): ?>
        <div class="col-md-5 col-md-offset-2 col-sm-6">
          <div class="animation full">
            <?php if ( $single->thumbnail ) : ?>
              <div class="wrapper">
                <img src="<?php echo $single->thumbnail_low['url']; ?>" alt="<?php echo esc_attr( $single->title ); ?>" style="max-width: 100%; height: auto;">
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
</header>
<?php if(!is_phone()): ?>
<div class="ath-landing-ebook-footer">
  <div class="container">
    <div class="row footer">
      <div class="col-md-8 col-sm-7">
        <p><?php echo $ath_options['footer_copyright']; ?></p>
      </div>
      <div class="col-md-4 col-sm-5">
        <div class="networks font-15">
          <?php get_template_part( 'template-parts/ath', 'social-links' ) ?>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<?php endif; ?>

<style>
  .ath-capture.sending:before {background: url('<?php echo get_template_directory_uri(); ?>/assets/images/load2.gif') no-repeat center center <?php echo $post->banner->color; ?> !important; background-size: 25px !important; background-position: 10px center !important;  opacity: .9 !important; -webkit-opacity: .9 !important; -moz-opacity: .9 !important;}
</style>