<?php 

	Redux::setSection( $opt_name , array(

      'id'    =>'tab-layout',
      'icon'  => 'dashicons dashicons-align-left',
      'title' => esc_html__( 'Layout', 'ath-options' ),
      'desc'  => esc_html__( '', 'ath-options' ),
      'fields'=> array()

   ));



  Redux::setSection( $opt_name , array(

      'id'     => 'tab-layout-home',
      'icon'   => 'dashicons dashicons-arrow-right',
      'title'  => esc_html__( 'Inicial', 'ath-options' ),
      'subsection'=>true,
      'fields' => array(

          array(
            'id'       => 'home_type',
            'type'     => 'image_select',
            'title'    => __('Modelo de página inicial', 'ath-options'), 
            'subtitle' => __('Escolha como a página principal do seu projeto será exibida', 'ath-options'),
            'options'  => array(
                'company'      => array(
                    'title'   => 'Institucional', 
                    'img'   => get_template_directory_uri() .'/assets/images/home-company.png',
                ),
                'blog'      => array(
                    'title'   => 'Blog', 
                    'img'   => get_template_directory_uri() .'/assets/images/home-blog.png'
                )
            ),
            'default' => 'company'
          )

      )
  ));



  Redux::setSection( $opt_name , array(

      'id'     => 'tab-layout-header',
      'icon'   => 'dashicons dashicons-arrow-right',
      'title'  => esc_html__( 'Topo', 'ath-options' ),
      'subsection'=>true,
      'fields' => array(

        array(
          'id'       => 'header_color',
          'type'     => 'color_gradient',
          'title'    => __('Gradiente', 'ligre-options'),
          'transparent'=>false,
          'default'  => array(
              'from' => '#00c7ee',
              'to'   => '#2db0ee'
          )
        ),
        
        

        array(
          'id'       => 'header_type',
          'type'     => 'image_select',
          'title'    => __('Estilo do topo', 'ath-options'), 
          'subtitle' => __('', 'ath-options'),
          'options'  => array(
              'transparent'      => array(
                  'title'   => 'Transparente', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-transparent.png',
              ),
              'full'      => array(
                  'title'   => 'Preenchido', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-full.png'
              )
          ),
          'default' => 'transparent'
        ),



        array(
          'id'       => 'header_content',
          'type'     => 'image_select',
          'title'    => __('Conteúdo do topo', 'ath-options'), 
          'subtitle' => __('', 'ath-options'),
          'options'  => array(
              'feature'      => array(
                  'title'   => 'Destaque', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-feature.png',
              ),
              'posts'      => array(
                  'title'   => 'Posts recentes', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-posts.png'
              )
          ),
          'default' => 'feature'
        ),

        array(
          'id'       => 'header_bg',
          'type'     => 'image_select',
          'required' => array('header_content','=','feature'),
          'title'    => __('Plano de fundo', 'ath-options'), 
          'subtitle' => __('', 'ath-options'),
          'options'  => array(
              'picture'   => array(
                  'title' => 'Imagem lateral', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-image-side.png'
              ),
              'full'      => array(
                  'title' => 'Imagem preenchida', 
                  'img'   => get_template_directory_uri() .'/assets/images/header-image-full.png',
              )
          ),
          'default' => 'picture'
        ),


        array(
          'id'=>'header_title',
          'type' => 'text',
          'title' => __('Título', 'ath-options'),
          'required' => array('header_content','=','feature'),
          'default' => 'Produção de conteúdo para construir sua autoridade memorável online',
        ),

        array(
          'id'=>'header_subtitle',
          'type' => 'text',
          'title' => __('Sub-título', 'ath-options'),
          'required' => array('header_content','=','feature'),
          'default' => 'Marketing de Conteúdo',
        ),

        array(
          'id'=>'header_button',
          'type' => 'text',
          'title' => __('Botão, texto', 'ath-options'),
          'required' => array('header_content','=','feature'),
          'default' => 'Saiba mais',
        ),

        array(
          'id'=>'header_button_url',
          'type' => 'text',
          'title' => __('Botão, URL', 'ath-options'),
          'required' => array('header_content','=','feature'),
          'default' => 'https://www.viverdeblog.com',
        ),

        array(
          'id'        => 'header_image',
          'type'      => 'media',
          'required' => array('header_content','=','feature'),
          'title'     => esc_html__( 'Imagem', 'ath-options' ),
          'default'   => array( 'url' =>get_template_directory_uri().'/assets/images/header-image.png'),
        ),


      )
  ));


  Redux::setSection( $opt_name , array(

      'id'     => 'tab-layout-footer',
      'icon'   => 'dashicons dashicons-arrow-right',
      'title'  => esc_html__( 'Rodapé', 'ath-options' ),
      'subsection'=>true,
      'fields' => array(

          array(
              'id'=>'footer_copyright',
              'type' => 'text',
              'title' => __('Copyright', 'ath-options'), 
              'default' => 'Todos os direitos reservados.',
          ),

      )
  ));

	
  Redux::setSection( $opt_name , array(

        'id'     => 'tab-layout-article',
        'icon'   =>'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Artigos', 'ath-options' ),
        'desc'   => esc_html__( 'Exibição de ítens nos artigos', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(


            // array(
            //   'id'       => 'article_time',
            //   'type'     => 'switch',
            //   'title'    => __('Tempo de leitura', 'ath-options'), 
            //   'default'  => '1'// 1 = on | 0 = off
            // ),

            // array(
            //   'id'       => 'article_focus',
            //   'type'     => 'switch',
            //   'title'    => __('Leitura em foco', 'ath-options'), 
            //   'default'  => '1'// 1 = on | 0 = off
            // ),

            array(
              'id'       => 'article_thumbnail',
              'type'     => 'switch',
              'title'    => __('Thumbmail', 'ath-options'),
              'default'  => '1'// 1 = on | 0 = off
            ),

            array(
              'id'       => 'article_author',
              'type'     => 'switch',
              'title'    => __('Autor e descrição', 'ath-options'), 
              'default'  => '1'// 1 = on | 0 = off
            ),

            array(
              'id'       => 'article_date',
              'type'     => 'switch',
              'title'    => __('Data', 'ath-options'), 
                'default'  => '1'// 1 = on | 0 = off
            ),

            // array(
            //   'id'       => 'article_date_format',
            //   'type'     => 'select',
            //   'title'    => 'Formato da data',
            //   'options'  => array(
            //     'a'=>'01 de Janeiro de 2018',
            //     'b'=>'01 de Janeiro de 2018 00:00',
            //     'c'=>'01/01/2018',
            //     'd'=>'01/01/2018 00:00',
            //   ),
            //   'default'=> 'a',
            //   'required' => array('article_date', '=', true),
            // ),

            array(
              'id'       => 'article_tags',
              'type'     => 'switch',
              'title'    => __('Tags', 'ath-options'), 
              'default'  => '1'// 1 = on | 0 = off
            ),

            // array(
            //   'id'       => 'article_comments_total',
            //   'type'     => 'switch',
            //   'title'    => __('Total de comentários', 'ath-options'), 
            //   'default'  => '1'// 1 = on | 0 = off
            // ),

            array(
              'id'       => 'article_related_posts',
              'type'     => 'switch',
              'title'    => __('Artigos relacionados', 'ath-options'), 
              'default'  => '1'// 1 = on | 0 = off
            ),

            array(
              'id'=>'article_comments_title',
              'type' => 'text',
              'title' => __('Título comentários', 'ath-options'), 
              'default' => 'Hey,',
            ),

            array(
              'id'=>'article_comments_description',
              'type' => 'text',
              'title' => __('Descrição comentários', 'ath-options'), 
              'default' => 'o que você achou deste conteúdo? Conte nos comentários.',
            ),

        )
      )
  );


  Redux::setSection( $opt_name , array(

        'id'     => 'tab-layout-search',
        'icon'   =>'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Pesquisa', 'ath-options' ),
        'desc'   => esc_html__( '', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(

            array(
              'id'=>'search_placeholder',
              'type' => 'text',
              'title' => __('Etiqueta', 'ath-options'), 
              'default' => 'Sobre o que você quer aprender?',
            ),

        )
      )
  );



  Redux::setSection( $opt_name , array(

        'id'     => 'tab-layout-thumbnails',
        'icon'   =>'dashicons dashicons-arrow-right',
        'title'  => esc_html__( 'Thumbnails', 'ath-options' ),
        'desc'   => esc_html__( 'Escolha como as thumbnails serão exibidas no site', 'ath-options' ),
        'subsection'=>true,
        'fields' => array(

          array(
            'id'       => 'layout_thumbnails',
            'type'     => 'image_select',
            'title'    => __('Conteúdo do topo', 'ath-options'), 
            'subtitle' => __('', 'ath-options'),
            'options'  => array(
                'fill'      => array(
                    'title'   => 'Preenchido', 
                    'img'   => get_template_directory_uri() .'/assets/images/panel-thumb-fill.png',
                ),
                'transparent'      => array(
                    'title'   => 'Transparente', 
                    'img'   => get_template_directory_uri() .'/assets/images/panel-thumb-transparent.png'
                )
            ),
            'default' => 'fill'
          ),

          array(
            'id'   => 'layout_thumbnail_sample',
            'type' => 'info',
            'desc' => __(' <i class="dashicons dashicons-download"></i> <a href="'. get_template_directory_uri() .'/assets/images/thumbnail-padrao.png" target="_blank">Clique aqui</a> para baixar o template padrão para os thumbnails (1280px por 720px).', 'ath-options')
          )



        )
      )
  );
?>