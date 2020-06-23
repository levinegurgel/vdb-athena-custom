<?php $mob = new Mobile_Detect; ?>
<?php get_header(); ?>
<?php get_template_part( 'template-parts/ath-header', 'internal' ); ?>
<?php 
  global $ath_options;
  $single = apply_filters( 'get_material_content', false );
  $color1 = !empty( get_field('material_color',$post->ID) ) ?  get_field('material_color',$post->ID) : $ath_options['color_primary'];
  $color2 = $color1;
?>


<section class="ath-banner article has-absolute has-capture <?php echo ($single->categories[0]->term_id == 1 ? 'no-category':''); ?>" style="background-color:<?php echo $color1; ?>;">
   <div class="thumbnail hidden-xs hidden-sm">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/deletar/thumbnail-transparent.png" alt="">
   </div>
   <div class="container">
     <div class="row">
       <div class="col-md-8 col-sm-10 col-centered">
         <div class="title">
            <h4><?php echo $single->types[0]->name; ?></h4>
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
                </div>
              </div>

         </div>
       </div>
     </div>
     <div class="row relative">
            <div class="col-md-12 col-sm-11 col-xs-12">

              <div class="banner-audio-player mt-0">
                <div class="row">
                  <div class="col-md-10 col-xs-12 col-centered">
                    <?php 
                      $material_thumb = get_field('material_thumbnail',$post->ID);
                      $epi_source = get_field('material_podcast_embed_source',$post->ID);
                      $epi_file = get_field('material_podcast_embed_file',$post->ID);
                      $epi_embed = get_field('material_podcast_embed',$post->ID);
                    ?>

                    <div class="ath-cta horizontal-2col-form big-shadow p-4">
                      <div class="row">
                        <div class="col-md-12 col-xs-12">
                          <?php 
                            if($epi_source == 'external'){
                              echo !empty($epi_embed) ? $epi_embed : 'Nenhum código inserido.';
                            }else{
                              $args = array(
                                'src' => $epi_file          );
                              echo !empty($epi_file) ? wp_audio_shortcode($args) : 'Nenhum arquivo inserido.';
                            }
                          ?>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
        </div>
   </div>
</section>



<main class="ath-section padding-top-0 margin-bottom-70 margin-top-170-xs">

         <div class="container">
            <div class="row">
               <div class="col-md-10 col-centered">

                  <!-- Início do artigo -->
                  <div class="ath-article single">
                    <?php the_field('material_podcast_content',$single->ID); ?>
                  </div>
                  <!-- Fim do artigo -->


               </div>
            </div>
         </div>

   </main>

<?php
    get_template_part( 'template-parts/ath-showcase', 'podcast' );
    get_template_part( 'template-parts/ath-cta', 'footer' );
    get_footer();
 ?>