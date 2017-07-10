<?php

/*
 * Get header.php
 */
get_header();

?>

<?php

if ( is_category() ){
	$current_term = get_queried_object();
	$lead = '<div class="ish-category-lead">';
	$lead .= '<h1 class="color1">' . __( 'Category: ', 'ishyoboy' ) . $current_term->name . '</h1>';
	$lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
	$lead .= '</div>';
	ishyoboy_custom_part_tagline($lead);
}
elseif (is_tag()){
	$current_term = get_queried_object();
	$lead = '<div class="ish-tag-lead">';
	$lead .= '<h1 class="color1">' . __( 'Tag: ', 'ishyoboy' ) . $current_term->name . '</h1>';
	$lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
	$lead .= '</div>';
	ishyoboy_custom_part_tagline($lead);
}
elseif (is_archive()){
	$lead = '<div class="ish-archive-lead"><h1 class="color1">';
	if ( is_day() ) :
		$lead .= sprintf( __( 'Daily Archives: %s', 'ishyoboy' ), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
		$lead .= sprintf( __( 'Monthly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ishyoboy' ) ) . '</span>' );
	elseif ( is_year() ) :
		$lead .= sprintf( __( 'Yearly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ishyoboy' ) ) . '</span>' );
	else :
		$lead .= __( 'Archives', 'ishyoboy' );
	endif;
	$lead .= '</h1></div>';
	ishyoboy_custom_part_tagline($lead);
}
else{
	ishyoboy_get_part_tagline(get_the_ID());
}
?>

<?php
// Breadcrumbs display
ishyoboy_show_breadcrumbs();
?>
	<?php
	$blog_style = ( isset( $ish_options ) && isset( $ish_options['blog_overview_style'] ) ) ? $ish_options['blog_overview_style']  : 'classic';
	$blog_cols = ( isset( $ish_options ) && isset( $ish_options['blog_masonry_columns'] ) && 'masonry' == $blog_style ) ? ( ' data-count="' . $ish_options['blog_masonry_columns'] . '"' )  : '';
	$masonry_layout = ( 'masonry' == $blog_style && isset( $ish_options ) && isset( $ish_options['blog_masonry_layout_style'] ) && 'grid' == $ish_options['blog_masonry_layout_style'] ) ? ' ish-blog-masonry-layout-grid'  : '';
	?>
	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content ish-blog ish-blog-' . $blog_style . $masonry_layout ); ?>"<?php echo $blog_cols; ?>>

		<?php

		if ( ishyoboy_has_sidebar() ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishyoboy_get_content_class(); ?>">
						<?php if (have_posts()) {

							if ( 'masonry' == $blog_style ){
								echo '<span class="ish-preloader"></span>';
							}

							if ( is_category() ){
								echo ishyoboy_blog_categories();
							}

							if ('masonry' == $blog_style ){
								$mass_row_style = ( isset( $ish_options['blog_masonry_row_style'] ) && 'full' == $ish_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
								echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
							}

							while (have_posts()) {

								the_post();

								$format = get_post_format();
								if( false === $format ) { $format = 'standard'; }
								get_template_part( 'content-post', $format );

							}

							if ('masonry' == $blog_style ){
								echo '</div></div></div>';
							}

							if(empty($paged) || 0 == $paged) $paged = 1;

							$pg = ishyoboy_get_pagination('', 3, $wp_query->max_num_pages, $paged);
							if ('' != $pg){
								?>
								<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
									<div class="ish-vc_row_inner">
										<?php
										echo $pg;
										?>
									</div>
								</div>
							<?php
							}


						} else {  ?>

							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php _e( 'Sorry, there is nothing to be displayed in here.', 'ishyoboy'); ?>
								</div>
							</div>

						<?php } ?>
					</div>

					<?php
					// SIDEBAR
					get_sidebar();
					?>

				</div>
			</div>
		<?php
		} else {

			if (have_posts()) {

				if ( 'masonry' == $blog_style ){
					echo '<span class="ish-preloader"></span>';
				}

				if ( is_category() ){
					echo ishyoboy_blog_categories();
				}

				if ('masonry' == $blog_style ){
					$mass_row_style = ( isset( $ish_options['blog_masonry_row_style'] ) && 'full' == $ish_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
					echo '<div class="wpb_row vc_row-fluid ' . $mass_row_style . ' ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
				}

				while (have_posts()) {

					the_post();

					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'content-post', $format );

				}

				if ('masonry' == $blog_style ){
					echo '</div></div></div>';
				}

				if(empty($paged) || 0 == $paged) $paged = 1;

				$pg = ishyoboy_get_pagination('', 3, $wp_query->max_num_pages, $paged);
				if ('' != $pg){
					?>
					<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
						<div class="ish-vc_row_inner">
							<?php
							echo $pg;
							?>
						</div>
					</div>
				<?php
				}


			} else {  ?>

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">
						<?php _e( 'Sorry, there is nothing to be displayed in here.', 'ishyoboy'); ?>
					</div>
				</div>

			<?php }

		}?>



	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>