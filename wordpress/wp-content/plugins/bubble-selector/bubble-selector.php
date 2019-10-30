<?php
/**
 * Plugin Name: Bubble Selector
 * Description: 
 * Plugin URI: 
 * Author:
 * Version: 0.0.1
 * Author URI: 
 *
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Load class
require_once(plugin_dir_path(__FILE__).'bubble-selector-class.php');

function registerBubbleSelection(){
	register_widget('BubbleSelectionWidget');
}

// Hook in function
add_action('widgets_init', 'registerBubbleSelection');