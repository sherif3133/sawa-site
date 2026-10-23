<?php
/**
 * Site-wide WordPress hardening (Oct 2026, after the PHP2Shell attacks):
 * - XML-RPC off (nothing of ours uses it; it is a favourite target for password guessing).
 * - Usernames stay private: no /wp-json/wp/v2/users list, no ?author=1 redirect, no users sitemap.
 * - Login limiting: 5 wrong passwords from one address → that address waits 15 minutes.
 * Each part can be switched off with a filter, e.g. add_filter( 'sawa_site_login_limit', '__return_false' ) if Wordfence does it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site_Hardening {

	const TRIES = 5;
	const WAIT  = 15 * MINUTE_IN_SECONDS;

	public static function init() {
		if ( apply_filters( 'sawa_site_block_xmlrpc', true ) ) {
			add_filter( 'xmlrpc_enabled', '__return_false' );
			add_filter( 'xmlrpc_methods', '__return_empty_array' );
			add_filter( 'pings_open', '__return_false' );
			add_filter( 'wp_headers', array( __CLASS__, 'no_pingback_header' ) );
			remove_action( 'wp_head', 'rsd_link' );
		}
		if ( apply_filters( 'sawa_site_hide_users', true ) ) {
			add_filter( 'rest_endpoints', array( __CLASS__, 'hide_user_endpoints' ) );
			add_filter( 'wp_sitemaps_add_provider', array( __CLASS__, 'no_users_sitemap' ), 10, 2 );
			add_action( 'template_redirect', array( __CLASS__, 'no_author_scan' ), 0 );
		}
		if ( apply_filters( 'sawa_site_login_limit', true ) ) {
			add_filter( 'authenticate', array( __CLASS__, 'check_lock' ), 30, 1 );
			add_action( 'wp_login_failed', array( __CLASS__, 'failed' ) );
			add_action( 'wp_login', array( __CLASS__, 'succeeded' ) );
		}
	}

	public static function no_pingback_header( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}

	/** Only people who edit the site (the post editor's author list) can read the users endpoints. */
	public static function hide_user_endpoints( $endpoints ) {
		if ( current_user_can( 'edit_posts' ) ) {
			return $endpoints;
		}
		foreach ( array_keys( $endpoints ) as $route ) {
			if ( 0 === strpos( $route, '/wp/v2/users' ) && '/wp/v2/users/me' !== $route ) {
				unset( $endpoints[ $route ] );
			}
		}
		return $endpoints;
	}

	public static function no_users_sitemap( $provider, $name ) {
		return 'users' === $name ? false : $provider;
	}

	/** /?author=1 would redirect to /author/<username>/ and show the login name. */
	public static function no_author_scan() {
		if ( isset( $_GET['author'] ) && ! current_user_can( 'edit_posts' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}

	private static function ip() {
		return isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	}

	private static function key() {
		return 'sawa_site_login_' . md5( self::ip() );
	}

	public static function check_lock( $user ) {
		$n = (int) get_transient( self::key() );
		if ( $n >= self::TRIES ) {
			return new WP_Error( 'too_many_tries', 'Too many wrong passwords. Wait 15 minutes and try again. · محاولات كتير غلط. استنى ربع ساعة وجرّب تاني.' );
		}
		return $user;
	}

	public static function failed() {
		set_transient( self::key(), (int) get_transient( self::key() ) + 1, self::WAIT );
	}

	public static function succeeded() {
		delete_transient( self::key() );
	}
}
