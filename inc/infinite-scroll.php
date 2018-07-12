<?php
/**
 * CWA Newsletter infinite scroll for newsletter article lists
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.6
 */

// @todo simplify if-statement
// @todo avoid code duplication with functions.php
 function cwa_newsletter_infinite_scroll_desired() {
	 return is_category() || is_post_type_archive( 'newsletter_article' ) || is_post_type_archive( 'newsletter' ) || is_singular( 'newsletter' );
 }

function cwa_newsletter_infinite_scroll_enqueue_scripts() {
	wp_register_script( 'infinite_scroll', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array( 'jquery' ), '20180413', true );

	if ( cwa_newsletter_infinite_scroll_desired() ) {
		wp_enqueue_script( 'infinite_scroll' );
	}
}
add_action( 'wp_enqueue_scripts', 'cwa_newsletter_infinite_scroll_enqueue_scripts' );
