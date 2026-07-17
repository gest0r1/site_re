<?php
/**
 * Site breadcrumbs for scenario pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'the_content', function( $content ) {
	if ( is_admin() || ! is_page() || is_front_page() ) {
		return $content;
	}

	if ( ! function_exists( 'rank_math_the_breadcrumbs' ) ) {
		return $content;
	}

	ob_start();
	echo '<nav class=de-breadcrumbs aria-label=Breadcrumbs>';
	rank_math_the_breadcrumbs();
	echo '</nav>';
	$breadcrumbs = trim( (string) ob_get_clean() );

	if ( '' === $breadcrumbs ) {
		return $content;
	}

	return '<div class=de-breadcrumbs-wrap>' . $breadcrumbs . '</div>' . $content;
}, 5 );
