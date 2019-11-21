<?php
/**
 * Plugin Name: Bubble Selector
 * Description: 
 * Plugin URI: 
 * Author: Beat Scherrer
 * Version: 0.0.1
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'BUBBLE_SELECTOR_VERSION', '0.0.1' );

// Activation and deactivation hooks

function activate_bubble_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/php/class-bubble-selector-activator.php';
	BubbleSelectorActivator::activate();
}

function deactivate_bubble_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/php/class-bubble-selector-deactivator.php';
	BubbleSelectorDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bubble_selector' );
register_deactivation_hook( __FILE__, 'deactivate_bubble_selector' );

// Load class
require_once(plugin_dir_path(__FILE__) . 'includes/php/class-bubble-selector.php');

$table_name = "test_table";

// create class instance
$bubble_selector = new BubbleSelector($table_name);