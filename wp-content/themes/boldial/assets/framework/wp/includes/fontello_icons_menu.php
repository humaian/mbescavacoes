<?php
/*
Plugin Name: IshYoBoy Fontello Icons Menu
Plugin URI: http://ishyoboy.com/
Description: Enables shortcodes to be used in WordPress Themes by IshYoBoy
Version: 1.0
Author: IshYoBoy
Author URI: http://ishyoboy.com
*/

if ( ! class_exists( 'Ishyoboy_Fontello_Icons_Menu' ) ) :
class Ishyoboy_Fontello_Icons_Menu {

	function filter_icons( $nav_menu, $args ){
		$nav_menu_filtered = preg_replace_callback( '/(<li[^>]+class=")([^"]+)("?[^>]+>[^>]+>)([^<]+)<\/a>/', array( &$this, 'replace_icon_class' ), $nav_menu );
		return $nav_menu_filtered;
	}

	function replace_icon_class( $matches ){

		$m['start'] = $matches[1];
		$m['classes'] = $matches[2];
		$m['remaining'] = $matches[3];
		$m['text'] = $matches[4];
		$before = true;

		$class_array = explode( ' ', $m['classes'] );
		$icons_classes = Array();

		foreach ( $class_array as $key => $val ) {
			if ( false !== strpos( $val, 'icon-') ) {
				$icons_classes[] = $val;
				unset( $class_array[ $key ] );
			}
		}

		if ( ! empty( $icons_classes ) ){
			// Add class to the <li> element
			$class_array[] = 'ish-nav-ic-item';

			// Add class to the icon container
			$icons_classes[] = 'ish-nav-ic';

			// Prepare the new content with icon
			$new_text = '<i class="' . implode( ' ', $icons_classes ). '"></i><span class="ish-nav-ic-text"> ' . $m['text'] . '</span>';

			// Connect the new string
			$item = $m['start'] . implode( ' ', $class_array ) . $m['remaining'] . $new_text . '</a>';

		} else {

			$item = $matches[0];

		}

		return $item;
	}

	function __construct(){
		add_filter( 'wp_nav_menu' , array( $this, 'filter_icons' ), 10, 2 );
	}
}
endif;

$ish_fontello_icons_menu = new Ishyoboy_Fontello_Icons_Menu();