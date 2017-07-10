<?php

$wc_colors = get_option( 'woocommerce_colors' );
if ( ! $wc_colors ) {
	// Try previous field name which was used in WooCommerce 2.2.*
	$wc_colors = get_option( 'woocommerce_frontend_css_colors' );
}

if ( empty( $wc_colors ) ) {

	$wc_colors = Array();
	/*
	$wc_colors['primary'] = '#a46497';
	$wc_colors['secondary'] = '#ebe9eb';
	$wc_colors['highlight'] = '#77a464';
	$wc_colors['content_bg'] = '#ffffff';
	$wc_colors['subtext'] = '#777777';
	*/

	// Woocommerce colors
	$wc_colors['primary'] = '#ad74a2';
	$wc_colors['secondary'] = '#f7f6f7';
	$wc_colors['highlight'] = '#85ad74';
	$wc_colors['content_bg'] = '#ffffff';
	$wc_colors['subtext'] = '#777777';
}

/*

$wc_colors['primary'];
$wc_colors['secondary'];
$wc_colors['highlight'];
$wc_colors['content_bg'];
$wc_colors['subtext'];

ishyoboy_hex2rgb( $wc_colors['primary'] );

ishyoboy_adjust_brightness( $wc_colors['primary'], -25 )

*/


// Body color
echo "
.product-category a,
.product a,
.myaccount_user a,
.addresses a,
.product-category a mark,
.chosen-search input,
.shop_table.cart a,
.add_to_cart_button:before
{
	color: " . $c_text . ";
}\n";


// Info, mesage, error
?>
.woocommerce-error, .woocommerce-message, .woocommerce-info,
.woocommerce-error a, .woocommerce-message a, .woocommerce-info a {
	color: #fff !important;
}

.woocommerce-info { background: #49a9e8 !important; }
.woocommerce-info:before { color: #49a9e8 !important; }
.woocommerce-message { background: #9ac54a !important; }
.woocommerce-message:before { color: #9ac54a !important; }
.woocommerce-error { background: #fa594a !important; }
.woocommerce-error:before { color: #fa594a !important; }

.woocommerce-info:before,
.woocommerce-message:before,
.woocommerce-error:before {
	background: #fff !important;
}
<?php


// Primary -------------------------------------------------------------------------------------------------------------
echo "
.x
{
	color: " . $wc_colors['primary'] . ";
}\n";

echo "
.demo_store,
.place-order .button,
.single_add_to_cart_button.button,
.woocommerce-pagination span.page-numbers,
.price_slider .ui-slider-range,
.price_slider .ui-slider-handle,
.wc-forward.checkout-button.button,
.shipping-calculator-button,
.wc-backward.button
{
	background: " . $wc_colors['primary'] . " !important;
}\n";

echo "
.place-order .button:hover,
.single_add_to_cart_button.button:hover,
.wc-forward.checkout-button.button:hover,
.shipping-calculator-button:hover,
.wc-backward.button:hover
{
	background: " . ishyoboy_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.price_slider .ui-slider-handle
{
	border-color: " . ishyoboy_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.place-order .button,
.single_add_to_cart_button.button,
.woocommerce-pagination span.page-numbers,
.wc-forward.checkout-button.button,
.wc-backward.button,
.shipping-calculator-button
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.place-order .button:hover,
.single_add_to_cart_button.button:hover,
.wc-forward.checkout-button.button:hover,
.wc-backward.button:hover,
.shipping-calculator-button:hover
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['primary'], -50 ) . " !important;
}\n";


// Secondary -----------------------------------------------------------------------------------------------------------
echo "
.x
{
	color: " . $wc_colors['secondary'] . ";
}\n";

echo "
.s
{
	background: " . $wc_colors['secondary'] . " !important;
}\n";


// Highlight -----------------------------------------------------------------------------------------------------------
echo "
.product ins
{
	color: " . $wc_colors['highlight'] . ";
}\n";

echo "
.onsale
{
	background: " . $wc_colors['highlight'] . " !important;
}\n";


// Content -------------------------------------------------------------------------------------------------------------
echo "
.demo_store,
.wc-forward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
.woocommerce-pagination .page-numbers,
.widget_product_tag_cloud a,
.wc-forward.checkout-button.button,
.shipping-calculator-button,
.quantity .minus, .quantity .plus,
.form-submit #submit,
.checkout_coupon .button,
.woocommerce-tabs .tabs a,
.chosen-single,
.payment_box,
.place-order .button,
.single_add_to_cart_button.button,
.woocommerce .products .button,
.wc-backward.button
{
	color: " . $wc_colors['content_bg'] . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button
{
	background: " . $wc_colors['content_bg'] . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button:hover, .woocommerce-message .wc-forward.button:hover, .woocommerce-info .wc-forward.button:hover
{
	background: " . ishyoboy_adjust_brightness( $wc_colors['content_bg'], -25 ) . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['content_bg'], -25 ) . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button:hover, .woocommerce-message .wc-forward.button:hover, .woocommerce-info .wc-forward.button:hover
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['content_bg'], -50 ) . " !important;
}\n";


// Subtext  ------------------------------------------------------------------------------------------------------------
echo "
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button
{
	color: " . $wc_colors['subtext'] . " !important;
}\n";

echo "
.wc-forward.button,
.wc-backward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
.woocommerce-pagination a.page-numbers,
.widget_product_tag_cloud a,
.price_slider,
.quantity .minus, .quantity .plus,
.form-submit #submit,
.checkout_coupon .button,
.woocommerce-tabs .tabs a,
.chosen-single,
.payment_box,
.woocommerce .products .button
{
	background: " . $wc_colors['subtext'] . " !important;
}\n";

echo "
.wc-forward.button:hover,
.wc-backward.button:hover,
.add_to_cart_button.button:hover,
.price_slider_amount .button:hover,
.coupon .button:hover,
.coupon + .button:hover,
.shipping-calculator-form .button:hover,
.button[name='save_address']:hover,
.button[name='save_account_details']:hover,
.button[name='login']:hover,
.button[name='wc_reset_password']:hover,
.woocommerce-pagination a.page-numbers:hover,
.widget_product_tag_cloud a:hover,
.quantity .minus:hover, .quantity .plus:hover,
.form-submit #submit:hover,
.checkout_coupon .button:hover,
.woocommerce-tabs .tabs a:hover, .woocommerce-tabs .tabs .active a,
.woocommerce .products .button:hover
{
	background: " . ishyoboy_adjust_brightness( $wc_colors['subtext'], -25 ) . " !important;
}\n";

echo "
.wc-forward.button,
.wc-backward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
.woocommerce-pagination a.page-numbers,
.widget_product_tag_cloud a,
.form-submit #submit,
.checkout_coupon .button,
.woocommerce-tabs .tabs a,
.woocommerce .products .button
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['subtext'], -25 ) . " !important;
}\n";

echo "
.wc-forward:hover.button,
.wc-backward:hover.button,
.add_to_cart_button.button:hover,
.price_slider_amount .button:hover,
.coupon .button:hover,
.coupon + .button:hover,
.shipping-calculator-form .button:hover,
.button[name='save_address']:hover,
.button[name='save_account_details']:hover,
.button[name='login']:hover,
.button[name='wc_reset_password']:hover,
.woocommerce-pagination a.page-numbers:hover,
.widget_product_tag_cloud a:hover,
.form-submit #submit:hover,
.checkout_coupon .button:hover,
.woocommerce-tabs .tabs a:hover, .woocommerce-tabs .tabs .active a,
.woocommerce .products .button:hover
{
	box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $wc_colors['subtext'], -50 ) . " !important;
}\n";

?>


<?php
// Exapndable area colors ----------------------------------------------------------------------------------------------
if ( isset( $newdata['exparea_colors'] ) || isset( $newdata['exparea_block_colors'] ) ) {

	// Text
	if ( isset( $newdata['exparea_colors']['text'] ) && '' != $newdata['exparea_colors']['text'] ) {
		?>
		.ish-part_expandables .widget_shopping_cart .total
		{
			border-color: <?php echo $newdata['exparea_colors']['text']; ?> !important;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['exparea_colors']['link1'] ) && '' != $newdata['exparea_colors']['link1'] ) {
		?>
		.ish-part_expandable .widget_shopping_cart .total
		{
			color: <?php echo $newdata['exparea_colors']['link1']; ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget_product_search input[type="text"],
		.ish-part_expandable .widget_product_search input[type="submit"]
		{
			background-color: <?php echo $newdata['exparea_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget_product_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['exparea_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['exparea_block_colors']['block_text'] ) && '' != $newdata['exparea_block_colors']['block_text'] ) {
		?>
		.ish-part_expandable .widget_product_search input[type="text"],
		.ish-part_expandable .widget_product_search input[type="submit"]
		{
			color: <?php echo $newdata['exparea_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-part_expandable .widget_product_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['exparea_block_colors']['block_text']) . ", 0.5); }\n";
			}
		}
	}

}
?>


<?php
// Sidebar colors ------------------------------------------------------------------------------------------------------
if ( isset( $newdata['sidebar_colors'] ) || isset( $newdata['sidebar_block_colors'] ) ) {

	// Text
	if ( isset( $newdata['sidebar_colors']['text'] ) && '' != $newdata['sidebar_colors']['text'] ) {
		?>
		.ish-main-sidebar .widget_shopping_cart .total
		{
			border-color: <?php echo $newdata['sidebar_colors']['text']; ?> !important;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['sidebar_colors']['link1'] ) && '' != $newdata['sidebar_colors']['link1'] ) {
		?>
		.ish-main-sidebar .widget_shopping_cart .total
		{
			color: <?php echo $newdata['sidebar_colors']['link1']; ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget_product_search input[type="text"],
		.ish-main-sidebar .widget_product_search input[type="submit"]
		{
			background-color: <?php echo $newdata['sidebar_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget_product_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['sidebar_block_colors']['block_text'] ) && '' != $newdata['sidebar_block_colors']['block_text'] ) {
		?>
		.ish-main-sidebar .widget_product_search input[type="text"],
		.ish-main-sidebar .widget_product_search input[type="submit"]
		{
			color: <?php echo $newdata['sidebar_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-main-sidebar .widget_product_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['footer_block_colors']['block_text']) . ", 0.5); }\n";
			}
		}
	}


}
?>


<?php
// Footer colors -------------------------------------------------------------------------------------------------------
if ( isset( $newdata['footer_colors'] ) || isset( $newdata['footer_block_colors'] ) ) {

	// Text
	if ( isset( $newdata['footer_colors']['text'] ) && '' != $newdata['footer_colors']['text'] ) {
		?>
		.ish-part_footer .widget_shopping_cart .total
		{
			border-color: <?php echo $newdata['footer_colors']['text']; ?> !important;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['footer_colors']['link1'] ) && '' != $newdata['footer_colors']['link1'] ) {
		?>
		.ish-part_footer .widget_shopping_cart .total
		{
			color: <?php echo $newdata['footer_colors']['link1']; ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget_product_search input[type="text"],
		.ish-part_footer .widget_product_search input[type="submit"]
		{
			background-color: <?php echo $newdata['footer_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget_product_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['footer_block_colors']['block_text'] ) && '' != $newdata['footer_block_colors']['block_text'] ) {
		?>
		.ish-part_footer .widget_product_search input[type="text"],
		.ish-part_footer .widget_product_search input[type="submit"]
		{
			color: <?php echo $newdata['footer_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-part_footer .widget_product_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['footer_block_colors']['block_text']) . ", 0.5); }\n";
			}
		}
	}

}
?>