<?php

namespace Mizner\DTSK;

class User_Form {

	public function __construct( $user_id, $user_tasks, $tasklist_today ) {

		$this->form( $user_id, $user_tasks, $tasklist_today );

	}

	public function form( $user_id, $user_tasks, $tasklist_today ) {

		$user_tasks = ( $tasklist_today ? $tasklist_today['tasks'] : $user_tasks );
		$post_id    = ( $tasklist_today ? $tasklist_today['ID'] : null );


		ob_start(); ?>
		<?php wp_enqueue_script( 'frontend-task-form' ); ?>
        <h2><?php _e('Daily Tasks'); ?></h2>
        <header class="task-first-header">
            <div class="task-first-header-col">
                <h3><?php _e('Tasks');?></h3>
            </div>
            <div class="task-second-header-col">
                <h3><?php _e('Optional Note');?></h3>
            </div>
        </header>
		<?php
		$i        = 0;
		foreach ( $user_tasks as $task => $value ):
			$meta = get_post_meta( $post_id, $task, true );
			$name = str_replace( ' ', '_', strtolower( $task ) );

			$text    = null;
			$checked = null;
			if ( $meta ) {
				$checked = ( $meta['checkbox'] === 'true' ? 'checked' : '' );
				$text    = ( $meta['text'] ? $meta['text'] : '' );
			}
			?>


            <form action="" class="task-item" data-id="<?php echo $post_id; ?>" data-meta="<?php _e( $task ); ?>">
                <div class="squaredTwo">
                    <input type="checkbox" <?php echo $checked; ?> id="<?php echo 'squaredTwo'. $i; ?>">
                    <label for="<?php echo 'squaredTwo'. $i; ?>"></label>
                </div>
                <span class="task-title"><?php _e( $task ); ?></span>
                <label class="optional-note" for="<?php echo( $name ) ?>"></label>
                <input type="text" name="<?php echo $name ?>" value="<?php echo $text; ?>" autocomplete="off">
                <button class="">Save</button>
            </form>
			<?php
			$i ++;
		endforeach; ?>

		<?php echo ob_get_clean();
	}
}