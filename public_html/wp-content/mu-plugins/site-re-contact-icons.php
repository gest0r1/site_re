<?php
/**
 * Plugin Name: Site RE Contact Icons
 * Description: Inline SVG icon functions for contact details (phone, email, clock, location).
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Shared span wrapper for all contact icons.
 */
function de_icon_wrap( $svg_content ) {
    echo '<span class="de-icon" style="display:inline-flex;align-items:center;justify-content:center;vertical-align:middle;margin-right:6px;width:18px;height:18px;color:#C8A468;flex-shrink:0;">' . $svg_content . '</span>';
}

/**
 * Phone handset icon.
 */
function de_icon_phone() {
    de_icon_wrap(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">'
        . '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>'
        . '</svg>'
    );
}

/**
 * Envelope / mail icon.
 */
function de_icon_email() {
    de_icon_wrap(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">'
        . '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>'
        . '<polyline points="22,6 12,13 2,6"/>'
        . '</svg>'
    );
}

/**
 * Clock icon for business hours.
 */
function de_icon_clock() {
    de_icon_wrap(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">'
        . '<circle cx="12" cy="12" r="10"/>'
        . '<polyline points="12 6 12 12 16 14"/>'
        . '</svg>'
    );
}

/**
 * Map pin / location icon.
 */
function de_icon_location() {
    de_icon_wrap(
        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">'
        . '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>'
        . '<circle cx="12" cy="10" r="3"/>'
        . '</svg>'
    );
}

/**
 * Output a contact row with icon + text.
 *
 * @param string $icon_fn  Name of the icon function to call (e.g. 'de_icon_phone').
 * @param string $text     The contact detail text.
 */
function de_contact_row( $icon_fn, $text ) {
    echo '<span class="de-contact-row" style="display:flex;align-items:flex-start;gap:8px;margin-bottom:10px;color:#D8DEE8;font-size:14px;line-height:1.5;">';
    if ( is_callable( $icon_fn ) ) {
        call_user_func( $icon_fn );
    }
    echo '<span>' . wp_kses_post( $text ) . '</span>';
    echo '</span>';
}
