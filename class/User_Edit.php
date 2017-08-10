<?php

namespace Mizner\DTSK;

class User_Edit {

	public $template;

	public function __construct() {

		if ( ! is_admin() ) {
			return;
		}

		add_action( 'wp_loaded', [ $this, 'init' ], 3 );

	}

	public function init() {
		if ( ! strpos( $_SERVER['REQUEST_URI'], 'user-edit.php' ) ) {
			return;
		}
		$this->template = $this->task_history_template();
		add_action( 'show_user_profile', [ $this, 'show_task_history' ], 1 );
		add_action( 'edit_user_profile', [ $this, 'show_task_history' ], 10 );
	}

	public function show_task_history() {
		echo $this->template;
	}

	public function task_history_template() {
		ob_start();
		include DTSK_PATH . 'templates/my-account-dailytasks.php';

		return ob_get_clean();
	}
}