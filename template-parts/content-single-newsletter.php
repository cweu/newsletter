<?php
/**
 * The template part for displaying single newsletter issues
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.3
 */

$pods     = pods( 'newsletter', get_the_ID() );
$issue_nr = $pods->field( 'issue_nr' );
$pdf_link = $pods->field( 'pdf_file' )['guid'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="page-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		<p class="page-subtitle">
			<?php echo esc_html( cwa_newsletter_format_issue_nr( $issue_nr ) ); ?>
			<?php if ( $pdf_link ) : ?>
				<a href="<?php echo esc_url( $pdf_link ); ?>" class="view-pdf">(<?php esc_html_e( 'View PDF', 'cwa_newsletter' ); ?>)</a>
			<?php endif; ?>
		</p>
	</header><!-- .page-header -->

	<?php
	// Start the article loop.
	// @todo Move to function and use that too in pre_get_posts.
	$query = new WP_Query( array(
		'post_type'      => 'newsletter_article',
		'meta_query'     => array(
			'key'   => 'issue_nr',
			'value' => $pods->field( 'issue_nr' ),
		),
		'meta_key'       => 'page_nr',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'posts_per_page' => -1,
	));
	?>

	<?php if ( ! $query->have_posts() ) : ?>

		<?php if ( $pdf_link ) : ?>
			<a href="<?php echo esc_url( $pdf_link ); ?>" style="text-align: center; display: block;">
				<?php cwa_newsletter_post_thumbnail( false, 'medium' ); /* @todo include fallback image */ ?>
			</a>
		<?php else : ?>
			<?php cwa_newsletter_post_thumbnail( false, 'medium' ); /* @todo include fallback image */ ?>
		<?php endif; ?>

	<?php else : ?>
		<div class="the-content">
			<?php
			while ( $query->have_posts() ) : $query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() ?: get_post_type() );

			// End the loop.
			endwhile;
			?>
		</div>
	<?php
	endif;

	wp_reset_postdata();
	?>

</article><!-- #post-## -->
