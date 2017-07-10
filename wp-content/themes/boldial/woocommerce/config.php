<?php
if ( ishyoboy_woocommerce_plugin_active() ) {

	// Sidebar
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	// Main Content Structure
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	//Products & Tax content wrapper
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

	// Demo Store
	remove_action( 'wp_footer', 'woocommerce_demo_store' );
	add_action( 'wp_footer', 'ishyoboy_woocommerce_demo_store' );

	// Breadcrumbs:
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

	//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); // remove result count above products
	//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // remove woocommerce ordering dropdown
	//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
	//remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination


	// Main Content Structure
	add_action('woocommerce_before_main_content', 'ishyoboy_woo_taglines', 10);
	add_action('woocommerce_before_main_content', 'ishyoboy_woo_breadcrumbs_bar', 10);
	add_action('woocommerce_before_main_content', 'ishyoboy_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'ishyoboy_woo_wrapper_end', 10);


	// Shop wrapper
	add_action('woocommerce_before_shop_loop', 'ishyoboy_woo_before_shop_loop', 10);
	add_action('woocommerce_after_shop_loop', 'ishyoboy_woo_after_shop_loop', 10);

	// Single Product wrapper
	add_action('woocommerce_before_single_product', 'ishyoboy_woo_before_shop_loop', 10);
	add_action('woocommerce_after_single_product', 'ishyoboy_woo_after_shop_loop', 10);



	// Templates:
	// no-products-found
	add_action('woocommerce_before_template_part', 'ishyoboy_woo_before_template_part', 10, 4);
	add_action('woocommerce_after_template_part', 'ishyoboy_woo_before_template_part', 10, 4);



	//Products content wrapper
	add_action( 'woocommerce_archive_description', 'ishyoboy_woo_product_archive_description', 10 );

	// Title removal:
	add_filter( 'woocommerce_show_page_title', 'ishyoboy_woo_hide_title' );

	add_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
	add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

	// Generate Dynamic CSS files
	add_filter( 'woocommerce_update_options', 'ishyoboy_dynamic_css_woocommerce', 10);
	add_action( 'customize_save_after', 'ishyoboy_woocommerce_customize_after_save', 11);


	if ( ! function_exists( 'ishyoboy_woo_add_to_cart' ) ) {
		function ishyoboy_woo_add_to_cart( $message) {
			return '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">' . $message . '</div></div>';

		}
	}

	if ( ! function_exists( 'ishyoboy_woo_before_template_part' ) ) {
		function ishyoboy_woo_before_template_part( $template_name, $template_path, $located, $args) {

			if ( 'loop/no-products-found.php' == $template_name ){
				echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">';
			}

		}
	}

	if ( ! function_exists( 'woocommerce_after_template_part' ) ) {
		function woocommerce_after_template_part( $template_name, $template_path, $located, $args) {

			if ( 'loop/no-products-found.php' == $template_name ){
				echo '</div></div>';
			}

		}
	}

	if ( ! function_exists( 'ishyoboy_woo_before_shop_loop' ) ) {
		function ishyoboy_woo_before_shop_loop() {

			echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">';

		}
	}

	if ( ! function_exists( 'ishyoboy_woo_after_shop_loop' ) ) {
		function ishyoboy_woo_after_shop_loop() {

			echo '</div></div>';

		}
	}


	function ishyoboy_woo_product_archive_description() {
		if ( is_post_type_archive( 'product' ) && get_query_var( 'paged' ) == 0 ) {
			$shop_page   = get_post( wc_get_page_id( 'shop' ) );
			if ( $shop_page ) {
				$description = apply_filters( 'the_content', $shop_page->post_content );
				if ( $description ) {
					echo $description;
				}
			}
		}
	}

	if ( ! function_exists( 'ishyoboy_woo_taglines' ) ) {
		function ishyoboy_woo_taglines() {
			global $ish_woo_id;

			$shop_page_id = null;

			if ( is_shop() ){
				$shop_page_id = woocommerce_get_page_id( 'shop' );
				$page_title   = get_the_title( $shop_page_id );
				$ish_woo_id = $shop_page_id;
			}
			else{
				$ish_woo_id = get_the_ID();
			}

			ishyoboy_get_part_tagline( $shop_page_id );
		}
	}


	if ( ! function_exists( 'ishyoboy_woo_breadcrumbs_bar' ) ) {
		function ishyoboy_woo_breadcrumbs_bar() {
			ishyoboy_show_breadcrumbs();
		}
	}

	if ( ! function_exists( 'ishyoboy_woo_hide_title' ) ) {
		function ishyoboy_woo_hide_title( $show ) {
			return false;
		}
	}

	if ( ! function_exists( 'ishyoboy_woocommerce_demo_store' ) ) {
		function ishyoboy_woocommerce_demo_store() {
			if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_woocommerce_page() ) ){
				woocommerce_demo_store();
			}
		}
	}

	if ( ! function_exists( 'ishyoboy_woo_wrapper_start' ) ) {
		function ishyoboy_woo_wrapper_start() {

			$shop_page_id = null;

			if ( is_shop() ){
				$shop_page_id = woocommerce_get_page_id( 'shop' );
				$page_title   = get_the_title( $shop_page_id );
				$ish_woo_id = $shop_page_id;
			}
			else{
				$ish_woo_id = get_the_ID();
			}

			echo '<section class="' . apply_filters( 'ish_part_content_classes', 'ish-part_content', $ish_woo_id ) . '">';

			if ( ishyoboy_has_sidebar( $ish_woo_id ) ){
				// Content with sidebar
				echo '<div class="ish-row ish-row-notfull ish-with-sidebar"><div class="ish-row_inner"><div class="' . ishyoboy_get_content_class( $ish_woo_id ) . '">';
			}else{
				// No Sidebar
				//echo '<div class="ish-row ish-row-notfull"><div class="ish-row_inner">';
			}

		}
	}

	if ( ! function_exists( 'ishyoboy_woo_wrapper_end' ) ) {
		function ishyoboy_woo_wrapper_end() {

			$shop_page_id = null;

			if ( is_shop() ){
				$shop_page_id = woocommerce_get_page_id( 'shop' );
				$page_title   = get_the_title( $shop_page_id );
				$ish_woo_id = $shop_page_id;
			}
			else{
				$ish_woo_id = get_the_ID();
			}

			if ( ishyoboy_has_sidebar( $ish_woo_id ) ){
				// Content with sidebar
				echo '</div>';
				// SIDEBAR
				get_sidebar('woocommerce');
				echo '</div></div>';
			}else{
				// No Sidebar
				//echo '</div></div>';
			}

			echo '</section>';

		}
	}
	/**
	 * is_woocommerce - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and thus are not included)
	 *
	 * @access public
	 * @return bool
	 */
	if ( ! function_exists( 'is_woocommerce_page' ) ) {
		function is_woocommerce_page() {

			if ( ! function_exists( 'is_woocommerce' ) ) {
				return false;
			}

			return ( is_cart() || is_checkout() || is_account_page() || is_order_received_page() || is_product_category() || is_product_tag() || is_product() ) ? true : false;
		}
	}
}


/* *********************************************************************************************************************
 * Woocommerce support
 */
if ( ! function_exists( 'woocommerce_support' ) ) {
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
}
add_action( 'after_setup_theme', 'woocommerce_support' );