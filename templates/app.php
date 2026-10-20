<?php
/**
 * Branded shell for app pages (the tracker, the review form): header, the page's content, footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="app-sec">
	<div class="wrap app-wrap">
		<?php the_content(); ?>
	</div>
</section>
