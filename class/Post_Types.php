<?php

namespace Mizner\DTSK;

class Post_Types {

	const NAME = 'dailytasklist';
	const SINGULAR = 'Daily Task Lists';
	const PLURAL = 'Daily Task List';

	public function __construct() {
		add_action( 'init', [ $this, 'create_post_type' ], 10 );
	}

	/**
	 * Registers the People post type
	 */
	public function create_post_type() {

		$labels = [
			'name'               => __( self::PLURAL ),
			'single_name'        => __( self::SINGULAR ),
			'add_new_item'       => __( 'Add New ' . self::SINGULAR ),
			'edit_item'          => __( 'Edit ' . self::SINGULAR ),
			'new_item'           => __( 'New ' . self::SINGULAR ),
			'all_items'          => __( 'All ' . self::PLURAL ),
			'view_item'          => __( 'View ' . self::SINGULAR ),
			'search_items'       => __( 'Search ' . self::PLURAL ),
			'not_found'          => __( 'No ' . strtolower( self::PLURAL ) . ' found' ),
			'not_found_in_trash' => __( 'No ' . strtolower( self::PLURAL ) . ' found in the Trash' ),
			'parent_item_colon'  => __( '' ),
			'menu_name'          => __( self::PLURAL ),
		];
		$args   = [
			'labels'            => $labels,
			'public'            => true,
			'has_archive'       => false,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'menu_position'     => 5,
			'rewrite'           => [
				'slug'       => strtolower( self::PLURAL ),
				'with_front' => false
			],
			'map_meta_cap'      => true,
			'capability_type'   => 'post',
			'supports'          => [ 'author', 'custom-fields', 'title' ],
			'show_in_rest'      => true,
		];

		register_post_type( self::NAME, $args );

	}
}
