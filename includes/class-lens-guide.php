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
	const VERSION = '0.6.3';

	public static function file_url( $name ) {
		return SAWA_SITE_URL . 'assets/lens/downloads/' . $name;
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
