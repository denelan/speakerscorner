<?php
/**
* Plugin Name: Speakerscorner
* Plugin URI: http://www.zorgethiek.nu
* Description: Plugin to show, sort and connect to alumni of ZeB
* Author: Antoinette de Fouw
* Author URI: https://plus.google.com/+AntoinettedeFouw
* Version: 0.0.1
* License: GPLv2
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH') ) {
	exit;
}

require ( plugin_dir_path(__FILE__) . 'alumni-listing-cpt.php' );
require ( plugin_dir_path(__FILE__) . 'alumni-listing-render-admin.php' );
require ( plugin_dir_path(__FILE__) . 'alumni-listing-fields.php' );

