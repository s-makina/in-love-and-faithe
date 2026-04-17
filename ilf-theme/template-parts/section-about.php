<?php
/**
 * Template Part: About Section (Homepage)
 */
if (!defined('ABSPATH')) exit;

$about_img_id = ilf_option('about_section_image');
$about_img_url = $about_img_id ? wp_get_attachment_image_url($about_img_id, 'about-thumb') : ILF_URI . '/assets/images/community.png';
$founded_year = ilf_option('founded_year', '2016');
?>

<section class="about section-padding" id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-image fade-in-left">
        <img src="<?php echo esc_url($about_img_url); ?>" alt="Community gathering and support activities">
        <div class="about-image-badge">
          <div class="number"><?php echo esc_html($founded_year); ?></div>
          <div class="label">Year Established</div>
        </div>
      </div>

      <div class="about-text fade-in-right">
        <span class="section-label">Who We Are</span>
        <h2>A Charity Built on Compassion and Purpose</h2>
        <p>In Love and Faith is a registered charity in England and Wales (No. <?php echo esc_html(ilf_option('charity_number', '1166693')); ?>), founded in <?php echo esc_html($founded_year); ?> with a clear mission: to relieve sickness, promote health, and transform lives through education and community support.</p>
        <p>We focus on those affected by HIV/AIDS and other long-term conditions, bridging gaps in healthcare and education between the UK and developing countries.</p>

        <div class="about-features">
          <div class="about-feature">
            <div class="about-feature-icon">🏥</div>
            <div>
              <h4>Health Relief</h4>
              <p>HIV/AIDS support and sickness relief</p>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">📚</div>
            <div>
              <h4>Education</h4>
              <p>Pre-school through secondary</p>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">🤝</div>
            <div>
              <h4>Advocacy</h4>
              <p>Advice and grants for individuals</p>
            </div>
          </div>
          <div class="about-feature">
            <div class="about-feature-icon">🌍</div>
            <div>
              <h4>Global Exchange</h4>
              <p>Care worker programmes</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
