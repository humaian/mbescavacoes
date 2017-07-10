<?php

/*******************************************************************************************************************
 * Add custom meta boxes
 */

add_ishyo_meta_box('iyb_meta_post_link', array(
	'title'     => __('Link settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_link'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __('URL', 'ishyoboy'),
			'id' => 'post_url',
			'desc' => __('Add an URL link.', 'ishyoboy'),
			'type' => 'text'
		),
		array(
			'name' => __('Link Text', 'ishyoboy'),
			'id' => 'post_url_text',
			'desc' => __('Add text for the URL link.', 'ishyoboy'),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_quote', array(
	'title'     => __('Quote settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_quote'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __('Quote', 'ishyoboy'),
			'id' => 'post_quote',
			'desc' => __('Add a quote', 'ishyoboy'),
			'type' => 'textarea'
		),
		array(
			'name' => __('Quote Source', 'ishyoboy'),
			'id' => 'post_quote_source',
			'desc' => __('Add the quote source', 'ishyoboy'),
			'type' => 'text'
		),
		array(
			'name' => __('URL', 'ishyoboy'),
			'id' => 'post_quote_url',
			'desc' => __('Add the quote source URL', 'ishyoboy'),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_audio', array(
	'title'     => __('Audio settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_audio'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __('Adio file URL', 'ishyoboy'),
			'id' => 'post_audio',
			'default' => '',
			'desc' => __('Please enter the URL of the audio file.', 'ishyoboy'),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_video', array(
	'title'     => __('Video settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_video'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __('Embedded or Selfhosted video', 'ishyoboy'),
			'id' => 'post_embedded_video',
			'default' => 'true',
			'desc' => __('Use embedded video.', 'ishyoboy'),
			'type' => 'checkbox',
		),
		array(
			'name' => __('URL or Embedded Code', 'ishyoboy'),
			'id' => 'post_video',
			'desc' => __('Enter the URL or embed code of Vimeo.com or YouTube.com streaming services.<br>To get the code, go to the external video page, click "share" button and copy the Embed code.', 'ishyoboy'),
			'type' => 'textarea'
		),
		array(
			'name' => __('MP4 file URL', 'ishyoboy'),
			'id' => 'post_video_mp4',
			'default' => '',
			'desc' => __('Please enter the URL of the .mp4 video file.', 'ishyoboy'),
			'type' => 'text'
		),
		array(
			'name' => __('WebM file URL', 'ishyoboy'),
			'id' => 'post_video_webm',
			'default' => '',
			'desc' => __('Please enter the URL of the .webm video file.', 'ishyoboy'),
			'type' => 'text'
		),
		array(
			'name' => __('Poster image', 'ishyoboy'),
			'id' => 'post_video_poster',
			'default' => '',
			'desc' => __('Please enter the URL of the poster image file.', 'ishyoboy'),
			'type' => 'text',
			'std' => ''
		),
	)
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('taglines_settings', array(
	'title'     => __( 'Custom Taglines', 'ishyoboy' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'taglines_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __( 'Show Custom Taglines', 'ishyoboy' ),
			'id' => 'use_taglines',
			'default' => 'false',
			'desc' => __( 'If checked, custom taglines will be used instead of the page headline.', 'ishyoboy' ),
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Main Tagline', 'ishyoboy' ),
			'id' => 'tagline_1',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'text',
		),
		array(
			'name' => __( 'Sub Tagline', 'ishyoboy' ),
			'id' => 'tagline_2',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'text',
		),
		array(
			'name' => __( 'Use Image as background', 'ishyoboy' ),
			'id' => 'use_bg_image',
			'default' => 'false',
			'desc' => __( 'Use the featured image as a background for the Taglines area.', 'ishyoboy' ),
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Use Custom Colors', 'ishyoboy' ),
			'id' => 'use_colors',
			'default' => 'false',
			'desc' => __( 'Use the colors from "Color Settings" box in the Taglines area.', 'ishyoboy' ),
			'type' => 'checkbox',
		),
	)
));

$pages_arr = array('post');
add_ishyo_meta_box('ishyoboy_color_settings', array(
	'title'     => __('Color Settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'ishyoboy_color_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __( 'Background color', 'ishyoboy' ),
			'id' => 'color',
			'default' => '',
			'desc' => __( 'Used in Taglines, Full-width and Grid Blog overview pages.', 'ishyoboy'),
			'type' => 'color_selector',
		),
		array(
			'name' => __( 'Text color', 'ishyoboy' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => __( 'Used in Taglines, Full-width and Masonry Blog overview pages.', 'ishyoboy'),
			'type' => 'color_selector',
		),
		array(
			'name' => __('Masonry size', 'ishyoboy'),
			'id' => 'masonry_size',
			'default' => '',
			'desc' => __( 'Used for Masonry Grid Blog overview pages.', 'ishyoboy'),
			'type' => 'radio_random',
			'options' => array(
				'1_1' => __( '1 x 1', 'ishyoboy' ),
				'1_2' => __( '1 x 2', 'ishyoboy' ),
				'2_1' => __( '2 x 1', 'ishyoboy' ),
				'2_2' => __( '2 x 2', 'ishyoboy' ),
			)
		),
	)
));

$pages_arr = array('page');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('ishyoboy_color_settings', array(
	'title'     => __('Color Settings', 'ishyoboy'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'ishyoboy_color_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => __( 'Background color', 'ishyoboy' ),
			'id' => 'color',
			'default' => '',
			'desc' => __( 'Used in Taglines area.', 'ishyoboy'),
			'type' => 'color_selector',
		),
		array(
			'name' => __( 'Text color', 'ishyoboy' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => __( 'Used in Taglines area.', 'ishyoboy'),
			'type' => 'color_selector',
		)
	)
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('page_settings', array(
	'title'     => __( 'Page Settings', 'ishyoboy' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'page_settings'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Show breadcrumbs:', 'ishyoboy'),
			'id' => 'show_breadcrumbs',
			'default' => '',
			'desc' => __('To show/hide the breadcrumbs on all pages go to ', 'ishyoboy' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
			'type' => 'select',
			'options' => array(
				''		            => __( 'Default setting', 'ishyoboy' ),
				'none'              => __( 'None', 'ishyoboy'),
				'breadcrumbs'       => __( 'Breadcrumbs only', 'ishyoboy'),
				'icons'             => __( 'Social Icons only', 'ishyoboy'),
				'breadcrumbs-icons' => __( 'Breadcrumbs & Social Icons', 'ishyoboy'),
			)
		),
		array(
			'name' => __('Page Boxed / Unboxed layout:', 'ishyoboy'),
			'id' => 'boxed_layout',
			'default' => '',
			'desc' => __('To change the layout of the whole website go to ', 'ishyoboy' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
			'type' => 'select',
			'options' => array(
				''		    => __( 'Default setting', 'ishyoboy' ),
				'boxed'		=> __( 'Boxed', 'ishyoboy' ),
				'unboxed'	=> __( 'Unboxed', 'ishyoboy' ),
			)
		)
	)
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

/* // MOVED TO CPT
add_ishyo_meta_box('slides_urls', array(
	'title'     => __('Slide Settings', 'ishyoboy'),
	'pages'		=> array('slides'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Slide type', 'ishyoboy'),
			'id' => 'slide_type',
			'default' => 'content',
			'desc' => '',//__('Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'ishyoboy'),
			'type' => 'radio',
			'options' => array(
				'content' => __('Content', 'ishyoboy'),
				'image' => __('Image', 'ishyoboy'),
			)
		),
		array(
			'name' => __('Slide url link', 'ishyoboy'),
			'id' => 'slide_url',
			'default' => '',
			'desc' => __('Enter the url which the slide will link to. E.g. http://www.ishyoboy.com', 'ishyoboy'),
			'type' => 'text',
		),
		array(
			'name' => __('New window', 'ishyoboy'),
			'id' => 'slide_url_nw',
			'default' => 'true',
			'desc' => __('Open link in a new window.', 'ishyoboy'),
			'type' => 'checkbox'
		)
	)
));
*/

$pages_arr = array('page');

// Page Main Navigation options
add_ishyo_meta_box('mainnav', array(
	'title'     => __( 'Main Navigation', 'ishyoboy' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'mainnav'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Navigation Position', 'ishyoboy'),
			'id' => 'mainnav_pos',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'select',
			'options' => array(
				''		    => __( 'Default setting', 'ishyoboy' ),
				'center'	=> __( 'Center', 'ishyoboy' ),
				'left'		=> __( 'Left', 'ishyoboy' ),
				'right'		=> __( 'Right', 'ishyoboy' ),
			),
		),
		array(
			'name' => __('Navigation Menu', 'ishyoboy'),
			'desc' => '',
			'id' => 'mainnav_menu',
			'default' => '',
			'type' => 'menu_select'
		)
	)
));


$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Page, Blog & Portfolio Sidebars
add_ishyo_meta_box('blog_sidebars', array(
	'title'     => __( 'Sidebar', 'ishyoboy' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'blog_sidebars'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Sidebar position', 'ishyoboy'),
			'id' => 'sb_pos',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'select',
			'options' => array(
				''		    => __( 'Default setting', 'ishyoboy' ),
				'none'		=> __( 'No Sidebar', 'ishyoboy' ),
				'left'		=> __( 'Left', 'ishyoboy' ),
				'right'		=> __( 'Right', 'ishyoboy' ),
			),
		),
		array(
			'name' => __('Sidebar', 'ishyoboy'),
			'desc' => '', //__('<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy'),
			'id' => 'sidebar',
			'default' => '',
			'type' => 'sidebar_select'
		)
	)
));


/*
$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Expandable header
add_ishyo_meta_box('expandable_header', array(
	'title'     => 'Expandable header',
	'pages'		=> $pages_arr,
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Make header expandable:', 'ishyoboy'),
			'id' => 'use_header_sidebar',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'select',
			'options' => array(
				''		=> 'Default setting',
				'0'		=> 'Disable',
				'1'		=> 'Enable'
			)
		),
		array(
			'name' => __('Use expandable sidebar:', 'ishyoboy'),
			'id' => 'header_sidebar',
			'default' => '',
			'type' => 'sidebar_select'
		),
		array(
			'name' => __('Defaulf expandable state:', 'ishyoboy'),
			'id' => 'header_sidebar_on',
			'default' => '0',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'select',
			'options' => array(
				'0'		=> 'Closed',
				'1'		=> 'Opened'
			)
		)
	)
));
/**/


$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Footer widget area
add_ishyo_meta_box('footer_widgets', array(
	'title'     => __( 'Footer Widget Area', 'ishyoboy' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'footer_widgets'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Footer widget area:', 'ishyoboy'),
			'id' => 'use_fw_area',
			'default' => '',
			'desc' => '', //__('', 'ishyoboy'),
			'type' => 'select',
			'options' => array(
				''		=> __( 'Default setting', 'ishyoboy' ),
				'0'		=> __( 'Disable', 'ishyoboy' ),
				'1'		=> __( 'Enable', 'ishyoboy' ),
			)
		),
		array(
			'name' => __('Use footer sidebar:', 'ishyoboy'),
			'id' => 'footer_sidebar',
			'default' => 'sidebar-footer',
			'type' => 'sidebar_select'
		),
	)
));

/* // MOVED TO CPT
add_ishyo_meta_box('portfolio_images_box', array(
	'title'     => __('Portfolio Gallery', 'ishyoboy'),
	'pages'		=> array('portfolio-post'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => '', //__('Upload images', 'ishyoboy'),
			'id' => 'porfolio_images',
			'default' => '',
			'desc' => '',
			'type' => 'images2',
		)
	)
));*/