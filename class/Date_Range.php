<?php

namespace Mizner\DTSK;

use Mizner\DTSK\Get_Current_User;

class Date_Range {

	public $date_range;

	public function __construct() {
		$this->date_range = $this->get_date_range();
	}

	public function get_date_range() {

		$user = new Get_Current_User();

		if ( ! is_admin() ):
			$user_id   = $user->id;
			$user_data = get_userdata( $user_id );
			$begin     = new \DateTime( substr( $user_data->data->user_registered, 0, 10 ) );
		elseif ( is_admin() ):
			$user_id   = $user->id;
			$user_data = get_userdata( $user_id );
			$begin     = new \DateTime( substr( $user_data->data->user_registered, 0, 10 ) );
		else:
			$begin = new \DateTime( '2017-07-16' );
		endif;

		$today      = current_time( 'mysql' );
		$end        = new \DateTime( $today );
		$end        = $end->modify( '+1 day' );
		$interval   = new \DateInterval( 'P1D' );
		$date_range = new \DatePeriod( $begin, $interval, $end );
		$date_array = [];

		foreach ( $date_range as $date ) {
			$date_array[ $date->format( "m/d/y" ) ] = [];
		}

		return $date_array;
	}
}