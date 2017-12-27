<?php
/**
 * Template for displaying search forms in CWA Newsletter
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'cwa_newsletter' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cwa_newsletter' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'cwa_newsletter' ); ?></span></button>
</form>
