<?php
/**
 * Theme Options Page
 */
if (!defined('ABSPATH')) exit;

// ─── Admin Menu ───────────────────────────────────────────────
function ilf_admin_menu() {
    add_menu_page(
        'In Love & Faith',
        'In Love & Faith',
        'manage_options',
        'ilf-settings',
        'ilf_settings_page',
        'dashicons-heart',
        3
    );
}
add_action('admin_menu', 'ilf_admin_menu');

// ─── Register Settings ───────────────────────────────────────
function ilf_register_settings() {
    register_setting('ilf_options_group', 'ilf_options', 'ilf_sanitize_options');
}
add_action('admin_init', 'ilf_register_settings');

function ilf_sanitize_options($input) {
    $sanitized = [];
    $text_fields = [
        'charity_number', 'founded_year', 'phone', 'email', 'address', 'office_hours',
        'hero_title_line1', 'hero_title_line2', 'hero_description',
        'footer_description', 'cf7_shortcode',
    ];
    foreach ($text_fields as $key) {
        $sanitized[$key] = isset($input[$key]) ? sanitize_text_field($input[$key]) : '';
    }

    // Textarea fields (allow newlines)
    $textarea_fields = ['address', 'office_hours', 'footer_description'];
    foreach ($textarea_fields as $key) {
        $sanitized[$key] = isset($input[$key]) ? sanitize_textarea_field($input[$key]) : '';
    }

    // Integer fields (image IDs)
    $int_fields = ['hero_main_image', 'hero_edu_image', 'hero_comm_image', 'about_image', 'about_section_image'];
    foreach ($int_fields as $key) {
        $sanitized[$key] = isset($input[$key]) ? absint($input[$key]) : 0;
    }

    // CF7 shortcode (allow brackets)
    if (isset($input['cf7_shortcode'])) {
        $sanitized['cf7_shortcode'] = wp_kses($input['cf7_shortcode'], []);
    }

    return $sanitized;
}

// ─── Settings Page ────────────────────────────────────────────
function ilf_settings_page() {
    $opts = get_option('ilf_options', []);
    ?>
    <div class="wrap">
        <h1>In Love &amp; Faith Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('ilf_options_group'); ?>

            <h2 class="title">General</h2>
            <table class="form-table">
                <tr>
                    <th><label for="charity_number">Charity Number</label></th>
                    <td><input type="text" id="charity_number" name="ilf_options[charity_number]" value="<?php echo esc_attr($opts['charity_number'] ?? '1166693'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="founded_year">Founded Year</label></th>
                    <td><input type="text" id="founded_year" name="ilf_options[founded_year]" value="<?php echo esc_attr($opts['founded_year'] ?? '2016'); ?>" class="regular-text"></td>
                </tr>
            </table>

            <h2 class="title">Contact Information</h2>
            <table class="form-table">
                <tr>
                    <th><label for="phone">Phone</label></th>
                    <td><input type="text" id="phone" name="ilf_options[phone]" value="<?php echo esc_attr($opts['phone'] ?? '07446 642 464'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="email">Email</label></th>
                    <td><input type="email" id="email" name="ilf_options[email]" value="<?php echo esc_attr($opts['email'] ?? 'inloveandfaith2025@gmail.com'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="address">Address</label></th>
                    <td><textarea id="address" name="ilf_options[address]" rows="4" class="large-text"><?php echo esc_textarea($opts['address'] ?? "20 Young Street\nHartlepool\nTS26 8BS\nUnited Kingdom"); ?></textarea></td>
                </tr>
                <tr>
                    <th><label for="office_hours">Office Hours</label></th>
                    <td><textarea id="office_hours" name="ilf_options[office_hours]" rows="3" class="large-text"><?php echo esc_textarea($opts['office_hours'] ?? "Monday – Friday: 9:00 AM – 5:00 PM\nSaturday & Sunday: Closed"); ?></textarea></td>
                </tr>
            </table>

            <h2 class="title">Hero Section</h2>
            <table class="form-table">
                <tr>
                    <th><label for="hero_title_line1">Hero Title (Line 1)</label></th>
                    <td><input type="text" id="hero_title_line1" name="ilf_options[hero_title_line1]" value="<?php echo esc_attr($opts['hero_title_line1'] ?? 'Compassion in Action,'); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th><label for="hero_title_line2">Hero Title (Line 2 — Gradient)</label></th>
                    <td><input type="text" id="hero_title_line2" name="ilf_options[hero_title_line2]" value="<?php echo esc_attr($opts['hero_title_line2'] ?? 'Hope in Every Life'); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th><label for="hero_description">Hero Description</label></th>
                    <td><textarea id="hero_description" name="ilf_options[hero_description]" rows="3" class="large-text"><?php echo esc_textarea($opts['hero_description'] ?? 'We are a UK-registered charity dedicated to HIV/AIDS relief, education, and bridging the gap between healthcare workers in the UK and developing countries.'); ?></textarea></td>
                </tr>
                <?php
                $img_fields = [
                    'hero_main_image'    => 'Hero Main Image',
                    'hero_edu_image'     => 'Hero Education Image',
                    'hero_comm_image'    => 'Hero Community Image',
                    'about_section_image' => 'About Section Image (Home)',
                    'about_image'        => 'About Page Image',
                ];
                foreach ($img_fields as $key => $label) :
                    $img_id = $opts[$key] ?? 0;
                    $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'thumbnail') : '';
                ?>
                <tr>
                    <th><label><?php echo esc_html($label); ?></label></th>
                    <td>
                        <input type="hidden" id="<?php echo esc_attr($key); ?>" name="ilf_options[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($img_id); ?>">
                        <div id="<?php echo esc_attr($key); ?>_preview" style="margin-bottom:8px;">
                            <?php if ($img_url) : ?>
                                <img src="<?php echo esc_url($img_url); ?>" style="max-width:150px;height:auto;border-radius:8px;">
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button ilf-upload-btn" data-target="<?php echo esc_attr($key); ?>">Choose Image</button>
                        <button type="button" class="button ilf-remove-btn" data-target="<?php echo esc_attr($key); ?>" <?php echo $img_id ? '' : 'style="display:none"'; ?>>Remove</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h2 class="title">Footer</h2>
            <table class="form-table">
                <tr>
                    <th><label for="footer_description">Footer Description</label></th>
                    <td><textarea id="footer_description" name="ilf_options[footer_description]" rows="3" class="large-text"><?php echo esc_textarea($opts['footer_description'] ?? 'A UK-registered charity dedicated to the relief of sickness for those with HIV/AIDS, education, and community development since 2016.'); ?></textarea></td>
                </tr>
            </table>

            <h2 class="title">Integrations</h2>
            <table class="form-table">
                <tr>
                    <th><label for="cf7_shortcode">Contact Form 7 Shortcode</label></th>
                    <td><input type="text" id="cf7_shortcode" name="ilf_options[cf7_shortcode]" value="<?php echo esc_attr($opts['cf7_shortcode'] ?? ''); ?>" class="large-text" placeholder='[contact-form-7 id="..." title="..."]'></td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Upload button
        $('.ilf-upload-btn').on('click', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            var frame = wp.media({ title: 'Select Image', multiple: false, library: { type: 'image' } });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + target).val(attachment.id);
                var thumb = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                $('#' + target + '_preview').html('<img src="' + thumb + '" style="max-width:150px;height:auto;border-radius:8px;">');
                $('[data-target="' + target + '"].ilf-remove-btn').show();
            });
            frame.open();
        });

        // Remove button
        $('.ilf-remove-btn').on('click', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('#' + target).val('');
            $('#' + target + '_preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

// Enqueue WP media uploader on settings page
function ilf_admin_enqueue($hook) {
    if ($hook === 'toplevel_page_ilf-settings') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'ilf_admin_enqueue');
