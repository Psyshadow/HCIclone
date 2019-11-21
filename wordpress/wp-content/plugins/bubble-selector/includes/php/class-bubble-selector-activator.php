<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class BubbleSelectorActivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		//
		// create database table
		//

		global $wpdb;

		// check to see if table exists
		if($wpdb->get_var("show tables like 'test_table'") != "test_table") {

	  	$query = "CREATE TABLE test_table (
				`id` int NOT NULL AUTO_INCREMENT,
				`user_id` int,
				`topic_id` int,
				PRIMARY KEY (`id`)
				);";

		  // Import db functionality
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			dbDelta( $query );
		}
	}
}