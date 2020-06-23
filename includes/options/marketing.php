<?php 


	Redux::setSection( $opt_name , array(

      'id'    =>'tab-marketing',
      'icon'  => 'dashicons dashicons-megaphone',
      'title' => esc_html__( 'Marketing', 'ath-options' ),
      'desc'  => esc_html__( '', 'ath-options' ),

  ));


  Redux::setSection( $opt_name , array(

        'id'     => 'tab-marketing-footer',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Promobar', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(

      		array(
              'id'       => 'fbar_status',
              'type'     => 'switch',
              'title'    => __('Status', 'ath-options'),
              'on'			 => 'Ativo',
              'off'			 => 'Inativo', 
              'default'  => '0'// 1 = on | 0 = off
          ),

          array(
              'id'       => 'fbar_mobile',
              'type'     => 'switch',
              'title'    => __('Mobile', 'ath-options'),
              'on'       => 'Exibir',
              'off'      => 'Esconder',
              'default'  => '1'// 1 = on | 0 = off
          ),

          array(
              'id'       => 'fbar_position',
              'type'     => 'switch',
              'title'    => __('Posição', 'ath-options'),
              'on'       => 'Topo',
              'off'      => 'Rodapé', 
              'default'  => '0'// 1 = on | 0 = off
          ),

          array(
            
            'id'=>'fbar_title',
            'type' => 'text',
            'title' => __('Título', 'ath-options'), 
            'default' => '',
          
          ),

          array(
            
            'id'=>'fbar_button_url',
            'type' => 'text',
            'title' => __('Botão, url', 'ath-options'), 
            'default' => '',
          
          ),

          array(
            
            'id'=>'fbar_button_label',
            'type' => 'text',
            'title' => __('Botão, texto', 'ath-options'), 
            'default' => 'Saiba mais',
          
          ),

        	array(

            'id'       => 'fbar_color1',
            'type'     => 'color',
            'title'    => __('Cor primária', 'ath-options'),
            'transparent'=>false,
            'default'  => '#00bbed',
            'validate' => 'color'
          ),

          array(

            'id'       => 'fbar_color2',
            'type'     => 'color',
            'title'    => __('Cor secundária', 'ath-options'),
            'transparent'=>false,
            'default'  => '#00bbed',
            'validate' => 'color'
          ),

      		array(
              'id'        => 'fbar_image',
              'type'      => 'media',
              'title'     => esc_html__( 'Imagem', 'ath-options' ),
              'default'   => array( 'url' =>get_template_directory_uri().'/assets/images/brand-mono-white.png'),
          ),
        )
  ));


  Redux::setSection( $opt_name , array(

        'id'     => 'tab-marketing-capture-header',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Captura - Topo', 'ath-options' ),
        'subsection'=>true,
        'fields' => ath_capture_options('header')
  ));

  
  Redux::setSection( $opt_name , array(

        'id'     => 'tab-marketing-capture-footer',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Captura - Rodapé', 'ath-options' ),
        'subsection'=>true,
        'fields' => ath_capture_options('footer')
  ));


?>