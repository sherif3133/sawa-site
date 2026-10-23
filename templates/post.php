<?php
/**
 * A single blog article: title band, featured image, readable column, then the join section.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

while ( have_posts() ) :
	the_post();
	$sawa_cat = get_the_category();
	?>
	<article class="post-article">
		<header class="hero light post-hero">
			<div class="wrap narrow">
				<p class="meta">
					<a class="text-link" href="<?php echo esc_url( Sawa_Site::blog_url() ); ?>"><?php echo sawa_t( 'Blog', 'المدونة' ); // phpcs:ignore ?></a>
					<?php if ( $sawa_cat ) : ?>
						· <a class="text-link" href="<?php echo esc_url( get_category_link( $sawa_cat[0] ) ); ?>"><?php echo esc_html( $sawa_cat[0]->name ); ?></a>
					<?php endif; ?>
				</p>
				<h1 dir="auto"><?php the_title(); ?></h1>
				<p class="meta post-by">
					<?php echo esc_html( get_the_author() ); ?> ·
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time> ·
					<?php echo Sawa_Site::read_time(); // phpcs:ignore ?>
				</p>
			</div>
		</header>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="wrap post-cover"><?php the_post_thumbnail( 'large', array( 'alt' => '' ) ); ?></div>
		<?php endif; ?>
		<div class="wrap narrow prose" dir="auto">
			<?php
			the_content();
			wp_link_pages();
			?>
		</div>
		<?php
		$sawa_tags = get_the_tags();
		if ( $sawa_tags ) :
			?>
			<div class="wrap narrow post-tags">
				<?php foreach ( $sawa_tags as $sawa_tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $sawa_tag ) ); ?>">#<?php echo esc_html( $sawa_tag->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<nav class="wrap narrow post-nav" aria-label="More articles">
			<?php
			$sawa_prev = get_previous_post();
			$sawa_next = get_next_post();
			if ( $sawa_next ) {
				echo '<a href="' . esc_url( get_permalink( $sawa_next ) ) . '"><span class="meta">' . sawa_t( 'Newer article', 'المقال الأحدث' ) . '</span><b dir="auto">' . esc_html( get_the_title( $sawa_next ) ) . '</b></a>';
			}
			if ( $sawa_prev ) {
				echo '<a href="' . esc_url( get_permalink( $sawa_prev ) ) . '"><span class="meta">' . sawa_t( 'Older article', 'المقال الأقدم' ) . '</span><b dir="auto">' . esc_html( get_the_title( $sawa_prev ) ) . '</b></a>';
			}
			?>
		</nav>
	</article>
	<?php
endwhile;
echo sawa_sec_close(); // phpcs:ignore
