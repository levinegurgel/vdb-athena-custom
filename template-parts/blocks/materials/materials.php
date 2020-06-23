<?php

  /*
   *
   * ID
   *
   */

  global $ath_options;
  $uid = 'ath-block-materials';


  /*
   *
   * SETTINGS
   *
   */

  $id = $uid . '-' . $block['id'];
  if( !empty($block['anchor']) ) {
      $id = $block['anchor'];
  }

  $className = $uid;
  if( !empty($block['className']) ) {
      $className .= ' ' . $block['className'];
  }
  if( !empty($block['align']) ) {
      $className .= ' align' . $block['align'];
  }


  /*
   *
   * CAMPOS
   *
   */

  $title    = get_field('title') ?: '';
  $material = get_field('material') ?: 0;

  if(isset($material->ID)):
  
  $mob = new Mobile_Detect;
  $material_title = get_the_title($material->ID);
  $material_terms = wp_get_post_terms( $material->ID, 'material_type' );
  $material_slug = $material_terms[0]->slug;
  $material_type = $material_slug == 'infograficos' ? 'material_infographic' : 'material_ebook' ;
  $material_type_name = $material_terms[0]->name;
  $mail_service = get_field($material_type . '_mail_service',$material->ID);
  $material_file = get_field($material_type.'_file',$material->ID);
  $material_thumb = get_field('material_thumbnail',$material->ID);
  $material_color = get_field('material_color',$material->ID);
  $material_desc = get_field('material_description',$material->ID);
  $file_external = get_field($material_type . '_file_external',$material->ID);
  $file_url = get_field($material_type . '_file_url',$material->ID);
  $red_status = get_field($material_type . '_redirect_status',$material->ID);
  $red_url = get_field($material_type . '_redirect_url',$material->ID);

  if($file_external == true){
    $material_source = $file_url;
  }else{
    $material_source = base64_encode(trim($material_file['url']));
  }

?>

  
  <?php
    /* EBOOKS E INFOGRÁFICOS*/
    if($material_slug == 'ebooks' or $material_slug == 'infograficos'): 
  ?>

  <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="block-material-wrapper">
      <?php if(!is_admin()): ?>
        
        <div class="ath-cta horizontal-2col-form big-shadow">
          <div class="row">
            <div class="col-md-2 col-sm-2">
              <div class="thumb" style="background-color: <?php echo $material_color; ?>;">
                <img src="<?php echo $material_thumb['sizes']['medium']; ?>" alt="">
              </div>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="wrapper">
                <div class="content pt-4 capture-in-shortcode" data-fe="<?php echo $file_external == true ? 1 : 0; ?>" data-f="<?php echo $material_source; ?>">
                  <h5><?php echo $material_type_name; ?></h5>
                  <h3><?php echo $material_title; ?></h3>
                  <?php echo ath_capture_form($mail_service,false,$material->ID); ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>     
    </div>  
  </div>

  <?php endif; ?>

  <?php
    /* VIDEOS */
    if($material_slug == 'videos'):
      $video = get_field('material_video_embed',$material->ID);
      if(!is_admin()):
  ?>

  <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="block-material-video-wrapper my-6">
      <?php if(!empty($video)): ?>
        <div class="ath-cta horizontal-2col-form big-shadow p-4">
          <?php echo $video; ?>
        </div>
      <?php endif ?>
    </div>
  </div>

  <?php 
      endif;
    endif; 
  ?>

  <?php
    /* PODCASTS */
    if($material_slug == 'podcasts'):
      $epi_source = get_field('material_podcast_embed_source',$material->ID);
      $epi_file = get_field('material_podcast_embed_file',$material->ID);
      $epi_embed = get_field('material_podcast_embed',$material->ID);
      if(!is_admin()):
  ?>

  <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="block-material-podcast-wrapper my-6">
      <div class="ath-cta horizontal-2col-form big-shadow p-4">
        <div class="row">
          <div class="col-md-2 col-xs-4">
            <?php 
            if(!empty($material_thumb)):
              echo '<img src="'.$material_thumb['sizes']['ath-thumb-square'].'" style="transform:initial !important;">';
            endif;
            ?>
          </div>
          <div class="col-md-10 col-xs-8">
            <h3 class="font-18 lh-20-xs lh-25"><?php echo $material_title; ?></h3>
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

  <?php 
      endif;
    endif; 
  ?>

<?php endif; //material 0 ?>


<?php if(is_admin()): ?>
  <div class="content-preview">
    <?php 
      $preview  = '<div class="tag">';
      $preview .= 'Material';
      $preview .= '</div>';
      $preview .= '<div class="content">';
      
      if(!empty($material_thumb)):
        $preview .= '<img src="'.$material_thumb['sizes']['medium'].'" style="float: left; max-height: 50px; margin-right: 16px;">';
      endif;

      $preview .= '<ul>';
      $preview .= '<li><b>Material:</b> '. ( isset($material->ID) ? $material_title : 'Nenhum material selecionado.' ) .'</li>';
      $preview .= '<li><b>Tipo:</b> '. ( isset($material->ID) ? $material_type_name : '-' ) .'</li>';
      $preview .= '</ul>';
      $preview .= '</div>';
    ?>
    <div class='ath-block-no-preview'><?php echo $preview; ?></div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  jQuery(document).ready(function(){

    var block   = jQuery("#<?php echo $id;?> .<?php echo !is_admin() ? 'content':'content-preview'; ?>");
    var content = jQuery(".ath-article.single");    
    if(content.size() >= 1){}else{}

  });
</script>

<style>
  #<?php echo $id; ?>{}
  .acf-block-preview .<?php echo $uid; ?>{}
</style>