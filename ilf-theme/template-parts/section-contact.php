<?php
/**
 * Template Part: Contact Strip Section
 */
if (!defined('ABSPATH')) exit;

$address = ilf_option('address', "20 Young Street\nHartlepool\nTS26 8BS\nEngland\nUnited Kingdom");
$phone   = ilf_option('phone', '+447446642464');
$email   = ilf_option('email', 'inloveandfaith2025@gmail.com');
?>

<section class="contact section-padding" id="contact">
  <div class="container">
    <div class="text-center">
      <span class="section-label">Reach Out</span>
      <h2 class="section-title">Get In Touch</h2>
      <p class="section-subtitle">Whether you need support, want to volunteer, or have questions about our work, we'd love to hear from you.</p>
    </div>

    <div class="contact-grid stagger-children">
      <div class="contact-card fade-in">
        <div class="contact-icon">📍</div>
        <h3>Our Address</h3>
        <p><?php echo nl2br(esc_html($address)); ?></p>
      </div>

      <div class="contact-card fade-in">
        <div class="contact-icon">📞</div>
        <h3>Phone</h3>
        <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
      </div>

      <div class="contact-card fade-in">
        <div class="contact-icon">✉️</div>
        <h3>Email</h3>
        <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
      </div>

      <div class="contact-card fade-in">
        <div class="contact-icon">🏦</div>
        <h3>Bank Details</h3>
        <p class="bank-details">
          <strong>ILF Charity</strong><br>
          Business Current<br>
          <span class="bank-acct">51839024</span><br>
          <span class="bank-sort">60-13-28</span>
        </p>
      </div>
    </div>
  </div>
</section>
