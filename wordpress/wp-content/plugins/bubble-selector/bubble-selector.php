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
add_action( 'the_content', 'testFunction');

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function testFunction($content) {
	return $content = $content . '<p> blablabl!</p>';
}