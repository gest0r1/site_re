<?php
/**
 * Site Re — Theme Functions
 *
 * @package SiteRe
 * @version 0.1.0
 */

defined('ABSPATH') || exit;

/* ─── Theme Constants ───────────────────────────── */
define('SITE_RE_THEME_VERSION', '0.1.0');
define('SITE_RE_THEME_DIR', get_template_directory());
define('SITE_RE_THEME_URI', get_template_directory_uri());

/* ─── Theme Setup ──────────────────────────────── */
add_action('after_setup_theme', 'site_re_setup');
function site_re_setup(): void {
    // Translations
    load_theme_textdomain('site-re', SITE_RE_THEME_DIR . '/languages');

    // Core features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Menus
    register_nav_menus([
        'header' => esc_html__('Header Navigation', 'site-re'),
        'footer' => esc_html__('Footer Navigation', 'site-re'),
    ]);
}

/* ─── Register Sidebars ────────────────────────── */
add_action('widgets_init', 'site_re_widgets_init');
function site_re_widgets_init(): void {
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'site-re'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Основная боковая панель', 'site-re'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Footer Widgets', 'site-re'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Виджеты в подвале', 'site-re'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ]);
}

/* ─── Enqueue Styles & Scripts ─────────────────── */
add_action('wp_enqueue_scripts', 'site_re_enqueue');
function site_re_enqueue(): void {
    // Theme stylesheet
    wp_enqueue_style('site-re-style', get_stylesheet_uri(), [], SITE_RE_THEME_VERSION);

    // Main CSS (для Stage 5 — дизайн-система)
    // wp_enqueue_style('site-re-main', SITE_RE_THEME_URI . '/assets/css/main.css', ['site-re-style'], SITE_RE_THEME_VERSION);

    // Main JS (заготовка)
    // wp_enqueue_script('site-re-scripts', SITE_RE_THEME_URI . '/assets/js/main.js', [], SITE_RE_THEME_VERSION, ['strategy' => 'defer']);
}

/* ─── Utilities & Helpers ──────────────────────── */

/**
 * Получить SVG-иконку из спрайта (заготовка).
 */
function site_re_icon(string $name): string {
    return ''; // Stage 5 — подключить SVG-спрайт
}

/**
 * Вывести хлебные крошки (заготовка).
 */
function site_re_breadcrumbs(): void {
    // Stage 5 — реализовать
}
