<?php

vc_map( array(
	'name' => __( 'Image Gallery', 'ishyoboy_assets' ),
	'base' => 'ish_gallery',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	//'description' => __( '', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-picture-1',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'attach_images',
				'heading' => __( 'Gallery Images', 'ishyoboy_assets' ),
				'param_name' => 'images',
				'value' => '',
				'description' => __( 'Choose images from the media library.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Gallery Type', 'ishyoboy_assets' ),
				'param_name' => 'gallery_type',
				'value' => array(
					__( 'Regular', 'ishyoboy_assets' ) => '',
					__( 'Masonry', 'ishyoboy_assets' ) => 'masonry',
					__( 'Slideshow', 'ishyoboy_assets' ) => 'slideshow',

				),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image size', 'ishyoboy_assets' ),
				'param_name' => 'thumbnail_size',
				//'admin_label' => true,
				'std' => 'theme-large',
				'value' => $ish_image_sizes,
				//'description' => __( '', 'ishyoboy_assets' ),
			),

			// GALLERY TYPE - ALL
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Pop-up Window', 'ishyoboy_assets' ),
				'param_name' => 'open_popup',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Make images clickable and open large image versions in pop-up window.', 'ishyoboy_assets' ),
			),

			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Image Captions', 'ishyoboy_assets' ),
				'param_name' => 'use_captions',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Display image captions in the pop-up window.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'open_popup', 'value' => Array('') ),
			),

			// GALLERY TYPE - REGULAR & MASONRY
			array(
				'type' => 'dropdown',
				'heading' => __( 'Columns Count', 'ishyoboy_assets' ),
				'param_name' => 'columns',
				'admin_label' => true,
				'std' => 4,
				'value' => Array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5,
					'6' => 6,
					'7' => 7,
					'8' => 8,
					'9' => 9,
					'10' => 10,
					'11' => 11,
					'12' => 12,
				),
				'description' => __( 'Number of columns to display the images in.', 'ishyoboy_assets' ),
				//'dependency' => Array( 'element' => 'gallery_type', 'value' => Array( '', 'masonry') ),
			),

			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Images Aspect Ratio', 'ishyoboy_assets' ),
				'param_name' => 'ratio',
				'value' => array(
					__( 'Original Image Size', 'ishyoboy_assets' ) => '',
					__( 'Rectangle 16:9', 'ishyoboy_assets' ) => 'rectangle16',
					__( 'Rectangle 4:3', 'ishyoboy_assets' ) => 'rectangle4',
					__( 'Square 1:1', 'ishyoboy_assets' ) => 'square',
				),
				'description' => __( 'Choose the transition between slides', 'ishyoboy_assets' ),
				//'dependency' => Array( 'element' => 'gallery_type', 'value' => Array( '', 'masonry') ),
			),

			// GALLERY TYPE - SLIDESHOW
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Animation', 'ishyoboy_assets' ),
				'param_name' => 'animation',
				'value' => array(
					__( 'Slide', 'ishyoboy_assets' ) => 'slide',
					__( 'Fade', 'ishyoboy_assets' ) => 'fade',
				),
				'description' => __( 'Choose the transition between slides', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Navigation', 'ishyoboy_assets' ),
				'param_name' => 'navigation',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Display buttons to switch between slides', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Navigation Alignment', 'ishyoboy_assets' ),
				'param_name' => 'nav_align',
				'value' => array(
					__( 'Align Left', 'ishyoboy_assets' ) => 'left',
					__( 'Align Center', 'ishyoboy_assets' ) => 'center',
					__( 'Align Right', 'ishyoboy_assets' ) => 'right',
				),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Color', 'ishyoboy_assets' ),
				'param_name' => 'nav_color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Prev/Next buttons', 'ishyoboy_assets' ),
				'param_name' => 'prevnext',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Display previous and next slide buttons', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Prev/Next Color', 'ishyoboy_assets' ),
				'param_name' => 'prevnext_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Autoslide', 'ishyoboy_assets' ),
				'param_name' => 'autoslide',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Automatically switch the slides every few seconds.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Interval', 'ishyoboy_assets' ),
				'param_name' => 'interval',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Time interval in seconds before switching the slide. If empty, the default is "4" seconds.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Maximum Height', 'ishyoboy_assets' ),
				'param_name' => 'max_height',
				'value' => '',
				'description' => __( 'The max. height a slider can have.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'gallery_type', 'value' => 'slideshow' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Border Width', 'ishyoboy_assets' ),
				'param_name' => 'border_width',
				'value' => '5',
				'description' => __( 'Width in pixels to add a transparent border to each gallery item. Set "0" to remove it completely.', 'ishyoboy_assets' )
			),
		),
		$ish_global_params
	)
) );