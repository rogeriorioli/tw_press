<?php
/**
 * WP Blank Theme functions and definitions
 *
 * @package WP_Blank
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function wp_blank_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Switch default core markup to valid HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Set up the WordPress core custom background feature
    add_theme_support('custom-background', [
        'default-color' => 'ffffff',
        'default-image' => '',
    ]);

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for block styles
    add_theme_support('wp-block-styles');

    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Navigation', 'wp-blank'),
        'footer'  => esc_html__('Footer Navigation', 'wp-blank'),
    ]);
}
add_action('after_setup_theme', 'wp_blank_setup');

// Set the content width in pixels
function wp_blank_content_width() {
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'wp_blank_content_width', 0);

// Enqueue scripts and styles
function wp_blank_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'wp-blank-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // Tailwind CSS (production)
    wp_enqueue_style(
        'wp-blank-tailwind',
        get_template_directory_uri() . '/dist/css/main.css',
        [],
        wp_get_theme()->get('Version')
    );

    // Main JavaScript
    wp_enqueue_script(
        'wp-blank-script',
        get_template_directory_uri() . '/dist/js/main.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    // Skip link focus fix for IE11
    wp_enqueue_script(
        'wp-blank-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wp_blank_scripts');

// Register widget areas
function wp_blank_widgets_init() {
    register_sidebar([
        'name'          => esc_html__('Primary Sidebar', 'wp-blank'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wp-blank'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-semibold mb-4">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => esc_html__('Footer Widgets', 'wp-blank'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add footer widgets here.', 'wp-blank'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold mb-3">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'wp_blank_widgets_init');

// Custom excerpt length
function wp_blank_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'wp_blank_excerpt_length');

// Custom excerpt more
function wp_blank_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wp_blank_excerpt_more');

// Add custom class to body
function wp_blank_body_classes($classes) {
    // Add a class of hfeed to non-singular pages
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter('body_class', 'wp_blank_body_classes');

// Pingback header
function wp_blank_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'wp_blank_pingback_header');

// Remove WordPress version info for security
remove_action('wp_head', 'wp_generator');

// Clean up WordPress head
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// Custom function to get post navigation
function wp_blank_post_navigation() {
    the_posts_navigation([
        'prev_text' => '&larr; ' . __('Older posts', 'wp-blank'),
        'next_text' => __('Newer posts', 'wp-blank') . ' &rarr;',
    ]);
}

// Custom function to display breadcrumbs
function wp_blank_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="breadcrumbs text-sm text-gray-600 mb-6" aria-label="Breadcrumbs">';
    echo '<ul class="flex items-center space-x-2">';
    
    echo '<li><a href="' . home_url() . '" class="hover:text-gray-900">Home</a></li>';
    
    if (is_category() || is_single()) {
        echo '<li><span class="mx-2">/</span></li>';
        if (is_single()) {
            the_category(' <span class="mx-2">/</span> ');
            echo '<li><span class="mx-2">/</span></li>';
            echo '<li class="text-gray-900">' . get_the_title() . '</li>';
        } else {
            echo '<li class="text-gray-900">' . single_cat_title('', false) . '</li>';
        }
    } elseif (is_page()) {
        echo '<li><span class="mx-2">/</span></li>';
        echo '<li class="text-gray-900">' . get_the_title() . '</li>';
    }
    
    echo '</ul>';
    echo '</nav>';
} 