<?php
/**
 * Meta Boxes for Custom Post Types
 */
if (!defined('ABSPATH')) exit;

// ─── Register Meta Boxes ──────────────────────────────────────
function ilf_add_meta_boxes() {

    // Trustee fields
    add_meta_box('ilf_trustee_meta', 'Trustee Details', 'ilf_trustee_meta_cb', 'ilf_trustee', 'normal', 'high');

    // Pillar fields
    add_meta_box('ilf_pillar_meta', 'Pillar Details', 'ilf_pillar_meta_cb', 'ilf_pillar', 'normal', 'high');

    // Stat fields
    add_meta_box('ilf_stat_meta', 'Stat Details', 'ilf_stat_meta_cb', 'ilf_stat', 'normal', 'high');

    // Timeline fields
    add_meta_box('ilf_timeline_meta', 'Timeline Details', 'ilf_timeline_meta_cb', 'ilf_timeline', 'normal', 'high');
}
add_action('add_meta_boxes', 'ilf_add_meta_boxes');

// ─── Trustee Meta Box ─────────────────────────────────────────
function ilf_trustee_meta_cb($post) {
    wp_nonce_field('ilf_trustee_nonce', 'ilf_trustee_nonce_field');
    $initials = get_post_meta($post->ID, '_ilf_trustee_initials', true);
    $role     = get_post_meta($post->ID, '_ilf_trustee_role', true);
    $date     = get_post_meta($post->ID, '_ilf_trustee_date', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ilf_trustee_initials">Initials</label></th>
            <td><input type="text" id="ilf_trustee_initials" name="ilf_trustee_initials" value="<?php echo esc_attr($initials); ?>" class="regular-text" placeholder="e.g. MR"></td>
        </tr>
        <tr>
            <th><label for="ilf_trustee_role">Role</label></th>
            <td><input type="text" id="ilf_trustee_role" name="ilf_trustee_role" value="<?php echo esc_attr($role); ?>" class="regular-text" placeholder="e.g. Trustee"></td>
        </tr>
        <tr>
            <th><label for="ilf_trustee_date">Appointed Date</label></th>
            <td><input type="text" id="ilf_trustee_date" name="ilf_trustee_date" value="<?php echo esc_attr($date); ?>" class="regular-text" placeholder="e.g. 15 July 2024"></td>
        </tr>
    </table>
    <?php
}

// ─── Pillar Meta Box ──────────────────────────────────────────
function ilf_pillar_meta_cb($post) {
    wp_nonce_field('ilf_pillar_nonce', 'ilf_pillar_nonce_field');
    $icon_class = get_post_meta($post->ID, '_ilf_pillar_icon_class', true);
    $icon_emoji = get_post_meta($post->ID, '_ilf_pillar_icon_emoji', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ilf_pillar_icon_emoji">Icon Emoji</label></th>
            <td><input type="text" id="ilf_pillar_icon_emoji" name="ilf_pillar_icon_emoji" value="<?php echo esc_attr($icon_emoji); ?>" class="regular-text" placeholder="e.g. 🎗️"></td>
        </tr>
        <tr>
            <th><label for="ilf_pillar_icon_class">Icon CSS Class</label></th>
            <td>
                <select id="ilf_pillar_icon_class" name="ilf_pillar_icon_class">
                    <option value="">None</option>
                    <option value="health" <?php selected($icon_class, 'health'); ?>>Health (Red)</option>
                    <option value="education" <?php selected($icon_class, 'education'); ?>>Education (Gold)</option>
                    <option value="community" <?php selected($icon_class, 'community'); ?>>Community (Terracotta)</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// ─── Stat Meta Box ────────────────────────────────────────────
function ilf_stat_meta_cb($post) {
    wp_nonce_field('ilf_stat_nonce', 'ilf_stat_nonce_field');
    $number = get_post_meta($post->ID, '_ilf_stat_number', true);
    $suffix = get_post_meta($post->ID, '_ilf_stat_suffix', true);
    $icon   = get_post_meta($post->ID, '_ilf_stat_icon', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ilf_stat_number">Number</label></th>
            <td><input type="text" id="ilf_stat_number" name="ilf_stat_number" value="<?php echo esc_attr($number); ?>" class="regular-text" placeholder="e.g. 500"></td>
        </tr>
        <tr>
            <th><label for="ilf_stat_suffix">Suffix</label></th>
            <td><input type="text" id="ilf_stat_suffix" name="ilf_stat_suffix" value="<?php echo esc_attr($suffix); ?>" class="regular-text" placeholder="e.g. +"></td>
        </tr>
        <tr>
            <th><label for="ilf_stat_icon">Icon Emoji</label></th>
            <td><input type="text" id="ilf_stat_icon" name="ilf_stat_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text" placeholder="e.g. 🎗️"></td>
        </tr>
    </table>
    <?php
}

// ─── Timeline Meta Box ────────────────────────────────────────
function ilf_timeline_meta_cb($post) {
    wp_nonce_field('ilf_timeline_nonce', 'ilf_timeline_nonce_field');
    $year = get_post_meta($post->ID, '_ilf_timeline_year', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ilf_timeline_year">Year / Period</label></th>
            <td><input type="text" id="ilf_timeline_year" name="ilf_timeline_year" value="<?php echo esc_attr($year); ?>" class="regular-text" placeholder="e.g. 2016 or July 2024"></td>
        </tr>
    </table>
    <?php
}

// ─── Save Meta Boxes ──────────────────────────────────────────
function ilf_save_meta_boxes($post_id) {
    // Trustee
    if (isset($_POST['ilf_trustee_nonce_field']) && wp_verify_nonce($_POST['ilf_trustee_nonce_field'], 'ilf_trustee_nonce')) {
        if (isset($_POST['ilf_trustee_initials'])) update_post_meta($post_id, '_ilf_trustee_initials', sanitize_text_field($_POST['ilf_trustee_initials']));
        if (isset($_POST['ilf_trustee_role']))     update_post_meta($post_id, '_ilf_trustee_role', sanitize_text_field($_POST['ilf_trustee_role']));
        if (isset($_POST['ilf_trustee_date']))     update_post_meta($post_id, '_ilf_trustee_date', sanitize_text_field($_POST['ilf_trustee_date']));
    }

    // Pillar
    if (isset($_POST['ilf_pillar_nonce_field']) && wp_verify_nonce($_POST['ilf_pillar_nonce_field'], 'ilf_pillar_nonce')) {
        if (isset($_POST['ilf_pillar_icon_emoji'])) update_post_meta($post_id, '_ilf_pillar_icon_emoji', sanitize_text_field($_POST['ilf_pillar_icon_emoji']));
        if (isset($_POST['ilf_pillar_icon_class'])) update_post_meta($post_id, '_ilf_pillar_icon_class', sanitize_text_field($_POST['ilf_pillar_icon_class']));
    }

    // Stat
    if (isset($_POST['ilf_stat_nonce_field']) && wp_verify_nonce($_POST['ilf_stat_nonce_field'], 'ilf_stat_nonce')) {
        if (isset($_POST['ilf_stat_number'])) update_post_meta($post_id, '_ilf_stat_number', sanitize_text_field($_POST['ilf_stat_number']));
        if (isset($_POST['ilf_stat_suffix'])) update_post_meta($post_id, '_ilf_stat_suffix', sanitize_text_field($_POST['ilf_stat_suffix']));
        if (isset($_POST['ilf_stat_icon']))   update_post_meta($post_id, '_ilf_stat_icon', sanitize_text_field($_POST['ilf_stat_icon']));
    }

    // Timeline
    if (isset($_POST['ilf_timeline_nonce_field']) && wp_verify_nonce($_POST['ilf_timeline_nonce_field'], 'ilf_timeline_nonce')) {
        if (isset($_POST['ilf_timeline_year'])) update_post_meta($post_id, '_ilf_timeline_year', sanitize_text_field($_POST['ilf_timeline_year']));
    }
}
add_action('save_post', 'ilf_save_meta_boxes');
