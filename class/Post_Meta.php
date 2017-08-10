<?php
namespace Mizner\DTSK\Meta_Boxes;

use Mizner\DTSK\Post_Types;

class Post_Meta {

	const POST_TYPE = 'dailytasks';

	public function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'additions' ], 15 );
		add_action( 'add_meta_boxes', [ $this, 'removals' ], 15 );
	}

	public function additions() {
		add_meta_box( 'daily_tasks', __( 'Task-list Details' ), [ $this, 'meta_box' ], self::POST_TYPE );
	}

	public function meta_box() {
		include_once HPBS_PATH . 'templates/Daily_Task_List_MetaBox.php';
	}

	public function removals() {
		$screen = get_current_screen();

		if ( $screen->id === self::POST_TYPE ):
			remove_meta_box( 'submitdiv', self::POST_TYPE, 'side' );
			remove_meta_box( 'slugdiv', self::POST_TYPE, 'normal' );
			remove_meta_box( 'authordiv', self::POST_TYPE, 'normal' );
			remove_meta_box( 'wpseo_meta', self::POST_TYPE, 'normal' );
			remove_meta_box( 'wc-memberships-post-memberships-data', self::POST_TYPE, 'normal' );
			remove_meta_box( 'sharing_meta', self::POST_TYPE, 'advanced' );
		endif;

//		global $wp_meta_boxes;
//		_log( $wp_meta_boxes );

	}

}

new Post_Meta();