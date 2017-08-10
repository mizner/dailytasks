<?php

use Mizner\DTSK;

$user           = new DTSK\Get_Current_User();
$date_range     = new DTSK\Date_Range();
$user_tasks     = new DTSK\Get_User_Tasks( $user->id );
$possible_posts = new DTSK\Possible_Tasks( $date_range->date_range, $user_tasks->tasks );
$actual_posts   = new DTSK\Get_Tasklist_Posts( $user->id, $user_tasks->tasks );
$daily_tasks    = new DTSK\Merged_Data( $possible_posts->possible_posts, $actual_posts->posts );
$tasklist_today = new DTSK\Check_Daily_Tasklist_Post( $user->id, $user_tasks->tasks );
?>

<?php if ( ! is_admin() || is_page( 'my-account' ) ): ?>
	<?php new DTSK\User_Form( $user->id, $user_tasks->tasks, $tasklist_today->tasklist_today ); ?>
<?php endif; ?>


<section class="daily-task-table">
    <header>
        <h2>Task History</h2>
    </header>

	<?php
	$i = 0;
	foreach ( $daily_tasks->data as $date => $user_tasks ):
		$date_time = new DateTime( $date );
		if ( $date_time->format( 'l' ) === 'Sunday' || $i === 0 ): // Check if Sunday or First Loop
			?>
            <span class="break-line"></span>
            <div class="daily-task-table-column task-name">
                <div class="daily-task-table-column-row daily-task-table-top-left"><?php _e( 'Task' ); ?></div>
				<?php foreach ( $user_tasks as $task => $status ): ?>
                    <div class="daily-task-table-column-row" data-content="<?php _e( $task ); ?>"><?php _e( $task ); ?></div>
				<?php endforeach; ?>
            </div>
			<?php
		endif;
		?>
        <div class="daily-task-table-column">
            <div class="daily-task-table-column-row daily-task-table-date"><?php _e( $date_time->format( 'm/d/y' ) ); ?></div>
			<?php foreach ( $user_tasks as $task => $status ): ?>
                <div class="daily-task-table-column-row">
					<?php if ( $status ):
						$check = $status['checkbox'];
						$text = $status['text'];
						?>
                        <div class="daily-task-wrapper daily-task-checker-<?php echo $check; ?> daily-task-text-<?php echo( $text ? 'true' : 'false' ); ?>">
							<?php if ( $check === 'true' ): ?>
                                <span class="daily-task-table-top-left"></span>
							<?php endif; ?>

							<?php if ( $text ): ?>
                                <p class="daily-task-table-text"><?php _e( $text ); ?></p>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                </div>
			<?php endforeach; ?>
        </div>
		<?php
		$i ++;
	endforeach; ?>
</section>