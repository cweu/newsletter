<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() ) : ?>
				<?php if ( is_front_page() ) : ?>
					<?php $pods = cwa_newsletter_latest_newsletter(); ?>
					<?php if ( $pods ) : ?>
						<header>
							<h1 class="page-title"><?php echo esc_html( $pods->field( 'title' ) ); ?></h1>
							<p class="page-subtitle"><?php echo esc_html( cwa_newsletter_format_issue_nr( $pods->field( 'issue_nr' ) ) ); ?></p>
						</header>
					<?php endif; ?>
				<?php else : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() ?: get_post_type() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'cwa_newsletter' ),
				'next_text'          => __( 'Next page', 'cwa_newsletter' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cwa_newsletter' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
