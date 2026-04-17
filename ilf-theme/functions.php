<?php
/**
 * In Love and Faith Theme Functions
 */

if (!defined('ABSPATH')) exit;

define('ILF_VERSION', '1.0.0');
define('ILF_DIR', get_template_directory());
define('ILF_URI', get_template_directory_uri());

// ─── Theme Setup ──────────────────────────────────────────────
function ilf_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 48,
        'width'       => 48,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    register_nav_menus([
        'primary'      => __('Primary Navigation', 'ilf'),
        'footer-pages' => __('Footer Pages', 'ilf'),
        'footer-focus' => __('Footer Focus Areas', 'ilf'),
    ]);

    add_image_size('hero-bg', 1920, 1080, true);
    add_image_size('pillar-thumb', 800, 500, true);
    add_image_size('about-thumb', 800, 450, true);
}
add_action('after_setup_theme', 'ilf_setup');

// ─── Enqueue Styles & Scripts ─────────────────────────────────
function ilf_enqueue_assets() {
    wp_enqueue_style('ilf-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap', [], null);
    wp_enqueue_style('ilf-main', ILF_URI . '/assets/css/main.css', [], ILF_VERSION);

    if (is_page_template('page-home.php')) {
        wp_enqueue_style('ilf-hero-alt', ILF_URI . '/assets/css/hero-alt.css', ['ilf-main'], ILF_VERSION);
    }

    wp_enqueue_script('ilf-main', ILF_URI . '/assets/js/main.js', [], ILF_VERSION, true);
}
add_action('wp_enqueue_scripts', 'ilf_enqueue_assets');

// ─── Include Files ────────────────────────────────────────────
require_once ILF_DIR . '/inc/post-types.php';
require_once ILF_DIR . '/inc/meta-boxes.php';
require_once ILF_DIR . '/inc/theme-options.php';
require_once ILF_DIR . '/inc/seeder.php';

// ─── Helper: Get Theme Option ─────────────────────────────────
function ilf_option($key, $default = '') {
    $options = get_option('ilf_options', []);
    return isset($options[$key]) ? $options[$key] : $default;
}

// ─── Custom Nav Walker ────────────────────────────────────────
class ILF_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $is_current = in_array('current-menu-item', $item->classes) ? ' class="active"' : '';
        $is_cta = in_array('nav-cta', $item->classes) ? true : false;
        $class_attr = $is_cta ? ' class="nav-cta"' : $is_current;
        $output .= '<a href="' . esc_url($item->url) . '"' . $class_attr . '>' . esc_html($item->title) . '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = null) {}
    function start_lvl(&$output, $depth = 0, $args = null) {}
    function end_lvl(&$output, $depth = 0, $args = null) {}
}

// ─── Excerpt Length ───────────────────────────────────────────
function ilf_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'ilf_excerpt_length');
