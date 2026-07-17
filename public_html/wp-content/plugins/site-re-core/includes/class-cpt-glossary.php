<?php
/**
 * CPT: glossary — термин глоссария
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_CPT_Glossary {

    public static function register(): void {
        $labels = site_re_cpt_labels('Термин', 'Глоссарий');

        $args = [
            'label'               => __('Глоссарий', 'site-re'),
            'labels'              => $labels,
            'supports'            => ['title', 'editor', 'custom-fields'],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 24,
            'menu_icon'           => 'dashicons-book-alt',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => true,
            'rewrite'             => [
                'slug'       => 'glossary',
                'with_front' => false,
            ],
            'delete_with_user'    => false,
        ];

        register_post_type('glossary', $args);
    }
}
