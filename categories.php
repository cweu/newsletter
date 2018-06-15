<?php
/**
 * The template for displaying the category index.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.7
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main category-index" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php echo _( "Categories" ); ?></h1>
			</header><!-- .page-header -->

			<ul class="cat-index">
				<?php
				wp_list_categories( array(
					'depth'      => 1,    // @todo Show children as well.
					'title_li'   => false,
					'show_count' => true
				) );
				?>
			</ul>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
