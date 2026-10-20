<?php
/**
 * About Sherif. Facts only from Foundation.md and the VSL notes. Hero (dark) → story chapters → beliefs → close.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$beliefs = array(
	array( 'الانجليزي لعبة نفسية الأول', 'الالتزام، والكسوف، والقلق، والتسويف، والمجتمع، والهدف. دول اللي بيحددوا مين هيوصل، مش الجرامر.' ),
	array( 'المذاكرة لوحدك غالبًا بتفشل', 'خطة + ناس + حد مشي الطريق قبلك. ده اللي بيغير الفرصة.' ),
	array( 'مفيش حاجة اسمها advanced vocabulary', 'الجري ورا الكلمات "الصعبة" بيولّد الكمالية. ومحدش محتاج يبقى perfect.' ),
	array( 'التقدم الحقيقي بياخد وقت', 'مش شهر ولا ٣ ولا ٦. وأي حد بيوعدك بكده بيضحك عليك.' ),
	array( 'اسمع واقرا لحد B2', 'متتمرنش على "الأربع مهارات" مرة واحدة. الـ input الأول، وبعدين الكلام. والكلام بدري يكون بفيدباك عشان الأخطاء متثبتش.' ),
	array( '٨٠/٢٠ في الحاجات المملة', 'الكلمات اللي بتتكرر، والجرامر اللي الناس بتستخدمه فعلًا، والأخطاء المشهورة.' ),
);
?>
<section class="hero dark">
	<div class="wrap hero-grid">
		<div class="hero-text">
			<p class="meta">عن شريف عبد الباسط</p>
			<h1>كوتش، مش مدرس انجليزي بس.</h1>
			<p class="lead">الانجليزي هو الباب. وراه العقلية، والصحة النفسية، والفلوس، والشغل، والتواصل، والإحساس إنك منتمي لمكان.</p>
			<p class="fine">CELTA · اتعلمت الانجليزي (وشوية إسباني وصيني) بالطريقة الصعبة · أسست سوا انجليش</p>
		</div>
		<div class="hero-photo">
			<?php echo Sawa_Site::photo( 'photo_about', 'صورة شريف: صورة طبيعية، مش ستوديو' ); // phpcs:ignore ?>
		</div>
	</div>
</section>

<section class="sec light chapter">
	<div class="wrap narrow">
		<p class="meta">الفصل ١</p>
		<h2>الانجليزي ماجاش من المدرسة</h2>
		<p>جه من Nickelodeon وMTV وFriends وEminem والجيمز والراديو. اتعلمته عشان كنت بحبه، مش عشان امتحان.</p>
		<p>وأنا عندي ١٥ سنة، كان عندي صاحب ألماني اسمه ساشا، وكان بيطلب مني نتكلم على سكايب. وكل مرة أقوله: "المايك بايظ". كنت خايف أتكلم.</p>
		<p>لحد ما ضغط عليا. وبعد ساعة كلام… اكتشفت إني بعرف أتكلم أصلًا.</p>
	</div>
</section>

<section class="sec white chapter">
	<div class="wrap narrow">
		<p class="meta">الفصل ٢</p>
		<h2>اللي الانجليزي اداهوني</h2>
		<p>فلوس من الإنترنت وأنا عندي ١٥ سنة. شغل في الـ customer service من ١٩ لـ ٢٢ سنة بـ ٥٠٠–٦٥٠ دولار في الشهر. صحاب في كل حتة في العالم. وعمري ما حسيت إني صغير في أي أوضة.</p>
	</div>
</section>

<section class="sec dark chapter">
	<div class="wrap narrow">
		<p class="meta">الفصل ٣ · ٤ سنين جامعة + ٦ شهور في الصين</p>
		<h2 class="xl">ولسه <span class="red">B1</span> في الصيني.</h2>
		<p class="lead">عشان عمري ما حبيت اللغة ولا ثقافتها. ساعتها فهمت إيه اللي بيخلي حد يتكلم بجد. ومن هنا جت طريقة سوا انجليش.</p>
	</div>
</section>

<section class="sec light chapter">
	<div class="wrap narrow">
		<p class="meta">الفصل ٤</p>
		<h2>سنين الخوف</h2>
		<p>مشروعين فشلوا. ٤ سنين وأنا خايف أنشر أي حاجة، وصحابي ضحكوا. العلاج النفسي غيّر السبب اللي بعمل عشانه الحاجات.</p>
		<p>جربت تاني… ووصلت لـ ١٠ آلاف مشترك. ولو كنت استنيت لما أحس إني جاهز، سوا انجليش ماكانش هيبقى موجود.</p>
		<p>ودي نفس دايرة "أبدأ وأقف" اللي إنت فيها دلوقتي.</p>
	</div>
</section>

<section class="sec white" id="beliefs">
	<div class="wrap">
		<h2>اللي أنا مؤمن بيه</h2>
		<p class="serif red">no shortcuts.</p>
		<div class="grid-3 beliefs">
			<?php foreach ( $beliefs as $i => $b ) : ?>
				<article class="card"><span class="num"><?php echo esc_html( (string) ( $i + 1 ) ); ?></span><h3><?php echo esc_html( $b[0] ); ?></h3><p><?php echo esc_html( $b[1] ); ?></p></article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php
echo sawa_sec_stats(); // phpcs:ignore
echo sawa_sec_close( 'عمرك ما هتحس إنك جاهز. ادخل وإنت مش جاهز.' ); // phpcs:ignore
