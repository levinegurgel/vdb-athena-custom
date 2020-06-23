<?php

global $ath_options;
global $ath_colors;

/*
 * Paletas
 */

echo '<style>';
echo ':root {';


/**
* Cores
*/

if( !isset($ath_options['color_action']) or empty($ath_options['color_action']) ){
  $ath_options['color_action'] = '#46cc6e';
}
if( !isset($ath_options['color_text']) or empty($ath_options['color_text']) ){
  $ath_options['color_text'] = '#3e464f';
}
if( !isset($ath_options['color_bg']) or empty($ath_options['color_bg']) ){
  $ath_options['color_bg'] = '#ffffff';
}
if( !isset($ath_options['color_pallete_mode']) or empty($ath_options['color_pallete_mode']) ){
  $ath_options['color_pallete_mode'] = 'light';
}

if($ath_options['color_type'] == 'custom'){
  echo '--ath-color-primary:'. $ath_options['color_primary'] .';';
  echo '--ath-color-secondary:'. $ath_options['color_secondary'] .';';
  echo '--ath-color-action:'. $ath_options['color_action'] .';';
  echo '--ath-color-text: '. $ath_options['color_text'] .';';
  echo '--ath-color-bg: '. $ath_options['color_bg'] .';';
}else{
  
  $mode    = $ath_options['color_pallete_mode'];
  $pallete = ( $mode == 'dark' ? $ath_options['color_pallete_dark'] : $ath_options['color_pallete'] ); 
  echo '--ath-color-primary:'. $ath_colors->pallete($pallete)[0] .';';
  echo '--ath-color-secondary:'. $ath_colors->pallete($pallete)[1] .';';
  echo '--ath-color-action:'. $ath_colors->pallete($pallete)[2] .';';
  echo '--ath-color-text:'. $ath_colors->pallete($pallete)[3] .';';
  echo '--ath-color-bg:'. $ath_colors->pallete($pallete)[4] .';';
}


/**
* Tipografia
*/

echo '--ath-font-header:'. $ath_options['font_header']['font-family'] .';';
echo '--ath-font-header-weight:'. $ath_options['font_header']['font-weight'] .';';
echo '--ath-font-text:'. $ath_options['font_text']['font-family'] .';';
echo '--ath-font-text-weight:'. $ath_options['font_text']['font-weight'] .';';
echo '--ath-font-serif:'. $ath_options['font_serif']['font-family'] .';';
echo '--ath-font-serif-weight:'. $ath_options['font_serif']['font-weight'] .';';

/**
* Logotipo
*/

echo '--ath-logo: url("'. $ath_options['brand']['url'] .'");';
echo '--ath-logo-mono:url("'. $ath_options['brand_mono']['url'] .'");';

/**
* Outros
*/

for ($i=0; $i < 10; $i++) { 
  echo '--ath-op'.$i.': calc('.$i.' * 0.01);';
}
for ($i=10; $i < 100; $i+=5) { 
  echo '--ath-op'.$i.': calc('.$i.' * 0.01);';
}

echo '}';
echo '</style>';