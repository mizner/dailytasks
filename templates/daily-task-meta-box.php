<?php
$post_id = get_the_ID();
$post    = get_post( $post_id );
$author  = get_user_meta( $post->post_author, 'nickname', true );
var_dump( $author );

?>
<h2><?php _e( 'Nickname: ' . $author ); ?></h2>
