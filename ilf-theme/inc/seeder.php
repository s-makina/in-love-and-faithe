<?php
/**
 * Content Seeder — Auto-populate theme with default content
 */
if (!defined('ABSPATH')) exit;

// ─── Admin Page ───────────────────────────────────────────────
function ilf_seeder_menu() {
    add_submenu_page(
        'ilf-settings',
        'Seed Content',
        'Seed Content',
        'manage_options',
        'ilf-seed',
        'ilf_seeder_page'
    );
}
add_action('admin_menu', 'ilf_seeder_menu');

function ilf_seeder_page() {
    $done = false;
    if (isset($_POST['ilf_seed']) && check_admin_referer('ilf_seed_action', 'ilf_seed_nonce')) {
        ilf_seed_content();
        $done = true;
    }
    ?>
    <div class="wrap">
        <h1>Seed Content</h1>
        <?php if ($done) : ?>
            <div class="notice notice-success"><p>Content seeded successfully! Pages, trustees, pillars, stats, and timeline items have been created.</p></div>
        <?php endif; ?>
        <p>Click the button below to auto-populate the theme with default content. This will create pages, trustees, pillars, impact stats, and timeline items.</p>
        <p><strong>Note:</strong> Existing content with the same titles will not be duplicated.</p>
        <form method="post">
            <?php wp_nonce_field('ilf_seed_action', 'ilf_seed_nonce'); ?>
            <input type="submit" name="ilf_seed" class="button button-primary button-hero" value="Seed Content">
        </form>
    </div>
    <?php
}

// ─── Helper: Create Post If Not Exists ────────────────────────
function ilf_create_post_if_not_exists($args) {
    $existing = get_page_by_title($args['post_title'], OBJECT, $args['post_type']);
    if ($existing) return $existing->ID;

    $post_id = wp_insert_post($args);
    return $post_id;
}

// ─── Seed Content ─────────────────────────────────────────────
function ilf_seed_content() {

    // ── Pages ─────────────────────────────────────────────────
    $pages = [
        ['title' => 'Home',    'template' => 'page-home.php'],
        ['title' => 'About',   'template' => 'page-about.php'],
        ['title' => 'Contact', 'template' => 'page-contact.php'],
    ];

    foreach ($pages as $i => $page) {
        $page_id = ilf_create_post_if_not_exists([
            'post_title'   => $page['title'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'menu_order'   => $i + 1,
        ]);
        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', $page['template']);
        }
    }

    // Set Home as front page
    $home_page = get_page_by_title('Home');
    if ($home_page) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }

    // ── Trustees ──────────────────────────────────────────────
    $trustees = [
        ['name' => 'Elizabeth Abiti Makwinja', 'initials' => 'EM', 'role' => 'Founder & Ambassador, Evangelist Missionary', 'date' => '', 'photo' => ILF_URI . '/assets/images/elizabeth-makwinja.jpeg'],
        ['name' => 'Joyce Banda',              'initials' => 'JB', 'role' => 'Trustee, H.E Former President of Republic of Malawi', 'date' => '', 'photo' => ILF_URI . '/assets/images/joyce-banda.jpeg'],
        ['name' => 'Marisa',                   'initials' => 'MA', 'role' => 'Secretary', 'date' => '', 'photo' => ILF_URI . '/assets/images/marisa.jpeg'],
        ['name' => 'Patience Chigumira',       'initials' => 'PC', 'role' => 'Treasurer', 'date' => '', 'photo' => ILF_URI . '/assets/images/patience-chigumira.jpeg'],
    ];

    foreach ($trustees as $i => $t) {
        $pid = ilf_create_post_if_not_exists([
            'post_title'  => $t['name'],
            'post_status' => 'publish',
            'post_type'   => 'ilf_trustee',
            'menu_order'  => $i + 1,
        ]);
        if ($pid && !is_wp_error($pid)) {
            update_post_meta($pid, '_ilf_trustee_initials', $t['initials']);
            update_post_meta($pid, '_ilf_trustee_role', $t['role']);
            update_post_meta($pid, '_ilf_trustee_date', $t['date']);
            update_post_meta($pid, '_ilf_trustee_photo', $t['photo']);
        }
    }

    // ── Pillars ───────────────────────────────────────────────
    $pillars = [
        [
            'title'      => 'HIV/AIDS Relief',
            'content'    => '<p>Providing relief of sickness for people living with HIV/AIDS and other long-term health conditions through grants, resources, and dedicated support programmes.</p>',
            'icon_emoji' => '🎗️',
            'icon_class' => 'health',
        ],
        [
            'title'      => 'Education & Awareness',
            'content'    => '<p>Delivering pre-school, primary, and secondary education to children, and raising public awareness about HIV/AIDS among individuals and those in positions of responsibility.</p>',
            'icon_emoji' => '📖',
            'icon_class' => 'education',
        ],
        [
            'title'      => 'Community Development',
            'content'    => '<p>Facilitating exchange programmes for care workers between the UK and developing countries, and supporting housing, disability services, and community wellbeing.</p>',
            'icon_emoji' => '🌐',
            'icon_class' => 'community',
        ],
    ];

    foreach ($pillars as $i => $p) {
        $pid = ilf_create_post_if_not_exists([
            'post_title'   => $p['title'],
            'post_content' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'ilf_pillar',
            'menu_order'   => $i + 1,
        ]);
        if ($pid && !is_wp_error($pid)) {
            update_post_meta($pid, '_ilf_pillar_icon_emoji', $p['icon_emoji']);
            update_post_meta($pid, '_ilf_pillar_icon_class', $p['icon_class']);
        }
    }

    // ── Impact Stats ──────────────────────────────────────────
    $stats = [
        ['title' => 'Lives Supported',  'number' => '500', 'suffix' => '+', 'icon' => '🎗️'],
        ['title' => 'Children Educated', 'number' => '200', 'suffix' => '+', 'icon' => '📚'],
        ['title' => 'Countries Reached', 'number' => '3',   'suffix' => '',  'icon' => '🌍'],
        ['title' => 'Grants Awarded',   'number' => '50',  'suffix' => '+', 'icon' => '🤝'],
    ];

    foreach ($stats as $i => $s) {
        $pid = ilf_create_post_if_not_exists([
            'post_title'  => $s['title'],
            'post_status' => 'publish',
            'post_type'   => 'ilf_stat',
            'menu_order'  => $i + 1,
        ]);
        if ($pid && !is_wp_error($pid)) {
            update_post_meta($pid, '_ilf_stat_number', $s['number']);
            update_post_meta($pid, '_ilf_stat_suffix', $s['suffix']);
            update_post_meta($pid, '_ilf_stat_icon', $s['icon']);
        }
    }

    // ── Timeline Items ────────────────────────────────────────
    $timeline = [
        [
            'title'   => 'Charity Founded',
            'year'    => '2016',
            'content' => '<p>In Love and Faith was officially registered with the Charity Commission for England and Wales under charity number 1166693, with a focus on HIV/AIDS relief, education, and general charitable purposes.</p>',
        ],
        [
            'title'   => 'Building the Foundation',
            'year'    => '2016 – 2024',
            'content' => '<p>The charity established its operational framework, developing programmes for health relief, educational support, and care worker exchange programmes between the UK and developing countries.</p>',
        ],
        [
            'title'   => 'Maria-Rosa Matunhike Appointed Trustee',
            'year'    => 'July 2024',
            'content' => '<p>Maria-Rosa Matunhike joined the board as trustee on 15 July 2024, strengthening the charity\'s governance and leadership.</p>',
        ],
        [
            'title'   => 'Board Expansion',
            'year'    => 'July 2025',
            'content' => '<p>Dr Joyce Banda and Patience Sibusiwe Chigumira were both appointed as trustees on 1 July 2025, bringing medical expertise and community development experience to the board.</p>',
        ],
        [
            'title'   => 'Annah Mvundura Joins',
            'year'    => 'November 2025',
            'content' => '<p>Annah Mvundura was appointed as trustee on 26 November 2025, further diversifying the board and expanding the charity\'s capacity for outreach.</p>',
        ],
        [
            'title'   => 'Looking Forward',
            'year'    => '2026',
            'content' => '<p>With a strengthened board and renewed focus, In Love and Faith continues to expand its reach, deepening its impact in HIV/AIDS relief, education, and international care worker exchange programmes.</p>',
        ],
    ];

    foreach ($timeline as $i => $t) {
        $pid = ilf_create_post_if_not_exists([
            'post_title'   => $t['title'],
            'post_content' => $t['content'],
            'post_status'  => 'publish',
            'post_type'    => 'ilf_timeline',
            'menu_order'   => $i + 1,
        ]);
        if ($pid && !is_wp_error($pid)) {
            update_post_meta($pid, '_ilf_timeline_year', $t['year']);
        }
    }

    // ── Primary Navigation Menu ───────────────────────────────
    $menu_name = 'Primary Navigation';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        if (!is_wp_error($menu_id)) {
            $home_page    = get_page_by_title('Home');
            $about_page   = get_page_by_title('About');
            $contact_page = get_page_by_title('Contact');

            if ($home_page) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'     => 'Home',
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $home_page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 1,
                ]);
            }

            if ($about_page) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'     => 'About Us',
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $about_page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 2,
                ]);
            }

            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title'    => 'What We Do',
                'menu-item-url'      => home_url('/#what-we-do'),
                'menu-item-type'     => 'custom',
                'menu-item-status'   => 'publish',
                'menu-item-position' => 3,
            ]);

            wp_update_nav_menu_item($menu_id, 0, [
                'menu-item-title'    => 'Trustees',
                'menu-item-url'      => home_url('/#trustees'),
                'menu-item-type'     => 'custom',
                'menu-item-status'   => 'publish',
                'menu-item-position' => 4,
            ]);

            if ($contact_page) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'     => 'Contact',
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $contact_page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 5,
                ]);

                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'     => 'Support Us',
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $contact_page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 6,
                    'menu-item-classes'   => 'nav-cta',
                ]);
            }

            // Assign to Primary location
            $locations = get_theme_mod('nav_menu_locations', []);
            $locations['primary'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
}
