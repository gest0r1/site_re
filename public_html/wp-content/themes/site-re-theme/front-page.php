<?php
/**
 * Front page
 *
 * @package SiteRe
 */

get_header();
?>

<main id="main" class="site-main site-main--front">

	<?php while (have_posts()) : the_post(); ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>

</main>

<?php
get_footer();
