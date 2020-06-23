<?php


  /*
   *
   * ID
   *
   */

  global $ath_options;
  $uid = 'ath-block-capture-shortcode';


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

  $position = get_field('position');
  $title = get_field('title') ?: $ath_options['capture_'. $position .'_title'];
  $subtitle = get_field('subtitle') ?: $ath_options['capture_'. $position .'_subtitle'];


?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <?php if(!is_admin()): ?>
    <div class="content">
      <?php echo do_shortcode('[ath_capture title="'. $title .'" subtitle="'. $subtitle .'" ]'); ?>
    </div>
  <?php endif; ?>
  <?php if(is_admin()): ?>
    <div class="content-preview"></div>
  <?php endif; ?>  
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){


    var title  = "<?php echo $title;?>";
    var block  = jQuery("#<?php echo $id;?> .content-preview");
    
    if(jQuery('body').hasClass('wp-admin')){
      
      var preview  = '<div class="tag">';
          preview += 'Captura';
          preview += '</div>';
          preview += '<div class="content">';
          preview += '<ul>';
          preview += '<li><b>Título:</b> <?php echo $title; ?></li>';
          preview += '<li><b>Legenda:</b> <?php echo $subtitle; ?></li>';
          preview += '</ul>';
          preview += '</div>';

      block.append("<div class='ath-block-no-preview'>"+ preview +"</div>");

    }//if

  });
</script>

<style>
  #<?php echo $id; ?>{}
  .acf-block-preview .<?php echo $uid; ?>{}
</style>