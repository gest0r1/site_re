<?php
/**
 * CPT: property — объект недвижимости
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_CPT_Property {

    public static function register(): void {
        $labels = site_re_cpt_labels('Объект', 'Объекты');

        $args = [
            'label'               => __('Объекты', 'site-re'),
            'labels'              => $labels,
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 20,
            'menu_icon'           => 'dashicons-admin-multisite',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rewrite'             => [
                'slug'       => 'property',
                'with_front' => false,
            ],
            'delete_with_user'    => false,
        ];

        register_post_type('property', $args);
    }
}
