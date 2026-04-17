<?php
/**
 * Footer Template
 */
if (!defined('ABSPATH')) exit;

$home_url = home_url('/');
$charity_number = ilf_option('charity_number', '1166693');
?>

  <!-- ========== FOOTER ========== -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-brand">
          <div class="logo-name">In Love &amp; Faith</div>
          <p><?php echo esc_html(ilf_option('footer_description', 'A UK-registered charity dedicated to the relief of sickness for those with HIV/AIDS, education, and community development since 2016.')); ?></p>
          <div class="charity-badge">
            ✦ &nbsp;Registered Charity No. <?php echo esc_html($charity_number); ?> — England &amp; Wales
          </div>
        </div>

        <div class="footer-nav">
          <h4>Pages</h4>
          <div class="footer-links">
            <?php
            if (has_nav_menu('footer-pages')) {
                wp_nav_menu([
                    'theme_location' => 'footer-pages',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new ILF_Nav_Walker(),
                ]);
            } else {
                echo '<a href="' . esc_url($home_url) . '">Home</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('about'))) . '">About Us</a>';
                echo '<a href="' . esc_url($home_url) . '#what-we-do">What We Do</a>';
                echo '<a href="' . esc_url($home_url) . '#trustees">Trustees</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '">Contact</a>';
            }
            ?>
          </div>
        </div>

        <div class="footer-nav">
          <h4>Focus Areas</h4>
          <div class="footer-links">
            <?php
            if (has_nav_menu('footer-focus')) {
                wp_nav_menu([
                    'theme_location' => 'footer-focus',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new ILF_Nav_Walker(),
                ]);
            } else {
                echo '<a href="' . esc_url($home_url) . '#what-we-do">HIV/AIDS Relief</a>';
                echo '<a href="' . esc_url($home_url) . '#what-we-do">Education</a>';
                echo '<a href="' . esc_url($home_url) . '#what-we-do">Community Support</a>';
                echo '<a href="' . esc_url($home_url) . '#what-we-do">Care Worker Exchange</a>';
            }
            ?>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2016–<?php echo esc_html(date('Y')); ?> In Love and Faith. All rights reserved.</p>
        <p>Registered Charity No. <?php echo esc_html($charity_number); ?></p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
