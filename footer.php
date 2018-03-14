<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'cwa_newsletter' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the cwa_newsletter footer text for footer customization.
					 *
					 * @since CWA Newsletter 0.1
					 */
					do_action( 'cwa_newsletter_credits' );
				?>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
