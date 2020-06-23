<?php 
  if(get_option('ath-onboard') === false){
    add_option('ath-onboard','0');
    $onboard = '0';  
  }else{
    $onboard = get_option('ath-onboard');
  }
?>

<div class="ui modal" id="ath-admin-onboard" data-onboard="<?php echo $onboard; ?>" data-url="<?php echo get_bloginfo('url'); ?>/wp-admin">
  
  <i class="close icon"></i>
  
  <div class="image content slide" data-slide="1">
    <div class="image">
      <img src="https://image.shutterstock.com/image-vector/virtual-relationships-online-dating-social-450w-777064027.jpg" alt="">
    </div>
    <div class="description">
      <div class="description-wrapper">
        <h3 class="ath-font-header">Seja bem-vindo(a) ao Athena!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing eligulpt. Doloribus ea cumque velit doloremque harum, assumenda provident laboriosam obcaecati optio rem? Hic molestias enim dignissimos, quibusdam, placeat totam pariatur expedita sint!</p>
      </div>
    </div>
  </div>

  <div class="image content slide hide-this" data-slide="2">
    <div class="image">
      <img src="https://image.shutterstock.com/image-vector/girl-sitting-on-sofa-works-450w-769335463.jpg" alt="">
    </div>
    <div class="description">
      <div class="description-wrapper">
        <h3>Já criamos as principais páginas, deseja criar mais alguma?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
      </div>
    </div>
  </div>

  <div class="image content slide hide-this" data-slide="3">
    <div class="image">
      <img src="https://image.shutterstock.com/image-vector/fast-delivery-concept-van-man-450w-737486248.jpg" alt="">
    </div>
    <div class="description">
      <div class="description-wrapper">
        <h3 class="ath-font-header">Como deseja a sua página inicial?</h3>
        <p>Seleção do template Institucional ou Blog</p>
      </div>
    </div>
  </div>

  <div class="image content slide hide-this" data-slide="4">
    <div class="image">
      <img src="https://image.shutterstock.com/image-vector/fast-delivery-concept-warehouse-loader-450w-737526988.jpg" alt="">
    </div>
    <div class="description">
      <div class="description-wrapper">
        <h3 class="ath-font-header">Podemos inserir nosso conteúdo de teste?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum minima laborum magni in quia tenetur soluta necessitatibus</p>
      </div>
    </div>
  </div>

  <div class="image content slide hide-this" data-slide="5">
    <div class="image">
      <img src="https://image.shutterstock.com/image-vector/fast-delivery-concept-office-workers-450w-737566225.jpg" alt="">
    </div>
    <div class="description">
      <div class="description-wrapper">
        <h3 class="ath-font-header">Parabéns! Agora é começar a inserir seu conteúdo :)</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="ui tiny progress progress-slide">
      <div class="bar ath-gradient"></div>
    </div>
  </div>
  <div class="actions">
      <div class="ui right labeled icon button tiny blue mb-3 next-slide" data-slide="1">
        Avançar
        <i class="angle right icon"></i>
      </div>
  </div>

</div>

<script type="text/javascript">

 // jQuery(document).ready(function(){
		
 //    if(jQuery('#ath-admin-onboard').data('onboard') == '0'){

 //        // MODAL
        
 //        var modal = jQuery('.ui.modal');
 //        modal.modal({
 //          closable: false,
 //          dimmerSettings: {
 //            variation: 'inverted'
 //          }
 //        });
 //        modal.modal('show');

 //        // CARROUSEL

 //        var slide    = modal.find('.slide');
 //        var nslides  = slide.length;
 //        var button   = modal.find('.actions .next-slide');
 //        var progress = jQuery('.progress-slide').progress({percent:(100/nslides)});

 //        button.on('click',function(e){
 //          var $this = jQuery(this);
 //          if(!$this.hasClass('close')){
 //              slide.addClass('hide-this');
 //              modal.find('*[data-slide="'+ ($this.data('slide')+1) +'"]').removeClass('hide-this');
 //              progress.progress('increment',(100/nslides));
 //              if($this.data('slide') == (modal.find('.slide').last().data('slide') - 1)){
 //                button.html('Finalizar <i class="check icon"></i>').addClass('close');
 //              } 
 //              $this.data('slide',($this.data('slide') + 1));
 //          }else{

 //            var jqxhr = jQuery.post(
 //              ATH_Ajax.url,
 //              {
 //                action    : 'ath-onboard',
 //                nonce     : ATH_Ajax.nonce,
 //                option    : '1'
 //              },
 //              function(response) {
 //                window.location.href = jQuery('#ath-admin-onboard').data('url');
 //              }
 //            ).fail(function() {
 //              console.log('# FAIL');
 //              console.log(response);
 //            }).done(function() {
 //              console.log('# DONE');
 //            }).always(function() {
 //              console.log('# END');
 //            });

 //            modal.modal('hide');
          
 //          }//else
        
 //        });
 //    }

	// });
</script>