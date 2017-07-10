<?php

/**
 * Unlike style.css, the functions.php of a child theme does not override its counterpart from the parent.
 * Instead, it is loaded in addition to the parent’s functions.php. (Specifically, it is loaded right before the parent’s file.)
 * 
 * Read more: http://codex.wordpress.org/Child_Themes
 */
 

/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
 /*
function boldial_child_theme_setup() {
	load_child_theme_textdomain( 'boldial-child', get_stylesheet_directory() . '/language' );
}
add_action( 'after_setup_theme', 'boldial_child_theme_setup' );
*/


/**
 * Register a new child-theme CSS
 *
 * Register a new child-theme stylesheet which will be loaded after the dynamically generated colors and Fonts CSS
 * from the parent theme (main-options.css). It will however be loaded before the CSS generated from the
 * Custom CSS field in the administration.
 *
 * The priority 11 of the filter makes it load after all CSS as they are loaded with the default priority of 10
 *
 */
function boldial_child_theme_enqueue_scripts(){
	wp_register_style( "child-theme-css", get_stylesheet_directory_uri() . "/child-theme.css");
	wp_enqueue_style( "child-theme-css" );
}
add_action( "wp_enqueue_scripts", "boldial_child_theme_enqueue_scripts", 11);


/* Add any custom styles from here */