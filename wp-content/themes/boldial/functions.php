<?php

// Variables necessary for row decorations paddings of previous sections
global $ish_rows_replace;

// Variables necessary for row decorations paddings of previous sections
global $ish_globals;

$ish_rows_replace = Array();
// Necessary for content entered before the VC rows by "the_content" filter
$ish_rows_replace[] = ' ish-decor-padding-0 ';

require_once( locate_template( 'assets/functions/general.php' ) );
require_once( locate_template( 'assets/functions/layout.php' ) );
require_once( locate_template( 'assets/functions/nav.php' ) );
require_once( locate_template( 'assets/functions/widgets.php' ) );
require_once( locate_template( 'assets/functions/filters.php' ) );
require_once( locate_template( 'assets/functions/blog.php' ) );
require_once( locate_template( 'assets/functions/ajax.php' ) );
require_once( locate_template( 'assets/functions/theme-plugin-functions.php' ) );

/* *********************************************************************************************************************
 * Page width / content width
 */
define( 'IYB_PAGE_WIDTH', 1240);
define( 'IYB_BREAKINGPOINT', 768);
define( 'IYB_NAV_BREAKINGPOINT', 1024);

if ( ! isset( $content_width ) ) $content_width = 1120;


/* *********************************************************************************************************************
 * URI & DIR
 */
if ( get_stylesheet_directory() == get_template_directory() ) {
	define( 'IYB_STYLESHEET_URI', get_template_directory_uri() );
	define( 'IYB_STYLESHEET_DIR', get_template_directory() );
} else {
	define( 'IYB_STYLESHEET_URI', get_stylesheet_directory_uri() );
	define( 'IYB_STYLESHEET_DIR', get_stylesheet_directory() );
}

define( 'IYB_TEMPLATE_URI', get_template_directory_uri() );
define( 'IYB_TEMPLATE_DIR', get_template_directory() );

define( 'IYB_FRAMEWORK_URI', IYB_TEMPLATE_URI . '/assets/framework' );
define( 'IYB_FRAMEWORK_DIR', IYB_TEMPLATE_DIR . '/assets/framework' );

define( 'IYB_HTML_URI', IYB_TEMPLATE_URI . '/assets/frontend' );
define( 'IYB_HTML_DIR', IYB_TEMPLATE_DIR . '/assets/frontend' );

define( 'IYB_HTML_URI_JS', IYB_TEMPLATE_URI . '/assets/frontend/js' );
define( 'IYB_HTML_DIR_JS', IYB_TEMPLATE_DIR . '/assets/frontend/js' );

define( 'IYB_HTML_URI_CSS', IYB_TEMPLATE_URI . '/assets/frontend/css' );
define( 'IYB_HTML_DIR_CSS', IYB_TEMPLATE_DIR . '/assets/frontend/css' );

define( 'IYB_HTML_URI_USER', IYB_TEMPLATE_URI . '/assets/frontend/user' );
define( 'IYB_HTML_DIR_USER', IYB_TEMPLATE_DIR . '/assets/frontend/user' );

define( 'IYB_WP_URI', IYB_TEMPLATE_URI . '/assets/wp' );
define( 'IYB_WP_DIR', IYB_TEMPLATE_DIR . '/assets/wp' );

define( 'THEME_SLUG', 'boldial' );
define( 'PATH_ISHYOBOY_URL', 'http://themes.ishyoboy.com' );

if( is_child_theme() ) {
	$temp_obj = wp_get_theme();
	$theme_obj = wp_get_theme( $temp_obj->get('Template') );
} else {
	$theme_obj = wp_get_theme();
}

define( 'PARENT_THEME_NAME', $theme_obj->get('Name') );

// Generate dynamic.css on every Theme Options Save. If false the css will be output in the body of every page
if ( ! defined( 'ISH_GENERATE_DYNAMIC_CSS' ) ){
	define( 'ISH_GENERATE_DYNAMIC_CSS' , true );
}

// Due to IE9 MAX 4095 CSS Selectors per file error, we need to split the mani-options css file or fallback into more files
if ( ! defined( 'ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT' ) ){
	define( 'ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT' , 10 );
}



/* *********************************************************************************************************************
 * Colors
 */
define( 'ISH_COLOR_1', '#494c43');
define( 'ISH_COLOR_2', '#acaea9');
define( 'ISH_COLOR_3', '#f9f9f9');
define( 'ISH_COLOR_4', '#ffffff');
define( 'ISH_TEXT_COLOR', '#494c43');
define( 'ISH_BODY_COLOR', '#f9f9f9');
define( 'ISH_BACKGROUND_COLOR', '#fcd14c');  // Depends on the BG pattern
if ( ! defined( 'IYB_COLORS_COUNT' ) ){
	define( 'IYB_COLORS_COUNT', 20);  // Number of colors
}
define( 'IYB_BASE_COLORS_COUNT', 5);  // Number of base colors

define( 'ISH_COLOR_5', '#fcd14c'); // Yellow
define( 'ISH_COLOR_6', '#75a7c0'); // Blue
define( 'ISH_COLOR_7', '#eb7244'); // Orange
define( 'ISH_COLOR_8', '#98bb56'); // green
define( 'ISH_COLOR_9', '#f45e78'); // Pink
define( 'ISH_COLOR_10', '#8b6c93'); // Purple
define( 'ISH_COLOR_11', '#ee5454'); // Red
define( 'ISH_COLOR_12', '#9D7136'); // Brown
define( 'ISH_COLOR_13', '#dedede'); // Light grey
define( 'ISH_COLOR_14', '#81dbda'); // Turquoise Blue
define( 'ISH_COLOR_15', '#7a7a7a'); // Medium grey
define( 'ISH_COLOR_16', '#ffffff');
define( 'ISH_COLOR_17', '#ffffff');
define( 'ISH_COLOR_18', '#ffffff');
define( 'ISH_COLOR_19', '#ffffff');
define( 'ISH_COLOR_20', '#ffffff');

$current_colors['color1'] = ISH_COLOR_1;
$current_colors['color2'] = ISH_COLOR_2;
$current_colors['color3'] = ISH_COLOR_3;
$current_colors['color4'] = ISH_COLOR_4;


/* *********************************************************************************************************************
 * Fonts
 */
define( 'FONT_1', 'Ubuntu');
define( 'FONT_2', 'Lato');

// Will be used to store all fonts settings
$ish_fonts = array(
	'body_font' => array(
		'type' => 'google',
		'name' => FONT_2,
		'variant' => 'regular',
		'size' => '16',
		'line_height' => '22'
	),
	'body_font_2' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => 'regular', // Unused
		'size' => '', // Unused
		'line_height' => '' // Unused
	),
	'header_font' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => '500',
		'size' => '15',
		'line_height' => '18'
	),
	'h1_font' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => '700',
		'size' => '60',
		'line_height' => '70'
	),
	'h2_font' => array(
		'type' => 'google',
		'name' => 'Ubuntu',
		'variant' => '700',
		'size' => '40',
		'line_height' => '48'
	),
	'h3_font' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => '500',
		'size' => '24',
		'line_height' => '30'
	),
	'h4_font' => array(
		'type' => 'google',
		'name' => 'Ubuntu',
		'variant' => '500',
		'size' => '19',
		'line_height' => '24'
	),
	'h5_font' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => '500',
		'size' => '16',
		'line_height' => '20'
	),
	'h6_font' => array(
		'type' => 'google',
		'name' => FONT_1,
		'variant' => '500',
		'size' => '12',
		'line_height' => '15'
	)
);

/* *********************************************************************************************************************
 * Filters
 */

add_filter( 'ish_part_content_classes', 'ish_part_content_classes', 10, 2);
add_filter( 'ish_the_content', 'ishyoboy_the_content_line_open', 10, 1);
add_filter( 'ish_the_content', 'ishyoboy_the_content_line_close', 20, 1);
add_filter( 'ish_the_content', 'ishyoboy_the_content_remove_decor_padding_classes', 30, 1);

// Allow SVG files in Media Library
add_filter( 'upload_mimes', 'ishyoboy_mime_types' );

// Fix youtube video embeds floating over the sticky navigation in IE11
add_filter( 'embed_oembed_html', 'ishyoboy_add_video_wmode_transparent', 10, 3 );

/* *********************************************************************************************************************
 * Misc
 */
define ( 'ISH_DEFAULT_BOXED_LAYOUT', 'unboxed');
define ( 'ISH_DEFAULT_HEADER_HEIGHT', '100' );
define ( 'ISH_DEFAULT_STICKY_HEIGHT', '50' );


/* *********************************************************************************************************************
 * Theme setup
 */
if ( !function_exists( 'ishyoboy_theme_setup' ) ) {
	function ishyoboy_theme_setup() {

		// Adding support for post-formats WP 3.1+
		//add_theme_support( 'post-formats', array( 'image', 'audio', 'video', 'aside', 'gallery', 'link', 'quote', 'status' ) );
		add_theme_support( 'post-formats', array( 'image', 'audio', 'video', 'link', 'quote') );
		add_theme_support( 'automatic-feed-links' );

		/*
		aside - Typically styled without a title. Similar to a Facebook note update.
		gallery - A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
		link - A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.                                                                                                                                                                                                                                                                                                               image - A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
		quote - A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title.
		status - A short status update, similar to a Twitter status update.
		video - A single video. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
		audio - An audio file. Could be used for Podcasting.
		chat - A chat transcript
		/**/
	}
}
add_action( 'after_setup_theme', 'ishyoboy_theme_setup' );


/* *********************************************************************************************************************
 * Load other local js files
 */
if ( ! function_exists( 'ishyoboy_load_my_scripts' ) ) {
	function ishyoboy_load_my_scripts() {

		// Vendor ------------------------------------------------------------------------------------------------------
		global $smof_wpml_prefix, $ish_options;

		$uploads = wp_upload_dir();
		$uploads_dir = trailingslashit( $uploads['basedir'] ) . THEME_SLUG . '_css';
		$uploads_url = trailingslashit( $uploads['baseurl'] ) . THEME_SLUG . '_css';

		wp_enqueue_script('jquery');

		wp_register_style( 'ish-fontello', IYB_TEMPLATE_URI . '/assets/frontend/css/ish-fontello.css');
		wp_enqueue_style( 'ish-fontello' );

		wp_register_style( 'ish-' . THEME_SLUG . '-styles', IYB_STYLESHEET_URI . '/style.css');
		wp_enqueue_style( 'ish-' . THEME_SLUG . '-styles' );

		wp_register_style('ish-tooltipster', IYB_HTML_URI_CSS . '/plugins/tooltipster.css');
		wp_enqueue_style( 'ish-tooltipster' );


		// Include the generated dynamic.css into head links
		if ( ( ! defined( 'ISH_GENERATE_DYNAMIC_CSS' ) ) || ISH_GENERATE_DYNAMIC_CSS ){
			if ( file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '.css' ) ){
				$ver = get_option( 'ishyoboy_' . PARENT_THEME_NAME . '_generated_css_version' . $smof_wpml_prefix );
				wp_register_style( 'main-options', $uploads_url . '/main-options' . $smof_wpml_prefix . '.css', null, $ver );
				wp_enqueue_style( 'main-options' );

				// Load all main-options files
				for ( $i = 1; $i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < IYB_COLORS_COUNT ;$i++){
					if  ( file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '_' . ($i +1) . '.css' ) ){
						$ver = get_option( 'ishyoboy_' . PARENT_THEME_NAME . '_generated_css_version' . $smof_wpml_prefix );
						wp_register_style( 'main-options-' . ($i +1), $uploads_url . '/main-options' . $smof_wpml_prefix . '_' . ($i +1) . '.css', null, $ver );
						wp_enqueue_style( 'main-options-' . ($i +1) );
					}
				}

			}
		}

		do_action( 'ishyoboy_enque_skin_css' );

		// Load only if smoothscroll is enabled in TO
		if ( ishyoboy_body_smoothscroll() ) {
			wp_register_script( 'ish-smoothscroll', IYB_HTML_URI_JS . '/vendor/jquery.smoothscroll.min.js', array('jquery'), null, true );
			wp_enqueue_script( 'ish-smoothscroll' );
		}

		wp_register_script( 'ish-flexslider', IYB_HTML_URI_JS . '/vendor/jquery.flexslider-min.js', array('jquery'), null, true );
		//wp_enqueue_script( 'flexslider' );

		wp_register_script( 'ish-packery', IYB_HTML_URI_JS . '/vendor/packery.pkgd.min.js', array('jquery'));
		wp_enqueue_script( 'ish-packery' );

		wp_register_script( 'ish-imagesloaded', IYB_HTML_URI_JS . '/vendor/imagesloaded.pkgd.min.js', array('jquery'));
		wp_enqueue_script( 'ish-imagesloaded' );

		wp_register_script( 'ish-scrollTo-js', IYB_HTML_URI_JS . '/vendor/jquery.scrollTo-1.4.3.1-min.js', array('jquery'));
		wp_enqueue_script( 'ish-scrollTo-js' );

		wp_register_script( 'ish-fancybox', IYB_HTML_URI_JS . '/vendor/jquery.fancybox.pack.js', array('jquery'), null, true );
		wp_enqueue_script( 'ish-fancybox' );

		wp_register_style( 'ish-fancybox', IYB_HTML_URI_CSS . '/plugins/jquery.fancybox.css' );
		wp_enqueue_style( 'ish-fancybox' );

		/* Using a modified version. Check comment in file. */
		wp_register_script( 'ish-tooltipster', IYB_HTML_URI_JS . '/vendor/ish_jquery.tooltipster.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'ish-tooltipster' );

		//wp_register_script( 'ish-easy_pie_chart', IYB_HTML_URI_JS . '/vendor/jquery.easy-pie-chart.js', array('jquery'), null, true );
		//wp_enqueue_script( 'easy_pie_chart' );

		wp_register_script( 'backgroundpos', IYB_HTML_URI_JS . '/vendor/jquery.backgroundpos.min.js', array('jquery'), null, true );
		//wp_enqueue_script( 'jquery.backgroundpos.min' );

		wp_register_script( 'parallax', IYB_HTML_URI_JS . '/vendor/jquery.parallax-1.1.3.js', array('jquery'), null, true );
		//wp_enqueue_script( 'parallax' );

		wp_register_script( 'easing', IYB_HTML_URI_JS . '/vendor/jquery.easing-1.3.pack.js', array('jquery'), null, true );
		//wp_enqueue_script( 'easing' );

		// Custom ------------------------------------------------------------------------------------------------------
		do_action( 'ishyoboy_before_mainjs' );

		wp_register_script( 'ish-main', IYB_HTML_URI_JS . '/main.js', array('jquery'), null, true );
		wp_enqueue_script( 'ish-main' );

		/** Localize Scripts */
		global $php_array;
		$php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) ,
			'js_uri' => IYB_HTML_URI_JS ,
			'header_height' => ( isset( $ish_options ) && isset($ish_options['header_height'])) ? $ish_options['header_height'] : ISH_DEFAULT_HEADER_HEIGHT,
			'sticky_height' => ( isset( $ish_options ) && isset($ish_options['sticky_height'])) ? $ish_options['sticky_height'] : ISH_DEFAULT_STICKY_HEIGHT,
			'colors' => Array()
		);

		if ( isset($ish_options) ) {

			for ($i = 1; $i <= 50; $i++){
				if ( isset( $ish_options['color' . $i] ) ){
					$php_array['colors']['color' . $i] = $ish_options['color' . $i];
				}
			}

		}

		wp_localize_script( 'ish-main', 'iyb_globals', $php_array );

		do_action( 'ishyoboy_after_mainjs' );

		do_action( 'ishyoboy_enque_skinme_scripts' );

		wp_enqueue_style( 'wp-mediaelement' );

	}
}
add_action( 'wp_enqueue_scripts', 'ishyoboy_load_my_scripts' );
add_action( 'wp_enqueue_scripts', 'ishyoboy_set_javascritp_globals');


/* *********************************************************************************************************************
 * Enable thumbnail support
 */
if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails', array(
		'post'
	));

	if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		update_option('thumbnail_size_w',70);
		update_option('thumbnail_size_h',70);
		update_option('thumbnail_crop', 1);
	}

	add_image_size( 'theme-large', 1170, 9999, false );
	add_image_size( 'theme-half', 571, 9999, false );
	add_image_size( 'theme-third', 371, 9999, false );
	add_image_size( 'theme-fourth', 271, 9999, false );
	add_image_size( 'theme-thumbnail', 200, 200, true );
}

if ( ! function_exists( 'ishyoboy_image_sizes_choose' ) ) {
	function ishyoboy_image_sizes_choose( $sizes ) {
		$custom_sizes = array(
			'theme-large' => 'Theme Full',
			'theme-half' => 'Theme Half',
			'theme-third' => 'Theme Third',
			'theme-fourth' => 'Theme Fourth',
			'theme-thumbnail' => 'Theme Thumbnail'
		);
		return array_merge( $sizes, $custom_sizes );
	}
}
add_filter( 'image_size_names_choose', 'ishyoboy_image_sizes_choose' );


/* *********************************************************************************************************************
 * Comments display function
 */
$comment_index = 0;

if ( ! function_exists( 'ishyoboy_comments' ) ) {
	function ishyoboy_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		global $allowedposttags, $allowedtags, $comment_index;
		global $post;

		?>

		<?php
		// Comments counter
		$comment_index++;
		?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<span class="comment-avatar"><?php echo get_avatar($comment, $size = '70') ?><?php
				if ( ! empty( $post ) ) {
					if ( $comment->user_id === $post->post_author )
						echo '<span class="comment-author">' . __('Author') . '</span>';
				}
			?></span>
			<div class="blog-post-details">
				<h5 class="color1"><?php echo get_comment_author(); ?></h5>
				<span>on <?php echo get_comment_date(); ?></span>

				<?php $reply =  get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				<?php if ( $reply ) { ?>
					<?php echo $reply ?>
				<?php } ?>

				<?php $edit =  get_edit_comment_link(); ?>
				<?php if ( $edit ) { ?>
					<a class="comment-edit-link" href="<?php echo $edit ?>"><?php echo __( '(Edit)', 'ishyoboy' ) ?></a>
	        <?php } ?>

				<?php if ($comment->comment_approved == '0') : ?>
					<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'ishyoboy') ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text() ?>
			</div>
		</li>
	<?php
	}
}


/* *********************************************************************************************************************
 * Filter comment
 */
if ( ! function_exists( 'ishyoboy_filter_comment' ) ) {
	function ishyoboy_filter_comment( $comment ){
		//return strip_tags( $comment , html_entity_decode(allowed_tags()) );
		return $comment;
	}
}
add_filter('comment_text', 'ishyoboy_filter_comment');


/* *********************************************************************************************************************
 * Comment form
 */
if ( ! function_exists( 'ishyoboy_comment_form' ) ) {
	function ishyoboy_comment_form( $args = array(), $post_id = null ) {
		global $id;

		if ( null === $post_id )
			$post_id = $id;
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$fields =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'ishyoboy' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'ishyoboy' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'ishyoboy' ) . '</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'ishyoboy' ), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'ishyoboy' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'ishyoboy' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_form'           => 'form',
			'class_submit'         => 'submit',
			'title_reply'          => __( 'Leave a Reply', 'ishyoboy' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'ishyoboy' ),
			'cancel_reply_link'    => __( 'Cancel reply', 'ishyoboy' ),
			'label_submit'         => __( 'Post Comment', 'ishyoboy' ),
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<h2 class="ic"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></h2>
			<p><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></p>
			<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
				<?php echo $args['must_log_in']; ?>
				<?php do_action( 'comment_form_must_log_in_after' ); ?>
			<?php else : ?>
				<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="<?php echo esc_attr( $args['class_form'] ); ?>">
					<?php do_action( 'comment_form_top' ); ?>
					<?php if ( is_user_logged_in() ) : ?>
						<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
						<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
					<?php else : ?>
						<div class="ish-grid4">
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						</div>
					<?php endif; ?>

					<?php if ( !is_user_logged_in() ) : ?>
					<div class="ish-grid8">
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>

						<?php if ( !is_user_logged_in() ) : ?>
						<div>
							<?php else : ?>
							<div>
								<?php endif; ?>
								<?php echo $args['submit_button_before']; ?>
								<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" class="<?php echo esc_attr( $args['class_submit'] ); ?>" />
								<?php echo $args['submit_button_after']; ?>
							</div>
							<?php comment_id_fields( $post_id ); ?>

							<?php echo $args['comment_notes_after']; ?>
							<?php do_action( 'comment_form', $post_id ); ?>
							<?php if ( !is_user_logged_in() ) : ?>
						</div>
					<?php endif; ?>
				</form>
			<?php endif; ?>
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
	}
}


/**
 * Change the default setting for comments on Pages. Make them closed by default.
 */
if ( ! function_exists( 'ishyoboy_default_content_page' ) ) {
	function ishyoboy_default_content_page( $post_content, $post ) {
		if( $post->post_type )
			switch( $post->post_type ) {
				case 'page':
					//$post->comment_status = 'closed';
					break;
			}
		return $post_content;
	}
}
add_filter( 'default_content', 'ishyoboy_default_content_page', 10, 2 );


/* *********************************************************************************************************************
 * Slideshow/Image print
 */
if ( !function_exists( 'ishyoboy_slideshow' ) ) {
	function ishyoboy_slideshow($postid, $imagesize, $type = '', $fancybox = false) {
		$loader = 'ajax-loader.gif';
		$thumbid = 0;

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if ( 'slideshow' != $type ){
			// IMAGE ONLY
			if( !empty($attachments) ) {
				$i = 0;
				$count = count($attachments);
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$description = $attachment->post_content;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					//if ($caption) { echo "<h3 class='caption'>$caption</h3>"; }
					echo "<div>";

					if ($fancybox){
						$img_details = wp_get_attachment_image_src( $attachment->ID, 'full' );
						echo '<a href="' . esc_attr($img_details[0]) . '" rel="portfolio-box-' . $postid . '" class="openfancybox-image">';
					}

					echo "<img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' class='mask'/>";

					if ($fancybox){
						echo '</a>';
					}

					echo "</div>\n";
					//echo "<p>$description</p>";
					if ( $count > 1 ){
						echo "<div class='divider'></div>\n";
					}

					$i++;
				}
			}
			else{
				echo '<div>';

				if ($fancybox){
					$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'full' );
					echo '<a href="' . esc_attr($img_details[0]) . '" class="openfancybox-image">';
				}

				the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );

				if ($fancybox){
					echo '</a>';
				}

				echo "</div>\n";
			}
		}
		else {
			// SLIDESHOW
			echo "<div class='slides'><div class='slides_container'>\n";

			if( !empty($attachments) ) {
				$i = 0;
				foreach( $attachments as $attachment ) {

					// SKIP OUT THE FAETURED IMAGE
					//if( $attachment->ID == $thumbid ) continue;

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					echo "<div>";

					if ($fancybox){
						$img_details = wp_get_attachment_image_src( $attachment->ID, 'full' );
						echo '<a href="' . esc_attr($img_details[0]) . '" rel="portfolio-box-' . $postid . '" class="openfancybox-image">';
					}

					echo "<img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' />";
					if ($caption) { echo "<h3 class='caption'>$caption</h3>"; }

					if ($fancybox){
						echo '</a>';
					}

					echo "</div>\n";

					$i++;
				}
			}
			else{
				echo '<div>';
				the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				echo "</div>\n";

			}

			echo "</div></div>\n";

		}
	}
}


/* *********************************************************************************************************************
 * Get slideshow
 */
if ( ! function_exists( 'ishyoboy_get_slideshow' ) ) {
	function ishyoboy_get_slideshow($postid, $imagesize, $type = '', $fancybox = false) {
		$loader = 'ajax-loader.gif';
		$thumbid = 0;

		$return = '';

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if ( 'slideshow' != $type ){
			// IMAGE ONLY
			if( !empty($attachments) ) {
				$i = 0;
				$count = count($attachments);
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$description = $attachment->post_content;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					//if ($caption) { $return .= "<h3 class='caption'>$caption</h3>"; }
					$return .= "<div><img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' class='mask'/></div>\n";
					//$return .= "<p>$description</p>";
					if ( $count > 1 ){
						$return .= "<div class='divider'></div>\n";
					}

					$i++;
				}
			}
			else{
				$return .= '<div>';
				$return .= get_the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				$return .= "</div>\n";
			}

		}
		else {
			// SLIDESHOW
			$return .= "<div class='slides'><div class='slides_container'>\n";

			if( !empty($attachments) ) {
				$i = 0;
				foreach( $attachments as $attachment ) {

					// SKIP OUT THE FAETURED IMAGE
					//if( $attachment->ID == $thumbid ) continue;

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					$return .= "<div><img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' />";
					if ($caption) { $return .= "<h3 class='caption'>$caption</h3>"; }
					$return .= "</div>\n";

					$i++;
				}
			}
			else{
				$return .= '<div>';
				$return .= get_the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				$return .= "</div>\n";

			}
			$return .= "</div></div>\n";
		}

		return $return;
	}
}


/* *********************************************************************************************************************
 * Portfolio overview attachment images print
 */
if ( !function_exists( 'ishyoboy_portfolio_post_fancybox_images' ) ) {
	function ishyoboy_portfolio_post_fancybox_images($postid, $imagesize) {
		$thumbid = 0;

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if( !empty($attachments) ) {
			foreach( $attachments as $attachment ) {

				// SKIP OUT THE FAETURED IMAGE
				if( $attachment->ID == $thumbid ) continue;

				$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
				echo "<a href='" . esc_attr($details[0]) . "' rel='portfolio-box-" . $postid . "' class='openfancybox-image'></a>\n";
			}
		}

	}
}


/* *********************************************************************************************************************
 * Portfolio fancybox images
 */
if ( ! function_exists( 'ishyoboy_get_portfolio_post_fancybox_images' ) ) {
	function ishyoboy_get_portfolio_post_fancybox_images($postid, $imagesize) {
		$thumbid = 0;

		$return = '';

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if( !empty($attachments) ) {
			foreach( $attachments as $attachment ) {

				// SKIP OUT THE FAETURED IMAGE
				if( $attachment->ID == $thumbid ) continue;

				$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
				$return .= "<a href='" . esc_attr($details[0]) . "' rel='portfolio-box-" . $postid . "' class='openfancybox-image'></a>\n";
			}
		}

		return $return;
	}
}


/* *********************************************************************************************************************
 * Posts icons
 */
if ( ! function_exists( 'ishyoboy_post_icon' ) ) {
	function ishyoboy_post_icon($type){
		switch ($type){
			case 'audio' :
				return 'icon-music';
				break;
			case 'video' :
				return 'icon-video';
				break;
			case 'gallery' :
				return 'icon-th-large';
				break;
			case 'filter' :
				return 'icon-th-large';
				break;
			case 'image' :
				return 'icon-picture';
				break;
			case 'aside' :
				return 'icon-align-right';
				break;
			case 'link' :
				return 'icon-link';
				break;
			case 'quote' :
				return 'icon-comment-alt';
				break;
			case 'status' :
				return 'icon-edit';
				break;
			case 'chat' :
				return 'icon-comments-alt';
				break;
			default :
				return 'icon-align-left';
		}
	}
}


/* *********************************************************************************************************************
 * Pagination function
 */
if ( ! function_exists( 'ishyoboy_pagination' ) ) {
	function ishyoboy_pagination($pages = '', $range = 2) {

		$showitems = ($range * 2)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if( '' == $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if ( !$pages ) {
				$pages = 1;
			}
		}

		if( 1 != $pages ) {
			echo "<div class='ish-pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) echo "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class='current ish-sc_button ish-color1 ish-text-color3'>".$i."</span>":"<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($pages)."'>&raquo;</a>";
			echo "</div>\n";
		}

	}
}


/* *********************************************************************************************************************
 * Get pagination
 */
if ( ! function_exists( 'ishyoboy_get_pagination' ) ) {
	function ishyoboy_get_pagination($pages = '', $range = 2, $maxpages = 0, $paged = 1) {

		$showitems = ($range * 2)+1;

		if( '' == $pages ) {
			$pages = $maxpages;

			if ( !$pages ) {
				$pages = 1;
			}
		}

		$return = '';

		if( 1 != $pages ) {
			$return .= "<div class='ish-pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $return .= "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) $return .= "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$return .= ($paged == $i)? "<span class='current ish-sc_button ish-color1 ish-text-color3'>".$i."</span>":"<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			if ($paged < $pages && $showitems < $pages) $return .= "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $return .= "<a class='ish-sc_button ish-color2 ish-text-color3' href='".get_pagenum_link($pages)."'>&raquo;</a>";
			$return .= "</div>\n";
		}

		return $return;
	}
}


/* *********************************************************************************************************************
 * Load font setting
 */
if ( ! function_exists( 'ishyoboy_load_font_settings' ) ) {
	function ishyoboy_load_font_settings($position, $data){
		global $ish_fonts;

		// SET FONT TYPE
		if ( isset( $data[$position . '_use_google_font']) ){
			if ( '1' == $data[$position . '_use_google_font'] ){
				// GOOGLE
				$ish_fonts[$position]['type'] = 'google';
			}
			else{
				// REGULAR
				$ish_fonts[$position]['type'] = 'regular';
			}
		}

		// SET FONT NAME
		if ( isset( $data[$position . '_' . $ish_fonts[$position]['type']]) ){
			$ish_fonts[$position]['name'] = $data[$position . '_' . $ish_fonts[$position]['type']];
		}

		// SET FONT CSS OUTPUT STRING
		$ish_fonts[$position]['css_string'] = $ish_fonts[$position]['name'];
		if ( 'palatino' == $ish_fonts[$position]['name'] ){
			$ish_fonts[$position]['css_string'] = "Palatino Linotype', 'Book Antiqua', 'Palatino";
		}

		// SET FONT VARIANT
		if ( isset( $data[$position . '_' . $ish_fonts[$position]['type'] . '_variant']) ){
			$ish_fonts[$position]['variant'] = $data[$position . '_' . $ish_fonts[$position]['type'] . '_variant'];
		}

		// SET FONT SIZE
		if ( isset( $data[$position . '_size']) ){
			$ish_fonts[$position]['size'] = $data[$position . '_size'];
		}

		// SET FONT SIZE
		if ( isset( $data[$position . '_line_height']) ){
			$ish_fonts[$position]['line_height'] = $data[$position . '_line_height'];
		}
	}
}


/* *********************************************************************************************************************
 * Google font settings
 */
if ( ! function_exists( 'ishyoboy_google_fonts_setup' ) ) {
	function ishyoboy_google_fonts_setup() {
		global $ish_fonts, $ish_options;

		// FONT SETTINGS
		ishyoboy_load_font_settings('body_font', $ish_options);
		ishyoboy_load_font_settings('body_font_2', $ish_options);
		ishyoboy_load_font_settings('header_font', $ish_options);
		ishyoboy_load_font_settings('h1_font', $ish_options);
		ishyoboy_load_font_settings('h2_font', $ish_options);
		ishyoboy_load_font_settings('h3_font', $ish_options);
		ishyoboy_load_font_settings('h4_font', $ish_options);
		ishyoboy_load_font_settings('h5_font', $ish_options);
		ishyoboy_load_font_settings('h6_font', $ish_options);

		// CREATE A LIST OF GOOGLE FONTS TO LOAD
		$load = array();
		foreach ($ish_fonts as $position => $details){
			if ( 'google' == $details['type'] ){
				if ( !isset( $load[$details['name']] ) ) { $load[$details['name']] = ''; }
				$load[$details['name']] .= '400,400italic,regular,italic,700,700italic,' . $details['variant'] . ',';
			}
		}

		$protocol = is_ssl() ? 'https' : 'http';

		// LOAD THE FONTS
		$i = 0;
		foreach ($load as $font => $variants){
			$i++;
			wp_enqueue_style( THEME_SLUG . '-google-font-' . $i, "$protocol://fonts.googleapis.com/css?family=" . rawurlencode( $font ) . ':' . rawurlencode( $variants ) );
		}
	}
}
add_action('wp_enqueue_scripts', 'ishyoboy_google_fonts_setup');
add_action('admin_enqueue_scripts', 'ishyoboy_google_fonts_setup');


/* *********************************************************************************************************************
 * Google fonts variants
 */
if ( ! function_exists( 'ishyoboy_google_variants' ) ) {
	function ishyoboy_google_variants( $family ){
		$googleFonts = json_decode(ishyoboy_get_google_fonts());

		foreach ($googleFonts as $key => $details) {
			if ( $family == $details->family){
				$googleVariantsArray = array();
				foreach ($details->variants as $variant) {
					$googleVariantsArray[$variant] = $variant;
				}
				return $googleVariantsArray;
			}
		}

		return array();
	}
}

/* *********************************************************************************************************************
 * Custom styles
 */
if ( ! function_exists('ishyoboy_custom_styles') ) {
	function ishyoboy_custom_styles() {

		global $ish_options, $ish_fonts, $current_colors;

		echo '<style type="text/css">';

		global $smof_wpml_prefix;

		$uploads = wp_upload_dir();
		$uploads_dir = trailingslashit( $uploads['basedir'] ) . THEME_SLUG . '_css';


		// Output the dynamic.css into the body if not generated or if it should be ignored
		if ( defined( 'ISH_GENERATE_DYNAMIC_CSS' ) && false == ISH_GENERATE_DYNAMIC_CSS ){
			$newdata = $ish_options;

			for ( $inc_i = 0; $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < IYB_COLORS_COUNT ; $inc_i++ ){
				$ISH_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;
				include( locate_template( 'assets/framework/wp/dynamic_css/dynamic_css.php' ) );
				echo '</style><style type="text/css">';
			}

		}
		else{
			if ( ! file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '.css' ) ){
				// FILE DOES NOT EXIST
				$newdata = $ish_options;
				// FALLBACK IF MAIN OPTIONS DO NOT EXIST
				for ( $inc_i = 0; $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < IYB_COLORS_COUNT ; $inc_i++ ){
					$ISH_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISH_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;
					include( locate_template( 'assets/framework/wp/dynamic_css/dynamic_css.php' ) );
					echo '</style><style type="text/css">';
				}
			}
		}

		$header_height = ( isset( $ish_options ) && isset( $ish_options['header_height'] ) ) ? $ish_options['header_height'] : ISH_DEFAULT_HEADER_HEIGHT;

		// Sticky nav position if admin bar is visible
		if ( is_admin_bar_showing() ) {
			echo "\n";
			echo '.ish-sticky-on .ish-part_header, .ish-sidenav { top: 32px; }';
			echo '.ish-sidenav { padding-bottom: 52px; }';
			echo "\n";

			?>

			/* WP Admin bar fix ***********************************************************************************************/
			@media all and ( max-width: 782px ) {
				.ish-sticky-on .ish-part_header { top: 46px !important; }
			}
			@media all and ( max-width: 600px ) {
				.ish-sticky-on .ish-part_header { top: 0 !important; z-index: 501; } .ish-sticky-on .ish-body { padding-top: <?php echo ($header_height - 46); ?>px !important; }
			}

			<?php
		}

		// Add custom user CSS
		$css = ( isset( $ish_options['custom_css'] ) ) ? trim( $ish_options['custom_css'] ) : '';
		if ( '' != $css ){
			echo "\n" . $css . "\n";
		}

		echo '</style>' . "\n";

	}
}
add_action('wp_head', 'ishyoboy_custom_styles');


/* *********************************************************************************************************************
 * Custom scripts
 */
if ( !function_exists('ishyoboy_custom_scripts') ) {
	function ishyoboy_custom_scripts() {

		global $ish_options;
		if ( isset( $ish_options['custom_scripts'] ) ) {
			echo trim( $ish_options['custom_scripts'] );
		}

	}
}
add_action('wp_footer', 'ishyoboy_custom_scripts');


/* *********************************************************************************************************************
 * Register required plugins
 */
if ( is_admin() ) {

	if ( ! function_exists( 'ishyoboy_register_required_plugins' ) ) {
		function ishyoboy_register_required_plugins() {

			/**
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(

				// REQUIRED PLUGINS
				array(
					'name'     => 'Contact Form 7',
					'slug'     => 'contact-form-7',
					'required' => true,
					'force_activation' => false,
					'force_deactivation' => false,
				),

				array(
					'name'               => 'IshYoBoy Boldial Assets', // The plugin name.
					'slug'               => 'ishyoboy-boldial-assets', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/assets/framework/wp/includes/ishyoboy-boldial-assets.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					//'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => 'http://ishyoboy.com/', // If set, overrides default API URL and points to an external URL.
				),

			);


			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'default_path' => '',                      // Default absolute path to pre-packaged plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
				'strings'      => array(
					'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
					'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
					'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
					'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
					'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
					'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
					'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
					'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
					'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				)
			);
			tgmpa( $plugins, $config );
		}
	}
	add_action('tgmpa_register', 'ishyoboy_register_required_plugins');
}


if ( ! function_exists( 'ishyoboy_the_content' ) ) {
	function ishyoboy_the_content(){

		$content = apply_filters( 'the_content', get_the_content() );
		echo apply_filters( 'ish_the_content', $content );

	}
}

/* *********************************************************************************************************************
 *
 */
if ( ! function_exists( 'remove_page_from_query_string' ) ) {
	function remove_page_from_query_string($query_string)
	{
		global $wp_rewrite;
		//var_dump($query_string);

		if ( isset( $query_string['page'] ) && isset( $query_string['name'] ) && $wp_rewrite->pagination_base == $query_string['name']) {

			//var_dump($query_string);

			// Get post type object and page index
			$post_type = get_post_type_object( $query_string['post_type'] );
			list($page_index) = explode('/', $query_string['page']);

			// Reset query string
			$query_string = array();

			// Set page and page index
			$query_string['pagename'] = $post_type->rewrite['slug'];
			$query_string['paged'] = $page_index;

			//var_dump($query_string);

			// Catgeory  ["category_name"]=> string(9) "lifestyle"
			// Tag array(1) { ["tag"]=> string(9) "free-time" }

		}

		return $query_string;

	}
}
add_filter('request', 'remove_page_from_query_string');


/* *********************************************************************************************************************
 * Change post-type
 */
function ishyoboy_change_posttype() {
	global $wp_query;
	if( is_archive() && is_paged() && !is_admin() && ( !function_exists('is_woocommerce') || !is_woocommerce() ) ) {
		set_query_var( 'post_type', array( 'post', 'portfolio-post' ) );
	}
	return;
}
add_action( 'parse_query', 'ishyoboy_change_posttype' );

$option_posts_per_page = get_option( 'posts_per_page' );

add_action( 'init', 'ishyoboy_modify_posts_per_page', 0);
function ishyoboy_modify_posts_per_page() {
	add_filter( 'option_posts_per_page', 'ishyoboy_option_posts_per_page' );
}


/* *********************************************************************************************************************
 * Posts per page
 */
function ishyoboy_option_posts_per_page( $value ) {
	global $option_posts_per_page, $ish_options, $wp_query;

	if ( is_tax( 'portfolio-category') ) {

		if ( isset($ish_options['portfolio_per_page']) && !empty($ish_options['portfolio_per_page']) ){
			return $ish_options['portfolio_per_page'];
		}
		else{
			return $option_posts_per_page;
		}

	}
	elseif ( is_search() ){
		return 10;
	}
	elseif (function_exists('is_shop') && ( ( is_page() && get_query_var('page_id') == woocommerce_get_page_id( 'shop' ) ) || ( get_query_var('post_type') == 'product' ) || ( is_tax('product_cat') ) || ( is_tax('product_tag') ) ) ) {

		if ( isset($ish_options['woocommerce_posts_per_page']) && !empty($ish_options['woocommerce_posts_per_page']) ){
			return $ish_options['woocommerce_posts_per_page'];
		}
		else{
			return $option_posts_per_page;
		}
	}
	else {
		return $option_posts_per_page;
	}
}


/* *********************************************************************************************************************
 * Pages Excerpt
 */
add_action( 'init' ,  'ishyoboy_add_page_excerpt' );
if ( ! function_exists( 'ishyoboy_add_page_excerpt' ) ) {
	function ishyoboy_add_page_excerpt() {
		add_post_type_support( 'page', 'excerpt' );
	}
}

/* *********************************************************************************************************************
 * IshYoBoy title
 */
if ( ! function_exists( 'ishyoboy_title' ) ) {
	function ishyoboy_title(){

		if ( !ishyoboy_seo_plugin_active() ){
			$separator = stripslashes(get_option('ishyoboy_separator'));
			if ( !$separator ) $separator = '|';

			if ( is_front_page() ) {
				bloginfo('name');
				echo " $separator ";
				bloginfo('description');
			}
			else if ( is_single() or is_page() or is_home() ){
				bloginfo('name');
				wp_title($separator , true, '');
			}
			else if ( is_404() ){
				bloginfo('name');
				echo " $separator ";
				_e('404 error - page not found', 'ishyoboy');
			} else{
				bloginfo('name');
				wp_title($separator, true, '');
				echo " $separator ";
				bloginfo('description');
			}
		}
		else{
			wp_title();
		}

	}
}


/* *********************************************************************************************************************
 * ishYoBoy hex2rgb
 */
if ( ! function_exists( 'ishyoboy_hex2rgb' ) ) {
	function ishyoboy_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(", ", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}


/* *********************************************************************************************************************
 * Get term parents
 */
if ( ! function_exists( 'get_term_parents' ) ) {
	function get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';

		$parent = get_term( $id, $taxonomy );
		if ( is_wp_error( $parent ) )
			return $parent;

		if ( $nicename )
			$name = $parent->slug;
		else
			$name = $parent->name;

		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
		}

		if ( $link )
			$chain .= '<a href="' . get_term_link( $parent->slug, $taxonomy ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'ishyoboy' ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
		else
			$chain .= $name.$separator;

		return $chain;
	}
}


/* *********************************************************************************************************************
 * Get page parent
 */
if ( ! function_exists( 'get_page_parents' ) ) {
	function get_page_parents( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';

		$parent = get_post($id);

		if ( is_wp_error( $parent ) )
			return $parent;

		if ( $nicename )
			$name = $parent->post_name;
		else
			$name = $parent->post_title;

		if ( $parent->post_parent && !in_array( $parent->post_parent, $visited ) ) {
			$visited[] = $parent->post_parent;
			$chain .= get_page_parents( $parent->post_parent, $link, $separator, $nicename, $visited );
		}

		if ( $link )
			$chain .= '<a href="' . get_page_link( $parent->ID ) . '" title="' . esc_attr( sprintf( __( 'View %s page', 'ishyoboy' ), $parent->post_title ) ) . '">'.$name.'</a>' . $separator;
		else
			$chain .= $name.$separator;

		return $chain;
	}
}


/* *********************************************************************************************************************
 * Get google fonts
 */
if ( ! function_exists( 'ishyoboy_get_google_fonts' ) ) {
	function ishyoboy_get_google_fonts(){
		return '{"ABeeZee":{"family":"ABeeZee","variants":["regular","italic"]},"Abel":{"family":"Abel","variants":["regular"]},"Abril Fatface":{"family":"Abril Fatface","variants":["regular"]},"Aclonica":{"family":"Aclonica","variants":["regular"]},"Acme":{"family":"Acme","variants":["regular"]},"Actor":{"family":"Actor","variants":["regular"]},"Adamina":{"family":"Adamina","variants":["regular"]},"Advent Pro":{"family":"Advent Pro","variants":["100","200","300","regular","500","600","700"]},"Aguafina Script":{"family":"Aguafina Script","variants":["regular"]},"Akronim":{"family":"Akronim","variants":["regular"]},"Aladin":{"family":"Aladin","variants":["regular"]},"Aldrich":{"family":"Aldrich","variants":["regular"]},"Alef":{"family":"Alef","variants":["regular","700"]},"Alegreya":{"family":"Alegreya","variants":["regular","italic","700","700italic","900","900italic"]},"Alegreya SC":{"family":"Alegreya SC","variants":["regular","italic","700","700italic","900","900italic"]},"Alegreya Sans":{"family":"Alegreya Sans","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},"Alegreya Sans SC":{"family":"Alegreya Sans SC","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},"Alex Brush":{"family":"Alex Brush","variants":["regular"]},"Alfa Slab One":{"family":"Alfa Slab One","variants":["regular"]},"Alice":{"family":"Alice","variants":["regular"]},"Alike":{"family":"Alike","variants":["regular"]},"Alike Angular":{"family":"Alike Angular","variants":["regular"]},"Allan":{"family":"Allan","variants":["regular","700"]},"Allerta":{"family":"Allerta","variants":["regular"]},"Allerta Stencil":{"family":"Allerta Stencil","variants":["regular"]},"Allura":{"family":"Allura","variants":["regular"]},"Almendra":{"family":"Almendra","variants":["regular","italic","700","700italic"]},"Almendra Display":{"family":"Almendra Display","variants":["regular"]},"Almendra SC":{"family":"Almendra SC","variants":["regular"]},"Amarante":{"family":"Amarante","variants":["regular"]},"Amaranth":{"family":"Amaranth","variants":["regular","italic","700","700italic"]},"Amatic SC":{"family":"Amatic SC","variants":["regular","700"]},"Amethysta":{"family":"Amethysta","variants":["regular"]},"Anaheim":{"family":"Anaheim","variants":["regular"]},"Andada":{"family":"Andada","variants":["regular"]},"Andika":{"family":"Andika","variants":["regular"]},"Angkor":{"family":"Angkor","variants":["regular"]},"Annie Use Your Telescope":{"family":"Annie Use Your Telescope","variants":["regular"]},"Anonymous Pro":{"family":"Anonymous Pro","variants":["regular","italic","700","700italic"]},"Antic":{"family":"Antic","variants":["regular"]},"Antic Didone":{"family":"Antic Didone","variants":["regular"]},"Antic Slab":{"family":"Antic Slab","variants":["regular"]},"Anton":{"family":"Anton","variants":["regular"]},"Arapey":{"family":"Arapey","variants":["regular","italic"]},"Arbutus":{"family":"Arbutus","variants":["regular"]},"Arbutus Slab":{"family":"Arbutus Slab","variants":["regular"]},"Architects Daughter":{"family":"Architects Daughter","variants":["regular"]},"Archivo Black":{"family":"Archivo Black","variants":["regular"]},"Archivo Narrow":{"family":"Archivo Narrow","variants":["regular","italic","700","700italic"]},"Arimo":{"family":"Arimo","variants":["regular","italic","700","700italic"]},"Arizonia":{"family":"Arizonia","variants":["regular"]},"Armata":{"family":"Armata","variants":["regular"]},"Artifika":{"family":"Artifika","variants":["regular"]},"Arvo":{"family":"Arvo","variants":["regular","italic","700","700italic"]},"Asap":{"family":"Asap","variants":["regular","italic","700","700italic"]},"Asset":{"family":"Asset","variants":["regular"]},"Astloch":{"family":"Astloch","variants":["regular","700"]},"Asul":{"family":"Asul","variants":["regular","700"]},"Atomic Age":{"family":"Atomic Age","variants":["regular"]},"Aubrey":{"family":"Aubrey","variants":["regular"]},"Audiowide":{"family":"Audiowide","variants":["regular"]},"Autour One":{"family":"Autour One","variants":["regular"]},"Average":{"family":"Average","variants":["regular"]},"Average Sans":{"family":"Average Sans","variants":["regular"]},"Averia Gruesa Libre":{"family":"Averia Gruesa Libre","variants":["regular"]},"Averia Libre":{"family":"Averia Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Averia Sans Libre":{"family":"Averia Sans Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Averia Serif Libre":{"family":"Averia Serif Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Bad Script":{"family":"Bad Script","variants":["regular"]},"Balthazar":{"family":"Balthazar","variants":["regular"]},"Bangers":{"family":"Bangers","variants":["regular"]},"Basic":{"family":"Basic","variants":["regular"]},"Battambang":{"family":"Battambang","variants":["regular","700"]},"Baumans":{"family":"Baumans","variants":["regular"]},"Bayon":{"family":"Bayon","variants":["regular"]},"Belgrano":{"family":"Belgrano","variants":["regular"]},"Belleza":{"family":"Belleza","variants":["regular"]},"BenchNine":{"family":"BenchNine","variants":["300","regular","700"]},"Bentham":{"family":"Bentham","variants":["regular"]},"Berkshire Swash":{"family":"Berkshire Swash","variants":["regular"]},"Bevan":{"family":"Bevan","variants":["regular"]},"Bigelow Rules":{"family":"Bigelow Rules","variants":["regular"]},"Bigshot One":{"family":"Bigshot One","variants":["regular"]},"Bilbo":{"family":"Bilbo","variants":["regular"]},"Bilbo Swash Caps":{"family":"Bilbo Swash Caps","variants":["regular"]},"Bitter":{"family":"Bitter","variants":["regular","italic","700"]},"Black Ops One":{"family":"Black Ops One","variants":["regular"]},"Bokor":{"family":"Bokor","variants":["regular"]},"Bonbon":{"family":"Bonbon","variants":["regular"]},"Boogaloo":{"family":"Boogaloo","variants":["regular"]},"Bowlby One":{"family":"Bowlby One","variants":["regular"]},"Bowlby One SC":{"family":"Bowlby One SC","variants":["regular"]},"Brawler":{"family":"Brawler","variants":["regular"]},"Bree Serif":{"family":"Bree Serif","variants":["regular"]},"Bubblegum Sans":{"family":"Bubblegum Sans","variants":["regular"]},"Bubbler One":{"family":"Bubbler One","variants":["regular"]},"Buda":{"family":"Buda","variants":["300"]},"Buenard":{"family":"Buenard","variants":["regular","700"]},"Butcherman":{"family":"Butcherman","variants":["regular"]},"Butterfly Kids":{"family":"Butterfly Kids","variants":["regular"]},"Cabin":{"family":"Cabin","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},"Cabin Condensed":{"family":"Cabin Condensed","variants":["regular","500","600","700"]},"Cabin Sketch":{"family":"Cabin Sketch","variants":["regular","700"]},"Caesar Dressing":{"family":"Caesar Dressing","variants":["regular"]},"Cagliostro":{"family":"Cagliostro","variants":["regular"]},"Calligraffitti":{"family":"Calligraffitti","variants":["regular"]},"Cambo":{"family":"Cambo","variants":["regular"]},"Candal":{"family":"Candal","variants":["regular"]},"Cantarell":{"family":"Cantarell","variants":["regular","italic","700","700italic"]},"Cantata One":{"family":"Cantata One","variants":["regular"]},"Cantora One":{"family":"Cantora One","variants":["regular"]},"Capriola":{"family":"Capriola","variants":["regular"]},"Cardo":{"family":"Cardo","variants":["regular","italic","700"]},"Carme":{"family":"Carme","variants":["regular"]},"Carrois Gothic":{"family":"Carrois Gothic","variants":["regular"]},"Carrois Gothic SC":{"family":"Carrois Gothic SC","variants":["regular"]},"Carter One":{"family":"Carter One","variants":["regular"]},"Caudex":{"family":"Caudex","variants":["regular","italic","700","700italic"]},"Cedarville Cursive":{"family":"Cedarville Cursive","variants":["regular"]},"Ceviche One":{"family":"Ceviche One","variants":["regular"]},"Changa One":{"family":"Changa One","variants":["regular","italic"]},"Chango":{"family":"Chango","variants":["regular"]},"Chau Philomene One":{"family":"Chau Philomene One","variants":["regular","italic"]},"Chela One":{"family":"Chela One","variants":["regular"]},"Chelsea Market":{"family":"Chelsea Market","variants":["regular"]},"Chenla":{"family":"Chenla","variants":["regular"]},"Cherry Cream Soda":{"family":"Cherry Cream Soda","variants":["regular"]},"Cherry Swash":{"family":"Cherry Swash","variants":["regular","700"]},"Chewy":{"family":"Chewy","variants":["regular"]},"Chicle":{"family":"Chicle","variants":["regular"]},"Chivo":{"family":"Chivo","variants":["regular","italic","900","900italic"]},"Cinzel":{"family":"Cinzel","variants":["regular","700","900"]},"Cinzel Decorative":{"family":"Cinzel Decorative","variants":["regular","700","900"]},"Clicker Script":{"family":"Clicker Script","variants":["regular"]},"Coda":{"family":"Coda","variants":["regular","800"]},"Coda Caption":{"family":"Coda Caption","variants":["800"]},"Codystar":{"family":"Codystar","variants":["300","regular"]},"Combo":{"family":"Combo","variants":["regular"]},"Comfortaa":{"family":"Comfortaa","variants":["300","regular","700"]},"Coming Soon":{"family":"Coming Soon","variants":["regular"]},"Concert One":{"family":"Concert One","variants":["regular"]},"Condiment":{"family":"Condiment","variants":["regular"]},"Content":{"family":"Content","variants":["regular","700"]},"Contrail One":{"family":"Contrail One","variants":["regular"]},"Convergence":{"family":"Convergence","variants":["regular"]},"Cookie":{"family":"Cookie","variants":["regular"]},"Copse":{"family":"Copse","variants":["regular"]},"Corben":{"family":"Corben","variants":["regular","700"]},"Courgette":{"family":"Courgette","variants":["regular"]},"Cousine":{"family":"Cousine","variants":["regular","italic","700","700italic"]},"Coustard":{"family":"Coustard","variants":["regular","900"]},"Covered By Your Grace":{"family":"Covered By Your Grace","variants":["regular"]},"Crafty Girls":{"family":"Crafty Girls","variants":["regular"]},"Creepster":{"family":"Creepster","variants":["regular"]},"Crete Round":{"family":"Crete Round","variants":["regular","italic"]},"Crimson Text":{"family":"Crimson Text","variants":["regular","italic","600","600italic","700","700italic"]},"Croissant One":{"family":"Croissant One","variants":["regular"]},"Crushed":{"family":"Crushed","variants":["regular"]},"Cuprum":{"family":"Cuprum","variants":["regular","italic","700","700italic"]},"Cutive":{"family":"Cutive","variants":["regular"]},"Cutive Mono":{"family":"Cutive Mono","variants":["regular"]},"Damion":{"family":"Damion","variants":["regular"]},"Dancing Script":{"family":"Dancing Script","variants":["regular","700"]},"Dangrek":{"family":"Dangrek","variants":["regular"]},"Dawning of a New Day":{"family":"Dawning of a New Day","variants":["regular"]},"Days One":{"family":"Days One","variants":["regular"]},"Delius":{"family":"Delius","variants":["regular"]},"Delius Swash Caps":{"family":"Delius Swash Caps","variants":["regular"]},"Delius Unicase":{"family":"Delius Unicase","variants":["regular","700"]},"Della Respira":{"family":"Della Respira","variants":["regular"]},"Denk One":{"family":"Denk One","variants":["regular"]},"Devonshire":{"family":"Devonshire","variants":["regular"]},"Didact Gothic":{"family":"Didact Gothic","variants":["regular"]},"Diplomata":{"family":"Diplomata","variants":["regular"]},"Diplomata SC":{"family":"Diplomata SC","variants":["regular"]},"Domine":{"family":"Domine","variants":["regular","700"]},"Donegal One":{"family":"Donegal One","variants":["regular"]},"Doppio One":{"family":"Doppio One","variants":["regular"]},"Dorsa":{"family":"Dorsa","variants":["regular"]},"Dosis":{"family":"Dosis","variants":["200","300","regular","500","600","700","800"]},"Dr Sugiyama":{"family":"Dr Sugiyama","variants":["regular"]},"Droid Sans":{"family":"Droid Sans","variants":["regular","700"]},"Droid Sans Mono":{"family":"Droid Sans Mono","variants":["regular"]},"Droid Serif":{"family":"Droid Serif","variants":["regular","italic","700","700italic"]},"Duru Sans":{"family":"Duru Sans","variants":["regular"]},"Dynalight":{"family":"Dynalight","variants":["regular"]},"EB Garamond":{"family":"EB Garamond","variants":["regular"]},"Eagle Lake":{"family":"Eagle Lake","variants":["regular"]},"Eater":{"family":"Eater","variants":["regular"]},"Economica":{"family":"Economica","variants":["regular","italic","700","700italic"]},"Ek Mukta":{"family":"Ek Mukta","variants":["200","300","regular","500","600","700","800"]},"Electrolize":{"family":"Electrolize","variants":["regular"]},"Elsie":{"family":"Elsie","variants":["regular","900"]},"Elsie Swash Caps":{"family":"Elsie Swash Caps","variants":["regular","900"]},"Emblema One":{"family":"Emblema One","variants":["regular"]},"Emilys Candy":{"family":"Emilys Candy","variants":["regular"]},"Engagement":{"family":"Engagement","variants":["regular"]},"Englebert":{"family":"Englebert","variants":["regular"]},"Enriqueta":{"family":"Enriqueta","variants":["regular","700"]},"Erica One":{"family":"Erica One","variants":["regular"]},"Esteban":{"family":"Esteban","variants":["regular"]},"Euphoria Script":{"family":"Euphoria Script","variants":["regular"]},"Ewert":{"family":"Ewert","variants":["regular"]},"Exo":{"family":"Exo","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Exo 2":{"family":"Exo 2","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Expletus Sans":{"family":"Expletus Sans","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},"Fanwood Text":{"family":"Fanwood Text","variants":["regular","italic"]},"Fascinate":{"family":"Fascinate","variants":["regular"]},"Fascinate Inline":{"family":"Fascinate Inline","variants":["regular"]},"Faster One":{"family":"Faster One","variants":["regular"]},"Fasthand":{"family":"Fasthand","variants":["regular"]},"Fauna One":{"family":"Fauna One","variants":["regular"]},"Federant":{"family":"Federant","variants":["regular"]},"Federo":{"family":"Federo","variants":["regular"]},"Felipa":{"family":"Felipa","variants":["regular"]},"Fenix":{"family":"Fenix","variants":["regular"]},"Finger Paint":{"family":"Finger Paint","variants":["regular"]},"Fira Mono":{"family":"Fira Mono","variants":["regular","700"]},"Fira Sans":{"family":"Fira Sans","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},"Fjalla One":{"family":"Fjalla One","variants":["regular"]},"Fjord One":{"family":"Fjord One","variants":["regular"]},"Flamenco":{"family":"Flamenco","variants":["300","regular"]},"Flavors":{"family":"Flavors","variants":["regular"]},"Fondamento":{"family":"Fondamento","variants":["regular","italic"]},"Fontdiner Swanky":{"family":"Fontdiner Swanky","variants":["regular"]},"Forum":{"family":"Forum","variants":["regular"]},"Francois One":{"family":"Francois One","variants":["regular"]},"Freckle Face":{"family":"Freckle Face","variants":["regular"]},"Fredericka the Great":{"family":"Fredericka the Great","variants":["regular"]},"Fredoka One":{"family":"Fredoka One","variants":["regular"]},"Freehand":{"family":"Freehand","variants":["regular"]},"Fresca":{"family":"Fresca","variants":["regular"]},"Frijole":{"family":"Frijole","variants":["regular"]},"Fruktur":{"family":"Fruktur","variants":["regular"]},"Fugaz One":{"family":"Fugaz One","variants":["regular"]},"GFS Didot":{"family":"GFS Didot","variants":["regular"]},"GFS Neohellenic":{"family":"GFS Neohellenic","variants":["regular","italic","700","700italic"]},"Gabriela":{"family":"Gabriela","variants":["regular"]},"Gafata":{"family":"Gafata","variants":["regular"]},"Galdeano":{"family":"Galdeano","variants":["regular"]},"Galindo":{"family":"Galindo","variants":["regular"]},"Gentium Basic":{"family":"Gentium Basic","variants":["regular","italic","700","700italic"]},"Gentium Book Basic":{"family":"Gentium Book Basic","variants":["regular","italic","700","700italic"]},"Geo":{"family":"Geo","variants":["regular","italic"]},"Geostar":{"family":"Geostar","variants":["regular"]},"Geostar Fill":{"family":"Geostar Fill","variants":["regular"]},"Germania One":{"family":"Germania One","variants":["regular"]},"Gilda Display":{"family":"Gilda Display","variants":["regular"]},"Give You Glory":{"family":"Give You Glory","variants":["regular"]},"Glass Antiqua":{"family":"Glass Antiqua","variants":["regular"]},"Glegoo":{"family":"Glegoo","variants":["regular"]},"Gloria Hallelujah":{"family":"Gloria Hallelujah","variants":["regular"]},"Goblin One":{"family":"Goblin One","variants":["regular"]},"Gochi Hand":{"family":"Gochi Hand","variants":["regular"]},"Gorditas":{"family":"Gorditas","variants":["regular","700"]},"Goudy Bookletter 1911":{"family":"Goudy Bookletter 1911","variants":["regular"]},"Graduate":{"family":"Graduate","variants":["regular"]},"Grand Hotel":{"family":"Grand Hotel","variants":["regular"]},"Gravitas One":{"family":"Gravitas One","variants":["regular"]},"Great Vibes":{"family":"Great Vibes","variants":["regular"]},"Griffy":{"family":"Griffy","variants":["regular"]},"Gruppo":{"family":"Gruppo","variants":["regular"]},"Gudea":{"family":"Gudea","variants":["regular","italic","700"]},"Habibi":{"family":"Habibi","variants":["regular"]},"Hammersmith One":{"family":"Hammersmith One","variants":["regular"]},"Hanalei":{"family":"Hanalei","variants":["regular"]},"Hanalei Fill":{"family":"Hanalei Fill","variants":["regular"]},"Handlee":{"family":"Handlee","variants":["regular"]},"Hanuman":{"family":"Hanuman","variants":["regular","700"]},"Happy Monkey":{"family":"Happy Monkey","variants":["regular"]},"Headland One":{"family":"Headland One","variants":["regular"]},"Henny Penny":{"family":"Henny Penny","variants":["regular"]},"Herr Von Muellerhoff":{"family":"Herr Von Muellerhoff","variants":["regular"]},"Holtwood One SC":{"family":"Holtwood One SC","variants":["regular"]},"Homemade Apple":{"family":"Homemade Apple","variants":["regular"]},"Homenaje":{"family":"Homenaje","variants":["regular"]},"IM Fell DW Pica":{"family":"IM Fell DW Pica","variants":["regular","italic"]},"IM Fell DW Pica SC":{"family":"IM Fell DW Pica SC","variants":["regular"]},"IM Fell Double Pica":{"family":"IM Fell Double Pica","variants":["regular","italic"]},"IM Fell Double Pica SC":{"family":"IM Fell Double Pica SC","variants":["regular"]},"IM Fell English":{"family":"IM Fell English","variants":["regular","italic"]},"IM Fell English SC":{"family":"IM Fell English SC","variants":["regular"]},"IM Fell French Canon":{"family":"IM Fell French Canon","variants":["regular","italic"]},"IM Fell French Canon SC":{"family":"IM Fell French Canon SC","variants":["regular"]},"IM Fell Great Primer":{"family":"IM Fell Great Primer","variants":["regular","italic"]},"IM Fell Great Primer SC":{"family":"IM Fell Great Primer SC","variants":["regular"]},"Iceberg":{"family":"Iceberg","variants":["regular"]},"Iceland":{"family":"Iceland","variants":["regular"]},"Imprima":{"family":"Imprima","variants":["regular"]},"Inconsolata":{"family":"Inconsolata","variants":["regular","700"]},"Inder":{"family":"Inder","variants":["regular"]},"Indie Flower":{"family":"Indie Flower","variants":["regular"]},"Inika":{"family":"Inika","variants":["regular","700"]},"Irish Grover":{"family":"Irish Grover","variants":["regular"]},"Istok Web":{"family":"Istok Web","variants":["regular","italic","700","700italic"]},"Italiana":{"family":"Italiana","variants":["regular"]},"Italianno":{"family":"Italianno","variants":["regular"]},"Jacques Francois":{"family":"Jacques Francois","variants":["regular"]},"Jacques Francois Shadow":{"family":"Jacques Francois Shadow","variants":["regular"]},"Jim Nightshade":{"family":"Jim Nightshade","variants":["regular"]},"Jockey One":{"family":"Jockey One","variants":["regular"]},"Jolly Lodger":{"family":"Jolly Lodger","variants":["regular"]},"Josefin Sans":{"family":"Josefin Sans","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},"Josefin Slab":{"family":"Josefin Slab","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},"Joti One":{"family":"Joti One","variants":["regular"]},"Judson":{"family":"Judson","variants":["regular","italic","700"]},"Julee":{"family":"Julee","variants":["regular"]},"Julius Sans One":{"family":"Julius Sans One","variants":["regular"]},"Junge":{"family":"Junge","variants":["regular"]},"Jura":{"family":"Jura","variants":["300","regular","500","600"]},"Just Another Hand":{"family":"Just Another Hand","variants":["regular"]},"Just Me Again Down Here":{"family":"Just Me Again Down Here","variants":["regular"]},"Kameron":{"family":"Kameron","variants":["regular","700"]},"Kantumruy":{"family":"Kantumruy","variants":["300","regular","700"]},"Karla":{"family":"Karla","variants":["regular","italic","700","700italic"]},"Kaushan Script":{"family":"Kaushan Script","variants":["regular"]},"Kavoon":{"family":"Kavoon","variants":["regular"]},"Kdam Thmor":{"family":"Kdam Thmor","variants":["regular"]},"Keania One":{"family":"Keania One","variants":["regular"]},"Kelly Slab":{"family":"Kelly Slab","variants":["regular"]},"Kenia":{"family":"Kenia","variants":["regular"]},"Khmer":{"family":"Khmer","variants":["regular"]},"Kite One":{"family":"Kite One","variants":["regular"]},"Knewave":{"family":"Knewave","variants":["regular"]},"Kotta One":{"family":"Kotta One","variants":["regular"]},"Koulen":{"family":"Koulen","variants":["regular"]},"Kranky":{"family":"Kranky","variants":["regular"]},"Kreon":{"family":"Kreon","variants":["300","regular","700"]},"Kristi":{"family":"Kristi","variants":["regular"]},"Krona One":{"family":"Krona One","variants":["regular"]},"La Belle Aurore":{"family":"La Belle Aurore","variants":["regular"]},"Lancelot":{"family":"Lancelot","variants":["regular"]},"Lato":{"family":"Lato","variants":["100","100italic","300","300italic","regular","italic","700","700italic","900","900italic"]},"League Script":{"family":"League Script","variants":["regular"]},"Leckerli One":{"family":"Leckerli One","variants":["regular"]},"Ledger":{"family":"Ledger","variants":["regular"]},"Lekton":{"family":"Lekton","variants":["regular","italic","700"]},"Lemon":{"family":"Lemon","variants":["regular"]},"Libre Baskerville":{"family":"Libre Baskerville","variants":["regular","italic","700"]},"Life Savers":{"family":"Life Savers","variants":["regular","700"]},"Lilita One":{"family":"Lilita One","variants":["regular"]},"Lily Script One":{"family":"Lily Script One","variants":["regular"]},"Limelight":{"family":"Limelight","variants":["regular"]},"Linden Hill":{"family":"Linden Hill","variants":["regular","italic"]},"Lobster":{"family":"Lobster","variants":["regular"]},"Lobster Two":{"family":"Lobster Two","variants":["regular","italic","700","700italic"]},"Londrina Outline":{"family":"Londrina Outline","variants":["regular"]},"Londrina Shadow":{"family":"Londrina Shadow","variants":["regular"]},"Londrina Sketch":{"family":"Londrina Sketch","variants":["regular"]},"Londrina Solid":{"family":"Londrina Solid","variants":["regular"]},"Lora":{"family":"Lora","variants":["regular","italic","700","700italic"]},"Love Ya Like A Sister":{"family":"Love Ya Like A Sister","variants":["regular"]},"Loved by the King":{"family":"Loved by the King","variants":["regular"]},"Lovers Quarrel":{"family":"Lovers Quarrel","variants":["regular"]},"Luckiest Guy":{"family":"Luckiest Guy","variants":["regular"]},"Lusitana":{"family":"Lusitana","variants":["regular","700"]},"Lustria":{"family":"Lustria","variants":["regular"]},"Macondo":{"family":"Macondo","variants":["regular"]},"Macondo Swash Caps":{"family":"Macondo Swash Caps","variants":["regular"]},"Magra":{"family":"Magra","variants":["regular","700"]},"Maiden Orange":{"family":"Maiden Orange","variants":["regular"]},"Mako":{"family":"Mako","variants":["regular"]},"Marcellus":{"family":"Marcellus","variants":["regular"]},"Marcellus SC":{"family":"Marcellus SC","variants":["regular"]},"Marck Script":{"family":"Marck Script","variants":["regular"]},"Margarine":{"family":"Margarine","variants":["regular"]},"Marko One":{"family":"Marko One","variants":["regular"]},"Marmelad":{"family":"Marmelad","variants":["regular"]},"Marvel":{"family":"Marvel","variants":["regular","italic","700","700italic"]},"Mate":{"family":"Mate","variants":["regular","italic"]},"Mate SC":{"family":"Mate SC","variants":["regular"]},"Maven Pro":{"family":"Maven Pro","variants":["regular","500","700","900"]},"McLaren":{"family":"McLaren","variants":["regular"]},"Meddon":{"family":"Meddon","variants":["regular"]},"MedievalSharp":{"family":"MedievalSharp","variants":["regular"]},"Medula One":{"family":"Medula One","variants":["regular"]},"Megrim":{"family":"Megrim","variants":["regular"]},"Meie Script":{"family":"Meie Script","variants":["regular"]},"Merienda":{"family":"Merienda","variants":["regular","700"]},"Merienda One":{"family":"Merienda One","variants":["regular"]},"Merriweather":{"family":"Merriweather","variants":["300","300italic","regular","italic","700","700italic","900","900italic"]},"Merriweather Sans":{"family":"Merriweather Sans","variants":["300","300italic","regular","italic","700","700italic","800","800italic"]},"Metal":{"family":"Metal","variants":["regular"]},"Metal Mania":{"family":"Metal Mania","variants":["regular"]},"Metamorphous":{"family":"Metamorphous","variants":["regular"]},"Metrophobic":{"family":"Metrophobic","variants":["regular"]},"Michroma":{"family":"Michroma","variants":["regular"]},"Milonga":{"family":"Milonga","variants":["regular"]},"Miltonian":{"family":"Miltonian","variants":["regular"]},"Miltonian Tattoo":{"family":"Miltonian Tattoo","variants":["regular"]},"Miniver":{"family":"Miniver","variants":["regular"]},"Miss Fajardose":{"family":"Miss Fajardose","variants":["regular"]},"Modern Antiqua":{"family":"Modern Antiqua","variants":["regular"]},"Molengo":{"family":"Molengo","variants":["regular"]},"Molle":{"family":"Molle","variants":["italic"]},"Monda":{"family":"Monda","variants":["regular","700"]},"Monofett":{"family":"Monofett","variants":["regular"]},"Monoton":{"family":"Monoton","variants":["regular"]},"Monsieur La Doulaise":{"family":"Monsieur La Doulaise","variants":["regular"]},"Montaga":{"family":"Montaga","variants":["regular"]},"Montez":{"family":"Montez","variants":["regular"]},"Montserrat":{"family":"Montserrat","variants":["regular","700"]},"Montserrat Alternates":{"family":"Montserrat Alternates","variants":["regular","700"]},"Montserrat Subrayada":{"family":"Montserrat Subrayada","variants":["regular","700"]},"Moul":{"family":"Moul","variants":["regular"]},"Moulpali":{"family":"Moulpali","variants":["regular"]},"Mountains of Christmas":{"family":"Mountains of Christmas","variants":["regular","700"]},"Mouse Memoirs":{"family":"Mouse Memoirs","variants":["regular"]},"Mr Bedfort":{"family":"Mr Bedfort","variants":["regular"]},"Mr Dafoe":{"family":"Mr Dafoe","variants":["regular"]},"Mr De Haviland":{"family":"Mr De Haviland","variants":["regular"]},"Mrs Saint Delafield":{"family":"Mrs Saint Delafield","variants":["regular"]},"Mrs Sheppards":{"family":"Mrs Sheppards","variants":["regular"]},"Muli":{"family":"Muli","variants":["300","300italic","regular","italic"]},"Mystery Quest":{"family":"Mystery Quest","variants":["regular"]},"Neucha":{"family":"Neucha","variants":["regular"]},"Neuton":{"family":"Neuton","variants":["200","300","regular","italic","700","800"]},"New Rocker":{"family":"New Rocker","variants":["regular"]},"News Cycle":{"family":"News Cycle","variants":["regular","700"]},"Niconne":{"family":"Niconne","variants":["regular"]},"Nixie One":{"family":"Nixie One","variants":["regular"]},"Nobile":{"family":"Nobile","variants":["regular","italic","700","700italic"]},"Nokora":{"family":"Nokora","variants":["regular","700"]},"Norican":{"family":"Norican","variants":["regular"]},"Nosifer":{"family":"Nosifer","variants":["regular"]},"Nothing You Could Do":{"family":"Nothing You Could Do","variants":["regular"]},"Noticia Text":{"family":"Noticia Text","variants":["regular","italic","700","700italic"]},"Noto Sans":{"family":"Noto Sans","variants":["regular","italic","700","700italic"]},"Noto Serif":{"family":"Noto Serif","variants":["regular","italic","700","700italic"]},"Nova Cut":{"family":"Nova Cut","variants":["regular"]},"Nova Flat":{"family":"Nova Flat","variants":["regular"]},"Nova Mono":{"family":"Nova Mono","variants":["regular"]},"Nova Oval":{"family":"Nova Oval","variants":["regular"]},"Nova Round":{"family":"Nova Round","variants":["regular"]},"Nova Script":{"family":"Nova Script","variants":["regular"]},"Nova Slim":{"family":"Nova Slim","variants":["regular"]},"Nova Square":{"family":"Nova Square","variants":["regular"]},"Numans":{"family":"Numans","variants":["regular"]},"Nunito":{"family":"Nunito","variants":["300","regular","700"]},"Odor Mean Chey":{"family":"Odor Mean Chey","variants":["regular"]},"Offside":{"family":"Offside","variants":["regular"]},"Old Standard TT":{"family":"Old Standard TT","variants":["regular","italic","700"]},"Oldenburg":{"family":"Oldenburg","variants":["regular"]},"Oleo Script":{"family":"Oleo Script","variants":["regular","700"]},"Oleo Script Swash Caps":{"family":"Oleo Script Swash Caps","variants":["regular","700"]},"Open Sans":{"family":"Open Sans","variants":["300","300italic","regular","italic","600","600italic","700","700italic","800","800italic"]},"Open Sans Condensed":{"family":"Open Sans Condensed","variants":["300","300italic","700"]},"Oranienbaum":{"family":"Oranienbaum","variants":["regular"]},"Orbitron":{"family":"Orbitron","variants":["regular","500","700","900"]},"Oregano":{"family":"Oregano","variants":["regular","italic"]},"Orienta":{"family":"Orienta","variants":["regular"]},"Original Surfer":{"family":"Original Surfer","variants":["regular"]},"Oswald":{"family":"Oswald","variants":["300","regular","700"]},"Over the Rainbow":{"family":"Over the Rainbow","variants":["regular"]},"Overlock":{"family":"Overlock","variants":["regular","italic","700","700italic","900","900italic"]},"Overlock SC":{"family":"Overlock SC","variants":["regular"]},"Ovo":{"family":"Ovo","variants":["regular"]},"Oxygen":{"family":"Oxygen","variants":["300","regular","700"]},"Oxygen Mono":{"family":"Oxygen Mono","variants":["regular"]},"PT Mono":{"family":"PT Mono","variants":["regular"]},"PT Sans":{"family":"PT Sans","variants":["regular","italic","700","700italic"]},"PT Sans Caption":{"family":"PT Sans Caption","variants":["regular","700"]},"PT Sans Narrow":{"family":"PT Sans Narrow","variants":["regular","700"]},"PT Serif":{"family":"PT Serif","variants":["regular","italic","700","700italic"]},"PT Serif Caption":{"family":"PT Serif Caption","variants":["regular","italic"]},"Pacifico":{"family":"Pacifico","variants":["regular"]},"Paprika":{"family":"Paprika","variants":["regular"]},"Parisienne":{"family":"Parisienne","variants":["regular"]},"Passero One":{"family":"Passero One","variants":["regular"]},"Passion One":{"family":"Passion One","variants":["regular","700","900"]},"Pathway Gothic One":{"family":"Pathway Gothic One","variants":["regular"]},"Patrick Hand":{"family":"Patrick Hand","variants":["regular"]},"Patrick Hand SC":{"family":"Patrick Hand SC","variants":["regular"]},"Patua One":{"family":"Patua One","variants":["regular"]},"Paytone One":{"family":"Paytone One","variants":["regular"]},"Peralta":{"family":"Peralta","variants":["regular"]},"Permanent Marker":{"family":"Permanent Marker","variants":["regular"]},"Petit Formal Script":{"family":"Petit Formal Script","variants":["regular"]},"Petrona":{"family":"Petrona","variants":["regular"]},"Philosopher":{"family":"Philosopher","variants":["regular","italic","700","700italic"]},"Piedra":{"family":"Piedra","variants":["regular"]},"Pinyon Script":{"family":"Pinyon Script","variants":["regular"]},"Pirata One":{"family":"Pirata One","variants":["regular"]},"Plaster":{"family":"Plaster","variants":["regular"]},"Play":{"family":"Play","variants":["regular","700"]},"Playball":{"family":"Playball","variants":["regular"]},"Playfair Display":{"family":"Playfair Display","variants":["regular","italic","700","700italic","900","900italic"]},"Playfair Display SC":{"family":"Playfair Display SC","variants":["regular","italic","700","700italic","900","900italic"]},"Podkova":{"family":"Podkova","variants":["regular","700"]},"Poiret One":{"family":"Poiret One","variants":["regular"]},"Poller One":{"family":"Poller One","variants":["regular"]},"Poly":{"family":"Poly","variants":["regular","italic"]},"Pompiere":{"family":"Pompiere","variants":["regular"]},"Pontano Sans":{"family":"Pontano Sans","variants":["regular"]},"Port Lligat Sans":{"family":"Port Lligat Sans","variants":["regular"]},"Port Lligat Slab":{"family":"Port Lligat Slab","variants":["regular"]},"Prata":{"family":"Prata","variants":["regular"]},"Preahvihear":{"family":"Preahvihear","variants":["regular"]},"Press Start 2P":{"family":"Press Start 2P","variants":["regular"]},"Princess Sofia":{"family":"Princess Sofia","variants":["regular"]},"Prociono":{"family":"Prociono","variants":["regular"]},"Prosto One":{"family":"Prosto One","variants":["regular"]},"Puritan":{"family":"Puritan","variants":["regular","italic","700","700italic"]},"Purple Purse":{"family":"Purple Purse","variants":["regular"]},"Quando":{"family":"Quando","variants":["regular"]},"Quantico":{"family":"Quantico","variants":["regular","italic","700","700italic"]},"Quattrocento":{"family":"Quattrocento","variants":["regular","700"]},"Quattrocento Sans":{"family":"Quattrocento Sans","variants":["regular","italic","700","700italic"]},"Questrial":{"family":"Questrial","variants":["regular"]},"Quicksand":{"family":"Quicksand","variants":["300","regular","700"]},"Quintessential":{"family":"Quintessential","variants":["regular"]},"Qwigley":{"family":"Qwigley","variants":["regular"]},"Racing Sans One":{"family":"Racing Sans One","variants":["regular"]},"Radley":{"family":"Radley","variants":["regular","italic"]},"Raleway":{"family":"Raleway","variants":["100","200","300","regular","500","600","700","800","900"]},"Raleway Dots":{"family":"Raleway Dots","variants":["regular"]},"Rambla":{"family":"Rambla","variants":["regular","italic","700","700italic"]},"Rammetto One":{"family":"Rammetto One","variants":["regular"]},"Ranchers":{"family":"Ranchers","variants":["regular"]},"Rancho":{"family":"Rancho","variants":["regular"]},"Rationale":{"family":"Rationale","variants":["regular"]},"Redressed":{"family":"Redressed","variants":["regular"]},"Reenie Beanie":{"family":"Reenie Beanie","variants":["regular"]},"Revalia":{"family":"Revalia","variants":["regular"]},"Ribeye":{"family":"Ribeye","variants":["regular"]},"Ribeye Marrow":{"family":"Ribeye Marrow","variants":["regular"]},"Righteous":{"family":"Righteous","variants":["regular"]},"Risque":{"family":"Risque","variants":["regular"]},"Roboto":{"family":"Roboto","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},"Roboto Condensed":{"family":"Roboto Condensed","variants":["300","300italic","regular","italic","700","700italic"]},"Roboto Slab":{"family":"Roboto Slab","variants":["100","300","regular","700"]},"Rochester":{"family":"Rochester","variants":["regular"]},"Rock Salt":{"family":"Rock Salt","variants":["regular"]},"Rokkitt":{"family":"Rokkitt","variants":["regular","700"]},"Romanesco":{"family":"Romanesco","variants":["regular"]},"Ropa Sans":{"family":"Ropa Sans","variants":["regular","italic"]},"Rosario":{"family":"Rosario","variants":["regular","italic","700","700italic"]},"Rosarivo":{"family":"Rosarivo","variants":["regular","italic"]},"Rouge Script":{"family":"Rouge Script","variants":["regular"]},"Rubik Mono One":{"family":"Rubik Mono One","variants":["regular"]},"Rubik One":{"family":"Rubik One","variants":["regular"]},"Ruda":{"family":"Ruda","variants":["regular","700","900"]},"Rufina":{"family":"Rufina","variants":["regular","700"]},"Ruge Boogie":{"family":"Ruge Boogie","variants":["regular"]},"Ruluko":{"family":"Ruluko","variants":["regular"]},"Rum Raisin":{"family":"Rum Raisin","variants":["regular"]},"Ruslan Display":{"family":"Ruslan Display","variants":["regular"]},"Russo One":{"family":"Russo One","variants":["regular"]},"Ruthie":{"family":"Ruthie","variants":["regular"]},"Rye":{"family":"Rye","variants":["regular"]},"Sacramento":{"family":"Sacramento","variants":["regular"]},"Sail":{"family":"Sail","variants":["regular"]},"Salsa":{"family":"Salsa","variants":["regular"]},"Sanchez":{"family":"Sanchez","variants":["regular","italic"]},"Sancreek":{"family":"Sancreek","variants":["regular"]},"Sansita One":{"family":"Sansita One","variants":["regular"]},"Sarina":{"family":"Sarina","variants":["regular"]},"Satisfy":{"family":"Satisfy","variants":["regular"]},"Scada":{"family":"Scada","variants":["regular","italic","700","700italic"]},"Schoolbell":{"family":"Schoolbell","variants":["regular"]},"Seaweed Script":{"family":"Seaweed Script","variants":["regular"]},"Sevillana":{"family":"Sevillana","variants":["regular"]},"Seymour One":{"family":"Seymour One","variants":["regular"]},"Shadows Into Light":{"family":"Shadows Into Light","variants":["regular"]},"Shadows Into Light Two":{"family":"Shadows Into Light Two","variants":["regular"]},"Shanti":{"family":"Shanti","variants":["regular"]},"Share":{"family":"Share","variants":["regular","italic","700","700italic"]},"Share Tech":{"family":"Share Tech","variants":["regular"]},"Share Tech Mono":{"family":"Share Tech Mono","variants":["regular"]},"Shojumaru":{"family":"Shojumaru","variants":["regular"]},"Short Stack":{"family":"Short Stack","variants":["regular"]},"Siemreap":{"family":"Siemreap","variants":["regular"]},"Sigmar One":{"family":"Sigmar One","variants":["regular"]},"Signika":{"family":"Signika","variants":["300","regular","600","700"]},"Signika Negative":{"family":"Signika Negative","variants":["300","regular","600","700"]},"Simonetta":{"family":"Simonetta","variants":["regular","italic","900","900italic"]},"Sintony":{"family":"Sintony","variants":["regular","700"]},"Sirin Stencil":{"family":"Sirin Stencil","variants":["regular"]},"Six Caps":{"family":"Six Caps","variants":["regular"]},"Skranji":{"family":"Skranji","variants":["regular","700"]},"Slackey":{"family":"Slackey","variants":["regular"]},"Smokum":{"family":"Smokum","variants":["regular"]},"Smythe":{"family":"Smythe","variants":["regular"]},"Sniglet":{"family":"Sniglet","variants":["regular","800"]},"Snippet":{"family":"Snippet","variants":["regular"]},"Snowburst One":{"family":"Snowburst One","variants":["regular"]},"Sofadi One":{"family":"Sofadi One","variants":["regular"]},"Sofia":{"family":"Sofia","variants":["regular"]},"Sonsie One":{"family":"Sonsie One","variants":["regular"]},"Sorts Mill Goudy":{"family":"Sorts Mill Goudy","variants":["regular","italic"]},"Source Code Pro":{"family":"Source Code Pro","variants":["200","300","regular","500","600","700","900"]},"Source Sans Pro":{"family":"Source Sans Pro","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900","900italic"]},"Source Serif Pro":{"family":"Source Serif Pro","variants":["regular","600","700"]},"Special Elite":{"family":"Special Elite","variants":["regular"]},"Spicy Rice":{"family":"Spicy Rice","variants":["regular"]},"Spinnaker":{"family":"Spinnaker","variants":["regular"]},"Spirax":{"family":"Spirax","variants":["regular"]},"Squada One":{"family":"Squada One","variants":["regular"]},"Stalemate":{"family":"Stalemate","variants":["regular"]},"Stalinist One":{"family":"Stalinist One","variants":["regular"]},"Stardos Stencil":{"family":"Stardos Stencil","variants":["regular","700"]},"Stint Ultra Condensed":{"family":"Stint Ultra Condensed","variants":["regular"]},"Stint Ultra Expanded":{"family":"Stint Ultra Expanded","variants":["regular"]},"Stoke":{"family":"Stoke","variants":["300","regular"]},"Strait":{"family":"Strait","variants":["regular"]},"Sue Ellen Francisco":{"family":"Sue Ellen Francisco","variants":["regular"]},"Sunshiney":{"family":"Sunshiney","variants":["regular"]},"Supermercado One":{"family":"Supermercado One","variants":["regular"]},"Suwannaphum":{"family":"Suwannaphum","variants":["regular"]},"Swanky and Moo Moo":{"family":"Swanky and Moo Moo","variants":["regular"]},"Syncopate":{"family":"Syncopate","variants":["regular","700"]},"Tangerine":{"family":"Tangerine","variants":["regular","700"]},"Taprom":{"family":"Taprom","variants":["regular"]},"Tauri":{"family":"Tauri","variants":["regular"]},"Telex":{"family":"Telex","variants":["regular"]},"Tenor Sans":{"family":"Tenor Sans","variants":["regular"]},"Text Me One":{"family":"Text Me One","variants":["regular"]},"The Girl Next Door":{"family":"The Girl Next Door","variants":["regular"]},"Tienne":{"family":"Tienne","variants":["regular","700","900"]},"Tinos":{"family":"Tinos","variants":["regular","italic","700","700italic"]},"Titan One":{"family":"Titan One","variants":["regular"]},"Titillium Web":{"family":"Titillium Web","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900"]},"Trade Winds":{"family":"Trade Winds","variants":["regular"]},"Trocchi":{"family":"Trocchi","variants":["regular"]},"Trochut":{"family":"Trochut","variants":["regular","italic","700"]},"Trykker":{"family":"Trykker","variants":["regular"]},"Tulpen One":{"family":"Tulpen One","variants":["regular"]},"Ubuntu":{"family":"Ubuntu","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},"Ubuntu Condensed":{"family":"Ubuntu Condensed","variants":["regular"]},"Ubuntu Mono":{"family":"Ubuntu Mono","variants":["regular","italic","700","700italic"]},"Ultra":{"family":"Ultra","variants":["regular"]},"Uncial Antiqua":{"family":"Uncial Antiqua","variants":["regular"]},"Underdog":{"family":"Underdog","variants":["regular"]},"Unica One":{"family":"Unica One","variants":["regular"]},"UnifrakturCook":{"family":"UnifrakturCook","variants":["700"]},"UnifrakturMaguntia":{"family":"UnifrakturMaguntia","variants":["regular"]},"Unkempt":{"family":"Unkempt","variants":["regular","700"]},"Unlock":{"family":"Unlock","variants":["regular"]},"Unna":{"family":"Unna","variants":["regular"]},"VT323":{"family":"VT323","variants":["regular"]},"Vampiro One":{"family":"Vampiro One","variants":["regular"]},"Varela":{"family":"Varela","variants":["regular"]},"Varela Round":{"family":"Varela Round","variants":["regular"]},"Vast Shadow":{"family":"Vast Shadow","variants":["regular"]},"Vibur":{"family":"Vibur","variants":["regular"]},"Vidaloka":{"family":"Vidaloka","variants":["regular"]},"Viga":{"family":"Viga","variants":["regular"]},"Voces":{"family":"Voces","variants":["regular"]},"Volkhov":{"family":"Volkhov","variants":["regular","italic","700","700italic"]},"Vollkorn":{"family":"Vollkorn","variants":["regular","italic","700","700italic"]},"Voltaire":{"family":"Voltaire","variants":["regular"]},"Waiting for the Sunrise":{"family":"Waiting for the Sunrise","variants":["regular"]},"Wallpoet":{"family":"Wallpoet","variants":["regular"]},"Walter Turncoat":{"family":"Walter Turncoat","variants":["regular"]},"Warnes":{"family":"Warnes","variants":["regular"]},"Wellfleet":{"family":"Wellfleet","variants":["regular"]},"Wendy One":{"family":"Wendy One","variants":["regular"]},"Wire One":{"family":"Wire One","variants":["regular"]},"Yanone Kaffeesatz":{"family":"Yanone Kaffeesatz","variants":["200","300","regular","700"]},"Yellowtail":{"family":"Yellowtail","variants":["regular"]},"Yeseva One":{"family":"Yeseva One","variants":["regular"]},"Yesteryear":{"family":"Yesteryear","variants":["regular"]},"Zeyada":{"family":"Zeyada","variants":["regular"]}}';
	}
}


/* *********************************************************************************************************************
 * Get regular fonts
 */
if ( ! function_exists( 'ishyoboy_get_regular_fonts' ) ) {
	function ishyoboy_get_regular_fonts(){
		return array('arial'=>'Arial',
			'verdana'=>'Verdana, Geneva',
			'trebuchet'=>'Trebuchet',
			'georgia' =>'Georgia',
			'times'=>'Times New Roman',
			'tahoma'=>'Tahoma, Geneva',
			'palatino'=>'Palatino',
			'helvetica'=>'Helvetica' );
	}
}


/* *********************************************************************************************************************
 * Get regular fonts list
 */
if ( ! function_exists( 'ishyoboy_get_regular_fonts_list' ) ) {
	function ishyoboy_get_regular_fonts_list(){
		return '<option value="arial">Arial</option><option value="verdana">Verdana, Geneva</option><option value="trebuchet">Trebuchet</option><option value="georgia">Georgia</option><option value="times">Times New Roman</option><option value="tahoma">Tahoma, Geneva</option><option value="palatino">Palatino</option><option value="helvetica">Helvetica</option>';
	}
}


/* *********************************************************************************************************************
 * Get google fonts js
 */
if ( ! function_exists( 'ishyoboy_get_google_fonts_js' ) ) {
	function ishyoboy_get_google_fonts_js(){
		//return '[{"family":"ABeeZee","variants":["regular","italic"]},{"family":"Abel","variants":["regular"]},{"family":"Abril Fatface","variants":["regular"]},{"family":"Aclonica","variants":["regular"]},{"family":"Acme","variants":["regular"]},{"family":"Actor","variants":["regular"]},{"family":"Adamina","variants":["regular"]},{"family":"Advent Pro","variants":["100","200","300","regular","500","600","700"]},{"family":"Aguafina Script","variants":["regular"]},{"family":"Akronim","variants":["regular"]},{"family":"Aladin","variants":["regular"]},{"family":"Aldrich","variants":["regular"]},{"family":"Alegreya","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Alegreya SC","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Alex Brush","variants":["regular"]},{"family":"Alfa Slab One","variants":["regular"]},{"family":"Alice","variants":["regular"]},{"family":"Alike","variants":["regular"]},{"family":"Alike Angular","variants":["regular"]},{"family":"Allan","variants":["regular","700"]},{"family":"Allerta","variants":["regular"]},{"family":"Allerta Stencil","variants":["regular"]},{"family":"Allura","variants":["regular"]},{"family":"Almendra","variants":["regular","italic","700","700italic"]},{"family":"Almendra Display","variants":["regular"]},{"family":"Almendra SC","variants":["regular"]},{"family":"Amarante","variants":["regular"]},{"family":"Amaranth","variants":["regular","italic","700","700italic"]},{"family":"Amatic SC","variants":["regular","700"]},{"family":"Amethysta","variants":["regular"]},{"family":"Anaheim","variants":["regular"]},{"family":"Andada","variants":["regular"]},{"family":"Andika","variants":["regular"]},{"family":"Angkor","variants":["regular"]},{"family":"Annie Use Your Telescope","variants":["regular"]},{"family":"Anonymous Pro","variants":["regular","italic","700","700italic"]},{"family":"Antic","variants":["regular"]},{"family":"Antic Didone","variants":["regular"]},{"family":"Antic Slab","variants":["regular"]},{"family":"Anton","variants":["regular"]},{"family":"Arapey","variants":["regular","italic"]},{"family":"Arbutus","variants":["regular"]},{"family":"Arbutus Slab","variants":["regular"]},{"family":"Architects Daughter","variants":["regular"]},{"family":"Archivo Black","variants":["regular"]},{"family":"Archivo Narrow","variants":["regular","italic","700","700italic"]},{"family":"Arimo","variants":["regular","italic","700","700italic"]},{"family":"Arizonia","variants":["regular"]},{"family":"Armata","variants":["regular"]},{"family":"Artifika","variants":["regular"]},{"family":"Arvo","variants":["regular","italic","700","700italic"]},{"family":"Asap","variants":["regular","italic","700","700italic"]},{"family":"Asset","variants":["regular"]},{"family":"Astloch","variants":["regular","700"]},{"family":"Asul","variants":["regular","700"]},{"family":"Atomic Age","variants":["regular"]},{"family":"Aubrey","variants":["regular"]},{"family":"Audiowide","variants":["regular"]},{"family":"Autour One","variants":["regular"]},{"family":"Average","variants":["regular"]},{"family":"Average Sans","variants":["regular"]},{"family":"Averia Gruesa Libre","variants":["regular"]},{"family":"Averia Libre","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Averia Sans Libre","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Averia Serif Libre","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Bad Script","variants":["regular"]},{"family":"Balthazar","variants":["regular"]},{"family":"Bangers","variants":["regular"]},{"family":"Basic","variants":["regular"]},{"family":"Battambang","variants":["regular","700"]},{"family":"Baumans","variants":["regular"]},{"family":"Bayon","variants":["regular"]},{"family":"Belgrano","variants":["regular"]},{"family":"Belleza","variants":["regular"]},{"family":"BenchNine","variants":["300","regular","700"]},{"family":"Bentham","variants":["regular"]},{"family":"Berkshire Swash","variants":["regular"]},{"family":"Bevan","variants":["regular"]},{"family":"Bigelow Rules","variants":["regular"]},{"family":"Bigshot One","variants":["regular"]},{"family":"Bilbo","variants":["regular"]},{"family":"Bilbo Swash Caps","variants":["regular"]},{"family":"Bitter","variants":["regular","italic","700"]},{"family":"Black Ops One","variants":["regular"]},{"family":"Bokor","variants":["regular"]},{"family":"Bonbon","variants":["regular"]},{"family":"Boogaloo","variants":["regular"]},{"family":"Bowlby One","variants":["regular"]},{"family":"Bowlby One SC","variants":["regular"]},{"family":"Brawler","variants":["regular"]},{"family":"Bree Serif","variants":["regular"]},{"family":"Bubblegum Sans","variants":["regular"]},{"family":"Bubbler One","variants":["regular"]},{"family":"Buda","variants":["300"]},{"family":"Buenard","variants":["regular","700"]},{"family":"Butcherman","variants":["regular"]},{"family":"Butterfly Kids","variants":["regular"]},{"family":"Cabin","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Cabin Condensed","variants":["regular","500","600","700"]},{"family":"Cabin Sketch","variants":["regular","700"]},{"family":"Caesar Dressing","variants":["regular"]},{"family":"Cagliostro","variants":["regular"]},{"family":"Calligraffitti","variants":["regular"]},{"family":"Cambo","variants":["regular"]},{"family":"Candal","variants":["regular"]},{"family":"Cantarell","variants":["regular","italic","700","700italic"]},{"family":"Cantata One","variants":["regular"]},{"family":"Cantora One","variants":["regular"]},{"family":"Capriola","variants":["regular"]},{"family":"Cardo","variants":["regular","italic","700"]},{"family":"Carme","variants":["regular"]},{"family":"Carrois Gothic","variants":["regular"]},{"family":"Carrois Gothic SC","variants":["regular"]},{"family":"Carter One","variants":["regular"]},{"family":"Caudex","variants":["regular","italic","700","700italic"]},{"family":"Cedarville Cursive","variants":["regular"]},{"family":"Ceviche One","variants":["regular"]},{"family":"Changa One","variants":["regular","italic"]},{"family":"Chango","variants":["regular"]},{"family":"Chau Philomene One","variants":["regular","italic"]},{"family":"Chela One","variants":["regular"]},{"family":"Chelsea Market","variants":["regular"]},{"family":"Chenla","variants":["regular"]},{"family":"Cherry Cream Soda","variants":["regular"]},{"family":"Cherry Swash","variants":["regular","700"]},{"family":"Chewy","variants":["regular"]},{"family":"Chicle","variants":["regular"]},{"family":"Chivo","variants":["regular","italic","900","900italic"]},{"family":"Cinzel","variants":["regular","700","900"]},{"family":"Cinzel Decorative","variants":["regular","700","900"]},{"family":"Clicker Script","variants":["regular"]},{"family":"Coda","variants":["regular","800"]},{"family":"Coda Caption","variants":["800"]},{"family":"Codystar","variants":["300","regular"]},{"family":"Combo","variants":["regular"]},{"family":"Comfortaa","variants":["300","regular","700"]},{"family":"Coming Soon","variants":["regular"]},{"family":"Concert One","variants":["regular"]},{"family":"Condiment","variants":["regular"]},{"family":"Content","variants":["regular","700"]},{"family":"Contrail One","variants":["regular"]},{"family":"Convergence","variants":["regular"]},{"family":"Cookie","variants":["regular"]},{"family":"Copse","variants":["regular"]},{"family":"Corben","variants":["regular","700"]},{"family":"Courgette","variants":["regular"]},{"family":"Cousine","variants":["regular","italic","700","700italic"]},{"family":"Coustard","variants":["regular","900"]},{"family":"Covered By Your Grace","variants":["regular"]},{"family":"Crafty Girls","variants":["regular"]},{"family":"Creepster","variants":["regular"]},{"family":"Crete Round","variants":["regular","italic"]},{"family":"Crimson Text","variants":["regular","italic","600","600italic","700","700italic"]},{"family":"Croissant One","variants":["regular"]},{"family":"Crushed","variants":["regular"]},{"family":"Cuprum","variants":["regular","italic","700","700italic"]},{"family":"Cutive","variants":["regular"]},{"family":"Cutive Mono","variants":["regular"]},{"family":"Damion","variants":["regular"]},{"family":"Dancing Script","variants":["regular","700"]},{"family":"Dangrek","variants":["regular"]},{"family":"Dawning of a New Day","variants":["regular"]},{"family":"Days One","variants":["regular"]},{"family":"Delius","variants":["regular"]},{"family":"Delius Swash Caps","variants":["regular"]},{"family":"Delius Unicase","variants":["regular","700"]},{"family":"Della Respira","variants":["regular"]},{"family":"Denk One","variants":["regular"]},{"family":"Devonshire","variants":["regular"]},{"family":"Didact Gothic","variants":["regular"]},{"family":"Diplomata","variants":["regular"]},{"family":"Diplomata SC","variants":["regular"]},{"family":"Domine","variants":["regular","700"]},{"family":"Donegal One","variants":["regular"]},{"family":"Doppio One","variants":["regular"]},{"family":"Dorsa","variants":["regular"]},{"family":"Dosis","variants":["200","300","regular","500","600","700","800"]},{"family":"Dr Sugiyama","variants":["regular"]},{"family":"Droid Sans","variants":["regular","700"]},{"family":"Droid Sans Mono","variants":["regular"]},{"family":"Droid Serif","variants":["regular","italic","700","700italic"]},{"family":"Duru Sans","variants":["regular"]},{"family":"Dynalight","variants":["regular"]},{"family":"EB Garamond","variants":["regular"]},{"family":"Eagle Lake","variants":["regular"]},{"family":"Eater","variants":["regular"]},{"family":"Economica","variants":["regular","italic","700","700italic"]},{"family":"Electrolize","variants":["regular"]},{"family":"Elsie","variants":["regular","900"]},{"family":"Elsie Swash Caps","variants":["regular","900"]},{"family":"Emblema One","variants":["regular"]},{"family":"Emilys Candy","variants":["regular"]},{"family":"Engagement","variants":["regular"]},{"family":"Englebert","variants":["regular"]},{"family":"Enriqueta","variants":["regular","700"]},{"family":"Erica One","variants":["regular"]},{"family":"Esteban","variants":["regular"]},{"family":"Euphoria Script","variants":["regular"]},{"family":"Ewert","variants":["regular"]},{"family":"Exo","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},{"family":"Expletus Sans","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},{"family":"Fanwood Text","variants":["regular","italic"]},{"family":"Fascinate","variants":["regular"]},{"family":"Fascinate Inline","variants":["regular"]},{"family":"Faster One","variants":["regular"]},{"family":"Fasthand","variants":["regular"]},{"family":"Federant","variants":["regular"]},{"family":"Federo","variants":["regular"]},{"family":"Felipa","variants":["regular"]},{"family":"Fenix","variants":["regular"]},{"family":"Finger Paint","variants":["regular"]},{"family":"Fjalla One","variants":["regular"]},{"family":"Fjord One","variants":["regular"]},{"family":"Flamenco","variants":["300","regular"]},{"family":"Flavors","variants":["regular"]},{"family":"Fondamento","variants":["regular","italic"]},{"family":"Fontdiner Swanky","variants":["regular"]},{"family":"Forum","variants":["regular"]},{"family":"Francois One","variants":["regular"]},{"family":"Freckle Face","variants":["regular"]},{"family":"Fredericka the Great","variants":["regular"]},{"family":"Fredoka One","variants":["regular"]},{"family":"Freehand","variants":["regular"]},{"family":"Fresca","variants":["regular"]},{"family":"Frijole","variants":["regular"]},{"family":"Fruktur","variants":["regular"]},{"family":"Fugaz One","variants":["regular"]},{"family":"GFS Didot","variants":["regular"]},{"family":"GFS Neohellenic","variants":["regular","italic","700","700italic"]},{"family":"Gabriela","variants":["regular"]},{"family":"Gafata","variants":["regular"]},{"family":"Galdeano","variants":["regular"]},{"family":"Galindo","variants":["regular"]},{"family":"Gentium Basic","variants":["regular","italic","700","700italic"]},{"family":"Gentium Book Basic","variants":["regular","italic","700","700italic"]},{"family":"Geo","variants":["regular","italic"]},{"family":"Geostar","variants":["regular"]},{"family":"Geostar Fill","variants":["regular"]},{"family":"Germania One","variants":["regular"]},{"family":"Gilda Display","variants":["regular"]},{"family":"Give You Glory","variants":["regular"]},{"family":"Glass Antiqua","variants":["regular"]},{"family":"Glegoo","variants":["regular"]},{"family":"Gloria Hallelujah","variants":["regular"]},{"family":"Goblin One","variants":["regular"]},{"family":"Gochi Hand","variants":["regular"]},{"family":"Gorditas","variants":["regular","700"]},{"family":"Goudy Bookletter 1911","variants":["regular"]},{"family":"Graduate","variants":["regular"]},{"family":"Grand Hotel","variants":["regular"]},{"family":"Gravitas One","variants":["regular"]},{"family":"Great Vibes","variants":["regular"]},{"family":"Griffy","variants":["regular"]},{"family":"Gruppo","variants":["regular"]},{"family":"Gudea","variants":["regular","italic","700"]},{"family":"Habibi","variants":["regular"]},{"family":"Hammersmith One","variants":["regular"]},{"family":"Hanalei","variants":["regular"]},{"family":"Hanalei Fill","variants":["regular"]},{"family":"Handlee","variants":["regular"]},{"family":"Hanuman","variants":["regular","700"]},{"family":"Happy Monkey","variants":["regular"]},{"family":"Headland One","variants":["regular"]},{"family":"Henny Penny","variants":["regular"]},{"family":"Herr Von Muellerhoff","variants":["regular"]},{"family":"Holtwood One SC","variants":["regular"]},{"family":"Homemade Apple","variants":["regular"]},{"family":"Homenaje","variants":["regular"]},{"family":"IM Fell DW Pica","variants":["regular","italic"]},{"family":"IM Fell DW Pica SC","variants":["regular"]},{"family":"IM Fell Double Pica","variants":["regular","italic"]},{"family":"IM Fell Double Pica SC","variants":["regular"]},{"family":"IM Fell English","variants":["regular","italic"]},{"family":"IM Fell English SC","variants":["regular"]},{"family":"IM Fell French Canon","variants":["regular","italic"]},{"family":"IM Fell French Canon SC","variants":["regular"]},{"family":"IM Fell Great Primer","variants":["regular","italic"]},{"family":"IM Fell Great Primer SC","variants":["regular"]},{"family":"Iceberg","variants":["regular"]},{"family":"Iceland","variants":["regular"]},{"family":"Imprima","variants":["regular"]},{"family":"Inconsolata","variants":["regular","700"]},{"family":"Inder","variants":["regular"]},{"family":"Indie Flower","variants":["regular"]},{"family":"Inika","variants":["regular","700"]},{"family":"Irish Grover","variants":["regular"]},{"family":"Istok Web","variants":["regular","italic","700","700italic"]},{"family":"Italiana","variants":["regular"]},{"family":"Italianno","variants":["regular"]},{"family":"Jacques Francois","variants":["regular"]},{"family":"Jacques Francois Shadow","variants":["regular"]},{"family":"Jim Nightshade","variants":["regular"]},{"family":"Jockey One","variants":["regular"]},{"family":"Jolly Lodger","variants":["regular"]},{"family":"Josefin Sans","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},{"family":"Josefin Slab","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},{"family":"Joti One","variants":["regular"]},{"family":"Judson","variants":["regular","italic","700"]},{"family":"Julee","variants":["regular"]},{"family":"Julius Sans One","variants":["regular"]},{"family":"Junge","variants":["regular"]},{"family":"Jura","variants":["300","regular","500","600"]},{"family":"Just Another Hand","variants":["regular"]},{"family":"Just Me Again Down Here","variants":["regular"]},{"family":"Kameron","variants":["regular","700"]},{"family":"Karla","variants":["regular","italic","700","700italic"]},{"family":"Kaushan Script","variants":["regular"]},{"family":"Kavoon","variants":["regular"]},{"family":"Keania One","variants":["regular"]},{"family":"Kelly Slab","variants":["regular"]},{"family":"Kenia","variants":["regular"]},{"family":"Khmer","variants":["regular"]},{"family":"Kite One","variants":["regular"]},{"family":"Knewave","variants":["regular"]},{"family":"Kotta One","variants":["regular"]},{"family":"Koulen","variants":["regular"]},{"family":"Kranky","variants":["regular"]},{"family":"Kreon","variants":["300","regular","700"]},{"family":"Kristi","variants":["regular"]},{"family":"Krona One","variants":["regular"]},{"family":"La Belle Aurore","variants":["regular"]},{"family":"Lancelot","variants":["regular"]},{"family":"Lato","variants":["100","100italic","300","300italic","regular","italic","700","700italic","900","900italic"]},{"family":"League Script","variants":["regular"]},{"family":"Leckerli One","variants":["regular"]},{"family":"Ledger","variants":["regular"]},{"family":"Lekton","variants":["regular","italic","700"]},{"family":"Lemon","variants":["regular"]},{"family":"Libre Baskerville","variants":["regular","italic","700"]},{"family":"Life Savers","variants":["regular","700"]},{"family":"Lilita One","variants":["regular"]},{"family":"Limelight","variants":["regular"]},{"family":"Linden Hill","variants":["regular","italic"]},{"family":"Lobster","variants":["regular"]},{"family":"Lobster Two","variants":["regular","italic","700","700italic"]},{"family":"Londrina Outline","variants":["regular"]},{"family":"Londrina Shadow","variants":["regular"]},{"family":"Londrina Sketch","variants":["regular"]},{"family":"Londrina Solid","variants":["regular"]},{"family":"Lora","variants":["regular","italic","700","700italic"]},{"family":"Love Ya Like A Sister","variants":["regular"]},{"family":"Loved by the King","variants":["regular"]},{"family":"Lovers Quarrel","variants":["regular"]},{"family":"Luckiest Guy","variants":["regular"]},{"family":"Lusitana","variants":["regular","700"]},{"family":"Lustria","variants":["regular"]},{"family":"Macondo","variants":["regular"]},{"family":"Macondo Swash Caps","variants":["regular"]},{"family":"Magra","variants":["regular","700"]},{"family":"Maiden Orange","variants":["regular"]},{"family":"Mako","variants":["regular"]},{"family":"Marcellus","variants":["regular"]},{"family":"Marcellus SC","variants":["regular"]},{"family":"Marck Script","variants":["regular"]},{"family":"Margarine","variants":["regular"]},{"family":"Marko One","variants":["regular"]},{"family":"Marmelad","variants":["regular"]},{"family":"Marvel","variants":["regular","italic","700","700italic"]},{"family":"Mate","variants":["regular","italic"]},{"family":"Mate SC","variants":["regular"]},{"family":"Maven Pro","variants":["regular","500","700","900"]},{"family":"McLaren","variants":["regular"]},{"family":"Meddon","variants":["regular"]},{"family":"MedievalSharp","variants":["regular"]},{"family":"Medula One","variants":["regular"]},{"family":"Megrim","variants":["regular"]},{"family":"Meie Script","variants":["regular"]},{"family":"Merienda","variants":["regular","700"]},{"family":"Merienda One","variants":["regular"]},{"family":"Merriweather","variants":["300","regular","700","900"]},{"family":"Merriweather Sans","variants":["300","regular","700","800"]},{"family":"Metal","variants":["regular"]},{"family":"Metal Mania","variants":["regular"]},{"family":"Metamorphous","variants":["regular"]},{"family":"Metrophobic","variants":["regular"]},{"family":"Michroma","variants":["regular"]},{"family":"Milonga","variants":["regular"]},{"family":"Miltonian","variants":["regular"]},{"family":"Miltonian Tattoo","variants":["regular"]},{"family":"Miniver","variants":["regular"]},{"family":"Miss Fajardose","variants":["regular"]},{"family":"Modern Antiqua","variants":["regular"]},{"family":"Molengo","variants":["regular"]},{"family":"Molle","variants":["italic"]},{"family":"Monda","variants":["regular","700"]},{"family":"Monofett","variants":["regular"]},{"family":"Monoton","variants":["regular"]},{"family":"Monsieur La Doulaise","variants":["regular"]},{"family":"Montaga","variants":["regular"]},{"family":"Montez","variants":["regular"]},{"family":"Montserrat","variants":["regular","700"]},{"family":"Montserrat Alternates","variants":["regular","700"]},{"family":"Montserrat Subrayada","variants":["regular","700"]},{"family":"Moul","variants":["regular"]},{"family":"Moulpali","variants":["regular"]},{"family":"Mountains of Christmas","variants":["regular","700"]},{"family":"Mouse Memoirs","variants":["regular"]},{"family":"Mr Bedfort","variants":["regular"]},{"family":"Mr Dafoe","variants":["regular"]},{"family":"Mr De Haviland","variants":["regular"]},{"family":"Mrs Saint Delafield","variants":["regular"]},{"family":"Mrs Sheppards","variants":["regular"]},{"family":"Muli","variants":["300","300italic","regular","italic"]},{"family":"Mystery Quest","variants":["regular"]},{"family":"Neucha","variants":["regular"]},{"family":"Neuton","variants":["200","300","regular","italic","700","800"]},{"family":"New Rocker","variants":["regular"]},{"family":"News Cycle","variants":["regular","700"]},{"family":"Niconne","variants":["regular"]},{"family":"Nixie One","variants":["regular"]},{"family":"Nobile","variants":["regular","italic","700","700italic"]},{"family":"Nokora","variants":["regular","700"]},{"family":"Norican","variants":["regular"]},{"family":"Nosifer","variants":["regular"]},{"family":"Nothing You Could Do","variants":["regular"]},{"family":"Noticia Text","variants":["regular","italic","700","700italic"]},{"family":"Noto Sans","variants":["regular","italic","700","700italic"]},{"family":"Noto Serif","variants":["regular","italic","700","700italic"]},{"family":"Nova Cut","variants":["regular"]},{"family":"Nova Flat","variants":["regular"]},{"family":"Nova Mono","variants":["regular"]},{"family":"Nova Oval","variants":["regular"]},{"family":"Nova Round","variants":["regular"]},{"family":"Nova Script","variants":["regular"]},{"family":"Nova Slim","variants":["regular"]},{"family":"Nova Square","variants":["regular"]},{"family":"Numans","variants":["regular"]},{"family":"Nunito","variants":["300","regular","700"]},{"family":"Odor Mean Chey","variants":["regular"]},{"family":"Offside","variants":["regular"]},{"family":"Old Standard TT","variants":["regular","italic","700"]},{"family":"Oldenburg","variants":["regular"]},{"family":"Oleo Script","variants":["regular","700"]},{"family":"Oleo Script Swash Caps","variants":["regular","700"]},{"family":"Open Sans","variants":["300","300italic","regular","italic","600","600italic","700","700italic","800","800italic"]},{"family":"Open Sans Condensed","variants":["300","300italic","700"]},{"family":"Oranienbaum","variants":["regular"]},{"family":"Orbitron","variants":["regular","500","700","900"]},{"family":"Oregano","variants":["regular","italic"]},{"family":"Orienta","variants":["regular"]},{"family":"Original Surfer","variants":["regular"]},{"family":"Oswald","variants":["300","regular","700"]},{"family":"Over the Rainbow","variants":["regular"]},{"family":"Overlock","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Overlock SC","variants":["regular"]},{"family":"Ovo","variants":["regular"]},{"family":"Oxygen","variants":["300","regular","700"]},{"family":"Oxygen Mono","variants":["regular"]},{"family":"PT Mono","variants":["regular"]},{"family":"PT Sans","variants":["regular","italic","700","700italic"]},{"family":"PT Sans Caption","variants":["regular","700"]},{"family":"PT Sans Narrow","variants":["regular","700"]},{"family":"PT Serif","variants":["regular","italic","700","700italic"]},{"family":"PT Serif Caption","variants":["regular","italic"]},{"family":"Pacifico","variants":["regular"]},{"family":"Paprika","variants":["regular"]},{"family":"Parisienne","variants":["regular"]},{"family":"Passero One","variants":["regular"]},{"family":"Passion One","variants":["regular","700","900"]},{"family":"Patrick Hand","variants":["regular"]},{"family":"Patrick Hand SC","variants":["regular"]},{"family":"Patua One","variants":["regular"]},{"family":"Paytone One","variants":["regular"]},{"family":"Peralta","variants":["regular"]},{"family":"Permanent Marker","variants":["regular"]},{"family":"Petit Formal Script","variants":["regular"]},{"family":"Petrona","variants":["regular"]},{"family":"Philosopher","variants":["regular","italic","700","700italic"]},{"family":"Piedra","variants":["regular"]},{"family":"Pinyon Script","variants":["regular"]},{"family":"Pirata One","variants":["regular"]},{"family":"Plaster","variants":["regular"]},{"family":"Play","variants":["regular","700"]},{"family":"Playball","variants":["regular"]},{"family":"Playfair Display","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Playfair Display SC","variants":["regular","italic","700","700italic","900","900italic"]},{"family":"Podkova","variants":["regular","700"]},{"family":"Poiret One","variants":["regular"]},{"family":"Poller One","variants":["regular"]},{"family":"Poly","variants":["regular","italic"]},{"family":"Pompiere","variants":["regular"]},{"family":"Pontano Sans","variants":["regular"]},{"family":"Port Lligat Sans","variants":["regular"]},{"family":"Port Lligat Slab","variants":["regular"]},{"family":"Prata","variants":["regular"]},{"family":"Preahvihear","variants":["regular"]},{"family":"Press Start 2P","variants":["regular"]},{"family":"Princess Sofia","variants":["regular"]},{"family":"Prociono","variants":["regular"]},{"family":"Prosto One","variants":["regular"]},{"family":"Puritan","variants":["regular","italic","700","700italic"]},{"family":"Purple Purse","variants":["regular"]},{"family":"Quando","variants":["regular"]},{"family":"Quantico","variants":["regular","italic","700","700italic"]},{"family":"Quattrocento","variants":["regular","700"]},{"family":"Quattrocento Sans","variants":["regular","italic","700","700italic"]},{"family":"Questrial","variants":["regular"]},{"family":"Quicksand","variants":["300","regular","700"]},{"family":"Quintessential","variants":["regular"]},{"family":"Qwigley","variants":["regular"]},{"family":"Racing Sans One","variants":["regular"]},{"family":"Radley","variants":["regular","italic"]},{"family":"Raleway","variants":["100","200","300","regular","500","600","700","800","900"]},{"family":"Raleway Dots","variants":["regular"]},{"family":"Rambla","variants":["regular","italic","700","700italic"]},{"family":"Rammetto One","variants":["regular"]},{"family":"Ranchers","variants":["regular"]},{"family":"Rancho","variants":["regular"]},{"family":"Rationale","variants":["regular"]},{"family":"Redressed","variants":["regular"]},{"family":"Reenie Beanie","variants":["regular"]},{"family":"Revalia","variants":["regular"]},{"family":"Ribeye","variants":["regular"]},{"family":"Ribeye Marrow","variants":["regular"]},{"family":"Righteous","variants":["regular"]},{"family":"Risque","variants":["regular"]},{"family":"Roboto","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},{"family":"Roboto Condensed","variants":["300","300italic","regular","italic","700","700italic"]},{"family":"Rochester","variants":["regular"]},{"family":"Rock Salt","variants":["regular"]},{"family":"Rokkitt","variants":["regular","700"]},{"family":"Romanesco","variants":["regular"]},{"family":"Ropa Sans","variants":["regular","italic"]},{"family":"Rosario","variants":["regular","italic","700","700italic"]},{"family":"Rosarivo","variants":["regular","italic"]},{"family":"Rouge Script","variants":["regular"]},{"family":"Ruda","variants":["regular","700","900"]},{"family":"Rufina","variants":["regular","700"]},{"family":"Ruge Boogie","variants":["regular"]},{"family":"Ruluko","variants":["regular"]},{"family":"Rum Raisin","variants":["regular"]},{"family":"Ruslan Display","variants":["regular"]},{"family":"Russo One","variants":["regular"]},{"family":"Ruthie","variants":["regular"]},{"family":"Rye","variants":["regular"]},{"family":"Sacramento","variants":["regular"]},{"family":"Sail","variants":["regular"]},{"family":"Salsa","variants":["regular"]},{"family":"Sanchez","variants":["regular","italic"]},{"family":"Sancreek","variants":["regular"]},{"family":"Sansita One","variants":["regular"]},{"family":"Sarina","variants":["regular"]},{"family":"Satisfy","variants":["regular"]},{"family":"Scada","variants":["regular","italic","700","700italic"]},{"family":"Schoolbell","variants":["regular"]},{"family":"Seaweed Script","variants":["regular"]},{"family":"Sevillana","variants":["regular"]},{"family":"Seymour One","variants":["regular"]},{"family":"Shadows Into Light","variants":["regular"]},{"family":"Shadows Into Light Two","variants":["regular"]},{"family":"Shanti","variants":["regular"]},{"family":"Share","variants":["regular","italic","700","700italic"]},{"family":"Share Tech","variants":["regular"]},{"family":"Share Tech Mono","variants":["regular"]},{"family":"Shojumaru","variants":["regular"]},{"family":"Short Stack","variants":["regular"]},{"family":"Siemreap","variants":["regular"]},{"family":"Sigmar One","variants":["regular"]},{"family":"Signika","variants":["300","regular","600","700"]},{"family":"Signika Negative","variants":["300","regular","600","700"]},{"family":"Simonetta","variants":["regular","italic","900","900italic"]},{"family":"Sintony","variants":["regular","700"]},{"family":"Sirin Stencil","variants":["regular"]},{"family":"Six Caps","variants":["regular"]},{"family":"Skranji","variants":["regular","700"]},{"family":"Slackey","variants":["regular"]},{"family":"Smokum","variants":["regular"]},{"family":"Smythe","variants":["regular"]},{"family":"Sniglet","variants":["800"]},{"family":"Snippet","variants":["regular"]},{"family":"Snowburst One","variants":["regular"]},{"family":"Sofadi One","variants":["regular"]},{"family":"Sofia","variants":["regular"]},{"family":"Sonsie One","variants":["regular"]},{"family":"Sorts Mill Goudy","variants":["regular","italic"]},{"family":"Source Code Pro","variants":["200","300","regular","500","600","700","900"]},{"family":"Source Sans Pro","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900","900italic"]},{"family":"Special Elite","variants":["regular"]},{"family":"Spicy Rice","variants":["regular"]},{"family":"Spinnaker","variants":["regular"]},{"family":"Spirax","variants":["regular"]},{"family":"Squada One","variants":["regular"]},{"family":"Stalemate","variants":["regular"]},{"family":"Stalinist One","variants":["regular"]},{"family":"Stardos Stencil","variants":["regular","700"]},{"family":"Stint Ultra Condensed","variants":["regular"]},{"family":"Stint Ultra Expanded","variants":["regular"]},{"family":"Stoke","variants":["300","regular"]},{"family":"Strait","variants":["regular"]},{"family":"Sue Ellen Francisco","variants":["regular"]},{"family":"Sunshiney","variants":["regular"]},{"family":"Supermercado One","variants":["regular"]},{"family":"Suwannaphum","variants":["regular"]},{"family":"Swanky and Moo Moo","variants":["regular"]},{"family":"Syncopate","variants":["regular","700"]},{"family":"Tangerine","variants":["regular","700"]},{"family":"Taprom","variants":["regular"]},{"family":"Tauri","variants":["regular"]},{"family":"Telex","variants":["regular"]},{"family":"Tenor Sans","variants":["regular"]},{"family":"Text Me One","variants":["regular"]},{"family":"The Girl Next Door","variants":["regular"]},{"family":"Tienne","variants":["regular","700","900"]},{"family":"Tinos","variants":["regular","italic","700","700italic"]},{"family":"Titan One","variants":["regular"]},{"family":"Titillium Web","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900"]},{"family":"Trade Winds","variants":["regular"]},{"family":"Trocchi","variants":["regular"]},{"family":"Trochut","variants":["regular","italic","700"]},{"family":"Trykker","variants":["regular"]},{"family":"Tulpen One","variants":["regular"]},{"family":"Ubuntu","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},{"family":"Ubuntu Condensed","variants":["regular"]},{"family":"Ubuntu Mono","variants":["regular","italic","700","700italic"]},{"family":"Ultra","variants":["regular"]},{"family":"Uncial Antiqua","variants":["regular"]},{"family":"Underdog","variants":["regular"]},{"family":"Unica One","variants":["regular"]},{"family":"UnifrakturCook","variants":["700"]},{"family":"UnifrakturMaguntia","variants":["regular"]},{"family":"Unkempt","variants":["regular","700"]},{"family":"Unlock","variants":["regular"]},{"family":"Unna","variants":["regular"]},{"family":"VT323","variants":["regular"]},{"family":"Vampiro One","variants":["regular"]},{"family":"Varela","variants":["regular"]},{"family":"Varela Round","variants":["regular"]},{"family":"Vast Shadow","variants":["regular"]},{"family":"Vibur","variants":["regular"]},{"family":"Vidaloka","variants":["regular"]},{"family":"Viga","variants":["regular"]},{"family":"Voces","variants":["regular"]},{"family":"Volkhov","variants":["regular","italic","700","700italic"]},{"family":"Vollkorn","variants":["regular","italic","700","700italic"]},{"family":"Voltaire","variants":["regular"]},{"family":"Waiting for the Sunrise","variants":["regular"]},{"family":"Wallpoet","variants":["regular"]},{"family":"Walter Turncoat","variants":["regular"]},{"family":"Warnes","variants":["regular"]},{"family":"Wellfleet","variants":["regular"]},{"family":"Wendy One","variants":["regular"]},{"family":"Wire One","variants":["regular"]},{"family":"Yanone Kaffeesatz","variants":["200","300","regular","700"]},{"family":"Yellowtail","variants":["regular"]},{"family":"Yeseva One","variants":["regular"]},{"family":"Yesteryear","variants":["regular"]},{"family":"Zeyada","variants":["regular"]}]';
		return
			"\n\n<script type='text/javascript'>\n/* <![CDATA[*/\n var ish_google_fonts = '" . ishyoboy_get_google_fonts() . "';\n var ish_regular_fonts = '" . ishyoboy_get_regular_fonts_list() . "';\n/* ]]> */ \n </script>\n\n";
	}
}


/* *********************************************************************************************************************
 * Detects active WooCommerce plugin
 */
if ( ! function_exists( 'ishyoboy_woocommerce_plugin_active' ) ) {
	function ishyoboy_woocommerce_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) return true;
		return false;
	}
}


/* *********************************************************************************************************************
 * Detects active WPML plugin
 */
if ( ! function_exists( 'ishyoboy_wpml_plugin_active' ) ) {
	function ishyoboy_wpml_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) return true;
		return false;
	}
}


/* *********************************************************************************************************************
 * Woocommerce integration
 */
require_once( locate_template( 'woocommerce/config.php' ) );


/* *********************************************************************************************************************
 * Filter Search results
 */
if ( ! function_exists( 'ishyoboy_filter_where' ) ) {
	function ishyoboy_filter_where($where = '') {
		global $ish_options;

		// Exclude error 404 page
		$id_404 = ( isset( $ish_options['use_page_for_404'] ) && ( '1' == $ish_options['use_page_for_404'] ) && isset( $ish_options['page_for_404'] ) ) ? $ish_options['page_for_404'] : '';

		if ($id_404) {
			if ( is_search() ) {
				$exclude = array($id_404);

				for( $x=0; $x<count($exclude); $x++){
					$where .= " AND ID != " . $exclude[$x];
				}
			}
		}
		return $where;
	}
}
add_filter('posts_where', 'ishyoboy_filter_where');


/* *********************************************************************************************************************
 * IshYoBoy language selector
 */
if ( ! function_exists( 'ishyoboy_language_selector' ) ) {
	function ishyoboy_language_selector(){
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		$return = '';
		if(!empty($languages)){
			$return .= '<ul class="sub-menu">';
			foreach($languages as $l){
				$return .= '<li>';
				$return .= ($l['active']) ? ('<a href="#">') : ('<a href="'.$l['url'].'">');
				//$return .=  '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" class="ish-lng-img" /> ';
				//$return .=  $l['native_name'];
				$return .=  $l['translated_name'];
				$return .=  '</a>';
				$return .= '</li>';
			}
			$return .= '</ul>';
		}
		return $return;
	}
}


/* *********************************************************************************************************************
 * Detects active SEO plugins
 */
if ( ! function_exists( 'ishyoboy_seo_plugin_active' ) ) {
	function ishyoboy_seo_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) return true;
		if( is_plugin_active( 'headspace2/headspace.php' ) ) return true;
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) return true;
		return false;
	}
}

/* *********************************************************************************************************************
 * Load Language
 */
load_theme_textdomain( 'ishyoboy', IYB_TEMPLATE_DIR .'/language' );


if ( ishyoboy_wpml_plugin_active() ){
	add_filter( 'wp_nav_menu_items', 'ishyoboy_add_language_selector', 10, 2 );
}


/* *********************************************************************************************************************
 * Activate IshYoBoy Framework
 */
$tempdir = get_template_directory();

require_once( locate_template( 'assets/framework/wp/includes/sidebar_generator.php' ) );
require_once( locate_template( 'assets/framework/wp/includes/ish_like_it.php' ) );
require_once( locate_template( 'assets/framework/wp/includes/fontello_icons_menu.php' ) );
require_once( locate_template( 'admin/index.php' ) );
require_once( locate_template( 'assets/framework/wp/options/init.php' ) );
require_once( locate_template( 'assets/framework/wp/includes/class-tgm-plugin-activation.php' ) );
require_once( locate_template( 'assets/framework/wp/pagebuilder/ish_config/config_as_plugin.php' ) );