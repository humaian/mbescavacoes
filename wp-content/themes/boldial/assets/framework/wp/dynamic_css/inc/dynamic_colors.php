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


$start_color = $ISH_DYNAMIC_CSS_COLORS_START;
$end_color = $ISH_DYNAMIC_CSS_COLORS_START + ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT - 1;
$end_color = ( $end_color > IYB_COLORS_COUNT ) ? IYB_COLORS_COUNT  : $end_color ;

?>

/* color<?php echo $start_color; ?> - color<?php echo $end_color; ?> ---------------------------------------------------------------------------------------- */
<?php
for ( $i = $start_color; $i <= $end_color; $i++ ) {

	// Current color name E.g.: "ish-color1" ---------------------------------------------------------------------------
	$cc = 'ish-color' . $i;
	$tc = 'ish-text-color' . $i;
	$sc = 'ish-skill-color' . $i;
	$nc = 'ish-nav-color' . $i;
	$pnc = 'ish-prevnext-color' . $i;

	$lc1 = 'ish-link1-color' . $i;
	$lc2 = 'ish-link2-color' . $i;
	$bbgc = 'ish-block-bg-color' . $i;
	$btc = 'ish-block-text-color' . $i;
	$bg_cc = 'ish-bg-text-color' . $i;
	$tt_bg = 'ish-tooltip-color' . $i;
	$tt_tc = 'ish-tooltip-text-color' . $i;

	$hbg = 'ish-header-bg-color' . $i;
	$htc = 'ish-header-text-color' . $i;

	$borderc = 'ish-border-color' . $i;


	// color* ----------------------------------------------------------------------------------------------------------
	echo "
	.wpb_row.$tc,
	.wpb_row.$tc a,
	.ish-sc_headline.$cc,
	.ish-sc_headline.$cc a,
	.ish-sc_list.$cc li:before,
	.ish-sc_list.$cc.ish-noicon li:before,
	.ish-sc_list.$tc,
	.ish-sc_quote.$cc,
	.ish-sc_quote.$cc a,
	.ish-p-overlay.$tc,
	.ish-blog .wpb_row.$cc h2 a,
	.ish-blog .wpb_row.$cc blockquote a,
	.ish-blog .wpb_row.$cc .ish-blog-post-details a:hover,
	.ish-blog .wpb_row.$cc .ish-blog-post-links i:before,
	.ish-blog .wpb_row.$cc .ish-blog-post-links a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h2 a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-post-details a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-post-details a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-post-details span,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc blockquote a,
	.ish-blog.ish-blog-masonry .$tc,
	.ish-blog.ish-blog-masonry .$tc a,
	.ish-blog.ish-blog-masonry .$tc cite:before,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details a,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details a:hover,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details span,
	.ish-blog.ish-blog-masonry .$tc .ish-link-content a,
	.ish-tagline-image.$tc h1,
	.ish-tagline-image.$tc .ish-blog-post-details a,
	.ish-tagline-colored.$tc h1,
	.ish-tagline-colored.$tc .ish-blog-post-details a,
	.$tc .ish-section-filter li a:hover,
	.$tc .ish-section-filter li a.ish-active,
	.$tc .ish-section-filter li.current-cat a:hover,
	.ish-recent_posts_post.$cc h3 a,
	.ish-sc-element.ish-sc_icon.$tc,
	.ish-sc-element.ish-sc_icon.$tc a, .ish-sc-element.ish-sc_icon.$tc a:hover,
	.ish-sc_skills .ish-sc_skill.$tc .ish-bar-bg .ish-bar,
	.ish-sc_skills .ish-sc_skill.$tc.ish-outside > span,
	.ish-gmap_box.$tc, .ish-gmap_box.$tc a, .ish-gmap_box.$tc a:hover,
	div.ish-recent_posts_post.$tc, div.ish-recent_posts_post.$tc a, div.ish-recent_posts_post.$cc h3 a,
	.ish-sc-element.$pnc .flex-direction-nav li a,
	.ish-tgg-acc-title.$tc, .ish-tgg-acc-content.$tc,
	.ish-sc_tab.$tc, .ish-tabs-navigation li.$tc a,
	.ish-sc_sidebar.$tc .widget,
	.ish-sc_sidebar.$lc1 .widget-title,
	.ish-sc_sidebar.$lc1 .widget a,
	.ish-sc_sidebar.$lc2 .widget_calendar #wp-calendar tfoot a,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-recent-portfolio-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-dribbble-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-flickr-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-twitter-widget a.ish-button-small,

	.ish-sc_sidebar.$btc .widget select,
	.ish-sc_sidebar.$btc .widget option,
	.ish-sc_sidebar.$btc .widget_search input[type='text'],
	.ish-sc_sidebar.$btc .widget_search input[type='submit'],
	.ish-sc_sidebar.$btc .widget_tag_cloud a,
	.ish-sc_sidebar.$btc .widget_tag_cloud a:hover,

	.ish-sc_cf7.$bg_cc input,
	.ish-sc_cf7.$bg_cc textarea,
	.ish-sc_cf7.$bg_cc select,

	.ish-sc_cf7.$tc,

	.ish-sc_menu.$tc li a,
	.ish-sc_menu.$btc li a:hover,
	.ish-sc_menu.$btc li.current_page_item a,
	.wpb_text_column.$tc,
	.tooltipster-default.$tt_tc,

	.ish-sc_table.$tc,
	.ish-sc_table.$htc th,
	.ish-sc_table th.$tc,
	.ish-sc_table td.$tc,

	.ish-sc_pricing_table.$tc,

	.ish-sc_box.$tc

	{
		color: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-sc_button.$tc, a.ish-sc_button.$tc:hover,
	.ish-sc_portfolio_categories.$tc, .ish-sc_portfolio_categories.$tc a
	{
		color: " . $n_colors[$cc]['hex'] . " !important;
	}\n";

	echo "
	.ish-sc-element.ish-sc_icon.$tc:not([class*='ish-color']) a:hover,
	.ish-recent_posts_post.$cc h3 a:hover,
	.ish-blog .wpb_row.$cc h2 a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h2 a:hover,
	.ish-sc_sidebar.$lc1 .widget a:hover,

	.ish-sc_sidebar.$lc2 .widget_calendar #wp-calendar tfoot a:hover,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-dribbble-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-flickr-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-twitter-widget a.ish-button-small:hover
	{
		color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";

	echo "
	.ish-sc-element.$pnc .flex-direction-nav li a:hover
	{
		color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -50 ) . ";
	}\n";


	// color* ----------------------------------------------------------------------------------------------------------
	echo "

	.ish-tagline-image.$tc h2,
	.ish-tagline-colored.$tc h2
	{
		color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.8);
	}\n";


	$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
	foreach ( $prefixes as $prefix ) {
		echo '.ish-sc_cf7.'. $bg_cc . ' ' . $prefix . "{ color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }\n";
	}

	// color* ----------------------------------------------------------------------------------------------------------
	echo "

	.ish-tagline-image.$tc .ish-blog-post-details,
	.ish-tagline-image.$tc .ish-blog-post-details span,
	.ish-tagline-image.$tc .ish-blog-post-details a:hover,
	.ish-tagline-colored.$tc .ish-blog-post-details,
	.ish-tagline-colored.$tc .ish-blog-post-details span,
	.ish-tagline-colored.$tc .ish-blog-post-details a:hover,
	.$tc .ish-section-filter li a
	{
		color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . ");
	}\n";

	echo "
	.ish-sc_sidebar.$btc .widget_search input[type='text']:-moz-placeholder           { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	.ish-sc_sidebar.$btc .widget_search input[type='text']::-webkit-input-placeholder { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	.ish-sc_sidebar.$btc .widget_search input[type='text'].placeholder                { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	\n";


	// background-color* -----------------------------------------------------------------------------------------------
	echo "
	.wpb_row.$cc,
	.ish-row-overlay.$cc,
	.ish-sc_svg_icon.ish-square.$cc,
	.ish-sc_svg_icon.ish-circle.$cc,
	.ish-gmap_box.$cc,
	.ish-blog .wpb_row.$cc .ish-blog-post-links:after,
	.ish-blog-post-masonry.$cc,
	.ish-blog-post-masonry.$cc.ish-image-cover .ish-blog-post-media + div,
	.ish-blog-post-masonry.$tc.ish-image-cover .ish-blog-post-media + div:before,
	.ish-tagline-colored.$cc .ish-overlay,
	.ish-sc_icon.$cc.ish-square span span,
	.ish-sc_icon.$cc.ish-circle span span,
	.ish-sc_skills .ish-sc_skill.$sc .ish-bar-bg .ish-bar,
	.ish-sc_skills .ish-sc_skill.$cc .ish-bar-bg,
	.ish-sc-element.$nc .flex-control-nav li a,
	.ish-tgg-acc-title.$cc, .ish-tgg-acc-content.$cc,
	.ish-sc_tab.$cc, .ish-tabs-navigation li.$cc a,
	.ish-sc_separator.ish-separator-bold.$cc,
	.ish-sc_separator.ish-separator-thin-bold.$cc:before,

	.ish-sc_sidebar.$bbgc .widget select,
	.ish-sc_sidebar.$bbgc .widget option,
	.ish-sc_sidebar.$bbgc .widget_search input[type='text'],
	.ish-sc_sidebar.$bbgc .widget_tag_cloud a,

	.ish-sc_cf7.$cc input,
	.ish-sc_cf7.$cc textarea,
	.ish-sc_cf7.$cc select,
	.tooltipster-default.$tt_bg,

	.ish-sc_table.$cc td,
	.ish-sc_table.$cc th,
	.ish-sc_table.$hbg table th,
	.ish-sc_table table th.$cc,
	.ish-sc_table table td.$cc,

	.ish-sc_pricing_table.$cc table,

	.ish-sc_box.$cc

	{
		background-color: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-sc_icon.$cc.ish-square a:hover span span,
	.ish-sc_icon.$cc.ish-circle a:hover span span,
	.ish-sc_svg_icon.ish-square.$cc a:hover,
	.ish-sc_svg_icon.ish-circle.$cc a:hover,
	.ish-tgg-acc-title.$cc:hover, .ish-tgg-acc-title.$cc.ish-active,
	.ish-sc_sidebar.$bbgc .widget_search input[type='submit']:hover,
	.ish-blog-post-masonry.$cc:hover > div,
	.ish-blog-post-masonry.$cc.ish-image-cover:hover .ish-blog-post-media + div
	{
		background-color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";

	echo "
	.ish-sc-element.$nc .flex-control-nav li a:hover, .ish-sc-element.$nc .flex-control-nav li a.flex-active
	{
		background-color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -50 ) . ";
	}\n";

	echo "
	.ish-sc_table.ish-striped.$cc table tr:nth-child(even) td,
	.ish-sc_pricing_table.ish-striped.$cc tr:nth-child(even) td
	{
		background-color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -10 ) . ";
	}\n";

	echo "
	.ish-sc_table.ish-striped table tr:nth-child(even) td.$cc
	{
		background-color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -10 ) . " !important;
	}\n";

	echo "
	.ish-sc_button.$cc,
	.ish-tgg-acc-title.$cc,
	.ish-tabs-navigation li.$cc a,
	.ish-sc_cf7.$cc input[type=\"submit\"],
	.ish-sc_menu.$cc li a,
	.ish-sc_menu.$bbgc li a:hover,
	.ish-sc_menu.$bbgc li.current_page_item a
	{
		background-color: " . $n_colors[$cc]['hex'] . ";
		box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";


	echo "
	a.ish-sc_button.$cc:hover,
	.ish-tgg-acc-title.$cc:hover, .ish-tgg-acc-title.$cc.ish-active,
	.ish-tabs-navigation li.$cc a:hover, .ish-tabs-navigation li.$cc.ish-active a,
	.ish-sc_sidebar.$bbgc .widget_tag_cloud a:hover,
	.ish-sc_cf7.$cc input[type=\"submit\"]:hover,
	.ish-sc_menu.ish-no-active-bg.$cc li a:hover,
	.ish-sc_menu.ish-no-active-bg.$cc li.current_page_item a,
	.ish-sc_menu.$bbgc li.current_page_item a:hover
	{
		background-color: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
		box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -50 ) . ";
	}\n";


	// fill* -----------------------------------------------------------------------------------------------------------
	echo "
	.ish-sc_icon.ish-hexagon.$cc svg polygon,
	.ish-sc_icon.ish-hexagon_rounded.$cc svg path,
	.ish-sc_svg_icon.ish-hexagon.$cc svg polygon,
	.ish-sc_svg_icon.ish-hexagon_rounded.$cc svg path,
	.ish-row_section.$cc .ish-row-decor-top polyline.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom polyline.ish-color,
	.ish-row_section.$cc .ish-row-decor-top path.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom path.ish-color,
	.ish-row_section.$cc .ish-row-decor-top polygon.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom polygon.ish-color,
	.ish-row_section.$cc .ish-row-decor-top rect.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom rect.ish-color
	{
		fill: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-sc_icon.ish-hexagon.$cc a:hover svg polygon,
	.ish-sc_icon.ish-hexagon_rounded.$cc a:hover svg path,
	.ish-sc_svg_icon.ish-hexagon.$cc a:hover svg polygon,
	.ish-sc_svg_icon.ish-hexagon_rounded.$cc a:hover svg path
	{
		fill: " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";


	// background-color* -----------------------------------------------------------------------------------------------
	echo "
	.ish-p-overlay.$cc > span,
	.ish-blog-fullwidth .wpb_row.$cc > .ish-overlay,
	.ish-tagline-image.$cc .ish-overlay
	{
		background-color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.9);
	}\n";


	// border-color* ---------------------------------------------------------------------------------------------------
	echo "
	.ish-gmap_box.$cc:before,
	.ish-blog.ish-blog-masonry .$tc blockquote,
	.ish-sc_separator.ish-separator-thin.$cc,
	.ish-sc_separator.ish-separator-thin-bold.$cc,
	.$cc .recent_posts_post_content .post-quote-content,
	.ish-sc_table.$borderc th, .ish-sc_table.$borderc tr, .ish-sc_table.$borderc td,
	.ish-sc_pricing_table.$borderc th, .ish-sc_pricing_table.$borderc tr, .ish-sc_pricing_table.$borderc td
	{
		border-color: " . $n_colors[$cc]['hex'] . ";
	}\n";



	// box-shadow* -----------------------------------------------------------------------------------------------------
	echo "
	.ish-sc_sidebar.$bbgc .widget_tag_cloud a
	{
		box-shadow: 0 3px 0 " . ishyoboy_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}
	\n";


	// box-shadow* -----------------------------------------------------------------------------------------------------
	echo "
	.$tt_bg .tooltipster-arrow-top span,
	.$tt_bg .tooltipster-arrow-bottom span{
		border-top-color: " . $n_colors[$cc]['hex'] . " !important;
		border-bottom-color: " . $n_colors[$cc]['hex'] . " !important;
	}

	.$tt_bg .tooltipster-arrow-left span,
	.$tt_bg .tooltipster-arrow-right span{
		border-left-color: " . $n_colors[$cc]['hex'] . " !important;
		border-right-color: " . $n_colors[$cc]['hex'] . " !important;
	}
	\n";

}

?>