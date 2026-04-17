<?php
/**
 * Custom Post Types & Taxonomies
 */
if (!defined('ABSPATH')) exit;

function ilf_register_post_types() {

    // ── Trustees ──────────────────────────────────────────────
    register_post_type('ilf_trustee', [
        'labels' => [
            'name'          => 'Trustees',
            'singular_name' => 'Trustee',
            'add_new_item'  => 'Add New Trustee',
            'edit_item'     => 'Edit Trustee',
            'all_items'     => 'All Trustees',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => 'ilf-settings',
        'supports'     => ['title', 'page-attributes'],
        'menu_icon'    => 'dashicons-groups',
        'has_archive'  => false,
    ]);

    // ── Pillars (What We Do) ──────────────────────────────────
    register_post_type('ilf_pillar', [
        'labels' => [
            'name'          => 'Pillars',
            'singular_name' => 'Pillar',
            'add_new_item'  => 'Add New Pillar',
            'edit_item'     => 'Edit Pillar',
            'all_items'     => 'All Pillars',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => 'ilf-settings',
        'supports'     => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'    => 'dashicons-heart',
        'has_archive'  => false,
    ]);

    // ── Impact Stats ──────────────────────────────────────────
    register_post_type('ilf_stat', [
        'labels' => [
            'name'          => 'Impact Stats',
            'singular_name' => 'Stat',
            'add_new_item'  => 'Add New Stat',
            'edit_item'     => 'Edit Stat',
            'all_items'     => 'All Stats',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => 'ilf-settings',
        'supports'     => ['title', 'page-attributes'],
        'menu_icon'    => 'dashicons-chart-bar',
        'has_archive'  => false,
    ]);

    // ── Timeline Items ────────────────────────────────────────
    register_post_type('ilf_timeline', [
        'labels' => [
            'name'          => 'Timeline',
            'singular_name' => 'Timeline Item',
            'add_new_item'  => 'Add New Timeline Item',
            'edit_item'     => 'Edit Timeline Item',
            'all_items'     => 'All Timeline Items',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => 'ilf-settings',
        'supports'     => ['title', 'editor', 'page-attributes'],
        'menu_icon'    => 'dashicons-backup',
        'has_archive'  => false,
    ]);
}
add_action('init', 'ilf_register_post_types');
