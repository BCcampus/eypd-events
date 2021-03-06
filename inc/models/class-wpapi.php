<?php
/**
 * Project: api-client
 * Project Sponsor: BCcampus <https://bccampus.ca>
 * Copyright 2012-2017 Brad Payne <https://bradpayne.ca>
 * Date: 2017-09-13
 * Licensed under GPLv3, or any later version
 *
 * @author Brad Payne
 * @package BCcampus\ApiClient\Models
 * @license https://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright (c) 2012-2017, Brad Payne
 */

namespace BCcampus\ApiClient\Models;

use BCcampus\ApiClient\Polymorphism\RestInterface;

class WpApi implements RestInterface {

	private $host = 'https://earlyyearsbc.ca';
	private $path = '/wp-json/wp/v2/event/';
	private $url = '';

	/**
	 * @param $args
	 *
	 * @return array|mixed|object
	 */
	function retrieve( $args ) {
		/**
		 * JSON response please
		 */
		$parameters = '';

		foreach ( $args as $key => $val ) {
			if ( empty( $val ) ) {
				continue;
			}
			$parameters .= $key . '=' . $val . '&';
		}
		$params = rtrim( $parameters, '&' );

		// build the endpoint
		$this->url = $this->host . $this->path . '?' . $params;

		$result = wp_remote_get( $this->url, [ 'sslverify' => FALSE ] );

		// evaluate the result
		if ( is_wp_error( $result ) ) {
			// TODO: implement exception handling
			error_log( 'WP API is not returning results as expected in \EYPD\Models\WpApi::retrieve' );

			return '';
		}

		return json_decode( $result['body'], TRUE );
	}


	function create() {
		// TODO: Implement create() method.
	}

	function replace() {
		// TODO: Implement replace() method.
	}

	function remove() {
		// TODO: Implement remove() method.
	}
}
