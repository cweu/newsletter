<?php
/**
 * CWA Newsletter functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package CWA
 * @subpackage Newsletter
 * @since CWA Newsletter 0.1
 */

/**
 * CWA Newsletter only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	// @todo show error
}

if ( ! function_exists( 'cwa_newsletter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own cwa_newsletter_setup() function to override in a child theme.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on CWA Newsletter, use a find and replace
	 * to change 'cwa_newsletter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cwa_newsletter' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since CWA Newsletter 0.1
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cwa_newsletter' ),
		'social'  => __( 'Social Links Menu', 'cwa_newsletter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', cwa_newsletter_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // cwa_newsletter_setup
add_action( 'after_setup_theme', 'cwa_newsletter_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cwa_newsletter_content_width', 840 );
}
add_action( 'after_setup_theme', 'cwa_newsletter_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'cwa_newsletter' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'cwa_newsletter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'cwa_newsletter' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'cwa_newsletter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cwa_newsletter_widgets_init' );

if ( ! function_exists( 'cwa_newsletter_fonts_url' ) ) :
/**
 * Register Google fonts for CWA Newsletter.
 *
 * Create your own cwa_newsletter_fonts_url() function to override in a child theme.
 *
 * @since CWA Newsletter 0.1
 *
 * @return string Google fonts URL for the theme.
 */
function cwa_newsletter_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lora, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lora font: on or off', 'cwa_newsletter' ) ) {
		$fonts[] = 'Lora:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'cwa_newsletter' ) ) {
		$fonts[] = 'Playfair Display:700,900,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'cwa_newsletter' ) ) {
		// Lato instead of Avenir.
		$fonts[] = 'Lato:400,700'; // @todo pick only weights really used.
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'cwa_newsletter_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since CWA Newsletter 0.1
 */
function cwa_newsletter_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'cwa_newsletter-fonts', cwa_newsletter_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'cwa_newsletter-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'cwa_newsletter-ie', get_template_directory_uri() . '/css/ie.css', array( 'cwa_newsletter-style' ), '20160816' );
	wp_style_add_data( 'cwa_newsletter-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'cwa_newsletter-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'cwa_newsletter-style' ), '20160816' );
	wp_style_add_data( 'cwa_newsletter-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'cwa_newsletter-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'cwa_newsletter-style' ), '20160816' );
	wp_style_add_data( 'cwa_newsletter-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'cwa_newsletter-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'cwa_newsletter-html5', 'conditional', 'lt IE 9' );

	if ( is_home() || is_archive() ) {
		// Register Superclamp.
		wp_enqueue_script( 'cwa_newsletter-superclamp', get_template_directory_uri() . '/js/superclamp.min.js', array( 'jquery' ), '20161125' );
	}

	wp_enqueue_script( 'cwa_newsletter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cwa_newsletter-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'cwa_newsletter-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20180102', true );

	wp_localize_script( 'cwa_newsletter-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'cwa_newsletter' ),
		'collapse' => __( 'collapse child menu', 'cwa_newsletter' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'cwa_newsletter_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since CWA Newsletter 0.1
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function cwa_newsletter_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'cwa_newsletter_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since CWA Newsletter 0.1
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function cwa_newsletter_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Backend admin twaeks.
 */
require get_template_directory() . '/inc/admin-noblog.php';
require get_template_directory() . '/inc/admin-columns.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since CWA Newsletter 0.1
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function cwa_newsletter_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'cwa_newsletter_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since CWA Newsletter 0.1
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function cwa_newsletter_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'cwa_newsletter_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since CWA Newsletter 0.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function cwa_newsletter_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'cwa_newsletter_widget_tag_cloud_args' );

/**
 * Returns a human-readable version of the year-number combination.
 *
 * @since CWA Newsletter 0.1
 *
 * @param string $number number Issue number, like 5 or '29.1'.
 * @return string Human-readable issue name, like 'Jaargang 5' or 'Jaargang 29 nr. 1'.
 */
function cwa_newsletter_format_issue_nr( $number ) {
	if ( $number ) {
		$parts = explode( '.', $number, 2 );
		if ( count( $parts ) > 1 ) {
			return __( 'Jaargang', 'cwa_newsletter' ) . ' ' . $parts[0] . ' ' . __( 'nr.', 'cwa_newsletter' ) . ' ' . $parts[1];
		} else {
			return __( 'Jaargang', 'cwa_newsletter' ) . ' ' . $parts[0];
		}
	}
}

/**
 * Returns a Pod by issue number.
 *
 * @since CWA Newsletter 0.1
 *
 * @param string $pod_type type Pod type to find, either `newsletter` or `newsletter_article`.
 * @param string $number number Issue number, like 5 or '29.1'.
 * @return object Pod, or null if not found.
 */
function cwa_newsletter_pod_by_nr( $pod_type, $number ) {
	$query = array(
		'where' => 'issue_nr.meta_value = "' . pods_sanitize( $number ) . '"',
		'limit' => 1,
	);
	return pods( $pod_type, $query );
}
