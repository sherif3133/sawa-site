<?php
/**
 * Privacy policy (sawaenglish.com/privacy/). Google's sign-in consent screen links here.
 * Facts only: what the Sawa plugins and Language Lens really store and send. Update the date when this changes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$sawa_sections = array(
	array(
		'Who we are',
		'احنا مين',
		'Sawa English is an English school for Arabic speakers, run by Sherif Abdelbaset. This page covers sawaenglish.com, the Sawa App (/app), Language Lens (the browser extension) and the Silk Road game.',
		'سوا انجليش مدرسة انجليزي للي بيتكلموا عربي، بيديرها شريف عبد الباسط. الصفحة دي بتغطي sawaenglish.com، وتطبيق سوا (/app)، و Language Lens (إضافة المتصفح)، ولعبة طريق الحرير.',
	),
	array(
		'What we keep',
		'إيه اللي بنحفظه',
		'Your account: your name and email address (from the sign-up form, or from Google if you sign in with Google). Your learning: the words and sentences you save (with the page or video they came from), your review cards and answers, your level and test results, writing you send to be checked, chat messages, study time, and a small "used today" mark for the app, Language Lens and the game.',
		'حسابك: اسمك وإيميلك (من فورم التسجيل، أو من جوجل لو دخلت بجوجل). تعلمك: الكلمات والجمل اللي بتحفظها (مع الصفحة أو الفيديو اللي جت منه)، كروت المراجعة وإجاباتك، مستواك ونتايج الاختبارات، الكتابة اللي بتبعتها للتصحيح، رسايل الشات، وقت المذاكرة، وعلامة صغيرة "استخدم النهارده" للتطبيق و Language Lens واللعبة.',
	),
	array(
		'Language Lens',
		'Language Lens',
		'Language Lens reads the page or YouTube captions on your own device to show meanings. It sends our server only the words and sentences you look up or save, and the text you ask it to explain or check. It does not send your browsing history.',
		'Language Lens بتقرا الصفحة أو ترجمة يوتيوب على جهازك انت عشان تطلعلك المعاني. مش بتبعت لسيرفرنا غير الكلمات والجمل اللي بتدور عليها أو بتحفظها، والنص اللي بتطلب شرحه أو تصحيحه. مش بتبعت تاريخ التصفح بتاعك.',
	),
	array(
		'AI helpers',
		'مساعدين الذكاء الاصطناعي',
		'To explain a word, translate a sentence or check your writing, we send that text (not your name or email) to an AI provider: Anthropic (Claude), OpenAI or Google (Gemini). They use it to give the answer.',
		'عشان نشرح كلمة أو نترجم جملة أو نصحح كتابتك، بنبعت النص ده بس (من غير اسمك أو إيميلك) لشركة ذكاء اصطناعي: Anthropic (Claude) أو OpenAI أو Google (Gemini). بيستخدموه عشان يطلعوا الإجابة.',
	),
	array(
		'Sign in with Google',
		'الدخول بجوجل',
		'If you sign in with Google, we receive only your name, email address and profile ID, and use them only to make and open your Sawa English account. Sawa English\'s use of information received from Google APIs adheres to the Google API Services User Data Policy, including the Limited Use requirements.',
		'لو دخلت بجوجل، بيوصلنا اسمك وإيميلك ورقم حسابك عند جوجل بس، وبنستخدمهم بس عشان نعمل حسابك في سوا انجليش ونفتحه. استخدام سوا انجليش للمعلومات اللي جاية من Google APIs ملتزم بسياسة Google API Services User Data Policy، ومنها شروط Limited Use.',
	),
	array(
		'Who can see it',
		'مين يقدر يشوفها',
		'Sherif and the Sawa English team, to teach you and to see what helps. Other students see only what you share in the community: your name, your posts and chat messages, and your place on the leaderboard. We never sell your data and we don\'t show ads.',
		'شريف وفريق سوا انجليش، عشان يعلموك ويعرفوا إيه اللي بيفيد. الطلبة التانيين بيشوفوا بس اللي بتشاركه في المجتمع: اسمك، بوستاتك ورسايلك، ومكانك في الترتيب. عمرنا ما بنبيع بياناتك ومفيش إعلانات.',
	),
	array(
		'Cookies',
		'الكوكيز',
		'We use cookies to keep you signed in and to remember your language. No advertising cookies.',
		'بنستخدم كوكيز عشان تفضل داخل حسابك وعشان نفتكر لغتك. مفيش كوكيز إعلانات.',
	),
	array(
		'Your choices',
		'اختياراتك',
		'You can ask to see, correct or delete your data at any time. When you delete your account, we delete your learning data with it. To ask, use the Feedback button in the app, or message Sherif in the Sawa English community on Skool.',
		'تقدر تطلب تشوف بياناتك أو تعدلها أو تمسحها في أي وقت. لما تمسح حسابك، بنمسح بيانات تعلمك معاه. عشان تطلب، استخدم زرار Feedback في التطبيق، أو ابعت لشريف في مجتمع سوا انجليش على Skool.',
	),
);
?>
<header class="hero light">
	<div class="wrap narrow">
		<p class="meta"><?php echo sawa_t( 'Last updated: 23 October 2026', 'آخر تحديث: ٢٣ أكتوبر ٢٠٢٦' ); // phpcs:ignore ?></p>
		<h1><?php echo sawa_t( 'Privacy', 'الخصوصية' ); // phpcs:ignore ?></h1>
		<p class="lead"><?php echo sawa_t( 'What we keep about you, why, and how to have it deleted. In plain words.', 'إيه اللي بنحفظه عنك، وليه، وإزاي تمسحه. بكلام بسيط.' ); // phpcs:ignore ?></p>
	</div>
</header>
<div class="wrap narrow prose">
	<?php foreach ( $sawa_sections as $sawa_s ) : ?>
		<h2><?php echo sawa_t( $sawa_s[0], $sawa_s[1] ); // phpcs:ignore ?></h2>
		<p><?php echo sawa_t( $sawa_s[2], $sawa_s[3] ); // phpcs:ignore ?></p>
	<?php endforeach; ?>
</div>
