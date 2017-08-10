<?php

namespace Mizner\DTSK;

class My_Account {

	public function __construct() {

		/**
		 * Flush rewrite rules on plugin activation.
		 */
		register_activation_hook( __FILE__, [ $this, 'custom_endpoints' ] );
		register_deactivation_hook( __FILE__, [ $this, 'custom_endpoints' ] );
		add_action( 'init', [ $this, 'custom_endpoints' ], 8 ); // TODO: while testing only, remove below for production
		add_filter( 'query_vars', [ $this, 'custom_query_vars' ], 8 );

		/**
		 * Manipulate My Account Menu
		 */
		add_filter( 'woocommerce_account_menu_items', [ $this, 'additions' ], 8 );
		add_action( 'woocommerce_account_dailytasks_endpoint', [ $this, 'dailytasks_content' ], 8 );

	}

	public function custom_endpoints() {
		add_rewrite_endpoint( 'dailytasks', EP_ROOT | EP_PAGES );
		flush_rewrite_rules();
	}


	public function custom_query_vars( $vars ) {
		$vars[] = 'dailytasks';

		return $vars;
	}

	public function additions( $items ) {
		$items['dailytasks'] = __( 'Daily Tasks', 'woocommerce' );

		return $items;
	}

	public function dailytasks_content() {
		include_once DTSK_PATH . 'templates/my-account-dailytasks.php';
	}

}