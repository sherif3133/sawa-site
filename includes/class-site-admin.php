<?php
/**
 * Settings → Sawa Site: join link, price, numbers, photos and the setup checklist.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site_Admin {

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'register' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'media' ) );
	}

	public static function menu() {
		add_options_page( 'Sawa Site', 'Sawa Site', 'manage_options', 'sawa-site', array( __CLASS__, 'page' ) );
	}

	public static function media( $hook ) {
		if ( 'settings_page_sawa-site' === $hook ) {
			wp_enqueue_media();
		}
	}

	public static function register() {
		register_setting(
			'sawa_site',
			Sawa_Site::OPT,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( __CLASS__, 'sanitize' ),
			)
		);
	}

	public static function sanitize( $in ) {
		$d   = Sawa_Site::defaults();
		$out = array();
		foreach ( $d as $k => $v ) {
			$val       = isset( $in[ $k ] ) ? wp_unslash( $in[ $k ] ) : $v;
			$out[ $k ] = in_array( $k, array( 'join_url', 'youtube_url', 'photo_hero', 'photo_about', 'vsl_url' ), true ) ? esc_url_raw( $val ) : sanitize_text_field( $val );
		}
		return $out;
	}

	public static function page() {
		$s = Sawa_Site::s();
		$f = function ( $k, $label, $help = '', $type = 'text' ) use ( $s ) {
			echo '<tr><th scope="row"><label for="ss-' . esc_attr( $k ) . '">' . esc_html( $label ) . '</label></th><td>';
			echo '<input id="ss-' . esc_attr( $k ) . '" type="' . esc_attr( $type ) . '" class="regular-text" dir="auto" name="' . esc_attr( Sawa_Site::OPT . '[' . $k . ']' ) . '" value="' . esc_attr( $s[ $k ] ) . '">';
			if ( in_array( $k, array( 'photo_hero', 'photo_about' ), true ) ) {
				echo ' <button type="button" class="button ss-pick" data-target="ss-' . esc_attr( $k ) . '">Choose image</button>';
			}
			echo $help ? '<p class="description">' . wp_kses_post( $help ) . '</p>' : '';
			echo '</td></tr>';
		};
		$pages = array();
		foreach ( Sawa_Site::TEMPLATES as $slug => $name ) {
			$pages[ $slug ] = Sawa_Site::url( $slug );
		}
		?>
		<div class="wrap">
			<h1>Sawa Site</h1>
			<div class="card" style="max-width:900px">
				<h2>Pages</h2>
				<p>Each page uses a template. Create the page (any title), open <b>Page → Template</b> in the editor sidebar, pick the matching <b>Sawa:</b> template and publish. The page body can stay empty, except the app page, where you put the shortcode (<code>[sawa_tracker]</code> or <code>[sawa_review_form]</code>).</p>
				<table class="widefat striped" style="max-width:860px">
					<?php foreach ( Sawa_Site::TEMPLATES as $slug => $name ) : ?>
						<?php $has = Sawa_Site::has_page( $slug ); ?>
						<tr><td><b><?php echo esc_html( $name ); ?></b></td><td><?php echo $has ? '<a href="' . esc_url( $pages[ $slug ] ) . '" target="_blank">' . esc_html( $pages[ $slug ] ) . '</a>' : '<span style="color:#b32d2e">Not set up yet</span>'; ?></td></tr>
					<?php endforeach; ?>
				</table>
				<p>To make the Home page your front page: <b>Settings → Reading → "A static page"</b>, then choose it as the Homepage, and your blog page as the Posts page.</p>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields( 'sawa_site' ); ?>
				<h2>Joining</h2>
				<table class="form-table" role="presentation">
					<?php
					$f( 'join_url', 'Join link (Skool)', 'Every "ادخل سوا" button goes here.', 'url' );
					$f( 'price', 'Price', 'Shown on the Join page and the final section, e.g. <code>$29</code>.' );
					$f( 'price_period', 'Price period', 'e.g. <code>في الشهر</code>' );
					$f( 'price_note', 'Price note' );
					$f( 'guarantee', 'Guarantee line' );
					$f( 'vsl_url', 'Join page video (optional)', 'A YouTube link to your VSL. Shown under the Join page headline.', 'url' );
					?>
				</table>
				<h2>Numbers</h2>
				<p>Only real numbers. Leave one empty to hide it.</p>
				<table class="form-table" role="presentation">
					<?php
					$f( 'stat_subs', 'YouTube subscribers' );
					$f( 'stat_views', 'Free course views' );
					$f( 'stat_rating', 'Rating' );
					$f( 'stat_reviews', 'Number of reviews', 'Leave empty to count the testimonials on your wall automatically.' );
					$f( 'stat_rank', 'Skool rank' );
					?>
				</table>
				<h2>Photos and links</h2>
				<table class="form-table" role="presentation">
					<?php
					$f( 'photo_hero', 'Home hero photo', 'A real photo of you, cut out, ideally transparent PNG. Until you set one, a marked placeholder shows.', 'url' );
					$f( 'photo_about', 'About page photo', '', 'url' );
					$f( 'youtube_url', 'YouTube channel', '', 'url' );
					?>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<script>
		document.addEventListener('click', function (e) {
			var b = e.target.closest('.ss-pick'); if (!b || !window.wp || !wp.media) return;
			var f = wp.media({ title: 'Choose a photo', library: { type: 'image' }, multiple: false });
			f.on('select', function () { document.getElementById(b.dataset.target).value = f.state().get('selection').first().toJSON().url; });
			f.open();
		});
		</script>
		<?php
	}
}
