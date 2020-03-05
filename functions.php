<?php
/**
 * wtp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wtp
 */

if ( ! function_exists( 'wtp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wtp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wtp, use a find and replace
		 * to change 'wtp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wtp', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wtp' ),
			'menu-2' => esc_html__( 'Footer', 'wtp' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wtp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'wtp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wtp_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wtp_content_width', 640 );
}
add_action( 'after_setup_theme', 'wtp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wtp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wtp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wtp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wtp_widgets_init' );

/**
 * Register support for Gutenberg wide images in your theme
 */
function mytheme_setup() {
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

/**
 * Enqueue scripts and styles.
 */
function wtp_scripts() {
    wp_enqueue_style('wtp-theme-style', get_template_directory_uri().'/css/style.min.css', '', '2020-03-07-2');
	wp_enqueue_script( 'wtp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '2020-03-07-2', true );
	
	wp_enqueue_style('wtp-font', 'https://fonts.googleapis.com/css?family=Karla|Montserrat:300,700&display=swap', '', '2020-03-07-2');

	// if (!is_user_logged_in()) {
	// 	wp_enqueue_script( 'wtp-swup', get_template_directory_uri() . '/js/swup.min.js', array(), '2020-03-07-2', true );
	// 	wp_enqueue_script( 'wtp-swup-scroll', get_template_directory_uri() . '/js/SwupScrollPlugin.min.js', array(), '2020-03-07-2', true );
	// 	wp_enqueue_script( 'wtp-swup-init', get_template_directory_uri() . '/js/script.js', array(), '2020-03-07-2', true );
	// }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wtp_scripts' );

/**
 * Add Admin Style and Scripts
 */
function wtp_admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/style-admin.css');

	// extend gutenberg
	wp_enqueue_script( 'wtp-gutenberg-extension', get_template_directory_uri() . '/js/gutenberg-extension.js', array(), '2020-03-07-2', true );
}
add_action('admin_enqueue_scripts', 'wtp_admin_style');

/**
 * Defer Javascript
 */
function defer_parsing_of_js($url) {
	if (is_admin()) return $url; // don't break wp admin
	if (false === strpos($url, '.js')) return $url;
	// exclude defer for these files
	if (strpos($url, 'jquery.js')) return $url;
	if (strpos($url, 'swup.min.js')) return $url;
	if (strpos($url, 'gutenberg-extension.js')) return $url;
	
	return str_replace(' src', ' defer src', $url);
}
add_filter('script_loader_tag', 'defer_parsing_of_js', 10);



function my_deregister_scripts(){
	wp_dequeue_script( 'wp-embed' );
   }
add_action( 'wp_footer', 'my_deregister_scripts' );
 
/**
 * Remove Gutenberg Style
 * Addes via stylecow :)
 */
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );


/**
 * LE WALKER
 * Custom Navigation Classes
 */
class Le_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = array();
        if( !empty( $item->classes ) ) {
            $classes = (array) $item->classes;
        }

        $active_class = '';
        if( in_array('current-menu-item', $classes) ) {
            $active_class = 'active';
        } else if( in_array('current-menu-parent', $classes) ) {
            $active_class = 'active-parent';
        } else if( in_array('current-menu-ancestor', $classes) ) {
            $active_class = 'active-ancestor';
        }

        $parent_class = '';
        $parent_icon = '';
        if( in_array('menu-item-has-children', $classes) ) {
            $parent_class = 'dropdown';
        }

        $url = '';
        if( !empty( $item->url ) ) {
            $url = $item->url;
        }

        $output .= '
            <li class="nav__item  '. $active_class . ' ' . $parent_class . '">
                <a class="nav__link" href="' . $url . '">
                    ' . $item->title .$parent_icon .'
                </a>'
        ;
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '<p></p>', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '<p></p>', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);



/**
 * Override Custom Gutenberg Styles
 */
register_block_type(
	'cgb/block-wtp-plugin-block', array(
		// Enqueue blocks.style.build.css on both frontend & backend.
		// 'style'         => 'wtp_plugin_block-cgb-style-css',
		// Enqueue blocks.build.js in the editor only.
		'editor_script' => 'wtp_plugin_block-cgb-block-js',
		// Enqueue blocks.editor.build.css in the editor only.
		'editor_style'  => 'wtp_plugin_block-cgb-block-editor-css',
		// Render Callback
		'render_callback' => 'wtp_render_callback',
	)
);




function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
   }
   add_filter('upload_mimes', 'cc_mime_types');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

