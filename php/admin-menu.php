<?php

/**
 * Summary: php file which implements the plugin WP admin menu changes
 */


/**
 * Adds link to plugin settings page to Wordpress admin menu as a sub-menu item under Tools
 */
add_action('admin_menu', 'gmuw_aut_add_sublevel_menu');
function gmuw_aut_add_sublevel_menu() {
	
	// Add Wordpress admin menu item under settings for this plugin's settings
	add_management_page(
		'Admin User Template',
		'Admin User Template',
		'manage_options',
		'gmuw_aut',
		'gmuw_aut_plugin_page',
		1
	);
	
}
