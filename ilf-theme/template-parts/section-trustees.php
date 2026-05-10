<?php
/**
 * Template Part: Trustees Section
 */
if (!defined('ABSPATH')) exit;

$trustees = new WP_Query([
    'post_type'      => 'ilf_trustee',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if (!$trustees->have_posts()) return;

$is_about = is_page_template('page-about.php');
?>

<section class="trustees section-padding" id="trustees">
  <div class="container">
    <div class="text-center">
      <span class="section-label"><?php echo $is_about ? 'Our Leadership' : 'Leadership'; ?></span>
      <h2 class="section-title"><?php echo $is_about ? 'Board of Trustees' : 'Our Trustees'; ?></h2>
      <p class="section-subtitle">
        <?php echo $is_about
          ? 'Our trustees are responsible for the governance and strategic direction of In Love and Faith. Each brings unique experience and commitment to our mission.'
          : 'Our charity is governed by a committed board of trustees who bring diverse expertise and a shared passion for our mission.';
        ?>
      </p>
    </div>

    <div class="trustees-grid stagger-children">
      <?php $i = 1; while ($trustees->have_posts()) : $trustees->the_post();
        $initials   = get_post_meta(get_the_ID(), '_ilf_trustee_initials', true);
        $role       = get_post_meta(get_the_ID(), '_ilf_trustee_role', true);
        $date       = get_post_meta(get_the_ID(), '_ilf_trustee_date', true);
        $photo_url  = get_post_meta(get_the_ID(), '_ilf_trustee_photo', true);
        $thumb_id   = get_post_thumbnail_id(get_the_ID());
        $t_class    = 't' . (($i - 1) % 4 + 1);

        // Priority: featured image > photo meta > initials fallback
        $has_photo = false;
        if ($thumb_id) {
            $img_src = wp_get_attachment_image_url($thumb_id, 'trustee-photo');
            $has_photo = true;
        } elseif ($photo_url) {
            $img_src = $photo_url;
            $has_photo = true;
        }
      ?>
      <div class="trustee-card fade-in">
        <div class="trustee-avatar <?php echo esc_attr($t_class); ?><?php echo $has_photo ? ' has-photo' : ''; ?>">
          <?php if ($has_photo) : ?>
            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="trustee-photo">
          <?php else : ?>
            <?php echo esc_html($initials); ?>
          <?php endif; ?>
        </div>
        <h3><?php the_title(); ?></h3>
        <div class="trustee-role"><?php echo esc_html($role ?: 'Trustee'); ?></div>
        <?php if ($date) : ?>
        <div class="trustee-date">Appointed: <?php echo esc_html($date); ?></div>
        <?php endif; ?>
      </div>
      <?php $i++; endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
