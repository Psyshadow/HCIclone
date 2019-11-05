<?php
/**
 * Plugin Name: Bubble Selector
 * Description: 
 * Plugin URI: 
 * Author: Beat Scherrer
 * Version: 0.0.1
 */

// Housekeeping
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'BUBBLE_SELECTOR_VERSION', '0.0.1' );

// Load class
require_once(plugin_dir_path(__FILE__).'/includes/php/bubble-selector-class.php');
$bubble_selector = new BubbleSelector();

// TODO add hooks inside class
// ------------------
// Hook in javascript
// ------------------
wp_register_script('d3js', 'https://d3js.org/d3.v4.min.js', null, null, true);

// Function can be injected to various hooks instead of directly loaded
function enqueueScript(){
	wp_enqueue_script('test', plugin_dir_url(__FILE__).'includes/js/test.js', array('d3js'));
}
enqueueScript();

// get the course categories and hand them over to the javascript.
$categories = $bubble_selector->getVersion();

$bubble_selector->getCategories();

// add variables from php to js
wp_localize_script('test', 'php_vars', $categories);
