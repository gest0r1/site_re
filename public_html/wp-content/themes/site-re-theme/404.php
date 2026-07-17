<?php
/**
 * 404 — Страница не найдена
 *
 * @package SiteRe
 */

get_header();
?>

<main id="main" class="site-main site-main--404">
	<div class="container">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e('Страница не найдена', 'site-re'); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e('Возможно, страница была удалена или вы перешли по неверной ссылке.', 'site-re'); ?></p>

				<div class="error-404__actions">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">
						<?php esc_html_e('На главную', 'site-re'); ?>
					</a>
					<span class="error-404__or"><?php esc_html_e('или', 'site-re'); ?></span>
					<a href="<?php echo esc_url(home_url('/buyers/catalog/')); ?>" class="btn btn--outline">
						<?php esc_html_e('Смотреть каталог', 'site-re'); ?>
					</a>
				</div>

				<div class="error-404__links">
					<p><strong><?php esc_html_e('Продаёте квартиру?', 'site-re'); ?></strong></p>
					<a href="<?php echo esc_url(home_url('/sell/')); ?>"><?php esc_html_e('Оценить и продать', 'site-re'); ?></a>
					<span class="sep">|</span>
					<a href="<?php echo esc_url(home_url('/buyers/')); ?>"><?php esc_html_e('Проверить объект', 'site-re'); ?></a>
				</div>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
