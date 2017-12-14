<?php
/**
 * @package CWA
 * @subpackage Newsletter
 */

/**
 * Activate Nav Menu Options
 */
function cwa_newsletter_register_nav_menu() {
  register_nav_menu( 'header_primary', 'Header Primary Navigation menu' );
  register_nav_menu( 'footer_primary', 'Footer Primary Navigation menu' );
}

add_action( 'after_setup_theme', 'cwa_newsletter_register_nav_menu' );
