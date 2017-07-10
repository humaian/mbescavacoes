<?php
$output = $el_class = $width = '';

$sc_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
if (! isset($sc_atts['width']) ){ $sc_atts['width'] = '1/1'; }
$atts = shortcode_atts( $sc_atts, $atts);

// Default SC attributes
$defaults = array(
	'el_class' => '',
	'align' => '',
	'width' => '1/1',
);

// Merge defaults with the global attributes
$defaults = ishyoboy_extract_sc_attributes( $defaults, $atts);

// Extract all attributes
extract( $defaults );

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$align_class = ( '' != $align ) ? ' ish-' . $align : '';

$el_class .= ' wpb_column column_container' . $align_class;
$el_class .= ( '' != $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : '' ;
$el_class .= ( '' != $tooltip && '' != $tooltip_color ) ? ( ' ish-tooltip-' . esc_attr( $tooltip_color ) ) : '';
$el_class .= ( '' != $tooltip && '' != $tooltip_text_color ) ? ' ish-tooltip-text-' . esc_attr( $tooltip_text_color ) : '';

$style = ' style="' . $style . '"';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="' . $css_class . '"' . $style ;
$output .= ( '' != $tooltip ) ? ' data-type="tooltip" title="' . esc_attr( $tooltip ) . '"' : '';
// ID
$output .= ( '' != $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
$output .= '>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;