<?php
/**
 * CWA Newsletter backend admin tweaks: add columns
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

/**
 * Adds issue number to admin post listings
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_manage_post_columns( $defaults ) {
	$defaults['issue_nr'] = __( 'Issue', 'cwa_newsletter' );
	return $defaults;
}
add_filter( 'manage_newsletter_posts_columns', 'cwa_newsletter_admin_manage_post_columns' );
add_filter( 'manage_newsletter_article_posts_columns', 'cwa_newsletter_admin_manage_post_columns' );

/**
 * Show issue number admin post listings
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_manage_post_custom_column( $name ) {
	switch ( $name ) {
		case 'issue_nr':
			if ( is_pod( get_the_ID() ) ) {
				$pods = pods( get_post_type(), get_the_ID() );
				if ( 'newsletter' === get_post_type() ) {
					// For newsletter, just show the text, because it would point to itself.
					echo esc_html( $pods->field( 'issue_nr' ) );
				} else {
					// For other types, link to the newsletter.
					edit_post_link( $pods->field( 'issue_nr' ), '', '', get_the_ID() );
				}
			}
	}
}
add_action( 'manage_newsletter_posts_custom_column', 'cwa_newsletter_admin_manage_post_custom_column' );
add_action( 'manage_newsletter_article_posts_custom_column', 'cwa_newsletter_admin_manage_post_custom_column' );

/**
 * Enable sorting of custom columns
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_manage_post_sortable_columns( $sortable_columns ) {
	$sortable_columns['issue_nr'] = 'issue_nr';
	return $sortable_columns;
}
add_filter( 'manage_edit-newsletter_sortable_columns', 'cwa_newsletter_admin_manage_post_sortable_columns' );
add_filter( 'manage_edit-newsletter_article_sortable_columns', 'cwa_newsletter_admin_manage_post_sortable_columns' );
