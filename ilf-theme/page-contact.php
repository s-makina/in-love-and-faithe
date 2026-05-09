<?php
/**
 * Template Name: Contact
 */
if (!defined('ABSPATH')) exit;

get_header();

$charity_number = ilf_option('charity_number', '1166693');
$address        = ilf_option('address', "20 Young Street\nHartlepool\nTS26 8BS\nEngland\nUnited Kingdom");
$phone          = ilf_option('phone', '+447446642464');
$email          = ilf_option('email', 'inloveandfaith2025@gmail.com');
$office_hours   = ilf_option('office_hours', "Monday – Friday: 9:00 AM – 5:00 PM\nSaturday & Sunday: Closed");
$cf7_shortcode  = ilf_option('cf7_shortcode', '');
?>

  <!-- ========== PAGE HERO ========== -->
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="sep">›</span>
        <span class="current">Contact</span>
      </div>
      <h1>Contact Us</h1>
      <p>We'd love to hear from you. Whether you need support, want to get involved, or simply have a question — reach out.</p>
    </div>
  </section>

  <!-- ========== CONTACT INFO ========== -->
  <section class="section-padding" style="background: var(--clr-white);">
    <div class="container">
      <div class="contact-page-grid">

        <!-- Left: Contact Details -->
        <div class="fade-in-left">
          <span class="section-label">Get In Touch</span>
          <h2 style="font-size: clamp(1.6rem, 3vw, 2.4rem); margin-bottom: var(--space-lg);">We're Here to Help</h2>
          <p style="color: var(--clr-text-light); margin-bottom: var(--space-xl); font-size: 1.05rem; line-height: 1.8;">
            In Love and Faith is based in Hartlepool, England. Whether you're seeking support, 
            looking to volunteer, or want to learn more about our charitable work in HIV/AIDS relief and education,
            please don't hesitate to get in touch.
          </p>

          <div class="contact-info-list">
            <div class="contact-info-item">
              <div class="icon-wrap">📍</div>
              <div>
                <h4>Registered Address</h4>
                <p><?php echo nl2br(esc_html($address)); ?></p>
              </div>
            </div>

            <div class="contact-info-item">
              <div class="icon-wrap">📞</div>
              <div>
                <h4>Phone</h4>
                <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" style="color: var(--clr-terracotta); font-weight: 500;"><?php echo esc_html($phone); ?></a></p>
              </div>
            </div>

            <div class="contact-info-item">
              <div class="icon-wrap">✉️</div>
              <div>
                <h4>Email</h4>
                <p><a href="mailto:<?php echo esc_attr($email); ?>" style="color: var(--clr-terracotta); font-weight: 500;"><?php echo esc_html($email); ?></a></p>
              </div>
            </div>

            <div class="contact-info-item">
              <div class="icon-wrap">🕐</div>
              <div>
                <h4>Office Hours</h4>
                <p><?php echo nl2br(esc_html($office_hours)); ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Registration Card + How We Can Help -->
        <div class="fade-in-right">
          <div class="registration-card" style="margin-bottom: var(--space-lg);">
            <h3>Official Registration</h3>
            <p>Registered with the Charity Commission for England and Wales.</p>
            <div class="reg-number"><?php echo esc_html($charity_number); ?></div>
            <p style="margin-top: var(--space-md); font-size: 0.9rem;">
              You can verify our registration on the 
              <a href="https://register-of-charities.charitycommission.gov.uk/charity-search/-/charity-details/5049706" target="_blank" rel="noopener noreferrer" style="color: var(--clr-gold-lt); text-decoration: underline;">
                Charity Commission website ↗
              </a>
            </p>
          </div>

          <div style="background: var(--clr-light); border-radius: var(--radius-lg); padding: var(--space-xl);">
            <h3 style="font-family: var(--ff-body); font-size: 1.1rem; font-weight: 700; color: var(--clr-navy); margin-bottom: var(--space-md);">How We Can Help</h3>
            <ul style="list-style: none; padding: 0;">
              <?php
              $help_items = [
                  'Grants for individuals affected by HIV/AIDS',
                  'Education support for children',
                  'Advocacy and advice services',
                  'Care worker exchange programmes',
                  'Disability and housing support',
                  'Volunteering opportunities',
              ];
              foreach ($help_items as $item) :
              ?>
              <li style="display: flex; align-items: flex-start; gap: var(--space-sm); padding: var(--space-sm) 0; color: var(--clr-text-light); font-size: 0.95rem;">
                <span style="color: var(--clr-terracotta); font-weight: 700;">✓</span>
                <?php echo esc_html($item); ?>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </section>

  <?php if (!empty($cf7_shortcode)) : ?>
  <!-- ========== CONTACT FORM ========== -->
  <section class="section-padding" style="background: var(--clr-light);">
    <div class="container">
      <div class="text-center">
        <span class="section-label">Send a Message</span>
        <h2 class="section-title">Get In Touch</h2>
      </div>
      <div style="max-width: 700px; margin: 0 auto;">
        <?php echo do_shortcode($cf7_shortcode); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ========== IMPORTANT NOTICE ========== -->
  <section style="background: var(--clr-light); padding: var(--space-xl) 0;">
    <div class="container">
      <div class="fade-in" style="background: var(--clr-white); border-radius: var(--radius-md); padding: var(--space-xl); border-left: 4px solid var(--clr-gold); max-width: 800px; margin: 0 auto;">
        <h3 style="font-family: var(--ff-body); font-size: 1rem; font-weight: 700; color: var(--clr-navy); margin-bottom: var(--space-sm);">⚠️ Please Note</h3>
        <p style="color: var(--clr-text-light); font-size: 0.95rem; line-height: 1.8; margin: 0;">
          <strong>In Love and Faith (Charity <?php echo esc_html($charity_number); ?>)</strong> is a separate and independent organisation from the Church of England's 
          "Living in Love and Faith" project, which addresses questions about relationships and sexuality within the church. 
          Our charity focuses specifically on HIV/AIDS relief, education, and community development.
        </p>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
