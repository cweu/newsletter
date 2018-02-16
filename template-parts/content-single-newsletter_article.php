<?php
/**
 * The template part for displaying single newsletter articles
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

$pods       = pods( 'newsletter_article', get_the_ID() );
$intro      = $pods->field( 'intro' );
$issue_nr   = $pods->field( 'issue_nr' );
$issue_date = null;

if ( $issue_nr ) {
	// Get issue date from newsletter, referenced by the issue number.
	$newsletter_pods = cwa_newsletter_pod_by_nr( 'newsletter', $issue_nr );
	if ( $newsletter_pods ) {
		$issue_date = strtotime( $newsletter_pods->field( 'pub_date' ) );
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php //cwa_newsletter_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php
				// Show "<author>, <date>, <issue>" (depending on which fields are present).
				echo esc_html( implode( ', ', array_filter( array(
					get_the_author(),
					$issue_date ? date_i18n( get_option( 'date_format' ), $issue_date ) : null,
					$issue_nr ? cwa_newsletter_format_issue_nr( $issue_nr ) : null,
				) ) ) );
			?>
		</div>
	</header><!-- .entry-header -->

	<?php cwa_newsletter_excerpt(); ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'cwa_newsletter' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cwa_newsletter' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->

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
