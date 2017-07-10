<?php
$output = $el_class = $css_animation = '';

$sc_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = shortcode_atts( $sc_atts, $atts);

// Default SC attributes
$defaults = array(
	'color' => '',
	'align' => '',
);

// Merge defaults with the global attributes
$defaults = ishyoboy_extract_sc_attributes( $defaults, $atts);

// Extract all attributes
extract( $defaults );

$el_class = $this->getExtraClass($el_class);
$text_color =  ( '' != $color) ? ( ' ish-text-' . $color ) : '';
$el_class .= $text_color;

$el_class .= ( '' != $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : '' ;
$el_class .= ( '' != $align ) ? (' ish-' . $align ) : '' ;
$el_class .= ( '' != $tooltip && '' != $tooltip_color ) ? ( ' ish-tooltip-' . esc_attr( $tooltip_color ) ) : '';
$el_class .= ( '' != $tooltip && '' != $tooltip_text_color ) ? ' ish-tooltip-text-' . esc_attr( $tooltip_text_color ) : '';

$style = ' style="' . $style . '"';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_text_column wpb_content_element '.$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);

$output .= "\n\t".'<div class="' . $css_class . '"' . $style;
$output .= ( '' != $tooltip ) ? ' data-type="tooltip" title="' . esc_attr( $tooltip ) . '"' : '';
// ID
$output .= ( '' != $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
$output .= '>';

$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;