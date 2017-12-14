<?php
/**
 * Template for showing a general page
 *
 * @package CWA
 * @subpackage Newsletter
 */

get_header(); ?>

<div class="body">
	<!-- START IMAGE -->
	<!-- <div class="image">
		<img src="<?php echo $featured_img; ?>" alt="">
	</div> -->
	<!-- END IMAGE -->

	<!-- START CONTENT -->
	<div class="content">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		endif;
		?>
		<br>
	</div>
	<!-- END CONTENT -->
</div>

<?php get_footer(); ?>
