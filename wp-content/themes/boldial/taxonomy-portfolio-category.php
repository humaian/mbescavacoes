<?php

get_header();

$current_term = get_queried_object();

//<!-- Lead part section -->
$lead = '<h1>' . __( 'Category: ', 'ishyoboy' ) . $current_term->name . '</h1>';
$lead .= ( '' != $current_term->description ) ? '<h2>' . do_shortcode( $current_term->description ) . '</h2>' : '';
ishyoboy_custom_part_tagline( $lead );
//<!-- Lead part section -->

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
						<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
							<div class="ish-vc_row_inner">
								<div class="vc_col-sm-12 wpb_column column_container">
									<div class="wpb_wrapper">

										<?php
										// Get all global portfolio settings
										$atts = Array();
										foreach ( $ish_options as $key => $value ) {
											if ( 0 === strpos( $key, 'portfolio_' ) ){
												$atts[ str_replace('portfolio_', '', $key )] = $value;
											}
										}



										// var_dump( $atts );

										// Generate the shortcode
										$sc = '[ish_portfolio category="' . esc_attr( $current_term->slug ) . '" pagination="yes"';
										foreach ( $atts as $key => $value ){
											$sc .= ' ' . $key . '="' . $value . '"';
										}
										$sc .= ']';

										// Content with no sidebar
										$current_term = get_queried_object();

										if ( ! empty( $current_term ) ){
											echo apply_filters( 'ish_the_content', apply_filters('the_content', $sc ) );
											comments_template( '', true );
										}
										?>

									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
					// SIDEBAR
					get_sidebar();
					?>

				</div>
			</div>
		<?php
		} else {
			?>

			<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
				<div class="ish-vc_row_inner">
					<div class="vc_col-sm-12 wpb_column column_container">
						<div class="wpb_wrapper">
							<?php

							// Get all global portfolio settings
							$atts = Array();
							foreach ( $ish_options as $key => $value ) {
								if ( 0 === strpos( $key, 'portfolio_' ) ){
									$atts[ str_replace('portfolio_', '', $key )] = $value;
								}
							}

							// Generate the shortcode
							$sc = '[ish_portfolio category="' . esc_attr( $current_term->slug ) . '" pagination="yes"';
							foreach ( $atts as $key => $value ){
								$sc .= ' ' . $key . '="' . $value . '"';
							}
							$sc .= ']';

							// Content with no sidebar
							$current_term = get_queried_object();

							if ( ! empty( $current_term ) ){
								echo apply_filters( 'ish_the_content', apply_filters('the_content', $sc ) );
								comments_template( '', true );
							}
							?>
						</div>
					</div>
				</div>
			</div>


		<?php } ?>

	</section>
	<!-- Content part section END -->

	<!-- #content  END -->
<?php  get_footer(); ?>
