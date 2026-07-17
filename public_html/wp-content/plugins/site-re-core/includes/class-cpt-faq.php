<?php
/**
 * CPT: faq — вопрос-ответ
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_CPT_FAQ {

    public static function register(): void {
        $labels = site_re_cpt_labels('FAQ', 'FAQ');

        $args = [
            'label'               => __('FAQ', 'site-re'),
            'labels'              => $labels,
            'supports'            => ['title', 'editor', 'custom-fields'],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 23,
            'menu_icon'           => 'dashicons-editor-help',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rewrite'             => [
                'slug'       => 'faq',
                'with_front' => false,
            ],
            'delete_with_user'    => false,
        ];

        register_post_type('faq', $args);
    }
}
