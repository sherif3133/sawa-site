<?php
/**
 * Site-wide WordPress hardening (Oct 2026, after the PHP2Shell attacks):
 * - XML-RPC off (nothing of ours uses it; it is a favourite target for password guessing).
 * - Usernames stay private: no /wp-json/wp/v2/users list, no ?author=1 redirect, no users sitemap.
 * - Login limiting: 5 wrong passwords from one address → that address waits 15 minutes.
 * - "Lost password" never says whether an email has an account.
 * Each part can be switched off with a filter, e.g. add_filter( 'sawa_site_login_limit', '__return_false' ) if Wordfence does it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site_Hardening {

	const TRIES = 5;
	const WAIT  = 15 * MINUTE_IN_SECONDS;

	/** Cloudflare's edge addresses (cloudflare.com/ips). The site sits behind Cloudflare, so REMOTE_ADDR is Cloudflare's, not the student's. */
	const CLOUDFLARE = array( '173.245.48.0/20', '103.21.244.0/22', '103.22.200.0/22', '103.31.4.0/22', '141.101.64.0/18', '108.162.192.0/18', '190.93.240.0/20', '188.114.96.0/20', '197.234.240.0/22', '198.41.128.0/17', '162.158.0.0/15', '104.16.0.0/13', '104.24.0.0/14', '172.64.0.0/13', '131.0.72.0/22', '2400:cb00::/32', '2606:4700::/32', '2803:f800::/32', '2405:b500::/32', '2405:8100::/32', '2a06:98c0::/29', '2c0f:f248::/32' );

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
		if ( apply_filters( 'sawa_site_quiet_lost_password', true ) ) {
			add_action( 'lostpassword_post', array( __CLASS__, 'quiet_lost_password' ), 10, 2 );
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

	/** An unknown email or username gets the same "check your email" page as a real one. */
	public static function quiet_lost_password( $errors, $user_data ) {
		$only_unknown = ! array_diff( $errors->get_error_codes(), array( 'invalid_email', 'invalidcombo' ) );
		if ( ! $user_data && $only_unknown && ! empty( $_POST['user_login'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_safe_redirect( add_query_arg( 'checkemail', 'confirm', wp_login_url() ) );
			exit;
		}
	}

	private static function in_range( $ip, $cidr ) {
		list( $net, $bits ) = explode( '/', $cidr );
		$a = @inet_pton( $ip ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
		$b = @inet_pton( $net ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
		if ( false === $a || false === $b || strlen( $a ) !== strlen( $b ) ) {
			return false;
		}
		$bytes = intdiv( (int) $bits, 8 );
		$rest  = (int) $bits % 8;
		if ( substr( $a, 0, $bytes ) !== substr( $b, 0, $bytes ) ) {
			return false;
		}
		return ! $rest || 0 === ( ( ord( $a[ $bytes ] ) ^ ord( $b[ $bytes ] ) ) & ( 0xFF << ( 8 - $rest ) ) & 0xFF );
	}

	/** The student's own address: CF-Connecting-IP, but only when the request really came through Cloudflare (anyone can send that header). */
	private static function ip() {
		$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
		if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
			foreach ( self::CLOUDFLARE as $cidr ) {
				if ( self::in_range( $ip, $cidr ) ) {
					return sanitize_text_field( wp_unslash( $_SERVER['HTTP_CF_CONNECTING_IP'] ) );
				}
			}
		}
		return $ip;
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
