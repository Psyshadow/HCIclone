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

// Load class
require_once(plugin_dir_path(__FILE__).'/includes/php/bubble-selector-class.php');

$bubble_selector = new BubbleSelector();
