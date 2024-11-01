<?php
/**
 * @package  SpEbayFeedbacks
 */
/*
Plugin Name: SP Feedbacks - Your eBay in Your Site
Plugin URI: #
Description: This plugins brings sellers & buyers feedback of eBay to your wordpress with great ease. It comes up with good user experience through which you can setup the extension in any layout.
Version: 1.0.0
Author: Siliconplex
Author URI: http://www.siliconplex.com
License: GPLv2 or later
Text Domain: sp-ebay-feedbacks
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

Copyright 2018-2019, Siliconplex.
*/


// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function spefl_activate_ebay_plugin() {
	SpEFLInc\Base\Activate::activate();
}

/**
 * The code that runs during plugin deactivation
 */
function spefl_deactivate_ebay_plugin() {
	SpEFLInc\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'spefl_activate_ebay_plugin' );
register_deactivation_hook( __FILE__, 'spefl_deactivate_ebay_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'SpEFLInc\\Init' ) ) {
	SpEFLInc\Init::register_services();
}



require_once dirname( __FILE__ ) . '/templates/public/feedbacks/feedbacks_shortcode.php';


 
