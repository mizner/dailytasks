<?php

namespace Mizner\DTSK;

class Get_Current_User {

	public $id;

	public function __construct() {
		$this->id = $this->get_current_user();
	}

	public function get_current_user() {
		if ( is_admin() ) :
			$user_id = $_GET['user_id'];
		else:
			$user_id = get_current_user_id();
		endif;

		return $user_id;
	}
}