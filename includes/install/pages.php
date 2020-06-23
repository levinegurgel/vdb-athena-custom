<?php 
   

/**
 * Páginas padrão
 */


$pages = array(

  // title
  // template
  // meta fields


  /*
   *
   * Inicial
   *
   */


  array(
    'Inicial',
    'front-page.php',
    array(
      'home_header_type'                  => 'transparent',
      'home_header_content'               => 'feature',
      'home_header_bg_type'               => 'picture',
      'home_header_bg_color1'             => '#00c7ee',
      'home_header_bg_color2'             => '#00c7ee',
      // 'home_header_bg_image'              => '127',
      'home_header_title'                 => 'Minha headline fica aqui',
      'home_header_subtitle'              => 'Meu subtítulo fica aqui',
      'home_header_button'                => 'Saiba mais',
      'home_header_button_url'            => 'https://www.google.com',
      'home_call_left_title'              => 'Título da chamada',
      'home_call_left_description'        => 'Descrição da chamada',
      'home_call_left_button'             => 'Saiba mais',
      'home_call_left_button_url'         => 'https://www.google.com',
      'home_call_left'                    => '',
      '_home_call_left'                    => 'field_5be4420a3dfbd',
      'home_call_right_title'             => 'Título da chamada',
      'home_call_right_description'       => 'Descrição da chamada',
      'home_call_right_button'            => 'Saiba mais',
      'home_call_right_button_url'        => 'https://www.google.com',
      'home_call_right'                   => '',
      '_home_call_right'                   => 'field_5be442b93dfc2',
      'home_articles_title'               => 'Nossos artigos',
      'home_articles_description'         => 'Descrição da vitrine de artigos',
      'home_articles_numbers_0_number'    => '99 [mi]',
      'home_articles_numbers_0_label'     => 'seguidores',
      'home_articles_numbers_1_number'    => '999 [k]',
      'home_articles_numbers_1_label'     => 'fãs pelo mundo',
      'home_articles_numbers'             => '2',
      'home_ebooks_title'                 => 'Ebooks memoráveis',
      'home_ebooks_description'           => 'Descrição da vitrine de ebooks',
      'home_ebooks_numbers_0_number'      => '34',
      'home_ebooks_numbers_0_label'       => 'tipos',
      'home_ebooks_numbers_1_number'      => '3.5 [mi]',
      'home_ebooks_numbers_1_label'       => 'downloads',
      'home_ebooks_numbers'               => '2',
      'home_videos_title'                 => 'Você precisa ver',
      'home_videos_description'           => 'Descrição da vitrine de vídeos',
      'home_videos_numbers_0_number'      => '30',
      'home_videos_numbers_0_label'       => 'séries',
      'home_videos_numbers_1_number'      => '983',
      'home_videos_numbers_1_label'       => 'cursos',
      'home_videos_numbers'               => '2',
      'home_slides_more'                  => 'https://www.google.com',
      'home_slides_0_title'               => 'Título do slide',
      'home_slides_0_subtitle'            => 'Subtítulo do slide',
      'home_slides_0_description'         => 'Descrição do slide',
      // 'home_slides_0_image'               => '192',
      'home_slides_0_button_label'        => 'Saiba mais',
      'home_slides_0_button_url'          => 'https://www.google.com',
      'home_slides_0_bg'                  => 'gradient',
      'home_slides_0_color1'              => '#b78ce2',
      'home_slides_0_color2'              => '#b3e2e2',
      'home_slides'                       => '2',
      'home_slides_1_title'               => 'Outro slide com um titulo bem maior que o anterior',
      'home_slides_1_subtitle'            => 'É verdade',
      'home_slides_1_description'         => 'Aqui fica a descrição deste slide que pode ter até duas linhas de conteúdo',
      // 'home_slides_1_image'               => '194',
      // 'home_slides_1_button_label'        => '',
      // 'home_slides_1_button_url'          => '',
      'home_slides_1_bg'                  => 'gradient',
      'home_slides_1_color1'              => '#b78ce2',
      'home_slides_1_color2'              => '#8cd6ff',
      'home_about_salutation'             => 'Muito prazer!',
      'home_about_assign'                 => 'Equipe Memorável',
      'home_about_text'                   => '',
      // 'home_about_image'                  => '201',
      'home_model'                        => 'company',
      'home_promo_header'                 => 'Título da sua promoção',
      // 'home_promo_image'                  => '',
      'home_promo_button'                 => 'Saiba mais',
      'home_promo_button_url'             => 'https://www.google.com',
      'home_promo_bg'                     => '#10a6d3',
    ),
  ),



  /*
   *
   * Sobre
   *
   */



  array(
    'Sobre',
    'about.php',
    array(
      'about_title'                       => 'Título da página sobre do seu projeto memorável',
      'about_description'                 => 'Conte um pouco da sua história para o público. Eles vão adorar te conhecer melhor.',
      'about_label'                       => 'Quem somos nós',
      // 'about_image'                       => '214',
    ),
    'Conteúdo',
  ),



  /*
   *
   * Blog
   *
   */


  array(
    'Blog',
    'home.php',
    array(
      'page_title'                        => 'Tudo o que você precisa para alcançar o próximo nível',
      'page_subtitle'                     => 'Artigos incríveis',
      'page_description'                  => 'Aqui fica uma descrição',
    ),
  ),



  /*
   *
   * Contato
   *
   */


  array(
    'Contato',
    'contact.php',
    array(
      'contact_title'                     => 'Converse com a gente :)',
      'contact_description'               => 'Sempre que tiver uma crítica, sugestão ou quiser trocar uma ideia, é só entrar em contato!',
      'contact_form_title'                => 'Envie um email',
      'contact_form_name'                 => 'Qual seu nome?',
      'contact_form_email'                => 'Qual seu e-mail?',
      'contact_form_message'              => 'Escreva sua mensagem aqui...',
      'contact_form_submit'               => 'Enviar mensagem',
      'contact_form_subject'              => 'Contato pelo site',
      'form_recipients_0_email'           => 'contato@' . $_SERVER['HTTP_HOST'],
      'form_recipients'                   => '1',
      'contact_social_title'              => 'Vamos socializar!',
      'contact_social_description'        => 'Você também pode conversar com a gente através de uma das nossas redes sociais.',
    ),
  ),

   

  /*
   *
   * Materiais
   *
   */

  // array(
  //   'Materiais',
  //   'materials.php',
  //   array()
  // ),



  /*
   *
   * Landing Artigo
   *
   */


  array(
    'Landing de Artigo',
    'landing-article.php',
    array(
      // 'landing_brand'                     => '123',
      'landing_color1'                    => '#2db0ee',
      'landing_color2'                    => '#2db0ee',
    ),
  ),      



);

  
foreach ( $pages as $page ) {

  $new_page_title = $page[0];
  $new_page_template = $page[1];
  $new_page_meta_fields = $page[2];

  $page_check = get_page_by_title( $new_page_title );

  // if ( ! empty( $page_check->ID ) && $new_page_template == get_page_template_slug( $page_check->ID ) ) {
  //   continue;
  // }

  if($page_check == NULL){

    $new_page = array(
      'post_type'     => 'page',
      'post_status'   => 'publish',
      'post_content'  => '',
      'post_title'    => $new_page_title,
      'page_template' => $new_page_template,
    );

    if ( ! empty( $new_page_meta_fields ) ) {
      $new_page['meta_input'] = $new_page_meta_fields;
    }

    if ( ! empty( $page[3] ) ) {
      $new_page['post_content'] = $page[3];
    }

    $new_page_id = wp_insert_post( $new_page );

    if ( $new_page_id && ! is_wp_error( $new_page_id ) && 'Inicial' == $new_page_title ) {
      update_option( 'page_on_front', $new_page_id );
      update_option( 'show_on_front', 'page' );
    }

  }//if

  

}