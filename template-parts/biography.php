<?php
/**
 * The template part for displaying an Author biography
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the CWA Newsletter author bio avatar size.
		 *
		 * @since CWA Newsletter 0.1
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'cwa_newsletter_author_bio_avatar_size', 42 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<div class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'cwa_newsletter' ), get_the_author() ); ?>
			</a>
		</div><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
