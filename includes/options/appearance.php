<?php 

   global $ath_colors;
   global $ath_options;

   Redux::setSection( $opt_name , array(

            'id'    =>'tab-appearance',
            'icon'  => 'dashicons dashicons-admin-appearance',
            'title' => esc_html__( 'Aparência', 'ath-options' ),
            'desc'  => esc_html__( '', 'ath-options' ),

    ));


  	///////////////////////////////
    /// IDENTIDADE
    ///////////////////////////////

  	
  	Redux::setSection( $opt_name , array(

  	      'id'     => 'tab-appearance-brand',
  	      'icon'   =>'dashicons dashicons-arrow-right',
  	      'title'  => esc_html__( 'Identidade', 'ath-options' ),
  	      'desc'   => esc_html__( 'Identidade do projeto', 'ath-options' ),
  	      'subsection'=>true,
  	      'fields' => array(


  	          array(
  	              'id'        => 'brand',
  	              'type'      => 'media',
  	              'title'     => esc_html__( 'Logotipo', 'ath-options' ),
  	              // 'subtitle'  => esc_html__( 'brandtipo do projeto', 'ath-options' ),
  	              'default'   => array( 'url' =>get_template_directory_uri().'/assets/images/brand-color.png'),
  	          ),

  	          array(
  	              'id'        => 'brand_mono',
  	              'type'      => 'media',
  	              'title'     => esc_html__( 'Logotipo Monocromático', 'ath-options' ),
  	              'default'   => array( 'url' =>get_template_directory_uri().'/assets/images/brand-mono-white.png'),
  	          ),

  	          array(
  	              'id'        => 'brand_favicon',
  	              'type'      => 'media',
  	              'title'     => esc_html__( 'Favicon', 'ath-options' ),
  	              'subtitle'  => esc_html__( 'Icone das abas dos navegadores' ),
  	              'default'   => array( 'url' =>get_template_directory_uri().'/assets/images/brand-icon-mono.png'),
  	          ),

  	      ) )

  	 );


    ///////////////////////////////
    /// TIPOGRAFIA
    ///////////////////////////////


    Redux::setSection( $opt_name , array(

            'icon'      => 'dashicons dashicons-arrow-right',
            'title'     => esc_html__( 'Fontes', 'ath-options' ),
            // 'desc'      => esc_html__( 'Fontes padrões do projeto.', 'ath-options' ),
            'subsection'=>true,
            'fields'    => array(

                array(
                    'id'       => 'font_header',
                    'type'     => 'typography',
                    'title'    => __( 'Cabeçalhos', 'ath-options' ),
                    // 'subtitle' => __( 'Fonte padrão dos cabeçalhos do projeto', 'ath-options' ),
                    'google'   => true,
                    'font-size'=> false,
                    'color'    => false,
                    'text-align'=>false,
                    'line-height'=>false,
                    'subsets'=>false,
                    'default'  => array(
                        'font-family' => 'Lato',
                        'font-weight' => '900',
                    ),
                ),

                array(
                    'id'       => 'font_text',
                    'type'     => 'typography',
                    'title'    => __( 'Textos', 'ath-options' ),
                    // 'subtitle' => __( 'Fonte padrão dos textos do projeto', 'ath-options' ),
                    'google'   => true,
                    'font-size'=> false,
                    'color'    => false,
                    'text-align'=>false,
                    'line-height'=>false,
                    'subsets'=>false,
                    'default'  => array(
                        'font-family' => 'Lato',
                        'font-weight' => '400',
                    ),
                ),

                array(
                    'id'       => 'font_serif',
                    'type'     => 'typography',
                    'title'    => __( 'Serifa', 'ath-options' ),
                    // 'subtitle' => __( 'Fonte padrão dos textos do projeto', 'ath-options' ),
                    'google'   => true,
                    'font-size'=> false,
                    'color'    => false,
                    'text-align'=>false,
                    'line-height'=>false,
                    'subsets'=>false,
                    'default'  => array(
                        'font-family' => 'Roboto Slab',
                        'font-weight' => '400',
                    ),
                ),

            ) )
    );


    ///////////////////////////////
    /// CORES
    ///////////////////////////////

    Redux::setSection( $opt_name , array(

            'icon'      => 'dashicons dashicons-arrow-right',
            'title'     => esc_html__( 'Cores', 'ath-options' ),
            // 'desc'      => esc_html__( 'Fontes padrões do projeto.', 'ath-options' ),
            'subsection'=>true,
            'fields'    => array(

            array(
              
              'id'        => 'color_mode',
              'type'      => 'radio',
              'title'     => esc_html__( 'Layout', 'ath-options' ),
              'options'   => array(
                'light'   =>'Claro',
                'dark'    =>'Escuro'
              ),
              'default'   => 'light'
            ),

            array(
              
              'id'        => 'color_type',
              'type'      => 'radio',
              'title'     => esc_html__( 'Cores', 'ath-options' ),
              'options'   => array(
                'custom'  =>'Personalizado',
                'pallete' =>'Paleta de cores'
              ),
              'default'   => 'custom'
            ),
        	
        	  array(

              'id'       => 'color_primary',
              'type'     => 'color',
              'title'    => __('Cor primária', 'ath-options'),
              'transparent'=>false,
              'default'  => '#2db0ee',
              'validate' => 'color',
              'required' => array( 'color_type', '=', 'custom' ),
            ),

            array(

              'id'       => 'color_secondary',
              'type'     => 'color',
              'title'    => __('Cor secundária', 'ath-options'),
              'transparent'=>false,
              'default'  => '#00c7ee',
              'validate' => 'color',
              'required' => array( 'color_type', '=', 'custom' ),
            ),

            array(

              'id'       => 'color_action',
              'type'     => 'color',
              'title'    => __('Cor de ação', 'ath-options'),
              'transparent'=>false,
              'default'  => !empty($ath_options['color_primary']) ? $ath_options['color_primary'] : '#46cc6e',
              'validate' => 'color',
              'required' => array( 'color_type', '=', 'custom' ),
            ),

            array(

              'id'       => 'color_text',
              'type'     => 'color',
              'title'    => __('Cor de textos', 'ath-options'),
              'transparent'=>false,
              'default'  => '#3e464f',
              'validate' => 'color',
              'required' => array( 'color_type', '=', 'custom' ),
            ),

            array(

              'id'       => 'color_bg',
              'type'     => 'color',
              'title'    => __('Cor de fundo', 'ath-options'),
              'transparent'=>false,
              'default'  => '#ffffff',
              'validate' => 'color',
              'required' => array( 'color_type', '=', 'custom' ),
            ),

            array(
              
              'id'        => 'color_pallete_mode',
              'type'      => 'radio',
              'title'     => esc_html__( 'Tipo de paletas', 'ath-options' ),
              'options'   => array(
                'light'   =>'Claras',
                'dark'    =>'Escuras'
              ),
              'default'   => 'light',
              'required' => array( 'color_type', '=', 'pallete' ),
            ),

            array(
  	            'id'       => 'color_pallete',
  	            'type'     => 'palette',
  	            'title'    => __( 'Paletas', 'ath-options' ),
  	            'subtitle' => __( '' ),
  	            'required' => array( 'color_pallete_mode', '=', 'light' ),
  	            'default'  => 'vdb',
  	            'palettes' => array(
                    'vdb'  => $ath_colors->pallete(),
  	                'chiclets' => $ath_colors->pallete('chiclets'),
                    'teal' => $ath_colors->pallete('teal'),
                    'ruby' => $ath_colors->pallete('ruby'),
  	            )
  	        ),

            array(
                'id'       => 'color_pallete_dark',
                'type'     => 'palette',
                'title'    => __( 'Paletas', 'ath-options' ),
                'subtitle' => __( '' ),
                'required' => array( 'color_pallete_mode', '=', 'dark' ),
                'default'  => 'cherry',
                'palettes' => array(
                    'cherry' => $ath_colors->pallete('cherry'),
                    'candy' => $ath_colors->pallete('candy'),
                )
            ),

            ) )
    );   

?>