<?php

/* *********************************************************************************************************************
 * Misc
 */


// Header height -------------------------------------------------------------------------------------------------------
$header_height = ( isset( $newdata['header_height'] ) ) ? trim( $newdata['header_height'] ) : '';

if ( '' != $header_height ) {
	$header_height = str_replace('px;', '', $header_height);
	$header_height = str_replace('px', '', $header_height);
	$header_height = str_replace('%', '', $header_height);

	if ( (ISH_DEFAULT_HEADER_HEIGHT != $header_height) && is_numeric( $header_height ) ) {

		$maxwidth = $header_height - 50;
		if ( $maxwidth < 0 ){ $maxwidth = $header_height - 10; }
		if ( $maxwidth < 0 ){ $maxwidth = $header_height; }

		?>

		body.ish-sticky-on .ish-body { padding-top: <?php echo $header_height . 'px'; ?>; }
		.ish-sticky-on .ish-part_header + *:before { top: -<?php echo $header_height . 'px'; ?>; height: <?php echo $header_height . 'px'; ?>; }
		.ish-part_header .ish-row_inner { height: <?php echo $header_height . 'px'; ?>; }
		.ish-ph-logo img { max-height: <?php echo $maxwidth . 'px'; ?>; }

		<?php
	}
}

// Sticky height -------------------------------------------------------------------------------------------------------
$sticky_height = ( isset( $newdata['sticky_height'] ) ) ? trim( $newdata['sticky_height'] ) : '';

if ( '' != $sticky_height ) {
	$sticky_height = str_replace('px;', '', $sticky_height);
	$sticky_height = str_replace('px', '', $sticky_height);
	$sticky_height = str_replace('%', '', $sticky_height);

	if ( (ISH_DEFAULT_STICKY_HEIGHT != $sticky_height) && is_numeric( $sticky_height ) ) {

		$maxwidth = $sticky_height - 10;
		if ( $maxwidth < 0 ){ $maxwidth = $sticky_height; }
		
		?>

		.ish-sticky-scrolling .ish-ph-logo img { max-height: <?php echo $maxwidth . 'px'; ?>; }

	<?php
	}
}


// Retina logo ---------------------------------------------------------------------------------------------------------
if ( isset($newdata['logo_as_image']) && '1' == $newdata['logo_as_image'] ) {
	if ( ( isset( $newdata['logo_retina_image'] ) && '' != $newdata['logo_retina_image'] ) &&
		 ( isset( $newdata['logo_image'] ) && '' != $newdata['logo_image'] ) ) {
		?>

		@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
			.ish-ph-logo.ish-ph-logo_retina-yes img {
				visibility: hidden;
			}

			.ish-ph-logo.ish-ph-logo_retina-yes {
				background: url('<?php echo $newdata['logo_retina_image']; ?>') center center no-repeat;
				background-size: 100% auto;
			}
		}

		<?php
	}
}