<?php

namespace Mizner\DTSK;

class Get_Tasklist_Posts {

	public $posts;

	public function __construct( $user_id, $user_tasks ) {
		$raw_posts   = $this->get_posts( $user_id );
		$this->posts = $this->gather_post_info( $raw_posts, $user_tasks );
	}

	public function get_posts( $user_id ) {

		$the_query = new \WP_Query( [
			'post_type'      => 'dailytasklist',
			'posts_per_page' => 365,
			'author'         => $user_id,
		] );

		return $the_query->posts;
	}

	public function gather_post_info( $posts, $user_tasks ) {
		$tasks = [];
		foreach ( $posts as $post ) {
			$get_user_tasks = [];

			foreach ( $user_tasks as $key => $value ) {
				$meta                   = get_post_meta( $post->ID, $key, true );
				$get_user_tasks[ $key ] = ( $meta ? $meta : null );
			}

			$tasks[ get_the_date( 'm/d/y', $post->ID ) ] = $get_user_tasks;
		}

		return $tasks;
	}
}