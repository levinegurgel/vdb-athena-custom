<?php


  /*
   *
   * ID
   *
   */

  global $ath_options;
  $uid = 'ath-block-apollo-showcase';


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

  $url = get_field('url');


?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <?php if(!is_admin()): ?>
    <div class="content">
      <div class="ath-block-showcase-cards">
        <?php

          // MONTANDO A VITRINE

          if(!empty($url)){
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url.'?json');
            $result=curl_exec($ch);
            curl_close($ch);

            if(!empty($result)){

              $showcase = json_decode($result, true);

              foreach ($showcase as $i => $v) {

                echo '<div class="ath-showcase-section-title">'. $v['title'] .'</div>';
                echo '<div class="ath-showcase-section-cards">';
                
                if(isset($v['courses'])){

                  foreach ($v['courses'] as $k => $c) {
                    echo '
                    <article class="apl-card vertical course locked  public-showcase">
                      <a href="'. $c['url'] .'" target="_blank">
                      <div class="coverlink"></div>
                      </a>
                      <div class="card-header" style="background: linear-gradient(178.13deg, '. $c['color1'] .' 0%, '. $c['color2'] .' 100%);">
                        <div class="wrapper">
                    ';

                    if(!empty($c['logo_light'])){
                      echo '<img class="brand" src="'. $c['logo_light'] .'" alt="'. $c['name'] .'">';
                    }else{
                      echo '<h3 style="">'. $c['name'] .'</h3>';
                    }

                    echo '<p>'. $c['description'] .'</p>
                          <div class="status locked"></div>
                          <a href="'. $c['url'] .'" class="button-more" target="_blank">Conhecer</a>
                        </div>
                      </div>
                    </article>';
                  }

                }//courses
                
                echo '</div>';

              }

            }else{
              echo 'Não foi possível montar a vitrine de cursos.';
            }
          
          }else{
            echo 'Insira o link para sua vitrine pública do Apollo';
          }


        ?>        
      </div>
    </div>
  <?php endif; ?>
  <?php if(is_admin()): ?>
    <div class="content-preview"></div>
  <?php endif; ?>  
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){

    var block  = jQuery("#<?php echo $id;?> .content-preview");   
    if(jQuery('body').hasClass('wp-admin')){
      
      var preview  = '<div class="tag">';
          preview += 'Vitrine Apollo';
          preview += '</div>';
          preview += '<div class="content">';
          preview += '<ul>';
          preview += '<li><b>Status:</b> <?php echo !empty($url) ? '<span class="dashicons dashicons-yes-alt" style="vertical-align: middle; color: #4caf50;"></span> Vitrine pública conectada' : '<span class="dashicons dashicons-dismiss" style="vertical-align: middle; color:#d14c42;"></span> Insira sua URL para a vitrine pública Apollo'; ?></li>';
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