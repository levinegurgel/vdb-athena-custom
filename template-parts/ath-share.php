<?php 
	global $ath_options;
	$mob = new Mobile_Detect;
	
	$classes	  = '';
  $mobile     = $ath_options['social_share_mobile']; 
	$position	  = $ath_options['social_share_position'];
	$locations  = $ath_options['social_share_locations'];
	$networks 	= $ath_options['social_share_networks'];
	$whatsapp 	= $ath_options['social_share_whatsapp']; 

	if(is_home() or is_front_page()){
		if($locations['home'] == false){
			$classes .= ' hidden ';
		}
	}

	if(is_single()){
		if($locations['singles'] == false){
			$classes .= ' hidden ';
		}
	}

	if(is_page() or is_archive()){
		if(!is_home() and !is_front_page()){
      if($locations['pages'] == false){
        $classes .= ' hidden ';
      }
    }
	}

  if($mobile == false){
    if(is_phone() or is_tablet()){
      $classes .= ' hidden ';
    }
  }

	if($position == true){
		$classes .= ' left ';
	}else{
		$classes .= ' right ';
	}



?>

<div class="ath-share floated color bg <?php echo $classes; ?>">
	<nav>
		
		<?php 
     if(array_key_exists('facebook',$networks)): 
      if($networks['facebook'] == true):
    ?>
		<a href="#" class="bg facebook" data-url="<?php echo ath_get_current_url(); ?>" data-target="facebook">
			<i class="icon facebook square"></i>
		</a>
		<?php
        endif;
      endif;
    ?>
		
		<?php 
     if(array_key_exists('twitter',$networks)): 
      if($networks['twitter'] == true):
    ?>
		<a href="#" class="bg twitter" data-url="<?php echo ath_get_current_url(); ?>" data-target="twitter">
			<i class="icon twitter"></i>
		</a>
		<?php
        endif;
      endif;
    ?>
		
    <?php 
     if(array_key_exists('linkedin',$networks)): 
      if($networks['linkedin'] == true):
    ?>
		<a href="#" class="bg linkedin" data-url="<?php echo ath_get_current_url(); ?>" data-target="linkedin">
			<i class="icon linkedin"></i>
		</a>
		<?php
        endif;
      endif;
    ?>
		
		<?php 
     if(array_key_exists('pinterest',$networks)): 
      if($networks['pinterest'] == true):
    ?>
    		<a href="#" class="bg pinterest" data-url="<?php echo ath_get_current_url(); ?>" data-target="pinterest">
    			<i class="icon pinterest"></i>
    		</a>
		<?php
        endif;
      endif;
    ?>

		<?php 
     if(array_key_exists('whatsapp',$networks)): 
      if($networks['whatsapp'] == true):
    ?>
			<a href="#" class="bg whatsapp" data-target="self" data-url="whatsapp://send?text=<?php echo $whatsapp .'  '. ath_get_current_url() .' - '. get_bloginfo('name'); ?>" data-target="self">
				<i class="icon whatsapp"></i>
			</a>
    <?php
        endif;
      endif;
    ?>

	</nav>
</div>