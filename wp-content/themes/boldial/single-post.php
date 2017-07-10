<?php

/*
 * Get header.php
 */
get_header();

// Get Framework settings, do not remove!
global $ish_options;

// Get Sidebar width options, do not remove!
global $sidebar_width;


?>


<?php ishyoboy_get_part_tagline( ish_get_the_ID() ); ?>

<?php
// Breadcrumbs display
ishyoboy_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishyoboy_has_sidebar() ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishyoboy_get_content_class(); ?>">
						<?php if (have_posts()) {

							while (have_posts()) {

								the_post();

								$format = get_post_format();
								if( false === $format ) { $format = 'standard'; }
								get_template_part( 'content-post', $format );

							}
							?>
							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php
									ishyoboy_show_addthis();
									?>
								</div>
							</div>
							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php
									ishyoboy_blogpost_prev_next();
									?>
								</div>
							</div>
							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php
									comments_template('', true);
									?>
								</div>
							</div>
							<?php

						} else {  ?>

							<div id="post-0" <?php post_class(); ?>>

								<h2 class="entry-title"><?php _e('Error 404 - Page Not Found', 'ishyoboy') ?></h2>

								<div class="entry-content">
									<p><?php _e("Sorry, the content you are looking for could not be found.", 'ishyoboy') ?></p>
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
			// Content with no sidebar
			?>
			<?php if (have_posts()) {

				while (have_posts()) {

					the_post();

					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'content-post', $format );

				}

				?>
				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">
						<?php
						ishyoboy_show_addthis();
						?>
					</div>
				</div>
				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">
						<?php
						ishyoboy_blogpost_prev_next();
						?>
					</div>
				</div>

				<?php comments_template('', true); ?>

				<?php

			} else {  ?>

				<div id="post-0" <?php post_class(); ?>>

					<h2 class="entry-title"><?php _e('Error 404 - Page Not Found', 'ishyoboy') ?></h2>

					<div class="entry-content">
						<p><?php _e("Sorry, the content you are looking for could not be found.", 'ishyoboy') ?></p>
					</div>

				</div>

			<?php } ?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>