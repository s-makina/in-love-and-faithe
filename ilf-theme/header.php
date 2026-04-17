<?php
/**
 * Header Template
 */
if (!defined('ABSPATH')) exit;

$is_home = is_page_template('page-home.php');
$header_class = $is_home ? 'header header--alt' : 'header scrolled';
$home_url = home_url('/');

// Get custom logo
$logo_id = get_theme_mod('custom_logo');
$logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : ILF_URI . '/assets/images/logo.png';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo esc_url($logo_url); ?>" type="image/png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- ========== HEADER ========== -->
  <header class="<?php echo esc_attr($header_class); ?>" id="header">
    <div class="container">
      <a href="<?php echo esc_url($home_url); ?>" class="logo">
        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?> Logo">
        <span class="logo-text">
          <span class="logo-name">In Love &amp; Faith</span>
          <span class="logo-tagline">Charity No. <?php echo esc_html(ilf_option('charity_number', '1166693')); ?></span>
        </span>
      </a>

      <nav class="nav-links" id="nav-links">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new ILF_Nav_Walker(),
            'fallback_cb'    => function() {
                $home = home_url('/');
                echo '<a href="' . esc_url($home) . '">Home</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('about'))) . '">About Us</a>';
                echo '<a href="' . esc_url($home) . '#what-we-do">What We Do</a>';
                echo '<a href="' . esc_url($home) . '#trustees">Trustees</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '">Contact</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '" class="nav-cta">Support Us</a>';
            },
        ]);
        ?>
      </nav>

      <div class="hamburger" id="hamburger" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>
