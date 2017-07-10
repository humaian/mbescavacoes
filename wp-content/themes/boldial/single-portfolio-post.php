<?php

get_header();

?>

<?php ishyoboy_get_part_tagline( ish_get_the_ID() ); ?>

<?php ishyoboy_show_breadcrumbs(); ?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishyoboy_has_sidebar() ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishyoboy_get_content_class(); ?>">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php ishyoboy_the_content(); ?>
							<?php comments_template('', true); ?>
						<?php endwhile; else: ?>
							<p><?php _e('Sorry, no pages matched your criteria.', 'ishyoboy'); ?></p>
						<?php endif; ?>
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
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php ishyoboy_the_content(); ?>
				<?php comments_template('', true); ?>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no pages matched your criteria.', 'ishyoboy'); ?></p>
			<?php endif; ?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php  get_footer();