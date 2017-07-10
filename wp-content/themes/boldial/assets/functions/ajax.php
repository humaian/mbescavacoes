<?php

/**
 * Import the demo data from the demo-content.xml file
 */
if ( ! function_exists( 'ishyoboy_ajax_demo_import' ) ) {
	function ishyoboy_ajax_demo_import()
	{

		// Die if nonce is invalid
		check_ajax_referer( 'ishyoboy_demo_import_nonce' );

		//ob_start();
		require_once( locate_template( 'assets/framework/wp/importer/config.php' ) );
		//$output = ob_get_contents();
		//ob_end_clean();

		/*if ( empty( $output ) ){
			die( $output . 'demo_data_imported' );
		}
		else{
			die( $output );
		}*/

		die( 'demo_data_imported' );

	}

	add_action( 'wp_ajax_ishyoboy_ajax_demo_import', 'ishyoboy_ajax_demo_import' );
}
