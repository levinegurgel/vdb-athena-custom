<?php 

	// [ath_capture]
	
	add_shortcode('ath_capture', 'ath_optin');
	function ath_optin($attr){
			
			global $ath_options;
			
			$attr = shortcode_atts(array(
				'position'=>'header',
				'title'=>'',
				'subtitle'=>''			
			),
			$attr,
			'ath_capture');

			$script_uid = rand(99,999999);
			$uid = '.ath-capture-'.$script_uid;

			$return = '<div class="ath-cta horizontal-2col-form big-shadow">
			    <div class="row">
			        <div class="col-md-12 col-sm-12">
			            <div class="wrapper">
			                <div class="content">'.
			                ( !empty($attr['subtitle']) ? ' <h5>'. $attr['subtitle'] .'</h5>': '<h5>'. $ath_options['capture_'. $attr['position'] .'_subtitle'] .'</h5>' ).
			                ( !empty($attr['title']) ? ' <h3>'. $attr['title'] .'</h3>': '<h3>'. $ath_options['capture_'. $attr['position'] .'_title'] .'</h3>' ).
			                ath_capture_form($ath_options['capture_'. $attr['position'] .'_service']) .'
			                </div>
			            </div>
			        </div>
			    </div>
			</div>';

			return $return;

 } ?>