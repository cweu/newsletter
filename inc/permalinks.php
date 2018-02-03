<?php
/**
 * CWA Newsletter permalink modifications for custom post types.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

/**
 * Adds custom rewrite tags.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_add_rewrite_tags() {
	add_rewrite_tag( '%issue_nr%', '([0-9.]+)' );
}
add_action( 'init', 'cwa_newsletter_add_rewrite_tags', 10, 0 );

/**
 * Allows the use of issue_nr in newsletter and article URLs.
 *
 * @param string $url The post URL.
 * @param object $post The post object.
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_add_post_type_link( $url, $post ) {
	// Substitute issue number in our custom post types.
	$post_type = get_post_type( $post );
	if ( 'newsletter' === $post_type || 'newsletter_article' === $post_type ) {
		$pods = pods( get_post_type( $post ), get_the_ID( $post ) );
		$url  = str_replace( '%issue_nr%', $pods->field( 'issue_nr' ), $url );
	}
	return $url;
}
add_action( 'post_type_link', 'cwa_newsletter_add_post_type_link', 10, 2 );
