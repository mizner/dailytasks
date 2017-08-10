<?php

namespace Mizner\DTSK;

class User_Form_Ajax {

	public function __construct() {
		add_action( 'wp_ajax_dailytask_ajax_handler', [ $this, 'dailytask_ajax_handler' ] );
	}

	public function dailytask_ajax_handler() {

		if ( ! check_admin_referer( "admin_ajax_nonce", "security" ) ) {
			return wp_send_json_error( "Invalid Nonce" );
		}

		if ( ! is_user_logged_in() ) {
			return wp_send_json_error( "Sorry, you are not allowed to do this." );
		}
		$data  = $_POST['data'];
		$value = [
			'checkbox' => esc_textarea($data['checkbox']),
			'text'     => esc_textarea($data['text']),
		];

		if ( $data['id'] ) {
			update_post_meta( $data['id'], $data['key'], $value );
		} else {
			// Create post object
			$new_post = [
				'post_status' => 'publish',
				'post_author' => $data['user_id'],
				'post_type'   => 'dailytasklist'
				// 'tax_input'    => array(
				// 	'hierarchical_tax'     => $hierarchical_tax,
				// 	'non_hierarchical_tax' => $non_hierarchical_tax,
				// ),
				// 'meta_input'   => array(
				// 	'test_meta_key' => 'value of test_meta_key',
				// ),
			];

			$post_id = wp_insert_post( $new_post );
			update_post_meta( $post_id, $data['key'], $value );
			wp_send_json( $post_id );
		}


		wp_die(); // this is required to terminate immediately and return a proper response
	}
}