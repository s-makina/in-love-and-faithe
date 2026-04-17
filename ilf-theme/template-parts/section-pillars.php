<?php
/**
 * Template Part: What We Do — Pillars Section
 */
if (!defined('ABSPATH')) exit;

$pillars = new WP_Query([
    'post_type'      => 'ilf_pillar',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if (!$pillars->have_posts()) return;
?>

<section class="pillars section-padding" id="what-we-do">
  <div class="container">
    <div class="text-center">
      <span class="section-label">What We Do</span>
      <h2 class="section-title">Our Three Pillars of Impact</h2>
      <p class="section-subtitle">Through focused programmes in health, education, and community development, we work to create lasting change for individuals and families.</p>
    </div>

    <div class="pillars-grid stagger-children">
      <?php while ($pillars->have_posts()) : $pillars->the_post();
        $icon_class = get_post_meta(get_the_ID(), '_ilf_pillar_icon_class', true);
        $icon_emoji = get_post_meta(get_the_ID(), '_ilf_pillar_icon_emoji', true);
        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'pillar-thumb');
      ?>
      <div class="pillar-card fade-in">
        <?php if ($thumb_url) : ?>
        <div class="pillar-card-image">
          <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
          <?php if ($icon_emoji) : ?>
          <div class="pillar-icon <?php echo esc_attr($icon_class); ?>"><?php echo esc_html($icon_emoji); ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="pillar-card-body">
          <h3><?php the_title(); ?></h3>
          <?php the_content(); ?>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
