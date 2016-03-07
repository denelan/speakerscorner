<?php
/**
* Plugin Name: Speakerscorner
* Plugin URI: http://www.zorgethiek.nu
* Description: Plugin to clean up the dashboard
* Author: Antoinette de Fouw
* Author URI: https://plus.google.com/+AntoinettedeFouw
* Version: 1.0
* License: GPLv2
*/

function ZEB_remove_dashboard_widget() {
	// verwijder WP nieuws van dashboard

	remove_meta_box( 'dashboard_primary', 'dashboard', 'side');
}
add_action( 'wp_dashboard_setup', 'ZEB_remove_dashboard_widget');

function ZEB_add_google_link() {
	// goed link naar GA toe in admin bar

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'id' => 'google_analytics',
		'title' => 'Google Analytics',
		'href' => 'http://google.com/analytics'
		) );
}
add_action( 'wp_before_admin_bar_render', 'ZEB_add_google_link' );

