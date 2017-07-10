<?php

/**
 * Filter which handles the classes for "part_content"
 *
 * Checks if sidebar is used on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ishyoboy_has_sidebar()
 *
 * @param string $classes
 *
 * @return string - The modified classes
 */
if ( ! function_exists( 'ish_part_content_classes' ) ) {
	function ish_part_content_classes( $classes, $id = null ){
		global $id_404;

		if ( is_404() ){
			$id = $id_404;
		}

		if ( ishyoboy_has_sidebar( $id ) ){
			$classes .= ' ish-with-sidebar';
		} else {
			$classes .= ' ish-without-sidebar';
		}

		return $classes;
	}
}

$ish_content_opened = false;

if ( ! function_exists( 'ishyoboy_the_content_line_open' ) ) {
	function ishyoboy_the_content_line_open( $content ){

		// Wrap the non-visual-composer content into a row
		if ( ( ( is_singular() || is_home() ) && is_main_query() ) ) {

			if ( false === strpos( $content, 'wpb_row' ) ){
				// if [vc_row] shortcode has not been used
				$content = '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">' . $content . '</div></div>';
			}
		}

		// Prepare opening and closing tags for content entered by external plugins which will be closed later
		return '</div></div>' . $content . '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-maybe-empty"><div class="ish-vc_row_inner">';
	}
}

if ( ! function_exists( 'ishyoboy_the_content_line_close' ) ) {
	function ishyoboy_the_content_line_close( $content ){
		$detect_before = '</div></div>';
		$detect_after = '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-maybe-empty"><div class="ish-vc_row_inner">';
		$insert_before = str_replace( 'ish-maybe-empty', 'ish-maybe-empty ish-decor-padding-0 ', $detect_after );

		$length_before = strlen( $detect_before );
		$length_after = strlen( $detect_after );

		$content_start =  substr( $content, 0, strlen( $detect_before ) );
		$content_end =  substr( $content, -1 * ( strlen( $detect_after ) ) );

		if ( $detect_before == $content_start ) {
			$content = substr( $content, $length_before, strlen( $content ) );
		} else{
			$content = $insert_before . $content;
		}

		if ( $detect_after == $content_end ) {
			$content = substr( $content, 0, strlen( $content ) - $length_after );
		} else{
			$content = $content . $detect_before;
		}

		// Close the wrappers which were opened in the "ishyoboy_the_content_line_open" function
		return $content;
	}
}

if ( ! function_exists( 'ishyoboy_the_content_test' ) ) {
	function ishyoboy_the_content_test( $content ){

		$content =  '<div>ishyoboy_the_content_test</div>' . $content;
		$content =  $content . '<div>ishyoboy_the_content_test</div>';

		return $content;
	}
}

if ( ! function_exists( 'ishyoboy_the_content_remove_decor_padding_classes' ) ) {
	function ishyoboy_the_content_remove_decor_padding_classes( $content ){

		global $ish_rows_replace;
		$content = str_replace( $ish_rows_replace , '', $content );

		return $content;
	}
}

if ( ! function_exists( 'ishyoboy_tag_cloud_buttonize' ) ) {
	function ishyoboy_tag_cloud_buttonize( $content, $args ){
		//xdebug_var_dump( $args );
		return $content;
	}
}

if ( ! function_exists( 'ishyoboy_mime_types' ) ) {
	function ishyoboy_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}

if ( ! function_exists( 'ishyoboy_add_video_wmode_transparent' ) ) {
	function ishyoboy_add_video_wmode_transparent( $html, $url, $attr ) {
		if ( strpos( $html, "<embed src=" ) !== false ) {
			return str_replace( '</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html );
		}
		elseif ( strpos ( $html, 'feature=oembed' ) !== false ) {
			return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html );
		}
		else {
			return $html;
		}
	}
}