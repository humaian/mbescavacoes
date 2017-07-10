<?php

/**
 * Older VC version detected notice
 */
if ( ! function_exists( 'ishyoboy_old_vc_version_notice' ) ){
	function ishyoboy_old_vc_version_notice() {

		global $current_user, $ish_supported_vc_version;
		$userid = $current_user->ID;


		// Only show this notice if user hasn't already dismissed it
		// Take a good look at "Dismiss" link href attribute
		if ( current_user_can( 'install_plugins' ) && ! get_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_old_vc_version_notice' ) ) {
			echo '<div class="error ishyoboy_vc_version_notice">'; // Notices Classes - "updated", "error", "update-nag"
			echo '<h3>' . __( 'Incompatible Visual Composer version detected!', 'ishyoboy' ) . '</h3>';
			echo '<p>' . sprintf( __( '%1$s theme may not work properly with your current Visual Composer version (v.%2$s). Please, either deactivate the Visual Composer Plugin or replace it with version %3$s.', 'ishyoboy' ), PARENT_THEME_NAME, WPB_VC_VERSION, $ish_supported_vc_version ) . ' <a href="?ishyoboy_dismiss_notice=old_vc_version">Dismiss</a>' . '</p>';
			echo '</div>';
		}

	}
}

/**
 * Newer VC version detected notice
 */
if ( ! function_exists( 'ishyoboy_new_vc_version_notice' ) ){
	function ishyoboy_new_vc_version_notice() {

		global $current_user, $ish_supported_vc_version;
		$userid = $current_user->ID;

		// Only show this notice if user hasn't already dismissed it
		// Take a good look at "Dismiss" link href attribute
		if ( current_user_can( 'install_plugins' ) && ! get_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_new_vc_version_notice' ) ) {
			echo '<div class="updated ishyoboy_vc_version_notice">'; // Notices Classes - "updated", "error", "update-nag"
			echo '<p>' . sprintf( __( 'You have a newer Visual Composer than the one %1$s is 100%% compatible with. If you face any issues either deactivate Visual Composer Plugin or replace it with version %3$s.', 'ishyoboy' ), PARENT_THEME_NAME, WPB_VC_VERSION, $ish_supported_vc_version ) . ' <a href="?ishyoboy_dismiss_notice=new_vc_version">Dismiss</a>' . '</p>';
			echo '</div>';
		}

	}
}

/**
 * Add user meta value when Dismiss link is clicked
 */
if ( ! function_exists( 'ishyoboy_dismiss_admin_notice' ) ){
	function ishyoboy_dismiss_admin_notice() {

		global $current_user;
		$userid = $current_user->ID;

		// If "Dismiss" link has been clicked, user meta field is added
		if ( isset( $_GET['ishyoboy_dismiss_notice'] ) && 'new_vc_version' == $_GET['ishyoboy_dismiss_notice'] ) {
			add_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_new_vc_version_notice', 'yes', true );
		}

		if ( isset( $_GET['ishyoboy_dismiss_notice'] ) && 'old_vc_version' == $_GET['ishyoboy_dismiss_notice'] ) {
			add_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_old_vc_version_notice', 'yes', true );
		}

	}
}
add_action( 'admin_init', 'ishyoboy_dismiss_admin_notice' );

/**
 * Clear saved information about notices dismiss
 */
if ( ! function_exists( 'ishyoboy_clear_vc_version_dismiss' ) ){
	function ishyoboy_clear_vc_version_dismiss() {

		global $current_user;
		$userid = $current_user->ID;

		delete_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_new_vc_version_notice');
		delete_user_meta( $userid, 'ishyoboy_' . THEME_SLUG . '_ignore_old_vc_version_notice');

	}
}

register_activation_hook( 'js_composer/js_composer.php' , 'ishyoboy_clear_vc_version_dismiss' );

// Remove dismiss notices on VC activation
/*if ( ( isset( $_GET['action'] ) && 'activate' == $_GET['action'] ) && ( isset( $_GET['plugin'] ) && 'js_composer/js_composer.php' == $_GET['plugin'] ) ){
	add_action( 'admin_init', 'ishyoboy_clear_vc_version_dismiss' );
}*/