<?php
/**
 * Template Name: About
 */
if (!defined('ABSPATH')) exit;

get_header();

$charity_number = ilf_option('charity_number', '1166693');

// About image
$about_img_id = ilf_option('about_image');
$about_img_url = $about_img_id ? wp_get_attachment_image_url($about_img_id, 'about-thumb') : ILF_URI . '/assets/images/health-relief.png';
?>

  <!-- ========== PAGE HERO ========== -->
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="sep">›</span>
        <span class="current">About Us</span>
      </div>
      <h1>About In Love &amp; Faith</h1>
      <p>A UK-registered charity committed to transforming lives through health, education, and compassionate community support since <?php echo esc_html(ilf_option('founded_year', '2016')); ?>.</p>
    </div>
  </section>

  <!-- ========== MISSION ========== -->
  <section class="about section-padding">
    <div class="container">
      <div class="about-grid">
        <div class="about-image fade-in-left">
          <img src="<?php echo esc_url($about_img_url); ?>" alt="Healthcare workers providing HIV/AIDS support">
          <div class="about-image-badge">
            <div class="number"><?php echo esc_html($charity_number); ?></div>
            <div class="label">Charity Number</div>
          </div>
        </div>

        <div class="about-text fade-in-right">
          <span class="section-label">Our Mission</span>
          <h2>Relieving Suffering, Building Futures</h2>
          <p>In Love and Faith was established with the belief that no one should face illness, lack of education, or isolation without support. We are a registered charity in England and Wales (No. <?php echo esc_html($charity_number); ?>), headquartered in Hartlepool.</p>
          <p>Our mission centres on the relief of sickness — particularly for those living with HIV/AIDS and other long-term conditions. We also work to bridge educational gaps and facilitate the exchange of care workers between the United Kingdom and developing countries.</p>
          <p>We exist to serve a wide range of beneficiaries: children, young people, the elderly, people with disabilities, and the general public — offering grants, human resources, advocacy, advice, and sponsoring vital research.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== TIMELINE ========== -->
  <?php
  $timeline = new WP_Query([
      'post_type'      => 'ilf_timeline',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
  ]);

  if ($timeline->have_posts()) :
  ?>
  <section class="section-padding" style="background: var(--clr-light);">
    <div class="container">
      <div class="text-center">
        <span class="section-label">Our Journey</span>
        <h2 class="section-title">The Story So Far</h2>
        <p class="section-subtitle">From registration to a growing board of trustees, our charity continues to expand its mission and reach.</p>
      </div>

      <div style="max-width: 680px; margin: 0 auto;">
        <div class="timeline">
          <?php while ($timeline->have_posts()) : $timeline->the_post();
            $year = get_post_meta(get_the_ID(), '_ilf_timeline_year', true);
          ?>
          <div class="timeline-item fade-in">
            <div class="year"><?php echo esc_html($year); ?></div>
            <h3><?php the_title(); ?></h3>
            <?php the_content(); ?>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
  <?php wp_reset_postdata(); endif; ?>

  <!-- ========== CHARITABLE OBJECTIVES ========== -->
  <section class="section-padding" style="background: var(--clr-white);">
    <div class="container">
      <div class="text-center">
        <span class="section-label">Our Purpose</span>
        <h2 class="section-title">Charitable Objectives</h2>
        <p class="section-subtitle">As defined in our governing documents and registered with the Charity Commission.</p>
      </div>

      <div class="pillars-grid stagger-children" style="max-width: 900px; margin: 0 auto;">
        <div class="pillar-card fade-in" style="overflow: visible;">
          <div class="pillar-card-body" style="padding-top: var(--space-lg);">
            <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--clr-red-ribbon),#e85d5d);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:var(--space-md);color:#fff;">🎗️</div>
            <h3>Relief of Sickness</h3>
            <p>Providing relief for people with HIV/AIDS and other long-term health conditions through direct support and grant-making.</p>
          </div>
        </div>

        <div class="pillar-card fade-in" style="overflow: visible;">
          <div class="pillar-card-body" style="padding-top: var(--space-lg);">
            <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--clr-gold),#E8A435);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:var(--space-md);color:#fff;">📚</div>
            <h3>Education</h3>
            <p>Educating the public and people in positions of responsibility regarding HIV/AIDS, and providing pre-school to secondary education for children.</p>
          </div>
        </div>

        <div class="pillar-card fade-in" style="overflow: visible;">
          <div class="pillar-card-body" style="padding-top: var(--space-lg);">
            <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--clr-terracotta),var(--clr-terracotta-lt));display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:var(--space-md);color:#fff;">🌐</div>
            <h3>General Charitable Purposes</h3>
            <p>Supporting health promotion, disability services, housing, community development, and facilitating care worker exchange programmes.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== TRUSTEES (DETAILED) ========== -->
  <?php get_template_part('template-parts/section', 'trustees'); ?>

<?php get_footer(); ?>
