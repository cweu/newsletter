<?php
/**
 * Template Name: Home
 *
 * Shows the homepage and blog index, which is the last newsletter in this theme.
 * See `pre_get_posts` in `functions.php` for selection of the post.
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php get_template_part( 'template-parts/content-single', get_post_format() ?: get_post_type() ); ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
