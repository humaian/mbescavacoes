<?php
/*
Plugin Name: IshYoBoy Like It
Plugin URI: http://ishyoboy.com/
Description: Adds "Like It" functionality to theme
Version: 1.0
Author: IshYoBoy
Author URI: http://ishyoboy.com
*/

if ( ! class_exists( 'Ishyoboy_Like_It' ) ) {

	class Ishyoboy_Like_It {

		function __construct() {

			add_action( 'publish_post', array( &$this, 'initialize_like_it_field' ) );
			add_action( 'wp_ajax_ish-like-it', array( &$this, 'ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_ish-like-it', array( &$this, 'ajax_callback' ) );

		}

		function initialize_like_it_field( $post_id ) {

			if ( ! is_numeric( $post_id ) ) return;
			add_post_meta( $post_id, '_ish_likes', '0', true );

		}

		function ajax_callback() {

			if ( isset( $_POST['likes_id'] ) ) {
				$post_id = str_replace( 'ish-likes-', '', $_POST['likes_id'] );
				echo $this->like_this( $post_id, 'update' );
			} else {
				$post_id = str_replace( 'ish-likes-', '', $_POST['post_id'] );
				echo $this->like_this( $post_id, 'get' );
			}

			exit;
		}

		function like_this( $post_id, $action = 'get' ) {

			if ( ! is_numeric( $post_id ) ) return;

			switch ( $action ) {

				case 'get':
					$likes = get_post_meta( $post_id, '_ish_likes', true );
					if ( ! $likes ) {
						$likes = 0;
						add_post_meta( $post_id, '_ish_likes', $likes, true );
					}

					return $likes;
					break;

				case 'update':
					$likes = get_post_meta( $post_id, '_ish_likes', true );
					if ( isset( $_COOKIE['ish_likes_' . $post_id] ) ) return $likes;

					$likes++;
					update_post_meta( $post_id, '_ish_likes', $likes );
					setcookie( 'ish_likes_' . $post_id, $post_id, time()*20, '/' );

					return $likes;
					break;

			}
		}

		function do_likes( $as_button ) {

			global $post;

			$cookie_set = isset( $_COOKIE['ish_likes_' . $post->ID]);
			$output = $this->like_this( $post->ID );

			$btn_classes = ( $as_button ) ? " ish-sc_button ish-color1" : '';
			$btn_classes = apply_filters( 'ish_like_it_button_classes', $btn_classes, $as_button );

			if ( $cookie_set ){
				return '<span class="ish-likes' . $btn_classes . '"><i class="ish-icon-heart"></i><span class="ish-likes-count">'. $output .'</span></span>';
			}
			else{
				return '<a class="ish-likes' . $btn_classes . '" href="#" id="ish-likes-'. $post->ID .'" title="' . __( 'Like', 'ishyoboy' )  . '"><i class="ish-icon-heart"></i><span class="ish-likes-count">'. $output .'</span></a>';
			}
		}

	}
}

global $ish_like_it;
$ish_like_it = new Ishyoboy_Like_It();

if ( ! function_exists( 'ishyoboy_the_likes' ) ){
	function ishyoboy_the_likes( $as_button = true )	{
		global $ish_like_it;
		echo $ish_like_it->do_likes( $as_button );
	}
}

if ( ! function_exists( 'ishyoboy_get_likes' ) ){
	function ishyoboy_get_likes( $as_button = true )	{
		global $ish_like_it;
		return $ish_like_it->do_likes( $as_button );
	}
}