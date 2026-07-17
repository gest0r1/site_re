<?php
/**
 * Taxonomies: district (hierarchical), property_tag (flat)
 *
 * @package SiteRe_Core
 */

defined('ABSPATH') || exit;

class SiteRe_Taxonomies {

    public static function register(): void {
        self::register_district();
        self::register_property_tag();
    }

    private static function register_district(): void {
        $labels = site_re_tax_labels('Район', 'Районы');

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest'      => true,
            'show_tagcloud'     => false,
            'rewrite'           => [
                'slug'         => 'district',
                'with_front'   => false,
                'hierarchical' => true,
            ],
        ];

        register_taxonomy('district', ['property'], $args);
    }

    private static function register_property_tag(): void {
        $labels = site_re_tax_labels('Метка объекта', 'Метки объектов');

        $args = [
            'labels'            => $labels,
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_in_rest'      => true,
            'show_tagcloud'     => true,
            'rewrite'           => [
                'slug'       => 'property-tag',
                'with_front' => false,
            ],
        ];

        register_taxonomy('property_tag', ['property'], $args);
    }
}
