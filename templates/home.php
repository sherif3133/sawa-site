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
			<p class="meta"><?php echo sawa_t( 'Sawa English · with Sherif Abdelbaset', 'سوا انجليش · مع شريف عبد الباسط' ); // phpcs:ignore ?></p>
			<h1><?php echo Sawa_Lang::th( 'Stop starting from <span class="red">zero</span> every month.', 'بطل تبدأ من <span class="red">الأول</span> كل شهر.' ); // phpcs:ignore ?></h1>
			<p class="lead"><?php echo sawa_t( 'If you\'ve been studying English for years… you start, you stop, you go back to the beginning… and you still freeze when it\'s time to speak, Sawa English is made for you. A daily plan, people who study with you, and me with you on the way.', 'لو بقالك سنين بتذاكر انجليزي… بتبدأ وتقف وترجع من الأول… ولسه بتتجمد لما تيجي تتكلم، سوا انجليش معمول ليك. خطة يومية، ناس بتذاكر معاك، وأنا معاك في الطريق.' ); // phpcs:ignore ?></p>
			<div class="cta-row">
				<?php echo Sawa_Site::join_button( null, 'btn btn-light btn-lg' ); // phpcs:ignore ?>
				<?php if ( $free ) : ?>
					<a class="btn btn-ghost-light btn-lg" href="<?php echo esc_url( $free ); ?>"><?php echo sawa_t( 'Start with the free content', 'ابدأ بالمحتوى المجاني' ); // phpcs:ignore ?></a>
				<?php endif; ?>
			</div>
			<p class="fine"><?php echo sawa_t( 'For A2 and B1 · 150/200-day plan · 7-day money-back guarantee', 'لمستوى A2 و B1 · خطة ١٥٠/٢٠٠ يوم · ضمان استرجاع ٧ أيام' ); // phpcs:ignore ?></p>
			<p class="fine"><a href="<?php echo esc_url( home_url( '/placement/' ) ); ?>" style="color:inherit;text-decoration:underline"><?php echo sawa_t( 'Not sure about your level? Take the free level test →', 'مش عارف مستواك؟ اعمل اختبار تحديد المستوى ببلاش ←' ); // phpcs:ignore ?></a></p>
		</div>
		<div class="hero-photo">
			<?php echo Sawa_Site::photo( 'photo_hero', 'Sherif\'s photo: cut out, sitting on the bottom edge' ); // phpcs:ignore ?>
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
