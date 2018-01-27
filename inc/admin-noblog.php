<?php
/**
 * CWA Newsletter backend admin tweaks: remove blogging functionality
 *
 * Heavily inspired by the disable-blogging plugin by Fact Maven.
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
 * Display custom post types in the 'At a glance' meta box instead of posts and pages
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_glance_items( $items = array() ) {
	foreach ( array( 'newsletter', 'newsletter_article' ) as $post_type ) {
		// @see http://wpsnipp.com/index.php/functions-php/wordpress-post-types-dashboard-at-glance-widget/
		// @see https://github.com/WordPress/WordPress/blob/1caa918dbc1256af566fd0289bd750214db2d17d/wp-admin/includes/dashboard.php#L260
		$num_posts = wp_count_posts( $post_type );
		if ( $num_posts && $num_posts->publish ) {
			$post_type_object = get_post_type_object( $post_type );
			$text             = number_format_i18n( $num_posts->publish ) . ' '
				. ( $num_posts->publish > 1 ? $post_type_object->labels->name : $post_type_object->labels->singular_name );
			if ( $post_type_object && current_user_can( $post_type_object->cap->edit_posts ) ) {
				$items[] = sprintf( '<li class="%1$s-count"><a href="edit.php?post_type=%1$s">%2$s</a></li>', esc_attr( $post_type ), esc_html( $text ) );
			} else {
				$items[] = printf( '<li class="%1$s-count"><span>%2$s</span></li>', esc_attr( $post_type ), esc_html( $text ) );
			}
		}
	}
	return $items;
}
add_filter( 'dashboard_glance_items', 'cwa_newsletter_admin_glance_items', 10 );

/**
 * Enqueues scripts and styles.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_admin_scripts() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'cwa_newsletter_admin_scripts' );

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
