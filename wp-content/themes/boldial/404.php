<?php

$id_404 = ( isset( $ish_options['use_page_for_404'] ) && ( '1' == $ish_options['use_page_for_404'] ) && isset( $ish_options['page_for_404'] ) ) ? $ish_options['page_for_404'] : '';

get_header();

if ( '' != $id_404 && '-1' != $id_404 ){
	// 404 Page set in the backend
	ishyoboy_get_part_tagline( $id_404 );

	// Breadcrumbs display
	ishyoboy_show_breadcrumbs();
	?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishyoboy_has_sidebar( $id_404 ) ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishyoboy_get_content_class( $id_404 ); ?>">
						<?php

						$my_post = get_post($id_404);
						$content = apply_filters( 'the_content', $my_post->post_content );
						echo apply_filters( 'ish_the_content', $content );

						?>
					</div>

					<?php
					// SIDEBAR
					get_sidebar('404');
					?>

				</div>
			</div>
		<?php
		} else {
			// Content with no sidebar
			$my_post = get_post($id_404);
			$content = apply_filters( 'the_content', $my_post->post_content );
			echo apply_filters( 'ish_the_content', $content );
			?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php }
else{
	// USE DEFAULT 404 TEMPLATE
	ishyoboy_custom_part_tagline('<h1 class="color1">Oups!</h1><h2>Seems like there\'s no such page.</h2>');
	?>

	<?php
	// Breadcrumbs display
	ishyoboy_show_breadcrumbs();
	?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ish_part_content_classes', 'ish-part_content' ); ?>">
	    <div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
		    <div class="ish-vc_row_inner">
			    <p>We've searched more than <strong>404</strong> pages and none of them seems to be the one you we're looking for.</p>
			    <p>Why don't you have a look around and try to find it?</p>
		    </div>
	    </div>
	</section>
	<!-- Content part section END -->
	<?php
}
?>

<!-- #content  END -->
<?php  get_footer(); ?>