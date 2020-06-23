<?php
	

	
  $countdown_active   = get_field( 'countdown_active' );
  $countdown_title    = get_field( 'countdown_title' );
  $countdown_cta_text = get_field( 'countdown_cta_text' );
  $countdown_cta_link = get_field( 'countdown_cta_link' );

  date_default_timezone_set('America/Sao_Paulo');
  $date_today = date('Y-m-d H:i:s');
  $date_start = get_field('countdown_date_start');
  $date_end   = get_field('countdown_date_end');

  if($countdown_active):
    if(!empty($date_start) and !empty($date_end)):
    	if((strtotime($date_today) >= strtotime($date_start)) AND (strtotime($date_today) <= strtotime($date_end))):  ?>

			
			<section id="ath-header-countdown" data-date="<?php echo date( 'Y/m/d H:i:s', strtotime( $date_end ) ); ?>" style="position: initial;">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-xs-11 col-centered-xs">
							<div class="row">
								<div class="col-md-6 col-sm-5"><h4><?php echo $countdown_title; ?></h4></div>
								<div class="col-md-6 col-sm-7  <?php echo ! $countdown_title ? 'col-centered' : ''; ?>" <?php echo ! ( $countdown_cta_text || $countdown_cta_link ) ? 'style="text-align: center;"' : ''; ?>>
						            
						            <div style="display: table; float: right;">
							            <div class="timer"></div>
							            <?php if ( $countdown_cta_text && $countdown_cta_link ) : ?>
							            <a href="<?php echo $countdown_cta_link; ?>" class="button full green medium"><?php echo $countdown_cta_text; ?></a>
							            <?php endif; ?>
						            </div>
			          			
			          			</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<style>
	
	.ath-banner.footer-bar{
		display: none !important;
	}

</style>