<?php
/**
 * /lens/: the Language Lens install-and-use guide. A full page of its own (no theme), phone-first.
 * English by default; Arabic (RTL) with the English | العربية toggle in the header (Sawa_Lang::boot() + the toggle in the site header; lg_en / lg_ar / lg_t in class-lens-guide.php write both languages).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$ver     = Sawa_Site_Lens::VERSION;
$chrome  = Sawa_Site_Lens::file_url( 'language-lens-chrome.zip' );
$firefox = Sawa_Site_Lens::file_url( 'language-lens-firefox.zip' );
$app     = home_url( '/app/' );
$size    = Sawa_Site_Lens::size( 'language-lens-chrome.zip' );

/** A screenshot with English alt text now and Arabic alt text (data-alt-ar) that the language switch swaps in. */
$img = function ( $n, $alt_en, $alt_ar, $w, $h, $cls = '' ) {
	return '<img class="shot ' . esc_attr( $cls ) . '" src="' . esc_url( Sawa_Site_Lens::img( $n ) ) . '" alt="' . esc_attr( $alt_en ) . '" data-alt-en="' . esc_attr( $alt_en ) . '" data-alt-ar="' . esc_attr( $alt_ar ) . '" width="' . (int) $w . '" height="' . (int) $h . '" loading="lazy" decoding="async">';
};
$num = function ( $n ) {
	$ar = array( '0' => '٠', '1' => '١', '2' => '٢', '3' => '٣', '4' => '٤', '5' => '٥', '6' => '٦', '7' => '٧', '8' => '٨', '9' => '٩' );
	return '<span class="lg-n"><span class="t t-en">' . (int) $n . '</span><span class="t t-ar">' . strtr( (string) (int) $n, $ar ) . '</span></span>';
};
$dl_chrome = '<a class="btn btn-red btn-lg" href="' . esc_url( $chrome ) . '" download>'
	. lg_t( '⬇ Download for Chrome &amp; Edge', '⬇ حمّل لـ Chrome و Edge' )
	. '<span class="dl-meta">v' . esc_html( $ver ) . ' · ' . esc_html( $size ) . '</span></a>';
$dl_ff     = '<a class="btn btn-ghost-light btn-lg" href="' . esc_url( $firefox ) . '" download>' . lg_t( '⬇ Firefox version', '⬇ نسخة Firefox' ) . '</a>';
?><!doctype html>
<html lang="en" dir="ltr" data-lang="en" data-title-en="Language Lens: download the extension and learn with it | Sawa English" data-title-ar="Language Lens: حمّل الإضافة واتعلم بيها | سوا انجليش">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0F0F10">
<title>Language Lens: download the extension and learn with it | Sawa English</title>
<meta name="description" content="Language Lens explains any English word on YouTube and any website. A picture-by-picture guide to downloading, installing and using it, on computer and phone.">
<?php echo Sawa_Lang::boot(); // phpcs:ignore -- the site-wide language setting (English default, ?lang=ar, saved per visitor) ?>
<link rel="icon" href="<?php echo esc_url( SAWA_LENS_URL . 'assets/icon-192.png' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Changa:wght@500;800&family=IBM+Plex+Sans+Arabic:wght@400;600&family=Instrument+Serif:ital@0;1&display=swap">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.css?v=' . SAWA_SITE_VER ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.css?v=' . SAWA_SITE_VER ); ?>">
</head>
<body class="sawa-page sawa-lens-page">
<a class="skip" href="#main"><?php echo lg_t( 'Skip to content', 'اتخطى للمحتوى' ); // phpcs:ignore ?></a>
<?php echo Sawa_Site::header( 'sawa-lens' ); // phpcs:ignore ?>
<main id="main">

<!-- Hero -->
<section class="sec dark lg-hero">
	<div class="wrap lg-hero-grid">
		<div class="lg-hero-text">
			<p class="meta"><?php echo lg_t( 'Language Lens · beta · free for Sawa English members', 'Language Lens · نسخة بيتا · مجانية لأعضاء سوا انجليش' ); // phpcs:ignore ?></p>
			<h1><?php echo lg_t( 'Understand any English word <span class="red">while you watch and read</span>', 'افهم أي كلمة إنجليزي <span class="red">وإنت بتتفرج وبتقرا</span>', 'span' ); // phpcs:ignore ?></h1>
			<?php lg_en( 'p' ); ?>A browser extension: hover (or tap) any word on YouTube or any website and see its Arabic meaning, how to say it, and its level. Every word you save becomes a review card in the Sawa app.<?php lg_ar(); ?>إضافة للمتصفح: حط الماوس (أو دوس بإصبعك) على أي كلمة في يوتيوب أو أي موقع، تلاقي معناها بالعربي ونطقها ومستواها. وكل كلمة تحفظها بتتحول لكروت مراجعة في تطبيق سوا.<?php lg_end(); ?>
			<div class="cta-row"><?php echo $dl_chrome; // phpcs:ignore ?><?php echo $dl_ff; // phpcs:ignore ?></div>
			<p class="fine lg-fine"><?php echo lg_t( 'Installing takes 5 minutes. <a href="#install">Start the picture guide ↓</a>', 'التثبيت ٥ دقايق. <a href="#install">ابدأ الشرح المصوّر ↓</a>' ); // phpcs:ignore ?></p>
		</div>
		<div class="lg-hero-shot"><div class="phone"><?php echo $img( 'yt-captions.webp', 'YouTube on a phone: the English line, the Arabic translation under it and how it sounds', 'يوتيوب على الموبايل: الجملة الإنجليزي وتحتها الترجمة العربي وطريقة النطق', 786, 1480, 'hero-img' ); // phpcs:ignore ?></div></div>
	</div>
</section>

<!-- What it does -->
<section class="sec soft" id="features">
	<div class="wrap">
		<p class="eyebrow"><?php echo lg_t( 'What it does', 'إيه اللي بتعمله' ); // phpcs:ignore ?></p>
		<h2><?php echo lg_t( 'Everything you watch becomes a lesson', 'كل اللي بتتفرج عليه بقى درس' ); // phpcs:ignore ?></h2>
		<div class="grid-3">
			<article class="card"><h3><?php echo lg_t( 'A word’s meaning in a second', 'معنى الكلمة في ثانية' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>Hover any word (or tap it on your phone): the Arabic meaning, how to pronounce it, and its level from A1 to C2.<?php lg_ar(); ?>حط الماوس على أي كلمة (أو اضغط عليها في الموبايل): المعنى بالعربي، النطق، ومستوى الكلمة من A1 لحد C2.<?php lg_end(); ?></article>
			<article class="card"><h3><?php echo lg_t( '3 lines on YouTube', '٣ سطور على يوتيوب' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>The sentence in English, the Arabic translation under it, and <b>How it sounds</b>: how it is really said in fast speech.<?php lg_ar(); ?>الجملة بالإنجليزي، تحتها الترجمة العربي، وتحتها <b>How it sounds</b>: إزاي بتتنطق فعلًا في الكلام السريع.<?php lg_end(); ?></article>
			<article class="card"><h3><?php echo lg_t( 'Transcript and repeat', 'Transcript وتكرار' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>All the words of the video are written next to it. Repeat any sentence and say it after the speaker.<?php lg_ar(); ?>كل كلام الفيديو مكتوب جنب الفيديو. كرر أي جملة وقولها ورا المتكلم.<?php lg_end(); ?></article>
			<article class="card"><h3><?php echo lg_t( 'Review cards', 'كروت مراجعة' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>Mark a word <b>Learning</b> or save a sentence with the star, and it waits for you in the Sawa app, ready to review.<?php lg_ar(); ?>علّم الكلمة <b>Learning</b> أو احفظ الجملة بالنجمة، وهتلاقيها في تطبيق سوا جاهزة للمراجعة.<?php lg_end(); ?></article>
			<article class="card"><h3><?php echo lg_t( 'Lyrics game 🎮', 'لعبة الأغاني 🎮' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>Play a song and fill in the missing words as you hear them. Listening practice with music you like.<?php lg_ar(); ?>سمّع أغنية وكمّل الكلمات الناقصة من الكلام. تدريب سمع ممتع من أغاني بتحبها.<?php lg_end(); ?></article>
			<article class="card"><h3><?php echo lg_t( 'Works on any website', 'تشتغل في أي موقع' ); // phpcs:ignore ?></h3><?php lg_en( 'p' ); ?>Articles, news, any English page. It also underlines mistakes while you type.<?php lg_ar(); ?>مقالات، أخبار، أي صفحة إنجليزي. وكمان مدقق كتابة بيسطّر لك الأخطاء وإنت بتكتب.<?php lg_end(); ?></article>
		</div>
		<div class="lg-wide"><?php echo $img( 'web-1-hover.webp', 'A word on a normal website with its meaning and the save buttons', 'كلمة على موقع عادي ومعناها وكارت الحفظ', 1000, 625 ); // phpcs:ignore ?></div>
	</div>
</section>

<!-- Install -->
<section class="sec light" id="install">
	<div class="wrap">
		<p class="eyebrow"><?php echo lg_t( 'Install', 'التثبيت' ); // phpcs:ignore ?></p>
		<h2><?php echo lg_t( '7 steps on Chrome', '٧ خطوات على Chrome' ); // phpcs:ignore ?></h2>
		<?php lg_en( 'p' ); ?>Language Lens is in beta, so for now you install it by hand from the file, until the store approves it. It is easy, and you only do it once.<?php lg_ar(); ?>إحنا لسه في مرحلة البيتا، فبنثبّتها يدويًا من الملف لحد ما المتجر يوافق. الخطوات سهلة، وبتعملها مرة واحدة بس.<?php lg_end(); ?>
		<nav class="lg-jump" aria-label="<?php echo esc_attr( 'Pick your device' ); ?>">
			<a href="#install">Chrome</a><a href="#edge">Edge</a><a href="#firefox">Firefox</a><a href="#android"><?php echo lg_t( 'Android', 'أندرويد' ); // phpcs:ignore ?></a><a href="#update"><?php echo lg_t( 'Update', 'تحديث' ); // phpcs:ignore ?></a>
		</nav>

		<ol class="lg-steps">
			<li>
				<div class="lg-txt"><?php echo $num( 1 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Download the file', 'نزّل الملف' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Press the button. A file called <b dir="ltr">language-lens-chrome.zip</b> goes to your Downloads folder.<?php lg_ar(); ?>اضغط الزرار وهينزل ملف اسمه <b dir="ltr">language-lens-chrome.zip</b> في فولدر Downloads.<?php lg_end(); ?>
					<p><?php echo $dl_chrome; // phpcs:ignore ?></p></div>
				<div class="lg-vis"><div class="mk mk-file" dir="ltr"><span class="zipic">ZIP</span><span class="fn">language-lens-chrome.zip<small><?php echo esc_html( $size ); ?></small></span><span class="ok">✓</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><?php echo $num( 2 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Unzip it (Extract)', 'فكّ الضغط (Extract)' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Right-click the file → <b>Extract All</b> → <b>Extract</b>. A folder with the same name appears. <b>Leave it where it is and do not delete it</b> after installing, because Chrome runs the extension from that folder.<?php lg_ar(); ?>كليك يمين على الملف ثم <b>Extract All</b> ثم <b>Extract</b>. هيطلع فولدر بنفس الاسم. <b>سيبه في مكانه وماتمسحوش</b> بعد التثبيت، لأن Chrome بيشغّل الإضافة منه.<?php lg_end(); ?>
					<?php echo lg_t( '<p class="fine">On a Mac: double-click the file.</p>', '<p class="fine">على Mac: دوس دوسة مزدوجة على الملف.</p>', 'div' ); // phpcs:ignore ?></div>
				<div class="lg-vis"><div class="mk mk-menu" dir="ltr"><span>Open</span><span>Open with</span><span class="hl">Extract All…</span><span>Copy as path</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><?php echo $num( 3 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Open the extensions page', 'افتح صفحة الإضافات' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Open Chrome and type <b dir="ltr">chrome://extensions</b> in the address bar, then press Enter. (Websites are not allowed to link to this address, so copy it and paste it.)<?php lg_ar(); ?>افتح Chrome واكتب في شريط العنوان <b dir="ltr">chrome://extensions</b> ثم Enter. (الرابط ده Chrome ما بيسمحش نفتحه من موقع، فانسخه والصقه.)<?php lg_end(); ?>
					<p><button type="button" class="btn btn-ink btn-sm" data-copy="chrome://extensions" data-done-en="Copied ✓ paste it in the address bar" data-done-ar="اتنسخ ✓ الصقه في شريط العنوان"><?php echo lg_t( 'Copy chrome://extensions', 'انسخ chrome://extensions' ); // phpcs:ignore ?></button></p></div>
				<div class="lg-vis"><div class="mk mk-bar" dir="ltr"><span class="lock">●</span><span class="url">chrome://extensions</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><?php echo $num( 4 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Turn on Developer mode', 'شغّل Developer mode' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>The switch is at the top right. Make it <b>blue (on)</b>. If Chrome later shows a message about developer mode, that is normal: close it.<?php lg_ar(); ?>الزرار فوق على اليمين. اخليه <b>أزرق (شغّال)</b>. لو ظهرتلك رسالة عن Developer mode بعد كده، عادي، اقفلها.<?php lg_end(); ?></div>
				<div class="lg-vis"><?php echo $img( 'ext-1-devmode-off.webp', 'Chrome’s extensions page with a red ring around the Developer mode switch', 'صفحة إضافات Chrome وحلقة حمرا حوالين زرار Developer mode', 960, 510 ); // phpcs:ignore ?></div>
			</li>
			<li>
				<div class="lg-txt"><?php echo $num( 5 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Click Load unpacked', 'اضغط Load unpacked' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>The <b>Load unpacked</b> button appears at the top left. Click it and choose the folder you extracted: <b>the folder that has the file manifest.json directly inside it</b>. Then you will see a Language Lens card, switched on.<?php lg_ar(); ?>هيظهر زرار <b>Load unpacked</b> فوق على الشمال. اضغطه واختار الفولدر اللي فكّيته، <b>الفولدر اللي جواه ملف manifest.json</b> مباشرة. وبعدها هتلاقي كارت Language Lens شغّال.<?php lg_end(); ?></div>
				<div class="lg-vis"><?php echo $img( 'ext-2-load-unpacked.webp', 'After turning on Developer mode, the Load unpacked button appears with a red ring around it', 'بعد تشغيل Developer mode ظهر زرار Load unpacked وحواليه حلقة حمرا', 960, 510 ); // phpcs:ignore ?><?php echo $img( 'ext-3-loaded.webp', 'The Language Lens card in the extensions page, switched on', 'كارت Language Lens ظاهر وشغّال في صفحة الإضافات', 960, 510 ); // phpcs:ignore ?></div>
			</li>
			<li class="lg-pin" id="pin">
				<div class="lg-txt"><?php echo $num( 6 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Pin it to the toolbar 📌', 'ثبّتها في الشريط 📌' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Chrome hides new extensions inside a menu. Pinning keeps the Language Lens icon always visible, so you can sign in and change settings in one click. Follow the four small steps below.<?php lg_ar(); ?>Chrome بيخبّي الإضافات الجديدة جوه قايمة. التثبيت (Pin) بيخلّي أيقونة Language Lens ظاهرة دايمًا عشان تسجّل دخول وتغيّر الإعدادات بضغطة. اتبع الـ ٤ خطوات الصغيرين اللي تحت.<?php lg_end(); ?></div>
				<ol class="lg-pins">
					<li><figure><?php echo $img( 'pin-1.webp', 'The top right of Chrome with a red ring around the puzzle-piece Extensions icon', 'أعلى يمين Chrome وحلقة حمرا حوالين أيقونة الإضافات (قطعة البازل)', 730, 220 ); // phpcs:ignore ?><figcaption><b>6a</b> <?php echo lg_t( 'Click the puzzle-piece <b>Extensions</b> icon at the top right, next to your profile picture.', 'اضغط أيقونة <b>الإضافات</b> (قطعة البازل 🧩) فوق على اليمين، جنب صورة حسابك.' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-2.webp', 'The Extensions menu: the Language Lens row with a red ring around the three-dot button', 'قايمة الإضافات: صف Language Lens وحلقة حمرا حوالين زرار النقط التلاتة', 1156, 460 ); // phpcs:ignore ?><figcaption><b>6b</b> <?php echo lg_t( 'Find <b>Language Lens – Sawa English</b>. Click the pin icon 📌 at the right of its row. If you see three dots (⋮) instead, click them.', 'دوّر على <b>Language Lens – Sawa English</b>. اضغط أيقونة الدبوس 📌 على يمين الصف. لو شايف ٣ نقط (⋮) بدالها، اضغط عليهم.' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-3.webp', 'The menu from the three dots with a red ring around Pin to toolbar', 'القايمة اللي بتطلع من النقط التلاتة وحلقة حمرا حوالين Pin to toolbar', 700, 432 ); // phpcs:ignore ?><figcaption><b>6c</b> <?php echo lg_t( 'If you opened the three-dot menu, choose <b>Pin to toolbar</b>.', 'لو فتحت قايمة النقط التلاتة، اختار <b>Pin to toolbar</b>.' ); // phpcs:ignore ?></figcaption></figure></li>
					<li><figure><?php echo $img( 'pin-4.webp', 'The Language Lens icon, a black square with a magnifier, now sits in the toolbar next to the puzzle icon', 'أيقونة Language Lens (مربع أسود فيه عدسة) بقت ظاهرة في الشريط جنب أيقونة البازل', 730, 220 ); // phpcs:ignore ?><figcaption><b>6d</b> <?php echo lg_t( 'Done! The Language Lens icon (a black square with a magnifier) now stays in the toolbar. Click it any time.', 'خلاص! أيقونة Language Lens (مربع أسود فيه عدسة) بقت ظاهرة دايمًا في الشريط. اضغط عليها في أي وقت.' ); // phpcs:ignore ?></figcaption></figure></li>
				</ol>
			</li>
			<li>
				<div class="lg-txt"><?php echo $num( 7 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Sign in with your Sawa English account', 'سجّل دخول بحساب سوا انجليش' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Click the Language Lens icon → <b>Sign in with Sawa English</b> → use the same account as in the Sawa app. Your account must be active. If you do not have one yet, <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">join Sawa English</a>.<?php lg_ar(); ?>اضغط أيقونة Language Lens ثم <b>Sign in with Sawa English</b> ثم ادخل بنفس حسابك في تطبيق سوا. لازم حسابك يكون متفعّل. لو لسه معندكش، <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">ادخل سوا انجليش</a>.<?php lg_end(); ?>
					<?php lg_en( 'p' ); ?><span class="fine">After your first sign-in, the free level test opens in a new tab: take it first, then go back to YouTube. In the Language Lens window the main settings are on top and the rest is under <b>More settings</b>. The <b>How to use it</b> link opens this page.</span><?php lg_ar(); ?><span class="fine">بعد أول تسجيل دخول هتفتحلك صفحة اختبار تحديد المستوى (ببلاش) في تبويب جديد: اعمله الأول، وبعدين ارجع ليوتيوب. وفي أيقونة Language Lens هتلاقي الإعدادات المهمة فوق، والباقي تحت <b>More settings</b>، ورابط <b>How to use it</b> بيفتحلك الصفحة دي.</span><?php lg_end(); ?></div>
				<div class="lg-vis"><?php echo $img( 'popup-signin.webp', 'The Language Lens window with the Sign in with Sawa English button', 'نافذة Language Lens وزرار Sign in with Sawa English', 720, 660, 'narrow-shot' ); // phpcs:ignore ?></div>
			</li>
		</ol>
		<p class="lg-done"><?php echo lg_t( '🎉 That’s it! Open any YouTube video with English subtitles and Language Lens is working.', '🎉 خلاص! افتح أي فيديو على يوتيوب بترجمة إنجليزي وهتلاقي Language Lens شغّالة.' ); // phpcs:ignore ?></p>

		<div class="lg-alt" id="edge">
			<h3>Edge</h3>
			<?php lg_en(); ?>
			<p>The same steps, with these differences:</p>
			<ul><li>The file is the same <b>language-lens-chrome.zip</b> (Edge runs Chrome extensions).</li><li>The page is <b dir="ltr">edge://extensions</b>.</li><li><b>Developer mode</b> is in the left menu at the bottom, and the <b>Load unpacked</b> button shows at the top once it is on.</li><li>To pin: click the puzzle-piece Extensions icon, then the eye icon (👁 Show in toolbar) next to Language Lens.</li></ul>
			<?php lg_ar(); ?>
			<p>نفس الخطوات بالظبط، بس:</p>
			<ul><li>الملف هو نفس <b>language-lens-chrome.zip</b> (Edge بيشغّل إضافات Chrome).</li><li>الصفحة هي <b dir="ltr">edge://extensions</b>.</li><li><b>Developer mode</b> هتلاقيه في القايمة اللي على الشمال تحت، والزرار <b>Load unpacked</b> بيظهر فوق بعد ما تشغّله.</li><li>للتثبيت: اضغط أيقونة الإضافات (البازل) ثم أيقونة العين (👁 Show in toolbar) جنب Language Lens.</li></ul>
			<?php lg_end(); ?>
		</div>
		<div class="lg-alt" id="firefox">
			<h3><?php echo lg_t( 'Firefox (computer)', 'Firefox (كمبيوتر)' ); // phpcs:ignore ?></h3>
			<?php lg_en( 'p' ); ?>Download the <a href="<?php echo esc_url( $firefox ); ?>" download>Firefox version</a>, open <b dir="ltr">about:debugging#/runtime/this-firefox</b> → <b>Load Temporary Add-on…</b> → choose the <b>language-lens-firefox.zip</b> file itself. <b>Note:</b> Firefox removes a temporary add-on when you close it, so you repeat this step each time until we publish on Firefox’s store. If you use Chrome or Edge, use those instead.<?php lg_ar(); ?>حمّل <a href="<?php echo esc_url( $firefox ); ?>" download>نسخة Firefox</a> وافتح <b dir="ltr">about:debugging#/runtime/this-firefox</b> ثم <b>Load Temporary Add-on…</b> ثم اختار الملف <b>language-lens-firefox.zip</b> نفسه. <b>ملحوظة:</b> Firefox بيشيل الإضافة المؤقتة لما تقفله وتفتحه، فهتعيد الخطوة دي كل مرة لحد ما ننزلها على متجر Firefox. لو بتستخدم Chrome أو Edge الأفضل تستخدمهم.<?php lg_end(); ?>
		</div>
		<div class="lg-alt" id="android">
			<h3><?php echo lg_t( 'Android', 'أندرويد' ); // phpcs:ignore ?> <span class="tag"><?php echo lg_t( 'experimental', 'تجريبي' ); // phpcs:ignore ?></span></h3>
			<?php lg_en(); ?>
			<p>Language Lens works on YouTube’s phone site <b dir="ltr">m.youtube.com</b>: tap a word with your finger instead of hovering, and the card slides up from the bottom. We are still testing on real phones, so if something goes wrong, tell us.</p>
			<ol><li>Use a browser that accepts manual extensions, such as <b>Lemur Browser</b> or <b>Kiwi Browser</b>.</li><li>Download the <a href="<?php echo esc_url( $chrome ); ?>" download>Chrome file</a> on your phone.</li><li>Open <b dir="ltr">chrome://extensions</b>, turn on <b>Developer mode</b> → <b>+ (from .zip/.crx)</b> → choose the file.</li><li>Sign in from the Language Lens icon. After the first sign-in the level test opens in a new tab: take it first, then go back.</li><li>Open <b dir="ltr">m.youtube.com</b> (not the app), pick a video with English subtitles and tap any word.</li></ol>
			<p class="fine">The normal YouTube app does not accept extensions: use the browser. iPhone: coming later.</p>
			<?php lg_ar(); ?>
			<p>Language Lens بتشتغل على موقع يوتيوب للموبايل <b dir="ltr">m.youtube.com</b>: اضغط على الكلمة بإصبعك بدل الماوس، والكارت بيطلع من تحت. لسه بنجرّبها على موبايلات حقيقية، فلو جرّبت وحصلت مشكلة قولّي.</p>
			<ol><li>استخدم متصفح بيقبل الإضافات اليدوية مثل <b>Lemur Browser</b> أو <b>Kiwi Browser</b>.</li><li>نزّل <a href="<?php echo esc_url( $chrome ); ?>" download>ملف Chrome</a> على الموبايل.</li><li>افتح <b dir="ltr">chrome://extensions</b> وشغّل <b>Developer mode</b> ثم <b>+ (from .zip/.crx)</b> ثم اختار الملف.</li><li>سجّل دخول من أيقونة Language Lens. بعد أول تسجيل هيفتحلك اختبار تحديد المستوى في تبويب جديد: اعمله الأول وبعدين ارجع.</li><li>افتح <b dir="ltr">m.youtube.com</b> (مش التطبيق) واختار فيديو بترجمة إنجليزي، واضغط على أي كلمة.</li></ol>
			<p class="fine">تطبيق يوتيوب العادي مش بيقبل إضافات، لازم المتصفح. وأيفون: قريبًا.</p>
			<?php lg_end(); ?>
		</div>
		<div class="lg-alt" id="update">
			<h3><?php echo lg_t( 'How do I update to a new version?', 'إزاي أحدّث لنسخة جديدة؟' ); // phpcs:ignore ?></h3>
			<?php lg_en(); ?>
			<ol><li>Download the new file from this page (or from a Sawa message) and unzip it into a <b>new folder</b>.</li><li>In <b dir="ltr">chrome://extensions</b> click <b>Remove</b> on the old Language Lens.</li><li>Click <b>Load unpacked</b> and choose the new folder.</li></ol>
			<p class="fine">Your words and cards are saved in your account, so nothing is lost. Once the store approves us, it will update by itself.</p>
			<?php lg_ar(); ?>
			<ol><li>نزّل الملف الجديد من الصفحة دي (أو من رسالة سوا) وفكّه في <b>فولدر جديد</b>.</li><li>في <b dir="ltr">chrome://extensions</b> اضغط <b>Remove</b> على Language Lens القديمة.</li><li>اضغط <b>Load unpacked</b> واختار الفولدر الجديد.</li></ol>
			<p class="fine">كلماتك وكروتك محفوظة في حسابك، فمش هتضيع. بعد ما المتجر يوافق هتتحدّث لوحدها.</p>
			<?php lg_end(); ?>
		</div>
	</div>
</section>

<!-- How to use -->
<section class="sec soft" id="use">
	<div class="wrap">
		<p class="eyebrow"><?php echo lg_t( 'How to use it', 'الاستخدام' ); // phpcs:ignore ?></p>
		<h2><?php echo lg_t( 'How to use it every day', 'إزاي تستخدمها كل يوم' ); // phpcs:ignore ?></h2>
		<?php lg_en( 'p' ); ?>The pictures are from YouTube on a phone. On a computer you do the same things, with the mouse.<?php lg_ar(); ?>الصور من يوتيوب على الموبايل. على الكمبيوتر بتعمل نفس الحاجات، بس بالماوس.<?php lg_end(); ?>
		<div class="lg-uses">
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-captions.webp', 'Captions on the video in English, Arabic and pronunciation', 'ترجمة بالإنجليزي والعربي والنطق على الفيديو', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><?php echo $num( 1 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Watch YouTube with captions', 'اتفرج على يوتيوب بالترجمة' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Open any video that has English subtitles. Above the video you get 3 lines: <b>English</b>, <b>Arabic</b> and <b>how it sounds</b>. Under the video is the Language Lens panel with all the tools.<?php lg_ar(); ?>افتح أي فيديو فيه ترجمة إنجليزي. هتلاقي ٣ سطور فوق الفيديو: <b>الإنجليزي</b>، <b>العربي</b>، و<b>طريقة النطق</b>. تحت الفيديو لوحة Language Lens فيها كل الأدوات.<?php lg_end(); ?></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-card.webp', 'The word card: pronunciation, level and the I know it, Learning and Curious buttons', 'كارت الكلمة: النطق والمستوى وأزرار I know it وLearning وCurious', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><?php echo $num( 2 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Tap a word and save it', 'اضغط على كلمة واحفظها' ); // phpcs:ignore ?></h3>
					<?php lg_en(); ?>
					<p>On a computer, hover a word. On a phone, tap it (this works on any website, not only YouTube; press and hold selects words). A card opens with the meaning, the pronunciation and the level (A1 to C2), and you choose:</p>
					<ul><li><b>✓ I know it</b>: you know it already.</li><li><b>Learning</b>: you want to memorise it (only the important words).</li><li><b>💡 Curious</b>: you only want to understand it, and you earn XP.</li></ul>
					<p>If the meaning is not clear, tap <b>💬 Meaning here</b> under the card: it explains the word <b>in this exact sentence</b>.</p>
					<p>Phrases and idioms (like “give up” or “by the way”) have a <b>blue underline</b> as one unit: tap any word of it to get the meaning of the whole expression.</p>
					<p>Every word you save shows up in <b>Review</b> in the <a href="<?php echo esc_url( $app ); ?>">Sawa app</a> as a review card.</p>
					<?php lg_ar(); ?>
					<p>على الكمبيوتر حط الماوس على الكلمة. على الموبايل اضغط عليها (ده بيشتغل في أي موقع، مش يوتيوب بس؛ والضغط المطوّل بيحدد كلمات). هيفتح كارت فيه المعنى والنطق والمستوى (من A1 لحد C2) وتختار:</p>
					<ul><li><b>✓ I know it</b>: عارفها.</li><li><b>Learning</b>: عايز تحفظها (الكلمات المهمة بس).</li><li><b>💡 Curious</b>: عايز تفهمها بس وبتاخد XP.</li></ul>
					<p>لو المعنى مش واضح، دوس <b>💬 Meaning here</b> تحت الكارت: بيشرحلك معنى الكلمة <b>في الجملة دي بالذات</b>.</p>
					<p>العبارات والتعبيرات (زي “give up” أو “by the way”) عليها <b>خط أزرق</b> كوحدة واحدة: دوس على أي كلمة فيها وهتشوف معنى العبارة كلها.</p>
					<p>كل كلمة تحفظها بتظهر في <b>Review</b> في <a href="<?php echo esc_url( $app ); ?>">تطبيق سوا</a> كارت مراجعة.</p>
					<?php lg_end(); ?></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-transcript.webp', 'The transcript under the video, with repeat and star buttons next to each sentence', 'الـ Transcript تحت الفيديو وكل جملة جنبها أزرار التكرار والنجمة', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><?php echo $num( 3 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Transcript, repeat and saving sentences', 'Transcript، تكرار، وحفظ جمل' ); // phpcs:ignore ?></h3>
					<?php lg_en(); ?>
					<p>All the words are written under the video. Tap a sentence to play it. Next to each sentence:</p>
					<ul><li><b>Auto-scroll</b> (above the transcript): the text moves along with the video.</li><li><b>🔁 Repeat</b>: the sentence repeats so you can say it after the speaker.</li><li><b>☆ the star</b>: saves the sentence as a review card.</li><li>The wave button: how it sounds in fast speech.</li></ul>
					<p>On a computer you also have <b>A / S / D</b> for previous sentence / repeat / next sentence.</p>
					<?php lg_ar(); ?>
					<p>تحت الفيديو كل الكلام مكتوب. دوس على أي جملة تتشغّل. وجنب كل جملة:</p>
					<ul><li><b>Auto-scroll</b> (فوق الـ Transcript): الشرح بيمشي لوحده مع الفيديو.</li><li><b>🔁 Repeat</b>: تتكرر وقولها ورا المتكلم.</li><li><b>☆ النجمة</b>: تحفظ الجملة في كروت المراجعة.</li><li>زرار الموجة: إزاي بتتنطق في الكلام السريع.</li></ul>
					<p>على الكمبيوتر كمان: <b>A / S / D</b> للجملة اللي قبلها / تكرار / اللي بعدها.</p>
					<?php lg_end(); ?></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><?php echo $img( 'web-4-save.webp', 'Selecting a phrase on a normal website and saving it', 'تحديد جملة على موقع عادي وحفظها', 1000, 625 ); // phpcs:ignore ?></div>
				<div class="lg-txt"><?php echo $num( 4 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Any website, not only YouTube', 'أي موقع، مش يوتيوب بس' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>On a computer, open any English article. Hover a word for its meaning, or <b>select a phrase</b> to translate it, hear it and save it.<?php lg_ar(); ?>على الكمبيوتر، افتح أي مقال إنجليزي. حط الماوس على الكلمة لمعناها، أو <b>حدد جملة</b> عشان تترجمها وتسمعها وتحفظها.<?php lg_end(); ?></div>
			</article>
			<article class="lg-use lg-use-text">
				<div class="lg-txt"><?php echo $num( 5 ); // phpcs:ignore ?><h3><?php echo lg_t( 'Lyrics game 🎮', 'لعبة الأغاني 🎮' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>Open a song on YouTube that has time-synced lyrics, and in the Language Lens panel press <b>🎤 Music → 🎮 Lyrics game</b>. You listen to the song and fill in the missing words. You can turn on <b>🌐 Show the translation</b> or <b>⏸ Pause after every line</b> to go at your own pace.<?php lg_ar(); ?>افتح أغنية على يوتيوب ليها كلمات متزامنة، وفي لوحة Language Lens اضغط <b>🎤 Music ثم 🎮 Lyrics game</b>. بتسمع الأغنية وتكمّل الكلمات الناقصة. ممكن تشغّل <b>🌐 Show the translation</b> أو <b>⏸ Pause after every line</b> عشان تمشي براحتك.<?php lg_end(); ?></div>
			</article>
			<article class="lg-use lg-use-text">
				<div class="lg-txt"><?php echo $num( 6 ); // phpcs:ignore ?><h3><?php echo lg_t( 'The on/off switch', 'زرار التشغيل والإيقاف' ); // phpcs:ignore ?></h3>
					<?php lg_en( 'p' ); ?>On YouTube there is a Language Lens button in the video bar next to <b>Aa</b>. Turn it off and YouTube’s own captions come back and the panel hides. From <b>Aa</b> you can also switch each line on its own (English / Arabic / how it sounds).<?php lg_ar(); ?>على يوتيوب فيه زرار Language Lens في شريط الفيديو جنب <b>Aa</b>. لو طفّيته، ترجمة يوتيوب الأصلية ترجع واللوحة تختفي. من <b>Aa</b> تتحكم كمان في كل سطر لوحده (إنجليزي / عربي / النطق).<?php lg_end(); ?></div>
			</article>
		</div>
		<div class="cta-row center"><a class="btn btn-ink btn-lg" href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open the Sawa app (review cards)', 'افتح تطبيق سوا (كروت المراجعة)' ); // phpcs:ignore ?></a></div>
	</div>
</section>

<!-- FAQ -->
<section class="sec light" id="faq">
	<div class="wrap narrow">
		<p class="eyebrow"><?php echo lg_t( 'If something does not work', 'لو حاجة مش شغالة' ); // phpcs:ignore ?></p>
		<h2><?php echo lg_t( 'Questions and fixes', 'أسئلة وحلول' ); // phpcs:ignore ?></h2>
		<div class="faq">
			<details><summary><?php echo lg_t( 'I can’t find the Load unpacked button', 'مش لاقي زرار Load unpacked' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Developer mode is off. Turn it on at the top right (or from the left menu in Edge) and the button appears.<?php lg_ar(); ?>يبقى Developer mode مش شغّال. شغّله من فوق على اليمين (أو من القايمة اللي على الشمال في Edge) وهيظهر.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It says “Manifest file is missing or unreadable”', 'بيقول "Manifest file is missing or unreadable"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>You picked the wrong folder. Choose the folder that has <b dir="ltr">manifest.json</b> directly inside it, not the folder above it. Also make sure you extracted the zip (do not open it from inside the zip).<?php lg_ar(); ?>اخترت الفولدر الغلط. لازم تختار الفولدر اللي جواه ملف <b dir="ltr">manifest.json</b> مباشرة، مش الفولدر اللي فوقه. اتأكد كمان إنك عملت Extract للملف (مش فتحته من جوه الـ zip).<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'Chrome shows “Disable developer mode extensions”', 'Chrome بيظهر رسالة "Disable developer mode extensions"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>That message is normal for any extension installed by hand. Close it (or press Cancel) and do not disable the extension. It goes away once we are on the store.<?php lg_ar(); ?>دي رسالة عادية لأي إضافة بتتثبت يدويًا. اضغط إغلاق (أو Cancel) ومتعطّلش الإضافة. هتختفي لما ننزل على المتجر.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'I can’t see the Language Lens icon', 'مش شايف أيقونة Language Lens' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Chrome hides new extensions. Click the puzzle-piece icon at the top right and pin Language Lens: see <a href="#pin">step 6</a>.<?php lg_ar(); ?>Chrome بيخبّي الإضافات الجديدة. اضغط أيقونة البازل فوق على اليمين وثبّت Language Lens: شوف <a href="#pin">الخطوة ٦</a>.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It doesn’t show up on YouTube', 'الإضافة مش بتظهر على يوتيوب' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>1) Check it is switched on in <b dir="ltr">chrome://extensions</b>. 2) Refresh the page. 3) The video needs English subtitles (CC). 4) If the button in the video bar is off, turn it on.<?php lg_ar(); ?>١) اتأكد إنها شغّالة في <b dir="ltr">chrome://extensions</b>. ٢) اعمل Refresh للصفحة. ٣) الفيديو لازم يكون عليه ترجمة (CC) إنجليزي. ٤) لو الزرار اللي في شريط الفيديو مطفي، شغّله.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'It asks me to sign in again / I’m signed out', 'بيطلب مني Sign in كل شوية / طلعت مسجل خروج' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Click the Language Lens icon → Sign in with Sawa English and sign in again. If it still will not let you in, your account is not active yet: message me on Skool.<?php lg_ar(); ?>اضغط أيقونة Language Lens ثم Sign in with Sawa English وادخل تاني. لو لسه مش بيدخل، يبقى حسابك مش متفعّل: ابعتلي على Skool.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'The extension vanished after I deleted the folder', 'الإضافة اختفت بعد ما مسحت الفولدر' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Chrome runs the extension from that folder. If you deleted or moved it, remove the extension and install it again from a new folder.<?php lg_ar(); ?>Chrome بيشغّل الإضافة من الفولدر نفسه. لو مسحته أو نقلته، احذف الإضافة وثبّتها تاني من فولدر جديد.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'On my phone', 'على الموبايل' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Use <b dir="ltr">m.youtube.com</b> in Lemur or Kiwi (see the Android section above). The YouTube app does not accept extensions.<?php lg_ar(); ?>استخدم <b dir="ltr">m.youtube.com</b> في Lemur أو Kiwi (شوف قسم أندرويد فوق). تطبيق يوتيوب مش بيقبل إضافات.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'I see “🔒 Members only”', 'بيظهر لي "🔒 Members only"' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Your account is on the free plan: you can still save words to Review, but meanings, AI explanations, translations and the writing checker are for members. <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">Join Sawa English</a> and it opens at the next sync.<?php lg_ar(); ?>حسابك على الخطة المجانية: تقدر تحفظ كلمات في Review، بس المعاني وشرح الذكاء الاصطناعي والترجمة ومدقق الكتابة للأعضاء. <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">ادخل سوا انجليش</a> وهتتفتح مع أول مزامنة.<?php lg_end(); ?></details>
			<details><summary><?php echo lg_t( 'Any other problem', 'أي مشكلة تانية' ); // phpcs:ignore ?></summary><?php lg_en( 'p' ); ?>Tap <b>💬 Send feedback</b> in the Language Lens window (or in a word card), or write to me in Sawa English on Skool: where you were, what you did, and what happened, ideally with a screenshot.<?php lg_ar(); ?>دوس <b>💬 Send feedback</b> في نافذة Language Lens (أو في كارت الكلمة)، أو اكتب لي في سوا انجليش على Skool: كنت فين، عملت إيه، وحصل إيه، وياريت سكرين شوت.<?php lg_end(); ?></details>
		</div>
	</div>
</section>

<!-- Close -->
<section class="sec dark close">
	<div class="wrap narrow center-text">
		<h2 class="xl"><?php echo lg_t( 'Ready to <span class="red">start?</span>', 'جاهز <span class="red">تبدأ؟</span>' ); // phpcs:ignore ?></h2>
		<div class="cta-row center"><?php echo $dl_chrome; // phpcs:ignore ?><?php echo $dl_ff; // phpcs:ignore ?></div>
		<p class="fine lg-fine"><a href="<?php echo esc_url( $app ); ?>"><?php echo lg_t( 'Open the Sawa app', 'افتح تطبيق سوا' ); // phpcs:ignore ?></a> · <a href="https://www.youtube.com/@sherif.abdelbaset"><?php echo lg_t( 'YouTube channel', 'قناة يوتيوب' ); // phpcs:ignore ?></a></p>
	</div>
</section>

</main>
<?php echo Sawa_Site::footer(); // phpcs:ignore ?>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.js?v=' . SAWA_SITE_VER ); ?>"></script>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.js?v=' . SAWA_SITE_VER ); ?>"></script>
</body>
</html>
