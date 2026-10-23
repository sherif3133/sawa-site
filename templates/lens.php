<?php
/**
 * /lens/: the Language Lens install-and-use guide. A full page of its own (no theme), phone-first, Arabic RTL.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$L        = 'Sawa_Site_Lens';
$ver      = Sawa_Site_Lens::VERSION;
$chrome   = Sawa_Site_Lens::file_url( 'language-lens-chrome.zip' );
$firefox  = Sawa_Site_Lens::file_url( 'language-lens-firefox.zip' );
$app      = home_url( '/app/' );
$img      = function ( $n, $alt, $w, $h, $cls = '' ) {
	return '<img class="shot ' . esc_attr( $cls ) . '" src="' . esc_url( Sawa_Site_Lens::img( $n ) ) . '" alt="' . esc_attr( $alt ) . '" width="' . (int) $w . '" height="' . (int) $h . '" loading="lazy" decoding="async">';
};
$dl_chrome = '<a class="btn btn-red btn-lg" href="' . esc_url( $chrome ) . '" download>⬇ حمّل لـ Chrome و Edge <span class="dl-meta">v' . esc_html( $ver ) . ' · ' . esc_html( Sawa_Site_Lens::size( 'language-lens-chrome.zip' ) ) . '</span></a>';
$dl_ff     = '<a class="btn btn-ghost-light btn-lg" href="' . esc_url( $firefox ) . '" download>⬇ نسخة Firefox</a>';
?><!doctype html>
<html dir="rtl" lang="ar">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0F0F10">
<title>Language Lens: حمّل الإضافة واتعلم بيها | سوا انجليش</title>
<meta name="description" content="إضافة Language Lens بتشرحلك أي كلمة إنجليزي على يوتيوب وأي موقع. دليل مصوّر خطوة بخطوة للتحميل والتثبيت والاستخدام، على الكمبيوتر والموبايل.">
<link rel="icon" href="<?php echo esc_url( SAWA_LENS_URL . 'assets/icon-192.png' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Changa:wght@500;800&family=IBM+Plex+Sans+Arabic:wght@400;600&family=Instrument+Serif:ital@0;1&display=swap">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.css?v=' . SAWA_SITE_VER ); ?>">
<link rel="stylesheet" href="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.css?v=' . SAWA_SITE_VER ); ?>">
</head>
<body class="sawa-page sawa-lens-page">
<a class="skip" href="#main">اتخطى للمحتوى</a>
<?php echo Sawa_Site::header( 'sawa-lens' ); // phpcs:ignore ?>
<main id="main">

<!-- Hero -->
<section class="sec dark lg-hero">
	<div class="wrap lg-hero-grid">
		<div class="lg-hero-text">
			<p class="meta">Language Lens · نسخة بيتا · مجانية لأعضاء سوا انجليش</p>
			<h1>افهم أي كلمة إنجليزي <span class="red">وإنت بتتفرج وبتقرا</span></h1>
			<p class="lead">إضافة للمتصفح: حط الماوس (أو دوس بإصبعك) على أي كلمة في يوتيوب أو أي موقع، تلاقي معناها بالعربي ونطقها ومستواها. وكل كلمة تحفظها بتتحول لكروت مراجعة في تطبيق سوا.</p>
			<div class="cta-row"><?php echo $dl_chrome; // phpcs:ignore ?><?php echo $dl_ff; // phpcs:ignore ?></div>
			<p class="fine lg-fine">التثبيت ٥ دقايق. الشرح المصوّر تحت. <a href="#install">ابدأ التثبيت ↓</a></p>
		</div>
		<div class="lg-hero-shot"><div class="phone"><?php echo $img( 'yt-captions.webp', 'يوتيوب على الموبايل: الجملة الإنجليزي وتحتها الترجمة العربي وطريقة النطق', 786, 1480, 'hero-img' ); // phpcs:ignore ?></div></div>
	</div>
</section>

<!-- What it does -->
<section class="sec soft" id="features">
	<div class="wrap">
		<p class="eyebrow">إيه اللي بتعمله</p>
		<h2>كل اللي بتتفرج عليه بقى درس</h2>
		<div class="grid-3">
			<article class="card"><h3>معنى الكلمة في ثانية</h3><p>حط الماوس على أي كلمة (أو اضغط عليها في الموبايل): المعنى بالعربي، النطق، ومستوى الكلمة من A1 لحد C2.</p></article>
			<article class="card"><h3>٣ سطور على يوتيوب</h3><p>الجملة بالإنجليزي، تحتها الترجمة العربي، وتحتها <b>How it sounds</b>: إزاي بتتنطق فعلًا في الكلام السريع.</p></article>
			<article class="card"><h3>Transcript وتكرار</h3><p>كل كلام الفيديو مكتوب جنب الفيديو. كرر أي جملة وقولها ورا المتكلم.</p></article>
			<article class="card"><h3>كروت مراجعة</h3><p>علّم الكلمة <b>Learning</b> أو احفظ الجملة بالنجمة، وهتلاقيها في تطبيق سوا جاهزة للمراجعة.</p></article>
			<article class="card"><h3>لعبة الأغاني 🎮</h3><p>سمّع أغنية وكمّل الكلمات الناقصة من الكلام. تدريب سمع ممتع من أغاني بتحبها.</p></article>
			<article class="card"><h3>تشتغل في أي موقع</h3><p>مقالات، أخبار، أي صفحة إنجليزي. وكمان مدقق كتابة بيسطّر لك الأخطاء وإنت بتكتب.</p></article>
		</div>
		<?php echo '<div class="lg-wide">' . $img( 'web-1-hover.webp', 'كلمة على موقع عادي ومعناها وكارت الحفظ', 1000, 625 ) . '</div>'; // phpcs:ignore ?>
	</div>
</section>

<!-- Install -->
<section class="sec light" id="install">
	<div class="wrap">
		<p class="eyebrow">التثبيت</p>
		<h2>٧ خطوات على Chrome</h2>
		<p class="lead">إحنا لسه في مرحلة البيتا، فبنثبّتها يدويًا من الملف لحد ما المتجر يوافق. الخطوات سهلة، وبتعملها مرة واحدة بس.</p>
		<nav class="lg-jump" aria-label="اختار جهازك">
			<a href="#install">Chrome</a><a href="#edge">Edge</a><a href="#firefox">Firefox</a><a href="#android">أندرويد</a><a href="#update">تحديث</a>
		</nav>

		<ol class="lg-steps">
			<li>
				<div class="lg-txt"><span class="lg-n">١</span><h3>نزّل الملف</h3><p>اضغط الزرار وهينزل ملف اسمه <b dir="ltr">language-lens-chrome.zip</b> في فولدر Downloads.</p><p><?php echo $dl_chrome; // phpcs:ignore ?></p></div>
				<div class="lg-vis"><div class="mk mk-file" dir="ltr"><span class="zipic">ZIP</span><span class="fn">language-lens-chrome.zip<small><?php echo esc_html( Sawa_Site_Lens::size( 'language-lens-chrome.zip' ) ); ?></small></span><span class="ok">✓</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٢</span><h3>فكّ الضغط (Extract)</h3><p>كليك يمين على الملف ثم <b>Extract All</b> ثم <b>Extract</b>. هيطلع فولدر بنفس الاسم. <b>سيبه في مكانه وماتمسحوش</b> بعد التثبيت، لأن Chrome بيشغّل الإضافة منه.</p><p class="fine">على Mac: دوس دوسة مزدوجة على الملف.</p></div>
				<div class="lg-vis"><div class="mk mk-menu" dir="ltr"><span>Open</span><span>Open with</span><span class="hl">Extract All…</span><span>Copy as path</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٣</span><h3>افتح صفحة الإضافات</h3><p>افتح Chrome واكتب في شريط العنوان <b dir="ltr">chrome://extensions</b> ثم Enter. (الرابط ده Chrome ما بيسمحش نفتحه من موقع، فانسخه والصقه.)</p><p><button type="button" class="btn btn-ink btn-sm" data-copy="chrome://extensions">انسخ chrome://extensions</button></p></div>
				<div class="lg-vis"><div class="mk mk-bar" dir="ltr"><span class="lock">●</span><span class="url">chrome://extensions</span></div></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٤</span><h3>شغّل Developer mode</h3><p>الزرار فوق على اليمين. اخليه <b>أزرق (شغّال)</b>. لو ظهرتلك رسالة عن Developer mode بعد كده، عادي، اقفلها.</p></div>
				<div class="lg-vis"><?php echo $img( 'ext-1-devmode-off.webp', 'صفحة إضافات Chrome وحلقة حمرا حوالين زرار Developer mode', 960, 510 ); // phpcs:ignore ?></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٥</span><h3>اضغط Load unpacked</h3><p>هيظهر زرار <b>Load unpacked</b> فوق على الشمال. اضغطه واختار الفولدر اللي فكّيته، <b>الفولدر اللي جواه ملف manifest.json</b> مباشرة.</p></div>
				<div class="lg-vis"><?php echo $img( 'ext-2-load-unpacked.webp', 'بعد تشغيل Developer mode ظهر زرار Load unpacked وحواليه حلقة حمرا', 960, 510 ); // phpcs:ignore ?></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٦</span><h3>تأكد إنها اتثبتت ودبّسها 📌</h3><p>هتلاقي كارت <b>Language Lens – Sawa English</b> شغّال. بعدين اضغط أيقونة البازل 🧩 فوق جنب شريط العنوان، ودوس على الدبوس 📌 جنب Language Lens عشان تفضل ظاهرة.</p></div>
				<div class="lg-vis"><?php echo $img( 'ext-3-loaded.webp', 'كارت Language Lens ظاهر وشغّال في صفحة الإضافات', 960, 510 ); // phpcs:ignore ?>
					<div class="mk mk-tool" dir="ltr"><span class="url">chrome://…</span><span class="puz">🧩</span><span class="pop"><b>Language Lens</b><i class="pin">📌</i></span></div></div>
			</li>
			<li>
				<div class="lg-txt"><span class="lg-n">٧</span><h3>سجّل دخول بحساب سوا انجليش</h3><p>اضغط أيقونة Language Lens ثم <b>Sign in with Sawa English</b> ثم ادخل بنفس حسابك في تطبيق سوا. لازم حسابك يكون متفعّل. لو لسه معندكش، <a href="<?php echo esc_url( Sawa_Site::s( 'join_url' ) ); ?>">ادخل سوا انجليش</a>.</p></div>
				<div class="lg-vis"><?php echo $img( 'popup-signin.webp', 'نافذة Language Lens وزرار Sign in with Sawa English', 720, 660, 'narrow-shot' ); // phpcs:ignore ?></div>
			</li>
		</ol>
		<p class="lg-done">🎉 خلاص! افتح أي فيديو على يوتيوب بترجمة إنجليزي وهتلاقي Language Lens شغّالة.</p>

		<div class="lg-alt" id="edge">
			<h3>Edge</h3>
			<p>نفس الخطوات بالظبط، بس:</p>
			<ul><li>الملف هو نفس <b>language-lens-chrome.zip</b> (Edge بيشغّل إضافات Chrome).</li><li>الصفحة هي <b dir="ltr">edge://extensions</b>.</li><li><b>Developer mode</b> هتلاقيه في القايمة اللي على الشمال تحت، والزرار <b>Load unpacked</b> بيظهر فوق بعد ما تشغّله.</li><li>الدبوس: أيقونة الإضافات 🧩 ثم الدبوس جنب Language Lens.</li></ul>
		</div>
		<div class="lg-alt" id="firefox">
			<h3>Firefox (كمبيوتر)</h3>
			<p>حمّل <a href="<?php echo esc_url( $firefox ); ?>" download>نسخة Firefox</a> وافتح <b dir="ltr">about:debugging#/runtime/this-firefox</b> ثم <b>Load Temporary Add-on…</b> ثم اختار الملف <b>language-lens-firefox.zip</b> نفسه. <b>ملحوظة:</b> Firefox بيشيل الإضافة المؤقتة لما تقفله وتفتحه، فهتعيد الخطوة دي كل مرة لحد ما ننزلها على متجر Firefox. لو بتستخدم Chrome أو Edge الأفضل تستخدمهم.</p>
		</div>
		<div class="lg-alt" id="android">
			<h3>أندرويد <span class="tag">تجريبي</span></h3>
			<p>Language Lens بتشتغل على موقع يوتيوب للموبايل <b dir="ltr">m.youtube.com</b>: اضغط على الكلمة بإصبعك بدل الماوس، والكارت بيطلع من تحت. لسه بنجرّبها على موبايلات حقيقية، فلو جرّبت وحصلت مشكلة قولّي.</p>
			<ol><li>استخدم متصفح بيقبل الإضافات اليدوية مثل <b>Lemur Browser</b> أو <b>Kiwi Browser</b>.</li><li>نزّل <a href="<?php echo esc_url( $chrome ); ?>" download>ملف Chrome</a> على الموبايل.</li><li>افتح <b dir="ltr">chrome://extensions</b> وشغّل <b>Developer mode</b> ثم <b>+ (from .zip/.crx)</b> ثم اختار الملف.</li><li>افتح <b dir="ltr">m.youtube.com</b> (مش التطبيق) واختار فيديو بترجمة إنجليزي.</li></ol>
			<p class="fine">تطبيق يوتيوب العادي مش بيقبل إضافات، لازم المتصفح. وأيفون: قريبًا.</p>
		</div>
		<div class="lg-alt" id="update">
			<h3>إزاي أحدّث لنسخة جديدة؟</h3>
			<ol><li>نزّل الملف الجديد من الصفحة دي (أو من رسالة سوا) وفكّه في <b>فولدر جديد</b>.</li><li>في <b dir="ltr">chrome://extensions</b> اضغط <b>Remove</b> على Language Lens القديمة.</li><li>اضغط <b>Load unpacked</b> واختار الفولدر الجديد.</li></ol>
			<p class="fine">كلماتك وكروتك محفوظة في حسابك، فمش هتضيع. بعد ما المتجر يوافق هتتحدّث لوحدها.</p>
		</div>
	</div>
</section>

<!-- How to use -->
<section class="sec soft" id="use">
	<div class="wrap">
		<p class="eyebrow">الاستخدام</p>
		<h2>إزاي تستخدمها كل يوم</h2>
		<p class="lead">الصور من يوتيوب على الموبايل. على الكمبيوتر بتعمل نفس الحاجات، بس بالماوس.</p>
		<div class="lg-uses">
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-captions.webp', 'ترجمة بالإنجليزي والعربي والنطق على الفيديو', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><span class="lg-n">١</span><h3>اتفرج على يوتيوب بالترجمة</h3><p>افتح أي فيديو فيه ترجمة إنجليزي. هتلاقي ٣ سطور فوق الفيديو: <b>الإنجليزي</b>، <b>العربي</b>، و<b>طريقة النطق</b>. تحت الفيديو لوحة Language Lens فيها كل الأدوات.</p></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-card.webp', 'كارت الكلمة: النطق والمستوى وأزرار I know it وLearning وCurious', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><span class="lg-n">٢</span><h3>اضغط على كلمة واحفظها</h3><p>على الكمبيوتر حط الماوس على الكلمة. على الموبايل اضغط عليها. هيفتح كارت فيه المعنى والنطق والمستوى من A1 لحد C2 وتختار:</p><ul><li><b>✓ I know it</b>: عارفها.</li><li><b>Learning</b>: عايز تحفظها (الكلمات المهمة بس).</li><li><b>💡 Curious</b>: عايز تفهمها بس وبتاخد XP.</li></ul><p>كل كلمة تحفظها بتظهر في <b>Review</b> في <a href="<?php echo esc_url( $app ); ?>">تطبيق سوا</a> كارت مراجعة.</p></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><div class="phone"><?php echo $img( 'yt-transcript.webp', 'الـ Transcript تحت الفيديو وكل جملة جنبها أزرار التكرار والنجمة', 786, 1480 ); // phpcs:ignore ?></div></div>
				<div class="lg-txt"><span class="lg-n">٣</span><h3>Transcript، تكرار، وحفظ جمل</h3><p>تحت الفيديو كل الكلام مكتوب. دوس على أي جملة تتشغّل. وجنب كل جملة:</p><ul><li><b>🔁 Repeat</b>: تتكرر وقولها ورا المتكلم.</li><li><b>☆ النجمة</b>: تحفظ الجملة في كروت المراجعة.</li><li>زرار الموجة: إزاي بتتنطق في الكلام السريع.</li></ul><p>على الكمبيوتر كمان: <b>A / S / D</b> للجملة اللي قبلها / تكرار / اللي بعدها.</p></div>
			</article>
			<article class="lg-use">
				<div class="lg-vis"><?php echo $img( 'web-4-save.webp', 'تحديد جملة على موقع عادي وحفظها', 1000, 625 ); // phpcs:ignore ?></div>
				<div class="lg-txt"><span class="lg-n">٤</span><h3>أي موقع، مش يوتيوب بس</h3><p>على الكمبيوتر، افتح أي مقال إنجليزي. حط الماوس على الكلمة لمعناها، أو <b>حدد جملة</b> عشان تترجمها وتسمعها وتحفظها.</p></div>
			</article>
			<article class="lg-use lg-use-text">
				<div class="lg-txt"><span class="lg-n">٥</span><h3>لعبة الأغاني 🎮</h3><p>افتح أغنية على يوتيوب ليها كلمات متزامنة، وفي لوحة Language Lens اضغط <b>🎤 Music ثم 🎮 Lyrics game</b>. بتسمع الأغنية وتكمّل الكلمات الناقصة. ممكن تشغّل <b>🌐 Show the translation</b> أو <b>⏸ Pause after every line</b> عشان تمشي براحتك.</p></div>
			</article>
			<article class="lg-use lg-use-text">
				<div class="lg-txt"><span class="lg-n">٦</span><h3>زرار التشغيل والإيقاف</h3><p>على يوتيوب فيه زرار Language Lens في شريط الفيديو جنب <b>Aa</b>. لو طفّيته، ترجمة يوتيوب الأصلية ترجع واللوحة تختفي. من <b>Aa</b> تتحكم كمان في كل سطر لوحده (إنجليزي / عربي / النطق).</p></div>
			</article>
		</div>
		<div class="cta-row center"><a class="btn btn-ink btn-lg" href="<?php echo esc_url( $app ); ?>">افتح تطبيق سوا (كروت المراجعة)</a></div>
	</div>
</section>

<!-- FAQ -->
<section class="sec light" id="faq">
	<div class="wrap narrow">
		<p class="eyebrow">لو حاجة مش شغالة</p>
		<h2>أسئلة وحلول</h2>
		<div class="faq">
			<details><summary>مش لاقي زرار Load unpacked</summary><p>يبقى Developer mode مش شغّال. شغّله من فوق على اليمين (أو من القايمة اللي على الشمال في Edge) وهيظهر.</p></details>
			<details><summary>بيقول "Manifest file is missing or unreadable"</summary><p>اخترت الفولدر الغلط. لازم تختار الفولدر اللي جواه ملف <b dir="ltr">manifest.json</b> مباشرة، مش الفولدر اللي فوقه. اتأكد كمان إنك عملت Extract للملف (مش فتحته من جوه الـ zip).</p></details>
			<details><summary>Chrome بيظهر رسالة "Disable developer mode extensions"</summary><p>دي رسالة عادية لأي إضافة بتتثبت يدويًا. اضغط إغلاق (أو Cancel) ومتعطّلش الإضافة. هتختفي لما ننزل على المتجر.</p></details>
			<details><summary>الإضافة مش بتظهر على يوتيوب</summary><p>١) اتأكد إنها شغّالة في <b dir="ltr">chrome://extensions</b>. ٢) اعمل Refresh للصفحة. ٣) الفيديو لازم يكون عليه ترجمة (CC) إنجليزي. ٤) لو الزرار اللي في شريط الفيديو مطفي، شغّله.</p></details>
			<details><summary>بيطلب مني Sign in كل شوية / طلعت مسجل خروج</summary><p>اضغط أيقونة Language Lens ثم Sign in with Sawa English وادخل تاني. لو لسه مش بيدخل، يبقى حسابك مش متفعّل: ابعتلي على Skool.</p></details>
			<details><summary>الإضافة اختفت بعد ما مسحت الفولدر</summary><p>Chrome بيشغّل الإضافة من الفولدر نفسه. لو مسحته أو نقلته، احذف الإضافة وثبّتها تاني من فولدر جديد.</p></details>
			<details><summary>على الموبايل</summary><p>استخدم <b dir="ltr">m.youtube.com</b> في Lemur أو Kiwi (شوف قسم أندرويد فوق). تطبيق يوتيوب مش بيقبل إضافات.</p></details>
			<details><summary>أي مشكلة تانية</summary><p>اكتب لي في سوا انجليش على Skool: كنت فين، عملت إيه، وحصل إيه، وياريت سكرين شوت.</p></details>
		</div>
	</div>
</section>

<!-- Close -->
<section class="sec dark close">
	<div class="wrap narrow center-text">
		<h2 class="xl">جاهز <span class="red">تبدأ؟</span></h2>
		<div class="cta-row center"><?php echo $dl_chrome; // phpcs:ignore ?><?php echo $dl_ff; // phpcs:ignore ?></div>
		<p class="fine lg-fine"><a href="<?php echo esc_url( $app ); ?>">افتح تطبيق سوا</a> · <a href="https://www.youtube.com/@sherif.abdelbaset">قناة يوتيوب</a></p>
	</div>
</section>

</main>
<?php echo Sawa_Site::footer(); // phpcs:ignore ?>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/site.js?v=' . SAWA_SITE_VER ); ?>"></script>
<script src="<?php echo esc_url( SAWA_SITE_URL . 'assets/lens.js?v=' . SAWA_SITE_VER ); ?>"></script>
</body>
</html>
