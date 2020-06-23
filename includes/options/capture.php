<?php 
  
  function ath_capture_options($position){

    return array(


      //////////////////////////////////
      // OPÇÕES GERAIS
      //////////////////////////////////


      array(
        'id'       => 'capture_'. $position .'_status',
        'type'     => 'switch',
        'title'    => __('Status', 'ath-options'),
        'on'       => 'Exibir',
        'off'      => 'Esconder',
        'default'  => '1'// 1 = on | 0 = off
      ),

      array(
        
        'id'=>'capture_'. $position .'_title',
        'type' => 'text',
        'title' => __('Título', 'ath-options'), 
        'default' => 'Entre para nossa lista e receba conteúdos exclusivos e com prioridade'          
      ),

      array(
        
        'id'=>'capture_'. $position .'_subtitle',
        'type' => 'text',
        'title' => __('Subtítulo', 'ath-options'), 
        'default' => 'Junte-se a mais de X pessoas'     
      ),

      array(
          
        'id'       => 'capture_'. $position .'_name_status',
        'type'     => 'switch',
        'title'    => __('Exibir campo nome', 'ath-options'),
        'on'       => 'Exibir',
        'off'      => 'Não exibir', 
        'default'  => '0'// 1 = on | 0 = off
      ),

      array(
        
        'id'=>'capture_'. $position .'_name',
        'type' => 'text',
        'title' => __('Campo nome', 'ath-options'), 
        'default' => 'Seu nome',
        'required' => array('capture_name_status','=',1)
      
      ),

      array(
        
        'id'=>'capture_'. $position .'_mail',
        'type' => 'text',
        'title' => __('Campo email', 'ath-options'), 
        'default' => 'Seu email',
      
      ),

      array(
        
        'id'=>'capture_'. $position .'_button_label',
        'type' => 'text',
        'title' => __('Botão', 'ath-options'), 
        'default' => 'Enviar',
      
      ),

      array(
        
        'id'=>'capture_'. $position .'_return_success',
        'type' => 'text',
        'title' => __('Mensagem de sucesso', 'ath-options'), 
        'default' => 'Parabéns, você foi inscrito com sucesso!',
      
      ),

      array(
        
        'id'=>'capture_'. $position .'_return_error',
        'type' => 'text',
        'title' => __('Mensagem de erro', 'ath-options'), 
        'default' => 'Opa, não foi possível você se inscrever neste momento.',
      
      ),

      
      //////////////////////////////////
      // SERVIÇOS DE EMAIL
      //////////////////////////////////



      array(
        'id'       => 'capture_'. $position .'_service',
        'type'     => 'select',
        'title'    => __('Serviço de email', 'ath-options'),
        'subtitle' => __('', 'ath-options'),
        'options'  => array(
            '1' => 'Mailchimp',
            '2' => 'Active Campaign',
            '3' => 'Convert Kit',
            '4' => 'Lead Lovers',
            '5' => 'Mautic',
            '6' => 'Get Response',
            '7' => 'Mailer Lite',
            '8' => 'RD Station',
            '9' => 'E-goi',
            '10'=> 'Sendinblue',
            '11'=> 'Campaign Monitor'
        ),
        'default'  => '1'
      ),


      // MAILCHIMP

      array(
        
        'id'=>'capture_'. $position .'_mc_list',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','1'), 
        'default' => ''
      
      ),

      array(
        'id'       => 'capture_'. $position .'_mc_do',
        'type'     => 'switch',
        'title'    => __('Double Opt-in', 'ath-options'),
        'on'       => 'Ativado',
        'off'      => 'Desativado',
        'required' => array('capture_'. $position .'_service','=','1'), 
        'default'  => '0'// 1 = on | 0 = off
      ),


      // ACTIVE CAMPAIGN

      array(
        
        'id'=>'capture_'. $position .'_ac_form_list_id',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','2'), 
        'default' => ''
      
      ),

      // CONVERT KIT

      array(
        
        'id'=>'capture_'. $position .'_ck_form_list_id',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','3'), 
        'default' => ''
      
      ),

      
      // LEAD LOVERS
      
      array(
        
        'id'=>'capture_'. $position .'_ll_form_uid',
        'type' => 'text',
        'title' => __('Identificador único (PID)', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','4'), 
        'default' => ''
      
      ),

      array(
        
        'id'=>'capture_'. $position .'_ll_form_id',
        'type' => 'text',
        'title' => __('ID do formulário (ID)', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','4'), 
        'default' => ''
      
      ),

      // MAUTIC
      
      array(
        
        'id'=>'capture_'. $position .'_mau_form_id',
        'type' => 'text',
        'title' => __('ID do formulário', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','5'),
        'default' => ''
      
      ),

      // GET RESPONSE
      
      array(
        
        'id'=>'capture_'. $position .'_gr_form_list_id',
        'type' => 'text',
        'title' => __('Token da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','6'),
        'default' => ''
      
      ),

      // MAILER LITE
      
      array(
        
        'id'=>'capture_'. $position .'_ml_form_list_id',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','7'),
        'default' => ''
      
      ),

      // RD Station
      
      array(
        
        'id'=>'capture_'. $position .'_rd_identifier',
        'type' => 'text',
        'title' => __('Identificador', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','8'),
        'default' => ''
      
      ),

      // E-GOI
      
      array(
        
        'id'=>'capture_'. $position .'_eg_list',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','9'),
        'default' => ''
      
      ),

      // SENDINBLUE
      
      array(
        
        'id'=>'capture_'. $position .'_sb_list',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','10'),
        'default' => ''
      
      ),

      // CAMPAIGN MONITOR
      
      array(
        
        'id'=>'capture_'. $position .'_cm_list',
        'type' => 'text',
        'title' => __('ID da lista', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_service','=','11'),
        'default' => ''
      
      ),

      // REDIRECIONAMENTO     

      array(
        'id'       => 'capture_'. $position .'_redirect_status',
        'type'     => 'switch',
        'title'    => __('Redirecionar pós captura', 'ath-options'),
        'on'       => 'Ativado',
        'off'      => 'Desativado',
        'default'  => '0'// 1 = on | 0 = off
      ),

      array(
        
        'id'=>'capture_'. $position .'_redirect_url',
        'type' => 'text',
        'title' => __('URL', 'ath-options'),
        // 'subtitle' => __('<a href="#">O que é isso?</a>', 'ath-options'),
        'required' => array('capture_'. $position .'_redirect_status','=','1'),
        'default' => ''
      
      ),

    );

  }

?>