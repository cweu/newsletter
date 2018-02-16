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

/**
 * Allows duplicate article slugs in different newsletter issues.
 *
 * @param string $slug        The desired slug (post_name).
 * @param int    $post_ID     Post ID.
 * @param string $post_status No uniqueness checks are made if the post is still draft or pending.
 * @param string $post_type   Post type.
 * @param int    $post_parent Post parent ID.
 * @return string Unique slug for the post, based on $post_name (with a -1, -2, etc. suffix)
 * @since CWA Newsletter 0.1
 *
 * @see https://core.trac.wordpress.org/browser/tags/4.9.2/src/wp-includes/post.php#L3729
 * @see https://stackoverflow.com/a/17244042/2866660
 */
function cwa_newsletter_unique_post_slug( $slug, $post_ID, $post_status, $post_type, $post_parent ) {
	global $wpdb, $wp_rewrite;

	if ( 'newsletter_article' === $post_type ) {
    // start with a base slug w/o any suffixes
    $slug = preg_replace( '/(-\d+)$/', '', $slug );

		$check_sql = "
			SELECT $wpdb->posts.post_name
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
			  AND $wpdb->posts.post_name = %s AND $wpdb->posts.post_type = %s AND $wpdb->posts.ID != %d
			  AND $wpdb->postmeta.meta_key = 'issue_nr' AND $wpdb->postmeta.meta_value = (
					SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = 'issue_nr'
				)
			LIMIT 1
		";
		$post_name_check = $wpdb->get_var( $wpdb->prepare( $check_sql, $slug, $post_type, $post_ID, $post_ID ) );

		$feeds = is_array( $wp_rewrite->feeds ) ? $wp_rewrite->feeds : array();
		if ( $post_name_check || in_array( $slug, $feeds ) || 'embed' === $slug || apply_filters( 'wp_unique_post_slug_is_bad_flat_slug', false, $slug, $post_type ) ) {
			$suffix = 2;
			do {
				$alt_post_name = _truncate_post_slug( $slug, 200 - ( strlen( $suffix ) + 1 ) ) . "-$suffix";
				$post_name_check = $wpdb->get_var( $wpdb->prepare( $check_sql, $alt_post_name, $post_type, $post_ID, $post_ID ) );
				$suffix++;
			} while ( $post_name_check );
			$slug = $alt_post_name;
		}
	}

	return $slug;
}
add_filter( 'wp_unique_post_slug', 'cwa_newsletter_unique_post_slug', 10, 6 );
