<?php


  /*
   *
   * ID
   *
   */

  global $ath_options;
  $uid = 'ath-block-index';


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

  $title = get_field('title') ?: 'Índice de conteúdo';
  $closed = get_field('closed');
  $closed_status = get_field('closed') == true ? 'fechado' : 'aberto';
  $subtopics = get_field('subtopics');
  $subtopics_status = get_field('subtopics') == true ? 'não serão exibidos' : 'serão exibidos';


?>

<!-- px-5 py-4 my-5 -->
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class="index">
    <?php if(!is_admin()): ?>
      <div class="content"></div>
    <?php endif; ?>
    <?php if(is_admin()): ?>
    <div class="content-preview"></div>
    <?php endif; ?>
  </div>  
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){


    var title     = "<?php echo $title;?>"; 
    var closed    = <?php echo get_field('closed') == true ? 'true' : 'false'; ?>;
    var subtopics = <?php echo get_field('subtopics') == true ? 'true' : 'false'; ?>;
    
    var block   = jQuery("#<?php echo $id;?> .<?php echo !is_admin() ? 'content':'content-preview'; ?>");
    var content = jQuery(".ath-article.single");
    var headers = ( subtopics == true ? "h1,h2,h3" : "h1,h2,h3,h4,h5,h6" );

    if(content.size() >= 1){
      
      block.append("<h5 class='mb-3 index-title'><i class=''></i><?php echo $title;?> <a href='#'><i class='"+ (closed == true ? 'icon plus':'icon close') +"'></i></a></h5>");
      block.append("<ul class='my-0 "+ (closed == true ? 'hidden' : '') +"'></ul>");


      // CONTROLE DE EXIBIÇÃO

      block.find('.index-title a').on('click',function(e){
        e.preventDefault();
        icon = jQuery(this).find('i');
        block.find('ul').toggleClass('hidden');
        // icon.text() == 'plus' ? icon.text('close') : icon.text('plus');
        icon.hasClass('plus') ? icon.removeClass('icon plus').addClass('icon close') : icon.removeClass('icon close').addClass('icon plus');
        return false;
      });

      // LISTANDO TÓPICOS
      
      content.find(headers).not('.index-title,.ath-cta h5,.ath-cta h3').each(function(){
        
        var anchor  = theme_slug(jQuery(this).text());
        var classes = jQuery(this).is("h4") || jQuery(this).is("h5") || jQuery(this).is("h6") ? "pl-3" : "";
        
        jQuery(this).attr("id",anchor);
        if(jQuery(this).text() != title){
          block.find("ul").append("<li class='font-16 font-15-xs lh-22-xs "+ classes +"'><a href='#"+ anchor +"'>"+ jQuery(this).text() +"</a></li>");
        }
      
      });
      if(jQuery(window).width() <= 680){
        block.removeClass("px-5").addClass("px-4");
      }
    
    }else{

      var preview  = '<div class="tag">';
          preview += 'Tópicos';
          preview += '</div>';
          preview += '<div class="content">';
          preview += '<ul>';
          preview += '<li><b>Título:</b> <?php echo $title; ?></li>';
          preview += '<li><b>Subtópicos:</b> <?php echo $subtopics_status; ?></li>';
          preview += '<li><b>Iniciará:</b> <?php echo $closed_status; ?></li>';
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