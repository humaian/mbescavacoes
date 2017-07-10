<?php

/* *********************************************************************************************************************
 * Page width dependencies & media queries & responsive rules
 */

$page_width = IYB_PAGE_WIDTH;

if ( isset( $newdata['use_predefined_page_width'] ) && '1' == $newdata['use_predefined_page_width'] ){
    if ( isset( $newdata['predefined_page_width'] ) && '' != $newdata['predefined_page_width'] ){
        $page_width = $newdata['predefined_page_width'];
    }
}else{
    if ( isset( $newdata['custom_page_width'] ) && '' != $newdata['custom_page_width'] ){
        $page_width = $newdata['custom_page_width'];
    }
}

// Breaking point
$responsive_layout_breakingpoint = IYB_BREAKINGPOINT;

if ( isset( $newdata['responsive_layout_breakingpoint'] ) && '' != $newdata['responsive_layout_breakingpoint'] ){
    $responsive_layout_breakingpoint = $newdata['responsive_layout_breakingpoint'];
}


// Menu breaking point
$responsive_nav_breakingpoint = IYB_NAV_BREAKINGPOINT;

if ( isset( $newdata['responsive_nav_breakingpoint'] ) && '' != $newdata['responsive_nav_breakingpoint'] ){
    $responsive_nav_breakingpoint = $newdata['responsive_nav_breakingpoint'];
}

?>



/* *********************************************************************************************************************
 * Content width
 */
.ish-unboxed [class^="ish-part_"] > .ish-row-notfull > .ish-row_inner,
.ish-unboxed [class*=" ish-part_"] > .ish-row-notfull > .ish-row_inner,
.ish-unboxed [class^="ish-part_"] > .ish-row-notfull > .ish-vc_row_inner,
.ish-unboxed [class*=" ish-part_"] > .ish-row-notfull > .ish-vc_row_inner,
.ish-boxed [class^="ish-part_"],
.ish-boxed [class*=" ish-part_"],
.ish-boxed .ish-wrapper-all,
.ish-part_searchbar div,
.ish-part_searchbar input[type="text"],
.ish-part_expandable .ish-row_inner {
	<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
		width: <?php echo $page_width; ?>px;
	<?php } else { ?>
		max-width: <?php echo $page_width; ?>px;
	<?php } ?>
}

.ish-unboxed .ish-wrapper-all {
	<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
		width: 100%;
		min-width: <?php echo $page_width; ?>px;
	<?php } else { ?>
		width: 100%;
	<?php } ?>
}

/*VC*/
.ish-boxed .ish-vc_row_inner {
      <?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
	      width: <?php echo $page_width; ?>px !important;
      <?php } else { ?>
	      max-width: <?php echo $page_width; ?>px !important;
      <?php } ?>
}

/* Width fix for full-height div */
.ish-row_section.ish-row-notfull.ish-row-full-height .ish-vc_row_inner {
	width: <?php echo $page_width; ?>px;
}



/* Check if responsive layout is turned on */
<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>

	/* Breaking point ONLY for main menu -> transform to button and use responsive menu *******************************/
	@media all and ( max-width: <?php echo $responsive_nav_breakingpoint; ?>px ) {

		/* Hide main wp nav */
		.ish-ph-main_nav .ish-ph-mn-main_nav {
			display: none;
		}

		/* Show responsive 2 buttons navigation */
		.ish-ph-main_nav .ish-ph-mn-resp_nav.ish-ph-mn-hidden {
			max-width: 100%;
			position: relative;
			display: table-cell;
			vertical-align: middle;
		}

	}



	/* 1024px *********************************************************************************************************/
	<?php
	if ( $page_width < 1024 ) {
	    $cur_pwidth = $page_width;
	} else {
	    $cur_pwidth = 1024;
	}
	?>
	@media all and ( max-width: <?php echo $cur_pwidth; ?>px ) {

		<?php
		// Vars --------------------------------------------------------------------------------------------------------
		$padding = 35;
		?>



		/* Grid ----------------------------------------------------------------------------------------------------- */



		/* Layout --------------------------------------------------------------------------------------------------- */



		/* Content -------------------------------------------------------------------------------------------------- */



		/* Shortcodes ----------------------------------------------------------------------------------------------- */



		/* Blog ----------------------------------------------------------------------------------------------------- */



		/* Portfolio ------------------------------------------------------------------------------------------------ */



		/* Widgets -------------------------------------------------------------------------------------------------- */
		.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
		.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
		.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li {
			width: 50% !important;
		}



		/* Plugins -------------------------------------------------------------------------------------------------- */

	}



	/* User defined breaking point (768px) & more *********************************************************************/
	@media all and ( min-width: <?php echo $responsive_layout_breakingpoint + 1; ?>px ) {

		<?php
		// Vars --------------------------------------------------------------------------------------------------------
		$padding = 35;
		?>



		/* Grid ----------------------------------------------------------------------------------------------------- */



		/* Layout -------------------------------------------------------------------------------------------------- */

		/* WITHOUT SIDEBAR */
		/* Last shortcode bottom margin */
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,

		/* Last shortcodes bottom margin - nested */
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .wpb_content_element:last-child,
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc-element:last-child {
			margin-bottom: 0 !important;
		}

		/* Move -25px up if section goes after section */
		.ish-part_content.ish-without-sidebar > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection {
			margin-top: -25px;
		}

		/* WITH SIDEBAR */
		/* Last shortcode bottom margin */
		.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
		.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,

		/* Last shortcodes bottom margin - nested */
		.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .wpb_content_element:last-child,
		.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc-element:last-child {
			margin-bottom: 0 !important;
		}

		/* Move -25px up if section goes after section */
		.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection {
			margin-top: -25px;
		}
		/* Clear top padding for next not-section row */
		.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection > .ish-vc_row_inner {
			padding-top: 0 !important;
		}



		/* Content -------------------------------------------------------------------------------------------------- */



		/* Shortcodes ----------------------------------------------------------------------------------------------- */



		/* Blog ----------------------------------------------------------------------------------------------------- */



		/* Portfolio ------------------------------------------------------------------------------------------------ */



		/* Widgets -------------------------------------------------------------------------------------------------- */




		/* Plugins -------------------------------------------------------------------------------------------------- */

	}



	/* User defined breaking point (768px) & less *********************************************************************/
	@media all and ( max-width: <?php echo $responsive_layout_breakingpoint; ?>px ) {

		<?php
		// Vars --------------------------------------------------------------------------------------------------------
		$padding = 25;
		?>



		/* Grid ----------------------------------------------------------------------------------------------------- */

		/* Ish */
		[class^="ish-grid"], [class*=" ish-grid"] {
	        float: none;
	        width: 100%;
	        margin-left: 0;
	    }
		/* VC */
		.vc_row-fluid [class^="wpb_column"], .vc_row-fluid [class*=" wpb_column"] {
			float: none !important;
	        width: 100% !important;
	        margin-left: 0 !important;
		}



		/* Layout --------------------------------------------------------------------------------------------------- */

		/* Add left and right padding to all inner rows */
		.ish-row_inner, .ish-vc_row_inner {
			padding-left: <?php echo $padding; ?>px;
			padding-right: <?php echo $padding; ?>px;
		}

		/* Fix 100vh on iOS 7 - http://support.ishyoboy.com/forums/topic/responsive-mobile-page-isnt-readable/ */
		.ish-row_section.ish-row-full-height{
			min-height: 0 !important;
		}

	    /* Tagline */
		.ish-part_tagline {
			padding-top: <?php echo $padding; ?>px;
			padding-bottom: <?php echo $padding; ?>px;
		}

	    /* WITHOUT SIDEBAR */
	    /* Add top and bottom padding to all inner rows */
		.ish-part_content.ish-without-sidebar > .ish-row > .ish-row_inner, .ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner {
			padding-top: <?php echo $padding; ?>px;
			padding-bottom: <?php echo $padding; ?>px;
		}

		/* Last shortcode bottom margin */
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,

		/* Last shortcode bottom margin - nested */
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .wpb_content_element:last-child,
		.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc-element:last-child {
			margin-bottom: 0 !important;
		}

	    /* WITH SIDEBAR */
		.ish-part_content.ish-with-sidebar .ish-pc-content > .wpb_row.ish-row-notfull > .ish-vc_row_inner {
			padding-top: <?php echo $padding; ?>px !important;
			padding-bottom: <?php echo $padding; ?>px !important;
		}

		/* Last shortcode bottom margin */
		.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
		.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,

		/* Last shortcode bottom margin - nested */
		.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .wpb_content_element:last-child,
		.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc-element:last-child {
			margin-bottom: 0 !important;
		}

		/* Move -25px up if section goes after section */
		.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection {
			margin-top: -25px;
		}

		/* Make last section margin half 50 -> 25 */
		.ish-part_content.ish-with-sidebar .ish-pc-content>.ish-row_section:last-child {
			margin-bottom: <?php echo $padding; ?>px !important;
		}

	    /* 'Unboxed' layout */
		.ish-part_content > .ish-row > .ish-row_inner {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}

		/* Padding left & right for not section & sidebar */
		.ish-pc-content > .wpb_row.ish-row_notsection,
		.ish-main-sidebar {
			padding-left: <?php echo $padding; ?>px !important;
			padding-right: <?php echo $padding; ?>px !important;
		}

	    /* Sidebar */
		.ish-main-sidebar {
			padding-top: 0 !important;
			padding-bottom: <?php echo $padding; ?>px !important;
		}
	    /* Sidebar widgets */
		.ish-main-sidebar .widget {
			padding-top: <?php echo $padding; ?>px !important;
		}

		/* Search position & paddings */
		.ish-part_searchbar div input[type="text"] {
			padding-left: <?php echo $padding; ?>px;
			padding-right: <?php echo $padding; ?>px;
		}

	    /* Expandable center + paddings - make top padding smaller */
		.ish-part_expandable .ish-pe-bg {
			padding-top: <?php echo $padding; ?>px;
		}
		/* Clear rows padding */
		.ish-part_expandable .ish-pe-bg > .ish-row {
			padding-bottom: 0;
		}
		/* Set bottom padding to each grid */
	    .ish-part_expandable [class^="ish-grid"], .ish-part_expandable [class*=" ish-grid"] {
		    padding-bottom: <?php echo $padding; ?>px;
	    }

		/* Footer paddings */
		.ish-part_footer .ish-row .ish-row_inner {
			padding-top: 0 !important;
			padding-bottom: 0 !important;
		}

		.ish-part_footer .ish-row:first-child {
			padding-top: <?php echo $padding; ?>px;
		}
	    /* Set bottom padding to each grid */
		.ish-part_footer .ish-row .ish-row_inner [class^="ish-grid"], .ish-part_footer .ish-row .ish-row_inner [class*=" ish-grid"] {
			padding-bottom: <?php echo $padding; ?>px;
		}



		/* Content -------------------------------------------------------------------------------------------------- */

		/* Sticky position on native android browser - shadow bug */
		.ish-part_header.ish-sticky-scrolling {
			left: 0;
		}

		/* Hide tagline */
		.ish-ph-wp_tagline {
			display: none;
		}

		/* Make searchbar font smaller */
		.ish-part_searchbar div input[type="text"] {
			font-size: 31px;
		}

	    /* Make margin between nav buttons smaller */
		.ish-ph-mn-resp_nav li {
			margin-left: 0 !important;
			margin-right: 0 !important;
		}

	    /* Hide sticky on responsive layout */
		body.ish-sticky_resp-off { padding-top: 0; }
		.ish-sticky_resp-off .ish-part_header { position: relative; }

		/* Non float for breadcrumbs */
		.ish-breadcrumbs, .ish-socials {
			float: none;
		}

		/* Full width categories */
	    .ish-row-full .ish-section-filter {
		    padding-top: 25px !important;
		}



		/* Shortcodes ----------------------------------------------------------------------------------------------- */

		/* Sidebar shortcode*/
		.ish-sc_sidebar .ish-row .ish-row_inner {
			padding-top: 0 !important;
			padding-bottom: 0 !important;
		}

		.ish-sc_sidebar .ish-row .ish-row_inner [class^="ish-grid"], .ish-sc_sidebar .ish-row .ish-row_inner [class*=" ish-grid"] {
			padding-bottom: <?php echo $padding; ?>px;
		}

		.ish-sc_sidebar .ish-row:last-child .ish-row_inner [class^="ish-grid"]:last-child, .ish-sc_sidebar .ish-row:last-child .ish-row_inner [class*=" ish-grid"]:last-child {
			padding-bottom: 0;
		}

		/* Recent posts */
		.ish-sc_recent_posts .ish-row .ish-recent_posts_post {
			padding-bottom: 25px !important;
		}
		.ish-sc_recent_posts .ish-row:last-child .ish-recent_posts_post:last-child {
			padding-bottom: 0 !important;
		}

	    /* left / right tabs wwitch to inline */
		.ish-tabs-navigation.ish-tabs-left ul li, .ish-tabs-navigation.ish-tabs-right ul li {
			display: inline-block;
			float: left;
			margin-left: 1px !important;
		}
		.ish-tabs-navigation.ish-tabs-left ul li:first-child, .ish-tabs-navigation.ish-tabs-right ul li:first-child {
			margin-left: 0 !important;
		}

		/* Gallery */
		.ish-sc_gallery > .ish-row [class^="ish-grid"],
		.ish-sc_gallery > .ish-row [class*=" ish-grid"]{
			width: 33.33332%;
			float: left;
		}

	    /* Video BG */
		.wpb_row.ish-videobg video {
			display: none;
		}

		/* Blog ----------------------------------------------------------------------------------------------------- */

		/* Add comment form */
		.ish-comments-form textarea {
			margin-top: 20px;
		}

	    /* Masonry layout fix */
		.ish-without-sidebar .ish-masonry-container + .wpb_row {
			padding-top: 25px !important;
		}
		.ish-with-sidebar .ish-masonry-container + .wpb_row {
			padding-top: 0 !important;
		}
		.ish-part_content.ish-with-sidebar .wpb_row.ish-masonry-container.ish-row-notfull .ish-vc_row_inner {
			padding-top: 0 !important;
			padding-bottom: 0 !important;
		}
	    /* No categories - without sidebar */
		.ish-part_breadcrumbs + .ish-part_content.ish-without-sidebar > .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner {
			padding-top: 25px !important;
		}
		.ish-part_content.ish-without-sidebar > .ish-section-filter + .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner {
			padding-top: 0 !important;
		}

	    /* No categories - with sidebar */
		.ish-part_breadcrumbs + .ish-part_content.ish-with-sidebar > .ish-row > .ish-row_inner > .ish-grid9 > .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner {
			padding-top: 25px !important;
		}
		.ish-part_content.ish-with-sidebar > .ish-row > .ish-row_inner > .ish-grid9 > .ish-section-filter + .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner {
			padding-top: 0 !important;
		}

	    /* No pagination */
		.ish-masonry-container.ish-row-notfull {
			padding-bottom: 25px !important;
		}
		.ish-with-sidebar .ish-masonry-container.ish-row-full {
			padding-bottom: 25px !important;
		}

	    /* With pagination */
		.ish-part_content .wpb_row.ish-masonry-container.ish-row-notfull + .wpb_row .ish-vc_row_inner {
			padding-top: 0 !important;
		}

		/* Classic blog posts separators */
		.ish-blog-classic .ish-blog-post-links:after {
			margin-top: 25px;
		}



		/* Portfolio ------------------------------------------------------------------------------------------------ */
		.ish-section-filter .ish-p-filter {
			margin-bottom: 0 !important;
		}



		/* Widgets -------------------------------------------------------------------------------------------------- */
		.widget-title {
			padding-bottom: 10px;
		}

		.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
		.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
		.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li {
			width: 16.65% !important;
		}



		/* Plugins -------------------------------------------------------------------------------------------------- */

	}



	/* 480px **********************************************************************************************************/
	@media all and ( max-width: 480px ) {

		<?php
		// Vars --------------------------------------------------------------------------------------------------------
		?>



		/* Grid ----------------------------------------------------------------------------------------------------- */



		/* Layout --------------------------------------------------------------------------------------------------- */



		/* Content -------------------------------------------------------------------------------------------------- */

		/* Resp nav non-float */
		.ish-ph-main_nav, .ish-ph-logo {
			float: none;
			margin: 0 auto;
		}

		.ish-part_header.ish-sticky-scrolling .ish-ph-logo {
			display: none;
		}
		.ish-part_header:not(.ish-sticky-scrolling) .ish-ph-logo,
		.ish-part_header:not(.ish-sticky-scrolling) .ish-ph-main_nav {
			height: 50% !important;
		}

		.ish-part_header:not(.ish-sticky-scrolling) .ish-row_inner:before {
			left: 50%;
			margin-left: -35px;
		}

		/* Resp breadcrumb bar */
		.ish-pb-breadcrumbs, .ish-pb-socials {
			float: none;
			width: 100%;
			display: table;
		}
		.ish-pb-breadcrumbs > div {
			margin: 0 auto;
		}
		.ish-pb-socials {
			text-align: center;
		}
		.ish-pb-socials > div {
			display: inline-block;
			float: none !important;
		}


		/* Shortcodes ----------------------------------------------------------------------------------------------- */

		/* Gallery */
		.ish-sc_gallery > .ish-row [class^="ish-grid"],
		.ish-sc_gallery > .ish-row [class*=" ish-grid"]{
			width: 49.99999%;
			float: left;
		}

		/* Blog ----------------------------------------------------------------------------------------------------- */



		/* Portfolio ------------------------------------------------------------------------------------------------ */



		/* Widgets -------------------------------------------------------------------------------------------------- */
		.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
		.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
		.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li {
			width: 33.3% !important;
		}



		/* Plugins -------------------------------------------------------------------------------------------------- */

		/* WooCommerce */
		.woocommerce table.shop_table th,
		.woocommerce table.shop_table tr,
		.woocommerce table.shop_table td{
			word-wrap: break-word !important;
			padding: 3px !important;
			min-width: 0 !important;
		}

		.woocommerce table.cart td.actions .coupon,
		.woocommerce table.cart td.actions input{
			width: 100% !important;

		}

		.woocommerce table.cart td.actions .input-text{
			margin: 0 0 3px 0 !important;
		}

		.woocommerce table.cart td.actions input{
			margin: 0 0 6px 0 !important;
		}

		.woocommerce table.cart td.actions .coupon{
			padding-bottom: 0 !important;
		}

	}



	/* 320px **********************************************************************************************************/
	@media all and ( max-width: 320px ) {

		<?php
		// Vars --------------------------------------------------------------------------------------------------------
		?>



		/* Grid ----------------------------------------------------------------------------------------------------- */



		/* Layout --------------------------------------------------------------------------------------------------- */



		/* Content -------------------------------------------------------------------------------------------------- */



		/* Shortcodes ----------------------------------------------------------------------------------------------- */

		/* Gallery */
		.ish-sc_gallery > .ish-row [class^="ish-grid"],
		.ish-sc_gallery > .ish-row [class*=" ish-grid"]{
			width: 100%;
			background-clip: border-box;
			border: transparent;
			margin-bottom: 25px;
		}

		/* Blog ----------------------------------------------------------------------------------------------------- */



		/* Portfolio ------------------------------------------------------------------------------------------------ */



		/* Widgets -------------------------------------------------------------------------------------------------- */




		/* Plugins -------------------------------------------------------------------------------------------------- */

	}


	/* Portfolio Custom breaking points********************************************************************************/
	<?php
	/*
	 * Array of all breaking points for the amount of items ina row
	 *
	 * $pflo[ items_in_a_row_count ] = Array of breaking points where ($index) = amount of items to be left in a line after the breaking point
	 */
	$pflo = Array();
	$pflo[0] = null;
	$pflo[1] = null;
	$pflo[2] = Array( 1 => 700 );
	$pflo[3] = Array( 2 => 1024, 1 => 600 );
	$pflo[4] = Array( 3 => 1150, 2 => 960, 1 => 610 );
	$pflo[5] = Array( 4 => 1240, 3 => 1016, 2 => 768, 1 => 500 );
	$pflo[6] = Array( 5 => 1240, 4 => 1054, 3 => 868, 2 => 630, 1 => 440 );
	$pflo[7] = Array( 6 => 1240, 5 => 1080, 4 => 920, 3 => 768, 2 => 600, 1 => 390 );
	$pflo[8] = Array( 7 => 1240, 6 => 1110, 5 => 980, 4 => 830, 3 => 625, 2 => 480, 1 => 350 );

	if ( ! empty( $pflo ) ) {

		$pflo_width = 100; // 100% of the container
		$pflo_ffie_fix = 0.00001;

		foreach ( $pflo as $items_per_line => $breaks ){
			if ( ! empty( $breaks ) ){
				foreach ( $breaks as $items_count => $point ){
					if ( isset($point) ){
						//echo $items_per_line . ': [' . $items_count . '] => ' . $point . "\n";
						$double = ( $items_count > 1 ) ? 2 : 1 ;
						echo '@media all and ( max-width: '.$point.'px ){ .ish-sc_portfolio[data-count="'.$items_per_line.'"] .ish-p-col{ width: ' . ( ( $pflo_width / $items_count ) - $pflo_ffie_fix ) . '% !important;} .ish-p-packery.ish-sc_portfolio[data-count="'.$items_per_line.'"] .ish-p-col-w2{ width: ' . ( ( ( $pflo_width / $items_count ) * $double ) - $pflo_ffie_fix ) . '% !important;}}'."\n";
					}
				}
			}
		}

	}

	?>


	/* Blog masonry custom breaking points ****************************************************************************/
	<?php
	/*
	 * Array of all breaking points for the amount of items ina row
	 *
	 * $blgmas[ items_in_a_row_count ] = Array of breaking points where ($index) = amount of items to be left in a line after the breaking point
	 */
	$blgmas = Array();
	$blgmas[0] = null;
	$blgmas[1] = null;
	$blgmas[2] = Array( 1 => 700 );
	$blgmas[3] = Array( 2 => 1024, 1 => 600 );
	$blgmas[4] = Array( 3 => 1150, 2 => 960, 1 => 610 );
	$blgmas[5] = Array( 4 => 1240, 3 => 1016, 2 => 768, 1 => 500 );
	$blgmas[6] = Array( 5 => 1240, 4 => 1054, 3 => 868, 2 => 630, 1 => 440 );
	$blgmas[7] = Array( 6 => 1240, 5 => 1080, 4 => 920, 3 => 768, 2 => 600, 1 => 390 );
	$blgmas[8] = Array( 7 => 1240, 6 => 1110, 5 => 980, 4 => 830, 3 => 625, 2 => 480, 1 => 350 );

	if ( ! empty( $blgmas ) ) {

		$blgmas_width = 100; // 100% of the container
		$blgmas_ffie_fix = 0.00001;

		foreach ( $blgmas as $items_per_line => $breaks ){
			if ( ! empty( $breaks ) ){
				foreach ( $breaks as $items_count => $point ){
					if ( isset($point) ){
						//echo $items_per_line . ': [' . $items_count . '] => ' . $point . "\n";
						$double = ( $items_count > 1 ) ? 2 : 1 ;
						echo '@media all and ( max-width: '.$point.'px ){ .ish-blog-masonry[data-count="'.$items_per_line.'"] .ish-blog-post-masonry{ width: ' . ( ( $blgmas_width / $items_count ) - $blgmas_ffie_fix ) . '% !important;} .ish-blog-masonry[data-count="'.$items_per_line.'"] .ish-bpm-w2{ width: ' . ( ( ( $blgmas_width / $items_count ) * $double ) - $blgmas_ffie_fix ) . '% !important;}}'."\n";
					}
				}
			}
		}

	}

	?>
	@media all and ( max-width: 500px ) {
		[class*="ish-bpm"].ish-blog-post-masonry {
			/*border: 1px solid red !important;*/

			/*&:before {
				padding-top: 200% !important;
			}*/
		}

		.ish-blog-post-masonry:before {
			padding-top: 200%;
		}
	}
	<?php
}