<?php

/* *********************************************************************************************************************
 * Get boxed version class
 */
if ( ! function_exists( 'ishyoboy_get_boxed_layout_class' ) ) {
	function ishyoboy_get_boxed_layout_class(){
		global $ish_options, $ish_woo_id, $id_404, $wp_query;

		if ( ( function_exists('is_shop') && function_exists('woocommerce_get_page_id') ) && is_shop() ){
			$ish_woo_id = woocommerce_get_page_id( 'shop' );
		}

		if ( is_404() ){
			$post_id = $id_404;
		}
		elseif ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}else{
			$pst = get_post();
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ish_get_the_ID();
		}

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$state = isset( $meta['_ishmb_boxed_layout'] ) ? $meta['_ishmb_boxed_layout'][0] : '';
		}elseif ( null != $post_id ){
			$state = IshYoMetaBox::get('boxed_layout', true, $post_id);
		}else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$state = '';
			}else{
				$state = IshYoMetaBox::get('boxed_layout' );
			}
		}

		if ('' == $state){
			if ( isset( $ish_options['boxed_layout'] ) && '' != $ish_options['boxed_layout'] ){
				return 'ish-' . $ish_options['boxed_layout'];
			}
			else {
				return 'ish-' . ISH_DEFAULT_BOXED_LAYOUT;
			}
		}
		else{
			return 'ish-' . $state;
		}
	}
}


/* *********************************************************************************************************************
 * Get responsive layout state class
 */
if ( ! function_exists( 'ishyoboy_get_responsive_layout_class' ) ) {
	function ishyoboy_get_responsive_layout_class() {
		global $ish_options;

		if ( isset( $ish_options['use_responsive_layout'] ) && '1' == $ish_options['use_responsive_layout'] ) {
			return 'ish-responsive_layout_on';
		}
		else {
			return '';
		}
	}
}


/* *********************************************************************************************************************
 * Check if body smoothscroll is enabled
 */
if ( ! function_exists( 'ishyoboy_body_smoothscroll' ) ) {
	function ishyoboy_body_smoothscroll() {
		global $ish_options;

		if ( isset( $ish_options['nicescroll_enabled'] ) && '1' == $ish_options['nicescroll_enabled'] ) {
			return true;
		}
		else {
			return false;
		}
	}
}


/* *********************************************************************************************************************
 * Use expandable header
 * ISH-TODO: merge ishyoboy_use_expandable_header() and ishyoboy_get_expandable_header()
 */
if ( ! function_exists( 'ishyoboy_use_expandable_header' ) ) {
	function ishyoboy_use_expandable_header(){
		global $ish_options, $ish_globals, $ish_woo_id, $id_404;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		if ( is_404() ){
			$post_id = $id_404;
		}
		elseif ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_header_sidebar'] ) ? $meta['_ishmb_use_header_sidebar'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_header_sidebar', true, $post_id );
		}
		else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_header_sidebar' );
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_header_sidebar']) && is_active_sidebar($meta['_ishmb_header_sidebar'][0]) ) ? true : false;
				}else{
					$sidebar = IshYoMetaBox::get('header_sidebar', true, $post_id );
					$sidebar_set = is_active_sidebar($sidebar);
				}

				$ish_globals[__FUNCTION__] = $sidebar_set;

				return $ish_globals[__FUNCTION__];

			} else {
				$ish_globals[__FUNCTION__] = false;
				return $ish_globals[__FUNCTION__];
			}
		}
		else{
			// Default theme options
			$ish_globals[__FUNCTION__] = (isset($ish_options['expandable_header']) && '1' == $ish_options['expandable_header'] && isset($ish_options['header_sidebar']) && is_active_sidebar($ish_options['header_sidebar']) ) ? true : false;
			return $ish_globals[__FUNCTION__];
		}
	}
}


/* *********************************************************************************************************************
 * Get expandable header
 */
if ( ! function_exists( 'ishyoboy_get_expandable_header' ) ) {
	function ishyoboy_get_expandable_header(){
		global $ish_options, $ish_woo_id, $id_404;

		if ( is_404() ){
			$post_id = $id_404;
		}
		elseif ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_header_sidebar'] ) ? $meta['_ishmb_use_header_sidebar'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_header_sidebar', true, $post_id );
		}
		else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_header_sidebar' );
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_header_sidebar'])) ? $meta['_ishmb_header_sidebar'][0] : '';
				}else{
					$sidebar_set = IshYoMetaBox::get('header_sidebar', true, $post_id );
				}

				return $sidebar_set;

			} else {
				return '';
			}
		}
		else{
			// Default theme options
			return (isset($ish_options['expandable_header']) && '1' == $ish_options['expandable_header'] && isset($ish_options['header_sidebar']) && is_active_sidebar($ish_options['header_sidebar']) ) ? $ish_options['header_sidebar'] : '';
		}
	}
}

/**
 * Get position of the main navigation  - empty / left / right
 *
 * Returns the global option for the position of the main navigation
 *
 * @return string - empty, left, right
 *
 */
if ( ! function_exists( 'ishyoboy_get_mainnav_position' ) ) {
	function ishyoboy_get_mainnav_position() {
		global $ish_options, $ish_globals, $id_404;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		$menu_pos = '';

		if ( is_home() ){
			$page = get_post( get_option( 'page_for_posts' ) );
			if ( ! empty( $page ) ){
				$menu_pos = IshYoMetaBox::get( 'mainnav_pos', true, $page->ID );
			}
		}
		else if ( is_page() ){
			$menu_pos = IshYoMetaBox::get( 'mainnav_pos', true, ish_get_the_ID() );
		}
		else if ( is_404() ){
			$menu_pos = IshYoMetaBox::get( 'mainnav_pos', true, $id_404 );
		}
		else if ( ( function_exists('is_shop') && function_exists('woocommerce_get_page_id') ) && is_shop() ){
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			if ( ! empty( $shop_page_id ) ){
				$menu_pos = IshYoMetaBox::get( 'mainnav_pos', true, $shop_page_id );
			}
		}

		if ( '' == $menu_pos ){
			$menu_pos = isset( $ish_options['mainnav_position']) ? $ish_options['mainnav_position'] : '';
		}

		$ish_globals[__FUNCTION__] = $menu_pos;

		return $menu_pos;
	}
}

/**
 * Get position of the main navigation  - empty / left / right
 *
 * Returns the global option for the position of the main navigation
 *
 * @return string - empty, left, right
 *
 */
if ( ! function_exists( 'ishyoboy_get_mainnav_menu' ) ) {
	function ishyoboy_get_mainnav_menu() {
		global $ish_options, $id_404;

		$menu = '';

		if ( ( is_home() && !is_front_page()) || is_page() ){
			$menu = IshYoMetaBox::get( 'mainnav_menu', true, ish_get_the_ID() );
		}
		else if ( is_404() ){
			$menu = IshYoMetaBox::get( 'mainnav_menu', true, $id_404 );
		}
		else if ( ( function_exists('is_shop') && function_exists('woocommerce_get_page_id') ) && is_shop() ){
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			if ( ! empty( $shop_page_id ) ){
				$menu = IshYoMetaBox::get( 'mainnav_menu', true, $shop_page_id );
			}
		}

		return $menu;
	}
}

/**
 * Get the class name which sets whether the navigation should behave as onepage or multipage
 *
 * @return string
 *
 */
if ( ! function_exists( 'ishyoboy_get_mainnav_type_class' ) ) {
	function ishyoboy_get_mainnav_type_class() {
		global $ish_options;

		if ( isset( $ish_options['mainnav_type'] ) && '' != $ish_options['mainnav_type'] ){
			return 'ish-nt-' . $ish_options['mainnav_type'];
		}
		else{
			return 'ish-nt-regular';
		}

	}
}

/**
 * Check whether to place main navigation as sidenavigation
 *
 * Check whether the main navigation position is ste to left or right
 *
 * @uses ishyoboy_get_mainnav_position()
 *
 * @return bool
 *
 */
if ( ! function_exists( 'ishyoboy_use_sidenav' ) ) {
	function ishyoboy_use_sidenav() {
		global $ish_options, $ish_globals, $id_404;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		$position = ishyoboy_get_mainnav_position();

		$ish_globals[__FUNCTION__] = ( 'left' == $position || 'right' == $position ) ? true : false;

		return $ish_globals[__FUNCTION__];

	}
}

/**
 * Check whether to place main navigation as sidenavigation
 *
 * Check whether the main navigation position is ste to left or right
 *
 * @uses ishyoboy_use_sidenav(), ishyoboy_get_mainnav_position()
 *
 * @return bool
 *
 */
if ( ! function_exists( 'ishyoboy_get_sidenav_position_class' ) ) {
	function ishyoboy_get_sidenav_position_class() {
		global $ish_options, $id_404;

		$position = ishyoboy_get_mainnav_position();

		if ( ishyoboy_use_sidenav() ) {
			return ' ish-sn_' . $position;
		}

		return '';

	}
}

/**
 * Extract all attributes after merging them with defaults and global atts
 *
 * @param array $defaults - Shortcode specific atts
 * @param array $atts - Shortcode attributes as entered in Visual composer
 *
 * @return array - Array containing all final shortcode attributes values
 */
if ( ! function_exists( 'ishyoboy_extract_sc_attributes' ) ) {
	function ishyoboy_extract_sc_attributes( $defaults, $atts) {

		global $ish_plugins_shortcodes;

		if ( isset( $ish_plugins_shortcodes ) && is_object( $ish_plugins_shortcodes ) ) {
			// Shortcode plugin activated, use the  global attributes handling from it
			return $ish_plugins_shortcodes->extract_sc_attributes( $defaults, $atts );

		} else {
			// Shortcode plugin not activated, add global attributes

			$global_sc_atts = array(
				'global_atts' => '',
				'id' => '',
				'css_class' => '',
				'style' => '',
				'tooltip' => '',
				'tooltip_color' => '',
				'tooltip_custom_color' => '',
			);

			$output = shortcode_atts(
				array_merge(
					$global_sc_atts,
					$defaults
				),
				$atts
			);

			// Empty global atts if not used
			if ( ! isset($atts['global_atts']) || 'yes' != $atts['global_atts']){
				foreach ( $global_sc_atts as $key => $val ){
					$output[$key] = '';
				}
			}

			return $output;

		}

	}
}




/* *********************************************************************************************************************
 * Adds 'ish-wp38-plus' class to the body so SMOF Framework styling could be adjusted from now on
 *
 * @param string $classes
 *
 * @return string
 */
if ( ! function_exists( 'ishyoboy_add_wp38_body_class' ) ) {
	function ishyoboy_add_wp38_body_class( $classes ){
		global $wp_version;

		if ( version_compare( $wp_version, '3.8', '>=' ) ){
			$classes .= ' ish-wp38-plus';
		}

		return $classes;
	}
}

add_filter( 'admin_body_class', 'ishyoboy_add_wp38_body_class');


/**
 * Adjusts the brightness of a hex color
 *
 * @param string - color in hex fromat
 * @param integer - The amount of "steps" to darken/lighten the hex color by
 *
 * @return string - Hex color
 */
if ( ! function_exists('ishyoboy_adjust_brightness') ){
	function ishyoboy_adjust_brightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));

		// Format the hex color string
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}

		// Get decimal values
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));

		// Adjust number of steps and keep it inside 0 to 255
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));
		$b = max(0,min(255,$b + $steps));

		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

		return '#'.$r_hex.$g_hex.$b_hex;
	}
}

function ishyoboy_vc_build_style( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
	$has_image = false;
	$style = '';
	if ( (int) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
		$has_image = true;
		$style .= "background-image: url(" . $image_url . ");";
	}
	if ( ! empty( $bg_color ) ) {
		$style .= vc_get_css_color( 'background-color', $bg_color );
	}
	if ( ! empty( $bg_image_repeat ) && $has_image ) {
		if ( 'cover' === $bg_image_repeat ) {
			$style .= "background-repeat:no-repeat;background-size: cover;";
		} elseif ( 'contain' === $bg_image_repeat ) {
			$style .= "background-repeat:no-repeat;background-size: contain;";
		} elseif ( 'no-repeat' === $bg_image_repeat ) {
			$style .= 'background-repeat: no-repeat;';
		}
	}
	if ( ! empty( $font_color ) ) {
		$style .= vc_get_css_color( 'color', $font_color );
	}
	if ( $padding !== '' ) {
		$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
	}
	if ( $margin_bottom !== '' ) {
		$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
	}

	return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';
}