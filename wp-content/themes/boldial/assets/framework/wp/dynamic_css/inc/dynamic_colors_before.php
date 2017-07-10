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


/* Body text -------------------------------------------------------------------------------------------------------- */
body,
.ish-blog-post-details a, .ish-blog-post-links a,
.ish-section-filter li a:hover,
.ish-section-filter li.current-cat a,
.ish-section-filter li.current-cat a:hover,
.ish-section-filter .ish-p-filter li a:hover,
.ish-section-filter .ish-p-filter li a.ish-active,
.ish-part_content .ish-sc-element a, .ish-part_content .wpb_text_column a, .ish-comments-form a,
.about_paypal
{
	color: <?php echo $c_text ?>;
}

.ish-section-filter li a,
.ish-section-filter .ish-p-filter li a
{
	color: rgba(<?php echo ishyoboy_hex2rgb($c_text) . ", " . $dyn_col_opacity ?>);
}


/* Body background -------------------------------------------------------------------------------------------------- */
body
{
	background-color: <?php echo $c_background ?>;
	/*color: */<?php /*echo $c_text */?>;
}


/* Body background color -------------------------------------------------------------------------------------------- */
[class^="ish-part_"] > .ish-row, [class*=" ish-part_"] > .ish-row,
[class^="ish-part_"] > .wpb_row, [class*=" ish-part_"] > .wpb_row,
.ish-blog-classic > .wpb_row[class*="ish-color"]
{
	background-color: <?php echo $c_body ?>;
}

.ish-row_section .ish-row-decor-top polyline.ish-color,
.ish-row_section .ish-row-decor-bottom polyline.ish-color,
.ish-row_section .ish-row-decor-top path.ish-color,
.ish-row_section .ish-row-decor-bottom path.ish-color,
.ish-row_section .ish-row-decor-top polygon.ish-color,
.ish-row_section .ish-row-decor-bottom polygon.ish-color,
.ish-row_section .ish-row-decor-top rect.ish-color,
.ish-row_section .ish-row-decor-bottom rect.ish-color
{
	fill: <?php echo $c_body ?>;
}
