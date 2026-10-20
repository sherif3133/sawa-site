<?php
/**
 * The free content hub: a simple "Free content" list managed in wp-admin.
 * Paste a YouTube video or playlist link and the title and thumbnail fill in by themselves.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Sawa_Site_Resources {

	const PT = 'sawa_resource';

	const SHERIF_PHOTO = 'https://yt3.googleusercontent.com/QEUGhmFScUn3JU2vsRhUO8wJLwELDawTD6tfd6zJoe1Ego2PqaBLj8UTfP1ZK_dWIg9228PeChc=s240-c-k-c0x00ffffff-no-rj';

	const TYPES = array(
		'course'   => 'كورس',
		'video'    => 'فيديو',
		'reading'  => 'قراءة',
		'download' => 'ملف',
		'tool'     => 'أداة',
	);
	const LEVELS = array(
		'all' => 'كل المستويات',
		'a2'  => 'A2',
		'b1'  => 'B1',
	);

	public static function init() {
		add_action( 'init', array( __CLASS__, 'register' ) );
		add_action( 'init', array( __CLASS__, 'upgrade' ), 20 );
		if ( is_admin() ) {
			add_action( 'add_meta_boxes_' . self::PT, array( __CLASS__, 'box' ) );
			add_action( 'save_post_' . self::PT, array( __CLASS__, 'save' ), 10, 2 );
			add_filter( 'manage_' . self::PT . '_posts_columns', array( __CLASS__, 'cols' ) );
			add_action( 'manage_' . self::PT . '_posts_custom_column', array( __CLASS__, 'col' ), 10, 2 );
			add_filter( 'enter_title_here', array( __CLASS__, 'placeholder' ), 10, 2 );
		}
	}

	public static function register() {
		register_post_type(
			self::PT,
			array(
				'labels'       => array(
					'name'          => 'Free content',
					'singular_name' => 'Free content item',
					'add_new'       => 'Add item',
					'add_new_item'  => 'Add free content',
					'edit_item'     => 'Edit free content',
					'menu_name'     => 'Free content',
				),
				'public'       => false,
				'show_ui'      => true,
				'menu_icon'    => 'dashicons-video-alt3',
				'menu_position' => 24,
				'supports'     => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
			)
		);
	}

	public static function m( $id, $k, $d = '' ) {
		$v = get_post_meta( $id, '_sr_' . $k, true );
		return '' === $v ? $d : $v;
	}

	public static function yt_id( $u ) {
		return preg_match( '~(?:youtu\.be/|[?&]v=|/embed/|/shorts/|/live/)([\w-]{11})~', (string) $u, $m ) ? $m[1] : '';
	}

	public static function yt_list( $u ) {
		return preg_match( '~[?&]list=([\w-]+)~', (string) $u, $m ) ? $m[1] : '';
	}

	/** A YouTube channel link (not a video or playlist). Returns the @handle or ''. */
	public static function yt_channel( $u ) {
		if ( self::yt_id( $u ) || self::yt_list( $u ) ) {
			return '';
		}
		return preg_match( '~youtube[.]com/(@[A-Za-z0-9_.-]+|channel/[A-Za-z0-9_-]+|c/[A-Za-z0-9_.-]+)~', (string) $u, $m ) ? $m[1] : '';
	}

	/** The channel's profile photo, read from the channel page. */
	public static function channel_photo( $u ) {
		$res = wp_remote_get(
			$u,
			array(
				'timeout'    => 15,
				'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
				'headers'    => array( 'Cookie' => 'CONSENT=YES+1; SOCS=CAI', 'Accept-Language' => 'en' ),
			)
		);
		if ( ! is_wp_error( $res ) && preg_match( '~<meta property="og:image" content="([^"]+)"~', wp_remote_retrieve_body( $res ), $m ) ) {
			return esc_url_raw( str_replace( '=s900-', '=s240-', html_entity_decode( $m[1] ) ) );
		}
		// YouTube sometimes hides the channel page from servers. Known photo for Sherif's channel.
		return false !== stripos( $u, '@sherif.abdelbaset' ) ? self::SHERIF_PHOTO : '';
	}

	/**
	 * 1.2: the channel moved to @sherif.abdelbaset, and the free courses join the hub.
	 * Runs once; items are matched by link so nothing is added twice.
	 */
	public static function upgrade() {
		$db = (int) get_option( 'sawa_site_db', 1 );
		if ( 2 === $db ) {
			// 1.2.1: retry the channel photo where the first try found none.
			update_option( 'sawa_site_db', 3 );
			foreach ( get_posts( array( 'post_type' => self::PT, 'post_status' => 'any', 'posts_per_page' => 200 ) ) as $p ) {
				$u = self::m( $p->ID, 'url' );
				if ( self::yt_channel( $u ) && ! self::m( $p->ID, 'thumb' ) ) {
					$photo = self::channel_photo( $u );
					if ( $photo ) {
						update_post_meta( $p->ID, '_sr_thumb', $photo );
					}
				}
			}
			return;
		}
		if ( $db >= 2 ) {
			return;
		}
		update_option( 'sawa_site_db', 3 );
		$old = 'https://www.youtube.com/@sherifabdelbaset';
		$new = 'https://www.youtube.com/@sherif.abdelbaset';
		$set = get_option( Sawa_Site::OPT, array() );
		if ( is_array( $set ) && isset( $set['youtube_url'] ) && rtrim( $set['youtube_url'], '/' ) === $old ) {
			$set['youtube_url'] = $new;
			update_option( Sawa_Site::OPT, $set );
		}
		$all  = get_posts( array( 'post_type' => self::PT, 'post_status' => 'any', 'posts_per_page' => 200 ) );
		$have = array();
		foreach ( $all as $p ) {
			$u = self::m( $p->ID, 'url' );
			if ( rtrim( $u, '/' ) === $old ) {
				$u = $new;
				update_post_meta( $p->ID, '_sr_url', $new );
			}
			if ( self::yt_channel( $u ) ) {
				update_post_meta( $p->ID, '_sr_featured', 0 );
				wp_update_post( array( 'ID' => $p->ID, 'menu_order' => 10 ) );
				$photo = self::channel_photo( $u );
				if ( $photo ) {
					update_post_meta( $p->ID, '_sr_thumb', $photo );
				}
			}
			$have[] = self::yt_id( $u );
		}
		$courses = array(
			array( 'vr4TURN9xwc', 'كيف تتعلم اللغة الانجليزية في 2026؟ | خطتك الكاملة من الصفر للطلاقة (+6 ساعات)', 'خطة كاملة من الصفر للطلاقة في فيديو واحد. لو مش عارف تبدأ منين، ابدأ من هنا.', 'course', 'all', '+٦ ساعات', 1 ),
			array( '4TY7gGAmRq0', 'تعلم اللغة الإنجليزية من الصفر مجانًا | خطة كاملة + تطبيق عملي (+3 ساعات)', 'خطة كاملة ومعاها تطبيق عملي، للي بيبدأ من الصفر.', 'course', 'all', '+٣ ساعات', 0 ),
			array( 'I9QGJ7gNYXE', 'اقرأ كتاب بالانجليزي معايا | Alex Hormozi - $100M Offers (1/7)', 'بنقرا كتاب كامل بالانجليزي مع بعض. ده الجزء الأول من ٧.', 'reading', 'b1', 'الجزء ١ من ٧', 0 ),
		);
		foreach ( $courses as $i => $c ) {
			if ( in_array( $c[0], $have, true ) ) {
				continue;
			}
			$id = wp_insert_post(
				array(
					'post_type'    => self::PT,
					'post_status'  => 'publish',
					'post_title'   => $c[1],
					'post_excerpt' => $c[2],
					'menu_order'   => $i - 5,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_sr_url', 'https://www.youtube.com/watch?v=' . $c[0] );
				update_post_meta( $id, '_sr_type', $c[3] );
				update_post_meta( $id, '_sr_level', $c[4] );
				update_post_meta( $id, '_sr_length', $c[5] );
				update_post_meta( $id, '_sr_featured', $c[6] );
				update_post_meta( $id, '_sr_thumb', 'https://i.ytimg.com/vi/' . $c[0] . '/hqdefault.jpg' );
			}
		}
	}

	/** Items for the hub, featured first, then by menu order and date. */
	public static function items() {
		$q   = get_posts(
			array(
				'post_type'      => self::PT,
				'post_status'    => 'publish',
				'posts_per_page' => 200,
				'orderby'        => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
			)
		);
		$out = array();
		foreach ( $q as $p ) {
			$url   = self::m( $p->ID, 'url' );
			$thumb = get_the_post_thumbnail_url( $p, 'medium_large' );
			if ( ! $thumb ) {
				$thumb = self::m( $p->ID, 'thumb' );
			}
			if ( ! $thumb && self::yt_id( $url ) ) {
				$thumb = 'https://i.ytimg.com/vi/' . self::yt_id( $url ) . '/hqdefault.jpg';
			}
			$out[] = array(
				'id'       => $p->ID,
				'title'    => get_the_title( $p ),
				'text'     => $p->post_excerpt,
				'url'      => $url,
				'type'     => self::m( $p->ID, 'type', 'video' ),
				'level'    => self::m( $p->ID, 'level', 'all' ),
				'length'   => self::m( $p->ID, 'length' ),
				'featured' => (bool) self::m( $p->ID, 'featured', 0 ),
				'thumb'    => $thumb,
				'playlist' => (bool) self::yt_list( $url ),
				'channel'  => self::yt_channel( $url ),
			);
		}
		usort(
			$out,
			function ( $a, $b ) {
				return (int) $b['featured'] <=> (int) $a['featured'];
			}
		);
		return $out;
	}

	/* ------------------------------------------------------------------ admin */

	public static function placeholder( $t, $post ) {
		return self::PT === $post->post_type ? 'Title (leave empty for YouTube links: it fills in by itself)' : $t;
	}

	public static function box() {
		add_meta_box( 'sr_details', 'Details', array( __CLASS__, 'box_html' ), self::PT, 'normal', 'high' );
	}

	public static function box_html( $post ) {
		wp_nonce_field( 'sr_save', 'sr_nonce' );
		$sel = function ( $name, $opts, $cur ) {
			$h = '<select name="sr[' . esc_attr( $name ) . ']">';
			foreach ( $opts as $k => $l ) {
				$h .= '<option value="' . esc_attr( $k ) . '"' . selected( $cur, $k, false ) . '>' . esc_html( $l ) . '</option>';
			}
			return $h . '</select>';
		};
		$types = array(
			'course'   => 'Course / playlist (كورس)',
			'video'    => 'Video (فيديو)',
			'reading'  => 'Reading (قراءة)',
			'download' => 'Download / PDF (ملف)',
			'tool'     => 'Tool / worksheet (أداة)',
		);
		?>
		<p><label><b>Link</b> (a YouTube video or playlist, a PDF, or any page)<br>
		<input type="url" name="sr[url]" class="widefat" value="<?php echo esc_attr( self::m( $post->ID, 'url' ) ); ?>" placeholder="https://www.youtube.com/playlist?list=…"></label></p>
		<p style="display:flex;gap:24px;flex-wrap:wrap">
			<label><b>Type</b><br><?php echo $sel( 'type', $types, self::m( $post->ID, 'type', 'video' ) ); // phpcs:ignore ?></label>
			<label><b>Level</b><br><?php echo $sel( 'level', self::LEVELS, self::m( $post->ID, 'level', 'all' ) ); // phpcs:ignore ?></label>
			<label><b>Length</b> (optional)<br><input name="sr[length]" value="<?php echo esc_attr( self::m( $post->ID, 'length' ) ); ?>" placeholder="٦ ساعات · ١٢ فيديو"></label>
		</p>
		<p><label><input type="checkbox" name="sr[featured]" value="1" <?php checked( self::m( $post->ID, 'featured', 0 ), 1 ); ?>> <b>Start here</b>: show this first, as the big card at the top of the page</label></p>
		<p class="description">Write a one-line description in Arabic in the <b>Excerpt</b> box below. Order items with <b>Order</b> in the Page Attributes box (lower numbers first). For YouTube links the thumbnail is automatic; set a Featured image to override it.</p>
		<?php
	}

	public static function save( $post_id, $post ) {
		if ( ! isset( $_POST['sr_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['sr_nonce'] ), 'sr_save' ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$in  = isset( $_POST['sr'] ) ? (array) wp_unslash( $_POST['sr'] ) : array(); // phpcs:ignore
		$url = esc_url_raw( $in['url'] ?? '' );
		update_post_meta( $post_id, '_sr_url', $url );
		update_post_meta( $post_id, '_sr_type', array_key_exists( $in['type'] ?? '', self::TYPES ) ? $in['type'] : 'video' );
		update_post_meta( $post_id, '_sr_level', array_key_exists( $in['level'] ?? '', self::LEVELS ) ? $in['level'] : 'all' );
		update_post_meta( $post_id, '_sr_length', sanitize_text_field( $in['length'] ?? '' ) );
		update_post_meta( $post_id, '_sr_featured', empty( $in['featured'] ) ? 0 : 1 );

		if ( $url && self::yt_channel( $url ) ) {
			$photo = self::channel_photo( $url );
			if ( $photo ) {
				update_post_meta( $post_id, '_sr_thumb', $photo );
			}
		}
		// YouTube: fill in the title and thumbnail.
		if ( $url && ( self::yt_id( $url ) || self::yt_list( $url ) ) ) {
			$res = wp_remote_get( 'https://www.youtube.com/oembed?format=json&url=' . rawurlencode( $url ), array( 'timeout' => 10 ) );
			$j   = is_wp_error( $res ) ? null : json_decode( wp_remote_retrieve_body( $res ), true );
			if ( is_array( $j ) ) {
				if ( ! empty( $j['thumbnail_url'] ) ) {
					update_post_meta( $post_id, '_sr_thumb', esc_url_raw( str_replace( 'hqdefault', 'hqdefault', $j['thumbnail_url'] ) ) );
				}
				$title = trim( (string) $post->post_title );
				if ( ( '' === $title || 'Auto Draft' === $title ) && ! empty( $j['title'] ) ) {
					remove_action( 'save_post_' . self::PT, array( __CLASS__, 'save' ), 10 );
					wp_update_post(
						array(
							'ID'         => $post_id,
							'post_title' => sanitize_text_field( $j['title'] ),
						)
					);
					add_action( 'save_post_' . self::PT, array( __CLASS__, 'save' ), 10, 2 );
				}
			}
		}
	}

	public static function cols( $c ) {
		return array(
			'cb'        => $c['cb'],
			'sr_thumb'  => '',
			'title'     => 'Title',
			'sr_type'   => 'Type',
			'sr_level'  => 'Level',
			'sr_feat'   => 'Start here',
			'date'      => 'Date',
		);
	}

	public static function col( $c, $id ) {
		switch ( $c ) {
			case 'sr_thumb':
				foreach ( self::items() as $it ) {
					if ( $it['id'] === $id && $it['thumb'] ) {
						echo '<img src="' . esc_url( $it['thumb'] ) . '" alt="" style="width:80px;height:45px;object-fit:cover;border-radius:4px">';
					}
				}
				break;
			case 'sr_type':
				echo esc_html( self::TYPES[ self::m( $id, 'type', 'video' ) ] ?? '' );
				break;
			case 'sr_level':
				echo esc_html( self::LEVELS[ self::m( $id, 'level', 'all' ) ] ?? '' );
				break;
			case 'sr_feat':
				echo self::m( $id, 'featured', 0 ) ? '★' : '';
				break;
		}
	}

	/** First activation: a few real items so the page isn't empty. */
	public static function seed() {
		if ( get_posts( array( 'post_type' => self::PT, 'post_status' => 'any', 'posts_per_page' => 1, 'fields' => 'ids' ) ) ) {
			return;
		}
		$items = array(
			array( 'قناة شريف على يوتيوب', 'كل الفيديوهات والكورسات المجانية في مكان واحد. اشترك عشان يوصلك الجديد.', 'https://www.youtube.com/@sherif.abdelbaset', 'video', 'all', '', 1 ),
			array( '40 Values Checklist', 'اعرف إيه اللي يهمك فعلًا. لما تعرف "ليه" بتتعلم، بتكمّل.', home_url( '/40-values-checklist/' ), 'tool', 'all', '', 0 ),
			array( 'Indonesian Love Story: Free Graded Reader', 'قصة كاملة في ٨ فصول بانجليزي متدرج. قراءة ممتعة وانت فاهم معظمها.', home_url( '/indonesian-love-story-free-graded-reader/' ), 'reading', 'all', '٨ فصول', 0 ),
		);
		foreach ( $items as $i => $it ) {
			$id = wp_insert_post(
				array(
					'post_type'    => self::PT,
					'post_status'  => 'publish',
					'post_title'   => $it[0],
					'post_excerpt' => $it[1],
					'menu_order'   => $i,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_sr_url', $it[2] );
				update_post_meta( $id, '_sr_type', $it[3] );
				update_post_meta( $id, '_sr_level', $it[4] );
				update_post_meta( $id, '_sr_length', $it[5] );
				update_post_meta( $id, '_sr_featured', $it[6] );
			}
		}
	}
}
