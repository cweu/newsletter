<?php
/**
 * CWA Newsletter category index page
 *
 * WordPress has no category index. We make it an alias for the newsletter_article archive,
 * and let the newsletter_article archive show a category index if no filter is given.
 * A custom rewrite tag is added to detect this and modify the template.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.7
 */

// Category index URLs.
function cwa_newsletter_category_index_init() {
	add_rewrite_tag( '%show_category_index%', '[01]' );

	$category_base = get_option( 'category_base' );
	if ( ! $category_base ) $category_base = 'category';
	// @todo don't restrict to newsletter_article - or do? Need to trigger post archive for custom template.
	$target = 'index.php?post_type=newsletter_article&show_category_index=1';
	add_rewrite_rule( '^' . preg_quote($category_base) . '/?$', $target, 'top' );
	add_rewrite_rule( '^' . preg_quote($category_base) . '/page/([0-9]{1,})/?$', $target . '&paged=$matches[1]', 'top' );
}
add_action( 'init', 'cwa_newsletter_category_index_init' );

// Custom template for category index.
function cwa_newsletter_category_index_template( $template ) {
	if ( get_query_var( 'show_category_index' ) ) {
		$template = get_template_directory() . '/categories.php';
	}
	return $template;
}
add_filter( 'archive_template', 'cwa_newsletter_category_index_template' );
