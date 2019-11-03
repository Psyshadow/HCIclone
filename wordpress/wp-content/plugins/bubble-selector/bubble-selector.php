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

function testFunction() {
	$content = "<style>\r\n";
	$content .= "h3.demoClass { \r\n";
	$content .= "color: #26b158";
	$content .= "}\r\n";
	$content .= "</style>\r\n";
	$content .= '<h3 class="demoClass"> Check it out!</h3>';

	return $content;
}

// Hook in function
// add_action('widgets_init', 'registerBubbleSelection');
add_shortcode('bubble-selector', 'testFunction');