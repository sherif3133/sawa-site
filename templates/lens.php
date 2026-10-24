<?php
/**
 * /lens/: the Language Lens step-by-step guide. A full page of its own (no theme), phone-first.
 * One small step per screen with Back / Next and a progress bar (assets/lens.js); the step lives in the URL hash
 * (#pc-3, #an-2, #ip-1, #tour-5) so a student can come back to it. Without JavaScript every step shows, one under the other.
 * Paths: start (choose a device) → pc (Chrome / Edge) | an (Android, Lemur) | ip (iPhone, honest: not yet) → tour (one feature per step).
 * In the tour, .on-pc / .on-phone text follows the device the student chose (html.dev-pc / html.dev-phone).
 * English by default; Arabic (RTL) with the English | العربية toggle in the header (Sawa_Lang::boot(); lg_en / lg_ar / lg_t write both languages).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$ver     = Sawa_Site_Lens::VERSION;
$chrome  = Sawa_Site_Lens::file_url( 'language-lens-chrome.zip' );
$firefox = Sawa_Site_Lens::file_url( 'language-lens-firefox.zip' );
$app     = home_url( '/app/' );
$here    = home_url( '/lens/' );
$size    = Sawa_Site_Lens::size( 'language-lens-chrome.zip' );

/** A screenshot with English alt text now and Arabic alt text (data-alt-ar) that the language switch swaps in. */
$img = function ( $n, $alt_en, $alt_ar, $w, $h, $cls = '' ) {
	return '<img class="shot ' . esc_attr( $cls ) . '" src="' . esc_url( Sawa_Site_Lens::img( $n ) ) . '" alt="' . esc_attr( $alt_en ) . '" data-alt-en="' . esc_attr( $alt_en ) . '" data-alt-ar="' . esc_attr( $alt_ar ) . '" width="' . (int) $w . '" height="' . (int) $h . '" loading="lazy" decoding="async">';
};
/** Device-dependent words inside a sentence: computer (mouse) / phone (finger). */
$dv = function ( $pc, $phone ) {
	return '<span class="on-pc">' . $pc . '</span><span class="on-phone">' . $phone . '</span>';
};
/** One wizard screen: open (title), then the picture side, then close. */
$open = function ( $id, $path, $en, $ar ) {
	echo '<article class="wz-step" id="' . esc_attr( $id ) . '" data-path="' . esc_attr( $path ) . '"><div class="lg-txt"><h3>' . lg_t( $en, $ar ) . '</h3>'; // phpcs:ignore
};
$vis   = function () {
	echo '</div><div class="lg-vis">';
};
$close = function () {
	echo '</div></article>';
};
/** A drawn phone screen for the steps no screenshot can show (Lemur menus). $rows = HTML; .hl marks what to tap. */
$ph = function ( $title, $rows ) {
	return '<div class="mk-ph" dir="ltr"><div class="mk-ph-bar"><span>' . $title . '</span><b>⋮</b></div><div class="mk-ph-body">' . $rows . '</div></div>';
};
$card_mock = '<div class="mk mk-card" dir="ltr"><p class="w">struggle <small>/ˈstrʌɡ.əl/ · B1</small></p><p class="m">يكافح · to try very hard</p><div class="bt"><span>✓ I know it</span><span class="hl">Learning</span><span>💡 Curious</span></div><p class="sv">✓ Saved to your Review</p><span class="rv">Review now · 3 ready</span></div>';

$dl_chrome = '<a class="btn btn-red btn-lg" href="' . esc_url( $chrome ) . '" download>'
	. lg_t( '⬇ Download Language Lens', '⬇ حمّل Language Lens' )
	. '<span class="dl-meta">v' . esc_html( $ver ) . ' · ' . esc_html( $size ) . ' · Chrome / Edge / Android</span></a>';
$dl_ff     = '<a class="btn btn-ghost-light btn-lg" href="' . esc_url( $firefox ) . '" download>' . lg_t( '⬇ Firefox version', '⬇ نسخة Firefox' ) . '</a>';
?><!doctype html>
<html lang="en" dir="ltr" data-lang="en" data-title-en="Language Lens: step-by-step guide | Sawa English" data-title-ar="Language Lens: الشرح خطوة بخطوة | سوا انجليش">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0F0F10">
<title>Language Lens: step-by-step guide | Sawa English</title>
<meta name="description" content="Language Lens explains any English word on YouTube and any website. A step-by-step guide: download, install, sign in and use every feature, on a computer and on an Android phone.">
<script>document.documentElement.classList.add('wz-js');</script>
<?php echo Sawa_Lang::boot(); // phpcs:ignore -- the site-wide language setting (English default, ?lang=ar, saved per visitor) ?>
<link rel="icon" href="<?php echo esc_url( SAWA_LENS_URL . 'assets/icon-192.png' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Changa:wght@500;800&family=IBM+Plex+Sans+Arabic:wght@400;600&family=Instrument+Serif:ital@0;1&display=swap">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.css?v=' . SAWA_SITE_VER ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.css?v=' . SAWA_SITE_VER ); ?>">
</head>
<body class="sawa-page sawa-lens-page">
<a class="skip" href="#guide"><?php echo lg_t( 'Skip to the guide', 'اتخطى للشرح' ); // phpcs:ignore ?></a>
<?php echo Sawa_Site::header( 'sawa-lens' ); // phpcs:ignore ?>
<main id="main">

<!-- Hero -->
<section class="sec dark lg-hero">
	<div class="wrap lg-hero-grid">
		<div class="lg-hero-text">
			<p class="meta"><?php echo lg_t( 'Language Lens · beta · for Sawa English students', 'Language Lens · نسخة بيتا · لطلاب سوا انجليش' ); // phpcs:ignore ?></p>
			<h1><?php echo lg_t( 'Understand any English word <span class="red">while you watch and read</span>', 'افهم أي كلمة إنجليزي <span class="red">وإنت بتتفرج وبتقرا</span>', 'span' ); // phpcs:ignore ?></h1>
			<?php lg_en( 'p' ); ?>Click (or tap) any word on YouTube or any website: its Arabic meaning, how to say it, and its level. Every word you save becomes a review card in the Sawa app. This page walks you through it one small step at a time.<?php lg_ar(); ?>دوس على أي كلمة في يوتيوب أو أي موقع: تلاقي معناها بالعربي ونطقها ومستواها. وكل كلمة تحفظها بتبقى كارت مراجعة في تطبيق سوا. الصفحة دي هتمشيك خطوة صغيرة ورا خطوة.<?php lg_end(); ?>
			<div class="cta-row"><a class="btn btn-red btn-lg" href="#start"><?php echo lg_t( 'Start the step-by-step guide →', 'ابدأ الشرح خطوة بخطوة ←' ); // phpcs:ignore ?></a></div>
			<p class="fine lg-fine"><?php echo lg_t( 'Language Lens', 'Language Lens' ); // phpcs:ignore ?> v<?php echo esc_html( $ver ); ?> · <a href="<?php echo esc_url( $chrome ); ?>" download><?php echo lg_t( 'Download only', 'تحميل بس' ); // phpcs:ignore ?></a> · <a href="#faq"><?php echo lg_t( 'Problems? Fixes', 'مشكلة؟ الحلول' ); // phpcs:ignore ?></a></p>
		</div>
		<div class="lg-hero-shot"><div class="phone"><?php echo $img( 'yt-captions.webp', 'YouTube on a phone: the English line, the Arabic translation under it and how it sounds', 'يوتيوب على الموبايل: الجملة الإنجليزي وتحتها الترجمة العربي وطريقة النطق', 786, 1480, 'hero-img' ); // phpcs:ignore ?></div></div>
	</div>
</section>

<!-- The step-by-step guide -->
<section class="sec light wz" id="guide" aria-label="Step-by-step guide">
	<div class="wrap">
		<div class="wz-top" aria-live="polite">
			<p class="wz-count"></p>
			<div class="wz-bar"><i></i></div>
		</div>

		<div class="wz-steps">

		<!-- Start: choose a device -->
		<article class="wz-step wz-start" id="start" data-path="start">
			<div class="lg-txt wz-full">
				<h3><?php echo lg_t( 'Where will you use Language Lens?', 'هتستخدم Language Lens فين؟' ); // phpcs:ignore ?></h3>
				<?php lg_en( 'p' ); ?>Pick one. You will see one small step at a time: do it, then press <b>Next</b>. You can close this page and come back: it remembers your step.<?php lg_ar(); ?>اختار واحد. هتشوف خطوة صغيرة واحدة كل مرة: اعملها وبعدين دوس <b>التالي</b>. تقدر تقفل الصفحة وترجعلها: هي فاكرة إنت وصلت لفين.<?php lg_end(); ?>
				<div class="wz-choices">
					<a class="wz-choice" href="#pc-1" data-dev="pc"><span class="ic">💻</span><b><?php echo lg_t( 'Computer', 'كمبيوتر' ); // phpcs:ignore ?></b><small><?php echo lg_t( 'Chrome or Edge · Windows or Mac · 9 steps', 'Chrome أو Edge · ويندوز أو ماك · ٩ خطوات' ); // phpcs:ignore ?></small></a>
					<a class="wz-choice" href="#an-1" data-dev="phone"><span class="ic">📱</span><b><?php echo lg_t( 'Android phone', 'موبايل أندرويد' ); // phpcs:ignore ?></b><small><?php echo lg_t( 'With the free Lemur browser · 8 steps', 'بمتصفح Lemur المجاني · ٨ خطوات' ); // phpcs:ignore ?></small></a>
					<a class="wz-choice" href="#ip-1" data-dev="phone"><span class="ic">📲</span><b><?php echo lg_t( 'iPhone', 'أيفون' ); // phpcs:ignore ?></b><small><?php echo lg_t( 'Not yet: see what works today', 'لسه: شوف إيه اللي شغال النهارده' ); // phpcs:ignore ?></small></a>
					<a class="wz-choice wz-choice-alt" href="#tour-1"><span class="ic">✨</span><b><?php echo lg_t( 'Already installed', 'متثبتة عندي' ); // phpcs:ignore ?></b><small><?php echo lg_t( 'Show me what it can do · 13 features', 'وريني بتعمل إيه · ١٣ ميزة' ); // phpcs:ignore ?></small></a>
				</div>
			</div>
		</article>

		<!-- ============ Computer: Chrome / Edge ============ -->
		<?php $open( 'pc-1', 'pc', 'Download the file', 'نزّل الملف' ); ?>
			<?php lg_en( 'p' ); ?>Press the red button. A file called <b dir="ltr">language-lens-chrome.zip</b> goes to your <b>Downloads</b> folder. When the download has finished, press <b>Next</b>.<?php lg_ar(); ?>دوس الزرار الأحمر. هينزل ملف اسمه <b dir="ltr">language-lens-chrome.zip</b> في فولدر <b>Downloads</b>. لما التحميل يخلص، دوس <b>التالي</b>.<?php lg_end(); ?>
			<p><?php echo $dl_chrome; // phpcs:ignore ?></p>
			<details class="wz-more"><summary><?php echo lg_t( 'I use Firefox on my computer', 'بستخدم Firefox على الكمبيوتر' ); // phpcs:ignore ?></summary>
				<?php lg_en( 'p' ); ?>Download the <a href="<?php echo esc_url( $firefox ); ?>" download>Firefox version</a>, open <b dir="ltr">about:debugging#/runtime/this-firefox</b> → <b>Load Temporary Add-on…</b> → choose the zip file itself. Firefox removes it each time you close Firefox, until Firefox’s add-on store approves us. Chrome or Edge is easier.<?php lg_ar(); ?>حمّل <a href="<?php echo esc_url( $firefox ); ?>" download>نسخة Firefox</a>، وافتح <b dir="ltr">about:debugging#/runtime/this-firefox</b> ثم <b>Load Temporary Add-on…</b> واختار ملف الـ zip نفسه. Firefox بيشيلها كل ما تقفله، لحد ما متجر إضافات Firefox يوافق علينا. Chrome أو Edge أسهل.<?php lg_end(); ?>
			</details>
		<?php $vis(); ?>
			<div class="mk mk-file" dir="ltr"><span class="zipic">ZIP</span><span class="fn">language-lens-chrome.zip<small><?php echo esc_html( $size ); ?> · Downloads</small></span><span class="ok">✓</span></div>
		<?php $close(); ?>

		<?php $open( 'pc-2', 'pc', 'Unzip it (Extract)', 'فكّ الضغط (Extract)' ); ?>
			<?php lg_en( 'p' ); ?>Open your Downloads folder. <b>Right-click</b> the file → <b>Extract All…</b> → <b>Extract</b>. A normal folder with the same name appears.<?php lg_ar(); ?>افتح فولدر Downloads. <b>كليك يمين</b> على الملف ثم <b>Extract All…</b> ثم <b>Extract</b>. هيظهر فولدر عادي بنفس الاسم.<?php lg_end(); ?>
			<?php lg_en( 'p' ); ?><b>Keep this folder. Don’t delete or move it later</b>: the extension runs from it.<?php lg_ar(); ?><b>سيب الفولدر ده في مكانه وماتمسحوش بعدين</b>: الإضافة بتشتغل منه.<?php lg_end(); ?>
			<?php echo lg_t( '<p class="fine">On a Mac: just double-click the file.</p>', '<p class="fine">على الماك: دوس دوستين على الملف وخلاص.</p>', 'div' ); // phpcs:ignore ?>
		<?php $vis(); ?>
			<div class="mk mk-menu" dir="ltr"><span>Open</span><span>Open with</span><span class="hl tapr">Extract All…</span><span>Copy as path</span></div>
		<?php $close(); ?>

		<?php $open( 'pc-3', 'pc', 'Open the extensions page', 'افتح صفحة الإضافات' ); ?>
			<?php lg_en( 'p' ); ?>Press the button to copy the address, then click Chrome’s address bar at the top, paste it (<b>Ctrl+V</b>, on a Mac <b>⌘+V</b>) and press <b>Enter</b>. Websites can’t open this page for you.<?php lg_ar(); ?>دوس الزرار عشان تنسخ العنوان، وبعدين دوس على شريط العنوان فوق في Chrome، والصقه (<b>Ctrl+V</b>، وعلى الماك <b>⌘+V</b>) ودوس <b>Enter</b>. المواقع مش مسموح لها تفتحلك الصفحة دي.<?php lg_end(); ?>
			<p class="wz-btns"><button type="button" class="btn btn-ink btn-sm" data-copy="chrome://extensions" data-done-en="Copied ✓ now paste it" data-done-ar="اتنسخ ✓ الصقه دلوقتي"><?php echo lg_t( 'Copy chrome://extensions', 'انسخ chrome://extensions' ); // phpcs:ignore ?></button> <button type="button" class="btn btn-ghost btn-sm" data-copy="edge://extensions" data-done-en="Copied ✓ now paste it" data-done-ar="اتنسخ ✓ الصقه دلوقتي"><?php echo lg_t( 'On Edge: copy edge://extensions', 'على Edge: انسخ edge://extensions' ); // phpcs:ignore ?></button></p>
		<?php $vis(); ?>
			<div class="mk mk-bar tapr" dir="ltr"><span class="lock">●</span><span class="url">chrome://extensions</span></div>
		<?php $close(); ?>

		<?php $open( 'pc-4', 'pc', 'Turn on Developer mode', 'شغّل Developer mode' ); ?>
			<?php lg_en( 'p' ); ?>The <b>Developer mode</b> switch is at the top right. Click it so it turns <b>blue</b>.<?php lg_ar(); ?>زرار <b>Developer mode</b> فوق على اليمين. دوس عليه لحد ما يبقى <b>أزرق</b>.<?php lg_end(); ?>
			<?php echo lg_t( '<p class="fine">On Edge it is in the left menu, near the bottom. If Chrome later shows a message about developer mode, that is normal: close it.</p>', '<p class="fine">على Edge هتلاقيه في القايمة اللي على الشمال تحت. ولو Chrome ظهّر بعدين رسالة عن Developer mode، عادي: اقفلها.</p>', 'div' ); // phpcs:ignore ?>
		<?php $vis(); ?>
			<?php echo $img( 'ext-1-devmode-off.webp', 'Chrome’s extensions page with a red ring around the Developer mode switch', 'صفحة إضافات Chrome وحلقة حمرا حوالين زرار Developer mode', 960, 510 ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'pc-5', 'pc', 'Click “Load unpacked”', 'دوس “Load unpacked”' ); ?>
			<?php lg_en( 'p' ); ?>A <b>Load unpacked</b> button appears at the top left. Click it and choose the folder you extracted in step 2: <b>the one with manifest.json directly inside</b>. Then press <b>Select folder</b>.<?php lg_ar(); ?>هيظهر زرار <b>Load unpacked</b> فوق على الشمال. دوس عليه واختار الفولدر اللي فكّيته في خطوة ٢: <b>اللي جواه ملف manifest.json على طول</b>. وبعدين دوس <b>Select folder</b>.<?php lg_end(); ?>
			<?php lg_en( 'p' ); ?>You will see a <b>Language Lens</b> card, switched on. 🎉<?php lg_ar(); ?>هتلاقي كارت <b>Language Lens</b> ظهر وشغّال. 🎉<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $img( 'ext-2-load-unpacked.webp', 'The Load unpacked button with a red ring around it', 'زرار Load unpacked وحواليه حلقة حمرا', 960, 510 ); // phpcs:ignore ?><?php echo $img( 'ext-3-loaded.webp', 'The Language Lens card in the extensions page, switched on', 'كارت Language Lens ظاهر وشغّال في صفحة الإضافات', 960, 510 ); // phpcs:ignore ?>
		<?php $close(); ?>

		<article class="wz-step lg-pin" id="pc-6" data-path="pc">
			<div class="lg-txt wz-full"><h3><?php echo lg_t( 'Pin it to the toolbar 📌', 'ثبّتها في الشريط 📌' ); // phpcs:ignore ?></h3>
				<?php lg_en( 'p' ); ?>Chrome hides new extensions in a menu. Pin Language Lens so its icon is always there.<?php lg_ar(); ?>Chrome بيخبّي الإضافات الجديدة جوه قايمة. ثبّت Language Lens عشان أيقونتها تفضل ظاهرة.<?php lg_end(); ?>
				<ol class="lg-pins">
					<li><figure><?php echo $img( 'pin-1.webp', 'The top right of Chrome with a red ring around the puzzle-piece Extensions icon', 'أعلى يمين Chrome وحلقة حمرا حوالين أيقونة الإضافات (قطعة البازل)', 730, 220 ); // phpcs:ignore ?><figcaption><b>a</b> <?php echo lg_t( 'Click the puzzle piece 🧩 at the top right.', 'دوس على قطعة البازل 🧩 فوق على اليمين.' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-2.webp', 'The Extensions menu: the Language Lens row with a red ring around the three-dot button', 'قايمة الإضافات: صف Language Lens وحلقة حمرا حوالين زرار النقط التلاتة', 1156, 460 ); // phpcs:ignore ?><figcaption><b>b</b> <?php echo lg_t( 'Next to <b>Language Lens</b>, click the pin 📌 (or the three dots ⋮).', 'جنب <b>Language Lens</b> دوس على الدبوس 📌 (أو النقط التلاتة ⋮).' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-3.webp', 'The menu from the three dots with a red ring around Pin to toolbar', 'القايمة اللي بتطلع من النقط التلاتة وحلقة حمرا حوالين Pin to toolbar', 700, 432 ); // phpcs:ignore ?><figcaption><b>c</b> <?php echo lg_t( 'If you opened the dots: <b>Pin to toolbar</b>.', 'لو فتحت النقط: <b>Pin to toolbar</b>.' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-4.webp', 'The Language Lens icon, a black square with a magnifier, now sits in the toolbar', 'أيقونة Language Lens (مربع أسود فيه عدسة) بقت ظاهرة في الشريط', 730, 220 ); // phpcs:ignore ?><figcaption><b>d</b> <?php echo lg_t( 'Done: the black magnifier icon stays in the toolbar.', 'خلاص: أيقونة العدسة السودا بقت ثابتة في الشريط.' ); // phpcs:ignore ?></figcaption></figure></li>
				</ol>
				<?php echo lg_t( '<p class="fine">On Edge: click the puzzle piece, then the eye 👁 next to Language Lens.</p>', '<p class="fine">على Edge: دوس على البازل، وبعدين العين 👁 جنب Language Lens.</p>', 'div' ); // phpcs:ignore ?>
			</div>
		</article>

		<?php $open( 'pc-7', 'pc', 'Sign in', 'سجّل دخول' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>Click the Language Lens icon (the black magnifier).</li><li>Click <b>Sign in with Sawa English</b>.</li><li>Choose <b>Continue with Google</b>, or type your <b>email and password</b>. Use the same account as the Sawa app.</li></ol>
			<p class="fine">After your first sign-in, a short level test opens in a new tab. Take it (it makes the colours fit your level), then come back here.</p>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>دوس على أيقونة Language Lens (العدسة السودا).</li><li>دوس <b>Sign in with Sawa English</b>.</li><li>اختار <b>Continue with Google</b>، أو اكتب <b>الإيميل والباسورد</b>. استخدم نفس حسابك في تطبيق سوا.</li></ol>
			<p class="fine">بعد أول تسجيل دخول هيفتح اختبار مستوى قصير في تبويب جديد. اعمله (بيخلّي الألوان على قد مستواك)، وبعدين ارجع هنا.</p>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $img( 'popup-signin.webp', 'The Language Lens window with the Sign in with Sawa English button', 'نافذة Language Lens وزرار Sign in with Sawa English', 720, 660, 'narrow-shot' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'pc-8', 'pc', 'Save your first word', 'احفظ أول كلمة' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>Open any YouTube video with English subtitles, for example on <a href="https://www.youtube.com/@sherif.abdelbaset" target="_blank" rel="noopener">Sherif’s channel</a>.</li><li>The captions show in 3 lines over the video. <b>Click a word</b> you don’t know.</li><li>In the card, press <b>Learning</b>.</li></ol>
			<p class="fine">The pictures on this page are from a phone. On a computer it looks the same, only bigger.</p>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>افتح أي فيديو على يوتيوب بترجمة إنجليزي، مثلًا من <a href="https://www.youtube.com/@sherif.abdelbaset" target="_blank" rel="noopener">قناة شريف</a>.</li><li>الترجمة هتظهر ٣ سطور فوق الفيديو. <b>دوس على كلمة</b> مش عارفها.</li><li>في الكارت دوس <b>Learning</b>.</li></ol>
			<p class="fine">الصور في الصفحة دي من الموبايل. على الكمبيوتر نفس الشكل بس أكبر.</p>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="phone"><?php echo $img( 'yt-card.webp', 'The word card: pronunciation, level and the I know it, Learning and Curious buttons', 'كارت الكلمة: النطق والمستوى وأزرار I know it وLearning وCurious', 786, 1480 ); // phpcs:ignore ?></div>
		<?php $close(); ?>

		<?php $open( 'pc-9', 'pc', 'Review now', 'راجع دلوقتي' ); ?>
			<?php lg_en( 'p' ); ?>After you save a word, the card shows <b>✓ Saved to your Review</b> and a <b>Review now</b> button with how many cards are ready. Click it: the Sawa app opens on your review cards. Review a few minutes a day and the words stay with you.<?php lg_ar(); ?>بعد ما تحفظ كلمة، الكارت بيقولك <b>✓ Saved to your Review</b> وفيه زرار <b>Review now</b> وعليه عدد الكروت الجاهزة. دوس عليه: تطبيق سوا هيفتح على كروت المراجعة. راجع كام دقيقة كل يوم والكلمات هتفضل معاك.<?php lg_end(); ?>
			<?php lg_en( 'p' ); ?>🎉 <b>You’re set up!</b> Press <b>Next</b> to see everything else Language Lens can do, one feature at a time.<?php lg_ar(); ?>🎉 <b>كده خلصت التثبيت!</b> دوس <b>التالي</b> وشوف كل حاجة تانية Language Lens بتعملها، ميزة ميزة.<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $card_mock; // phpcs:ignore ?>
		<?php $close(); ?>

		<!-- ============ Android: Lemur ============ -->
		<?php $open( 'an-1', 'an', 'Get the Lemur browser', 'نزّل متصفح Lemur' ); ?>
			<?php lg_en( 'p' ); ?>Chrome on Android and the YouTube app don’t accept extensions. <b>Lemur Browser</b> does, and it is free. Install it from the <b>Play Store</b>.<?php lg_ar(); ?>Chrome على أندرويد وتطبيق يوتيوب مش بيقبلوا إضافات. <b>Lemur Browser</b> بيقبل، ومجاني. نزّله من <b>Play Store</b>.<?php lg_end(); ?>
			<p><a class="btn btn-ink btn-lg" href="https://play.google.com/store/search?q=Lemur%20Browser&amp;c=apps" target="_blank" rel="noopener"><?php echo lg_t( 'Find Lemur on the Play Store', 'دوّر على Lemur في Play Store' ); // phpcs:ignore ?></a></p>
			<?php echo lg_t( '<p class="fine">Firefox for Android will work too, once Firefox’s add-on store approves Language Lens. We’ll tell you on Skool.</p>', '<p class="fine">Firefox على أندرويد هيشتغل كمان، أول ما متجر إضافات Firefox يوافق على Language Lens. هنقولكم على Skool.</p>', 'div' ); // phpcs:ignore ?>
		<?php $vis(); ?>
			<?php echo $ph( 'Play Store', '<div class="mk-ph-app"><span class="lg">🦊</span><div><b>Lemur Browser</b><small>Free · Extensions</small></div><span class="hl tapr">Install</span></div>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-2', 'an', 'Open this page in Lemur and download', 'افتح الصفحة دي في Lemur ونزّل' ); ?>
			<?php lg_en( 'p' ); ?>Copy this page’s link, open <b>Lemur</b>, paste it in the address bar and go. You come back to this exact step. Then tap the red button: the file goes to your <b>Downloads</b>.<?php lg_ar(); ?>انسخ لينك الصفحة دي، وافتح <b>Lemur</b>، والصقه في شريط العنوان وادخل. هترجع لنفس الخطوة دي بالظبط. وبعدين دوس الزرار الأحمر: الملف هينزل في <b>Downloads</b>.<?php lg_end(); ?>
			<p class="wz-btns"><button type="button" class="btn btn-ink btn-sm" data-copy="<?php echo esc_attr( $here . '#an-2' ); ?>" data-done-en="Copied ✓ paste it in Lemur" data-done-ar="اتنسخ ✓ الصقه في Lemur"><?php echo lg_t( 'Copy this page’s link', 'انسخ لينك الصفحة' ); // phpcs:ignore ?></button></p>
			<p><?php echo $dl_chrome; // phpcs:ignore ?></p>
			<?php echo lg_t( '<p class="fine">Don’t unzip it: Lemur takes the zip file as it is.</p>', '<p class="fine">ماتفكّش الضغط: Lemur بياخد ملف الـ zip زي ما هو.</p>', 'div' ); // phpcs:ignore ?>
		<?php $vis(); ?>
			<?php echo $ph( 'sawaenglish.com/lens', '<div class="mk-ph-dl"><span class="zipic">ZIP</span><span>language-lens-chrome.zip<small>' . esc_html( $size ) . '</small></span></div><span class="mk-ph-btn hl tapr">⬇ Download</span>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-3', 'an', 'Open Extensions', 'افتح Extensions' ); ?>
			<?php lg_en( 'p' ); ?>In Lemur, tap the menu <b>⋮</b> (three dots, at the top or bottom right) → <b>Extensions</b>.<?php lg_ar(); ?>في Lemur دوس على القايمة <b>⋮</b> (التلات نقط، فوق أو تحت على اليمين) ثم <b>Extensions</b>.<?php lg_end(); ?>
			<?php echo lg_t( '<p class="fine">Menus can look a little different between versions: look for the word “Extensions”.</p>', '<p class="fine">القوايم ممكن تختلف شوية من نسخة لنسخة: دوّر على كلمة “Extensions”.</p>', 'div' ); // phpcs:ignore ?>
		<?php $vis(); ?>
			<?php echo $ph( 'Lemur', '<ul class="mk-ph-menu"><li>New tab</li><li>Bookmarks</li><li>History</li><li>Downloads</li><li class="hl tapr">Extensions</li><li>Settings</li></ul>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-4', 'an', 'Turn on Developer mode', 'شغّل Developer mode' ); ?>
			<?php lg_en( 'p' ); ?>At the top of the Extensions page, tap the <b>Developer mode</b> switch so it turns on (blue).<?php lg_ar(); ?>فوق في صفحة Extensions، دوس على زرار <b>Developer mode</b> لحد ما يشتغل (يبقى أزرق).<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $ph( 'Extensions', '<div class="mk-ph-row hl tapr"><span>Developer mode</span><i class="sw on"></i></div><div class="mk-ph-row dim"><span>+ (from .zip/.crx/.user.js)</span></div>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-5', 'an', 'Add the zip file', 'ضيف ملف الـ zip' ); ?>
			<?php lg_en( 'p' ); ?>Tap <b>+ (from .zip/.crx/.user.js)</b> → open <b>Downloads</b> → tap <b>language-lens-chrome.zip</b> → <b>OK</b>. A <b>Language Lens</b> card appears, switched on.<?php lg_ar(); ?>دوس <b>+ (from .zip/.crx/.user.js)</b> ثم افتح <b>Downloads</b> ثم دوس على <b>language-lens-chrome.zip</b> ثم <b>OK</b>. هيظهر كارت <b>Language Lens</b> وهو شغّال.<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $ph( 'Extensions', '<div class="mk-ph-row"><span>Developer mode</span><i class="sw on"></i></div><div class="mk-ph-row hl tapr"><span>+ (from .zip/.crx/.user.js)</span></div><div class="mk-ph-row card"><span>🔍 Language Lens – Sawa English</span><i class="sw on"></i></div>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-6', 'an', 'Sign in', 'سجّل دخول' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>Tap <b>⋮</b> → <b>Extensions</b> → tap <b>Language Lens</b> to open its window. (In some versions its icon also shows next to the address bar.)</li><li>Tap <b>Sign in with Sawa English</b>. A new tab opens.</li><li>Choose <b>Continue with Google</b>, or type your <b>email and password</b>.</li><li>When the page says you are connected, the short level test opens. Take it, then go back to your tab.</li></ol>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>دوس <b>⋮</b> ثم <b>Extensions</b> ثم دوس على <b>Language Lens</b> عشان تفتح نافذتها. (في بعض النسخ أيقونتها بتظهر كمان جنب شريط العنوان.)</li><li>دوس <b>Sign in with Sawa English</b>. هيفتح تبويب جديد.</li><li>اختار <b>Continue with Google</b>، أو اكتب <b>الإيميل والباسورد</b>.</li><li>لما الصفحة تقول إنك اتوصلت، هيفتح اختبار المستوى القصير. اعمله، وبعدين ارجع للتبويب بتاعك.</li></ol>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $ph( 'Language Lens', '<p class="mk-ph-p"><b>Language Lens</b><br><small>Sawa English</small></p><span class="mk-ph-btn hl tapr">Sign in with Sawa English</span>' ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'an-7', 'an', 'Save your first word on m.youtube.com', 'احفظ أول كلمة على m.youtube.com' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>In Lemur, go to <b dir="ltr">m.youtube.com</b> (the website, not the YouTube app). If Lemur shows the computer version, turn off <b>Desktop site</b> in the menu.</li><li>Open a video with English subtitles and turn on <b>CC</b>.</li><li><b>Tap a word</b>: its card slides up from the bottom. Tap <b>Learning</b>.</li></ol>
			<p class="fine">Press and hold to select several words. Tap outside the card to close it.</p>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>في Lemur ادخل على <b dir="ltr">m.youtube.com</b> (الموقع، مش تطبيق يوتيوب). لو Lemur فتح نسخة الكمبيوتر، اقفل <b>Desktop site</b> من القايمة.</li><li>افتح فيديو بترجمة إنجليزي وشغّل <b>CC</b>.</li><li><b>دوس على كلمة</b>: الكارت بتاعها هيطلع من تحت. دوس <b>Learning</b>.</li></ol>
			<p class="fine">اضغط ضغطة طويلة عشان تحدد كذا كلمة. ودوس برّه الكارت عشان تقفله.</p>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="phone"><?php echo $img( 'yt-card.webp', 'On a phone: the word card slides up from the bottom with the I know it, Learning and Curious buttons', 'على الموبايل: كارت الكلمة طالع من تحت وفيه أزرار I know it وLearning وCurious', 786, 1480 ); // phpcs:ignore ?></div>
		<?php $close(); ?>

		<?php $open( 'an-8', 'an', 'Review now', 'راجع دلوقتي' ); ?>
			<?php lg_en( 'p' ); ?>After you save a word, the card shows a <b>Review now</b> button with how many cards are ready. Tap it: the Sawa app opens on your review cards.<?php lg_ar(); ?>بعد ما تحفظ كلمة، الكارت بيظهر زرار <b>Review now</b> وعليه عدد الكروت الجاهزة. دوس عليه: تطبيق سوا هيفتح على كروت المراجعة.<?php lg_end(); ?>
			<?php lg_en( 'p' ); ?><b>Tip:</b> in the Sawa app, tap your browser’s menu → <b>Add to Home screen</b>, so Review is one tap away every day.<?php lg_ar(); ?><b>نصيحة:</b> في تطبيق سوا، دوس على قايمة المتصفح ثم <b>Add to Home screen</b>، عشان المراجعة تبقى بدوسة واحدة كل يوم.<?php lg_end(); ?>
			<?php lg_en( 'p' ); ?>🎉 <b>You’re set up!</b> Press <b>Next</b> to see everything else you can do.<?php lg_ar(); ?>🎉 <b>كده خلصت التثبيت!</b> دوس <b>التالي</b> وشوف كل حاجة تانية تقدر تعملها.<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $card_mock; // phpcs:ignore ?>
		<?php $close(); ?>

		<!-- ============ iPhone: honest ============ -->
		<?php $open( 'ip-1', 'ip', 'iPhone: not yet, but here’s what works', 'أيفون: لسه، بس ده اللي شغّال' ); ?>
			<?php lg_en(); ?>
			<p>Language Lens <b>doesn’t work on iPhone yet</b>. Safari only takes extensions from the App Store, and we are working on that version.</p>
			<p>What you can do today:</p>
			<ul><li><b>On a computer</b>, install Language Lens and save words while you watch.</li><li><b>On your iPhone</b>, open the Sawa app in Safari → Share <b>⬆</b> → <b>Add to Home Screen</b>, and review your words there every day.</li></ul>
			<?php lg_ar(); ?>
			<p>Language Lens <b>لسه مش شغالة على الأيفون</b>. Safari بياخد الإضافات من App Store بس، وإحنا شغالين على النسخة دي.</p>
			<p>اللي تقدر تعمله النهارده:</p>
			<ul><li><b>على الكمبيوتر</b>، ثبّت Language Lens واحفظ كلمات وإنت بتتفرج.</li><li><b>على الأيفون</b>، افتح تطبيق سوا في Safari ثم مشاركة <b>⬆</b> ثم <b>Add to Home Screen</b>، وراجع كلماتك هناك كل يوم.</li></ul>
			<?php lg_end(); ?>
			<p class="wz-btns"><a class="btn btn-ink btn-sm" href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open the Sawa app', 'افتح تطبيق سوا' ); // phpcs:ignore ?></a> <a class="btn btn-ghost btn-sm" href="#pc-1" data-dev="pc"><?php echo lg_t( 'Set it up on a computer', 'ثبّتها على الكمبيوتر' ); // phpcs:ignore ?></a></p>
		<?php $vis(); ?>
			<?php echo $card_mock; // phpcs:ignore ?>
		<?php $close(); ?>

		<!-- ============ Tour: one feature per step ============ -->
		<?php $open( 'tour-1', 'tour', 'Meanings in a second', 'المعنى في ثانية' ); ?>
			<?php lg_en(); ?>
			<p><?php echo $dv( '<b>Click</b> a word on YouTube, or <b>hover</b> it on other websites', '<b>Tap</b> any word, on YouTube or any website' ); // phpcs:ignore ?>. The card shows the Arabic meaning, how to say it, its level (A1 to C2), and a “sounds like” hint.</p>
			<ul><li>Not clear? Press <b>💬 Meaning here</b>: it explains the word <b>in this sentence</b>.</li><li><?php echo $dv( 'Prefer hover or click? Change it in the Language Lens window, separately for YouTube and websites.', '<b>Press and hold</b> to select several words. Links and buttons still work as usual.' ); // phpcs:ignore ?></li></ul>
			<?php lg_ar(); ?>
			<p><?php echo $dv( '<b>دوس</b> على الكلمة في يوتيوب، أو <b>حط الماوس</b> عليها في المواقع التانية', '<b>دوس</b> على أي كلمة، في يوتيوب أو أي موقع' ); // phpcs:ignore ?>. الكارت بيقولك المعنى بالعربي، والنطق، والمستوى (من A1 لـ C2)، و“بتتنطق زي”.</p>
			<ul><li>مش واضح؟ دوس <b>💬 Meaning here</b>: بيشرح الكلمة <b>في الجملة دي بالذات</b>.</li><li><?php echo $dv( 'عايز hover بدل click أو العكس؟ غيّرها من نافذة Language Lens، ليوتيوب وللمواقع كل واحد لوحده.', '<b>اضغط ضغطة طويلة</b> عشان تحدد كذا كلمة. واللينكات والأزرار شغالة عادي.' ); // phpcs:ignore ?></li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $img( 'web-1-hover.webp', 'A word on a normal website with its meaning and the save buttons', 'كلمة على موقع عادي ومعناها وكارت الحفظ', 1000, 625 ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'tour-2', 'tour', 'Save words, phrases and sentences', 'احفظ كلمات وعبارات وجمل' ); ?>
			<?php lg_en(); ?>
			<p>In the word card, choose:</p>
			<ul><li><b>✓ I know it</b>: no more colour on it.</li><li><b>Learning</b>: saved to your Review cards (keep this for important words).</li><li><b>💡 Curious</b>: you only looked it up. You get XP, but it is <b>not</b> saved.</li></ul>
			<p>Phrases like “give up” have a <b>double pink line</b>: <?php echo $dv( 'click', 'tap' ); // phpcs:ignore ?> any word of it for the whole phrase. <?php echo $dv( '<b>Select</b> some text', '<b>Press and hold</b>, then drag' ); // phpcs:ignore ?> to <b>Translate</b>, <b>Listen</b>, <b>Save sentence</b> or <b>Save expression</b>.</p>
			<p class="fine">Word colours: yellow box = Learning · solid blue = new for you · dotted orange = hard or rare · double pink = phrase.</p>
			<?php lg_ar(); ?>
			<p>في كارت الكلمة اختار:</p>
			<ul><li><b>✓ I know it</b>: اللون بيتشال من عليها.</li><li><b>Learning</b>: بتتحفظ في كروت المراجعة (خليها للكلمات المهمة).</li><li><b>💡 Curious</b>: بصّيت عليها بس. بتاخد XP، بس <b>مش</b> بتتحفظ.</li></ul>
			<p>العبارات زي “give up” عليها <b>خطين بمبي</b>: دوس على أي كلمة فيها تاخد معنى العبارة كلها. <?php echo $dv( '<b>حدد</b> أي كلام', '<b>اضغط ضغطة طويلة</b> واسحب' ); // phpcs:ignore ?> عشان <b>Translate</b> أو <b>Listen</b> أو <b>Save sentence</b> أو <b>Save expression</b>.</p>
			<p class="fine">ألوان الكلمات: مربع أصفر = Learning · خط أزرق = جديدة ليك · خط برتقاني منقّط = صعبة أو نادرة · خطين بمبي = عبارة.</p>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $img( 'web-4-save.webp', 'Selecting a phrase on a normal website and saving it', 'تحديد جملة على موقع عادي وحفظها', 1000, 625 ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'tour-3', 'tour', 'Review cards in the Sawa app', 'كروت المراجعة في تطبيق سوا' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>Every word or sentence you save becomes a card.</li><li>Press <b>Review now</b> in the word card, or open the <a href="<?php echo esc_url( $app ); ?>">Sawa app</a> → <b>Review</b>.</li><li>See the word, try to remember it, then say how well you knew it. Cards you find hard come back sooner.</li></ol>
			<p class="fine">A few minutes a day beats one long session a week.</p>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>كل كلمة أو جملة تحفظها بتبقى كارت.</li><li>دوس <b>Review now</b> في كارت الكلمة، أو افتح <a href="<?php echo esc_url( $app ); ?>">تطبيق سوا</a> ثم <b>Review</b>.</li><li>شوف الكلمة، حاول تفتكرها، وبعدين قول كنت عارفها قد إيه. الكروت الصعبة بترجعلك أسرع.</li></ol>
			<p class="fine">كام دقيقة كل يوم أحسن من قعدة طويلة مرة في الأسبوع.</p>
			<?php lg_end(); ?>
			<p><a class="btn btn-ink btn-sm" href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open my review cards', 'افتح كروت المراجعة' ); // phpcs:ignore ?></a></p>
		<?php $vis(); ?>
			<?php echo $card_mock; // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'tour-4', 'tour', 'Three caption lines on YouTube', 'تلات سطور ترجمة على يوتيوب' ); ?>
			<?php lg_en(); ?>
			<p>Over the video you get: the <b>English</b> sentence, the <b>Arabic</b> translation, and <b>how it sounds</b> in fast speech.</p>
			<ul><li>Turn each line on or off: tap <b>Aa</b> on the video bar.</li><li><b>Blur captions until <?php echo $dv( 'hover', 'tap' ); // phpcs:ignore ?></b>: listen first, then check. (Language Lens window → More settings.)</li><li>The Language Lens button next to <b>Aa</b> turns it all off and gives you YouTube’s own captions back.</li></ul>
			<?php lg_ar(); ?>
			<p>فوق الفيديو هتلاقي: الجملة <b>بالإنجليزي</b>، والترجمة <b>بالعربي</b>، و<b>إزاي بتتنطق</b> في الكلام السريع.</p>
			<ul><li>شغّل أو اقفل أي سطر: دوس <b>Aa</b> في شريط الفيديو.</li><li><b>Blur captions</b>: الترجمة بتبقى مغبّشة لحد ما <?php echo $dv( 'تحط الماوس عليها', 'تدوس عليها' ); // phpcs:ignore ?>: اسمع الأول وبعدين اتأكد. (نافذة Language Lens ثم More settings.)</li><li>زرار Language Lens اللي جنب <b>Aa</b> بيقفل كل ده ويرجّعلك ترجمة يوتيوب العادية.</li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="phone"><?php echo $img( 'yt-captions.webp', 'Captions on the video in English, Arabic and pronunciation', 'ترجمة بالإنجليزي والعربي والنطق على الفيديو', 786, 1480 ); // phpcs:ignore ?></div>
		<?php $close(); ?>

		<?php $open( 'tour-5', 'tour', 'Caption controls and Shadow mode', 'التحكم في الترجمة ووضع Shadow' ); ?>
			<?php lg_en(); ?>
			<p><?php echo $dv( 'Hover', 'Tap' ); // phpcs:ignore ?> the caption: a small strip appears.</p>
			<ul><li><b>‹ ⟲ ›</b> previous / repeat / next sentence · <b>🔁 Loop</b> one sentence · <b>0.75×</b> slower.</li><li><b>🗣 Shadow</b>: after each sentence the video waits for you to say it, then goes on. Turn on <b>🎤</b> to hear yourself right after the speaker (your voice stays on your device).</li><li><?php echo $dv( 'Keys: <b>A / S / D</b> previous / repeat / next, <b>R</b> loop, <b>X</b> slower, <b>W</b> shadow.', '<b>Swipe</b> the caption left or right for the next or previous sentence, <b>double-tap</b> it to repeat.' ); // phpcs:ignore ?></li></ul>
			<?php lg_ar(); ?>
			<p><?php echo $dv( 'حط الماوس على', 'دوس على' ); // phpcs:ignore ?> الترجمة: هيظهر شريط صغير.</p>
			<ul><li><b>‹ ⟲ ›</b> الجملة اللي قبل / تكرار / اللي بعد · <b>🔁 Loop</b> لجملة واحدة · <b>0.75×</b> أبطأ.</li><li><b>🗣 Shadow</b>: بعد كل جملة الفيديو يستناك تقولها وبعدين يكمّل. شغّل <b>🎤</b> وهتسمع صوتك بعد المتكلم على طول (صوتك بيفضل على جهازك).</li><li><?php echo $dv( 'الكيبورد: <b>A / S / D</b> قبل / تكرار / بعد، <b>R</b> تكرار مستمر، <b>X</b> أبطأ، <b>W</b> Shadow.', '<b>اسحب</b> الترجمة يمين أو شمال للجملة اللي بعدها أو اللي قبلها، و<b>دوس مرتين</b> للتكرار.' ); // phpcs:ignore ?></li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-strip" dir="ltr"><span>‹</span><span>⟲</span><span>›</span><span>🔁 Loop</span><span>0.75×</span><span class="hl tapr">🗣 Shadow</span><span>🎤</span></div>
			<p class="mk-cap" dir="ltr">I’ve been <u>struggling</u> with this for years</p>
		<?php $close(); ?>

		<?php $open( 'tour-6', 'tour', 'The transcript', 'الـ Transcript' ); ?>
			<?php lg_en(); ?>
			<p>All the words of the video are written <?php echo $dv( 'next to', 'under' ); // phpcs:ignore ?> it.</p>
			<ul><li><?php echo $dv( 'Click', 'Tap' ); // phpcs:ignore ?> a sentence to play it. <b>Auto-scroll</b> keeps the text moving with the video.</li><li><b>☆</b> saves the sentence as a review card.</li><li><b>🔁</b> repeats it so you can say it after the speaker.</li></ul>
			<?php lg_ar(); ?>
			<p>كل كلام الفيديو مكتوب <?php echo $dv( 'جنبه', 'تحته' ); // phpcs:ignore ?>.</p>
			<ul><li>دوس على أي جملة تتشغّل. <b>Auto-scroll</b> بيخلّي الكلام يمشي مع الفيديو.</li><li><b>☆</b> بتحفظ الجملة كارت مراجعة.</li><li><b>🔁</b> بتكررها عشان تقولها ورا المتكلم.</li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="phone"><?php echo $img( 'yt-transcript.webp', 'The transcript under the video, with repeat and star buttons next to each sentence', 'الـ Transcript تحت الفيديو وكل جملة جنبها أزرار التكرار والنجمة', 786, 1480 ); // phpcs:ignore ?></div>
		<?php $close(); ?>

		<?php $open( 'tour-7', 'tour', 'Quiz mode', 'وضع الأسئلة (Quiz)' ); ?>
			<?php lg_en(); ?>
			<ul><li><b>Sherif’s quizzes:</b> on some of Sherif’s videos, the video pauses at the right moment and asks you a question. Answer, see why, and the video goes on.</li><li><b>Quiz me on my Learning words:</b> when a word you are learning comes up in any video, the video sometimes pauses for a quick question (at most one every 3 minutes).</li></ul>
			<p class="fine">Don’t want it now? Press <b>Stop these quizzes</b> in the question, or switch it in the Language Lens panel → <b>Display ▾</b>.</p>
			<?php lg_ar(); ?>
			<ul><li><b>أسئلة شريف:</b> في بعض فيديوهات شريف، الفيديو بيقف في اللحظة المناسبة ويسألك سؤال. جاوب، شوف ليه، والفيديو يكمّل.</li><li><b>Quiz me on my Learning words:</b> لما كلمة إنت بتتعلمها تيجي في أي فيديو، الفيديو ساعات بيقف لسؤال سريع (مرة كل ٣ دقايق بالكتير).</li></ul>
			<p class="fine">مش عايزها دلوقتي؟ دوس <b>Stop these quizzes</b> في السؤال، أو غيّرها من لوحة Language Lens ثم <b>Display ▾</b>.</p>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-quiz" dir="ltr"><p class="qh">Quick check · a word you’re learning</p><p class="qq">I’ve been ____ with this for years.</p><span class="r">struggling ✓</span><span>strolling</span><span>stretching</span></div>
		<?php $close(); ?>

		<?php $open( 'tour-8', 'tour', 'Music and lyrics 🎵', 'الأغاني والكلمات 🎵' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>Open a song on YouTube.</li><li>In the Language Lens panel, press <b>🎤 Music</b>.</li><li>The lyrics line up with the song, translated by what they <b>mean</b>, not word by word. Slang and rude words are explained politely, with how strong they are.</li><li>Press <b>💡</b> next to a line to have it explained.</li></ol>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>افتح أغنية على يوتيوب.</li><li>في لوحة Language Lens دوس <b>🎤 Music</b>.</li><li>الكلمات بتمشي مع الأغنية، ومترجمة <b>بالمعنى</b> مش كلمة كلمة. والعامية والشتايم بتتشرح بأدب، مع قوتها قد إيه.</li><li>دوس <b>💡</b> جنب أي سطر عشان يتشرحلك.</li></ol>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-lyr" dir="ltr"><p>🎵 <b>Lyrics</b> · Genius</p><p class="on">I’m gonna give it all I’ve got <span>💡</span></p><p class="ar" dir="rtl">هعمل كل اللي أقدر عليه</p><p>Even when the road gets rough <span>💡</span></p></div>
		<?php $close(); ?>

		<?php $open( 'tour-9', 'tour', 'The Lyrics game 🎮', 'لعبة الأغاني 🎮' ); ?>
			<?php lg_en(); ?>
			<ol class="wz-list"><li>On a song, press <b>🎤 Music → 🎮 Lyrics game</b>.</li><li>One word is missing in each line. Listen and <?php echo $dv( 'type', 'tap' ); // phpcs:ignore ?> it.</li><li>Too fast? Turn on <b>⏸ Pause after every line</b>. Stuck? Turn on <b>🌐 Show the translation</b>.</li></ol>
			<?php lg_ar(); ?>
			<ol class="wz-list"><li>على أي أغنية دوس <b>🎤 Music ثم 🎮 Lyrics game</b>.</li><li>في كل سطر كلمة ناقصة. اسمع و<?php echo $dv( 'اكتبها', 'اختارها' ); // phpcs:ignore ?>.</li><li>سريعة عليك؟ شغّل <b>⏸ Pause after every line</b>. وقفت؟ شغّل <b>🌐 Show the translation</b>.</li></ol>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-lyr" dir="ltr"><p>🎮 <b>Lyrics game</b> · 7 / 10</p><p class="on">Even when the road gets <u class="gap">&nbsp;&nbsp;?&nbsp;&nbsp;</u></p><p class="opts"><span class="hl tapr">rough</span><span>rock</span><span>roof</span></p></div>
		<?php $close(); ?>

		<?php $open( 'tour-10', 'tour', 'Arabic → English', 'من العربي للإنجليزي' ); ?>
			<?php lg_en(); ?>
			<p>Reading Arabic on Facebook or any site and want to say it in English?</p>
			<ul><li><?php echo $dv( 'Hover', 'Tap' ); // phpcs:ignore ?> an <b>Arabic word</b>: you get its English word.</li><li><?php echo $dv( 'Select', 'Press and hold to select' ); // phpcs:ignore ?> an Arabic sentence: you get it in English.</li><li>Turn on <b>English under Arabic posts</b> (Language Lens window → More settings) to see an English line under Arabic posts.</li></ul>
			<?php lg_ar(); ?>
			<p>بتقرا عربي على فيسبوك أو أي موقع وعايز تعرف تقوله بالإنجليزي؟</p>
			<ul><li><?php echo $dv( 'حط الماوس على', 'دوس على' ); // phpcs:ignore ?> <b>كلمة عربي</b>: تاخد الكلمة الإنجليزي.</li><li><?php echo $dv( 'حدد', 'اضغط ضغطة طويلة وحدد' ); // phpcs:ignore ?> جملة عربي: تاخدها بالإنجليزي.</li><li>شغّل <b>English under Arabic posts</b> (نافذة Language Lens ثم More settings) وهتلاقي سطر إنجليزي تحت البوستات العربي.</li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<?php echo $img( 'web-3-arabic.webp', 'An Arabic word on a website with its English meaning', 'كلمة عربي على موقع ومعناها بالإنجليزي', 1000, 625 ); // phpcs:ignore ?>
		<?php $close(); ?>

		<?php $open( 'tour-11', 'tour', 'Check your writing', 'صحّح كتابتك' ); ?>
			<?php lg_en(); ?>
			<p>Write in English anywhere: a comment, an email, a chat. Language Lens underlines mistakes as you type.</p>
			<ul><li><b>Spelling</b> is checked right away on your device; <b>grammar</b> by Sawa English.</li><li><?php echo $dv( 'Click', 'Tap' ); // phpcs:ignore ?> an underlined word to see the fix and why.</li><li>On or off: Language Lens window → <b>Check my writing on websites</b>.</li></ul>
			<?php lg_ar(); ?>
			<p>اكتب إنجليزي في أي مكان: كومنت، إيميل، شات. Language Lens بتسطّرلك الأخطاء وإنت بتكتب.</p>
			<ul><li><b>الإملاء</b> بيتصحح على طول على جهازك، و<b>الجرامر</b> من سوا انجليش.</li><li>دوس على الكلمة اللي عليها خط تشوف التصحيح وليه.</li><li>تشغيل وإيقاف: نافذة Language Lens ثم <b>Check my writing on websites</b>.</li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-proof" dir="ltr"><p>I <u>goed</u> to the market <u class="g">yesterday morning and buyed</u> apples.</p><div class="fix"><b>went</b> · “go” → “went” in the past</div></div>
		<?php $close(); ?>

		<?php $open( 'tour-12', 'tour', 'Content check and calmer YouTube', 'فحص المحتوى ويوتيوب أهدى' ); ?>
			<?php lg_en(); ?>
			<ul><li><b>Content check:</b> before you watch, the panel tells you if a video has swearing or sexual content, and how strong.</li><li><b>Hide swear words</b> in the captions: Language Lens panel → <b>Display ▾</b>.</li><li><b>Hide Arabic videos on YouTube</b> (Home, Up next, Shorts) so you get more English: Language Lens window → More settings.</li></ul>
			<?php lg_ar(); ?>
			<ul><li><b>فحص المحتوى:</b> قبل ما تتفرج، اللوحة بتقولك لو الفيديو فيه شتايم أو محتوى جنسي، وقد إيه.</li><li><b>خبّي الشتايم</b> في الترجمة: لوحة Language Lens ثم <b>Display ▾</b>.</li><li><b>Hide Arabic videos on YouTube</b> (الرئيسية، Up next، Shorts) عشان يظهرلك إنجليزي أكتر: نافذة Language Lens ثم More settings.</li></ul>
			<?php lg_end(); ?>
		<?php $vis(); ?>
			<div class="mk mk-flag" dir="ltr"><p><b>Content check</b></p><p><span class="dot y"></span>Swearing: mild (3)</p><p><span class="dot g"></span>Sexual content: none</p></div>
		<?php $close(); ?>

		<?php $open( 'tour-13', 'tour', 'Settings, pause and feedback', 'الإعدادات والإيقاف والملاحظات' ); ?>
			<?php lg_en(); ?>
			<ul><li><?php echo $dv( 'Click the Language Lens icon', 'Tap ⋮ → Extensions → Language Lens' ); // phpcs:ignore ?> for its window: everyday switches on top, the rest under <b>More settings</b>. <b>Explanations</b> can be in English or العربية.</li><li>The switch for <b>this site</b> in the window turns it off on one website only.</li><li>Something wrong, or an idea? Press <b>💬 Send feedback</b> in the window or in a word card. Sherif reads every one.</li></ul>
			<?php lg_ar(); ?>
			<ul><li><?php echo $dv( 'دوس على أيقونة Language Lens', 'دوس ⋮ ثم Extensions ثم Language Lens' ); // phpcs:ignore ?> تفتح نافذتها: الإعدادات اليومية فوق، والباقي تحت <b>More settings</b>. و<b>Explanations</b> ممكن تبقى بالإنجليزي أو بالعربي.</li><li>زرار <b>الموقع ده</b> في النافذة بيقفلها في موقع واحد بس.</li><li>فيه مشكلة أو عندك فكرة؟ دوس <b>💬 Send feedback</b> في النافذة أو في كارت الكلمة. شريف بيقرا كل واحدة.</li></ul>
			<?php lg_end(); ?>
			<p class="lg-done"><?php echo lg_t( '🎉 That’s everything. Watch something you enjoy today and save 3 words.', '🎉 كده شفت كل حاجة. اتفرج النهارده على حاجة بتحبها واحفظ ٣ كلمات.' ); // phpcs:ignore ?></p>
			<p class="wz-btns"><a class="btn btn-red btn-sm" href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open the Sawa app', 'افتح تطبيق سوا' ); // phpcs:ignore ?></a> <a class="btn btn-ghost btn-sm" href="#start"><?php echo lg_t( 'Back to the start', 'ارجع للبداية' ); // phpcs:ignore ?></a></p>
		<?php $vis(); ?>
			<?php echo $img( 'popup-signin.webp', 'The Language Lens window', 'نافذة Language Lens', 720, 660, 'narrow-shot' ); // phpcs:ignore ?>
		<?php $close(); ?>

		</div>

		<nav class="wz-nav" aria-label="Guide steps">
			<button type="button" class="btn btn-ghost btn-lg wz-back"><?php echo lg_t( '← Back', '→ رجوع' ); // phpcs:ignore ?></button>
			<button type="button" class="btn btn-red btn-lg wz-next"><?php echo lg_t( 'Next →', 'التالي ←' ); // phpcs:ignore ?></button>
		</nav>
		<p class="wz-home"><a href="#start"><?php echo lg_t( 'Change device', 'غيّر الجهاز' ); // phpcs:ignore ?></a> · <a href="#tour-1"><?php echo lg_t( 'All features', 'كل المميزات' ); // phpcs:ignore ?></a> · <a href="#faq"><?php echo lg_t( 'Problems? Fixes', 'مشكلة؟ الحلول' ); // phpcs:ignore ?></a></p>
	</div>
</section>

<!-- FAQ -->
<section class="sec soft" id="faq">
	<div class="wrap narrow">
		<p class="eyebrow"><?php echo lg_t( 'If something does not work', 'لو حاجة مش شغالة' ); // phpcs:ignore ?></p>
		<h2><?php echo lg_t( 'Questions and fixes', 'أسئلة وحلول' ); // phpcs:ignore ?></h2>
		<div class="faq">
			<details><summary><?php echo lg_t( 'I can’t find the Load unpacked button', 'مش لاقي زرار Load unpacked' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Developer mode is off. Turn it on at the top right (or from the left menu in Edge) and the button appears.<?php lg_ar(); ?>يبقى Developer mode مش شغّال. شغّله من فوق على اليمين (أو من القايمة اللي على الشمال في Edge) وهيظهر.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It says “Manifest file is missing or unreadable”', 'بيقول "Manifest file is missing or unreadable"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>You picked the wrong folder. Choose the folder that has <b dir="ltr">manifest.json</b> directly inside it, not the folder above it. Also make sure you extracted the zip (do not open it from inside the zip).<?php lg_ar(); ?>اخترت الفولدر الغلط. لازم تختار الفولدر اللي جواه ملف <b dir="ltr">manifest.json</b> مباشرة، مش الفولدر اللي فوقه. اتأكد كمان إنك عملت Extract للملف (مش فتحته من جوه الـ zip).<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'Chrome shows “Disable developer mode extensions”', 'Chrome بيظهر رسالة "Disable developer mode extensions"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>That message is normal for any extension installed by hand. Close it (or press Cancel) and do not disable the extension. It goes away once we are on the store.<?php lg_ar(); ?>دي رسالة عادية لأي إضافة بتتثبت يدويًا. اضغط إغلاق (أو Cancel) ومتعطّلش الإضافة. هتختفي لما ننزل على المتجر.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'I can’t see the Language Lens icon', 'مش شايف أيقونة Language Lens' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Chrome hides new extensions. Click the puzzle-piece icon at the top right and pin Language Lens: see <a href="#pc-6">the pin step</a>.<?php lg_ar(); ?>Chrome بيخبّي الإضافات الجديدة. اضغط أيقونة البازل فوق على اليمين وثبّت Language Lens: شوف <a href="#pc-6">خطوة التثبيت</a>.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It doesn’t show up on YouTube', 'الإضافة مش بتظهر على يوتيوب' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>1) Check it is switched on in the extensions page. 2) Refresh the page. 3) The video needs English subtitles (CC). 4) If the Language Lens button in the video bar is off, turn it on. 5) On a phone, use <b dir="ltr">m.youtube.com</b> in Lemur, not the YouTube app.<?php lg_ar(); ?>١) اتأكد إنها شغّالة في صفحة الإضافات. ٢) اعمل Refresh للصفحة. ٣) الفيديو لازم يكون عليه ترجمة (CC) إنجليزي. ٤) لو زرار Language Lens اللي في شريط الفيديو مطفي، شغّله. ٥) على الموبايل استخدم <b dir="ltr">m.youtube.com</b> في Lemur، مش تطبيق يوتيوب.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'On my phone, the zip won’t install', 'على الموبايل ملف الـ zip مش بيتثبت' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Use <b>Lemur Browser</b> (Chrome for Android and the YouTube app don’t take extensions). Turn on <b>Developer mode</b> in Lemur’s Extensions page first, then tap <b>+ (from .zip/.crx/.user.js)</b> and pick the zip itself, without unzipping it. <a href="#an-3">See the steps</a>.<?php lg_ar(); ?>استخدم <b>Lemur Browser</b> (Chrome على أندرويد وتطبيق يوتيوب مش بياخدوا إضافات). شغّل <b>Developer mode</b> في صفحة Extensions في Lemur الأول، وبعدين دوس <b>+ (from .zip/.crx/.user.js)</b> واختار ملف الـ zip نفسه من غير ما تفكّه. <a href="#an-3">شوف الخطوات</a>.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It asks me to sign in again / I’m signed out', 'بيطلب مني Sign in كل شوية / طلعت مسجل خروج' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Open the Language Lens window → Sign in with Sawa English and sign in again. If it still will not let you in, message Sherif on Skool.<?php lg_ar(); ?>افتح نافذة Language Lens ثم Sign in with Sawa English وادخل تاني. لو لسه مش بيدخل، ابعت لشريف على Skool.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'The extension vanished after I deleted the folder', 'الإضافة اختفت بعد ما مسحت الفولدر' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Chrome runs the extension from that folder. If you deleted or moved it, remove the extension and install it again from a new folder.<?php lg_ar(); ?>Chrome بيشغّل الإضافة من الفولدر نفسه. لو مسحته أو نقلته، احذف الإضافة وثبّتها تاني من فولدر جديد.<?php lg_end(); ?></details>
			<details id="update"><summary><?php echo lg_t( 'How do I update to a new version?', 'إزاي أحدّث لنسخة جديدة؟' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Download the new file from this page and unzip it into a <b>new folder</b>. In the extensions page, press <b>Remove</b> on the old Language Lens, then <b>Load unpacked</b> and choose the new folder (on a phone: <b>+ (from .zip…)</b> with the new zip). Your words and cards are saved in your account, so nothing is lost.<?php lg_ar(); ?>نزّل الملف الجديد من الصفحة دي وفكّه في <b>فولدر جديد</b>. في صفحة الإضافات دوس <b>Remove</b> على Language Lens القديمة، وبعدين <b>Load unpacked</b> واختار الفولدر الجديد (على الموبايل: <b>+ (from .zip…)</b> بالـ zip الجديد). كلماتك وكروتك محفوظة في حسابك، فمش هيضيع حاجة.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'I see “🔒 Members only”', 'بيظهر لي "🔒 Members only"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Some features are for members of Sawa English. <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">Join Sawa English</a> and they open at the next sync.<?php lg_ar(); ?>بعض المميزات لأعضاء سوا انجليش. <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">ادخل سوا انجليش</a> وهتتفتح مع أول مزامنة.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'Any other problem', 'أي مشكلة تانية' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Press <b>💬 Send feedback</b> in the Language Lens window (or in a word card), or write to Sherif in Sawa English on Skool: where you were, what you did, and what happened, ideally with a screenshot.<?php lg_ar(); ?>دوس <b>💬 Send feedback</b> في نافذة Language Lens (أو في كارت الكلمة)، أو اكتب لشريف في سوا انجليش على Skool: كنت فين، عملت إيه، وحصل إيه، وياريت سكرين شوت.<?php lg_end(); ?></details>
		</div>
	</div>
</section>

<!-- Close -->
<section class="sec dark close">
	<div class="wrap narrow center-text">
		<h2 class="xl"><?php echo lg_t( 'Ready to <span class="red">start?</span>', 'جاهز <span class="red">تبدأ؟</span>' ); // phpcs:ignore ?></h2>
		<div class="cta-row center"><?php echo $dl_chrome; // phpcs:ignore ?><?php echo $dl_ff; // phpcs:ignore ?></div>
		<p class="fine lg-fine"><a href="#start"><?php echo lg_t( 'Step-by-step guide', 'الشرح خطوة بخطوة' ); // phpcs:ignore ?></a> · <a href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open the Sawa app', 'افتح تطبيق سوا' ); // phpcs:ignore ?></a> · <a href="https://www.youtube.com/@sherif.abdelbaset"><?php echo lg_t( 'YouTube channel', 'قناة يوتيوب' ); // phpcs:ignore ?></a></p>
	</div>
</section>

</main>
<?php echo Sawa_Site::footer(); // phpcs:ignore ?>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.js?v=' . SAWA_SITE_VER ); ?>"></script>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.js?v=' . SAWA_SITE_VER ); ?>"></script>
</body>
</html>
