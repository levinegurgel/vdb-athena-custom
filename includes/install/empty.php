<?php 

$path = get_template_directory_uri();
$emp = array(


  /*
   *
   * Home
   *
   */

  // Header

  'home_header_img' => $path .'/assets/images/header-image.png',
  
  // Slider

  'home_slider_thumb'=>  $path .'/assets/images/thumb.png',
  'home_slider' => array(
    array(
      'title'=>'Título do seu slide',
      'subtitle' =>'Subtítulo do seu slide',
      'description' => 'Aqui fica a descrição do seu slide memorável',
      'image' => 'https://images.unsplash.com/photo-1451598230103-645563cfa35b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80',
      'button_label'=>'Saiba mais',
      'button_url'=> get_bloginfo('url'),
      'bg'=>'picture',
      'color1'=>'#b78ce2',
      'color2'=> '#b3e2e2'
    )
  ),

  // About

  'home_about_image' => $path .'/assets/images/thumb.png'

);