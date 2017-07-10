<?php

$n_colors = Array();

for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ) {
	if ( isset( $newdata['color' . $i] ) && '' != $newdata['color' . $i] ) {
		$n_colors['ish-color' . $i]['hex'] = $newdata['color' . $i];
		$n_colors['ish-color' . $i]['rgb'] = ishyoboy_hex2rgb( $newdata['color' . $i] );
	} else {
		$n_colors['ish-color' . $i]['hex'] = ( defined( 'ISH_COLOR_' . $i ) ) ? constant( 'ISH_COLOR_' . $i ) : '#FFFFFF';
		$n_colors['ish-color' . $i]['rgb'] = ( defined( 'ISH_COLOR_' . $i ) ) ? ishyoboy_hex2rgb( constant( 'ISH_COLOR_' . $i ) ) : ishyoboy_hex2rgb( '#FFFFFF' );
	};
}

$c_text = ( isset( $newdata['text_color'] ) && '' != $newdata['text_color'] ) ? $newdata['text_color'] : ISH_TEXT_COLOR;
$c_body = ( isset( $newdata['body_color'] ) && '' != $newdata['body_color'] ) ? $newdata['body_color'] : ISH_BODY_COLOR;
$c_background = ( isset( $newdata['background_color'] ) && '' != $newdata['background_color'] ) ? $newdata['background_color'] : ISH_BACKGROUND_COLOR;

$c_body_rgb = ishyoboy_hex2rgb($c_body);
$c_text_rgb = ishyoboy_hex2rgb($c_text);

$dyn_col_opacity = 0.6;

?>

/* Color1 ----------------------------------------------------------------------------------------------------------- */
.ish-blog .wpb_row h2 a,
.ish-blog .wpb_row blockquote a,
.ish-blog .wpb_row .ish-blog-post-details a,
.ish-blog .wpb_row .ish-blog-post-links a,
.single-post .ish-part_tagline:not([class*="ish-color"]) .ish-blog-post-details a,
.ish-blog.ish-blog-masonry h3 a,
.ish-blog.ish-blog-masonry .ish-link-content a
{
	color: <?php echo $n_colors['ish-color1']['hex']; ?>;
}

.ish-blog .wpb_row h2 a:hover,
.ish-blog .wpb_row blockquote a:hover,
.ish-blog .wpb_row .ish-blog-post-details a:hover,
.ish-blog .wpb_row .ish-blog-post-links a:hover,
.single-post .ish-part_tagline:not([class*="ish-color"]) .ish-blog-post-details a:hover
{
	color: <?php echo ishyoboy_adjust_brightness( $n_colors['ish-color1']['hex'], -25 ); ?>;
}

.ish-comments-headline:before,
.ish-comments-form:before,
input[type="submit"],
.ish-blog .wpb_row .ish-blog-post-links:after,
.ish-blog-post-masonry.ish-image-cover .ish-blog-post-media + div:before
{
	background-color: <?php echo $n_colors['ish-color1']['hex']; ?>;
}

.ish-comments li.comment
{
	background-color: <?php echo "rgba(" . $n_colors['ish-color1']['rgb'] . ", 0.05);" ?>;
}


/* Color2 ----------------------------------------------------------------------------------------------------------- */
.comment-reply-link, .comment-edit-link, .comment-awaiting-moderation
{
	color: <?php echo $n_colors['ish-color2']['hex']; ?>;
}

.widget select,
.widget_search form div,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
input, textarea, select
{
	background-color: <?php echo $n_colors['ish-color2']['hex']; ?>;
}


/* Color3 ----------------------------------------------------------------------------------------------------------- */
.ish-back_to_top,
.widget select,
.widget_search input[type="text"],
.ish-pe-close,
.ish-p-overlay,
.ish-blog.ish-blog-fullwidth .ish-blog-post-links a,
.ish-blog.ish-blog-fullwidth .ish-blog-post-links > span,
input, textarea, select
{
	color: <?php echo $n_colors['ish-color3']['hex']; ?>;
}

.ish-blog.ish-blog-fullwidth .ish-blog-post-links a:hover,
.ish-blog.ish-blog-fullwidth .ish-blog-post-links i:before
{
	color: <?php echo $n_colors['ish-color3']['hex']; ?> !important;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
foreach ( $prefixes as $prefix ) {
	echo $prefix . "{ color: rgba(" . $n_colors['ish-color3']['rgb'] . ", " . $dyn_col_opacity . "); }\n";
}
?>

.ish-back_to_top
{
	border-color: <?php echo $n_colors['ish-color3']['hex']; ?>;
}


/* Color4 ----------------------------------------------------------------------------------------------------------- */


/* Color5 ----------------------------------------------------------------------------------------------------------- */
.ish-back_to_top,
.mejs-controls .mejs-time-rail .mejs-time-current,
.ish-comments li.comment-author-admin:before,
input[type="submit"]:hover
{
	background-color: <?php echo $n_colors['ish-color5']['hex']; ?>;
}

.ish-comments .bypostauthor
{
	background-color: rgba(<?php echo ishyoboy_hex2rgb($n_colors['ish-color5']['hex']); ?>, 0.25);
}

.ish-part_header .ish-row_inner:before
{
	border-color: <?php echo $n_colors['ish-color5']['hex']; ?>;
}

.ish-back_to_top:hover {
	background: <?php echo ishyoboy_adjust_brightness( $n_colors['ish-color5']['hex'], -25 ); ?>;
}

/* Extra colors - error, success ------------------------------------------------------------------------------------ */
.wpcf7-validation-errors, .wpcf7-mail-sent-ok, .ish-alert-notice { color: #fff; }
.wpcf7-validation-errors { background-color: #fa594a; } /* Error */
.wpcf7-mail-sent-ok { background-color: #9ac54a; }      /* Success */
.ish-alert-notice { background-color: #49a9e8; }      /* Notice */


<?php
// Header colors -------------------------------------------------------------------------------------------------------
if ( isset( $newdata['header_colors'] ) ) {

	// Bg
	if ( isset( $newdata['header_colors']['bg'] ) && '' != $newdata['header_colors']['bg'] ) {
		?>
		.ish-part_header .ish-row {
			background-color: <?php echo $newdata['header_colors']['bg']; ?>;

			<?php if ( isset( $newdata['header_colors_bg_opacity'] ) && '' != $newdata['header_colors_bg_opacity'] ) { ?>
				background-color: rgba(<?php echo ishyoboy_hex2rgb($newdata['header_colors']['bg']); ?>, <?php echo ( (int)$newdata['header_colors_bg_opacity'] / 100 ); ?>);
			<?php } ?>
		}
		<?php
	}

	// Text
	if ( isset( $newdata['header_colors']['text'] ) && '' != $newdata['header_colors']['text'] ) {
		?>
		.ish-part_header, .ish-part_header a {
			color: <?php echo $newdata['header_colors']['text']; ?>;
		}
		<?php
	}

	// Text active
	if ( isset( $newdata['header_colors']['text_active'] ) && '' != $newdata['header_colors']['text_active'] ) {
		?>
		.ish-part_header a:hover {
			color: <?php echo $newdata['header_colors']['text_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Main navigation colors ----------------------------------------------------------------------------------------------
if ( isset( $newdata['main_nav_colors'] ) ) {

	// BG
	if ( isset( $newdata['main_nav_colors']['bg'] ) && '' != $newdata['main_nav_colors']['bg'] ){
		?>
		.ish-ph-main_nav > ul > li > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
			background-color: <?php echo $newdata['main_nav_colors']['bg']; ?>;
		}
		<?php
	}else{
		?>
		.ish-ph-main_nav > ul > li > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
			background-color: transparent;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['main_nav_colors']['text'] ) && '' != $newdata['main_nav_colors']['text'] ){
		?>
		.ish-ph-main_nav > ul > li > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
			color: <?php echo $newdata['main_nav_colors']['text']; ?>;
		}
		<?php
	}

	// Active bg
	if ( isset( $newdata['main_nav_colors']['bg_active'] ) && '' != $newdata['main_nav_colors']['bg_active'] ){
		?>
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a
		.ish-ph-main_nav > ul > li > a:hover, .ish-ph-main_nav > ul > li:hover > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
		.ish-ph-mn-resp_menu a.ish-active,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
		.ish-ph-main_nav > ul > li.ish-op-active > a,
		.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
		{
			background-color: <?php echo $newdata['main_nav_colors']['bg_active']; ?>;
		}
		<?php
	}

	// Active text
	if ( isset( $newdata['main_nav_colors']['text_active'] ) && '' != $newdata['main_nav_colors']['text_active'] ){
		?>
		.ish-ph-main_nav > ul > li > a:hover, .ish-ph-main_nav > ul > li:hover > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
		.ish-ph-mn-resp_menu a.ish-active,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
		.ish-ph-main_nav > ul > li.ish-op-active > a,
		.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
		{
			color: <?php echo $newdata['main_nav_colors']['text_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Main navigation submenu colors --------------------------------------------------------------------------------------
if ( isset( $newdata['main_nav_submenu_colors'] ) ) {

	// BG
	if ( isset( $newdata['main_nav_submenu_colors']['bg'] ) && '' != $newdata['main_nav_submenu_colors']['bg'] ){
		?>
		.ish-ph-main_nav > ul > li ul {
			background-color: <?php echo $newdata['main_nav_submenu_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['main_nav_submenu_colors']['text'] ) && '' != $newdata['main_nav_submenu_colors']['text'] ){
		?>
		.ish-ph-main_nav > ul > li > ul li a {
			color: <?php echo $newdata['main_nav_submenu_colors']['text']; ?>;
		}
		<?php
	}

	// Active text
	if ( isset( $newdata['main_nav_submenu_colors']['text_active'] ) && '' != $newdata['main_nav_submenu_colors']['text_active'] ){
		?>
		.ish-ph-main_nav > ul > li > ul li a:hover,
		.ish-ph-main_nav > ul > li > ul li:hover > a,
		.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_ancestor > a,
		.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_parent > a,
		.ish-ph-main_nav > ul > li > ul li.ish-op-active > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_item > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_parent > a,
		.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_ancestor > a
		{
			color: <?php echo $newdata['main_nav_submenu_colors']['text_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Tagline colors ------------------------------------------------------------------------------------------------------
if ( isset( $newdata['tagline_colors'] ) ) {

	// Bg
	if ( isset( $newdata['tagline_colors']['bg'] ) && '' != $newdata['tagline_colors']['bg'] ) {
	?>
		.ish-part_tagline, .ish-part_tagline:before {
			background-color: <?php echo $newdata['tagline_colors']['bg']; ?>;
		}
		.ish-part_tagline > .ish-row {
			background-color: transparent;
		}
		<?php
	}

	// Tagline1
	if ( isset( $newdata['tagline_colors']['headline_1'] ) && '' != $newdata['tagline_colors']['headline_1'] ) {
		?>
		.ish-part_tagline h1,
		.single-post .ish-blog-post-details a:hover {
			color: <?php echo $newdata['tagline_colors']['headline_1']; ?>;
		}
		<?php
	}

	// Tagline2
	if ( isset( $newdata['tagline_colors']['headline_2'] ) && '' != $newdata['tagline_colors']['headline_2'] ) {
		?>
		.ish-part_tagline h2,
		.single-post .ish-blog-post-details,
		.single-post .ish-blog-post-details span,
		.single-post .ish-blog-post-details a {
			color: <?php echo $newdata['tagline_colors']['headline_2']; ?>;
		}
		<?php
	}
}
?>


<?php
// Breadcrumbs colors --------------------------------------------------------------------------------------------------
if ( isset( $newdata['breadcrumbs_colors'] ) ) {

	// Bg
	if ( isset( $newdata['breadcrumbs_colors']['bg'] ) && '' != $newdata['breadcrumbs_colors']['bg'] ) {
		?>
		.ish-part_breadcrumbs .ish-row,
		.ish-part_breadcrumbs:before,
		.ish-pb-socials .ish-sc_icon a > span
		{
			background-color: <?php echo $newdata['breadcrumbs_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['breadcrumbs_colors']['text'] ) && '' != $newdata['breadcrumbs_colors']['text'] ) {
		?>
		.ish-part_breadcrumbs div
		{
			color: <?php echo $newdata['breadcrumbs_colors']['text']; ?>;
		}
		<?php
	}

	// Link
	if ( isset( $newdata['breadcrumbs_colors']['link'] ) && '' != $newdata['breadcrumbs_colors']['link'] ) {
		?>
		.ish-part_breadcrumbs a
		{
			color: <?php echo $newdata['breadcrumbs_colors']['link']; ?>;
		}
		<?php
	}

	// Link active
	if ( isset( $newdata['breadcrumbs_colors']['link_active'] ) && '' != $newdata['breadcrumbs_colors']['link_active'] ) {
		?>
		.ish-part_breadcrumbs a:hover
		{
			color: <?php echo $newdata['breadcrumbs_colors']['link_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Search colors -------------------------------------------------------------------------------------------------------
if ( isset( $newdata['search_colors'] ) ) {

	// Bg
	if ( isset( $newdata['search_colors']['bg'] ) && '' != $newdata['search_colors']['bg'] ) {
		?>
		.ish-part_searchbar {
			background-color: <?php echo $newdata['search_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['search_colors']['text'] ) && '' != $newdata['search_colors']['text'] ) {
		?>
		.ish-part_searchbar input[type="text"], .ish-ps-searchform_close {
			color: <?php echo $newdata['search_colors']['text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-part_searchbar input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['search_colors']['text']) . ", " . $dyn_col_opacity . "); }\n";
			}
		}
	}

	// Text active
	if ( isset( $newdata['search_colors']['text'] ) && '' != $newdata['search_colors']['text'] ) {
		?>
		.ish-part_searchbar a:hover {
			color: <?php echo $newdata['search_colors']['text_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Sidenav colors ------------------------------------------------------------------------------------------------------
if ( isset( $newdata['sidenav_colors'] ) ) {

	// Bg
	if ( isset( $newdata['sidenav_colors']['bg'] ) && '' != $newdata['sidenav_colors']['bg'] ) {
		?>
		.ish-sidenav {
			background-color: <?php echo $newdata['sidenav_colors']['bg']; ?>;
		}
		<?php
	}

	// Link
	if ( isset( $newdata['sidenav_colors']['link'] ) && '' != $newdata['sidenav_colors']['link'] ) {
		?>
		.ish-sidenav a {
			color: <?php echo $newdata['sidenav_colors']['link']; ?>;
			border-color: rgba(<?php echo ishyoboy_hex2rgb($newdata['sidenav_colors']['link']) . ", " . $dyn_col_opacity; ?>);
		}
		<?php
	}

	// Link active
	if ( isset( $newdata['sidenav_colors']['link_active'] ) && '' != $newdata['sidenav_colors']['link_active'] ) {
		?>
		.ish-sidenav a:hover,
		.ish-sidenav .ish-nt-regular .current-menu-item > a,
		.ish-sidenav a.ish-active,
		.ish-sidenav li.ish-op-active > a,
		.ish-sidenav .ish-nt-regular .current_page_ancestor > a,
		.ish-sidenav .ish-nt-regular .current_page_item > a,
		.ish-sidenav .ish-nt-regular .current_page_parent > a,
		.ish-sidenav .ish-nt-onepage .current_page_ancestor > a,
		.ish-sidenav .ish-nt-onepage .current_page_item > a,
		.ish-sidenav .ish-nt-onepage .current_page_parent > a {
			color: <?php echo $newdata['sidenav_colors']['link_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Responsive navigation colors ----------------------------------------------------------------------------------------
if ( isset( $newdata['respnav_colors'] ) ) {

	// Bg
	if ( isset( $newdata['respnav_colors']['bg'] ) && '' != $newdata['respnav_colors']['bg'] ) {
		?>
		.ish-ph-mn-be_resp {
			background-color: <?php echo $newdata['respnav_colors']['bg']; ?>;
		}
		<?php
	}

	// Link
	if ( isset( $newdata['respnav_colors']['link'] ) && '' != $newdata['respnav_colors']['link'] ) {
		?>
		.ish-ph-mn-be_resp a {
			color: <?php echo $newdata['respnav_colors']['link']; ?>;
			border-color: rgba(<?php echo ishyoboy_hex2rgb($newdata['respnav_colors']['link']) . ", " . $dyn_col_opacity; ?>) !important;
		}
		<?php
	}

	// Link active
	if ( isset( $newdata['respnav_colors']['link_active'] ) && '' != $newdata['respnav_colors']['link_active'] ) {
		?>
		.ish-ph-mn-be_resp a:hover,
		.ish-ph-mn-be_resp a.ish-active,
		.ish-ph-mn-be_resp .current_page_ancestor > a,
		.ish-ph-mn-be_resp .current_page_item > a,
		.ish-ph-mn-be_resp .current_page_parent > a,
		.ish-ph-mn-be_resp .ish-op-active > a{
			color: <?php echo $newdata['respnav_colors']['link_active']; ?>;
		}
		<?php
	}
}
?>


<?php
// Exapndable area colors ----------------------------------------------------------------------------------------------
if ( isset( $newdata['exparea_colors'] ) || isset( $newdata['exparea_block_colors'] ) ) {

	// Bg
	if ( isset( $newdata['exparea_colors']['bg'] ) && '' != $newdata['exparea_colors']['bg'] ) {
		?>
		.ish-part_expandable .ish-pe-bg
		{
			background-color: <?php echo $newdata['exparea_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['exparea_colors']['text'] ) && '' != $newdata['exparea_colors']['text'] ) {
		?>
		.ish-part_expandable .widget
		{
			color: <?php echo $newdata['exparea_colors']['text']; ?>;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['exparea_colors']['link1'] ) && '' != $newdata['exparea_colors']['link1'] ) {
		?>
		.ish-part_expandable .widget-title,
		.ish-part_expandable .widget a
		{
			color: <?php echo $newdata['exparea_colors']['link1']; ?>;
		}
		<?php
	}
	// Link 1 hover
	if ( isset( $newdata['exparea_colors']['link1'] ) && '' != $newdata['exparea_colors']['link1'] ) {
		?>
		.ish-part_expandable .widget a:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['exparea_colors']['link1'], -25 ); ?>;
		}
		<?php
	}

	// Link 2
	if ( isset( $newdata['exparea_colors']['link2'] ) && '' != $newdata['exparea_colors']['link2'] ) {
		?>
		.ish-part_expandable .widget_calendar #wp-calendar tfoot a,
		.ish-part_expandable .widget_ishyoboy-recent-portfolio-widget a.ish-button-small,
		.ish-part_expandable .widget_ishyoboy-dribbble-widget a.ish-button-small,
		.ish-part_expandable .widget_ishyoboy-flickr-widget a.ish-button-small,
		.ish-part_expandable .widget_ishyoboy-twitter-widget a.ish-button-small
		{
			color: <?php echo $newdata['exparea_colors']['link2']; ?>;
		}
		<?php
	}
	// Link 2
	if ( isset( $newdata['exparea_colors']['link2'] ) && '' != $newdata['exparea_colors']['link2'] ) {
		?>
		.ish-part_expandable .widget_calendar #wp-calendar tfoot a:hover,
		.ish-part_expandable .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover,
		.ish-part_expandable .widget_ishyoboy-dribbble-widget a.ish-button-small:hover,
		.ish-part_expandable .widget_ishyoboy-flickr-widget a.ish-button-small:hover,
		.ish-part_expandable .widget_ishyoboy-twitter-widget a.ish-button-small:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_colors']['link2'], -25 ); ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget select,
		.ish-part_expandable .widget option,
		.ish-part_expandable .widget_search input[type="text"],
		.ish-part_expandable .widget_tag_cloud a
		{
			background-color: <?php echo $newdata['exparea_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['exparea_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['exparea_block_colors']['block_text'] ) && '' != $newdata['exparea_block_colors']['block_text'] ) {
		?>
		.ish-part_expandable .widget select,
		.ish-part_expandable .widget option,
		.ish-part_expandable .widget_search input[type="text"],
		.ish-part_expandable .widget_search input[type="submit"],
		.ish-part_expandable .widget_tag_cloud a,
		.ish-part_expandable .widget_tag_cloud a:hover
		{
			color: <?php echo $newdata['exparea_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-part_expandable .widget_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['exparea_block_colors']['block_text']) . ", " . $dyn_col_opacity . "); }\n";
			}
		}
	}

	// Block shadow
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget_tag_cloud a
		{
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['exparea_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block bg + shadow hover
	if ( isset( $newdata['exparea_block_colors']['block_bg'] ) && '' != $newdata['exparea_block_colors']['block_bg'] ) {
		?>
		.ish-part_expandable .widget_tag_cloud a:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['exparea_block_colors']['block_bg'], -25 ); ?>;
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['exparea_block_colors']['block_bg'], -50 ); ?>;
		}
		<?php
	}
}
?>


<?php
// Sidebar colors ------------------------------------------------------------------------------------------------------
if ( isset( $newdata['sidebar_colors'] ) || isset( $newdata['sidebar_block_colors'] ) ) {

	// Bg
	if ( isset( $newdata['sidebar_colors']['bg'] ) && '' != $newdata['footer_colors']['bg'] ) {
		?>
		.ish-main-sidebar
		{
			background-color: <?php echo $newdata['sidebar_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['sidebar_colors']['text'] ) && '' != $newdata['sidebar_colors']['text'] ) {
		?>
		.ish-main-sidebar .widget
		{
			color: <?php echo $newdata['sidebar_colors']['text']; ?>;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['sidebar_colors']['link1'] ) && '' != $newdata['sidebar_colors']['link1'] ) {
		?>
		.ish-main-sidebar .widget-title,
		.ish-main-sidebar .widget a
		{
			color: <?php echo $newdata['sidebar_colors']['link1']; ?>;
		}
		<?php
	}
	// Link 1 hover
	if ( isset( $newdata['sidebar_colors']['link1'] ) && '' != $newdata['sidebar_colors']['link1'] ) {
		?>
		.ish-main-sidebar .widget a:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_colors']['link1'], -25 ); ?>;
		}
		<?php
	}

	// Link 2
	if ( isset( $newdata['sidebar_colors']['link2'] ) && '' != $newdata['sidebar_colors']['link2'] ) {
		?>
		.ish-main-sidebar .widget_calendar #wp-calendar tfoot a,
		.ish-main-sidebar .widget_ishyoboy-recent-portfolio-widget a.ish-button-small,
		.ish-main-sidebar .widget_ishyoboy-dribbble-widget a.ish-button-small,
		.ish-main-sidebar .widget_ishyoboy-flickr-widget a.ish-button-small,
		.ish-main-sidebar .widget_ishyoboy-twitter-widget a.ish-button-small
		{
			color: <?php echo $newdata['sidebar_colors']['link2']; ?>;
		}
		<?php
	}
	// Link 2
	if ( isset( $newdata['sidebar_colors']['link2'] ) && '' != $newdata['sidebar_colors']['link2'] ) {
		?>
		.ish-main-sidebar .widget_calendar #wp-calendar tfoot a:hover,
		.ish-main-sidebar .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover,
		.ish-main-sidebar .widget_ishyoboy-dribbble-widget a.ish-button-small:hover,
		.ish-main-sidebar .widget_ishyoboy-flickr-widget a.ish-button-small:hover,
		.ish-main-sidebar .widget_ishyoboy-twitter-widget a.ish-button-small:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_colors']['link2'], -25 ); ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget select,
		.ish-main-sidebar .widget option,
		.ish-main-sidebar .widget_search input[type="text"],
		.ish-main-sidebar .widget_tag_cloud a
		{
			background-color: <?php echo $newdata['sidebar_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['sidebar_block_colors']['block_text'] ) && '' != $newdata['sidebar_block_colors']['block_text'] ) {
		?>
		.ish-main-sidebar .widget select,
		.ish-main-sidebar .widget option,
		.ish-main-sidebar .widget_search input[type="text"],
		.ish-main-sidebar .widget_search input[type="submit"],
		.ish-main-sidebar .widget_tag_cloud a,
		.ish-main-sidebar .widget_tag_cloud a:hover
		{
			color: <?php echo $newdata['sidebar_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-main-sidebar .widget_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['footer_block_colors']['block_text']) . ", " . $dyn_col_opacity . "); }\n";
			}
		}
	}

	// Block shadow
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget_tag_cloud a
		{
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block bg + shadow hover
	if ( isset( $newdata['sidebar_block_colors']['block_bg'] ) && '' != $newdata['sidebar_block_colors']['block_bg'] ) {
		?>
		.ish-main-sidebar .widget_tag_cloud a:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_block_colors']['block_bg'], -25 ); ?>;
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['sidebar_block_colors']['block_bg'], -50 ); ?>;
		}
		<?php
	}
}
?>


<?php
// Footer colors -------------------------------------------------------------------------------------------------------
if ( isset( $newdata['footer_colors'] ) || isset( $newdata['footer_block_colors'] ) ) {

	// Bg
	if ( isset( $newdata['footer_colors']['bg'] ) && '' != $newdata['footer_colors']['bg'] ) {
		?>
		.ish-part_footer
		{
			background-color: <?php echo $newdata['footer_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['footer_colors']['text'] ) && '' != $newdata['footer_colors']['text'] ) {
		?>
		.ish-part_footer .widget
		{
			color: <?php echo $newdata['footer_colors']['text']; ?>;
		}
		<?php
	}

	// Link 1
	if ( isset( $newdata['footer_colors']['link1'] ) && '' != $newdata['footer_colors']['link1'] ) {
		?>
		.ish-part_footer .widget-title,
		.ish-part_footer .widget a
		{
			color: <?php echo $newdata['footer_colors']['link1']; ?>;
		}
		<?php
	}
	// Link 1 hover
	if ( isset( $newdata['footer_colors']['link1'] ) && '' != $newdata['footer_colors']['link1'] ) {
		?>
		.ish-part_footer .widget a:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_colors']['link1'], -25 ); ?>;
		}
		<?php
	}

	// Link 2
	if ( isset( $newdata['footer_colors']['link2'] ) && '' != $newdata['footer_colors']['link2'] ) {
		?>
		.ish-part_footer .widget_calendar #wp-calendar tfoot a,
		.ish-part_footer .widget_ishyoboy-recent-portfolio-widget a.ish-button-small,
		.ish-part_footer .widget_ishyoboy-dribbble-widget a.ish-button-small,
		.ish-part_footer .widget_ishyoboy-flickr-widget a.ish-button-small,
		.ish-part_footer .widget_ishyoboy-twitter-widget a.ish-button-small
		{
			color: <?php echo $newdata['footer_colors']['link2']; ?>;
		}
		<?php
	}
	// Link 2 hover
	if ( isset( $newdata['footer_colors']['link2'] ) && '' != $newdata['footer_colors']['link2'] ) {
		?>
		.ish-part_footer .widget_calendar #wp-calendar tfoot a:hover,
		.ish-part_footer .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover,
		.ish-part_footer .widget_ishyoboy-dribbble-widget a.ish-button-small:hover,
		.ish-part_footer .widget_ishyoboy-flickr-widget a.ish-button-small:hover,
		.ish-part_footer .widget_ishyoboy-twitter-widget a.ish-button-small:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_colors']['link2'], -25 ); ?>;
		}
		<?php
	}

	// Block el bg
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget select,
		.ish-part_footer .widget option,
		.ish-part_footer .widget_search input[type="text"],
		.ish-part_footer .widget_tag_cloud a
		{
			background-color: <?php echo $newdata['footer_block_colors']['block_bg']; ?>;
		}
		<?php
	}

	// Block el bg active
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget_search input[type="submit"]:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block el text
	if ( isset( $newdata['footer_block_colors']['block_text'] ) && '' != $newdata['footer_block_colors']['block_text'] ) {
		?>
		.ish-part_footer .widget select,
		.ish-part_footer .widget option,
		.ish-part_footer .widget_search input[type="text"],
		.ish-part_footer .widget_search input[type="submit"],
		.ish-part_footer .widget_tag_cloud a,
		.ish-part_footer .widget_tag_cloud a:hover
		{
			color: <?php echo $newdata['footer_block_colors']['block_text']; ?>;
		}

		<?php
		$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
		$placeholders = Array( '.ish-part_footer .widget_search input[type="text"]' );
		foreach ( $placeholders as $placeholder ) {
			foreach ( $prefixes as $prefix ) {
				echo $placeholder . $prefix . "{ color: rgba(" . ishyoboy_hex2rgb($newdata['footer_block_colors']['block_text']) . ", " . $dyn_col_opacity . "); }\n";
			}
		}
	}

	// Block shadow
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget_tag_cloud a
		{
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['footer_block_colors']['block_bg'], -25 ); ?>;
		}
		<?php
	}

	// Block bg + shadow hover
	if ( isset( $newdata['footer_block_colors']['block_bg'] ) && '' != $newdata['footer_block_colors']['block_bg'] ) {
		?>
		.ish-part_footer .widget_tag_cloud a:hover
		{
			background-color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_block_colors']['block_bg'], -25 ); ?>;
			box-shadow: 0 3px 0 <?php echo ishyoboy_adjust_brightness( $newdata['footer_block_colors']['block_bg'], -50 ); ?>;
		}
		<?php
	}
}
?>


<?php
// Footer legals colors ------------------------------------------------------------------------------------------------
if ( isset( $newdata['footer_legals_colors'] ) ) {

	// Bg
	if ( isset( $newdata['footer_legals_colors']['bg'] ) && '' != $newdata['footer_legals_colors']['bg'] ) {
		?>
		.ish-part_legals .ish-row
		{
			background-color: <?php echo $newdata['footer_legals_colors']['bg']; ?>;
		}
		<?php
	}

	// Text
	if ( isset( $newdata['footer_legals_colors']['text'] ) && '' != $newdata['footer_legals_colors']['text'] ) {
		?>
		.ish-part_legals
		{
			color: <?php echo $newdata['footer_legals_colors']['text']; ?>;
		}
		<?php
	}

	// Link
	if ( isset( $newdata['footer_legals_colors']['link'] ) && '' != $newdata['footer_legals_colors']['link'] ) {
		?>
		.ish-part_legals a
		{
			color: <?php echo $newdata['footer_legals_colors']['link']; ?>;
		}
		<?php
	}

	// Link active
	if ( isset( $newdata['footer_legals_colors']['link'] ) && '' != $newdata['footer_legals_colors']['link'] ) {
		?>
		.ish-part_legals a:hover
		{
			color: <?php echo ishyoboy_adjust_brightness( $newdata['footer_legals_colors']['link'], -25 ); ?>;
		}
		<?php
	}
}