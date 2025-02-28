<?php

/**
 * Main plugin file for the Mason WordPress: Admin User Template
 */

/**
 * Plugin Name:       Mason WordPress: Admin User Template
 * Author:            Mason Webmaster
 * Plugin URI:        https://github.com/mason-webmaster/gmuw-wordpress-plugin-mason-adminusertemplate
 * Description:       
 * Version:           0.9
 */


// Exit if this file is not called directly.
	if (!defined('WPINC')) {
		die;
	}

// Set up auto-updates
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mason-webmaster/gmuw-wordpress-plugin-mason-adminusertemplate/',
	__FILE__,
	'gmuw-wordpress-plugin-mason-adminusertemplate'
	);


//admin menu
include('php/admin-menu.php');

//admin page
include('php/admin-page.php');

//dashboard
include('php/dashboard.php');

//plugin settings
include('php/settings.php');

//users
include('php/users.php');
