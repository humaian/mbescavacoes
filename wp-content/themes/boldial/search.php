<?php

get_header();

//<!-- Lead part section -->
$lead = '<div class="search-lead">';
$lead .= '<h1 class="color1 page-title">' . sprintf( __( 'Search Results for: %s', 'ishyoboy' ) ,  '<span>' . get_search_query() . '</span>' ) . '</h1>';
$lead .= '</div>';
ishyoboy_custom_part_tagline($lead);
//<!-- Lead part section -->

?>

<?php
// Breadcrumbs display
ishyoboy_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content' ); ?>">

		<?php if (have_posts()) :

			$results_count = 0;

			while (have_posts()) : the_post(); ?>

				<?php $results_count++; ?>

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-search-result">
					<div class="ish-vc_row_inner">
						<?php

						// SEPARATOR
						if ( $results_count > 1 ) echo '<div class="ish-sc-element ish-sc_separator ish-color1 ish-separator-thin ish-color13"></div>';

						// THUMBNAIL
						if ( has_post_thumbnail() ) {

							echo '<div class="ish-sc-element ish-search-result-image ish-sc_image ish-rounded">';
							echo '<a href="' . get_permalink() . '">';
							the_post_thumbnail( 'thumbnail' );
							echo '</a>';
							echo '</div>';

						}
						else {

							// No thumbnail
							if ( is_plugin_active('ishyoboy-boldial-assets/ishyoboy-boldial-assets.php') ){
								echo '<div class="ish-sc-element ish-search-result-image ish-sc_svg_icon ish-circle ish-color5 ish-glow">';
								echo '<a href="' . get_permalink() . '">';
								echo '<span><span style="background-image: url(\'' . plugins_url('ishyoboy-boldial-assets/ishyoboy-shortcodes/assets/frontend/images/icon-sets/beautiful-flat-icons/paper.svg') . '\');width:70px;height:70px;"></span></span>';
								echo '</a></div>';
							}
							else{
								echo '<div class="ish-sc-element ish-search-result-image ish-sc_icon ish-circle ish-color5 ish-text-color4 ish-glow" style="font-size:70px;width:70px;height:70px;">';
								echo '<a href="' . get_permalink() . '">';
								echo '<span style="width:70px;height:70px;"><span class="ish-icon-align-right" style="width:70px;height:70px;font-size:33.333333333333px;line-height:70px;"></span></span>';
								echo '</a></div>';
							}

						}
						?>

						<div class="search-details">

							<?php
							// TITLE
							$title = get_the_title();
							$title = ( ! empty( $title ) ) ? $title : __( 'No title', 'ishyoboy' );
							?>
							<h5 class="ish-sc-element ish-sc_headline"><a href="<?php the_permalink(); ?>"><?php echo $title ?></a></h5>

							<?php echo ishyoboy_custom_excerpt(get_the_content(), 40, get_search_query()); ?>
						</div>
					</div>
				</div>
			<?php endwhile;

			global $wp_query;
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

			?>


		<?php else : ?>

			<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
				<div class="ish-vc_row_inner">
					<h2 class="entry-title"><?php _e('No results found.', 'ishyoboy') ?></h2>
					<div class="entry-content">
						<p><?php _e("Sorry, the content you are looking for could not be found.", 'ishyoboy') ?></p>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</section>
	<!-- Content part section END -->

    <!-- #content  END -->
<?php  get_footer(); ?>