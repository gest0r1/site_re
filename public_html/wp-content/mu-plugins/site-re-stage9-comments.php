<?php
/**
 * Disable comments site-wide.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function() {
	$post_types = get_post_types( array(), 'names' );
	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
		}
		if ( post_type_supports( $post_type, 'trackbacks' ) ) {
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}, 20 );

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'post_comments_feed_link', '__return_empty_string', 20, 1 );
add_filter( 'feed_links_show_comments_feed', '__return_false' );

add_action( 'template_redirect', function() {
	if ( is_comment_feed() ) {
		status_header( 404 );
		nocache_headers();
		include get_query_template( '404' );
		exit;
	}
}, 1 );
