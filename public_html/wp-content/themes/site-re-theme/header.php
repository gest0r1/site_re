<?php
/**
 * Header
 *
 * @package SiteRe
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main">
		<?php esc_html_e('Перейти к содержимому', 'site-re'); ?>
	</a>

	<header id="masthead" class="site-header">
		<div class="container site-header__inner">
			<div class="site-branding">
				<?php if (has_custom_logo()) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="site-title" rel="home">
						<?php bloginfo('name'); ?>
					</a>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Основное меню', 'site-re'); ?>">
				<?php
				wp_nav_menu([
					'theme_location' => 'header',
					'menu_class'     => 'main-menu',
					'container'      => false,
					'depth'          => 3,
					'fallback_cb'    => false,
				]);
				?>
			</nav>
		</div>
	</header>
