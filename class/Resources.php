<?php

namespace Mizner\DTSK;

class Resources {

	const CSS_DIR = DTSK_URI . 'css/';
	const JS_DIR = DTSK_URI . 'js/';
	const DIST_DIR = DTSK_URI . 'dist/';

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 15 );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ], 15 );
		add_action( 'wp_enqueue_scripts', [ $this, 'public_styles' ], 15 );
		add_action( 'wp_enqueue_scripts', [ $this, 'public_scripts' ], 15 );
	}

	public static function admin_styles() {
		$css_user_form = 'user-form.css';
		wp_enqueue_style( 'user-form', self::CSS_DIR . $css_user_form, [], '1.0', 'all' );

	}

	public static function admin_scripts() {

	}

	public static function public_styles() {
		$css_user_form = 'user-form.css';
		wp_enqueue_style( 'user-form-css-front', self::CSS_DIR . $css_user_form, [], '1.0', 'all' );
	}

	public static function public_scripts() {

		$js_user_form = 'frontend-user-form.js';
		wp_register_script( 'frontend-task-form', self::JS_DIR . $js_user_form, [ 'jquery' ], '1.0', true );

		wp_localize_script( 'frontend-task-form', 'TASKLIST', [
			'ajaxurl'  => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'admin_ajax_nonce' ),
			'success'  => 'success!',
			'error'    => 'error!',
			'user_id'  => get_current_user_id(),
		] );
	}

}