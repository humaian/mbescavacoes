<?php

$main_colors_1 = '#89c6e6';
$main_colors_2 = '#3e3e3e';
$main_colors_3 = '#e8e8e8 ';
$main_colors_4 = '#fefefe';
$main_text_color = $main_colors_2;
$main_body_color = $main_colors_4;
$main_background_color = '#e8e8e8'; // Depends on the BG pattern

$skin_data = array(
	// LAYOUT
	'boxed_layout' => 'boxed',

	// COLORS
	'color1' => $main_colors_1,
	'color2' => $main_colors_2,
	'color3' => $main_colors_3,
	'color4' => $main_colors_4,
	'text_color' => $main_colors_2,
	'body_color' => $main_colors_4,
	'background_color' => $main_background_color,

	'header_bar_colors' => array(
		'bg' => $main_colors_2,
		'text' => $main_colors_4,
		'bg_active' => $main_colors_1,
		'text_active' => $main_colors_4
	),

	'header_colors' => array(
		'bg' => '#f6f6f6',
		'text' => $main_text_color,
		'bg_active' => $main_colors_1,
		'text_active' => $main_body_color
	),

	'header_colors_bg_opacity' => '30',

	'main_nav_colors' => array(
		'bg' => $main_body_color,
		'text' => $main_text_color,
		'bg_active' => $main_colors_1,
		'text_active' => $main_colors_4,
		'border' => $main_colors_3
	),

	'main_nav_submenu_colors' => array(
		'bg' => '#f6f6f6',
		'text' => $main_colors_2,
		'bg_active' => $main_colors_1,
		'text_active' => $main_colors_4
	),


	// PATTERNS
	'use_expandable_pattern' => '1',
	'expandable_bg_pattern' => '',

	'use_header_pattern' => '1',
	'header_bg_pattern' => 'solid-light-cream-pixels.png',

	'use_lead_pattern' => '1',
	'lead_bg_pattern' => '',

	'use_content_pattern' => '1',
	'content_bg_pattern' => '',

	'use_footer_pattern' => '1',
	'footer_bg_pattern' => '',

	'use_background_pattern' => '0',
    'background_bg_image' => IYB_HTML_URI . '/images/bg-images/background-1.jpg',
    'background_bg_image_cover' => '1',


	// FONTS
	'body_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Arimo',
		'google_variant' => 'regular',
		'size' => '13',
		'line_height' => '20'
	),
	'header_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => '300',
		'size' => '13',
	),
	'h1_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => '300',
		'size' => '45',
		'line_height' => '56'
	),
	'h2_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => '300',
		'size' => '28',
		'line_height' => '40'
	),
	'h3_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => 'regular',
		'size' => '18',
		'line_height' => '28'
	),
	'h4_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => 'regular',
		'size' => '14',
		'line_height' => '24'
	),
	'h5_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => 'regular',
		'size' => '13',
		'line_height' => '18'
	),
	'h6_font' => array(
		'use_google_font' => '1', // 1 = 'google', 0 = 'regular'
		'google' => 'Roboto',
		'google_variant' => 'regular',
		'size' => '11',
		'line_height' => '18'
	)
);