<?php

namespace Mizner\DTSK;

class Get_User_Tasks {

	public $tasks;

	public function __construct( $user_id ) {
		$this->tasks = $this->get_user_daily_tasks( $user_id );
	}

	public function get_user_daily_tasks( $user_id ) {
		$tasks = [];
		if ( have_rows( 'daily_tasks', 'user_' . $user_id ) ):
			while ( have_rows( 'daily_tasks', 'user_' . $user_id ) ) : the_row();
				$task_name           = get_sub_field( 'daily_task_description' );
				$tasks[ $task_name ] = null;
			endwhile;
		endif;

		return $tasks;

	}
}