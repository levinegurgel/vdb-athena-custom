<?php 
	
  global $ath_options;
  $mob = new Mobile_Detect;

  $style = '';
  $mobile = $ath_options['fbar_mobile'];
  $position = $ath_options['fbar_position'];

  if(!isset($position) or empty($position)){
    $position = false;
  }
  
  if($mobile == false){
    if(is_phone() or is_tablet()){
      $style .= ' display:none !important; ';
    }
  }
 
	if($ath_options['fbar_status'] == true):
?>

	<div class="ath-banner footer-bar floated <?php echo $position == true ? 'position-top':'';?>" style="background:linear-gradient(-175deg, <?php echo $ath_options['fbar_color1']; ?> 0%, <?php echo $ath_options['fbar_color2']; ?> 99%); <?php echo $style; ?>" data-href="<?php echo $ath_options['fbar_button_url']; ?>">
		
		<div class="close">
      <i class="icon close ath-color-white"></i>
    </div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-2 brand hidden-xs">
					<img src="<?php echo $ath_options['fbar_image']['url']; ?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="center-this">
						<p class="ath-font-header ath-font-header-weight ath-color-white <?php echo is_tablet() ? 'pl-2':''; ?> <?php echo is_phone() ? 'ta-c mb-3':''; ?>"><?php echo $ath_options['fbar_title']; ?></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-11">
					<a href="#" class="button outline white rpp small <?php echo is_phone() ? 'full-width':''; ?>"><?php echo $ath_options['fbar_button_label']; ?></a>
				</div>
			</div>
		</div>
		</a>
	</div>
<?php endif; ?>