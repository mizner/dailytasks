<?php
/**
 * Plugin Name: Daily Tasks
 * Plugin URI: http://mizner.io
 * Description: Creates a daily task list for users
 * Version: 1.0
 * Author: Michael Mizner
 * Author URI: http://mizner.io
 * License:
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'DTSK', 'daily-tasks' );
define( 'DTSK_PATH', plugin_dir_path( __FILE__ ) );
define( 'DTSK_URI', plugin_dir_url( __FILE__ ) );

require_once 'class/Check_Daily_Tasklist_Post.php';
require_once 'class/Resources.php';
require_once 'class/Post_Types.php';
require_once 'class/Post_Meta.php';
require_once 'class/User_Meta.php';
require_once 'class/Date_Range.php';
require_once 'class/Get_User_Tasks.php';
require_once 'class/Get_Current_User.php';
require_once 'class/WooCommerce_My_Account.php';
require_once 'class/User_Form.php';
require_once 'class/User_Form_Ajax.php';
require_once 'class/User_Edit.php';
require_once 'class/Possible_Tasks.php';
require_once 'class/Get_Tasklist_Posts.php';
require_once 'class/Merged_Data.php';


use Mizner\DTSK;

$resources    = new DTSK\Resources();
$post_types   = new DTSK\Post_Types();
$user_meta    = new DTSK\User_Meta();
$ajax_handler = new DTSK\User_Form_Ajax();
$my_account   = new DTSK\My_Account();
$user_edit    = new DTSK\User_Edit();
