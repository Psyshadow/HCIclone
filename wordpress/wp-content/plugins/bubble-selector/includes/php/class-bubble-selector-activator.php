<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @package    bubble-selector
 * @subpackage bubble-selector/includes
 * @author     Beat Scherrer <beat.scherrer@gmail.com>
 */
class BubbleSelectorActivator {
	/**
	 * Activation function.
	 * This function creates the database used by
	 * the bubble-selector plugin.
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