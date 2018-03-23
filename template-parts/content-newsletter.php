<?php
/**
 * The template part for displaying newsletters in a listing
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

$pods     = pods( 'newsletter', get_the_ID() );
$issue_nr = $pods->field( 'issue_nr' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'cwa_newsletter' ); ?></span>
			<?php endif; ?>

			<h2 class="entry-title"><?php echo esc_html( cwa_newsletter_format_issue_nr( $issue_nr ) ); ?></h2>
			<?php the_title( '<p class="entry-subtitle">', '</p>' ); ?>
		</header><!-- .entry-header -->

		<div class="newsletter-post-thumbnail-container">
			<?php cwa_newsletter_post_thumbnail( false, 'newsletter-medium-square' ); /* @todo include fallback image */ ?>
		</div>
	</a>

	<footer class="entry-footer">
		<?php cwa_newsletter_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'cwa_newsletter' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
