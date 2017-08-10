<?php

namespace Mizner\DTSK;

class Merged_Data {

	public $data;

	public function __construct( $possible_posts, $actual_posts ) {
		$this->data = $this->check_tasks( $possible_posts, $actual_posts );
	}

	public function check_tasks( $possible_posts, $actual_posts ) {

		$merged = array_merge( $possible_posts, $actual_posts );

		return $merged;
	}
}