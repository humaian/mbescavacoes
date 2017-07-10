<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

include_once( ABSPATH .'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	$demo_data_file = get_template_directory() . '/assets/framework/wp/includes/demo-data-woocommerce.xml';
} else{
	$demo_data_file = get_template_directory() . '/assets/framework/wp/includes/demo-data.xml';
}


// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';
if ( ! class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) ) {
		require_once $class_wp_importer;
	}
}

// Check if the wordpress-importer plugin's class exists and include it but remove the wordpress_importer_init() function and hook
if ( ! class_exists( 'WP_Import' ) ) {
	$class_wp_import = IYB_FRAMEWORK_DIR . '/wp/importer/wordpress-importer.php';
	if ( file_exists( $class_wp_import ) ) {
		require_once $class_wp_import ;
	}
}

if ( ! ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) )  ){

	echo 'An error occurred while loading the importer. Please import the demo data XML file manually using Tools -> Import -> WordPress';

} else {

	if ( class_exists( 'WP_Import' ) ) {
		include_once( IYB_FRAMEWORK_DIR . '/wp/importer/ishyoboy-wp-import.php');
	}

	if ( ! is_file( $demo_data_file ) ) {
		echo 'The demo data XML file could not be found in the theme directory. Please import the demo data XML file manually using Tools -> Import -> WordPress';
	}
	else
	{

		do_action('ishyoboy_before_demo_import');

		$wp_import = new Ishyoboy_WP_Import();
		$wp_import->fetch_attachments = true;


		$wp_import->import( $demo_data_file );
		$wp_import->set_widgets();
		$wp_import->set_menus();
		$wp_import->set_pages();
		$wp_import->set_permalinks();
		/**/

		do_action('ishyoboy_after_demo_import');
	}

}