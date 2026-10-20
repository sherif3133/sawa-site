<?php
/**
 * Join page: one job, send ready people to Skool. Hero (dark, price visible) → video (optional) → inside → steps → not for → FAQ → close.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$s   = Sawa_Site::s();
$vsl = '';
if ( $s['vsl_url'] && preg_match( '~(?:youtu\.be/|[?&]v=|/embed/|/shorts/)([\w-]{11})~', $s['vsl_url'], $m ) ) {
	$vsl = $m[1];
}
?>
<section class="hero dark join-hero">
	<div class="wrap narrow center-text">
		<p class="meta">سوا انجليش · خطة · ناس · وأنا</p>
		<h1>ادخل سوا انجليش، وكمّل المرة دي.</h1>
		<p class="lead">خطة يومية لمستواك، ناس بتذاكر معاك كل يوم، وأنا بنفسي في الرسايل والمكالمات. مش كورس هتتفرج عليه لوحدك.</p>
		<div class="cta-row center">
			<?php echo Sawa_Site::join_button( 'ادخل سوا انجليش · ' . $s['price'] . ' ' . $s['price_period'], 'btn btn-red btn-lg' ); // phpcs:ignore ?>
		</div>
		<p class="fine"><?php echo esc_html( $s['guarantee'] ); ?></p>
	</div>
</section>
<?php if ( $vsl ) : ?>
<section class="sec dark video-sec">
	<div class="wrap narrow">
		<div class="video"><iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $vsl ); ?>?rel=0" title="شريف بيشرح سوا انجليش" loading="lazy" allow="encrypted-media; picture-in-picture; fullscreen" allowfullscreen></iframe></div>
	</div>
</section>
<?php endif; ?>
<?php
echo sawa_sec_inside(); // phpcs:ignore
echo sawa_sec_steps(); // phpcs:ignore
echo sawa_sec_notfor(); // phpcs:ignore
echo sawa_sec_faq(); // phpcs:ignore
echo sawa_sec_close(); // phpcs:ignore
