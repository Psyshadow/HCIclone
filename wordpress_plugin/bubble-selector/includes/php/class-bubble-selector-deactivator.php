<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      0.0.1
 * @package    bubble-selector
 * @subpackage bubble-selector/includes
 * @author     Beat Scherrer <beat.scherrer@gmail.com>
 */
class BubbleSelectorDeactivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		//
		// remove database table
		//

		// global $wpd;

		// $sql = "DROP TABLE IF EXISTS 'test_table'";
		// $wpdb->query($sql);
	}
}
