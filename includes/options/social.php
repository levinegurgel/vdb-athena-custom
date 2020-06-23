<?php 

	Redux::setSection( $opt_name , array(

      'id'    =>'tab-social',
      'icon'  => 'dashicons dashicons-share',
      'title' => esc_html__( 'Social', 'ath-options' ),
      'desc'  => esc_html__( '', 'ath-options' ),

   ));

   Redux::setSection( $opt_name , array(

        'id'     => 'tab-social-networks',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Redes Sociais', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(

          array(
              'id'        => 'social_facebook',
              'type'      => 'text',
              'title'     => esc_html__( 'Facebook', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua página no Facebook', 'ath-options' ),
              'default'   => 'https://www.facebook.com/viverdeblog/',
          ),
          
          array(
              'id'        => 'social_instagram',
              'type'      => 'text',
              'title'     => esc_html__( 'Instagram', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua conta no Instagram', 'ath-options' ),
              'default'   => 'https://www.instagram.com/viverdeblog',
          ),

          array(
              'id'        => 'social_twitter',
              'type'      => 'text',
              'title'     => esc_html__( 'Twitter', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua conta no Twitter', 'ath-options' ),
              'default'   => '',
          ),


          array(
              'id'        => 'social_whatsapp',
              'type'      => 'text',
              'title'     => esc_html__( 'Whatsapp', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o link para seu contato ou grupo', 'ath-options' ),
              'default'   => '',
          ),

          array(
              'id'        => 'social_linkedin',
              'type'      => 'text',
              'title'     => esc_html__( 'Linkedin', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua página no Linkedin', 'ath-options' ),
              'default'   => '',
          ),

          array(
              'id'        => 'social_youtube',
              'type'      => 'text',
              'title'     => esc_html__( 'Youtube', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua página no Youtube', 'ath-options' ),
              'default'   => 'https://www.youtube.com/channel/UCk_803JFTku1ycwoAwF3xfg',
          ),

          array(
              'id'        => 'social_pinterest',
              'type'      => 'text',
              'title'     => esc_html__( 'Pinterest', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua página no Pinterest', 'ath-options' ),
              'default'   => '',
          ),

          array(
              'id'        => 'social_soundcloud',
              'type'      => 'text',
              'title'     => esc_html__( 'SoundCloud', 'ath-options' ),
              'subtitle'      => esc_html__( 'Digite o endereço da sua página no SoundCloud', 'ath-options' ),
              'default'   => '',
          ),

        )

    ));


   Redux::setSection( $opt_name , array(

        'id'     => 'tab-social-share',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Compartilhamento', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(


            array(
                'id'       => 'social_share_position',
                'type'     => 'switch',
                'title'    => __('Posição', 'ath-options'),
                'on'       => 'Esquerda',
                'off'      => 'Direita',
                'default'  => '1'// 1 = on | 0 = off
            ),

            array(
                'id'       => 'social_share_mobile',
                'type'     => 'switch',
                'title'    => __('Mobile', 'ath-options'),
                'on'       => 'Exibir',
                'off'      => 'Esconder',
                'default'  => '1'// 1 = on | 0 = off
            ),

            array(
                'id'       => 'social_share_locations',
                'type'     => 'checkbox',
                'title'    => __('Exibição', 'ath-options'), 
                'subtitle'     => __('Defina onde os botões de compartilhamento serão exibidos', 'ath-options'),         
                'options'  => array(
                    'home' => 'Página inicial',
                    'pages' => 'Páginas em geral',
                    'singles' => 'Artigos'
                ),         
                'default' => array(
                    'home' => '1',
                    'pages' => '1',
                    'singles' => '1'
                )
            ),

            array(
                'id'       => 'social_share_networks',
                'type'     => 'checkbox',
                'title'    => __('Redes sociais', 'ath-options'), 
                'subtitle'     => __('Selecione para quais redes socais deseja compartilhar seu conteúdo', 'ath-options'),         
                'options'  => array(
                    'facebook'  => 'Facebook',
                    'twitter'   => 'Twitter',
                    'linkedin'  => 'Linkedin',
                    'pinterest' => 'Pinterest',
                    'whatsapp'  => 'Whatsapp'
                ),         
                'default' => array(
                    'facebook' => '1',
                    'twitter'  => '1',
                    'linkedin' => '1'
                )
            ),

             array(
                'id'       => 'social_share_whatsapp',
                'type'     => 'textarea',
                'title'    => __('Whatsapp', 'ath-options'), 
                'subtitle' => __('Mensagem padrão quando o usuário compartilhar algum link no whatsapp', 'ath-options'),         
                'default' => 'Gostei muito dessa página e resolvi compartilhar contigo :)'
            ),

        )
    
    ));

?>