<?php
/**
 * The Language Lens guide at /lens/: what it does, how to install the zip, how to use it.
 * sawa-lens owns the /lens/ address and calls Sawa_Site_Lens::render() for it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site_Lens {

	/** Version of the zips in assets/lens/downloads. Change it when you copy new zips in. */
	const VERSION = '0.13.0';

	public static function file_url( $name ) {
		return SAWA_SITE_URL . 'assets/lens/downloads/' . $name . '?v=' . self::VERSION; // new ?v= each release: Cloudflare keeps the old zip otherwise
	}

	public static function img( $name ) {
		return SAWA_SITE_URL . 'assets/lens/' . $name;
	}

	/** "7.5 MB" for a download, or '' if the file is missing. */
	public static function size( $name ) {
		$f = SAWA_SITE_DIR . 'assets/lens/downloads/' . $name;
		return is_readable( $f ) ? number_format_i18n( filesize( $f ) / 1048576, 1 ) . ' MB' : '';
	}

	/** Prints the whole page and stops. */
	public static function render() {
		if ( ! defined( 'SAWA_SITE_DIR' ) ) {
			return;
		}
		status_header( 200 );
		header( 'Content-Type: text/html; charset=utf-8' );
		include SAWA_SITE_DIR . 'templates/lens.php';
		exit;
	}
}

/*
 * Two-language helpers for the /lens/ page. English is the default; Arabic shows when html[data-lang="ar"]
 * (set by the inline script in the page head from ?lang=ar or localStorage "sawa_lang"; toggle buttons carry data-set-lang).
 * Block text:  lg_en('div') … English … lg_ar() … Arabic … lg_end()
 * Short text:  echo lg_t( 'English', 'عربي' );
 */
if ( ! function_exists( 'lg_en' ) ) {
	$GLOBALS['lg_tag'] = 'div';

	function lg_en( $tag = 'div' ) {
		$GLOBALS['lg_tag'] = $tag;
		echo '<' . $tag . ' class="t t-en" lang="en" dir="ltr">'; // phpcs:ignore
	}

	function lg_ar() {
		$tag = $GLOBALS['lg_tag'];
		echo '</' . $tag . '><' . $tag . ' class="t t-ar" lang="ar" dir="rtl">'; // phpcs:ignore
	}

	function lg_end() {
		echo '</' . $GLOBALS['lg_tag'] . '>'; // phpcs:ignore
	}

	function lg_t( $en, $ar, $tag = 'span' ) {
		return '<' . $tag . ' class="t t-en" lang="en" dir="ltr">' . $en . '</' . $tag . '><' . $tag . ' class="t t-ar" lang="ar" dir="rtl">' . $ar . '</' . $tag . '>';
	}
}
