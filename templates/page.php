<?php
/**
 * Full-page shell for every "Sawa:" template. The theme's header, footer and styles are not used.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$sawa_tpl = Sawa_Site::current_template();
?><!doctype html>
<html dir="rtl" lang="ar">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0F0F10">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">اتخطى للمحتوى</a>
<?php echo Sawa_Site::header(); // phpcs:ignore ?>
<main id="main">
<?php
if ( 'sawa-blog' === $sawa_tpl || 'sawa-post' === $sawa_tpl ) {
	include SAWA_SITE_DIR . 'templates/' . str_replace( 'sawa-', '', $sawa_tpl ) . '.php';
}
while ( 'sawa-blog' !== $sawa_tpl && 'sawa-post' !== $sawa_tpl && have_posts() ) {
	the_post();
	$file = SAWA_SITE_DIR . 'templates/' . str_replace( 'sawa-', '', $sawa_tpl ) . '.php';
	if ( file_exists( $file ) ) {
		include $file;
	}
}
?>
</main>
<?php echo Sawa_Site::footer(); // phpcs:ignore ?>
<?php wp_footer(); ?>
</body>
</html>
