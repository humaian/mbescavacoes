<?php

// Default SC attributes
$defaults = array(
	'images' => '',
	'gallery_type' => '',
	'thumbnail_size' => '',
	'ratio' => '',
	'open_popup' => '',
	'use_captions' => '',
	'columns' => '',
	'autoslide' => '',
	'animation' => '',
	'interval' => '',
	'navigation' => '',
	'prevnext' => '',
	'nav_color' => '',
	'prevnext_color' => '',
	'nav_align' => '',
	'max_height' => '',
	'border_width' => '',
);

global $ish_sc_gallery_count;
$ish_sc_gallery_count++;

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );


// GET IMAGES SIZE
global $_wp_additional_image_sizes;
$thumbnail = '';
$img_size = '';
if ( (!empty( $_wp_additional_image_sizes[ $sc_atts['thumbnail_size'] ]) && is_array($_wp_additional_image_sizes[ $sc_atts['thumbnail_size'] ])) || in_array($sc_atts['thumbnail_size'], array('thumbnail', 'thumb', 'medium', 'large', 'full') ) ) {
	$img_size = $sc_atts['thumbnail_size'];
} else {
	$img_size = 'medium';
}

$popup_size = apply_filters( 'ish_gallery_sc_popup_image_size', 'theme-large', get_the_ID() );

// GET ALL IMAGES
$images = explode( ',', $sc_atts['images'] );
$id = get_the_ID();

// Necessary if no images added.
$return = '';

if ( $images ) {

	if ( 'slideshow' == $sc_atts['gallery_type'] ){

		wp_enqueue_script( 'ish-owl-slider' );

		$return .= '[ish_slidable';


		$class = 'ish-gallery_slideshow';
		$class .= ( '' != $sc_atts['ratio'] ) ? ' ish-ratio-' . esc_attr( $sc_atts['ratio'] ) : ' ish-ratio-none' ;
		$class .= ( 'no' != $sc_atts['open_popup'] ) ? ' ish-open-popup' : '' ;
		$class .= ( '' != $sc_atts['css_class']) ? ' ' . esc_attr($sc_atts['css_class']) .'"' : '' ;

		$return .= ('' != $sc_atts['id']) ? ' id="' . esc_attr($sc_atts['id']) . '"' : '';
		$return .= ' global_atts="yes"';
		$return .= ( '' != $class ) ? ' css_class="' . $class .'"' : '' ;
		$return .= ('' != $sc_atts['style']) ? ' style="' . esc_attr($sc_atts['style']). '"' : '' ;
		$return .= ('' != $sc_atts['tooltip']) ? ' tooltip="' . esc_attr($sc_atts['tooltip']) . '"' : ''  ;
		$return .= ('' != $sc_atts['tooltip_color']) ? ' tooltip_color="' . esc_attr($sc_atts['tooltip_color']) . '"' : '';
		$return .= ('' != $sc_atts['tooltip_text_color']) ? ' tooltip_text_color="' . esc_attr($sc_atts['tooltip_text_color']) . '"' : '';
		$return .= ('' != $sc_atts['autoslide']) ? ' autoslide="' . esc_attr($sc_atts['autoslide']) .'"' : '' ;
		$return .= ('' != $sc_atts['animation']) ? ' animation="' . esc_attr($sc_atts['animation']) .'"' : '' ;
		$return .= ('' != $sc_atts['interval']) ? ' interval="' . esc_attr($sc_atts['interval']) .'"' : '' ;
		$return .= ('' != $sc_atts['navigation']) ? ' navigation="' . esc_attr($sc_atts['navigation']) .'"' : '' ;
		$return .= ('' != $sc_atts['prevnext']) ? ' prevnext="' . esc_attr($sc_atts['prevnext']) .'"' : '' ;
		$return .= ('' != $sc_atts['nav_align']) ? ' nav_align="' . esc_attr($sc_atts['nav_align']) .'"' : '' ;
		$return .= ('' != $sc_atts['nav_color']) ? ' nav_color="' . esc_attr($sc_atts['nav_color']) .'"' : '' ;
		$return .= ('' != $sc_atts['prevnext_color']) ? ' prevnext_color="' . esc_attr($sc_atts['prevnext_color']) .'"' : '' ;
		$return .= ('' != $sc_atts['max_height']) ? ' max_height="' . esc_attr($sc_atts['max_height']) .'"' : '' ;
		$return .= ('' != $sc_atts['columns']) ? ' items_count="' . esc_attr($sc_atts['columns']) .'"' : '' ;
		$return .= ']';

		foreach ( $images as $attachment_id ) {
			$return .= '[ish_slide class="ish-gallery-slide"]';


			$img_src = wp_get_attachment_image_src($attachment_id, $img_size);
			$border_width = ('' != $sc_atts['border_width']) ? ' border-width: ' . esc_attr($sc_atts['border_width']) .'px;' :  ' border-width: 0px;';

			$return .= '<div class="ish-gallery-slide-image" style="background-image: url(\'' . $img_src[0] . '\');' . $border_width . '">';

			if ( 'no' != $sc_atts['open_popup'] ) {

				// IMAGE CAPTION
				$img_caption = '';
				if ( 'no' != $sc_atts['use_captions'] ) {
					$img_obj = get_post($attachment_id);
					if (is_object($img_obj)) {
						$img_caption = $img_obj->post_excerpt;
					}
				}

				$img_src = wp_get_attachment_image_src($attachment_id, $popup_size);
				$return .= '<a href="' . $img_src[0] . '" title="' . esc_attr( $img_caption ) . '" rel="ish-gallery-' . $ish_sc_gallery_count . '" class="openfancybox-image">';
			}

			$return .= wp_get_attachment_image( $attachment_id, $img_size );

			if ( 'no' != $sc_atts['open_popup'] ) {
				$return .= '</a>';
			}

			$return .= '</div>';

			$return .= '[/ish_slide]';
		}

		$return .= '[/ish_slidable]';

	}
	else{
		// SHORTCODE BEGIN
		$return = '';
		$return .= '<div class="';

		// CLASSES
		$class = 'ish-sc_gallery';
		$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
		$class .= ( '' != $sc_atts['ratio'] ) ? ' ish-ratio-' . esc_attr( $sc_atts['ratio'] ) : ' ish-ratio-none' ;
		$class .= ( 'no' != $sc_atts['open_popup'] ) ? ' ish-open-popup' : '' ;
		$class .= ( 'masonry' == $sc_atts['gallery_type'] ) ? ' ish-g-' . esc_attr( $sc_atts['gallery_type'] ) : '' ;
		$class .= ( '' != $sc_atts['nav_color'] ) ? ' ish-nav-' . esc_attr( $sc_atts['nav_color'] ) : '' ;
		$class .= ( '' != $sc_atts['prevnext_color'] ) ? ' ish-prevnext-' . esc_attr( $sc_atts['prevnext_color'] ) : '' ;
		$class .= ( '' != $sc_atts['nav_align'] ) ? (' ish-nav-' . $sc_atts['nav_align'] ) : '' ;
		$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
		$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
		$return .= apply_filters( 'ish_sc_classes', $class, $tag );
		$return .= '"' ;

		// ID
		$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

		// STYLE
		if ( '' != $sc_atts['style'] ){
			$return .= ' style="';

			$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';

			$return .= '"';

		}

		// TOOLTIP
		$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

		$return .= '>';

		// SETUP GRID
		$grid = 'ish-grid3';

		if ( is_numeric( $sc_atts['columns'] ) ){
			$grid = 'ish-grid' . ( $sc_atts['columns'] );
		}

		// CONTENT
		$return .= '<div class="ish-row">';
		$count = 0;

		foreach ( $images as $attachment_id ) {

			$count++;

			$img_src = wp_get_attachment_image_src($attachment_id, $img_size);
			$border_width = ('' != $sc_atts['border_width']) ? ' border-width: ' . esc_attr($sc_atts['border_width']) .'px;' : ' border-width: 0px;';
			$return .= '<div class="ish-gallery-image ' . $grid . '" style="background-image: url(\'' . $img_src[0] . '\'); ' . $border_width . '">';

			if ( 'no' != $sc_atts['open_popup'] ) {

				// IMAGE CAPTION
				$img_caption = '';
				if ( 'no' != $sc_atts['use_captions'] ) {
					$img_obj = get_post($attachment_id);
					if (is_object($img_obj)) {
						$img_caption = $img_obj->post_excerpt;
					}
				}

				$img_src = wp_get_attachment_image_src($attachment_id, $popup_size);
				$return .= '<a href="' . $img_src[0] . '" title="' . esc_attr( $img_caption ) . '" rel="ish-gallery-' . $ish_sc_gallery_count . '" class="openfancybox-image">';
			}

			$return .= wp_get_attachment_image( $attachment_id, $img_size );

			if ( 'no' != $sc_atts['open_popup'] ) {
				$return .= '</a>';
			}

			$return .= '</div>';

			/*if (($count % $sc_atts['columns'] == 0) && ($count != count($images)) ) {
				$return .= '</div><div class="ish-row">';
			}*/
		}

		$return .= '</div>'; // Close last .ish-row


		// SHORTCODE END
		$return .= '</div>';
	}
}

echo do_shortcode( $return );