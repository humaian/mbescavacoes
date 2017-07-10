<?php
class Ishyoboy_WP_Import extends WP_Import
{
	function set_menus()
	{
		global $ish_globals;

		// get all registered menu locations
		$locations = get_theme_mod('nav_menu_locations');

		// get all registered menus
		$theme_menus  = wp_get_nav_menus();

		if ( ! empty( $theme_menus ) && ! empty( $ish_globals['nav_menus'] ) ) {

			foreach ( $theme_menus as $menu ) {

				// Check if the menu exists in the $ish_globals['nav_menus'] set in functions.php
				if ( is_object( $menu ) && in_array( $menu->slug, $ish_globals['nav_menus'] ) ) {

					$key = array_search( $menu->slug, $ish_globals['nav_menus'] );

					if ( $key ) {
						// Set the menu to the correct location
						$locations[ $key ] = $menu->term_id;
					}
				}
			}
		}

		//update the theme
		set_theme_mod( 'nav_menu_locations', $locations);

		echo 'ish_menus_set';
	}

	function set_pages()
	{
		// Use a static front page
		$about = get_page_by_title( 'Home' );
		if ( ! empty( $about ) && is_object( $about ) ){
			update_option( 'page_on_front', $about->ID );
			update_option( 'show_on_front', 'page' );
		}

		// Set the blog page
		$blog = get_page_by_title( 'Blog' );
		if ( ! empty( $blog ) && is_object( $blog ) ){
			update_option( 'page_for_posts', $blog->ID );
		}


		echo 'ish_pages_set';
	}

	function set_permalinks()
	{
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure('/%postname%/');
		flush_rewrite_rules();
		echo 'ish_permalinks_set';
	}




	function set_widgets()
	{

		$demo_widgets_file = get_template_directory() . '/assets/framework/wp/includes/demo-widgets.json';

		if ( ! class_exists( 'Ishyoboy_Widget_Data' ) ) {
			$class_widgets_import = IYB_FRAMEWORK_DIR . '/wp/importer/class-ishyoboy-widget-data.php';
			if ( file_exists( $class_widgets_import ) ) {
				require_once $class_widgets_import ;
			}
		}

		if ( ! is_file( $demo_widgets_file ) ) {
			echo 'The demo widgets JSON file could not be found in the theme directory. Please make sure to use the latest theme version.';
		}
		else
		{
			do_action('ishyoboy_before_demo_widgets_import');

			$wp_widgets_import = new Ishyoboy_Widget_Data();
			$wp_widgets_import->ishyoboy_import_widget_data( $demo_widgets_file );

			do_action('ishyoboy_after_demo_widgets_import');

			echo 'ish_widgets_set';

		}



	}
}