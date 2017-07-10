<?php

/*
 * Get header.php
 */
get_header();
$page = get_post( get_option( 'page_for_posts' ) );

?>
<?php

if ( 'page' == get_option('show_on_front') ){
	ishyoboy_get_part_tagline( $page->ID );
}
else{
	$lead = '<h1>' . get_bloginfo('name') . '</h1>';
	ishyoboy_custom_part_tagline( $lead );
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
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content ish-blog ish-blog-' . $blog_style . $masonry_layout  ); ?>"<?php echo $blog_cols; ?>>

		<?php if ( 'page' == get_option('show_on_front') && isset($page) && '' != $page && '' != $page->post_content) :?>
			<?php echo apply_filters( 'ish_the_content', apply_filters( 'the_content',  $page->post_content ) ); ?>
		<?php endif; ?>

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

							echo ishyoboy_blog_categories();

							if ( 'masonry' == $blog_style ){
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

						<?php }?>
					</div>

					<?php
					// SIDEBAR
					get_sidebar();
					?>

				</div>
			</div>
		<?php
		} else {
			// Content with no sidebar
			if (have_posts()) {

				if ( 'masonry' == $blog_style ){
					echo '<span class="ish-preloader"></span>';
				}

				echo ishyoboy_blog_categories();

				if ( 'masonry' == $blog_style ){
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
		} ?>
	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>