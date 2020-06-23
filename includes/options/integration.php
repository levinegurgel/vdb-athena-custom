<?php 

	Redux::setSection( $opt_name , array(

	      'id'    =>'tab-integrations',
	      'icon'  => 'dashicons dashicons-admin-plugins',
	      'title' => esc_html__( 'Integrações', 'ath-options' ),
	      'desc'  => esc_html__( '', 'ath-options' ),
   ));

	Redux::setSection( $opt_name , array(

      'id'     => 'tab-integrations-tools',
      'icon'   => 'dashicons dashicons-arrow-right',
      'title'  => esc_html__( 'Ferramentas', 'ath-options' ),
      'subsection'=>true,
      'fields' => array(

    			array(
					    'id'=>'ga_code',
					    'type' => 'text',
					    'title' => __('Google Analytics', 'ath-options'), 
					    'subtitle' => __('Insira o código de identificação fornecido pelo Google Analytics.', 'ath-options'),
					    'default' => '',
					),

          array(
              'id'       => 'int-mailchimp',
              'type'     => 'text',
              'title'    => __('Mailchimp', 'ath-options'),
              'subtitle' => __('Mailchimp API', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ac-url',
              'type'     => 'text',
              'title'    => __('Active Campaign, Url', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ac-token',
              'type'     => 'text',
              'title'    => __('Active Campaign, Token', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ck-api',
              'type'     => 'text',
              'title'    => __('ConvertKit, Api Key', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ck-secret',
              'type'     => 'text',
              'title'    => __('ConvertKit, Api Secret', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ml-api',
              'type'     => 'text',
              'title'    => __('Mailer Lite, Api Key', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-gr-api',
              'type'     => 'text',
              'title'    => __('Get Response, Api Key', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-ml-api',
              'type'     => 'text',
              'title'    => __('Mailer Lite, Api Key', 'ath-options'),
              // 'subtitle' => __('', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-mautic',
              'type'     => 'text',
              'title'    => __('Mautic', 'ath-options'),
              'subtitle' => __('Domínio Mautic. Sem "/" no fim da url', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-rdstation',
              'type'     => 'text',
              'title'    => __('RD Station, token privado', 'ath-options'),
              'subtitle' => __('Onde encontrar: <a href="https://app.rdstation.com.br/integracoes/tokens" target="_blank"><i class="el el-info-circle"></i></a>', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-rdstation-public',
              'type'     => 'text',
              'title'    => __('RD Station, token público', 'ath-options'),
              'subtitle' => __('Onde encontrar: <a href="https://app.rdstation.com.br/integracoes/tokens" target="_blank"><i class="el el-info-circle"></i></a>', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-egoi',
              'type'     => 'text',
              'title'    => __('E-goi, Api Key', 'ath-options'),
              'subtitle' => __('Onde encontrar: <a href="https://bo31.e-goi.com/?action=ui#/integrations" target="_blank"><i class="el el-info-circle"></i></a>', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-sendinblue',
              'type'     => 'text',
              'title'    => __('Sendiblue, Api Key', 'ath-options'),
              'subtitle' => __('Onde encontrar: <a href="https://account.sendinblue.com/advanced/api" target="_blank"><i class="el el-info-circle"></i></a>', 'ath-options'),
              'default'  => ''
          ),

          array(
              'id'       => 'int-cmonitor',
              'type'     => 'text',
              'title'    => __('Campaign Monitor, Api Key', 'ath-options'),
              // 'subtitle' => __('Onde encontrar: <a href="" target="_blank"><i class="el el-info-circle"></i></a>', 'ath-options'),
              'default'  => ''
          )

      )
      
  ));					

	Redux::setSection( $opt_name , array(

        'id'     => 'tab-integrations-scripts',
        'icon'   => 'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Scripts', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(

						array(
						    'id'=>'script_header',
						    'type' => 'textarea',
						    'title' => __('Scripts no topo', 'ath-options'), 
						    'subtitle' => __('Os scripts serão inseridos na tag <head> no topo do site', 'ath-options'),
						    'validate' => 'js',
						    'default' => '',
						),

						array(
						    'id'=>'script_footer',
						    'type' => 'textarea',
						    'title' => __('Scripts no rodapé', 'ath-options'), 
						    'subtitle' => __('Os scripts serão inseridos no rodapé do site', 'ath-options'),
						    'validate' => 'js',
						    'default' => '',
						)

        )
    ));

?>