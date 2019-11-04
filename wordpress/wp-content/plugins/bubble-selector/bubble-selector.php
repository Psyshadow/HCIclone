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

// Housekeeping
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'BUBBLE_SELECTOR_VERSION', '0.0.1' );


// Load class
require_once(plugin_dir_path(__FILE__).'bubble-selector-class.php');

function registerBubbleSelection(){
	register_widget('BubbleSelectionWidget');
}


// ------------------
// Hook in javascript
// ------------------
wp_register_script('d3js', 'https://d3js.org/d3.v4.min.js', null, null, true);

// Function can be injected to various hooks instead of directly loaded
function enqueueScript(){
	wp_enqueue_script('test', plugin_dir_url(__FILE__).'includes/js/test.js', array('d3js'));
}
enqueueScript();

// ---------------
// Shortcode Stuff
// ---------------
function testFunction() {
	$content = "<style>\r\n";
	$content .= "h3.demoClass { \r\n";
	$content .= "color: #26b158";
	$content .= "}\r\n";
	$content .= "</style>\r\n";
	$content .= '<h3 class="demoClass" id="demoId"> Check it out!</h3>';
	$content .= '<button id="demoButton">demobutton</button>';
	$content .= '<div id="bubbleGraph"></div>';
	return $content;
}

// Hook in function
// add_action('widgets_init', 'registerBubbleSelection');
add_shortcode('bubble-selector', 'testFunction');