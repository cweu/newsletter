<?php
/**
 * CWA Newsletter functions and definitions
 *
 * @package CWA
 * @subpackage Newsletter
 */

// Remove Admin bar on front-end
show_admin_bar( false );

require get_template_directory() . '/inc/theme-support.php';
require get_template_directory() . '/plugins/plugin.php';
require get_template_directory() . '/inc/enqueue.php';

/**
 * Remove unused admin menus
 */
function remove_menus() {
	// remove_menu_page( 'index.php' );                  // Dashboard
	// remove_menu_page( 'jetpack' );                    // Jetpack*
	remove_menu_page( 'edit.php' );                      // Posts
	// remove_menu_page( 'upload.php' );                 // Media
	// remove_menu_page( 'edit.php?post_type=page' );    // Pages
	remove_menu_page( 'edit-comments.php' );             // Comments
	// remove_menu_page( 'themes.php' );                 // Appearance
	// remove_menu_page( 'plugins.php' );                // Plugins
	// remove_menu_page( 'users.php' );                  // Users
	// remove_menu_page( 'tools.php' );                  // Tools
	// remove_menu_page( 'options-general.php' );        // Settings
}
add_action( 'admin_menu', 'remove_menus' );
