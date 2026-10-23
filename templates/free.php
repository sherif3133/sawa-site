<?php
/**
 * Free content hub. Hero (light) → "start here" card → filters + grid → bridge to Sawa (dark).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$items    = Sawa_Site_Resources::items();
$featured = array_values( array_filter( $items, function ( $i ) { return $i['featured']; } ) );
$rest     = array_values( array_filter( $items, function ( $i ) { return ! $i['featured']; } ) );
$start    = $featured ? array_shift( $featured ) : null;
$rest     = array_merge( $featured, $rest );
$types    = array_unique( wp_list_pluck( $rest, 'type' ) );

$icon = array(
	'course'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h11M4 10h11M4 15h7M17 13l4 3-4 3z"/></svg>',
	'video'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5l11 7-11 7z"/></svg>',
	'reading'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 6c-2-1.5-5-2-8-1.5V18c3-.5 6 0 8 1.5 2-1.5 5-2 8-1.5V4.5c-3-.5-6 0-8 1.5zM12 6v13.5"/></svg>',
	'download' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4v11M7 10l5 5 5-5M5 20h14"/></svg>',
	'tool'     => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6h11M9 12h11M9 18h11M4 6l1 1 2-2M4 12l1 1 2-2M4 18l1 1 2-2"/></svg>',
);
$card = function ( $it, $big = false ) use ( $icon ) {
	$tl = $it['channel'] ? sawa_t( 'YouTube channel', 'قناة يوتيوب' ) : Sawa_Site_Resources::label( 'TYPES', $it['type'] );
	$ll = Sawa_Site_Resources::label( 'LEVELS', $it['level'] );
	$h  = '<article class="res' . ( $big ? ' res-big' : '' ) . '" data-type="' . esc_attr( $it['type'] ) . '" data-level="' . esc_attr( $it['level'] ) . '">';
	$h .= '<a class="res-link" href="' . esc_url( $it['url'] ) . '" target="_blank" rel="noopener">';
	if ( $it['channel'] ) {
		$h .= '<span class="res-thumb res-channel">'
			. ( $it['thumb'] ? '<img src="' . esc_url( $it['thumb'] ) . '" alt="" loading="lazy" referrerpolicy="no-referrer">' : '' )
			. '<span class="ch-handle" dir="ltr">' . esc_html( $it['channel'] ) . '</span>'
			. '<span class="ch-sub"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5l11 7-11 7z"/></svg>' . sawa_t( 'Subscribe', 'اشترك في القناة' ) . '</span></span>';
	} else {
		$h .= $it['thumb']
		? '<span class="res-thumb"><img src="' . esc_url( $it['thumb'] ) . '" alt="" loading="lazy"></span>'
		: '<span class="res-thumb res-thumb-ph">' . ( $icon[ $it['type'] ] ?? '' ) . '</span>';
	}
	$h .= '<span class="res-body"><span class="res-meta"><span class="res-type">' . ( $icon[ $it['type'] ] ?? '' ) . $tl . '</span>'
		. ( 'all' !== $it['level'] ? '<span class="res-level">' . $ll . '</span>' : '' )
		. ( $it['length'] ? '<span>' . esc_html( $it['length'] ) . '</span>' : '' ) . '</span>';
	$h .= '<span class="res-title" dir="auto">' . esc_html( $it['title'] ) . '</span>';
	$h .= $it['text'] ? '<span class="res-text" dir="auto">' . esc_html( $it['text'] ) . '</span>' : '';
	$h .= '</span></a></article>';
	return $h;
};
?>
<section class="hero light free-hero">
	<div class="wrap">
		<p class="meta"><?php echo sawa_t( 'Free · from YouTube and from Sawa English', 'ببلاش · من يوتيوب ومن سوا انجليش' ); // phpcs:ignore ?></p>
		<h1><?php echo sawa_t( 'Free content', 'المحتوى المجاني' ); // phpcs:ignore ?></h1>
		<p class="serif red">start here.</p>
		<p class="lead"><?php echo sawa_t( 'Courses, videos, reading and tools, without searching through a hundred places. Start with the first card, then choose by your level.', 'كورسات وفيديوهات وقراءة وأدوات، من غير ما تدور في مية مصدر. ابدأ بالكارت الأول، وبعدين اختار حسب مستواك.' ); // phpcs:ignore ?></p>
	</div>
</section>

<section class="sec white hub">
	<div class="wrap">
		<?php if ( $start ) : ?>
			<div class="start-here"><?php echo $card( $start, true ); // phpcs:ignore ?></div>
		<?php endif; ?>

		<?php if ( $rest ) : ?>
			<div class="filters" role="group" aria-label="Filter the content">
				<div class="chips" data-filter="type">
					<button type="button" aria-pressed="true" data-v=""><?php echo sawa_t( 'All', 'الكل' ); // phpcs:ignore ?></button>
					<?php foreach ( $types as $t ) : ?>
						<button type="button" aria-pressed="false" data-v="<?php echo esc_attr( $t ); ?>"><?php echo Sawa_Site_Resources::label( 'TYPES', $t ); // phpcs:ignore ?></button>
					<?php endforeach; ?>
				</div>
				<div class="chips" data-filter="level">
					<button type="button" aria-pressed="true" data-v=""><?php echo sawa_t( 'Any level', 'أي مستوى' ); // phpcs:ignore ?></button>
					<button type="button" aria-pressed="false" data-v="a2">A2</button>
					<button type="button" aria-pressed="false" data-v="b1">B1</button>
				</div>
			</div>
			<div class="res-grid" id="res-grid">
				<?php foreach ( $rest as $it ) { echo $card( $it ); } // phpcs:ignore ?>
			</div>
			<p class="empty" id="res-empty" hidden><?php echo sawa_t( 'Nothing here with this filter yet. Try "All".', 'مفيش حاجة هنا بالفلتر ده لسه. جرب "الكل".' ); // phpcs:ignore ?></p>
		<?php elseif ( ! $start ) : ?>
			<p class="empty"><?php echo Sawa_Lang::th( 'The content is on its way. Until then, all the videos are on <a href="' . esc_url( Sawa_Site::s( 'youtube_url' ) ) . '">YouTube</a>.', 'المحتوى بيتجهز. لحد ما يخلص، كل الفيديوهات على <a href="' . esc_url( Sawa_Site::s( 'youtube_url' ) ) . '">يوتيوب</a>.' ); // phpcs:ignore ?></p>
		<?php endif; ?>

		<p class="yt-line"><a class="btn btn-ink" href="<?php echo esc_url( Sawa_Site::s( 'youtube_url' ) ); ?>" target="_blank" rel="noopener"><?php echo sawa_t( 'All the videos on YouTube', 'كل الفيديوهات على يوتيوب' ); // phpcs:ignore ?></a></p>
	</div>
</section>

<section class="sec dark bridge">
	<div class="wrap narrow center-text">
		<h2><?php echo Sawa_Lang::th( 'Free content teaches you.<br>Sawa English helps you <span class="red">keep going</span>.', 'المحتوى المجاني بيعلمك.<br>سوا انجليش بيخليك <span class="red">تكمّل</span>.' ); // phpcs:ignore ?></h2>
		<p class="lead"><?php echo sawa_t( 'Resources aren't the problem. A plan, people and someone following up are what's missing.', 'المصادر مش المشكلة. الخطة والناس والمتابعة هما اللي ناقصين.' ); // phpcs:ignore ?></p>
		<div class="cta-row center">
			<?php
			$join = Sawa_Site::url( 'sawa-join' );
			echo $join ? '<a class="btn btn-light btn-lg" href="' . esc_url( $join ) . '">' . sawa_t( 'See what\'s inside Sawa English', 'اعرف إيه اللي جوه سوا انجليش' ) . '</a>' : Sawa_Site::join_button( null, 'btn btn-light btn-lg' ); // phpcs:ignore
			?>
		</div>
	</div>
</section>
