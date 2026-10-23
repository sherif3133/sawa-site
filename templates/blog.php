<?php
/**
 * Blog index, categories, tags, authors, dates and search: a light hero, then a grid of article cards.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_search() ) {
	/* translators: search phrase */
	$sawa_title = sawa_t( sprintf( 'Search results for "%s"', get_search_query() ), sprintf( 'نتايج البحث عن "%s"', get_search_query() ) );
} elseif ( is_category() || is_tag() ) {
	$sawa_title = esc_html( single_term_title( '', false ) );
} elseif ( is_author() ) {
	$sawa_name  = get_the_author_meta( 'display_name', (int) get_query_var( 'author' ) );
	$sawa_title = sawa_t( 'Articles by ' . $sawa_name, 'مقالات ' . $sawa_name );
} elseif ( is_date() ) {
	$sawa_title = sawa_t( 'Archive: ' . get_the_date( 'F Y' ), 'أرشيف ' . get_the_date( 'F Y' ) );
} else {
	$sawa_title = sawa_t( 'Blog', 'المدونة' );
}
$sawa_main = ! is_search() && ! is_category() && ! is_tag() && ! is_author() && ! is_date();
?>
<section class="hero light free-hero blog-hero">
	<div class="wrap">
		<p class="eyebrow"><?php echo sawa_t( 'Long articles about learning, mindset, and keeping going', 'مقالات طويلة عن التعلم، والعقلية، والاستمرار' ); // phpcs:ignore ?></p>
		<h1 dir="auto"><?php echo $sawa_title; // phpcs:ignore -- escaped above ?></h1>
		<?php if ( $sawa_main ) : ?>
			<p class="serif">read slowly.</p>
		<?php elseif ( is_category() && category_description() ) : ?>
			<div class="lead"><?php echo wp_kses_post( category_description() ); ?></div>
		<?php endif; ?>
		<form class="blog-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="sr" for="blog-s"><?php echo sawa_t( 'Search the blog', 'دوّر في المدونة' ); // phpcs:ignore ?></label>
			<input id="blog-s" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search the blog"<?php echo Sawa_Lang::attr( array( 'placeholder' => array( 'Search the blog', 'دوّر في المدونة' ) ) ); // phpcs:ignore ?> dir="auto">
			<input type="hidden" name="post_type" value="post">
			<button class="btn btn-ink btn-sm" type="submit"><?php echo sawa_t( 'Search', 'دوّر' ); // phpcs:ignore ?></button>
		</form>
	</div>
</section>

<section class="sec white hub blog-list">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="res-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$sawa_cat = get_the_category();
					?>
					<article class="res">
						<a class="res-link" href="<?php the_permalink(); ?>">
							<span class="res-thumb<?php echo has_post_thumbnail() ? '' : ' res-thumb-ph'; ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'alt' => '' ) );
								} else {
									echo '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>';
								}
								?>
							</span>
							<span class="res-body">
								<span class="res-meta">
									<?php if ( $sawa_cat ) : ?>
										<span class="res-type"><?php echo esc_html( $sawa_cat[0]->name ); ?></span>
									<?php endif; ?>
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
									<span><?php echo Sawa_Site::read_time(); // phpcs:ignore ?></span>
								</span>
								<span class="res-title" dir="auto"><?php the_title(); ?></span>
								<span class="res-text" dir="auto"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></span>
							</span>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php
			$sawa_pages = paginate_links(
				array(
					'type'      => 'list',
					'prev_text' => sawa_t( 'Newer', 'الأحدث' ),
					'next_text' => sawa_t( 'Older', 'الأقدم' ),
				)
			);
			if ( $sawa_pages ) {
				echo '<nav class="pager" aria-label="Blog pages">' . $sawa_pages . '</nav>'; // phpcs:ignore
			}
			?>
		<?php else : ?>
			<p class="empty"><?php echo is_search() ? sawa_t( 'No articles found. Try another word.', 'ملقيناش مقالات بالكلام ده. جرب كلمة تانية.' ) : sawa_t( 'No articles here yet.', 'لسه مفيش مقالات هنا.' ); // phpcs:ignore ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
echo sawa_sec_close(); // phpcs:ignore
