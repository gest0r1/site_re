<?php
/**
 * CPT: review — отзыв / кейс
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_CPT_Review {

    public static function register(): void {
        $labels = site_re_cpt_labels('Отзыв', 'Отзывы');

        $args = [
            'label'               => __('Отзывы', 'site-re'),
            'labels'              => $labels,
            'supports'            => ['title', 'editor', 'thumbnail', 'custom-fields'],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 22,
            'menu_icon'           => 'dashicons-star-filled',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rewrite'             => [
                'slug'       => 'review',
                'with_front' => false,
            ],
            'delete_with_user'    => false,
        ];

        register_post_type('review', $args);
    }
}
