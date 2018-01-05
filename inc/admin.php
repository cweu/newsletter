<?php
/**
 * CWA Newsletter backend admin tweaks
 *
 * Removing blogging functionality inspired by the disable-blogging plugin by Fact Maven.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

/**
 * Removes post-related functionality from top admin bar
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_tweak_admin_bar() {
	// New post option in top bar.
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'new-post' );
}
add_action( 'wp_before_admin_bar_render', 'cwa_newsletter_admin_tweak_admin_bar', 10 );

/**
 * Removes post-related functionality from left admin menu
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_tweak_admin_menu() {
	remove_menu_page( 'edit.php' );
}
add_action( 'admin_menu', 'cwa_newsletter_admin_tweak_admin_menu', 10 );

/**
 * Display custom post types in the 'Activity' meta box instead of posts
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_recent_posts_query_args( $query_args ) {
	$query_args['post_type'] = get_post_types(
		array(
			'public'   => true,
			'_builtin' => false,
		),
		'names', 'and'
	);
	return $query_args;
}
add_filter( 'dashboard_recent_posts_query_args', 'cwa_newsletter_admin_recent_posts_query_args', 10 );

/**
 * Removes widgets we don't want from the dashboard
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_tweak_dashboard() {
	remove_action( 'welcome_panel', 'wp_welcome_panel' );             // Welcome.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );      // WordPress Blog.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Draft.
}
add_action( 'wp_dashboard_setup', 'cwa_newsletter_admin_tweak_dashboard', 10 );

/**
 * Removes post type from REST API
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newletter_admin_tweak_rest_api() {
	global $wp_post_types;
	// If the API calls 'post', return false.
	if ( isset( $wp_post_types['post'] ) ) {
		$wp_post_types['post']->show_in_rest = false;
		return true;
	}
	return false;
}
add_action( 'init', 'cwa_newletter_admin_tweak_rest_api', 25 );

// Disable post-by-email functionality.
add_filter( 'enable_post_by_email_configuration', '__return_false', 10 );
