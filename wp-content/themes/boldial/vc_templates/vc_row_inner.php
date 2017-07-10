<?php

global $ish_rows_count, $ish_rows_replace, $ish_options;

$output = $output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';

$sc_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = shortcode_atts( $sc_atts, $atts);

// Default SC attributes
$defaults = array(
	'vertical_align'  => '',
);

// Merge defaults with the global attributes
$defaults = ishyoboy_extract_sc_attributes($defaults, $atts);

// Extract all attributes
extract( $defaults );

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$el_data_attributes = '';

$output = '';


if ( ! empty( $style ) ){
	$style = ' style="' . $style . '"';
}

$ish_css_classes = ( '' != $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : '' ;
$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_color ) ? ( ' ish-tooltip-' . esc_attr( $tooltip_color ) ) : '';
$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_text_color ) ? ' ish-tooltip-text-' . esc_attr( $tooltip_text_color ) : '';
$ish_css_classes .= ( '' != $vertical_align ) ? ' ish-valign-' . $vertical_align : '';
$ish_css_classes .= ( false !== strpos( $content, '[ish_portfolio') ) ? ' ish-has-portfolio' : '';

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row vc_row-fluid ' . $el_class . $ish_css_classes , $this->settings['base']);
$output .= '<div class="'.$css_class.'"' . $style;
$output .= ( '' != $tooltip ) ? ' data-type="tooltip" title="' . esc_attr( $tooltip ) . '"' : '';

// ID
$output .= ( '' != $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

$output .= '>';
$output .= wpb_js_remove_wpautop( do_shortcode($content) );
$output .= '</div>'.$this->endBlockComment('row');

echo $output;