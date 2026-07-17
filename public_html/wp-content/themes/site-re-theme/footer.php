<?php
/**
 * Footer
 *
 * @package SiteRe
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="container site-footer__inner">
			<div class="site-footer__widgets">
				<?php if (is_active_sidebar('footer-1')) : ?>
					<?php dynamic_sidebar('footer-1'); ?>
				<?php endif; ?>
			</div>

			<nav class="site-footer__nav" aria-label="<?php esc_attr_e('Меню в подвале', 'site-re'); ?>">
				<?php
				wp_nav_menu([
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => false,
				]);
				?>
			</nav>

			<div class="site-footer__bottom">
				<p class="site-footer__copyright">
					&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
					<?php esc_html_e('Все права защищены.', 'site-re'); ?>
				</p>
				<p class="site-footer__legal">
					<a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Политика конфиденциальности', 'site-re'); ?></a>
					<span class="sep">|</span>
					<a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>"><?php esc_html_e('Cookie Policy', 'site-re'); ?></a>
					<span class="sep">|</span>
					<a href="<?php echo esc_url(home_url('/terms/')); ?>"><?php esc_html_e('Пользовательское соглашение', 'site-re'); ?></a>
				</p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
