<?php

/* *********************************************************************************************************************
 * Register widget areas
 */
if ( !function_exists( 'ishyoboy_sidebars_init' ) ) {

	function ishyoboy_sidebars_init() {

		if (function_exists('register_sidebar')) {

			register_sidebar(array(
				'name' => __('Blog Sidebar', 'ishyoboy'),
				'id'   => 'sidebar-main',
				'description'   => __('This is the widgetized blog sidebar.', 'ishyoboy'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			));

			if ( is_plugin_active('ishyoboy-boldial-assets/ishyoboy-boldial-assets.php') ){
				register_sidebar(array(
					'name' => __('Portfolio Sidebar', 'ishyoboy'),
					'id'   => 'sidebar-portfolio',
					'description'   => __('This is the widgetized Portfolio sidebar.', 'ishyoboy'),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>'
				));
			}

			register_sidebar(array(
				'name' => __('Expandable', 'ishyoboy'),
				'id'   => 'sidebar-header',
				'description'   => __('This is the widgetized expandable area', 'ishyoboy'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			));

			register_sidebar(array(
				'name' => __('Footer', 'ishyoboy'),
				'id'   => 'sidebar-footer',
				'description'   => __('This is the widgetized footer.', 'ishyoboy'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			));

			/* register_sidebar(array(
				'name' => __('Footer Legals', 'ishyoboy'),
				'id'   => 'sidebar-footer-legals',
				'description'   => __('This is the widgetized footer legals.', 'ishyoboy'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)); */

			if ( ishyoboy_woocommerce_plugin_active() ){
				register_sidebar(array(
					'name' => __('WooCommerce Sidebar', 'ishyoboy'),
					'id'   => 'sidebar-woocommerce',
					'description'   => __('This is the widgetized sidebar for Woocommerce pages if set in theme options.', 'ishyoboy'),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>'
				));
			}
		}
	}
}
global $wp_embed;
add_action( 'widgets_init', 'ishyoboy_sidebars_init' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

$ish_sidebar_curwidth = 0;
$last_sidebar = -1;


/* *********************************************************************************************************************
 * Widget first - last class
 * Add "first" and "last" CSS classes to dynamic sidebar widgets.
 * Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
if ( ! function_exists( 'widget_first_last_classes' ) ) {
	function widget_first_last_classes( $params ) {

		global $wp_registered_widgets, $sidebar_width, $ish_sidebar_curwidth, $last_sidebar;
		global $my_widget_num; // Global counter array

		$new_row_string = '</div></div><div class="ish-row ish-row-notfull"><div class="ish-row_inner">';

		// Get the id for the current sidebar we're processing
		$this_id = $params[0]['id'];
		if ( $last_sidebar != $this_id ) {
			$last_sidebar = $this_id;
			$ish_sidebar_curwidth = 0;
		}

		// Get an array of ALL registered widgets
		$arr_registered_widgets = wp_get_sidebars_widgets();


		//echo $my_widget_num[ $this_id ] . '/' . count( $arr_registered_widgets[ $this_id ] ) . '; w: ' . $ish_sidebar_curwidth . '; sw: ' . $sidebar_width . '<br>';

		// If the counter array doesn't exist, create it
		if( ! $my_widget_num ) {
			$my_widget_num = array();
		}

		// Check if the current sidebar has no widgets
		if( ! isset( $arr_registered_widgets[ $this_id ] ) || ! is_array( $arr_registered_widgets[ $this_id ] ) ) {
			return $params; // No widgets in this sidebar... bail early.
		}

		// See if the counter array has an entry for this sidebar
		if ( isset( $my_widget_num[ $this_id ] ) ) {
			$my_widget_num[ $this_id ]++;
		} else { // If not, create it starting with 1
			$my_widget_num[ $this_id ] = 1;
		}

		// Add a widget number class for additional styling options
		$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

		$divider_exists = false;
		if ( false !== strpos( $params[0]['after_widget'], $new_row_string ) ){
			$divider_exists = true;
		}

		if (  $my_widget_num[ $this_id ] == count( $arr_registered_widgets[ $this_id ] ) &&  $divider_exists){
			$params[0]['after_widget'] = str_replace( $new_row_string, '', $params[0]['after_widget']);
		}

		// Insert our new classes into "before widget"
		$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);

		$widget_id	= $params[0]['widget_id'];
		$widget_obj	= $wp_registered_widgets[$widget_id];
		if ( 'icl_lang_sel_widget' == $widget_obj['id'] ){
			//WPML Widget
			$widget_obj['params'][0]['number'] = 0;
			$widget_num	= $widget_obj['params'][0]['number'];
		}
		else{
			$widget_opt	= get_option($widget_obj['callback'][0]->option_name);
			$widget_num	= $widget_obj['params'][0]['number'];
		}

		if ( isset($widget_opt[$widget_num]['widget_width']) && !empty($widget_opt[$widget_num]['widget_width']) ){}
		else{
			$widget_opt[$widget_num]['widget_width'] = 3;
		}

		$ish_sidebar_curwidth += $widget_opt[$widget_num]['widget_width'];

		if (  $ish_sidebar_curwidth >= $sidebar_width ){
			if (  $my_widget_num[$this_id] != count($arr_registered_widgets[$this_id]) &&  !$divider_exists){
				$params[0]['after_widget'] .= $new_row_string;
			}
			$ish_sidebar_curwidth = 0;
		}

		// Add the grid class based on the additional widget width field
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"ish-grid{$widget_opt[$widget_num]['widget_width']} ", $params[0]['before_widget'], 1 );


		/*if (  $my_widget_num[ $this_id ] == count( $arr_registered_widgets[ $this_id ] ) ){
			$my_widget_num[ $this_id ] = 0;
			$ish_sidebar_curwidth = 0;
		}*/

		return $params;
	}
}
add_filter( 'dynamic_sidebar_params', 'widget_first_last_classes' );


/* *********************************************************************************************************************
 * Use footer sidebar
 */
if ( ! function_exists( 'ishyoboy_use_footer_sidebar' ) ) {
	function ishyoboy_use_footer_sidebar(){
		global $ish_options, $ish_woo_id, $id_404;

		if ( is_404() ){
			$post_id = $id_404;
		}
		else if ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}
		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_fw_area'] ) ? $meta['_ishmb_use_fw_area'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_fw_area', true, $post_id );
		}else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_fw_area');
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_footer_sidebar']) && is_active_sidebar($meta['_ishmb_footer_sidebar'][0]) ) ? true : false;
				}else{
					$sidebar = IshYoMetaBox::get('footer_sidebar', true, $post_id );
					$sidebar_set = is_active_sidebar($sidebar);
				}

				return $sidebar_set;

			} else {
				return false;
			}

		}
		else{
			// Default theme options
			return (isset($ish_options['footer_widget_area']) && '1' == $ish_options['footer_widget_area'] && isset($ish_options['footer_sidebar']) && is_active_sidebar($ish_options['footer_sidebar']) ) ? true : false;

		}
	}
}


/* *********************************************************************************************************************
 * Get footer sidebar
 */
if ( ! function_exists( 'ishyoboy_get_footer_sidebar' ) ) {
	function ishyoboy_get_footer_sidebar(){
		global $ish_options, $ish_woo_id, $id_404;

		if ( is_404() ){
			$post_id = $id_404;
		}
		elseif ( isset($ish_woo_id) ) {
			$post_id = $ish_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_fw_area'] ) ? $meta['_ishmb_use_fw_area'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_fw_area', true, $post_id );
		}else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_fw_area');
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_footer_sidebar'])) ? $meta['_ishmb_footer_sidebar'][0] : '';
				}else{
					$sidebar_set = IshYoMetaBox::get('footer_sidebar', true, $post_id );
				}

				return $sidebar_set;

			} else {
				return '';
			}

		}
		else{
			// Default theme options
			return (isset($ish_options['footer_widget_area']) && '1' == $ish_options['footer_widget_area'] && isset($ish_options['footer_sidebar']) && is_active_sidebar($ish_options['footer_sidebar']) ) ? $ish_options['footer_sidebar'] : '';

		}
	}
}


/* *********************************************************************************************************************
 * Get legals sidebar
 */
if ( ! function_exists( 'ishyoboy_get_legals_sidebar' ) ) {
	function ishyoboy_get_legals_sidebar(){
		global $ish_options;

		// Default theme options
		return (isset($ish_options['footer_legals_area']) && '1' == $ish_options['footer_legals_area'] && isset($ish_options['footer_legals']) && is_active_sidebar($ish_options['footer_legals']) ) ? $ish_options['footer_legals'] : '';

	}
}


/* *********************************************************************************************************************
 * Use footer legals
 */
if ( ! function_exists( 'ishyoboy_use_footer_legals' ) ) {
	function ishyoboy_use_footer_legals(){
		global $ish_options;

		// Default theme options
		return (isset($ish_options['footer_legals_area']) && '' != $ish_options['footer_legals_area'] ) ? true : false;

	}
}