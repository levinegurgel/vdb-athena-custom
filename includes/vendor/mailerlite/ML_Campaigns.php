<?php

require_once dirname( __FILE__ ) . '/base/ML_Rest.php';

/**
 * Class ML_Campaigns
 */
class ML_Campaigns extends ML_Rest {
	/**
	 * ML_Campaigns constructor.
	 *
	 * @param $api_key
	 */
	function __construct( $api_key ) {
		$this->endpoint = 'campaigns';

		parent::__construct( $api_key );
	}

	function getRecipients() {
		$this->path .= 'recipients/';

		return $this->execute( 'GET' );
	}

	function getOpens() {
		$this->path .= 'opens/';

		return $this->execute( 'GET' );
	}

	function getClicks() {
		$this->path .= 'clicks/';

		return $this->execute( 'GET' );
	}

	function getUnsubscribes() {
		$this->path .= 'unsubscribes/';

		return $this->execute( 'GET' );
	}

	function getBounces() {
		$this->path .= 'bounces/';

		return $this->execute( 'GET' );
	}

	function getJunk() {
		$this->path .= 'junks/';

		return $this->execute( 'GET' );
	}
}