<?php

/* *********************************************************************************************************************
 * Fonts
 */

global $ish_fonts;


// FONT SETTINGS
ishyoboy_load_font_settings('body_font', $newdata);     // Lato / regular / 16px / 22px
ishyoboy_load_font_settings('body_font_2', $newdata);     // Lato / regular / 16px / 22px
ishyoboy_load_font_settings('header_font', $newdata);   // Ubuntu / 500 / 15px / 18px
ishyoboy_load_font_settings('h1_font', $newdata);       // Ubuntu / 700 / 60px / 70px
ishyoboy_load_font_settings('h2_font', $newdata);       // Ubuntu / 700 / 40px / 48px
ishyoboy_load_font_settings('h3_font', $newdata);       // Ubuntu / 500 / 24px / 30px
ishyoboy_load_font_settings('h4_font', $newdata);       // Ubuntu / 500 / 19px / 24px
ishyoboy_load_font_settings('h5_font', $newdata);       // Ubuntu / 500 / 16px / 20px
ishyoboy_load_font_settings('h6_font', $newdata);       // Ubuntu / 500 / 12px / 15px


foreach ( $ish_fonts as $key => $val){

    switch ( $val['variant'] ){
        case '100' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '100italic' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '200' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '200italic' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '300' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '300italic' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case 'regular' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case 'italic' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '500' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '500italic' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '600' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '600italic' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '700' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '700italic' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '800' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '800italic' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '900' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '900italic' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
    }

	if ( ! isset($ish_fonts[$key]['font-style']) ) {
		$ish_fonts[$key]['font-style'] = 'normal';
	}

}
?>


/* Body font 1 ------------------------------------------------------------------------------------------------------ */
body,
.ish-gmap_box,
.ish-ph-main_nav .sub-menu a {
	font-family:    '<?php echo $ish_fonts['body_font']['css_string']; ?>', sans-serif !important;
	font-weight:    <?php echo $ish_fonts['body_font']['variant']; ?>;
}


p, ul, ol, div, .ish-gmap_box,
.ish-ph-main_nav .sub-menu a{
	font-size:      <?php echo $ish_fonts['body_font']['size']; ?>px;
	font-style:     <?php echo $ish_fonts['body_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['body_font']['line_height']; ?>px;
}

.ish-ph-main_nav .sub-menu a{
	font-size:	14px;
}


/* Body font 2 ------------------------------------------------------------------------------------------------------ */
.widget_calendar #wp-calendar caption,
.widget_calendar #wp-calendar tfoot a,
.widget_ishyoboy-recent-portfolio-widget .ish-button-small,
.widget_ishyoboy-dribbble-widget .ish-button-small,
.widget_ishyoboy-flickr-widget .ish-button-small,
.widget_ishyoboy-twitter-widget .ish-button-small,
.widget_tag_cloud a,
.ish-part_legals,
.ish-sc_button,
.ish-sc_quote[class*=" ish-h"],
.ish-sc_skills .ish-sc_skill,
.ish-p-headline,
.ish-sidenav,
.ish-blog-post-details,
.ish-blog-post-links,
.ish-section-filter li,
.ish-pagination a, .ish-pagination span,
.ish-single_post_navigation a,
.comment-reply-link, .comment-edit-link, .comment-awaiting-moderation,
input[type="submit"],
.wpcf7-validation-errors, .wpcf7-mail-sent-ok, .ish-alert-notice,
.rc-post-details-top, .rc-post-details-bottom,
.recent_posts_post_content a.pt-link, .recent_posts_post_content .post-quote-content,
.ish-link-content,

.wc-forward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.place-order .button,
.button[name="save_address"],
.single_add_to_cart_button.button,
.woocommerce-pagination .page-numbers,
.widget_product_tag_cloud a,
.shipping-calculator-button,
.woocommerce-error, .woocommerce-message, .woocommerce-info,
.woocommerce-tabs .tabs a,
.demo_store,
.added_to_cart,
.ish-sc_menu li a
{
	font-family:    '<?php echo $ish_fonts['body_font_2']['css_string']; ?>', sans-serif !important;
}


/* Header font ------------------------------------------------------------------------------------------------------ */
.ish-part_header div,
.ish-ph-main_nav a,
.ish-ph-mn-be_resp a {
	font-family:    '<?php echo $ish_fonts['header_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['header_font']['size']; ?>px;
	font-style:     <?php echo $ish_fonts['header_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['header_font']['line_height']; ?>px;
}


/* Headlines -------------------------------------------------------------------------------------------------------- */
h1, .ish-h1, .ish-sc_quote .ish-h1, .widget .ish-h1,
.ish-part_searchbar input[type="text"] {
	font-family:    '<?php echo $ish_fonts['h1_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h1_font']['size']; ?>px !important;  /* !important because of VC */
	font-weight:    <?php echo $ish_fonts['h1_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h1_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h1_font']['line_height']; ?>px;
}


h2, .ish-h2, .ish-sc_quote .ish-h2, .widget .ish-h2 {
	font-family:    '<?php echo $ish_fonts['h2_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h2_font']['size']; ?>px;
	font-weight:    <?php echo $ish_fonts['h2_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h2_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h2_font']['line_height']; ?>px;
}


h3, .ish-h3, .ish-sc_quote .ish-h3, .widget .ish-h3 {
	font-family:    '<?php echo $ish_fonts['h3_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h3_font']['size']; ?>px;
	font-weight:    <?php echo $ish_fonts['h3_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h3_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h3_font']['line_height']; ?>px;
}


h4, .ish-h4, .ish-sc_quote .ish-h4, .widget .ish-h4 {
	font-family:    '<?php echo $ish_fonts['h4_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h4_font']['size']; ?>px;
	font-weight:    <?php echo $ish_fonts['h4_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h4_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h4_font']['line_height']; ?>px;
}


h5, .ish-h5, .ish-sc_quote .ish-h5, .widget .ish-h5 {
	font-family:    '<?php echo $ish_fonts['h5_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h5_font']['size']; ?>px;
	font-weight:    <?php echo $ish_fonts['h5_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h5_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h5_font']['line_height']; ?>px;
}


h6, .ish-h6, .ish-sc_quote .ish-h6, .widget .ish-h6 {
	font-family:    '<?php echo $ish_fonts['h6_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo $ish_fonts['h6_font']['size']; ?>px;
	font-weight:    <?php echo $ish_fonts['h6_font']['variant']; ?>;
	font-style:     <?php echo $ish_fonts['h6_font']['font-style']; ?>;
	line-height:    <?php echo $ish_fonts['h6_font']['line_height']; ?>px;
}


/* Uppercase */
.ish-ph-logo,
.ish-ph-main_nav,
.ish-ph-mn-be_resp li a,
.ish-part_searchbar input[type="text"],
.ish-sidenav a,
.ish-part_breadcrumbs,
.widget_ishyoboy-dribbble-widget .ish-button-small,
.widget_ishyoboy-flickr-widget .ish-button-small,
.widget_ishyoboy-recent-portfolio-widget .ish-button-small,
.widget_ishyoboy-twitter-widget .ish-button-small,
.widget_calendar #wp-calendar caption,
.widget_calendar #wp-calendar tfoot a,
.widget-title, .widget-title a,
.ish-blog-post-details a, .ish-blog-post-links a,
.ish-single_post_navigation a,
.widget_tag_cloud a,
.ish-comments-headline,
.ish-add-comment-headline,
.ish-comments h5,
input[type="submit"],
.wpcf7-validation-errors, .wpcf7-mail-sent-ok, .ish-alert-notice,
.rc-post-details-top, .rc-post-details-bottom a,
.ish-recent_posts-read_more,
.recent_posts_post_content a.pt-link, .recent_posts_post_content .post-quote-content,

.wc-forward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.place-order .button,
.button[name="save_address"],
.single_add_to_cart_button.button,
.widget_product_tag_cloud a,
.shipping-calculator-button,
.woocommerce-error, .woocommerce-message, .woocommerce-info,
.woocommerce-tabs .tabs a,
.demo_store,
.added_to_cart,
.woocommerce .products .button,
.ish-section-filter
{
   text-transform: uppercase;
}

.ish-ph-main_nav .sub-menu a{
	text-transform: none;
}