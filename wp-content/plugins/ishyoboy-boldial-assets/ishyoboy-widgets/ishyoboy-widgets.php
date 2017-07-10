<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_Widgets' ) ) :

	//require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_Widgets extends Ish_Plugin_Base {


		function __construct() {

			// Necessary to set all global plugin variables
			parent::__construct( __FILE__ );


			define( 'IYB_WIDGETS_PLUGIN_URI', $this->PLUGIN_PLUGIN_URI );

			//require_once( 'assets/backend/includes/updater-client.php' );
			//new IYB_Commercial_Client(); // Activate the IshYoBoy Plugins update checker

			add_action( 'init', array(&$this, 'action_init') );
			add_action( 'after_setup_theme', array(&$this, 'action_after_setup_theme') );
			add_action( 'admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init') );
			add_action( 'wp_enqueue_scripts', array(&$this, 'action_frontend_scripts') );
			add_action( 'ish_theme_options_after_woocommerce_options', array(&$this, 'add_theme_options_misc_options') );

		}

		/**
		 * Registers and Endues Frontend Scripts
		 *
		 * @return	void
		 */
		function action_frontend_scripts() {

			wp_enqueue_script('jquery');

			// Twitter
			wp_register_script( 'ish-twitter', IYB_WIDGETS_PLUGIN_URI . '/assets/frontend/js/vendor/tweetMachine.js', array('jquery'), false, true );

			// Bribbble
			wp_register_script( 'ish-dribbble', IYB_WIDGETS_PLUGIN_URI . '/assets/frontend/js/vendor/jquery.jribbble.min.js', array('jquery'), false, true );

			// Widgets Activation
			wp_register_script( 'ish-widgets', IYB_WIDGETS_PLUGIN_URI . '/assets/frontend/js/widgets.js', array('jquery'), false, true );
			wp_enqueue_script( 'ish-widgets' );

			// Localize ish-widgets - Send admin ajax url
			$php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
			wp_localize_script( 'ish-widgets', 'php_array', $php_array );

		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */

		function action_admin_scripts_init() {

			wp_enqueue_script('jquery');

			wp_register_style( 'ish-widgets-admin', IYB_WIDGETS_PLUGIN_URI .'/assets/backend/css/widgets_admin.css' );
			wp_enqueue_style('ish-widgets-admin');

			wp_register_script( 'ish-widgets-admin', IYB_WIDGETS_PLUGIN_URI .'/assets/backend/js/widgets_admin.js', array('jquery'), false,true );
			wp_enqueue_script('ish-widgets-admin');

		}

		/**
		 * Action called in 'init' hook
		 *
		 * Initiates the plugin
		 *
		 * @return void
		 */
		function action_init() {

			global $ish_options;

			if ( empty( $ish_options ) ){
				require_once( $this->locate_template_in_plugin( 'assets/backend/includes/settings_page.php' ) );
				require_once( $this->locate_template_in_plugin( 'assets/backend/includes/settings_page_dribbble.php' ) );
			}

		}


		/**
		 * Action called in 'after_setup_theme' hook
		 *
		 * Registers all widgets
		 *
		 * @return void
		 */
		function action_after_setup_theme() {

			require_once( $this->locate_template_in_plugin( 'assets/backend/helpers/functions.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/widgets/twitter-widget.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/widgets/flickr-widget.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/widgets/dribbble-widget.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/widgets/recent-posts.php' ) );

			if ( is_admin() ){
				add_filter('widget_form_callback', 'ishyoboy_widget_form_extend', 10, 2);
				add_filter( 'widget_update_callback', 'ishyoboy_widget_update', 10, 3 );
			}

		}


		/**
		 * Echoes the returned Twitter tweets
		 *
		 * Connects to Twitter and returns Tweets when called by ajax "wp_ajax_ishyoboy_get_tweets"
		 *
		 * @param integer $count The number of tweets to retrieve
		 * @param bool $username
		 * @param bool $options
		 *
		 * @return array $instance The updated value
		 */
		function ishyoboy_get_unparsed_tweets($count = 20, $username = false, $options = false) {

			global $ish_options;

			if ( ! empty( $ish_options ) ){
				// Theme by IshYoBoy
				$config['key'] = $ish_options['twitter_widget_consumer_key'];
				$config['secret'] = $ish_options['twitter_widget_consumer_secret'];
				$config['token'] = $ish_options['twitter_widget_access_token'];
				$config['token_secret'] = $ish_options['twitter_widget_access_token_secret'];
				$config['screenname'] = '';
			} else {
				// Other theme
				$config['key'] = get_option('twitter_widget_consumer_key');
				$config['secret'] = get_option('twitter_widget_consumer_secret');
				$config['token'] = get_option('twitter_widget_access_token');
				$config['token_secret'] = get_option('twitter_widget_access_token_secret');
				$config['screenname'] = '';
			}

			if ( isset( $_GET['username'] ) && !empty( $_GET['username'] )){
				$username = $_GET['username'];
			}
			if ( isset( $_GET['count'] ) && !empty( $_GET['count'] )){
				$count = $_GET['count'];
			}

			require_once( $this->locate_template_in_plugin( 'assets/frontend/includes/StormTwitter.class.php' ) );

			if (class_exists('IshStormTwitter')) {
				$obj = new IshStormTwitter($config);
				$res = $obj->getTweets($count, $username, $options);

				echo json_encode($res);
			}

			die();

		}

		/**
		 * Echoes the returned Dribbble shots
		 *
		 * Connects to Dribbble and returns Shots when called by ajax "ishyoboy_get_dribbble_shots§"
		 *
		 * @param integer $count The number of tweets to retrieve
		 * @param bool $username
		 * @param bool $options
		 *
		 * @return array $instance The updated value
		 */
		function ishyoboy_get_dribbble_shots() {

			global $ish_options;

			$cache_seconds = apply_filters( 'ish_dribbble_widget_cache_seconds', 60);

			// GET ACCESS TOKEN
			if ( ! empty( $ish_options ) ){
				// Theme by IshYoBoy
				$config['dribbble_access_token'] = ( isset($ish_options['dribbble_access_token']) ) ? $ish_options['dribbble_access_token'] : '';
			} else {
				// Other theme
				$config['dribbble_access_token'] = get_option('dribbble_access_token');
			}

			// GET USERNAME & COUNT
			$username = ( isset( $_GET['username'] ) && !empty( $_GET['username'] ) ) ? $_GET['username'] : '';
			$count = ( isset( $_GET['count'] ) && !empty( $_GET['count'] ) ) ? $_GET['count'] : 9;

			// GET SHOTS IF ALL FILLED
			if ( '' != $config['dribbble_access_token'] && '' != $username && '' != $count ) {
				$trans_key = 'ish_dribble_shots_' . $username . $count;
				if ( false === ( $response = get_transient( $trans_key ) ) ) {
					// CACHE EXPIRED - LOAD AGAIN
					$response = wp_remote_get( 'https://api.dribbble.com/v1/users/' . $username . '/shots/?access_token=' . $config['dribbble_access_token'] . '&per_page=' . $count, array( 'timeout' => 300 ) );
					if ( is_array( $response ) ) {
						set_transient( $trans_key, $response['body'], $cache_seconds );
						echo '' . $response['body'];
					}

				} else {
					// CACHED
					echo '' . $response;
				}
			}

			die();

		}

		/**
		 * Adds Theme Options page
		 *
		 * Adds Theme Options page to themes by IshYoBoy using the  "ish_theme_options_after_woocommerce_options" hook
		 *
		 * @return void
		 */
		function add_theme_options_misc_options(){

			global $of_options;

			// Check whether the section already exists
			$ish_misc_options_exist = false;
			foreach ( $of_options as $key => $val ) {
				if ( isset($val['class']) && 'misc-options' === $val['class']) {
					$ish_misc_options_exist = true;
				}
			}

			if ( ! $ish_misc_options_exist ) {

				do_action( 'ish_theme_options_before_misc_options' );

				/* *************************************************************************************************************
				 * 8. Misc Options
				 */
				$of_options[] = array(
					'name'  => __( 'Misc Options', 'ishyoboy_assets' ),
					'class' => 'misc-options',
					'type'  => 'heading'
				);
			}

			// TWITTER WIDGET ******************************************************************************************
			$of_options[] = array(  'name' => __( 'Twitter Widget', 'ishyoboy_assets' ),
				'desc' => '', //__( '', 'ishyoboy_assets' ),
				'id' => 'twitter_ifo',
				'std' => '',
				'type' => 'twitter-info');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
				'desc' => __( 'API key', 'ishyoboy_assets' ),
				'id' => 'twitter_widget_consumer_key',
				'std' => '',
				'type' => 'text');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
				'desc' => __( 'API secret', 'ishyoboy_assets' ),
				'id' => 'twitter_widget_consumer_secret',
				'std' => '',
				'type' => 'text');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
				'desc' => __( 'Access token', 'ishyoboy_assets' ),
				'id' => 'twitter_widget_access_token',
				'std' => '',
				'type' => 'text');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
				'desc' => __( 'Access token secret', 'ishyoboy_assets' ),
				'id' => 'twitter_widget_access_token_secret',
				'std' => '',
				'type' => 'text');


			// DRIBBBLE WIDGET ******************************************************************************************
			$of_options[] = array(  'name' => __( 'Dribbble Widget', 'ishyoboy_assets' ),
			                        'desc' => '', //__( '', 'ishyoboy_assets' ),
			                        'id' => 'dribbble_info',
			                        'std' => '',
			                        'type' => 'dribbble-info');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
			                        'desc' => __( 'Access Token', 'ishyoboy_assets' ),
			                        'id' => 'dribbble_access_token',
			                        'std' => '',
			                        'type' => 'text');

			if ( ! $ish_misc_options_exist ) {
				do_action( 'ish_theme_options_after_misc_options' );
			}
		}

	}
	$ish_plugins_widgets = new Ishyoboy_Widgets;

endif;

?>