<?php
/**
 * Plugin Name:       Site Re — Core
 * Plugin URI:        https://дом-эксперт.рф
 * Description:       Кастомные типы записей, таксономии и мета-поля для сайта риелтора.
 * Version:           0.1.0
 * Requires PHP:      8.0
 * Author:            OpenCode / Developer
 * Text Domain:       site-re
 * Domain Path:       /languages
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

define('SITE_RE_CORE_VERSION', '0.1.0');
define('SITE_RE_CORE_DIR', plugin_dir_path(__FILE__));
define('SITE_RE_CORE_URI', plugin_dir_url(__FILE__));

/* ─── Autoload includes ──────────────────────────── */
$includes = [
    'includes/class-cpt-property.php',
    'includes/class-cpt-developer.php',
    'includes/class-cpt-review.php',
    'includes/class-cpt-faq.php',
    'includes/class-cpt-glossary.php',
    'includes/class-taxonomies.php',
    'includes/class-acf-fields.php',
];

foreach ($includes as $file) {
    $path = SITE_RE_CORE_DIR . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}

/* ─── Init ───────────────────────────────────────── */
add_action('init', 'site_re_core_init');
function site_re_core_init(): void {
    SiteRe_CPT_Property::register();
    SiteRe_CPT_Developer::register();
    SiteRe_CPT_Review::register();
    SiteRe_CPT_FAQ::register();
    SiteRe_CPT_Glossary::register();
    SiteRe_Taxonomies::register();
    SiteRe_ACF_Fields::register();
}

/* ─── Flush rewrite rules on activation ─────────── */
register_activation_hook(__FILE__, 'site_re_core_activate');
function site_re_core_activate(): void {
    site_re_core_init();
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'site_re_core_deactivate');
function site_re_core_deactivate(): void {
    flush_rewrite_rules();
}

/* ─── Helper: label generator ───────────────────── */
if (!function_exists('site_re_cpt_labels')) {
    function site_re_cpt_labels(string $singular, string $plural, string $textdomain = 'site-re'): array {
        return [
            'name'                  => _x($plural, 'Post Type General Name', $textdomain),
            'singular_name'         => _x($singular, 'Post Type Singular Name', $textdomain),
            'menu_name'             => __($plural, $textdomain),
            'name_admin_bar'        => __($singular, $textdomain),
            'archives'              => __('Архив', $textdomain) . ' ' . $plural,
            'attributes'            => __('Атрибуты', $textdomain) . ' ' . $singular,
            'all_items'             => __('Все', $textdomain) . ' ' . $plural,
            'add_new_item'          => __('Добавить', $textdomain) . ' ' . $singular,
            'add_new'               => __('Добавить', $textdomain),
            'new_item'              => __('Новый', $textdomain) . ' ' . $singular,
            'edit_item'             => __('Редактировать', $textdomain) . ' ' . $singular,
            'update_item'           => __('Обновить', $textdomain) . ' ' . $singular,
            'view_item'             => __('Просмотреть', $textdomain) . ' ' . $singular,
            'view_items'            => __('Просмотреть', $textdomain) . ' ' . $plural,
            'search_items'          => __('Искать', $textdomain) . ' ' . $plural,
            'not_found'             => $plural . ' ' . __('не найдены', $textdomain),
            'not_found_in_trash'    => $plural . ' ' . __('не найдены в корзине', $textdomain),
            'featured_image'        => __('Изображение', $textdomain),
            'set_featured_image'    => __('Установить изображение', $textdomain),
            'remove_featured_image' => __('Удалить изображение', $textdomain),
            'use_featured_image'    => __('Использовать как изображение', $textdomain),
            'insert_into_item'      => __('Вставить в', $textdomain) . ' ' . $singular,
            'uploaded_to_this_item' => __('Загружено для', $textdomain) . ' ' . $singular,
            'items_list'            => __('Список', $textdomain) . ' ' . $plural,
            'items_list_navigation' => __('Навигация по списку', $textdomain) . ' ' . $plural,
            'filter_items_list'     => __('Фильтровать список', $textdomain) . ' ' . $plural,
        ];
    }
}

if (!function_exists('site_re_tax_labels')) {
    function site_re_tax_labels(string $singular, string $plural, string $textdomain = 'site-re'): array {
        return [
            'name'                       => _x($plural, 'Taxonomy General Name', $textdomain),
            'singular_name'              => _x($singular, 'Taxonomy Singular Name', $textdomain),
            'menu_name'                  => __($plural, $textdomain),
            'all_items'                  => __('Все', $textdomain) . ' ' . $plural,
            'parent_item'                => __('Родительский', $textdomain) . ' ' . $singular,
            'parent_item_colon'          => __('Родительский:', $textdomain) . ' ' . $singular,
            'new_item_name'              => __('Новый', $textdomain) . ' ' . $singular,
            'add_new_item'               => __('Добавить', $textdomain) . ' ' . $singular,
            'edit_item'                  => __('Редактировать', $textdomain) . ' ' . $singular,
            'update_item'                => __('Обновить', $textdomain) . ' ' . $singular,
            'view_item'                  => __('Просмотреть', $textdomain) . ' ' . $singular,
            'separate_items_with_commas' => __('Разделите запятыми', $textdomain),
            'add_or_remove_items'        => __('Добавить или удалить', $textdomain),
            'choose_from_most_used'      => __('Выбрать из часто используемых', $textdomain),
            'popular_items'              => __('Популярные', $textdomain) . ' ' . $plural,
            'search_items'               => __('Искать', $textdomain) . ' ' . $plural,
            'not_found'                  => $plural . ' ' . __('не найдены', $textdomain),
            'no_terms'                   => __('Нет', $textdomain) . ' ' . $plural,
            'items_list'                 => __('Список', $textdomain) . ' ' . $plural,
            'items_list_navigation'      => __('Навигация по списку', $textdomain) . ' ' . $plural,
        ];
    }
}
