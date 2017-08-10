<?php

namespace Mizner\DTSK;

class Check_Daily_Tasklist_Post {

	public $tasklist_today;

	public function __construct( $user_id, $user_tasks ) {
		$this->tasklist_today = $this->check_for_post( $user_id, $user_tasks );
	}

	public function check_for_post( $user_id, $user_tasks ) {

		$post = [];

		$month = current_time( 'm' );
		$year  = current_time( 'Y' );
		$day   = current_time( 'd' );

		// _log( $day . '/' . $month . '/' . $year );

		$the_query = new \WP_Query( [
			'post_type'      => 'dailytasklist',
			'posts_per_page' => 1,
			'author'         => $user_id,
			'year'           => $year, //(int) - 4 digit year (e.g. 2011).
			'monthnum'       => $month, //(int) - Month number (from 1 to 12).
			'day'            => $day,  //(int) - Day of the month (from 1 to 31).
//			'year'           => current_time( 'y' ), //(int) - 4 digit year (e.g. 2011).
//			'monthnum'       => current_time( 'm' ), //(int) - Month number (from 1 to 12).
//			'day'            => current_time( 'd' ),  //(int) - Day of the month (from 1 to 31).

			// @todo: Use current time later?
			// current_time( 'm/d/y' )
		] );

		if ( $the_query->post ) {
			$get_user_tasks = [];

			foreach ( $user_tasks as $key => $value ) {
				$meta                   = get_post_meta( $the_query->post->ID, $key, true );
				$get_user_tasks[ $key ] = ( $meta ? $meta : null );
			}
			$post['ID']    = $the_query->post->ID;
			$post['Date']  = get_the_date( 'm/d/y', $the_query->post->ID );
			$post['tasks'] = $get_user_tasks;

		}

		return $post;
	}

}