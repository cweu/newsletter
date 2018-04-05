<?php
/**
 * Template Name: Newsletter
 *
 * Shows the newsletter articles and the PDF.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

$pods = pods( 'newsletter', get_the_ID() );

if ( false ) :

// @todo Do this for .pdf suffix.
// Serve the PDF as a redirect to the file.
$pdf = $pods->field( 'pdf_file' );

if ( $pdf && $pdf['guid'] ) {
	header( 'Location: ' . $pdf['guid'] );
} else {
	status_header( 404 );
	include get_query_template( '404' );
}

else :

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header>
				<h1 class="page-title"><?php echo esc_html( $pods->field( 'title' ) ); ?></h1>
				<p class="page-subtitle"><?php echo esc_html( cwa_newsletter_format_issue_nr( $pods->field( 'issue_nr' ) ) ); ?></p>
			</header>

			<div class="the-content">
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

				while ( $query->have_posts() ) : $query->the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() ?: get_post_type() );

				// End the loop.
				endwhile;

				wp_reset_postdata();
				?>
			</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>

<?php endif; ?>
