<?php
/**
 * CWA Newsletter basic mail template
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

/**
 * Returns basic mail template for newsletter post type and query parameter.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_newsletter_mail_template( $single_template ) {
	global $post;

	$post_type = get_post_type( $post );
	$template  = get_query_var( 'template' );
	if ( 'newsletter' === $post_type && 'mail' === $template ) {
		$single_template = get_template_directory() . '/template-parts/content-single-newsletter-mail.php';
	}

	return $single_template;
}
add_filter( 'single_template', 'cwa_newsletter_newsletter_mail_template' );

/**
 * Adds query parameter for mail template.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_add_mail_rewrite_tags() {
	add_rewrite_tag( '%template%', '\\w+' );
}
add_action( 'init', 'cwa_newsletter_add_mail_rewrite_tags', 10, 0 );

/**
 * Registers the mail footer menu.
 *
 * @since CWA Newsletter 0.6
 */
function cwa_newsletter_mail_template_setup() {
	register_nav_menu( 'mailfooter', __( 'Mail Footer Menu', 'cwa_newsletter' ) );
}
add_action( 'after_setup_theme', 'cwa_newsletter_mail_template_setup' );

/**
 * Returns the mail footer menu.
 *
 * @param stdClass    $args   An object containing wp_nav_menu() arguments.
 * @return string The HTML content for the mail footer menu.
 */
function cwa_newsletter_mailfooter_menu( $args = array() ) {
	$args = array_merge( array(
		'theme_location' => 'mailfooter',
		'fallback_cb'    => false,
		'depth'          => 1,
		'container'      => false,
		'walker'         => new CWA_Newsletter_Mailfooter_Walker(),
	), $args );
	return wp_nav_menu( $args );
}

/**
 * Custom menu walker returning a flat list
 */
class CWA_Newsletter_Mailfooter_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf("%s<a href='%s'>%s</a>",
			$output ? ' | ' : '',
			esc_attr( WP_Http::make_absolute_url( $item->url, get_site_url() ) ),
			esc_html( $item->title )
		);
	}

	function end_el( &$output, $object, $depth = 0, $args = array() ) {
		// nothing to do
	}
}
