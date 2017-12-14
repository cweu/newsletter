<?php
/**
 * Admin enqueuing functions
 *
 * @package CWA
 * @subpackage Newsletter
 */

/**
 * Load required stylesheets
 */
function cwa_newsletter_load_css() {
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.3.7', 'all' );
  wp_enqueue_style( 'newsletter', get_template_directory_uri() . '/css/newsletter.css', array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'cwa_newsletter_load_css' );

/**
 * Load required scripts
 */
function cwa_newsletter_load_scripts() {
  wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', false, '3.2.1', true );
  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'cwa_newsletter_load_scripts' );
