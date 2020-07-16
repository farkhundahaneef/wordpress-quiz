<?php
/**
 * Busyness functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Busyness
 */

if ( ! function_exists( 'busyness_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function busyness_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Busyness, use a find and replace
		 * to change 'busyness' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'busyness' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 450, true );


		// Set the default content width.
		$GLOBALS['content_width'] = 525;

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'busyness' ),
			'social' 	=> esc_html__( 'Social', 'busyness' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'busyness_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . busyness_min() . '.css', busyness_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'busyness' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'busyness' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'busyness' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'busyness' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'busyness' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'busyness' ),
		       	'shortName' => esc_html__( 'S', 'busyness' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'busyness' ),
		       	'shortName' => esc_html__( 'M', 'busyness' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'busyness' ),
		       	'shortName' => esc_html__( 'L', 'busyness' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'busyness' ),
		       	'shortName' => esc_html__( 'XL', 'busyness' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'busyness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function busyness_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = busyness_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter Busyness content width of the theme.
	 *
	 * @since Busyness 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'busyness_content_width', $content_width );
}
add_action( 'template_redirect', 'busyness_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function busyness_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'busyness' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'busyness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebars( 4, array(
		'name'          => esc_html__( 'Optional Sidebar %d', 'busyness' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'busyness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'busyness_widgets_init' );


if ( ! function_exists( 'busyness_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function busyness_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open+Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'busyness' ) ) {
		$fonts[] = 'Open Sans:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'busyness' ) ) {
		$fonts[] = 'Lato:300,400,600,700,900';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Busyness 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function busyness_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'busyness-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'busyness_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function busyness_scripts() {
	$options = busyness_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'busyness-fonts', busyness_fonts_url(), array(), null );

	// font-awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . busyness_min() . '.css' );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick' . busyness_min() . '.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . busyness_min() . '.css' );

	// blocks
	wp_enqueue_style( 'busyness-blocks', get_template_directory_uri() . '/assets/css/blocks' . busyness_min() . '.css' );

	wp_enqueue_style( 'busyness-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Load the colorscheme.
	$color_scheme = $options['colorscheme'];
	if ( ! in_array( $color_scheme, array( 'default', 'custom' ) ) ) {
		wp_enqueue_style( 'busyness-colors', get_template_directory_uri() . '/assets/css/' . esc_attr( $color_scheme ) . busyness_min() .'.css', array( 'busyness-style' ), '1.0' );
	}

	// Load the html5 shiv.
	wp_enqueue_script( 'busyness-html5', get_template_directory_uri() . '/assets/js/html5' . busyness_min() . '.js', array(), '3.7.3' );
	wp_script_add_data( 'busyness-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'busyness-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . busyness_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'busyness-navigation', get_template_directory_uri() . '/assets/js/navigation' . busyness_min() . '.js', array(), '20151215', true );

	$busyness_l10n = array(
		'quote'          => busyness_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'busyness' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'busyness' ),
		'icon'           => busyness_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);

	wp_localize_script( 'busyness-navigation', 'busyness_l10n', $busyness_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . busyness_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'jquery-matchHeight', get_template_directory_uri() . '/assets/js/jquery.matchHeight' . busyness_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri() . '/assets/js/isotope.pkgd' . busyness_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup' . busyness_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'packery-pkgd', get_template_directory_uri() . '/assets/js/packery.pkgd' . busyness_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'busyness-custom', get_template_directory_uri() . '/assets/js/custom' . busyness_min() . '.js', array( 'jquery' ), '20151215', true );

	if ( 'infinite' == $options['pagination_type'] ) {
		// infinite scroll js
		wp_enqueue_script( 'busyness-infinite-scroll', get_template_directory_uri() . '/assets/js/infinite-scroll' . busyness_min() . '.js', array( 'jquery' ), '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'busyness_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Busyness 1.0.0
 */
function busyness_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'busyness-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . busyness_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'busyness-fonts', busyness_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'busyness_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';
