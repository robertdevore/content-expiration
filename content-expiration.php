<?php
/*
Plugin Name: Content Expiration
Description: A plugin to manage content expiration with shortcodes.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Shortcode handler for content expiration.
 *
 * @param array  $atts    Shortcode attributes.
 * @param string $content Content enclosed by shortcode.
 * @return string
 */
function content_expiration_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( [
        'show' => '',
        'hide' => '',
    ], $atts, 'content_expiration' );

    $show_date = sanitize_text_field( $atts['show'] );
    $hide_date = sanitize_text_field( $atts['hide'] );
    $current_date = current_time( 'Y-m-d' );

    if ( ( ! empty( $show_date ) && $current_date < $show_date ) || ( ! empty( $hide_date ) && $current_date > $hide_date ) ) {
        return ''; // Content is not within the specified date range.
    }

    return sprintf( 
        '<div class="content-expiration">%s</div>', 
        esc_html( $content ) 
    );
}
add_shortcode( 'content_expiration', 'content_expiration_shortcode' );
