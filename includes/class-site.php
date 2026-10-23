<?php
/**
 * Page templates, settings, the shared header/footer and helpers.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site {

	const OPT = 'sawa_site_settings';

	const TEMPLATES = array(
		'sawa-home'  => 'Sawa: Home',
		'sawa-about' => 'Sawa: About Sherif',
		'sawa-join'  => 'Sawa: Join',
		'sawa-free'  => 'Sawa: Free content',
		'sawa-app'   => 'Sawa: App page (tracker, review form)',
	);

	public static function init() {
		add_filter( 'theme_page_templates', array( __CLASS__, 'register_templates' ) );
		add_filter( 'template_include', array( __CLASS__, 'template_include' ), 99 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'assets' ), 999 );
		add_filter( 'body_class', array( __CLASS__, 'body_class' ) );
	}

	/* ------------------------------------------------------------------ settings */

	public static function defaults() {
		return array(
			'join_url'      => 'https://www.skool.com/sawa-english-7655',
			'price'         => '$29',
			'price_period'  => 'في الشهر',
			'price_note'    => 'السعر اللي تدخل بيه ثابت للأبد، وهيزيد مع كل تحسين.',
			'guarantee'     => 'مش مناسب ليك؟ فلوسك ترجعلك خلال ٢٤–٤٨ ساعة، في أول ٧ أيام.',
			'youtube_url'   => 'https://www.youtube.com/@sherif.abdelbaset',
			'stat_subs'     => '+10K',
			'stat_views'    => '180K',
			'stat_rating'   => '5.0',
			'stat_reviews'  => '',
			'stat_rank'     => '#32',
			'photo_hero'    => '',
			'photo_about'   => '',
			'vsl_url'       => '',
		);
	}

	public static function s( $key = null ) {
		$s = wp_parse_args( (array) get_option( self::OPT, array() ), self::defaults() );
		return null === $key ? $s : ( $s[ $key ] ?? '' );
	}

	/** Number of approved testimonials, if the testimonials plugin is active. */
	public static function review_count() {
		if ( '' !== self::s( 'stat_reviews' ) ) {
			return self::s( 'stat_reviews' );
		}
		if ( post_type_exists( 'sawa_testimonial' ) ) {
			$n = (int) wp_count_posts( 'sawa_testimonial' )->publish;
			if ( $n ) {
				return (string) $n;
			}
		}
		return '102';
	}

	/* ------------------------------------------------------------------ templates */

	public static function register_templates( $t ) {
		return array_merge( $t, self::TEMPLATES );
	}

	public static function current_template() {
		if ( is_singular( 'post' ) ) {
			return 'sawa-post';
		}
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() || ( is_search() && ! is_admin() ) ) {
			return 'sawa-blog';
		}
		if ( ! is_singular( 'page' ) ) {
			return '';
		}
		$t = get_page_template_slug( get_queried_object_id() );
		return isset( self::TEMPLATES[ $t ] ) ? $t : '';
	}

	public static function template_include( $template ) {
		$t = self::current_template();
		if ( $t ) {
			return SAWA_SITE_DIR . 'templates/page.php';
		}
		return $template;
	}

	public static function body_class( $c ) {
		if ( self::current_template() ) {
			$c[] = 'sawa-page';
			$c[] = self::current_template();
		}
		return $c;
	}

	public static function assets() {
		$t = self::current_template();
		if ( ! $t ) {
			return;
		}
		// Our pages carry their own design: drop the theme's and page builders' front-end styles.
		global $wp_styles;
		$theme_roots = array( get_template_directory_uri(), get_stylesheet_directory_uri() );
		foreach ( (array) $wp_styles->queue as $handle ) {
			$src = isset( $wp_styles->registered[ $handle ] ) ? (string) $wp_styles->registered[ $handle ]->src : '';
			foreach ( $theme_roots as $root ) {
				if ( $src && 0 === strpos( $src, $root ) ) {
					wp_dequeue_style( $handle );
				}
			}
			if ( preg_match( '/^(elementor-|astra-|global-styles|wp-block-library-theme)/', $handle ) ) {
				wp_dequeue_style( $handle );
			}
		}
		wp_enqueue_style( 'sawa-fonts', 'https://fonts.googleapis.com/css2?family=Changa:wght@500;800&family=IBM+Plex+Sans+Arabic:wght@400;600&family=Instrument+Serif:ital@0;1&display=swap', array(), null );
		wp_enqueue_style( 'sawa-site', SAWA_SITE_URL . 'assets/site.css', array( 'sawa-fonts' ), SAWA_SITE_VER );
		wp_enqueue_script( 'sawa-site', SAWA_SITE_URL . 'assets/site.js', array(), SAWA_SITE_VER, true );
	}

	/* ------------------------------------------------------------------ links */

	/** URL of the first published page using a template, else a sensible fallback. */
	public static function url( $template ) {
		static $cache = array();
		if ( isset( $cache[ $template ] ) ) {
			return $cache[ $template ];
		}
		$p = get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'meta_key'       => '_wp_page_template', // phpcs:ignore
				'meta_value'     => $template, // phpcs:ignore
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		);
		if ( $p ) {
			$cache[ $template ] = get_permalink( $p[0] );
		} elseif ( 'sawa-home' === $template ) {
			$cache[ $template ] = home_url( '/' );
		} else {
			$cache[ $template ] = '';
		}
		return $cache[ $template ];
	}

	public static function has_page( $template ) {
		return (bool) get_posts(
			array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'meta_key'       => '_wp_page_template', // phpcs:ignore
				'meta_value'     => $template, // phpcs:ignore
				'posts_per_page' => 1,
				'fields'         => 'ids',
			)
		);
	}

	public static function blog_url() {
		$id = (int) get_option( 'page_for_posts' );
		return $id ? get_permalink( $id ) : home_url( '/blog/' );
	}

	public static function tracker_url() {
		$u = get_option( 'sawa_tr_page' );
		return $u ? $u : '';
	}

	/* ------------------------------------------------------------------ pieces */

	public static function join_button( $label = 'ادخل سوا انجليش', $class = 'btn btn-red' ) {
		return '<a class="' . esc_attr( $class ) . '" href="' . esc_url( self::s( 'join_url' ) ) . '" target="_blank" rel="noopener">' . esc_html( $label ) . '</a>';
	}

	public static function photo( $key, $label, $class = '' ) {
		$src = self::s( $key );
		if ( $src ) {
			return '<img class="photo ' . esc_attr( $class ) . '" src="' . esc_url( $src ) . '" alt="شريف عبد الباسط">';
		}
		return '<div class="photo photo-ph ' . esc_attr( $class ) . '" role="img" aria-label="مكان صورة شريف"><span>' . esc_html( $label ) . '</span></div>';
	}

	/** "قراية ٥ دقايق" for the current post, at about 200 words a minute. */
	public static function read_time() {
		$words = count( preg_split( '/[\s]+/u', trim( wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ) ) ), -1, PREG_SPLIT_NO_EMPTY ) );
		$min   = max( 1, (int) round( $words / 200 ) );
		return 'قراية ' . ( 1 === $min ? 'دقيقة' : ( 2 === $min ? 'دقيقتين' : $min . ' دقايق' ) );
	}

	public static function header( $current = '' ) {
		$t     = $current ? $current : self::current_template();
		$items = array(
			array( 'الرئيسية', self::url( 'sawa-home' ), 'sawa-home' ),
			array( 'المحتوى المجاني', self::url( 'sawa-free' ), 'sawa-free' ),
			array( 'المدونة', self::blog_url(), 'sawa-blog' ),
			array( 'عن شريف', self::url( 'sawa-about' ), 'sawa-about' ),
			array( 'Language Lens', home_url( '/lens/' ), 'sawa-lens' ),
			array( 'اختبر مستواك', home_url( '/placement/' ), '' ),
		);
		$tracker = self::tracker_url();
		ob_start();
		?>
		<header class="site-head" id="top">
			<div class="wrap head-row">
				<a class="wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="سوا انجليش، الصفحة الرئيسية">
					<span class="wm-ar">سوا</span><span class="wm-en">Sawa English</span>
				</a>
				<button class="menu-btn" aria-expanded="false" aria-controls="site-nav"><span class="sr">القائمة</span><i></i><i></i><i></i></button>
				<nav class="site-nav" id="site-nav" aria-label="القائمة الرئيسية">
					<ul>
						<?php foreach ( $items as $it ) : ?>
							<?php if ( $it[1] ) : ?>
								<li><a href="<?php echo esc_url( $it[1] ); ?>"<?php echo $t === $it[2] ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $it[0] ); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php if ( $tracker ) : ?>
							<li><a href="<?php echo esc_url( home_url( '/app/' ) ); ?>">التطبيق</a></li>
						<?php endif; ?>
					</ul>
					<?php echo self::join_button( 'ادخل سوا انجليش', 'btn btn-ink btn-sm' ); // phpcs:ignore ?>
				</nav>
			</div>
		</header>
		<?php
		return ob_get_clean();
	}

	public static function footer() {
		ob_start();
		?>
		<footer class="site-foot">
			<div class="wrap foot-grid">
				<div class="foot-brand">
					<span class="wordmark big"><span class="wm-ar">سوا</span><span class="wm-en">Sawa English</span></span>
					<p>خطة، ناس، وأنا. لمستوى A2 و B1 اللي اتعبوا من البداية من الصفر كل شهر.</p>
				</div>
				<nav class="foot-links" aria-label="روابط">
					<?php
					$links = array(
						array( 'المحتوى المجاني', self::url( 'sawa-free' ) ),
						array( 'المدونة', self::blog_url() ),
						array( 'عن شريف', self::url( 'sawa-about' ) ),
						array( 'Language Lens', home_url( '/lens/' ) ),
						array( 'اختبر مستواك ببلاش', home_url( '/placement/' ) ),
						array( 'ادخل سوا انجليش', self::url( 'sawa-join' ) ? self::url( 'sawa-join' ) : self::s( 'join_url' ) ),
						array( 'YouTube', self::s( 'youtube_url' ) ),
						array( 'Skool', self::s( 'join_url' ) ),
					);
					foreach ( $links as $l ) {
						if ( $l[1] ) {
							echo '<a href="' . esc_url( $l[1] ) . '">' . esc_html( $l[0] ) . '</a>';
						}
					}
					?>
				</nav>
			</div>
			<div class="wrap foot-meta">
				<span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> Sawa English · شريف عبد الباسط</span>
				<?php $terms = get_page_by_path( 'term_conditions' ); ?>
				<?php if ( $terms ) : ?>
					<a href="<?php echo esc_url( get_permalink( $terms ) ); ?>">الشروط والأحكام</a>
				<?php endif; ?>
			</div>
		</footer>
		<?php
		return ob_get_clean();
	}
}
