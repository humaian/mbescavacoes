<?php

if ( is_admin() ){
	add_action( 'init', 'of_options' );
}

if (!function_exists('of_options')) {

    function of_options() {

        global $ish_fonts, $of_pages, $of_sidebars, $of_menus, $of_categories, $bg_images, $alt_stylesheets, $alt_stylesheets_imgs, $googleFontsArray, $regular_fonts, $regular_variants;
	    $of_categories = array();
	    $of_pages = array();
	    $of_sidebars = array();
	    $of_menus = array();
	    $bg_images = array();
	    $alt_stylesheets = array();
	    $alt_stylesheets_imgs = array();
	    $googleFontsArray = array();
	    $regular_fonts = array();
	    $regular_fonts = array();
	    $regular_variants = array();

	    $social_icons = null;


		//Access the WordPress Categories via an Array
		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, 'Select a category:');

		//Access the WordPress Pages via an Array
		$of_pages = array();
        $of_pages_obj = get_pages();

        $of_pages['-1'] = __( 'Select a page', 'ishyoboy');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_title;
        }

        //Sidebars
        $of_sidebars = array();
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar){
            $of_sidebars[ $sidebar['id'] ] =  $sidebar['name'];
        }

        //Menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );
        $of_menus = array( '' => __( 'Select a menu', 'ishyoboy') );
        foreach ( $menus as $menu ) {
            $of_menus[$menu->term_id] = $menu->name;
        }

        //Social icons
        $social_icons = '[ish_icon icon="ish-icon-twitter" icon_url="http://twitter.com/ishyoboydotcom" bg_color="#00acee" text_color="#ffffff" global_atts="yes" tooltip="Twitter" tooltip_color="color1" tooltip_text_color="color3"]

[ish_icon icon="ish-icon-facebook" icon_url="http://www.facebook.com/ishyoboydotcom" bg_color="#3b5998" text_color="#ffffff" global_atts="yes" tooltip="Facebook" tooltip_color="color1" tooltip_text_color="color3"]

[ish_icon icon="ish-icon-dribbble" icon_url="http://dribbble.com/MattImling" bg_color="#ea4c89" text_color="#ffffff" global_atts="yes" tooltip="Dribbble" tooltip_color="color1" tooltip_text_color="color3"]

[ish_icon icon="ish-icon-behance" icon_url="http://www.behance.net/MattImling" bg_color="#005cff" text_color="#ffffff" global_atts="yes" tooltip="Behance" tooltip_color="color1" tooltip_text_color="color3"]

[ish_icon icon="ish-icon-email" icon_url="http://eepurl.com/C-X7v" bg_color="#fcbf20" text_color="#ffffff" global_atts="yes" tooltip="Subscribe to our newsletter" tooltip_color="color1" tooltip_text_color="color3"]';

	    //
	    $footer_legals_area = '<p style="text-align: center;">PROUDLY POWERED BY <a href="http://wordpress.org" title="WordPress">WORDPRESS</a> ~ CREATED BY <a href="http://ishyoboy.com" title="IshYoBoy.com">ISHYOBOY.COM</a></p>';

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> 'placebo', //REQUIRED!
				"block_one"		=> 'Block One',
				"block_two"		=> 'Block Two',
				"block_three"	=> 'Block Three',
			),
			"enabled" => array (
				'placebo' => 'placebo', //REQUIRED!
				'block_four'	=> 'Block Four',
			),
		);

        //$googleFonts = array('none' => __( 'Select a font', 'ishyoboy') );
        $googleFonts = json_decode(ishyoboy_get_google_fonts());
        $googleFontsArray = array('none' => __( 'Select a font', 'ishyoboy') );

        foreach ($googleFonts as $key => $details) {
            $googleFontsArray[$key] = $key;
        }

        $regular_fonts = array(
            'arial'     =>  'Arial',
            'verdana'   =>  'Verdana, Geneva',
            'trebuchet' =>  'Trebuchet',
            'georgia'   =>  'Georgia',
            'times'     =>  'Times New Roman',
            'tahoma'    =>  'Tahoma, Geneva',
            'palatino'  =>  'Palatino',
            'helvetica' =>  'Helvetica'
        );

        $regular_variants = array(
            'normal'        =>  'Normal',
            'italic'        =>  'Italic',
            'bold'          =>  'Bold',
            'bold italic'   =>  'Bold Italic'
        );

	    // FONT SETTINGS
	    global $ish_options;
	    $ish_default_fonts = $ish_fonts;
	    ishyoboy_load_font_settings('body_font', $ish_options);
	    ishyoboy_load_font_settings('body_font_2', $ish_options);
	    ishyoboy_load_font_settings('header_font', $ish_options);
	    ishyoboy_load_font_settings('h1_font', $ish_options);
	    ishyoboy_load_font_settings('h2_font', $ish_options);
	    ishyoboy_load_font_settings('h3_font', $ish_options);
	    ishyoboy_load_font_settings('h4_font', $ish_options);
	    ishyoboy_load_font_settings('h5_font', $ish_options);
	    ishyoboy_load_font_settings('h6_font', $ish_options);
	    $ish_saved_fonts = $ish_fonts;
	    $ish_fonts = $ish_default_fonts;

        //Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
        $alt_stylesheets_imgs = array();


	    if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, '.php') !== false)
		            {
		                $alt_stylesheets[$alt_stylesheet_file] = ucfirst(substr($alt_stylesheet_file, 0, -4));
                        $alt_stylesheets_imgs[$alt_stylesheet_file] = IYB_TEMPLATE_URI . '/admin/layouts/' . substr($alt_stylesheet_file, 0, -4).'.png';
		            }
		        }
		    }
		}

        asort($alt_stylesheets);
        asort($alt_stylesheets_imgs);

        $bg_images_path = IYB_HTML_DIR . '/images/bg-patterns'; // change this to where you store your bg images
        $bg_images_url = IYB_HTML_URI . '/images/bg-patterns'; // change this to where you store your bg images

	    $bg_images = array();
	    $bg_images_first = array( '' => IYB_HTML_URI . '/images/none.png');

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if( (stristr($bg_images_file, '.png') !== false || stristr($bg_images_file, '.jpg') !== false || stristr($bg_images_file, '.gif') !== false )) {
		                $bg_images[$bg_images_file] = $bg_images_url . '/' . $bg_images_file;
		            }
		        }
		    }
		}

        asort($bg_images);
        $bg_images = array_merge($bg_images_first, $bg_images);

        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();

	    do_action( 'ish_theme_options_before_general_options' );

		/* *************************************************************************************************************
         * 1. General Settings
         */
	    $of_options[] = array(  'name'  => __( 'General Options', 'ishyoboy' ),
		                        'class' => 'generaloptions',
		                        'type'  => 'heading');

	        // BOXED / UNBOXED *****************************************************************************************
		    $url =  ADMIN_DIR . 'assets/images/';
		    $of_options[] = array(  'name'      => __( 'Boxed / Unboxed Layout', 'ishyoboy' ),
                                    'desc'      => __( 'Default layout of the theme. Either boxed with a background image or unboxed (full-width).', 'ishyoboy' ),
                                    'id'        => 'boxed_layout',
                                    'std'       => ISH_DEFAULT_BOXED_LAYOUT,
                                    'type'      => 'images',
                                    'options'   => Array(
                                        'boxed'     => $url . '3cm.png',
                                        'unboxed'   => $url . '1col.png'
                                    ));

	        // PAGE WIDTH **********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Page Width', 'ishyoboy' ),
                                    'desc'  => __( 'Choose one of the pre-defined widths or enter custom one.', 'ishyoboy'),
                                    'id'    => 'use_predefined_page_width',
                                    'std'   => 1,
                                    'on'    => __( 'Predefined', 'ishyoboy' ),
                                    'off'   => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 0,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'      => '', //__( 'Page Width', 'ishyoboy' ),
                                    'desc'      => '', //__( '', 'ishyoboy' ),
                                    'id'        => 'predefined_page_width',
                                    'std'       => IYB_PAGE_WIDTH,
                                    'type'      => 'radio',
                                    'fold'      => 'use_predefined_page_width',
                                    'options'   => array(
	                                    IYB_PAGE_WIDTH  => __( 'Wide Screen', 'ishyoboy' ) . ' (1240px)',
                                        '960'           => __( 'NoteBook', 'ishyoboy' ) . ' (960px)',
                                    ));

            $of_options[] = array(  'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => 'px',
                                    'id'    => 'custom_page_width',
                                    'std'   => IYB_PAGE_WIDTH,
                                    'fold'  => 'off_' . 'use_predefined_page_width',
                                    'type'  => 'text');

            // RESPONSIVE LAYOUT ***************************************************************************************
	        $of_options[] = array(  'name'  => __( 'Responsive layout', 'ishyoboy' ),
                                    'desc'  => __( 'Make the page width fit the screen of every device or set it to never resize.', 'ishyoboy'),
                                    'id'    => 'use_responsive_layout',
                                    'std'   => 1,
                                    'on'    => __( 'Responsive', 'ishyoboy' ),
                                    'off'   => __( 'Fixed', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'px - from this point the layout will change to a mobile version.', 'ishyoboy' ),
                                    'id'    => 'responsive_layout_breakingpoint',
                                    'std'   => IYB_BREAKINGPOINT,
                                    'fold'  => 'use_responsive_layout',
                                    'type'  => 'text');

            // NICESCROLL **********************************************************************************************
            $of_options[] = array(  'name'  => __( 'SmoothScroll', 'ishyoboy' ),
                                    'desc'  => __( 'Enable smoothscroll functionality for smoother page scrolling effect (Google Chrome only).', 'ishyoboy' ),
                                    'id'    => 'nicescroll_enabled',
                                    'std'   => 1,
                                    'type'  => 'switch');

			// BREADCRMBS **********************************************************************************************
	        $of_options[] = array(  'name'  => __( 'Breadcrumbs Bar', 'ishyoboy' ),
                                    'desc'  => __( 'Display a breadcrumbs navigation in the content of each page.', 'ishyoboy' ),
                                    'id'    => 'show_breadcrumbs',
									'std' => 'breadcrumbs-icons',
									'type' => 'select',
									'options' => Array(
										'none'              => __( 'None', 'ishyoboy'),
										'breadcrumbs'       => __( 'Breadcrumbs only', 'ishyoboy'),
										'icons'             => __( 'Social Icons only', 'ishyoboy'),
										'breadcrumbs-icons' => __( 'Breadcrumbs & Social Icons', 'ishyoboy'),
									),
			);

	        // 404 PAGE ************************************************************************************************
            $of_options[] = array(  'name' => __( '404 Error page', 'ishyoboy' ),
                                    'desc' => __( 'Select a page to be displayed instead of the standard 404 Not Found page.', 'ishyoboy' ),
                                    'id' => 'use_page_for_404',
                                    'std' => '0',
                                    'folds' => '1',
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
                                    'desc' => __( 'The page which will be displayed instead of the standard 404 page.', 'ishyoboy' ),
                                    'id' => 'page_for_404',
                                    'std' => '',
                                    'fold' => 'use_page_for_404',
                                    'type' => 'select',
                                    'options' => $of_pages );

	        // SOCIAL ICONS ********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Social icons', 'ishyoboy' ),
                                    'desc'  => __( 'Social icons: Paste the social icons using the [social] shortcode', 'ishyoboy' ),
                                    'id'    => 'social_icons_bar',
                                    'std'   => $social_icons,
                                    'type'  => 'textarea');


            // REGULAR PAGES SIDEBAR ***********************************************************************************
            /*$of_options[] = array(  'name' => __( 'Regular Pages Sidebar', 'ishyoboy' ),
                                    'desc' => __( "Display the sidebar on each page by default. This settings can be overridden in each page's settings.", 'ishyoboy') . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id' => 'show_page_sidebar',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //'name' => __( 'Regular Pages Sidebar position', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy' ),
                                    'id'    => 'page_sidebar_position',
                                    'std'   => 'right',
                                    'fold'  => 'show_page_sidebar',
                                    'type'  => 'select',
                                    'options' => array('left' => 'Left', 'right' => 'Right') );

            $of_options[] = array(  'name' => '', //'name' => __( 'Regular Pages Sidebar', 'ishyoboy' ),
                                    'desc' => __( 'Select which sidebar will be displayed on each page by default.', 'ishyoboy' ),
                                    'id' => 'page_sidebar',
                                    'std' => 'sidebar-main',
                                    'fold' => 'show_page_sidebar',
                                    'type' => 'select',
                                    'options' => $of_sidebars);*/

            // TRACKING ************************************************************************************************
            $of_options[] = array(  'name'  => __( 'Tracking Code', 'ishyoboy' ),
                                    'desc'  => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'ishyoboy' ),
                                    'id'    => 'tracking_script',
                                    'std'   => '',
                                    'type'  => 'textarea');

            // ADDTHIS SHARE *******************************************************************************************
             $of_options[] = array(  'name' => __( 'Social Sharing Code', 'ishyoboy' ),
                                    'desc' => __( 'Paste your addthis sharing code from https://www.addthis.com/get/sharing', 'ishyoboy' ),
                                    'id' => 'addthis_share',
                                    'std' => '<!-- AddThis Button BEGIN --><div class="addthis_toolbox addthis_default_style addthis_32x32_style"><a class="addthis_button_facebook"></a><a class="addthis_button_twitter"></a><a class="addthis_button_google_plusone_share"></a><a class="addthis_button_linkedin"></a><a class="addthis_button_pinterest_share"></a><a class="addthis_button_digg"></a><a class="addthis_button_reddit"></a><a class="addthis_button_xing"></a><a class="addthis_button_gmail"></a><a class="addthis_button_pocket"></a><a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a></div><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script><!-- AddThis Button END -->',
                                    'type' => 'textarea');

            // CUSTOM CSS **********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Custom CSS', 'ishyoboy' ),
                                    'desc'  => __( 'Quickly add some CSS to your theme by adding it to this block.', 'ishyoboy'),
                                    'id'    => 'custom_css',
                                    'std'   => '',
                                    'type'  => 'textarea');

            // CUSTOM SCRIPTS ******************************************************************************************
            /* $of_options[] = array(  'name' => __( 'Custom Scripts', 'ishyoboy' ),
                                    'desc' => __( 'Quickly add some JavaScript includes to your theme by adding it to this block.', 'ishyoboy'),
                                    'id' => 'custom_scripts',
                                    'std' => '',
                                    'type' => 'textarea'); */

            // FAVICON *************************************************************************************************
            $of_options[] = array(  'name'  => __( 'Custom Favicons', 'ishyoboy' ),
                                    'desc'  => __( "Upload a regular 16px x 16px png/gif/ico image that will represent your website's favicon.", 'ishyoboy' ),
                                    'id'    => 'custom_favicon_16',
                                    'std'   => '', //IYB_HTML_URI_USER . '/favicon.ico',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc'  => __( "For iPad 1, 2 - 72px x 72px png image", 'ishyoboy' ),
                                    'id'    => 'custom_favicon_72',
                                    'std'   => '', //IYB_HTML_URI_USER . '/apple-touch-icon.png',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc'  => __( "For iPhone Retina - 114px x 114px png image", 'ishyoboy' ),
                                    'id'    => 'custom_favicon_114',
                                    'std'   => '',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => '', //__( 'Custom Favicon', 'ishyoboy' ),
                                    'desc'  => __( "For iPad 3 Retina - 144px x 144px png image", 'ishyoboy' ),
                                    'id'    => 'custom_favicon_144',
                                    'std'   => '',
                                    'type'  => 'media');

	    do_action( 'ish_theme_options_after_general_options' );
	    do_action( 'ish_theme_options_before_header_options' );

        /* *************************************************************************************************************
         * 2. Header Options
         */
        $of_options[] = array(  'name'  => __( 'Header Options', 'ishyoboy' ),
                                'class' => 'headeroptions',
                                'type'  => 'heading');

	        // SITE LOGO ***********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Site Logo', 'ishyoboy' ),
                                    'desc'  => __( 'Use image logo instead of a simple Site Title and if not empty, Tagline.', 'ishyoboy' ),
                                    'id'    => 'logo_as_image',
                                    'std'   => 0,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'  => __( ' ', 'ishyoboy' ), // Display just hr
                                    'desc'  => __( 'Select an image for the Site Logo.', 'ishyoboy' ),
                                    'id'    => 'logo_image',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => __( ' ', 'ishyoboy' ), // Display just hr
                                    'desc'  => __( 'Retina devices logo alternative - 2 times bigger than the normal logo.', 'ishyoboy' ) .'<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>The Site Logo must be set.', 'ishyoboy' ) . '</span>',
                                    'id'    => 'logo_retina_image',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

	        // HEADER HEIGHT *******************************************************************************************
	        $of_options[] = array(  'name'  => __( 'Header Height', 'ishyoboy' ),
                                    'desc'  => __( 'px - the height of the header area.', 'ishyoboy' ),
                                    'id'    => 'header_height',
                                    'std'   => ISH_DEFAULT_HEADER_HEIGHT,
                                    'type'  => 'text');

            // RESPONSIVE LAYOUT MENU **********************************************************************************
	        $of_options[] = array(  'name'  => __( 'Header navigation responsive layout', 'ishyoboy' ),
                                    'desc'  => __( 'px - from this point the main navigation will change to a mobile version. Works only if \'General Options -> Responsive layout\' is set to \'Responsive\'', 'ishyoboy' ),
                                    'id'    => 'responsive_nav_breakingpoint',
                                    'std'   => IYB_NAV_BREAKINGPOINT,
                                    'type'  => 'text');

	        // HEADER SEARCH *******************************************************************************************
            $of_options[] = array(  'name'  => __( 'Header navigation search form', 'ishyoboy' ),
                                    'desc'  => __( 'Add search form as last navigation item.', 'ishyoboy' ),
                                    'id'    => 'use_navigation_search',
                                    'std'   => '1',
                                    'type'  => 'switch');

            // STICKY NAV **********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Sticky Navigation', 'ishyoboy' ),
                                    'desc'  => __( 'Choose whether the navigation remains sticked to the top of the page while scrolling down.', 'ishyoboy' ),
                                    'id'    => 'sticky_nav',
                                    'std'   => 1,
                                    'folds' => 1,
                                    'type'  => 'switch');

		    $of_options[] = array(  'name'  => '', //'name' => __( '', 'ishyoboy' ),
								    'desc'  => __( 'Display Sticky Nav on tablets and mobile devices', 'ishyoboy' ),
								    'id'    => 'sticky_nav_responsive',
								    'std'   => 1,
								    'fold'  => 'sticky_nav',
								    'type'  => 'switch');

	        $of_options[] = array(  'name'  => '', //__( 'Sticky Navigation Height', 'ishyoboy' ),
                                    'desc'  => __( 'Sticky Navigation Height in pixels. E.g.: "50".', 'ishyoboy' ),
                                    'id'    => 'sticky_height',
                                    'std'   => ISH_DEFAULT_STICKY_HEIGHT,
		                            'fold'  => 'sticky_nav',
                                    'type'  => 'text');

	        // SIDENAV *************************************************************************************************
            /*$of_options[] = array(  'name'  => __( 'Side Navigation', 'ishyoboy' ),
                                    'desc'  => __( 'Transform main navigation to side navigation.', 'ishyoboy' ),
                                    'id'    => 'use_sidenav',
                                    'std'   => '1',
                                    'type'  => 'switch');*/

	        $of_options[] = array(  'name'      => __( 'Main Navigation Position', 'ishyoboy' ),
                                    'desc'      => __( 'Choose whether to display the Main Navigation on the top, left or right side of the page.', 'ishyoboy' ),
                                    'id'        => 'mainnav_position',
                                    'std'       => '',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    ''  => 'Center',
	                                    'left' => 'Left',
	                                    'right'  => 'Right',
                                    ));

	        $of_options[] = array(  'name'  => __( 'Main Navigation Type', 'ishyoboy' ),
                                    'desc'  => __( 'Choose how the navigation should highlight the active pages/sections.', 'ishyoboy' ),
                                    'id'    => 'mainnav_type',
                                    'std'   => '',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    ''  => 'Multipage (Default)',
	                                    'onepage' => 'Onepage',
                                    ));

            // HEADER EXPANDABLE ***************************************************************************************
            $of_options[] = array(  'name'  => __( 'Expandable area', 'ishyoboy' ),
                                    'desc'  => __( 'Enable to display overlay expandable area.', 'ishyoboy' ),
                                    'id'    => 'expandable_header',
                                    'std'   => 1, //0,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'      => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc'      => __( 'Select which sidebar will be displayed inside the expandable area by default.', 'ishyoboy' ),
                                    'id'        => 'header_sidebar',
                                    'std'       => 'sidebar-header',
                                    'fold'      => 'expandable_header',
                                    'type'      => 'select',
                                    'options'   => $of_sidebars);

            if ( ishyoboy_wpml_plugin_active() ){
                $of_options[] = array(  'name'  => __( 'Language Selector', 'ishyoboy' ),
                                        'desc'  => __( 'Display the language selector', 'ishyoboy'),
                                        'id'    => 'header_bar_languages',
                                        'std'   => 0,
                                        'folds' => 1,
                                        //'fold'  => 'use_header_bar',
                                        'type'  => 'switch');
            }

	    do_action( 'ish_theme_options_after_header_options' );
	    do_action( 'ish_theme_options_before_footer_options' );

        /* *************************************************************************************************************
         * 3. Footer Settings
         */
        $of_options[] = array(  'name'  => __( 'Footer Options', 'ishyoboy' ),
                                'class' => 'footeroptions',
                                'type'  => 'heading');

            // FOOTER WIDGETS ******************************************************************************************
            $of_options[] = array(  'name'  => __( 'Footer widget area', 'ishyoboy' ),
                                    'desc'  => __( 'Show the footer widget area.', 'ishyoboy' ),
                                    'id'    => 'footer_widget_area',
                                    'std'   => 1,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array( 'name'       => '', //'name' => __( 'Expandable header sidebar', 'ishyoboy' ),
                                    'desc'      => __( 'Select which sidebar will be displayed inside the footer widget area by default.', 'ishyoboy' ),
                                    'id'        => 'footer_sidebar',
                                    'std'       => 'sidebar-footer',
                                    'fold'      => 'footer_widget_area',
                                    'type'      => 'select',
                                    'options'   => $of_sidebars);

            // FOOTER LEGALS *******************************************************************************************
	        $of_options[] = array(  'name'  => __( 'Footer legals area', 'ishyoboy' ),
                                    'desc'  => __( 'Show content in the footer legals area.', 'ishyoboy' ),
                                    'id'    => 'footer_legals_area',
                                    'std'   => $footer_legals_area,
                                    'type'  => 'textarea');

	    do_action( 'ish_theme_options_after_footer_options' );

	    // PORTFOLIO SETTINGS COME HERE

	    do_action( 'ish_theme_options_before_blog_options' );


        /* *************************************************************************************************************
         * 5. Blog Settings
         */
        $of_options[] = array(  'name'  => __( 'Blog Options', 'ishyoboy' ),
                                'class' => 'blogoptions',
                                'type'  => 'heading');

	        // BLOG STYLE **********************************************************************************************
	        $of_options[] = array(  'name'      => __( 'Blog Overview Style', 'ishyoboy' ),
                                    'desc'      => __( 'Choose how the blog overview page will look like.', 'ishyoboy' ),
                                    'id'        => 'blog_overview_style',
                                    'std'       => 'fullwidth', //'classic',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    'classic'       => 'Classic',
	                                    'fullwidth'     => 'Full-width',
	                                    'masonry'       => 'Masonry',
                                    ));

	        $of_options[] = array(  'name' => __( 'Masonry Options', 'ishyoboy' ),
								    'desc' => __( 'Masonry Layout Style - Regular Grid or Proportional Tiles.', 'ishyoboy' ),
								    'id' => 'blog_masonry_layout_style',
								    'std' => 'grid',
								    'type' => 'select',
								    'options' => Array(
									    'grid' => 'Grid - Same widths, auto heights',
									    'tiles' => 'Tiles - Widths & heights as in post settings',
								    ),
		    );

		    $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
									'desc' => __( 'Number of columns to display in the Masonry Blog Grid.', 'ishyoboy' ),
									'id' => 'blog_masonry_columns',
									'std' => '6',
									'type' => 'select',
									'options' => Array(
										'8' => '8',
										'7' => '7',
										'6' => '6',
										'5' => '5',
										'4' => '4',
										'3' => '3',
									),
			);

		    $of_options[] = array(  'name' => '', //__( '', 'ishyoboy' ),
								    'desc' => __( 'Masonry Row Style - Keep the Masonry Grid within content or expand to full width.', 'ishyoboy' ),
								    'id' => 'blog_masonry_row_style',
								    'std' => 'notfull',
								    'type' => 'select',
								    'options' => Array(
									    'notfull' => 'Regular',
									    'full' => 'Full-width',
								    ),
		    );

	        // BLOG CATEGORIES BAR *************************************************************************************
            $of_options[] = array(  'name'  => __( 'Display Categories Bar', 'ishyoboy' ),
                                    'desc'  => __( 'Display a bar with all Blog categories on overview pages.', 'ishyoboy'), // . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id'    => 'show_blog_categories',
                                    'std'   => 1,
                                    'type'  => 'switch');

	        // BLOG SIDEBAR ********************************************************************************************
            $of_options[] = array(  'name'  => __( 'Blog Sidebar', 'ishyoboy' ),
                                    'desc'  => __( 'Display Sidebar on Blog overview and Blog detail pages.', 'ishyoboy'), // . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                    'id'    => 'show_blog_sidebar',
                                    'std'   => 0, //1,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'      => '', //'name' => __( 'Blog Sidebar position', 'ishyoboy' ),
                                    'desc'      => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy' ),
                                    'id'        => 'blog_sidebar_position',
                                    'std'       => 'right',
                                    'fold'      => 'show_blog_sidebar',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    'left'  => 'Left',
	                                    'right' => 'Right'
                                    ));

            $of_options[] = array(  'name'      => '', //'name' => __( 'Blog Sidebar', 'ishyoboy' ),
                                    'desc'      => __( 'Select which sidebar will be displayed on Blog overview and Blog detail pages.', 'ishyoboy' ),
                                    'id'        => 'blog_sidebar',
                                    'std'       => 'sidebar-main',
                                    'fold'      => 'show_blog_sidebar',
                                    'type'      => 'select',
                                    'options'   => $of_sidebars);

	        // BLOG SOCIAL SHARING *************************************************************************************
            $of_options[] = array(  'name' => __( 'Blog Social Sharing', 'ishyoboy' ),
                                    'desc' => __( 'Chose whether to display a social sharing buttons box by default.', 'ishyoboy' ),
                                    'id' => 'use_addthis_share',
                                    'std' => '1',
                                    'type' => 'switch');

	    do_action( 'ish_theme_options_after_blog_options' );
	    do_action( 'ish_theme_options_before_themes_skins' );

	    /* *************************************************************************************************************
         * Theme Skins
         */

		/*
        $of_options[] = array(  'name'  => __( 'Theme Skins', 'ishyoboy' ),
                                'class' => 'themeskins',
                                'type'  => 'heading');

	        // THEME SKINS *********************************************************************************************
            $of_options[] = array(  'name'      => __( 'Theme Skins', 'ishyoboy' ),
                                    'desc'      => __( 'Select one of the pre-defined skins.', 'ishyoboy' ) . '<br><br><span style="color: red;">' . __( '<strong>IMPORTANT:</strong><br>Changing the skin will reset all your currently defined Colors, Patterns, Fonts and Boxed Layout options.', 'ishyoboy' ) . '</span>',
                                    'id'        => 'skin',
                                    'std'       => 'default.php',
                                    'type'      => 'images',
                                    //'fold'    => 'use_skin',
                                    'options'   => $alt_stylesheets_imgs);
		*/

	    do_action( 'ish_theme_options_after_themes_skins' );
	    do_action( 'ish_theme_options_before_color_options' );

	    /* *************************************************************************************************************
         * Color Options
         */
        $of_options[] = array(  'name'  => __( 'Color Options', 'ishyoboy' ),
                                'class' => 'coloroptions',
                                'type'  => 'heading');

		    // GLOBAL COLORS *******************************************************************************************
            $of_options[] = array(  'name'  => __( 'Global Colors', 'ishyoboy' ),
                                    'desc'  => __( 'Text color', 'ishyoboy' ),
                                    'id'    => 'text_color',
                                    'std'   => ISH_TEXT_COLOR,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type'  => 'color');

            $of_options[] = array( 	'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Body content color', 'ishyoboy' ),
                                    'id'    => 'body_color',
                                    'std'   => ISH_BODY_COLOR,
                                    'type' 	=> 'color');

            $of_options[] = array( 	'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Background color (when no pattern or image)', 'ishyoboy' ),
                                    'id'    => 'background_color',
                                    'std'   => ISH_BACKGROUND_COLOR,
                                    'type' 	=> 'color');

	        // BASE COLORS *********************************************************************************************
	        for ($i = 1; $i <= IYB_BASE_COLORS_COUNT; $i++){
		        $of_options[] = array(  'name'  => ( (1 == $i) ? __( 'Base colors', 'ishyoboy' ) : '' ),
								        'desc'  => __( 'Color', 'ishyoboy' ) . ' ' . $i,
								        'id'    => 'color' . $i,
								        'std'   => ( defined( 'ISH_COLOR_' . $i) ) ? constant('ISH_COLOR_' . $i) : '#ffffff',
								        'type'  => 'color');
		    }

	        // ADDITIONAL COLORS ***************************************************************************************
		    for ($i = IYB_BASE_COLORS_COUNT + 1; $i <= IYB_COLORS_COUNT; $i++){
			    $of_options[] = array(  'name'  => ( (IYB_BASE_COLORS_COUNT + 1 == $i) ? __( 'Additional Colors', 'ishyoboy' ) : '' ),
				                        'desc'  => __( 'Color', 'ishyoboy' ) . ' ' . $i,
				                        'id'    => 'color' . $i,
				                        'std'   => ( defined( 'ISH_COLOR_' . $i) ) ? constant('ISH_COLOR_' . $i) : '#ffffff',
				                        'type'  => 'color');
		    }

	        // HEADER COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Header Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'header_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_4,
                                        'text'          => ISH_TEXT_COLOR,
                                        'text_active'   => ISH_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

            $of_options[] = array(	'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Header Background opacity in %.', 'ishyoboy' ) . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>For pattern or background image set "0".', 'ishyoboy' ) . '<br>' . __( 'For solid background color - "100".', 'ishyoboy' ) . '</span>',
                                    'id'    => 'header_colors_bg_opacity',
                                    'std'   => 100,
                                    "min"   => '0',
                                    "step"  => '1',
                                    "max"   => '100',
                                    'type'  => 'sliderui' );

	        // MAIN NAVIGATION COLORS **********************************************************************************
            $of_options[] = array( 	'name'  => __( 'Main Navigation Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'main_nav_colors',
                                    'std'   => array(
	                                    'bg'            => '',
	                                    'bg_active'     => ISH_COLOR_5,
                                        'text'          => ISH_COLOR_2,
                                        'text_active'   => ISH_COLOR_4
                                    ),
                                    'type' 	=> 'color_set');

	        // MAIN NAVIGATION SUBMENU COLORS **************************************************************************
            $of_options[] = array( 	'name'  => __( 'Main Navigation Submenu Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'main_nav_submenu_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_1,
                                        'text'          => ISH_COLOR_4,
                                        'text_active'   => ISH_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        // TAGLINE COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Tagline Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'tagline_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_3,
                                        'headline_1'    => ISH_TEXT_COLOR,
                                        'headline_2'    => ISH_COLOR_2
                                    ),
	                                'type' 	=> 'color_set');

			// BREADCRUMBS BAR COLORS **********************************************************************************
            $of_options[] = array( 	'name'  => __( 'Breadcrumbs Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'breadcrumbs_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_1,
                                        'text'          => ISH_COLOR_3,
                                        'link'          => ISH_COLOR_3,
                                        'link_active'   => ISH_COLOR_5
                                    ),
	                                'type' 	=> 'color_set');

	        // SIDEBAR COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Sidebar Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'sidebar_colors',
                                    'std'   => array(
                                        'text'  => ISH_COLOR_2,
                                        'link1' => ISH_COLOR_1,
                                        'link2' => ISH_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => '', //__( 'Sidebar Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'sidebar_block_colors',
                                    'std'   => array(
	                                    'block_bg'      => ISH_COLOR_2,
	                                    'block_text'    => ISH_COLOR_3
                                    ),
                                    'type' 	=> 'color_set');

            // FOOTER COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Footer Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'footer_colors',
                                    'std'   => array(
	                                    'bg'    => ISH_COLOR_1,
                                        'text'  => ISH_COLOR_2,
                                        'link1' => ISH_COLOR_3,
                                        'link2' => ISH_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => '', //__( 'Footer Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'footer_block_colors',
                                    'std'   => array(
	                                    'block_bg'      => ISH_COLOR_2,
	                                    'block_text'    => ISH_COLOR_3
                                    ),
                                    'type' 	=> 'color_set');

            // FOOTER LEGALS COLORS ************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Footer Legals Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'footer_legals_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_4,
                                        'text'          => ISH_COLOR_2,
                                        'link'          => ISH_COLOR_5,
                                    ),
                                    'type' 	=> 'color_set');

			// SIDENAV COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Side Navigation Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'sidenav_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_5,
                                        'link'          => ISH_COLOR_3,
                                        'link_active'   => ISH_COLOR_1
                                    ),
                                    'type' 	=> 'color_set');

			// RESPNAV COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Responsive Navigation Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'respnav_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_5,
                                        'link'          => ISH_COLOR_3,
                                        'link_active'   => ISH_COLOR_1
                                    ),
                                    'type' 	=> 'color_set');

	        // SEARCH COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => __( 'Search Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'search_colors',
                                    'std'   => array(
	                                    'bg'            => ISH_COLOR_5,
                                        'text'          => ISH_COLOR_3,
                                        'text_active'   => ISH_COLOR_1
                                    ),
                                    'type' 	=> 'color_set');

	        // EXPANDABLE AREA COLORS **********************************************************************************
            $of_options[] = array( 	'name'  => __( 'Expandable Area Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'exparea_colors',
                                    'std'   => array(
	                                    'bg'    => ISH_COLOR_1,
                                        'text'  => ISH_COLOR_2,
                                        'link1' => ISH_COLOR_3,
                                        'link2' => ISH_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => '', //__( 'Expandable Area Colors', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'exparea_block_colors',
                                    'std'   => array(
	                                    'block_bg'      => ISH_COLOR_2,
	                                    'block_text'    => ISH_COLOR_3
                                    ),
                                    'type' 	=> 'color_set');


	    do_action( 'ish_theme_options_after_color_options' );
	    do_action( 'ish_theme_options_before_pattern_options' );

	    /* *************************************************************************************************************
         * Pattern Options
         */
        $of_options[] = array(  'name'  => __( 'Pattern Options', 'ishyoboy' ),
                                'class' => 'patternoptions',
                                'type'  => 'heading');

            // BACKGROUND PATTERN (BOXED LAYOUT ONLY) ******************************************************************
            $of_options[] = array(  'name'  => __( 'Background Pattern (Boxed layout only)', 'ishyoboy' ),
                                    'desc'  => '', //__( '', 'ishyoboy' ),
                                    'id'    => 'use_background_pattern',
                                    'std'   => 1,
                                    'on'    => __( 'Predefined', 'ishyoboy' ),
                                    'off'   => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array( 	'name' 		=> '', //__( '', 'ishyoboy' ),
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'background_bg_pattern',
                                    'std' 		=> 'solid-light-escheresque.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_background_pattern',
                                    'options'   => $bg_images);

            $of_options[] = array(  'name'  => '', //__( '', 'ishyoboy' ),
                                    'desc'  => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id'    => 'background_bg_image',
                                    'std'   => '',
                                    'fold'  => 'off_' . 'use_background_pattern',
                                    'mod'   => 'min',
                                    'type'  => 'media');

            $of_options[] = array(  'name'      => '', //__( '', 'ishyoboy' ),
                                    'desc'      => __( 'Background position', 'ishyoboy' ),
                                    'id'        => 'background_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_background_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => __( 'Repeat and scroll', 'ishyoboy' ),
                                        '1'     => __( 'Fixed and cover', 'ishyoboy' ),
                                    ));

            // HEADER PATTERN ******************************************************************************************
            $of_options[] = array(  'name' => __( 'Header pattern', 'ishyoboy' ),
                                    'desc' => 'solid-light-cream-pixels.png', //__( '', 'ishyoboy' ),
                                    'id' => 'use_header_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ) . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>The Header background color opacity must not be set to "100". See "Color Options" section.', 'ishyoboy' ), // . ' ' . '<a href="#section-header_colors">' . __( 'See setting', 'ishyoboy' ) . '</a>' .  '</span>',
                                    'id' 		=> 'header_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_header_pattern',
                                    'options' 	=> $bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ) . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>The Header background color opacity must not be set to "100". See "Color Options" section.', 'ishyoboy' ),  //. ' ' . '<a href="#section-header_colors">' . __( 'See setting', 'ishyoboy' ) . '</a>' .  '</span>',
                                    'id' => 'header_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_header_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //__( '', 'ishyoboy' ),
                                    'desc'      => __( 'Background position', 'ishyoboy' ),
                                    'id'        => 'header_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_header_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => __( 'Repeat and scroll', 'ishyoboy' ),
                                        '1'     => __( 'Cover', 'ishyoboy' ),
                                    ));

			// Expandable Pattern
            $of_options[] = array(  'name' => __( 'Expandable area pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_expandable_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'expandable_bg_pattern',
                                    'std' 		=> 'ish-transparent-stripes-very-dark.png',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_expandable_pattern',
                                    'options' 	=> $bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'expandable_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_expandable_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //__( '', 'ishyoboy' ),
                                    'desc'      => __( 'Background position', 'ishyoboy' ),
                                    'id'        => 'expandable_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_expandable_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => __( 'Repeat and scroll', 'ishyoboy' ),
                                        '1'     => __( 'Cover', 'ishyoboy' ),
                                    ));

            // LEAD PATTERN ********************************************************************************************
            $of_options[] = array(  'name' => __( 'Tagline pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_lead_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'lead_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_lead_pattern',
                                    'options' 	=> $bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'lead_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_lead_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //__( '', 'ishyoboy' ),
                                    'desc'      => __( 'Background position', 'ishyoboy' ),
                                    'id'        => 'lead_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_lead_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => __( 'Repeat and scroll', 'ishyoboy' ),
                                        '1'     => __( 'Cover', 'ishyoboy' ),
                                    ));

            // FOOTER PATTERN ******************************************************************************************
            $of_options[] = array(  'name' => __( 'Footer Widget area pattern', 'ishyoboy' ),
                                    'desc' => '', //__( '', 'ishyoboy' ),
                                    'id' => 'use_footer_pattern',
                                    'std' => 1,
                                    'on' => __( 'Predefined', 'ishyoboy' ),
                                    'off' => __( 'Custom', 'ishyoboy' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  __( 'Choose one of the pre-defined patterns.', 'ishyoboy' ),
                                    'id' 		=> 'footer_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_footer_pattern',
                                    'options' 	=> $bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => __( 'Upload and select custom pattern.', 'ishyoboy' ),
                                    'id' => 'footer_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_footer_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //__( '', 'ishyoboy' ),
                                    'desc'      => __( 'Background position', 'ishyoboy' ),
                                    'id'        => 'footer_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_footer_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => __( 'Repeat and scroll', 'ishyoboy' ),
                                        '1'     => __( 'Cover', 'ishyoboy' ),
                                    ));

	    do_action( 'ish_theme_options_after_pattern_options' );
	    do_action( 'ish_theme_options_before_font_options' );

	    /* *************************************************************************************************************
         * Font Options
         */
        $of_options[] = array(  'name'  => __( 'Font Options', 'ishyoboy' ),
                                'class' => 'fontoptions',
                                'type'  => 'heading');

	        // BODY FONT ***********************************************************************************************
            $id = 'body_font'; // Important!

            $of_options[] = array(  'name' => __( 'Body Font 1', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_2,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '16px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_2 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // BODY FONT ***********************************************************************************************
            $id = 'body_font_2'; // Important!

            $of_options[] = array(  'name' => __( 'Body Font 2', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '16px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            // HEADER FONT *********************************************************************************************
	        $id = 'header_font'; // Important!

            $of_options[] = array(  'name' => __( 'Header Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');
            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H1 FONT *************************************************************************************************
            $id = 'h1_font'; // Important!

            $of_options[] = array(  'name' => __( 'H1', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H2 FONT *************************************************************************************************
            $id = 'h2_font'; // Important!

            $of_options[] = array(  'name' => __( 'H2', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	         // H3 FONT ************************************************************************************************
            $id = 'h3_font'; // Important!

            $of_options[] = array(  'name' => __( 'H3', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            // H4 FONT *************************************************************************************************
	        $id = 'h4_font'; // Important!

            $of_options[] = array(  'name' => __( 'H4', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H5 FONT *************************************************************************************************
            $id = 'h5_font'; // Important!

            $of_options[] = array(  'name' => __( 'H5', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H6 FONT *************************************************************************************************
            $id = 'h6_font'; // Important!

            $of_options[] = array(  'name' => __( 'H6', 'ishyoboy' ),
                                    'desc' => __( 'Font Type', 'ishyoboy' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //__( 'Theme Google Font', 'ishyoboy' ),
                                    'desc' => __( 'Font Family', 'ishyoboy' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => __( 'Google font preview!', 'ishyoboy' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $googleFontsArray);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishyoboy_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //__( 'Theme Regular Font', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Family', 'ishyoboy' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_fonts);

            $of_options[] = array(  'name' => '', //__( 'Font Variant', 'ishyoboy' ),
                                    'desc' =>  __( 'Font Variant', 'ishyoboy' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ish_fonts[$id]['type']) ? $ish_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Font Size', 'ishyoboy' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ish_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> __( 'Line Height', 'ishyoboy' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ish_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	    do_action( 'ish_theme_options_after_styling_options' );
	    do_action( 'ish_theme_options_before_woocommerce_options' );

        /* *************************************************************************************************************
         * 7. Woocommerce Settings
         */
        if (ishyoboy_woocommerce_plugin_active()){
            $of_options[] = array(  'name' => __( 'Woocommerce', 'ishyoboy' ),
                                    'class' => 'woocommerce',
                                    'type' => 'heading');

	            // WOOCOMMERCE SIDEBAR *********************************************************************************
                $of_options[] = array(  'name' => __( 'Woocommerce Sidebar', 'ishyoboy' ),
                                        'desc' => __( "Display the sidebar on each woocommerce page by default. This settings can be overridden in each page's settings.", 'ishyoboy'), // . '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy' ) . '</span>',
                                        'id' => 'show_woocommerce_sidebar',
                                        'std' => 0,
                                        'folds' => 1,
                                        'type' => 'switch');

                $of_options[] = array(  'name' => '', //'name' => __( 'Woocommerce Sidebar position', 'ishyoboy' ),
                                        'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of woocommerce pages.', 'ishyoboy' ),
                                        'id'    => 'woocommerce_sidebar_position',
                                        'std'   => 'right',
                                        'fold'  => 'show_woocommerce_sidebar',
                                        'type'  => 'select',
                                        'options' => array('left' => 'Left', 'right' => 'Right'));

                $of_options[] = array(  'name' => '', //'name' => __( 'Woocommerce Sidebar', 'ishyoboy' ),
                                        'desc' => __( 'Select which sidebar will be displayed on each woocommerce page by default.', 'ishyoboy' ),
                                        'id' => 'woocommerce_sidebar',
                                        'std' => 'sidebar-woocommerce',
                                        'fold' => 'show_woocommerce_sidebar',
                                        'type' => 'select',
                                        'options' => $of_sidebars);

	            // PRODUCTS PER PAGE ***********************************************************************************
                $of_options[] = array(  'name' => __( 'Products per page', 'ishyoboy' ),
                                        'desc' => __( 'Number of products displayed per page. To see all items set the value to "-1"', 'ishyoboy' ),
                                        'id' => 'woocommerce_posts_per_page',
                                        'std' => '8',
                                        'type' => 'text');
        }

	    do_action( 'ish_theme_options_after_woocommerce_options' );
	    do_action( 'ish_theme_options_before_plugins_options' );

        /* *************************************************************************************************************
         * 8. Plugins Options
         */
	    $section_options = Array();
	    $section_heading = Array(
		    array(  'name' => __( 'Plugins Options' , 'ishyoboy' ),
                                'class' => 'pluginsoptions',
                                'type' => 'heading',
		    ),
	    );

	    // Allow plugins to create options
	    $section_options = apply_filters( 'ish_theme_options_section_content', $section_options, 'pluginsoptions' );

	    if ( count( $section_options ) >= 1 ){
		    $of_options = array_merge( $of_options, $section_heading, $section_options );
	    }

	    do_action( 'ish_theme_options_after_plugins_options' );
	    do_action( 'ish_theme_options_before_backup_options' );

        /* *************************************************************************************************************
         * 9. Backup Options
         */
        $of_options[] = array(  'name' => __( 'Backup Options' , 'ishyoboy' ),
                                'class' => 'backupoptions',
                                'type' => 'heading');

	        // BACKUP & RESTORE ****************************************************************************************
            $of_options[] = array( 'name' => __( 'Backup and Restore Options', 'ishyoboy' ),
                                'id' => 'of_backup',
                                'std' => '',
                                'type' => 'backup',
                                'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
                                );

	        // TRANSFER OPTIONS ****************************************************************************************
            $of_options[] = array( 'name' => __( 'Transfer Theme Options Data', 'ishyoboy' ),
                                'id' => 'of_transfer',
                                'std' => '',
                                'type' => 'transfer',
                                'desc' => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
                                    ',
                                );

	    do_action( 'ish_theme_options_after_backup_options' );
	    do_action( 'ish_theme_options_before_themeupdate_options' );

        /* *************************************************************************************************************
         * 10. Theme Update
         */
        $of_options[] = array(  'name' => __( 'Theme Update', 'ishyoboy' ),
                                'class' => 'themeupdate',
                                'ish-updates' => '1',
                                'type' => 'heading');

	        // THEME UPDATE ********************************************************************************************
            $of_options[] = array(  'name' => __( 'Theme Update', 'ishyoboy' ),
                                    'desc' => '',
                                    'id' => 'theme_update',
                                    'std' => '',
                                    'type' => 'theme_update');

	    do_action( 'ish_theme_options_after_themeupdate_options' );
	    do_action( 'ish_theme_options_before_demo_import_options' );

        /* *************************************************************************************************************
         * 10. Demo Content
         */
        $of_options[] = array(  'name' => __( 'Demo Data Import', 'ishyoboy' ),
                                'class' => 'demo_import',
                                'type' => 'heading');

	        // THEME UPDATE ********************************************************************************************
            $of_options[] = array(  'name' => __( 'Demo Data Import', 'ishyoboy' ),
                                    'desc' => '',
                                    'id' => 'demo_import',
                                    'std' => '',
                                    'type' => 'demo_import');

	    do_action( 'ish_theme_options_after_demo_import_options' );

	}
}