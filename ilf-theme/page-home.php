<?php
/**
 * Template Name: Home
 */
if (!defined('ABSPATH')) exit;

get_header();

// Get theme options
$hero_title_line1 = ilf_option('hero_title_line1', 'Compassion in Action,');
$hero_title_line2 = ilf_option('hero_title_line2', 'Hope in Every Life');
$hero_desc = ilf_option('hero_description', 'We are a UK-registered charity dedicated to HIV/AIDS relief, education, and bridging the gap between healthcare workers in the UK and developing countries.');
$charity_number = ilf_option('charity_number', '1166693');

// Hero images
$hero_main_id = ilf_option('hero_main_image');
$hero_edu_id  = ilf_option('hero_edu_image');
$hero_comm_id = ilf_option('hero_comm_image');

$hero_main_url = $hero_main_id ? wp_get_attachment_image_url($hero_main_id, 'hero-bg') : ILF_URI . '/assets/images/hero-banner.png';
$hero_edu_url  = $hero_edu_id ? wp_get_attachment_image_url($hero_edu_id, 'pillar-thumb') : ILF_URI . '/assets/images/education.png';
$hero_comm_url = $hero_comm_id ? wp_get_attachment_image_url($hero_comm_id, 'pillar-thumb') : ILF_URI . '/assets/images/community.png';
?>

  <!-- ========== HERO — SPLIT SCREEN LAYOUT ========== -->
  <section class="hero-split" id="home">
    <div class="hero-split__bg-pattern"></div>

    <div class="container">
      <div class="hero-split__grid">

        <!-- Left: Text Content -->
        <div class="hero-split__text">
          <div class="hero-split__charity-tag">
            <span class="tag-dot"></span>
            Registered Charity No. <?php echo esc_html($charity_number); ?>
          </div>

          <h1 class="hero-split__title">
            <?php echo esc_html($hero_title_line1); ?>
            <span class="hero-split__highlight"><?php echo esc_html($hero_title_line2); ?></span>
          </h1>

          <p class="hero-split__desc"><?php echo esc_html($hero_desc); ?></p>

          <div class="hero-split__actions">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="btn btn-primary">
              Discover Our Mission
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="btn btn-secondary">Contact Us</a>
          </div>

          <!-- Inline trust badges -->
          <div class="hero-split__trust">
            <div class="trust-item">
              <span class="trust-icon">🏛️</span>
              <span>Charity Commission<br><strong>Registered</strong></span>
            </div>
            <div class="trust-divider"></div>
            <div class="trust-item">
              <span class="trust-icon">📅</span>
              <span>Founded<br><strong><?php echo esc_html(ilf_option('founded_year', '2016')); ?></strong></span>
            </div>
            <div class="trust-divider"></div>
            <div class="trust-item">
              <span class="trust-icon">🌍</span>
              <span>UK &amp; Global<br><strong>Outreach</strong></span>
            </div>
          </div>
        </div>

        <!-- Right: Image Collage -->
        <div class="hero-split__visuals">
          <div class="hero-collage">
            <div class="collage-main">
              <img src="<?php echo esc_url($hero_main_url); ?>" alt="Healthcare workers providing care and support">
            </div>
            <div class="collage-stack">
              <div class="collage-sm collage-sm--top">
                <img src="<?php echo esc_url($hero_edu_url); ?>" alt="Children in a classroom learning">
              </div>
              <div class="collage-sm collage-sm--bottom">
                <img src="<?php echo esc_url($hero_comm_url); ?>" alt="Community development activities">
              </div>
            </div>
            <div class="collage-float-card">
              <div class="float-card__icon">🎗️</div>
              <div class="float-card__text">
                <strong>HIV/AIDS Relief</strong>
                <span>Primary Focus</span>
              </div>
            </div>
            <div class="collage-ring"></div>
            <div class="collage-dots"></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <?php
  // ── About Section
  get_template_part('template-parts/section', 'about');

  // ── What We Do (Pillars)
  get_template_part('template-parts/section', 'pillars');

  // ── Impact Numbers
  get_template_part('template-parts/section', 'impact');

  // ── Trustees
  get_template_part('template-parts/section', 'trustees');

  // ── Contact Strip
  get_template_part('template-parts/section', 'contact');
  ?>

<?php get_footer(); ?>
