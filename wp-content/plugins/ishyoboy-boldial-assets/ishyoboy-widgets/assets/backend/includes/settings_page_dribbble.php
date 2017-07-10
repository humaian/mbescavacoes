<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Add an option page
if ( is_admin() ) {
	add_action('admin_menu', 'ish_dribbble_widget_menu');
	add_action('admin_init', 'ish_dribbble_widget_register_settings');
}

function ish_dribbble_widget_menu() {
	add_options_page( __( 'IshYoBoy Dribbble Widget Options', 'ishyoboy_assets' ), __( 'Dribbble Options', 'ishyoboy_assets' ), 'manage_options', 'ish_dribbble_widget_settings', 'ish_dribbble_widget_settings_output');
}

function ish_dribbble_widget_settings() {
	$tdf = array();
	$tdf[] = array('name'=>'dribbble_access_token', 'label' => __( 'Access Token', 'ishyoboy_assets' ) );
	return $tdf;
}

function ish_dribbble_widget_register_settings() {
	$settings = ish_dribbble_widget_settings();
	foreach($settings as $setting) {
		register_setting('ishyoboy_dribbble_widget_settings',$setting['name']);
	}
}


function ish_dribbble_widget_settings_output() {
	$settings = ish_dribbble_widget_settings();

	echo '<div class="wrap">';

	echo '<h2>' . __( 'IshYoBoy Dribbble Widget Options', 'ishyoboy_assets' ) . '</h2>';

	echo '<br>';

	echo '<p>To be able to use the Dribbble Widget you need to create an application under your dribbble API account which will allow your widget to communicate with dribbble servers and receive your latest posts. Please follow each of the steps below:</p>
<ol>
<li>Add a new dribbble application by visiting: <a href="https://dribbble.com/account/applications" target="_blank">https://dribbble.com/account/applications</a></li>
<li>Log in with your dribbble account</li>
<li>Click on the "Register a new application." button or use an already existing one.</li>
<li>Fill in all fields and register your application.</li>
<li>Copy the "Client Access Token" key into the field below.</li>
<li>Save all changes. You can now create your Dribble Widget in "Appearance -> Widgets".</li>
</ol>
</div>';

	echo '<br><hr />';

	echo '<form method="post" action="options.php">';

	settings_fields('ishyoboy_dribbble_widget_settings');

	echo '<table>';
	foreach($settings as $setting) {
		echo '<tr>';
		echo '<td>'.$setting['label'].'</td>';
		echo '<td><input type="text" style="width: 400px" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
		echo '</tr>';
	}
	echo '</table>';

	submit_button();

	echo '</form>';

	echo '</div>';

}