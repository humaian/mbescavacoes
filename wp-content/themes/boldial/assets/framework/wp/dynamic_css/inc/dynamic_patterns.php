<?php

/* *********************************************************************************************************************
 * Patterns
 */

$images_path = str_replace('http://', '//', IYB_HTML_URI . '/images');
$images_path = str_replace('https://', '//', $images_path );


// Background pattern / image ------------------------------------------------------------------------------------------
$pattern = '';
$id = 'background';
$image_styles = '';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[$id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[$id . '_bg_pattern'];
} else {
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata['background_bg_image'];

        if ( isset($newdata[$id . '_bg_image_cover'] ) && ( '1' == $newdata[$id . '_bg_image_cover'] ) ) {
            $image_styles = 'background-attachment: fixed; background-size: cover;';
        }
        else {
            $image_styles = 'background-attachment: scroll; background-size: auto;';
        }
    }
}
if ( '' != $pattern ) { echo '.ish-body { background-image: url(\'' . $pattern . '\'); ' . $image_styles . '}'; }


// HEADER PATTERN ------------------------------------------------------------------------------------------------------
$pattern = '';
$id = 'header';
$image_styles = '';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[$id . '_bg_pattern'];
} else {
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];

        if ( isset($newdata[$id . '_bg_image_cover'] ) && ( '1' == $newdata[$id . '_bg_image_cover'] ) ) {
            $image_styles = 'background-attachment: auto; background-size: cover; background-position: center center;';
        }
        else {
            $image_styles = 'background-attachment: scroll; background-size: auto;';
        }
    }
}
if ( '' != $pattern ) { echo '.ish-part_' . $id . ' { background-image: url(\'' . $pattern . '\'); ' . $image_styles . '}'; }

// EXPANDABLE PATTERN
$pattern = '';
$id = 'expandable';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
	$pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
	if ( '' != $pattern ) { echo '.ish-part_' . $id . ' .ish-pe-bg { background-image: url(\'' . $pattern . '\') !important; ' . $image_styles . ' }'; }
} else{
	if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
		$pattern = $newdata[ $id . '_bg_image'];

		if ( isset($newdata[$id . '_bg_image_cover'] ) && ( '1' == $newdata[$id . '_bg_image_cover'] ) ) {
			//$image_styles = 'background-attachment: fixed !important; background-size: cover !important; background-position: center center !important;';
			$image_styles = 'background-size: cover !important;';
			if ( '' != $pattern ) { echo '.ish-part_' . $id . ' { background-image: url(\'' . $pattern . '\') !important; ' . $image_styles . ' } .ish-pe-bg { background: none !important; }'; }
		}
		else {
			$image_styles = 'background-attachment: scroll !important; background-size: auto;';
			if ( '' != $pattern ) { echo '.ish-part_' . $id . ' .ish-pe-bg { background-image: url(\'' . $pattern . '\') !important; ' . $image_styles . ' }'; }
		}
	}
}

// LEAD / TAGLINE PATTERN ----------------------------------------------------------------------------------------------
$pattern = '';
$id = 'lead';
$image_styles = '';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[$id . '_bg_pattern'];
} else {
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[$id . '_bg_image'];

        if ( isset($newdata[$id . '_bg_image_cover'] ) && ( '1' == $newdata[$id . '_bg_image_cover'] ) ) {
            $image_styles = 'background-attachment: auto; background-size: cover; background-position: center center;';
        }
        else {
            $image_styles = 'background-attachment: scroll; background-size: auto;';
        }
    }
}
if ( '' != $pattern ) { echo '.ish-part_tagline { background-image: url(\'' . $pattern . '\') !important; ' . $image_styles . '}'; }


// FOOTER PATTERN ------------------------------------------------------------------------------------------------------
$pattern = '';
$id = 'footer';
$image_styles = '';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else {
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];

        if ( isset($newdata[$id . '_bg_image_cover'] ) && ( '1' == $newdata[$id . '_bg_image_cover'] ) ) {
            $image_styles = 'background-attachment: auto; background-size: cover; background-position: center center;';
        }
        else {
            $image_styles = 'background-attachment: scroll; background-size: auto;';
        }
    }
}
if ( '' != $pattern ) { echo '.ish-part_' . $id . ' { background-image: url(\'' . $pattern . '\') !important; ' . $image_styles . '}'; }