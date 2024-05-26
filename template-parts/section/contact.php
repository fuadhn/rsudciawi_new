<?php
/**
 * Template parts
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // Kontak
  $panggilan_darurat = get_option('rsc_kontak_panggilan_darurat');
  $panggilan_operator = get_option('rsc_kontak_panggilan_operator');
  $layanan_sms = get_option('rsc_kontak_layanan_sms');
?>

<section id="rscContact">
  <div class="rsc-custom-container">
    <div class="rsc-grid rsc-grid-cols-1 md:rsc-grid-cols-3 rsc-gap-8 md:rsc-gap-4">
      <div class="rsc-col-span-1">
        <div class="rsc-contact-item">
          <div>
            <i class="fa-solid fa-phone-volume fa-2xl rsc-text-rscsecondary"></i>
          </div>
          <div class="rsc-space-y-1">
            <p class="rsc-label"><?php echo __('Panggilan Darurat', 'rsc'); ?></p>
            <h4 class="rsc-text"><?php echo esc_html(($panggilan_darurat ? $panggilan_darurat : '&mdash;')); ?></h4>
          </div>
        </div>
      </div>
      <div class="rsc-col-span-1">
        <div class="rsc-contact-item">
          <div>
            <i class="fa-solid fa-headset fa-2xl rsc-text-rscsecondary"></i>
          </div>
          <div class="rsc-space-y-1">
            <p class="rsc-label"><?php echo __('Panggilan Operator', 'rsc'); ?></p>
            <h4 class="rsc-text"><?php echo esc_html(($panggilan_operator ? $panggilan_operator : '&mdash;')); ?></h4>
          </div>
        </div>
      </div>
      <div class="rsc-col-span-1">
        <div class="rsc-contact-item">
          <div>
            <i class="fa-solid fa-envelope fa-2xl rsc-text-rscsecondary"></i>
          </div>
          <div class="rsc-space-y-1">
            <p class="rsc-label"><?php echo __('Layanan SMS', 'rsc'); ?></p>
            <h4 class="rsc-text"><?php echo esc_html(($layanan_sms ? $layanan_sms : '&mdash;')); ?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>