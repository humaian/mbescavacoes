<?php

/* *********************************************************************************************************************
 * Dynamic menu support
 */
add_theme_support( 'nav-menus' );
add_action( 'init', 'ishyoboy_register_menus' );

if ( ! function_exists( 'ishyoboy_register_menus' ) ) {
	function ishyoboy_register_menus() {
		global $ish_globals;

		register_nav_menus(
			array(
				'header-menu' => __( 'Main menu', 'ishyoboy' )
			)
		);

		$ish_globals['nav_menus'] = array(
			'header-menu' => 'main-navigation' // Menu location slug => The default menu slug (for the importer) to be assigned to this location
		);
	}
}


/* *********************************************************************************************************************
 * Add searchform to main menu
 */
add_filter( 'wp_nav_menu_items', 'ishyoboy_add_search_form', 10, 2 );

if ( ! function_exists( 'ishyoboy_add_search_form' ) ) {
	function ishyoboy_add_search_form($items, $args) {
		?>
		<?php
		global $ish_options;

		if ( ! ishyoboy_use_sidenav() ){

			if ( isset($args->theme_location) && ('header-menu' == $args->theme_location ) && isset($ish_options['use_navigation_search']) && ('1' == $ish_options['use_navigation_search']) ){
				$searchboxItem =
					'<li class="ish-ph-mn-search">' .
					$args->before .
					'<a href="#search" class="ish-icon-search"></a>' . $args->after . '</li>';
				$items = $items . $searchboxItem;
			}

			if ( isset($args->theme_location) && ('header-menu' == $args->theme_location ) && ishyoboy_use_expandable_header() ){
				$expandableItem =
					'<li class="ish-ph-expandable_btn">' .
					$args->before .
					'<a href="#expandable" class="ish-icon-list-add"></a>' . $args->after . '</li>';
				$items = $items . $expandableItem;
			}

		}
		return $items;
	}
}


/* *********************************************************************************************************************
 * Create menu and search button second ul for responsive version
 */
if ( ! function_exists( 'ishyoboy_create_resp_nav' ) ) {
	function ishyoboy_create_resp_nav() {
		global $ish_options;

		$visibility_class = ( ishyoboy_use_sidenav() ) ? 'ish-ph-mn-visible' : 'ish-ph-mn-hidden';

		?>
		<ul class="ish-ph-mn-resp_nav <?php echo $visibility_class; ?>">
			<!-- Resp menu button -->
			<?php if ( ! ishyoboy_use_sidenav() ){ ?>
				<li class="ish-ph-mn-resp_menu"><a href="#respnav" class="ish-icon-menu"></a></li>
			<?php } else { ?>
				<li class="ish-ph-mn-resp_menu"><a href="#sidenav" class="ish-icon-menu"></a></li>
			<?php } ?>

			<!-- Search button if enabled -->
			<?php if ( isset($ish_options['use_navigation_search']) && ('1' == $ish_options['use_navigation_search']) ) { ?>
				<li class="ish-ph-mn-search"><a href="#search" class="ish-icon-search"></a></li>
			<?php } ?>

			<!-- Expandable button if enabled -->
			<?php if ( ishyoboy_use_expandable_header() ) { ?>
				<li class="ish-ph-expandable_btn"><a href="#expandable" class="ish-icon-list-add"></a></li>
			<?php } ?>

			<?php echo ishyoboy_add_language_selector(); ?>
		</ul>
		<?php
	}
}


/* *********************************************************************************************************************
 * Make wp_nav_menu recognize custom post type page and highlight its ancestor
 */
add_filter('nav_menu_css_class', 'ishyoboy_current_type_nav_class', 10, 2);

if ( ! function_exists( 'ishyoboy_current_type_nav_class' ) ) {
	function ishyoboy_current_type_nav_class($css_class, $cur_page){
		global $ish_options;

		$post_type = get_post_type();
		if($post_type != "page" && $post_type != 'post' ){
			$parent_page = (isset($ish_options['page_for_custom_post_type_' . $post_type])) ? $ish_options['page_for_custom_post_type_' . $post_type] : '-1';
			if($cur_page->object_id == $parent_page){
				$css_class[] = 'current_page_parent';
			}
			else{
				if(($key = array_search('current_page_parent', $css_class)) !== false) {
					unset($css_class[$key]);
				}
			}
		}
		return $css_class;
	}
}


/* *********************************************************************************************************************
 * Add language selector
 */
if ( ! function_exists( 'ishyoboy_add_language_selector' ) ) {
	function ishyoboy_add_language_selector($items = null, $args = null){
		global $ish_options;

		if ( isset( $items ) && isset( $args ) ){
			// Running as a filter
			if ( isset($args->container_class) && ('ish-ph-mn-center' == $args->container_class ) && isset($ish_options['header_bar_languages']) && ('1' == $ish_options['header_bar_languages']) ){

				$searchboxItem =
					'<li class="ish-ph-lng-selector">' .
					$args->before .
					'<a href="#"  class="ish-icon-globe"><span>' . __( 'Language', 'ishyoboy' ) . '</span></a>';

					$searchboxItem .= ishyoboy_language_selector() .

					//$args->link_before . 'Home' . $args->link_after .
					$args->after .
					'</li>';

				$items = $items . $searchboxItem;

			}

		} else {
			// Running as stand-alone function

			$items = '';

			if ( ishyoboy_wpml_plugin_active() && isset($ish_options['header_bar_languages']) && ('1' == $ish_options['header_bar_languages']) ){

				$searchboxItem =
					'<li class="ish-ph-lng-selector">' .
					'<a href="#"  class="ish-icon-globe"><span>' . __( 'Language', 'ishyoboy' ) . '</span></a>';

				$searchboxItem .= ishyoboy_language_selector() .
					'</li>';

				$items = $items . $searchboxItem;

			}
		}

		return $items;
	}
}


/* *********************************************************************************************************************
 * Do not highlight Blog page in main menu when on search results page.
 */
if ( ! function_exists( 'ishyoboy_noCurrentNavInSearch' ) ) {
	function ishyoboy_noCurrentNavInSearch( $content ) {
		if ( is_search() || is_404() ) $content = preg_replace( '/ current_page[_a-z]*([\" ])/', '\1', $content );
		return $content;
	}
}
add_filter( 'wp_nav_menu', 'ishyoboy_noCurrentNavInSearch' );


/* *********************************************************************************************************************
 * Sticky nav on
 */
if ( !function_exists('ishyoboy_is_sticky_nav_on') ) {
	function ishyoboy_is_sticky_nav_on(){

		global $ish_options;

		if ( isset( $ish_options['sticky_nav'] ) && '1' == $ish_options['sticky_nav'] ) {
			return 'ish-sticky-on';
		}
		else {
			return '';
		}

	}
}


/* *********************************************************************************************************************
 * Sticky resp nav on
 */
if ( !function_exists('ishyoboy_is_sticky_nav_responsive_on') ) {
	function ishyoboy_is_sticky_nav_responsive_on(){

		global $ish_options;

		if ( isset( $ish_options['sticky_nav_responsive'] ) && '1' == $ish_options['sticky_nav_responsive'] ) {
			return '';
		}
		else {
			return 'ish-sticky_resp-off';
		}

	}
}


/* *********************************************************************************************************************
 * Retina logo
 */
if ( !function_exists('ishyoboy_is_retina_logo') ) {
	function ishyoboy_is_retina_logo(){

		global $ish_options;
		return ( isset( $ish_options['logo_retina_image'] ) && '' != $ish_options['logo_retina_image'] );

	}
}


/* *********************************************************************************************************************
 * Logo
 */
if ( !function_exists('ishyoboy_is_logo') ) {
	function ishyoboy_is_logo(){

		global $ish_options;
		return ( isset( $ish_options['logo_image'] ) && '' != $ish_options['logo_image'] );

	}
}


/* *********************************************************************************************************************
 * Use image logo
 */
if ( !function_exists('ishyoboy_use_logo') ) {
	function ishyoboy_use_logo(){

		global $ish_options;
		return ( isset($ish_options['logo_as_image']) && '1' == $ish_options['logo_as_image']);

	}
}

if ( !function_exists('ishyoboy_empty_menu_fallback') ) {
	function ishyoboy_empty_menu_fallback(){

		echo '<ul id="mainnav" class="ish-ph-mn-main_nav"><li class="ish-no-menu">';
		if ( is_user_logged_in() ){
			echo '<a href="' . site_url() . '/wp-admin/nav-menus.php">' . __( 'No menu set under "Appearance -> Menus"' , 'ishyoboy' ) . '</a>';
		}
		else{
			echo '<a href="#">' . __( 'No menu set under "Appearance -> Menus"' , 'ishyoboy' ) . '</a>';
		}
		echo '</li></ul>';

	}
}


