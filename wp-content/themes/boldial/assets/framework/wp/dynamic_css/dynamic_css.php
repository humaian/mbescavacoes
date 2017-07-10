<?php

/* *********************************************************************************************************************
 * Theme options
 */

if ( 1 == $ISH_DYNAMIC_CSS_COLORS_START ) {
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_fonts.php' ) );
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_colors_before.php' ) );
}

include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_colors.php' ) );

if ( (int)IYB_COLORS_COUNT <= $ISH_DYNAMIC_CSS_COLORS_START + ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT - 1  ) {
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_colors_after.php' ) );
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_patterns.php' ) );
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_responsive.php' ) );
	include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_misc.php' ) );
	if ( ishyoboy_woocommerce_plugin_active() ){
		include( locate_template( 'assets/framework/wp/dynamic_css/inc/dynamic_woocommerce.php' ) );
	}
}