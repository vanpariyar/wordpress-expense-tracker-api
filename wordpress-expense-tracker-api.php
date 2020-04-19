<?php
/**
 * @package Wordpress Expense Tracker API
 */
/*
Plugin Name: Wordpress Expense Tracker API
Plugin URI: https://github.com/vanpariyar/wordpress-expense-tracker-api
Description: This is the Plugin to Generate the Expnense Module, Wordpress Expense Tracker API is.
Version: 4.1.4
Author: vanpariyar
Author URI: https://github.com/vanpariyar 
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: WPETA
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software

Copyright 2005-2015 Sahajanad IT Solutions.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  May be You Lost Some where In Space.';
	exit;
}

define( 'WPETA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPETA_PLUGIN_URL', plugins_url( __FILE__ ) );

require_once( WPETA_PLUGIN_DIR . 'includes/plugin_helpers.php');

/**
 *  TODO :: Remove the WP-basic Auth Plugin From Code.
 * 
 */
require_once( WPETA_PLUGIN_DIR . 'api/basic-auth.php');


require_once( WPETA_PLUGIN_DIR . 'api/routes/transactions.php');

// add_action( 'the_content', function(){
//     echo get_post_meta( get_the_ID( ) , 'track', true );
//     update_post_meta( get_the_ID(), 'abcf', 250);
//  } );