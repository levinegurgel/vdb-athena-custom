<?php 

	global $ath_options;	

	if(!empty($ath_options['fb_app_code'])){

		echo '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId='.$ath_options['fb_app_code'].'"; fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';

	}

	if(!empty($ath_options['ga_code'])){

		$ga  = "<script>";
		$ga .= "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){";
		$ga .= "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
		$ga .= "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
		$ga .= "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
		$ga .= "ga('create', '". $ath_options['ga_code'] ."', 'auto');";
		$ga .= "ga('send', 'pageview');";
		$ga .= "</script>";

		echo $ga;
	}
				
	echo $ath_options['script_footer'];

?>

<script type="text/javascript">
  var ATH_Lazy = new LazyLoad({
   elements_selector: ".lazy"
  });
</script>