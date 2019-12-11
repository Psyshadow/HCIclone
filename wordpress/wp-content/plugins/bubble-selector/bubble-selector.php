<?php
/**
 * Plugin Name: Bubble Selector
 * Description: Make a selection of preferred learndash courses and save them
 * to a database. Allows to suggest modules a user is interested in.
 * Plugin URI: 
 * Author: Beat Scherrer
 * Version: 0.0.1
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Constants
define( 'BUBBLE_SELECTOR_VERSION', '0.0.1' );

// activation hook
function activate_bubble_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/php/class-bubble-selector-activator.php';
	BubbleSelectorActivator::activate();
}
register_activation_hook( __FILE__, 'activate_bubble_selector' );

// deactivation hook
function deactivate_bubble_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/php/class-bubble-selector-deactivator.php';
	BubbleSelectorDeactivator::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_bubble_selector' );

// Load the plugin
require_once(plugin_dir_path(__FILE__) . 'includes/php/class-bubble-selector.php');

$table_name = "test_table";

// Finally create the instance
$bubble_selector = new BubbleSelector($table_name);