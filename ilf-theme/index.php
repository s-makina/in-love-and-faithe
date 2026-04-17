<?php
/**
 * Fallback Template
 *
 * Template Name: Default
 */
if (!defined('ABSPATH')) exit;

get_header();
?>

  <section class="page-hero">
    <div class="container">
      <?php if (!is_front_page()) : ?>
      <div class="breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="sep">›</span>
        <span class="current"><?php the_title(); ?></span>
      </div>
      <?php endif; ?>
      <h1><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section-padding" style="background: var(--clr-white);">
    <div class="container">
      <?php
      if (have_posts()) :
          while (have_posts()) : the_post();
              the_content();
          endwhile;
      endif;
      ?>
    </div>
  </section>

<?php get_footer(); ?>
