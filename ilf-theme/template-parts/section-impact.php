<?php
/**
 * Template Part: Impact Numbers Section
 */
if (!defined('ABSPATH')) exit;

$stats = new WP_Query([
    'post_type'      => 'ilf_stat',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if (!$stats->have_posts()) return;
?>

<section class="impact section-padding" id="impact">
  <div class="container">
    <div class="text-center">
      <span class="section-label">Our Reach</span>
      <h2 class="section-title">Making a Difference</h2>
      <p class="section-subtitle">Since <?php echo esc_html(ilf_option('founded_year', '2016')); ?>, we have been working to relieve suffering and transform lives through targeted programmes and partnerships.</p>
    </div>

    <div class="impact-grid stagger-children">
      <?php while ($stats->have_posts()) : $stats->the_post();
        $number = get_post_meta(get_the_ID(), '_ilf_stat_number', true);
        $suffix = get_post_meta(get_the_ID(), '_ilf_stat_suffix', true);
        $icon   = get_post_meta(get_the_ID(), '_ilf_stat_icon', true);
      ?>
      <div class="impact-item fade-in">
        <?php if ($icon) : ?>
        <div class="icon"><?php echo esc_html($icon); ?></div>
        <?php endif; ?>
        <div class="number" data-count="<?php echo esc_attr($number); ?>"<?php if ($suffix) : ?> data-suffix="<?php echo esc_attr($suffix); ?>"<?php endif; ?>>0</div>
        <div class="label"><?php the_title(); ?></div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
