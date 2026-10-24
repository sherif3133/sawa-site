<?php
/**
 * The hiring page for the content creator job, served as a standalone page (own CSS/JS, no theme header or footer)
 * at /hire/contentcreator. The old WordPress page /hiring-content-creator-cairo-egypt/ is kept but redirects here (301).
 * The page file is assets/hire/contentcreator.html, output as it is (only Open Graph tags and a canonical link are added to its head).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sawa_Site_Hire {

	const PATH = 'hire/contentcreator';
	const OLD  = 'hiring-content-creator-cairo-egypt';

	public static function init() {
		add_action( 'init', array( __CLASS__, 'serve' ), 1 );
	}

	public static function serve() {
		$uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : ''; // phpcs:ignore
		$path = trim( (string) wp_parse_url( $uri, PHP_URL_PATH ), '/' );
		if ( self::OLD === $path ) {
			wp_redirect( home_url( '/' . self::PATH ), 301 ); // phpcs:ignore
			exit;
		}
		if ( self::PATH !== $path ) {
			return;
		}
		$file = SAWA_SITE_DIR . 'assets/hire/contentcreator.html';
		if ( ! is_readable( $file ) ) {
			return;
		}
		$html = (string) file_get_contents( $file ); // phpcs:ignore
		$url  = home_url( '/' . self::PATH );
		$desc = 'Sawa English is hiring a junior content creator in Cairo (Zayed / 6th of October). Fridays and Saturdays on set with Sherif. Apply now.';
		$head = '<link rel="canonical" href="' . esc_url( $url ) . '">'
			. '<meta property="og:type" content="website"><meta property="og:site_name" content="Sawa English">'
			. '<meta property="og:title" content="Hiring: Content Creator (Cairo) – Sawa English">'
			. '<meta property="og:description" content="' . esc_attr( $desc ) . '">'
			. '<meta property="og:url" content="' . esc_url( $url ) . '">'
			. '<meta name="twitter:card" content="summary">';
		$html = preg_replace( '/<\/head>/i', $head . '</head>', $html, 1 );
		status_header( 200 );
		nocache_headers();
		header( 'Cache-Control: public, max-age=300' );
		header( 'Content-Type: text/html; charset=utf-8' );
		echo $html; // phpcs:ignore -- the page is our own static file
		exit;
	}
}
