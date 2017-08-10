<?php

namespace Mizner\DTSK;

class Possible_Tasks {
	public $possible_posts;

	public function __construct( $date_range, $user_tasks ) {
		$this->possible_posts = $this->create_structure( $date_range, $user_tasks );
	}

	public function create_structure( $date_range, $user_tasks ) {
		$possible_posts = [];
		foreach ( $date_range as $key => $value ) {
			$possible_posts[ $key ] = $user_tasks;
		}

		return $possible_posts;
	}
}