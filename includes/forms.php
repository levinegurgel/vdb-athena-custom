<?php 

  function ath_capture_form($service,$position='header',$material=false,$uid=false){

    
    global $ath_options;
    global $single;
    
    $capture = "";

    if($uid == false or empty($uid)){
      $uid = 'ath-form-'. $position .'-'. rand(99,999) .'-'. rand(999,9999); 
    }
    
    if($position != false){

      $field_name_status = $ath_options['capture_'. $position .'_name_status'];
      $field_name = $ath_options['capture_'. $position .'_name'];
      $field_mail = $ath_options['capture_'. $position .'_mail'];
      $field_button = $ath_options['capture_'. $position .'_button_label'];
      $field_redirect_status = $ath_options['capture_'. $position .'_redirect_status'];
      $field_redirect_url = $ath_options['capture_'. $position .'_redirect_url'];
      $form_classes = $field_name_status == false ? '' : '';

    }else{

      $field_name_status = false;
      $field_name = '';
      $field_mail = 'Qual seu email?';
      $field_button = get_field('material_button',( isset($single->ID) ? $single->ID : $material ));
      $form_classes = $field_name_status == false ? '' : '';

      if(empty($field_button)){
        $field_button = 'Baixar material';
      }

      if(!is_int($material)){
        $mat_ID   = $single->ID; 
        $mat_type = $single->types[0]->slug == 'infograficos' ? 'material_infographic' : 'material_ebook';
      }else{
        $material_terms = wp_get_post_terms( $material, 'material_type' );
        $material_slug = $material_terms[0]->slug;
        $mat_ID = $material; 
        $mat_type = $material_slug == 'infograficos' ? 'material_infographic' : 'material_ebook';
      }
    }


    if($field_name_status == false){
      if(is_tablet()){
        $form_classes = '';
      }
      if(is_phone()){
        $form_classes = 'mt-3';
      }
    }

    $message_error   = !empty($ath_options['capture_'. $position .'_return_error']) ? $ath_options['capture_'. $position .'_return_error'] : 'Opa, algo não deu certo.';
    $message_success = !empty($ath_options['capture_'. $position .'_return_success']) ? $ath_options['capture_'. $position .'_return_success'] : 'Parabéns, você foi inscrito com sucesso!';


  /*
   *
   * HONEYPOT
   */  
  
    $honeyfield = '<input name="lastname" type="text" value="" class="ath-honeyfield" />';


  /*
   *
   * RETURN BOX
   *
   */


    $returnBox  = '<div class="return-message hidden" data-error="'. $message_error .'" data-success="'. $message_success .'">';
    $returnBox .= '<div class="">';
    $returnBox .= '';
    $returnBox .= '</div>';
    $returnBox .= '</div>';
    

  /*
   *
   * MAILCHIMP
   *
   */

    
    if($service == 1){

      if($material != false){
        $ath_options['capture_'. $position .'_mc_list'] = get_field($mat_type . '_mc_list',$mat_ID);
        $ath_options['capture_'. $position .'_mc_do'] = get_field($mat_type . '_mc_do',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'FNAME';
      $ident_email = 'EMAIL';
      
      if($material != false){
        $double = ( get_field($mat_type . '_mc_do',$mat_ID) == true ? 1 : 0 );
      }else{
        $double = ( $ath_options['capture_'. $position .'_mc_do'] == true ? 1 : 0 );
      }

      $capture .= '<form id="'. $uid .'" class="ath-capture '. $form_classes .'" data-service="1">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_mc_list'] .'"/>';
      $capture .= '<input type="hidden" name="double" value="'. $double .'"/>';
      
      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }


      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }



    /*
     *
     * ACTIVE CAMPAIGN
     *
     */


    if($service == 2){

      if($material != false){
        $ath_options['capture_'. $position .'_ac_form_list_id'] = get_field($mat_type . '_ac_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="2" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_ac_form_list_id'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }



    /*
     *
     * CONVERT KIT
     *
     */


    if($service == 3){

       if($material != false){
        $ath_options['capture_'. $position .'_ck_form_list_id'] = get_field($mat_type . '_ck_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="3" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_ck_form_list_id'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }


    /*
     *
     * LEAD LOVERS
     *
     */


    if($service == 4){

      if($material != false){
        $ath_options['capture_'. $position .'_ll_form_id'] = get_field($mat_type . '_ll_form_id',$mat_ID);
        $ath_options['capture_'. $position .'_ll_form_uid'] = get_field($mat_type . '_ll_form_uid',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture no-api" method="post" data-service="4" target="_blank" action="https://leadlovers.com/Pages/Index/'. $ath_options['capture_'. $position .'_ll_form_id'] .'">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="id" value="' . $ath_options['capture_'. $position .'_ll_form_id'] . '">
      <input name="pid" type="hidden" value="' . $ath_options['capture_'. $position .'_ll_form_uid'] . '" />
      <input name="list_id" type="hidden" value="' . $ath_options['capture_'. $position .'_ll_form_id'] . '" />
      <input name="provider" type="hidden" value="'. get_bloginfo('name') .'" />';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }



    /*
     *
     * MAUTIC
     *
     */


    if($service == 5){

       if($material != false){
        $ath_options['capture_'. $position .'_mau_form_id'] = get_field($mat_type . '_mau_form_id',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'mauticform[name]';
      $ident_email = 'mauticform[email]';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="5" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="mauticform[formId]" value="'. $ath_options['capture_'. $position .'_mau_form_id'] .'">';
      $capture .= '<input type="hidden" name="mauticform[domain]" value="'. $ath_options['int-mautic']  .'"/>';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }



    /*
     *
     * GET RESPONSE
     *
     */


    if($service == 6){

      if($material != false){
        $ath_options['capture_'. $position .'_gr_form_list_id'] = get_field($mat_type . '_gr_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="6" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_gr_form_list_id'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }



    /*
     *
     * MAILER LITE
     *
     */


    if($service == 7){

      if($material != false){
        $ath_options['capture_'. $position .'_ml_form_list_id'] = get_field($mat_type . '_ml_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="7" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="groups[]" value="'. $ath_options['capture_'. $position .'_ml_form_list_id'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }




    /*
     *
     * RD Station
     *
     */


    if($service == 8){

      if($material != false){
        $ath_options['capture_'. $position .'_rd_identifier'] = get_field($mat_type . '_rd_identifier',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="8" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="identifier" value="'. $ath_options['capture_'. $position .'_rd_identifier'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }




    /*
     *
     * E-GOI
     *
     */


    if($service == 9){

      if($material != false){
        $ath_options['capture_'. $position .'_eg_list'] = get_field($mat_type . '_eg_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="9" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_eg_list'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }




    /*
     *
     * SENDINBLUE
     *
     */


    if($service == 10){

      if($material != false){
        $ath_options['capture_'. $position .'_sb_list'] = get_field($mat_type . '_sb_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="10" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_sb_list'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }




    /*
     *
     * CAMPAIGN MONITOR
     *
     */


    if($service == 11){

      if($material != false){
        $ath_options['capture_'. $position .'_cm_list'] = get_field($mat_type . '_cm_list',$mat_ID);
        $field_redirect_status = get_field($mat_type . '_redirect_status',$mat_ID);
        $field_redirect_url = get_field($mat_type . '_redirect_url',$mat_ID);
      }

      $ident_name  = 'name';
      $ident_email = 'email';

      $capture .= '<form id="'. $uid .'" class="ath-capture" method="post" data-service="11" enctype="multipart/form-data">';
      $capture .= $returnBox;
      $capture .= '<input type="hidden" name="capture-service" value="'. $service .'"/>';
      $capture .= '<input type="hidden" name="list" value="'. $ath_options['capture_'. $position .'_cm_list'] .'">';

      if($field_redirect_status == true){
        $capture .= '<input type="hidden" name="redirect" value="'. $field_redirect_url .'">';
      }

      $capture .= '
        <div class="ui form mt-4">
          <div class="'. ($field_name_status == true ? 'three':'two') .' fields">';
      
      if($field_name_status == true){
        $capture .= '
              <div class="field mt-2">
                <input type="text" name="'. $ident_name .'" placeholder="'. $field_name .'"  data-validation="required">
              </div>';        
      }

      $capture .= '
            <div class="field mt-2">
              <input type="email" name="'. $ident_email .'" placeholder="'. $field_mail .'"  data-validation="required">
              '. $honeyfield .'
            </div>
            <div class="field mt-2">
              <button class="ui button submit full-width">'.  $field_button .'</button>
            </div>
          </div>
        </div>';

      $capture .= '</form>';
    }




    /*
     *
     * SCRIPT
     *
     */

    $capture .= '<script type="text/javascript">';
    $capture .= 'jQuery(document).ready(function(){';
    $capture .= 'theme_capture("#'. $uid .'","'. $ident_name .'","'. $ident_email .'");';
    $capture .= '});';
    $capture .= '</script>';

    return $capture;

  }


?>