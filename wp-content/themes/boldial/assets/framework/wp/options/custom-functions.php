<?php
/**
 * Created by JetBrains PhpStorm.
 * User: VlooMan
 * Date: 17.2.2013
 * Time: 10:20
 * To change this template use File | Settings | File Templates.
 */

remove_filter( 'the_content', 'post_formats_compat', 7 );

if ( ! defined('PREV_DEFAULT') ) { define( 'PREV_DEFAULT', __( 'Older Article &gt;', 'ishyoboy' ) ); }
if ( ! defined('NEXT_DEFAULT') ) { define( 'NEXT_DEFAULT',  __( '&lt; Newer Article', 'ishyoboy' ) ); }

if ( ! function_exists( 'ishyoboy_custom_part_tagline' ) ) {
	function ishyoboy_custom_part_tagline( $content ){

		global $post, $page, $wp_embed;

		$return = '';
		$return .= '<div class="ish-part_tagline tagline_custom"><div class="ish-row ish-row-notfull"><div class="ish-row_inner">';
		$return .= $content;
		$return .= '</div></div></div>';

		echo $return;

	}
}

if ( ! function_exists( 'ishyoboy_get_part_tagline' ) ) {
	function ishyoboy_get_part_tagline( $id = null, $use_bg_image = null, $use_colors = null ){

		if ( null == $id ){
			if ( !is_tax() && !is_404() && !is_search() ){
				$id = get_the_ID();
			}
		}

		if ( null != $id ){
			$page_title = get_the_title( $id );


			$return = '';

			$display_taglines = IshYoMetaBox::get( 'use_taglines', true, $id );


			if ( null == $use_bg_image ){
				$use_bg_image = ( 'true' == IshYoMetaBox::get( 'use_bg_image', true, $id ) ) ? true : false;
			}

			if ( null == $use_colors ){
				$use_colors = ( 'true' == IshYoMetaBox::get( 'use_colors', true, $id ) ) ? true : false;
			}

			$img_details = '';
			$img_styles = '';
			$img_class = '';
			$overlay_container = '';
			$text_color_class = '';

			if ( $use_bg_image && has_post_thumbnail( $id) ){
				$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'theme-large' );
			}

			if ( $use_colors ){
				$color_data = ishyoboy_get_color_data( $id );
				$text_color_class = $color_data['classes'];
				if ( '' != $color_data['bg_class'] ) { $overlay_container = '<div class="ish-overlay"></div>'; }
			}

			if ( ! empty( $img_details ) ){
				$img_styles = ' style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position-y: 50%;"';
				$img_class = ' ish-tagline-image' . $text_color_class;
			}else{
				$img_class = ' ish-tagline-colored' . $text_color_class;
			}

			if ( 'true' == $display_taglines ){

				$tagline_1 = IshYoMetaBox::get( 'tagline_1', true, $id );
				$tagline_2 = IshYoMetaBox::get( 'tagline_2', true, $id );

				if ( ( !empty( $tagline_1 ) ) ||  ( !empty( $tagline_2 ) ) ){
					$return .= '<div class="ish-part_tagline ish-tagline_custom' . $img_class .'"' . $img_styles . '>' . $overlay_container . '<div class="ish-row ish-row-notfull"><div class="ish-row_inner">';
					if ( !empty( $tagline_1 ) ){ $return .= '<h1>' . $tagline_1 . '</h1>'; }
					if ( !empty( $tagline_2 ) ){ $return .= '<h2>' . $tagline_2 . '</h2>'; }

					if ( is_singular('post') ){
						$return .= ishyoboy_get_post_details();
					}

					$return .= '</div></div></div>';
				}

			}
			else {
				$return .= '<div class="ish-part_tagline ish-tagline_title' . $img_class . '"' . $img_styles . '>' . $overlay_container . '<div class="ish-row ish-row-notfull"><div class="ish-row_inner">';
				$return .= '<h1>' . $page_title . '</h1>';

				if ( is_singular('post') ){
					$return .= ishyoboy_get_post_details();
				}

				$return .= '</div></div></div>';
			}

			echo $return;

		} else{
			//<!-- Lead part section -->
			$current_term = get_queried_object();
			$lead_type = '';

			if ( is_tax( 'product_tag' ) ){
				$lead_type = __( 'Tag: ', 'ishyoboy' );
			} else if ( is_tax( 'product_cat' ) ){
				$lead_type = __( 'Category: ', 'ishyoboy' );
			}

			$lead = '<h1>' . $lead_type . $current_term->name . '</h1>';
			$lead .= ( '' != $current_term->description ) ? '<h2>' . do_shortcode( $current_term->description ) . '</h2>' : '';

			// Image
			if ( function_exists('get_woocommerce_term_meta') ){
				$thumbnail_id = get_woocommerce_term_meta( $current_term->term_id, 'thumbnail_id', true  );
			}

			if ( $thumbnail_id ) {
				$image = wp_get_attachment_image_src( $thumbnail_id, 'theme-large'  );
				$image = $image[0];
			}

			if ( ! empty( $image ) ){
				$img_styles = ' style="background-image: url(\'' . $image . '\'); background-size: cover; background-position-y: 50%;"';
				$img_class = ' ish-tagline-image';
				$return = '<div class="ish-part_tagline ish-tagline_title' . $img_class . '"' . $img_styles . '><div class="ish-row ish-row-notfull"><div class="ish-row_inner">';
				$return .= $lead;
				$return .= '</div></div></div>';
				echo $return;
			}else{
				ishyoboy_custom_part_tagline( $lead );
			}
			//<!-- Lead part section -->
		}
	}
}




if ( ! function_exists( 'ishyoboy_use_header_bar' ) ) {
	function ishyoboy_use_header_bar(){
		global $ish_options;
		return ( isset($ish_options['use_header_bar']) && '1' == $ish_options['use_header_bar'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishyoboy_social_icons_in_header_bar' ) ) {
	function ishyoboy_social_icons_in_header_bar(){
		global $ish_options;
		return ( isset($ish_options['header_bar_social_icons_position']) && 'in-header-bar' == $ish_options['header_bar_social_icons_position'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishyoboy_social_icons_in_header' ) ) {
	function ishyoboy_social_icons_in_header(){
		global $ish_options;
		return ( isset($ish_options['header_bar_social_icons_position']) && 'in-header' == $ish_options['header_bar_social_icons_position'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishyoboy_array_find' ) ) {
	function ishyoboy_array_find($needle, $haystack)
	{
		foreach ($haystack as $key => $item)
		{
			if (stripos($item, $needle) !== FALSE)
			{
				return $key;
				break;
			}
		}

		return 0;
	}
}

if ( ! function_exists( 'ishyoboy_search_excerpt_highlight' ) ) {
	function ishyoboy_search_excerpt_highlight($excerpt) {
		$keys = implode('|', explode(' ', get_search_query()));
		$new_excerpt = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $excerpt);
		return $new_excerpt;
	}
}

if ( ! function_exists( 'ishyoboy_custom_excerpt' ) ) {
	function ishyoboy_custom_excerpt($custom_content, $limit, $search = null) {
		$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $custom_content);  # strip shortcodes, keep shortcode content
		$content = wp_strip_all_tags($content, true);
		$content = preg_replace('/\[.+\]/','', $content);

		if ( isset($search)){
			$content = explode(' ', $content);
			$index = ishyoboy_array_find($search, $content);
			$start = ( ($index - $limit / 2) < 0 ) ? 0 : $index - $limit / 2;
			$content = array_slice($content, $start, $limit);
		} else{
			$content = explode(' ', $content, $limit);
		}

		if ( count($content) >= $limit ) {
			array_pop($content);
			$content = implode( ' ', $content ) . '...';
		} else {
			$content = implode( ' ', $content );
		}
		//$content = preg_replace('/\[.+\]/','', $content);
		if ( isset($search)){
			$content = apply_filters('the_content', $content);
		}
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace("&nbsp;", ' ', $content);
		//$content = str_ireplace($search, '<mark>' . $search . '</mark>' , $content);
		//$content = ishyoboy_search_excerpt_highlight($content);
		/**/
		return $content;
	}
}

if ( ! function_exists( 'ishyoboy_colors_to_hex' ) ) {
	function ishyoboy_colors_to_hex($input){
		global $current_colors, $ish_options;
		$output = $input;

		for ($i = IYB_COLORS_COUNT; $i >= 1; $i--) {
			$output = str_replace('color' . $i, $ish_options['color' . $i], $output);
		}

		return $output;
	}
}

if ( ! function_exists( 'ishyoboy_show_addthis' ) ) {
	function ishyoboy_show_addthis(){
		global $ish_options;

		if ( isset($ish_options['use_addthis_share']) && '1' == $ish_options['use_addthis_share'] && isset($ish_options['addthis_share']) && '' != $ish_options['addthis_share'] ){
			echo  '<div class="share_box share_box_fixed">' . $ish_options['addthis_share'] . '</div>';
		}
	}
}

if ( ! function_exists( 'ishyoboy_blogpost_prev_next' ) ) {
	function ishyoboy_blogpost_prev_next($separator = ' ', $prev_label = PREV_DEFAULT, $next_label = NEXT_DEFAULT ){
		echo '<div class="ish-single_post_navigation">';
		$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
		$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );
		if ( get_permalink() != $nav_next ){
			echo '<div class="blog-next-link"><a class="ish-sc_button ish-color2 ish-text-color3" href="' . esc_attr($nav_next) . '">' . $next_label . '</a></div>';
		}

		echo $separator;

		if ( get_permalink() != $nav_prev ){
			echo '<div class="blog-prev-link"><a class="ish-sc_button ish-color2 ish-text-color3" href="' . esc_attr($nav_prev) . '">' . $prev_label . '</a></div>';
		}
		echo '</div>';
	}
}

if (!function_exists('has_shortcode')){
	function has_shortcode( $content, $tag ) {
		if ( shortcode_exists( $tag ) ) {
			$matches = array();
			preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
			if ( empty( $matches ) )
				return false;

			foreach ( $matches as $shortcode ) {
				if ( $tag === $shortcode[2] )
					return true;
			}
		}
		return false;
	}
}

if (!function_exists('shortcode_exists')){
	function shortcode_exists( $tag ) {
		global $shortcode_tags;
		return array_key_exists( $tag, $shortcode_tags );
	}
}


add_action( 'of_options_before_save_only_save', 'ishyoboy_theme_change_check' );

if ( ! function_exists( 'ishyoboy_theme_change_check' ) ) {
	function ishyoboy_theme_change_check($data){
		global $ish_options;

		if ( isset( $ish_options['skin'] ) && isset( $data['skin'] ) && $ish_options['skin'] != $data['skin'] ){
			// SKIN Change

			$alt_stylesheet_path = LAYOUT_PATH;

			if ( is_dir($alt_stylesheet_path) )
			{
				$skin = $alt_stylesheet_path . $data['skin'];
				if ( file_exists( $skin ) ) {
					require_once( $skin );

					if ( isset($skin_data) ) {

						foreach ( $skin_data as $key => $val){
							if ( is_array($val) ){

								// Make sure to also change this code in "ishyoboy_generate_skins" function
								if ( strpos( $key, '_colors' ) !== false){
									// Grouped colors setting
									$data[$key] = $val;
								}
								else{
									// Font Setings

									foreach ( $val as $val_key => $val_val){

										$new_key = $key . '_' . $val_key;

										//echo 'Changing "' . $new_key .'" from [' . $data[$new_key] . '] to [' . $val_val . ' ]' . "\n";
										$data[$new_key] = $val_val;

									}

								}

							}
							else{
								//echo 'Changing "' . $key .'" from [' . $data[$key] . '] to [' . $val . ' ]' . "\n";
								$data[$key] = $val;
							}

						}
					}
				}

			}
		}
		else{
			// NO Change
		}

		//ishyoboy_generate_options_css( $data );
		return $data;
	}
}

add_action( 'of_options_before_save', 'ishyoboy_filter_theme_change_check' );

if ( ! function_exists( 'ishyoboy_filter_theme_change_check' ) ) {
	function ishyoboy_filter_theme_change_check($data){
		ishyoboy_generate_options_css( $data );
		return $data;
	}
}

if ( ! function_exists( 'ishyoboy_generate_options_css' ) ) {
	function ishyoboy_generate_options_css( $newdata, $generated_css_key = GENERATEDCSS, $generated_css_prefix = ISH_PREFIX) {
		$ver = get_option( $generated_css_key );
		$ver = ( $ver ) ? (int)$ver : 1;
		$ver++;
		update_option( $generated_css_key , $ver);

		$uploads = wp_upload_dir();
		$css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

		$newdata = apply_filters( 'of_options_before_generate_options_css', $newdata );
		/** Save on different directory if on multisite **/
		/*
		if( is_multisite() ) {
			$aq_uploads_dir = trailingslashit( $uploads['basedir'] );
		} else {
			$aq_uploads_dir = $css_dir;
		}
		/**/
		$ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . THEME_SLUG . '_css';

		for ( $inc_i = 0; $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < IYB_COLORS_COUNT ; $inc_i++ ){

			$ISH_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;

			/** Capture CSS output **/
			ob_start();
			require( locate_template( 'assets/framework/wp/dynamic_css/dynamic_css.php' ) );
			$css = ob_get_clean();

			/** Write to options.css file **/
			WP_Filesystem();
			global $wp_filesystem;
			wp_mkdir_p( $ish_uploads_dir );
			$ish_file_order_postfix = ($inc_i > 0) ? '_' . ( $inc_i + 1 ) : '';
			if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/main-options' . $generated_css_prefix . $ish_file_order_postfix . '.css', $css, 0644) ) {
				return true;
			}

		}



	}
}

/**
 * Returns the contrast color for a given hex color value (e.g. #ffffff)
 *
 * @param string $hexcolor - The color in hex format "#ffffff"
 * @return string
 */
if ( ! function_exists( 'ishyoboy_get_color_contrast' ) ) {
	function ishyoboy_get_color_contrast( $hexcolor ){
		// Remove the "#" from the beginning
		$hexcolor = substr( $hexcolor, 1);

		$r = hexdec(substr($hexcolor,0,2));
		$g = hexdec(substr($hexcolor,2,2));
		$b = hexdec(substr($hexcolor,4,2));
		$yiq = (($r*299)+($g*587)+($b*114))/1000;
		return ($yiq >= 128) ? '#000000' : '#ffffff';
	}
}

if ( ! function_exists( 'ishyoboy_generate_theme_skins' ) ) {
	function ishyoboy_generate_theme_skins( $newdata, $skin_name) {

		$uploads = wp_upload_dir();
		$css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

		$ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . THEME_SLUG . '_css';

		for ( $inc_i = 0; $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < IYB_COLORS_COUNT ; $inc_i++ ){

			$ISH_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;

			/** Capture CSS output **/
			ob_start();
			require( locate_template( 'assets/framework/wp/dynamic_css/dynamic_css.php' ) );
			$css = ob_get_clean();

			/** Write to options.css file **/
			WP_Filesystem();
			global $wp_filesystem;
			wp_mkdir_p( $ish_uploads_dir );
			$ish_file_order_postfix = ($inc_i > 0) ? '_' . ( $inc_i + 1 ) : '';
			if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/' . THEME_SLUG . '_skin_' . strtolower($skin_name) . $ish_file_order_postfix . '.css', $css, 0644) ) {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'ishyoboy_get_favicon' ) ) {
	function ishyoboy_get_favicon( $size = null ){
		global $ish_options;
		$return = '';

		if ( isset( $ish_options['custom_favicon_144'] ) && ( '' != $ish_options['custom_favicon_144']) ){
			$return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_144'] . '">' . "\n";
		}

		if ( isset( $ish_options['custom_favicon_114'] ) && ( '' != $ish_options['custom_favicon_114']) ){
			$return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_114'] . '">' . "\n";
		}

		if ( isset( $ish_options['custom_favicon_72'] ) && ( '' != $ish_options['custom_favicon_72']) ){
			$return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_72'] . '">' . "\n";
		}

		if ( isset( $ish_options['custom_favicon_16'] ) && ( '' != $ish_options['custom_favicon_16']) ){
			$return .= '<link rel="shortcut icon" href="' . $ish_options['custom_favicon_16'] . '">' . "\n";
		}

		return $return;
	}
}

if ( ! function_exists( 'ishyoboy_set_javascritp_paths' ) ) {
	function ishyoboy_set_javascritp_paths(){

		global $ish_options;

		echo "\n\n<script type='text/javascript'>\n";
		echo "/* <![CDATA[*/\n";
		echo "var ishyoboy_globals = {\n \tIYB_FRAMEWORK_URI: '".IYB_FRAMEWORK_URI."', \n \tIYB_TEMPLATE_URI: '".IYB_TEMPLATE_URI."',\n \t";

		$all_colors = '{';

		for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ){

			if ( isset( $ish_options['color' . $i] ) ){
				$all_colors .= '"color' . $i . '":"' . $ish_options['color' . $i] . '",';
			}

		}

		$all_colors .= '}';

		if ( '{}' != $all_colors ){
			echo "IYB_COLORS: " . $all_colors . "\n \t";
		}

		echo "}; \n";

		echo "/* ]]> */ \n ";
		echo "</script>\n\n";
	}
}

if ( ! function_exists( 'ishyoboy_set_javascritp_globals' ) ) {
	function ishyoboy_set_javascritp_globals(){
		global $ish_options;
		echo "\n\n<script type='text/javascript'>\n";
		echo "/* <![CDATA[*/\n";
		echo "var ishyoboy_fe_globals = {\n \tIYB_RESPONSIVE: " . ( ( !isset( $ish_options['use_responsive_layout'] ) || '1' == $ish_options['use_responsive_layout'] ) ? 'true' : 'false'  ) . ",\n \tIYB_BREAKINGPOINT: " . ( ( isset( $ish_options['responsive_layout_breakingpoint'] ) && '' != $ish_options['responsive_layout_breakingpoint'] ) ? $ish_options['responsive_layout_breakingpoint'] : IYB_BREAKINGPOINT  ) . "\n \t}; \n";
		echo "/* ]]> */ \n ";
		echo "</script>\n\n";
	}
}

// BREADCRUMBS
if ( ! function_exists( 'ishyoboy_get_breadcrumbs' ) ) {
	function ishyoboy_get_breadcrumbs() {

		global $ish_options, $ish_woo_id;

		$return = '';

		$return .= '<div class="ish-pb-breadcrumbs"><div><div>' . "\n";

		if ( ! is_front_page() ) {
			if ( function_exists('is_woocommerce') ) {
				if ( !is_woocommerce() && !is_woocommerce_page() ){
					$return .= '<a class="ish-pb-breadcrumbs-home" href="';
					$return .= home_url();
					$return .= '">';
					$return .= '<span>' . __( 'Home', 'ishyoboy' ) . '</span>';
					$return .= "</a> &gt; ";
				}

			}
			else{
				$return .= '<a class="ish-pb-breadcrumbs-home" href="';
				$return .= home_url();
				$return .= '">';
				$return .= '<span>' . __( 'Home', 'ishyoboy' ) . '</span>';
				$return .= "</a> &gt; ";
			}

		}
		else {
			$return .= '<span class="ish-pb-breadcrumbs-home">';
			$return .= '<span>' . __( 'Home', 'ishyoboy' ) . '</span>';
			$return .= "</span>";
		}

		if ( !is_front_page() && is_home() ) {
			global $page;
			$return .= $page->post_title;
		}

		if ( is_archive() && 'post' == get_post_type() && ! is_category() && ( !function_exists('is_woocommerce') || !is_woocommerce() )  ) {
			$hpage = get_page( get_option( 'page_for_posts' ) );
			if ( 'page' == get_option('show_on_front') && isset($hpage) && '' != $hpage ){
				$return .=  get_page_parents($hpage->ID, TRUE, ' &gt; ', FALSE );
			}
			if ( is_day() ) :
				$return .= sprintf( __( 'Daily Archives: %s', 'ishyoboy' ), '<span>' . get_the_date() . '</span>' );
			elseif ( is_month() ) :
				$return .= sprintf( __( 'Monthly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ishyoboy' ) ) . '</span>' );
			elseif ( is_year() ) :
				$return .= sprintf( __( 'Yearly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ishyoboy' ) ) . '</span>' );
			else :
				$return .= __( 'Archives', 'ishyoboy' );
			endif;
		}
		else if ( is_archive() && 'post' != get_post_type() && 'portfolio-post' != get_post_type() && ( !function_exists('is_woocommerce') || !is_woocommerce() )  ) {

			$type = get_post_type( get_the_ID() );

			$obj = get_post_type_object( $type );
			if ( is_object( $obj ) ){
				$return .= $obj->labels->name;
			}

		}

		if ( (is_category() || is_single()) && ( ( !function_exists('is_woocommerce_page') || !function_exists('is_woocommerce' ) ) || ( !is_woocommerce() && !is_woocommerce_page() ) ) ) {

			$post_id = ish_get_the_ID();
			$post_type = get_post_type();

			switch ($post_type){
				case 'portfolio-post' :
					$terms = get_the_terms($post_id, 'portfolio-category' );
					$term = ( ! empty( $terms ) ) ? array_pop($terms) : '';

					if (isset($ish_options['page_for_custom_post_type_portfolio-post']) && '-1' != $ish_options['page_for_custom_post_type_portfolio-post']){

						$portfolio_page = get_page($ish_options['page_for_custom_post_type_portfolio-post']);
						$separator = " &gt; ";
						$return .= '<a href="' . get_page_link( $ish_options['page_for_custom_post_type_portfolio-post'] ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" , 'ishyoboy' ), $portfolio_page->post_title ) ) . '">'.$portfolio_page->post_title.'</a>' . $separator;
					}

					if ( ! empty( $term ) ){
						$return .= get_term_parents($term->term_id, 'portfolio-category', TRUE, ' &gt; ', FALSE );
					}
					break;

				case 'post' :
					$hpage = get_page( get_option( 'page_for_posts' ) );
					if ( 'page' == get_option('show_on_front') && isset($hpage) && '' != $hpage ){
						$return .=  get_page_parents($hpage->ID, TRUE, ' &gt; ', FALSE );
					}
					if ( is_category() ){
						global  $cat;
						$category = get_category($cat);
						if ( $category->parent && ( $category->parent != $category->term_id ) ){
							$return .= get_category_parents($category->parent, TRUE, ' &gt; ', FALSE );
						}
						$return .= single_cat_title('', false);
					}
					else{
						$category = get_the_category();
						if ( is_array( $category ) ){
							$ID = $category[0]->cat_ID;
							$return .= get_category_parents($ID, TRUE, ' &gt; ', FALSE );
						}
					}
					break;

				default :
					$type = get_post_type( get_the_ID() );

					$obj = get_post_type_object( $type );
					if ( is_object( $obj ) ){
						$return .= '<a href="' . get_post_type_archive_link( $type ) .'">' . $obj->labels->name . '</a> &gt; ';
					}

			}
		}
		else if ( ( function_exists('is_woocommerce_page') && function_exists('is_woocommerce') ) && (is_woocommerce() || is_woocommerce_page() )){
			ob_start();
			woocommerce_breadcrumb(array(
				'delimiter'   => ' &gt; ',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => '<span class="ish-pb-breadcrumbs-home"><span>' . _x( 'Home', 'breadcrumb', 'woocommerce' ) . '</span></span>',
			));
			$woo_crumbs = ob_get_contents();
			$woo_crumbs = str_replace( '&lt;span class=&quot;ish-pb-breadcrumbs-home&quot;&gt;&lt;span&gt;', '<span class="ish-pb-breadcrumbs-home"><span>', $woo_crumbs );
			$woo_crumbs = str_replace( '&lt;/span&gt;&lt;/span&gt;', '</span></span>', $woo_crumbs );
			$return .= $woo_crumbs;
			ob_end_clean();
		}
		else if (is_tax()){
			if (is_tax('portfolio-category')){

				$current_term = get_queried_object();

				if ( !empty($current_term) ){
					//var_dump($current_term);

					if (isset($ish_options['page_for_custom_post_type_portfolio-post']) && '-1' != $ish_options['page_for_custom_post_type_portfolio-post']){

						$portfolio_page = get_page($ish_options['page_for_custom_post_type_portfolio-post']);
						$separator = " &gt; ";
						$return .= '<a href="' . get_page_link( $ish_options['page_for_custom_post_type_portfolio-post'] ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" , 'ishyoboy' ), $portfolio_page->post_title ) ) . '">'.$portfolio_page->post_title.'</a>' . $separator;
					}

					if ($current_term->parent != 0 ){
						$return .= get_term_parents($current_term->parent, 'portfolio-category', TRUE, ' &gt; ', FALSE );
					}

					$return .= $current_term->name;
				}
			}
		}
		else if (is_page()){
			global $post;

			if ($post->post_parent != 0 ){
				$return .= get_page_parents($post->post_parent, TRUE, ' &gt; ', FALSE );
			}
		}

		if (!function_exists('is_woocommerce_page') || !is_woocommerce_page()){
			if(is_single()) {$return .= get_the_title();}
			if(is_page()) {
				global $post;
				$frontpage = get_option('page_on_front');

				if ( $frontpage && $frontpage == $post->ID){
					/*$return .= '<a class="home" href="';
					$return .= home_url();
					$return .= '">';
					$return .= '<span>' . __( 'Home', 'ishyoboy' ) . '</span>';
					$return .= "</a>";*/
				} else {
					$return .= get_the_title();
				}
			}
			if(is_tag()){ $return .= __( 'Tag: ', 'ishyoboy' ) . single_tag_title('',FALSE); }
			if(is_404()){ $return .= __( '404 - Page not Found', 'ishyoboy' ); }
			if(is_search()){ $return .= __( 'Search', 'ishyoboy' ); }
			if(is_year()){ $return .= get_the_time('Y'); };
		}

		$return .= '</div></div></div>';

		return $return;
	}
}

if ( !function_exists('the_post_thumbnail_caption') ) {
	function the_post_thumbnail_caption(){

		$thumb = get_post_thumbnail_id();

		if ( ! empty( $thumb ) ){
			$thumb_object = get_post( $thumb );
			if ( ! empty( $thumb_object ) ) {
				echo '<div class="wp-caption"><p class="wp-caption-text">' . $thumb_object->post_excerpt . '</p></div>';
			}
		}

	}
}

if ( !function_exists('get_the_post_thumbnail_caption') ) {
	function get_the_post_thumbnail_caption(){

		$thumb = get_post_thumbnail_id();

		if ( ! empty( $thumb ) )
			return get_post( $thumb )->post_excerpt;

		return null;
	}
}

if ( ! function_exists( 'ishyoboy_activate_fancybox_on_blog_single' ) ) {
	function ishyoboy_activate_fancybox_on_blog_single() {

		if ( is_singular() && !is_singular( 'product' ) ){
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					var thumbnails = jQuery("a:has(img)").not(".nolightbox").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr('href')) });

					if ( thumbnails.length > 0){
						thumbnails.addClass( 'openfancybox-image' ).attr( 'rel', 'fancybox-post-image-<?php the_ID() ?>');
					}
				});
			</script>
		<?php
		}

	}
}
add_action( 'wp_head', 'ishyoboy_activate_fancybox_on_blog_single' );


if ( ! function_exists( 'ishyoboy_dummy_functions' ) ) {
	function ishyoboy_dummy_functions() {

		if ( false ) {
			posts_nav_link();
			wp_link_pages();
			$args = '';
			add_theme_support( 'custom-header', $args );
			add_theme_support( 'custom-background', $args );
		}

	}
}
