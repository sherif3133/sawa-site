<?php
/**
 * Page sections shared by several templates. Copy follows the Sawa Brain voice and the VSL.
 * Every section names its mode (light/dark) and has at most one red element.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sawa_red( $t ) {
	return '<span class="red">' . esc_html( $t ) . '</span>';
}

/** Light. The four pains, in the learners' own words. Red: none. */
function sawa_sec_pain() {
	$cards = array(
		array( 'تبدأ… وتقف', '"باخد باور اسبوع وبعدين اركن."' ),
		array( 'مصادر كتير', 'أبلكيشنز، كورسات، كتب… ودايمًا بتدور على المصدر السحري.' ),
		array( 'بتتجمد لما تتكلم', 'في الإنترفيو، في الميتنج، مع أجنبي.' ),
		array( 'لوحدك', 'محدش حواليك بيتعلم ولا فاهم إنت بتمر بإيه.' ),
	);
	$h = '<section class="sec light" id="pain"><div class="wrap">'
		. '<p class="eyebrow">لو بقالك سنين بتذاكر انجليزي</p><h2>أنا عارف إنت فين</h2><div class="grid-4">';
	foreach ( $cards as $c ) {
		$h .= '<article class="card"><h3>' . esc_html( $c[0] ) . '</h3><p>' . esc_html( $c[1] ) . '</p></article>';
	}
	return $h . '</div></div></section>';
}

/** Dark. The turn. Red: one word. */
function sawa_sec_turn() {
	return '<section class="sec dark turn"><div class="wrap narrow">'
		. '<h2 class="xl">مش ' . sawa_red( 'غلطتك' ) . '.</h2>'
		. '<p class="lead">محدش وراك إزاي اللغات بتتكتسب فعلًا… ومحدش اتعامل مع اللي بيحصل في دماغك.</p>'
		. '</div></section>';
}

/** Light. The three-part method. Red: the serif line. */
function sawa_sec_method() {
	$steps = array(
		array( '١', 'العقل الأول', 'الكمالية والكسوف والقلق هما اللي بيخلوك تقف، مش الجرامر. إنت مش كسلان… إنت بتهرب من إحساس الفشل.' ),
		array( '٢', '٣٠–٤٠ دقيقة مذاكرة', 'كلمات بـ Anki + تعرّض نشط. والباقي محتوى بتحبه وفاهم معظمه.' ),
		array( '٣', 'حب اللغة', 'ميمز، مزيكا، مسلسلات، ثقافة. اللغة اللي مش بتحبها مش هتتكلمها.' ),
	);
	$h = '<section class="sec light" id="method"><div class="wrap">'
		. '<h2>إزاي بتتعلم لغة فعلًا</h2><p class="serif red">mindset first.</p><ol class="steps">';
	foreach ( $steps as $s ) {
		$h .= '<li><span class="num">' . esc_html( $s[0] ) . '</span><h3>' . esc_html( $s[1] ) . '</h3><p>' . esc_html( $s[2] ) . '</p></li>';
	}
	return $h . '</ol><p class="truth">لا ٣٠ يوم ولا ٧ أيام. ده بياخد شهور… وهقولك الحقيقة.</p></div></section>';
}

/** Light (soft). What's inside Sawa. Red: none (the "me" card is ink). */
function sawa_sec_inside( $tracker_link = true ) {
	$tracker = Sawa_Site::tracker_url();
	$cards   = array(
		array( 'المجتمع', 'مكالمات مذاكرة مع بعض، وجروبات الأعضاء بيعملوها بنفسهم.', '' ),
		array( 'الخطة', 'خطة يومية ١٥٠/٢٠٠ يوم حسب مستواك. عمرك ما هتسأل "أذاكر إيه النهارده؟"', '' ),
		array( 'الأدوات', 'Language Reactor، تطبيق متابعة تقدمك، وتطبيق للصحة النفسية (قريب).', $tracker_link && $tracker ? $tracker : '' ),
		array( 'أنا', 'برد على رسايلك خلال ٢٤–٤٨ ساعة، ومكالمتين كل أسبوع: اسألني أي حاجة، وقعدة مع المجتمع.', '' ),
	);
	$h = '<section class="sec soft" id="inside"><div class="wrap">'
		. '<p class="eyebrow">خطة · ناس · وأنا</p><h2>جوه سوا</h2><div class="grid-2">';
	foreach ( $cards as $i => $c ) {
		$h .= '<article class="card' . ( 3 === $i ? ' card-ink' : '' ) . '"><h3>' . esc_html( $c[0] ) . '</h3><p>' . esc_html( $c[1] ) . '</p>'
			. ( $c[2] ? '<a class="text-link" href="' . esc_url( $c[2] ) . '">شوف تطبيق المتابعة ←</a>' : '' ) . '</article>';
	}
	return $h . '</div><p class="note">سوا لسه جديد وبيتحسن بسرعة. كل تحديث جديد بيوصلك… وإنت بتشارك في بناءه.</p></div></section>';
}

/** White. What happens after you join. Red: none. */
function sawa_sec_steps() {
	$steps = array(
		array( 'الخطوة ١', 'ناس وصحاب', 'خطة قصيرة تستخدم بيها المجتمع وتتعرف على ناس بتذاكر زيك.' ),
		array( 'الخطوة ٢', 'نحدد مستواك', 'A2 أو B1؟ إنت في المكان الصح. غير كده؟ هقولك بصراحة إن سوا مش ليك دلوقتي.' ),
		array( 'الخطوة ٣', 'الخطة اليومية', 'خطة ١٥٠/٢٠٠ يوم. كل يوم عارف هتعمل إيه بالظبط.' ),
	);
	$h = '<section class="sec white" id="steps"><div class="wrap"><h2>أول ما تدخل سوا</h2><ol class="join-steps">';
	foreach ( $steps as $s ) {
		$h .= '<li><span class="meta">' . esc_html( $s[0] ) . '</span><h3>' . esc_html( $s[1] ) . '</h3><p>' . esc_html( $s[2] ) . '</p></li>';
	}
	return $h . '</ol></div></section>';
}

/** Ink band of numbers. Red: none. */
function sawa_sec_stats() {
	$s     = Sawa_Site::s();
	$stats = array(
		array( $s['stat_subs'], 'مشترك على يوتيوب' ),
		array( $s['stat_views'], 'شافوا الكورس المجاني (٦ ساعات)' ),
		array( $s['stat_rating'], 'من ' . Sawa_Site::review_count() . ' تقييم' ),
		array( $s['stat_rank'], 'على Skool عالميًا، بعد ٣–٤ شهور' ),
	);
	$h = '<section class="stats-band" aria-label="أرقام"><div class="wrap"><dl class="stats">';
	foreach ( $stats as $st ) {
		if ( '' === trim( (string) $st[0] ) ) {
			continue;
		}
		$h .= '<div><dt>' . esc_html( $st[0] ) . '</dt><dd>' . esc_html( $st[1] ) . '</dd></div>';
	}
	return $h . '</dl></div></section>';
}

/** Soft. Real testimonials from the testimonials plugin. Red: none here (the wall has its own). */
function sawa_sec_proof( $limit = 9 ) {
	if ( ! shortcode_exists( 'sawa_testimonials' ) ) {
		return '';
	}
	return '<section class="sec soft proof" id="proof"><div class="wrap">'
		. '<p class="eyebrow">من الطلبة نفسهم</p><h2>مش كلام</h2>'
		. do_shortcode( '[sawa_testimonials limit="' . (int) $limit . '" heading="no"]' )
		. '</div></section>';
}

/** Dark. Story teaser. Red: one word. */
function sawa_sec_story() {
	$about = Sawa_Site::url( 'sawa-about' );
	return '<section class="sec dark story"><div class="wrap narrow">'
		. '<p class="meta">عندي ١٥ سنة · صاحبي الألماني · سكايب</p>'
		. '<h2 class="xl">"المايك ' . sawa_red( 'بايظ' ) . '"</h2>'
		. '<p class="lead">كدبت عشان كنت خايف أتكلم. بعد ساعة… اكتشفت إني بعرف.</p>'
		. ( $about ? '<a class="btn btn-ghost-light" href="' . esc_url( $about ) . '">اقرا قصتي كاملة</a>' : '' )
		. '</div></section>';
}

/** Light. Who it's not for. Red: one phrase. */
function sawa_sec_notfor() {
	$items = array(
		'عايز تتكلم انجليزي في ٣٠ يوم.',
		'عايز ليستة كلمات و"كلمة اليوم".',
		'عايز كل حاجة ببلاش وللأبد.',
		'مستواك مش A2 أو B1.',
	);
	$h = '<section class="sec light" id="not-for"><div class="wrap narrow"><h2>سوا ' . sawa_red( 'مش ليك' ) . ' لو:</h2><ul class="lines">';
	foreach ( $items as $i ) {
		$h .= '<li>' . esc_html( $i ) . '</li>';
	}
	return $h . '</ul></div></section>';
}

/** White. Objections, answered straight. Red: none. */
function sawa_sec_faq() {
	$q = array(
		array( 'أقدر أذاكر لوحدي ببلاش؟', 'جربت. المصادر مش المشكلة. الخطة والناس والمتابعة هما اللي ناقصين.' ),
		array( 'معنديش وقت.', '٣٠–٤٠ دقيقة في اليوم. الباقي جوه اللي بتتفرج عليه أصلًا.' ),
		array( 'مش متأكد من مستوايا.', 'هنحدد مستواك أول ما تدخل. ولو سوا مش مناسب ليك، الـ ٧ أيام بتحميك.' ),
		array( 'غالي.', 'قارنه بشهر كلاسات، أو بعرض شغل واحد بالانجليزي.' ),
		array( 'كله كلام تحفيزي؟', 'لا. فيه خطة وأدوات وشغل يومي. العقلية هي اللي بتخليك تعمله.' ),
		array( 'ده كورس ولا كلاسات؟', 'لا ده ولا ده. سوا مش دروس خصوصية ولا كلاسات. الكلاسات بتديك كام ساعة في الأسبوع، وسوا بيخليك تذاكر ٣٠–٤٠ ساعة في الشهر، مع ناس ومعايا.' ),
		array( 'لو مش عاجبني؟', 'ابعتلي رسالة أو املا الفورم في أول ٧ أيام، وفلوسك ترجعلك خلال ٢٤–٤٨ ساعة.' ),
	);
	$h = '<section class="sec white" id="faq"><div class="wrap narrow"><h2>أسئلتك… بصراحة</h2><div class="faq">';
	foreach ( $q as $i => $qa ) {
		$h .= '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . esc_html( $qa[0] ) . '</summary><p>' . esc_html( $qa[1] ) . '</p></details>';
	}
	return $h . '</div></div></section>';
}

/** Dark. The close: price, guarantee, one button. Red: the button. */
function sawa_sec_close( $title = 'عمرك ما هتحس إنك جاهز. أنا استنيت ٤ سنين.' ) {
	$s = Sawa_Site::s();
	return '<section class="sec dark close" id="join"><div class="wrap narrow">'
		. '<h2 class="xl">' . esc_html( $title ) . '</h2>'
		. '<div class="price-card"><p class="price"><b>' . esc_html( $s['price'] ) . '</b> <span>' . esc_html( $s['price_period'] ) . '</span></p>'
		. '<ul><li>' . esc_html( $s['price_note'] ) . '</li><li>' . esc_html( $s['guarantee'] ) . '</li></ul>'
		. Sawa_Site::join_button( 'ادخل سوا وابدأ النهارده', 'btn btn-red btn-lg' )
		. '<p class="after">أول خطوة بعد ما تدخل: عرّف نفسك ولاقي الناس اللي هتذاكر معاهم.</p></div>'
		. '</div></section>';
}
