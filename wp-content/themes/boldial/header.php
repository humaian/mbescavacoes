<?php

global $ish_options;
global $sidebar_width;
global $ish_woo_id;
global $id_404;

?>
<!doctype html>

<!--[if IE 8]><html class="ie8 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]><html class="ie9 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 10]><html class="ie10 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>><!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">

        <title><?php ishyoboy_title(); ?></title>

        <?php if ( function_exists( 'ishyoboy_meta_head' ) ){ ishyoboy_meta_head(); } ?>
        <meta name="author" content="IshYoBoy.com">

        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png (72x72) in the root directory -->
        <?php if ( function_exists( 'ishyoboy_meta_head' ) ){echo ishyoboy_get_favicon(); } ?>

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <!-- HTML5 enabling script -->
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <?php
        /*
         * Call wp head
         */
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
        wp_head();
        ?>
        <!--[if IE 8]><link rel="stylesheet" href="<?php echo IYB_HTML_URI_CSS . '/ie8.css'; ?>"><![endif]-->

    </head>



    <body <?php body_class( ishyoboy_get_boxed_layout_class() . ' ' . ishyoboy_get_responsive_layout_class() . ' ' . ishyoboy_is_sticky_nav_on() . ' ' . ishyoboy_is_sticky_nav_responsive_on()); ?>>

        <?php
	    if ( ishyoboy_use_sidenav() ) {
	    ?>
        <!-- Floated menu -->
	    <div class="ish-sidenav <?php echo ishyoboy_get_sidenav_position_class(); ?>">
		    <a href="#close" class="ish-sidenav-close ish-icon-cancel" title="<?php _e( 'Close Side Navigation (ESC)', 'ishyoboy' ); ?>"></a>
		    <?php

		    $main_menu = ishyoboy_get_mainnav_menu();
		    $nav_type_class = ishyoboy_get_mainnav_type_class();
		    if ( '' != $main_menu ) {
			    wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu' => $main_menu, 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'fallback_cb' => 'ishyoboy_empty_menu_fallback' ) );
		    }else{
		        wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'fallback_cb' => 'ishyoboy_empty_menu_fallback' ) );
		    }

		    ?>
	    </div>
	    <!-- Floated menu END -->
	    <?php
	    }
	    ?>



        <div class="ish-body">

		    <!-- Expandable part section -->
		    <?php if ( ishyoboy_use_expandable_header() ){?>
			    <section class="ish-part_expandable ish-a-expandable">

				    <!-- Must be one layer more because of min-height if content is less than height of browser -->
				    <div class="ish-pe-bg">

					    <a href="#close" class="ish-pe-close ish-icon-cancel" title="<?php _e( 'Close Expandable (ESC)', 'ishyoboy' ); ?>"></a>

					    <div class="ish-row ish-row-notfull">
						    <div class="ish-row_inner">
							    <?php $sidebar_width = 12; ?>

							    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(ishyoboy_get_expandable_header())) : else : ?>

								    <!-- NO WIDGETS -->

							    <?php endif; ?>
						    </div>
					    </div>

					</div>

			    </section>
		    <?php } ?>
		    <!-- Expandable part section END -->


		    <!-- Search bar -->
		    <section class="ish-part_searchbar ish-a-search">
			    <div>
				    <?php get_template_part( 'searchform-header' ); ?>
			    </div>
		    </section>
		    <!-- Search bar END -->


		    <!-- Wrap whole page -->
		    <div class="ish-wrapper-all">

		        <!-- Header part section -->
			    <section class="ish-part_header">
				    <div class="ish-row ish-row-notfull">
					    <div class="ish-row_inner">



						    <!-- Logo image / text -->
							<?php if ( ishyoboy_use_logo() && ishyoboy_is_logo() ){ ?>
							    <a class="ish-ph-logo <?php echo ( ishyoboy_use_logo() && ishyoboy_is_retina_logo() ) ? 'ish-ph-logo_retina-yes' : 'ish-ph-logo_retina-no'; ?>" href="<?php echo esc_attr( apply_filters( 'ishyoboy_logo_url', home_url() ) ); ?>">
								    <span>
									    <img src="<?php echo $ish_options['logo_image']; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" />
									</span>
							    </a>
						    <?php } else { ?>
							    <a class="ish-ph-logo" href="<?php echo esc_attr( apply_filters( 'ishyoboy_logo_url', home_url() ) ); ?>">
								    <span>
									    <?php echo esc_attr(get_bloginfo('name')); ?>
								    </span>
							    </a>
						    <?php } ?>

						    <!-- Default WordPress tagline -->
						    <?php
						    $blog_tagline = get_bloginfo('description');

						    if ('' != $blog_tagline) {
							    ?><span class="ish-ph-wp_tagline"><span><?php echo $blog_tagline; ?></span></span><?php
						    }
						    ?>

						    <!-- Main navigation -->
						    <nav class="ish-ph-main_nav">
							    <?php if ( ! ishyoboy_use_sidenav() ) {
							        $main_menu = ishyoboy_get_mainnav_menu();
								    $nav_type_class = ishyoboy_get_mainnav_type_class();
								    if ( '' != $main_menu ) {
									    wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu' => $main_menu, 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'container_class' => 'ish-ph-mn-center', 'fallback_cb' => 'ishyoboy_empty_menu_fallback' ) );
								    }else{
									    wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'container_class' => 'ish-ph-mn-center', 'fallback_cb' => 'ishyoboy_empty_menu_fallback' ) );
								    }

								} ?>

							    <!-- Responsive or sidenav navigation -->
							    <?php ishyoboy_create_resp_nav(); ?>

						    </nav>
						</div>
					</div>
				</section>
		        <!-- Header part section END -->