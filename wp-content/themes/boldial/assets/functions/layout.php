<?php

/**
 * Echo the breadcrumbs block
 *
 * Checks weather the breadcrumbs should be displayed and shows the part_breadcrumbs block
 *
 * @return void
 */
if ( ! function_exists( 'ishyoboy_show_breadcrumbs' ) ) {
	function ishyoboy_show_breadcrumbs(){

		global $ish_options, $ish_woo_id, $id_404;

		if ( is_404() ){
			$post_id = $id_404;
		}
		elseif ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if ( is_home() ){

			if ( is_front_page() ){
				$show = '';
			}
			else{

				$home = get_post( get_option( 'page_for_posts' ) );
				if ( ! empty( $home ) ){
					$show = IshYoMetaBox::get('show_breadcrumbs', true, $home->ID );
				}
				else{
					$show = '';
				}

			}

		}elseif ( null != $post_id ){
			$show = IshYoMetaBox::get('show_breadcrumbs', true, $post_id );
		}else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$show = '';
			}else{
				$show = IshYoMetaBox::get('show_breadcrumbs' );
			}
		}

		if ( '' == $show ){
			// Get global options
			if ( isset( $ish_options['show_breadcrumbs'] ) ){
				$show = $ish_options['show_breadcrumbs'];
			}
		}

		if ( ( '' != $show )  &&  ( 'none' != $show )  ){

			echo '
			<div class="ish-part_breadcrumbs">
				<div class="ish-row ish-row-notfull">
					<div class="ish-row_inner">';

			if ( 'breadcrumbs' == $show || 'breadcrumbs-icons' == $show ) {
				echo ishyoboy_get_breadcrumbs();
			}

			if ( 'icons' == $show || 'breadcrumbs-icons' == $show  ) {
				if ( isset( $ish_options['social_icons_bar'] ) && ( '' != $ish_options['social_icons_bar']) && shortcode_exists('ish_icon') ) {
					echo '<div class="ish-pb-socials">';
					echo do_shortcode( $ish_options['social_icons_bar'] );
					echo '</div>';
				}
			}

			echo '</div></div></div>';

		}

	}
}


/**
 * Checks if sidebar is used on the current page
 *
 * Checks if sidebar is used on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ishyoboy_get_sidebar_position()
 *
 * @param integer $post_id The ID of the current post or page
 * @return bool
 */
if ( ! function_exists( 'ishyoboy_has_sidebar' ) ) {
	function ishyoboy_has_sidebar( $post_id = null ){
		global $ish_options, $ish_globals;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		$sidebar_position = ishyoboy_get_sidebar_position( $post_id );

		if ( 'left' == $sidebar_position || 'right' == $sidebar_position){
			$ish_globals[__FUNCTION__] = true;
		}else{
			$ish_globals[__FUNCTION__] = false;
		}

		return $ish_globals[__FUNCTION__];
	}
}

/**
 * Return a string containing the sidebar position
 *
 * Checks the position of the sidebar for the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @param integer $post_id The ID of the current post or page
 * @return string "left", "right" or empty string if none;
 */
if ( ! function_exists( 'ishyoboy_get_sidebar_position' ) ) {
	function ishyoboy_get_sidebar_position($post_id = null){
		global $ish_options, $ish_globals;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		if ( $post_id ) {
			$id = $post_id;
		}else{
			$id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if ( is_home() ){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$sidebar_position = isset( $meta['_ishmb_sb_pos'] ) ? $meta['_ishmb_sb_pos'][0] : '';
		}
		elseif( null != $id ){
			$sidebar_position = IshYoMetaBox::get('sb_pos', true, $id );
		}
		else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$sidebar_position = '';
			}
			else{
				$sidebar_position = IshYoMetaBox::get('sb_pos' );
			}
		}

		if ('' == $sidebar_position){
			// Use global settings

			if ( ( isset($ish_options['page_for_custom_post_type_portfolio-post']) && $id == $ish_options['page_for_custom_post_type_portfolio-post']) || (is_singular('portfolio-post')) || is_tax('portfolio-category')){
				// PORTFOLIO OVERVIEW
				//echo '<h1>SETTINGS: PORTFOLIO OVERVIEW</h1>';
				if (isset($ish_options['show_portfolio_sidebar']) && '1' == $ish_options['show_portfolio_sidebar']){
					// Portfolio sidebar turned ON
					//echo '<h1>SETTINGS: PORTFOLIO SIDEBAR ON</h1>';
					if (isset($ish_options['portfolio_sidebar_position']) && '' != $ish_options['portfolio_sidebar_position']){
						$sidebar_position = $ish_options['portfolio_sidebar_position'];
					}
					else{
						$sidebar_position = 'right';
					}
				}else{
					// Portfolio sidebar turned OFF
					//echo '<h1>SETTINGS: PORTFOLIO SIDEBAR OFF</h1>';
					$sidebar_position = '';
				}
			}else{

				if ( function_exists('is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

					if (isset($ish_options['show_woocommerce_sidebar']) && '1' == $ish_options['show_woocommerce_sidebar']){
						// Sidebar ON
						if (isset($ish_options['woocommerce_sidebar_position']) && '' != $ish_options['woocommerce_sidebar_position']){
							$sidebar_position = $ish_options['woocommerce_sidebar_position'];
						}else{
							$sidebar_position = 'right';
						}
					}else{
						// Sidebar OFF
						$sidebar_position = '';
					}

				}
				else{

					if (is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
						// BLOG OVERVIEW
						//echo '<h1>SETTINGS: BLOG OVERVIEW</h1>';
						if (isset($ish_options['show_blog_sidebar']) && '1' == $ish_options['show_blog_sidebar']){
							// Blog sidebar turned ON
							//echo '<h1>SETTINGS: BLOG SIDEBAR ON</h1>';
							if (isset($ish_options['blog_sidebar_position']) && '' != $ish_options['blog_sidebar_position']){
								$sidebar_position = $ish_options['blog_sidebar_position'];
							}
							else{
								$sidebar_position = 'right';
							}
						}
						else{
							// Blog sidebar turned OFF
							//echo '<h1>SETTINGS: BLOG SIDEBAR OFF</h1>';
							$sidebar_position = '';
						}
					}else{

						// REGULAR PAGE
						//echo '<h1>SETTINGS: REGULAR PAGE</h1>';
						if (isset($ish_options['show_page_sidebar']) && '1' == $ish_options['show_page_sidebar']){
							// Page sidebar turned ON
							//echo '<h1>SETTINGS: PAGE SIDEBAR ON</h1>';
							if (isset($ish_options['page_sidebar_position']) && '' != $ish_options['page_sidebar_position']){
								$sidebar_position = $ish_options['page_sidebar_position'];
							}
							else{
								$sidebar_position = 'right';
							}
						}
						else{
							// Page sidebar turned OFF
							//echo '<h1>SETTINGS: PAGE SIDEBAR OFF</h1>';
							$sidebar_position = '';
						}

					}
				}
			}
		}
		else{
			//echo '<h1>CUSTOM SETTINGS: ' . $sidebar_position . '</h1>';
		}

		$ish_globals[__FUNCTION__] = $sidebar_position;

		return $ish_globals[__FUNCTION__];
	}
}


/**
 * Return the current page's sidebar ID as string
 *
 * Checks which sidebar should be displayed on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ish_get_the_ID()
 *
 * @param integer $post_id; The ID of the current post or page
 *
 * @return string The ID of the sidebar which is set for the current page
 */
if ( ! function_exists( 'ishyoboy_get_sidebar' ) ) {
	function ishyoboy_get_sidebar($post_id = null){
		global $ish_options;

		if ( $post_id ) {
			$id = $post_id;
		}else{
			$id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$sidebar_position = isset( $meta['_ishmb_sb_pos'] ) ? $meta['_ishmb_sb_pos'][0] : '';
		}elseif( null != $id ){
			$sidebar_position = IshYoMetaBox::get('sb_pos', true, $id );
		}
		else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$sidebar_position = '';
			}else{
				$sidebar_position = IshYoMetaBox::get('sb_pos' );
			}
		}

		if ( '' != $sidebar_position){
			// Local settings exist
			if (is_home()){
				$sidebar = isset( $meta['_ishmb_sidebar'] ) ? $meta['_ishmb_sidebar'][0] : '';
			}else{
				$sidebar = IshYoMetaBox::get('sidebar', true, $id );
			}

		}else{
			// Use global settings
			if (( isset($ish_options['page_for_custom_post_type_portfolio-post']) && $id == $ish_options['page_for_custom_post_type_portfolio-post']) || is_singular('portfolio-post') || is_tax('portfolio-category') ){
				// PORTFOLIO OVERVIEW
				//echo '<h1>DEFAULT: PORTFOLIO OVERVIEW</h1>';
				if (isset($ish_options['show_portfolio_sidebar']) && '1' == $ish_options['show_portfolio_sidebar']){
					// Portfolio sidebar set
					$sidebar = $ish_options['portfolio_sidebar'];
				}else{
					// Portfolio sidebar not set
					$sidebar = '';
				}
			}else{
				if ( function_exists('is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

					if (isset($ish_options['show_woocommerce_sidebar']) && '1' == $ish_options['show_woocommerce_sidebar']){
						$sidebar = $ish_options['woocommerce_sidebar'];
					}else{
						$sidebar = '';
					}

				}
				else{

					if ( is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
						// BLOG OVERVIEW
						//echo '<h1>DEFAULT: BLOG OVERVIEW</h1>';
						if (isset($ish_options['show_blog_sidebar']) && '1' == $ish_options['show_blog_sidebar']){
							$sidebar = $ish_options['blog_sidebar'];
						}else{
							$sidebar = '';
						}
					}else{
						// REGULAR PAGE
						//echo '<h1>DEFAULT: REGULAR PAGE</h1>';
						if (isset($ish_options['show_page_sidebar']) && '1' == $ish_options['show_page_sidebar']){
							$sidebar = $ish_options['page_sidebar'];
						}else{
							$sidebar = '';
						}
					}
				}
			}
		}
		return $sidebar;
	}
}


/**
 * Return the content classes
 *
 * Return the content classes which will be used to position the sidebar and the content divs
 *
 * @uses ishyoboy_get_content_class()
 * @uses ishyoboy_get_sidebar_position()
 *
 * @param integer $post_id The ID of the current post or page
 *
 * @return string
 */
if ( ! function_exists( 'ishyoboy_get_content_class' ) ) {
	function ishyoboy_get_content_class($post_id = null){
		global $ish_options, $ish_globals;

		// Load from global "cache"
		if ( isset( $ish_globals[__FUNCTION__] ) ) return $ish_globals[__FUNCTION__];

		$sidebar_position = ishyoboy_get_sidebar_position($post_id);
		$class = '';

		switch ( $sidebar_position ){
			case 'none':
				$class = '';
				break;
			case 'left':
				$class = ' ish-pc-content ish-grid9 ish-with-sidebar ish-with-left-sidebar';
				break;
			case 'right':
				$class = ' ish-pc-content ish-grid9 ish-with-sidebar ish-with-right-sidebar';
				break;
			default :
				$class = '';
				break;
		}

		$ish_globals[__FUNCTION__] = $class;

		return $ish_globals[__FUNCTION__];
	}
}