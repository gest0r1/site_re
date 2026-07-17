<?php
/**
 * Template part — контент не найден
 *
 * @package SiteRe
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e('Ничего не найдено', 'site-re'); ?></h1>
	</header>

	<div class="page-content">
		<?php if (is_search()) : ?>
			<p><?php esc_html_e('По вашему запросу ничего не найдено. Попробуйте изменить запрос.', 'site-re'); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php esc_html_e('Записей пока нет.', 'site-re'); ?></p>
		<?php endif; ?>
	</div>
</section>
