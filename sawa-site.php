<?php
/**
 * Plugin Name:       Sawa Site
 * Description:       The Sawa English website: home, about, join and free-content pages in the Sawa visual identity, plus a branded shell for the tracker and review pages. Pick a "Sawa:" template for a page under Page → Template.
 * Version:           1.5.22
 * Author:            Sawa English
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * License:           GPL-2.0-or-later
 * Text Domain:       sawa-site
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SAWA_SITE_VER', '1.5.22' );
define( 'SAWA_SITE_URL', plugin_dir_url( __FILE__ ) );
define( 'SAWA_SITE_DIR', plugin_dir_path( __FILE__ ) );

require_once SAWA_SITE_DIR . 'includes/class-lang.php';
require_once SAWA_SITE_DIR . 'includes/class-site.php';
require_once SAWA_SITE_DIR . 'includes/class-resources.php';
require_once SAWA_SITE_DIR . 'includes/class-lens-guide.php';
require_once SAWA_SITE_DIR . 'includes/sections.php';
require_once SAWA_SITE_DIR . 'includes/class-hardening.php';
if ( is_admin() ) {
	require_once SAWA_SITE_DIR . 'includes/class-site-admin.php';
}

Sawa_Site::init();
Sawa_Site_Resources::init();
Sawa_Site_Hardening::init();
if ( is_admin() ) {
	Sawa_Site_Admin::init();
}

register_activation_hook(
	__FILE__,
	function () {
		Sawa_Site_Resources::register();
		Sawa_Site_Resources::seed();
		flush_rewrite_rules();
	}
);
