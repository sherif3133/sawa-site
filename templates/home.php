<?php
/**
 * Home / landing page. Hero (dark) → numbers → pain → the turn → method → inside → proof → story → not for → FAQ → close.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$free = Sawa_Site::url( 'sawa-free' );
?>
<section class="hero dark">
	<div class="wrap hero-grid">
		<div class="hero-text">
			<p class="meta">سوا انجليش · مع شريف عبد الباسط</p>
			<h1>بطل تبدأ من <span class="red">الأول</span> كل شهر.</h1>
			<p class="lead">لو بقالك سنين بتذاكر انجليزي… بتبدأ وتقف وترجع من الأول… ولسه بتتجمد لما تيجي تتكلم، سوا انجليش معمول ليك. خطة يومية، ناس بتذاكر معاك، وأنا معاك في الطريق.</p>
			<div class="cta-row">
				<?php echo Sawa_Site::join_button( 'ادخل سوا انجليش', 'btn btn-light btn-lg' ); // phpcs:ignore ?>
				<?php if ( $free ) : ?>
					<a class="btn btn-ghost-light btn-lg" href="<?php echo esc_url( $free ); ?>">ابدأ بالمحتوى المجاني</a>
				<?php endif; ?>
			</div>
			<p class="fine">لمستوى A2 و B1 · خطة ١٥٠/٢٠٠ يوم · ضمان استرجاع ٧ أيام</p>
			<p class="fine"><a href="<?php echo esc_url( home_url( '/placement/' ) ); ?>" style="color:inherit;text-decoration:underline">مش عارف مستواك؟ اعمل اختبار تحديد المستوى ببلاش ←</a></p>
		</div>
		<div class="hero-photo">
			<?php echo Sawa_Site::photo( 'photo_hero', 'صورة شريف: مقصوصة، ثابتة على الحافة السفلية' ); // phpcs:ignore ?>
		</div>
	</div>
</section>
<?php
echo sawa_sec_stats(); // phpcs:ignore
echo sawa_sec_pain(); // phpcs:ignore
echo sawa_sec_turn(); // phpcs:ignore
echo sawa_sec_method(); // phpcs:ignore
echo sawa_sec_inside(); // phpcs:ignore
echo sawa_sec_proof( 9 ); // phpcs:ignore
echo sawa_sec_story(); // phpcs:ignore
echo sawa_sec_notfor(); // phpcs:ignore
echo sawa_sec_faq(); // phpcs:ignore
echo sawa_sec_close(); // phpcs:ignore
