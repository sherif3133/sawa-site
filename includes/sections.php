<?php
/**
 * Page sections shared by several templates. Copy follows the Sawa Brain voice and the VSL.
 * Every section names its mode (light/dark) and has at most one red element.
 * Every text is a pair: English first (the default), then the Arabic that was here before (see Sawa_Lang).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Both languages, escaped. */
function sawa_t( $en, $ar ) {
	return Sawa_Lang::t( $en, $ar );
}

function sawa_red( $en, $ar = null ) {
	return '<span class="red">' . ( null === $ar ? esc_html( $en ) : sawa_t( $en, $ar ) ) . '</span>';
}

/** Light. The four pains, in the learners' own words. Red: none. */
function sawa_sec_pain() {
	$cards = array(
		array( 'You start… then stop', '"I get motivated for a week, then I give up."', 'تبدأ… وتقف', '"باخد باور اسبوع وبعدين اركن."' ),
		array( 'Too many resources', 'Apps, courses, books… and you\'re always looking for the magic one.', 'مصادر كتير', 'أبلكيشنز، كورسات، كتب… ودايمًا بتدور على المصدر السحري.' ),
		array( 'You freeze when you speak', 'In the interview, in the meeting, with a foreigner.', 'بتتجمد لما تتكلم', 'في الإنترفيو، في الميتنج، مع أجنبي.' ),
		array( 'On your own', 'Nobody around you is learning, or understands what you\'re going through.', 'لوحدك', 'محدش حواليك بيتعلم ولا فاهم إنت بتمر بإيه.' ),
	);
	$h = '<section class="sec light" id="pain"><div class="wrap">'
		. '<p class="eyebrow">' . sawa_t( 'If you\'ve been studying English for years', 'لو بقالك سنين بتذاكر انجليزي' ) . '</p><h2>' . sawa_t( 'I know where you are', 'أنا عارف إنت فين' ) . '</h2><div class="grid-4">';
	foreach ( $cards as $c ) {
		$h .= '<article class="card"><h3>' . sawa_t( $c[0], $c[2] ) . '</h3><p>' . sawa_t( $c[1], $c[3] ) . '</p></article>';
	}
	return $h . '</div></div></section>';
}

/** Dark. The turn. Red: one word. */
function sawa_sec_turn() {
	return '<section class="sec dark turn"><div class="wrap narrow">'
		. '<h2 class="xl">' . Sawa_Lang::th( 'It\'s not ' . sawa_red( 'your fault' ) . '.', 'مش ' . sawa_red( 'غلطتك' ) . '.' ) . '</h2>'
		. '<p class="lead">' . sawa_t( 'Nobody showed you how languages are really learned… and nobody dealt with what goes on in your head.', 'محدش وراك إزاي اللغات بتتكتسب فعلًا… ومحدش اتعامل مع اللي بيحصل في دماغك.' ) . '</p>'
		. '</div></section>';
}

/** Light. The three-part method. Red: the serif line. */
function sawa_sec_method() {
	$steps = array(
		array( '1', '١', 'Mindset first', 'العقل الأول', 'Perfectionism, shyness and worry make you stop, not grammar. You\'re not lazy… you\'re running away from the feeling of failing.', 'الكمالية والكسوف والقلق هما اللي بيخلوك تقف، مش الجرامر. إنت مش كسلان… إنت بتهرب من إحساس الفشل.' ),
		array( '2', '٢', '30–40 minutes of study', '٣٠–٤٠ دقيقة مذاكرة', 'Words with Anki + active listening and reading. The rest is content you love and mostly understand.', 'كلمات بـ Anki + تعرّض نشط. والباقي محتوى بتحبه وفاهم معظمه.' ),
		array( '3', '٣', 'Love the language', 'حب اللغة', 'Memes, music, series, culture. You won\'t speak a language you don\'t love.', 'ميمز، مزيكا، مسلسلات، ثقافة. اللغة اللي مش بتحبها مش هتتكلمها.' ),
	);
	$h = '<section class="sec light" id="method"><div class="wrap">'
		. '<h2>' . sawa_t( 'How you really learn a language', 'إزاي بتتعلم لغة فعلًا' ) . '</h2><p class="serif red">mindset first.</p><ol class="steps">';
	foreach ( $steps as $s ) {
		$h .= '<li><span class="num">' . sawa_t( $s[0], $s[1] ) . '</span><h3>' . sawa_t( $s[2], $s[3] ) . '</h3><p>' . sawa_t( $s[4], $s[5] ) . '</p></li>';
	}
	return $h . '</ol><p class="truth">' . sawa_t( 'Not 30 days, not 7 days. It takes months… and I\'ll tell you the truth.', 'لا ٣٠ يوم ولا ٧ أيام. ده بياخد شهور… وهقولك الحقيقة.' ) . '</p></div></section>';
}

/** Light (soft). What's inside Sawa. Red: none (the "me" card is ink). */
function sawa_sec_inside( $tracker_link = true ) {
	$tracker = Sawa_Site::tracker_url();
	$cards   = array(
		array( 'The community', 'Study calls together, and groups that members start themselves.', 'المجتمع', 'مكالمات مذاكرة مع بعض، وجروبات الأعضاء بيعملوها بنفسهم.', '' ),
		array( 'The plan', 'A 150/200-day daily plan for your level. You\'ll never ask "What do I study today?" again.', 'الخطة', 'خطة يومية ١٥٠/٢٠٠ يوم حسب مستواك. عمرك ما هتسأل "أذاكر إيه النهارده؟"', '' ),
		array( 'The tools', 'Language Reactor, an app that tracks your progress, and a mental health app (coming soon).', 'الأدوات', 'Language Reactor، تطبيق متابعة تقدمك، وتطبيق للصحة النفسية (قريب).', $tracker_link && $tracker ? $tracker : '' ),
		array( 'Me', 'I answer your messages within 24–48 hours, plus two calls every week: ask me anything, and a session with the community.', 'أنا', 'برد على رسايلك خلال ٢٤–٤٨ ساعة، ومكالمتين كل أسبوع: اسألني أي حاجة، وقعدة مع المجتمع.', '' ),
	);
	$h = '<section class="sec soft" id="inside"><div class="wrap">'
		. '<p class="eyebrow">' . sawa_t( 'A plan · people · and me', 'خطة · ناس · وأنا' ) . '</p><h2>' . sawa_t( 'Inside Sawa English', 'جوه سوا انجليش' ) . '</h2><div class="grid-2">';
	foreach ( $cards as $i => $c ) {
		$h .= '<article class="card' . ( 3 === $i ? ' card-ink' : '' ) . '"><h3>' . sawa_t( $c[0], $c[2] ) . '</h3><p>' . sawa_t( $c[1], $c[3] ) . '</p>'
			. ( $c[4] ? '<a class="text-link" href="' . esc_url( $c[4] ) . '">' . sawa_t( 'See the progress app →', 'شوف تطبيق المتابعة ←' ) . '</a>' : '' ) . '</article>';
	}
	return $h . '</div><p class="note">' . sawa_t( 'Sawa English is still new and getting better fast. Every update reaches you… and you help build it.', 'سوا انجليش لسه جديد وبيتحسن بسرعة. كل تحديث جديد بيوصلك… وإنت بتشارك في بناءه.' ) . '</p></div></section>';
}

/** White. What happens after you join. Red: none. */
function sawa_sec_steps() {
	$steps = array(
		array( 'Step 1', 'People and friends', 'A short plan to use the community and meet people who study like you.', 'الخطوة ١', 'ناس وصحاب', 'خطة قصيرة تستخدم بيها المجتمع وتتعرف على ناس بتذاكر زيك.' ),
		array( 'Step 2', 'We find your level', 'A2 or B1? You\'re in the right place. Something else? I\'ll tell you honestly that Sawa English isn\'t for you right now.', 'الخطوة ٢', 'نحدد مستواك', 'A2 أو B1؟ إنت في المكان الصح. غير كده؟ هقولك بصراحة إن سوا انجليش مش ليك دلوقتي.' ),
		array( 'Step 3', 'The daily plan', 'A 150/200-day plan. Every day you know exactly what to do.', 'الخطوة ٣', 'الخطة اليومية', 'خطة ١٥٠/٢٠٠ يوم. كل يوم عارف هتعمل إيه بالظبط.' ),
	);
	$h = '<section class="sec white" id="steps"><div class="wrap"><h2>' . sawa_t( 'When you join Sawa English', 'أول ما تدخل سوا انجليش' ) . '</h2><ol class="join-steps">';
	foreach ( $steps as $s ) {
		$h .= '<li><span class="meta">' . sawa_t( $s[0], $s[3] ) . '</span><h3>' . sawa_t( $s[1], $s[4] ) . '</h3><p>' . sawa_t( $s[2], $s[5] ) . '</p></li>';
	}
	return $h . '</ol></div></section>';
}

/** Ink band of numbers. Red: none. */
function sawa_sec_stats() {
	$s     = Sawa_Site::s();
	$n     = Sawa_Site::review_count();
	$stats = array(
		array( $s['stat_subs'], 'YouTube subscribers', 'مشترك على يوتيوب' ),
		array( $s['stat_views'], 'watched the free course (6 hours)', 'شافوا الكورس المجاني (٦ ساعات)' ),
		array( $s['stat_rating'], 'from ' . $n . ' reviews', 'من ' . $n . ' تقييم' ),
		array( $s['stat_rank'], 'on Skool worldwide, after 3–4 months', 'على Skool عالميًا، بعد ٣–٤ شهور' ),
	);
	$h = '<section class="stats-band" aria-label="Numbers"><div class="wrap"><dl class="stats">';
	foreach ( $stats as $st ) {
		if ( '' === trim( (string) $st[0] ) ) {
			continue;
		}
		$h .= '<div><dt>' . esc_html( $st[0] ) . '</dt><dd>' . sawa_t( $st[1], $st[2] ) . '</dd></div>';
	}
	return $h . '</dl></div></section>';
}

/** Soft. Real testimonials from the testimonials plugin. Red: none here (the wall has its own). */
function sawa_sec_proof( $limit = 9 ) {
	if ( ! shortcode_exists( 'sawa_testimonials' ) ) {
		return '';
	}
	return '<section class="sec soft proof" id="proof"><div class="wrap">'
		. '<p class="eyebrow">' . sawa_t( 'From the students themselves', 'من الطلبة نفسهم' ) . '</p><h2>' . sawa_t( 'Not just talk', 'مش كلام' ) . '</h2>'
		. do_shortcode( '[sawa_testimonials limit="' . (int) $limit . '" heading="no"]' )
		. '</div></section>';
}

/** Dark. Story teaser. Red: one word. */
function sawa_sec_story() {
	$about = Sawa_Site::url( 'sawa-about' );
	return '<section class="sec dark story"><div class="wrap narrow">'
		. '<p class="meta">' . sawa_t( 'Age 15 · my German friend · Skype', 'عندي ١٥ سنة · صاحبي الألماني · سكايب' ) . '</p>'
		. '<h2 class="xl">' . Sawa_Lang::th( '"My mic is ' . sawa_red( 'broken' ) . '"', '"المايك ' . sawa_red( 'بايظ' ) . '"' ) . '</h2>'
		. '<p class="lead">' . sawa_t( 'I lied because I was scared to speak. One hour later… I found out I could.', 'كدبت عشان كنت خايف أتكلم. بعد ساعة… اكتشفت إني بعرف.' ) . '</p>'
		. ( $about ? '<a class="btn btn-ghost-light" href="' . esc_url( $about ) . '">' . sawa_t( 'Read my full story', 'اقرا قصتي كاملة' ) . '</a>' : '' )
		. '</div></section>';
}

/** Light. Who it's not for. Red: one phrase. */
function sawa_sec_notfor() {
	$items = array(
		array( 'You want to speak English in 30 days.', 'عايز تتكلم انجليزي في ٣٠ يوم.' ),
		array( 'You want word lists and a "word of the day".', 'عايز ليستة كلمات و"كلمة اليوم".' ),
		array( 'You want everything free, forever.', 'عايز كل حاجة ببلاش وللأبد.' ),
		array( 'Your level isn\'t A2 or B1.', 'مستواك مش A2 أو B1.' ),
	);
	$h = '<section class="sec light" id="not-for"><div class="wrap narrow"><h2>' . Sawa_Lang::th( 'Sawa English is ' . sawa_red( 'not for you' ) . ' if:', 'سوا انجليش ' . sawa_red( 'مش ليك' ) . ' لو:' ) . '</h2><ul class="lines">';
	foreach ( $items as $i ) {
		$h .= '<li>' . sawa_t( $i[0], $i[1] ) . '</li>';
	}
	return $h . '</ul></div></section>';
}

/** White. Objections, answered straight. Red: none. */
function sawa_sec_faq() {
	$q = array(
		array( 'Can I study alone for free?', 'You tried. Resources aren\'t the problem. A plan, people and someone following up are what\'s missing.', 'أقدر أذاكر لوحدي ببلاش؟', 'جربت. المصادر مش المشكلة. الخطة والناس والمتابعة هما اللي ناقصين.' ),
		array( 'I don\'t have time.', '30–40 minutes a day. The rest happens inside what you already watch.', 'معنديش وقت.', '٣٠–٤٠ دقيقة في اليوم. الباقي جوه اللي بتتفرج عليه أصلًا.' ),
		array( 'I\'m not sure about my level.', 'We find your level as soon as you join. And if Sawa English isn\'t right for you, the 7 days protect you.', 'مش متأكد من مستوايا.', 'هنحدد مستواك أول ما تدخل. ولو سوا انجليش مش مناسب ليك، الـ ٧ أيام بتحميك.' ),
		array( 'It\'s expensive.', 'Compare it to one month of classes, or to one job offer in English.', 'غالي.', 'قارنه بشهر كلاسات، أو بعرض شغل واحد بالانجليزي.' ),
		array( 'Is it all motivation talk?', 'No. There\'s a plan, tools and daily work. The mindset is what makes you do it.', 'كله كلام تحفيزي؟', 'لا. فيه خطة وأدوات وشغل يومي. العقلية هي اللي بتخليك تعمله.' ),
		array( 'Is it a course or classes?', 'Neither. Sawa English isn\'t private lessons or classes. Classes give you a few hours a week; Sawa English gets you studying 30–40 hours a month, with people and with me.', 'ده كورس ولا كلاسات؟', 'لا ده ولا ده. سوا انجليش مش دروس خصوصية ولا كلاسات. الكلاسات بتديك كام ساعة في الأسبوع، وسوا انجليش بيخليك تذاكر ٣٠–٤٠ ساعة في الشهر، مع ناس ومعايا.' ),
		array( 'What if I don\'t like it?', 'Message me or fill in the form in your first 7 days, and you get your money back within 24–48 hours.', 'لو مش عاجبني؟', 'ابعتلي رسالة أو املا الفورم في أول ٧ أيام، وفلوسك ترجعلك خلال ٢٤–٤٨ ساعة.' ),
	);
	$h = '<section class="sec white" id="faq"><div class="wrap narrow"><h2>' . sawa_t( 'Your questions… answered honestly', 'أسئلتك… بصراحة' ) . '</h2><div class="faq">';
	foreach ( $q as $i => $qa ) {
		$h .= '<details' . ( 0 === $i ? ' open' : '' ) . '><summary>' . sawa_t( $qa[0], $qa[2] ) . '</summary><p>' . sawa_t( $qa[1], $qa[3] ) . '</p></details>';
	}
	return $h . '</div></div></section>';
}

/** Dark. The close: price, guarantee, one button. Red: the button. $title: array( English, Arabic ). */
function sawa_sec_close( $title = null ) {
	$title = $title ? $title : array( 'You\'ll never feel ready. I waited 4 years.', 'عمرك ما هتحس إنك جاهز. أنا استنيت ٤ سنين.' );
	$s     = Sawa_Site::s();
	return '<section class="sec dark close" id="join"><div class="wrap narrow">'
		. '<h2 class="xl">' . sawa_t( $title[0], $title[1] ) . '</h2>'
		. '<div class="price-card"><p class="price"><b>' . esc_html( $s['price'] ) . '</b> <span>' . Sawa_Site::st( 'price_period' ) . '</span></p>'
		. '<ul><li>' . Sawa_Site::st( 'price_note' ) . '</li><li>' . Sawa_Site::st( 'guarantee' ) . '</li></ul>'
		. Sawa_Site::join_button( array( 'Join Sawa English and start today', 'ادخل سوا انجليش وابدأ النهارده' ), 'btn btn-red btn-lg' )
		. '<p class="after">' . sawa_t( 'Your first step after you join: introduce yourself and find the people you\'ll study with.', 'أول خطوة بعد ما تدخل: عرّف نفسك ولاقي الناس اللي هتذاكر معاهم.' ) . '</p></div>'
		. '</div></section>';
}
