<?php
/**
 * Displays the site footer.
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // CTA Konsultasi
  $judul_konsultasi = get_option('rsc_cta_konsultasi_judul');
  $tautan_konsultasi = get_option('rsc_cta_konsultasi_tautan');

  // Catatan Kaki
  $catatan_kaki = get_option('rsc_catatan_kaki_konten');

  // Logo
  $home_url = home_url();
  $logo_url = wp_get_attachment_url(get_theme_mod('custom_logo'));

  // Kontak
  $whatsapp = get_option('rsc_kontak_whatsapp');
  $email = get_option('rsc_kontak_email');
  $telepon = get_option('rsc_kontak_telepon');

  // footer_1
  $has_footer_1_menu = has_nav_menu('footer_1');

  $footer_1_menu_name = "";
  $footer_1_menu_items = array();

  if($has_footer_1_menu) {
    $locations = get_nav_menu_locations();
    $footer_1_menu = get_term($locations['footer_1'], 'nav_menu');
    $footer_1_menu_items = wp_get_nav_menu_items($footer_1_menu->term_id);

    $footer_1_menu_name = $footer_1_menu->name;
  }

  // footer_2
  $has_footer_2_menu = has_nav_menu('footer_2');

  $footer_2_menu_name = "";
  $footer_2_menu_items = array();

  if($has_footer_2_menu) {
    $locations = get_nav_menu_locations();
    $footer_2_menu = get_term($locations['footer_2'], 'nav_menu');
    $footer_2_menu_items = wp_get_nav_menu_items($footer_2_menu->term_id);

    $footer_2_menu_name = $footer_2_menu->name;
  }

  // Unduh
  $label_unduh = get_option('rsc_download_label');
  $google_play_url = get_option('rsc_download_google_play');
  $app_store_url = get_option('rsc_download_app_store');

  // Copyright
  $copyright_teks = get_option('rsc_copyright_teks');
  
  // Whatsapp Teks
  $whatsapp_teks = "";
  $whatsapp_umum = get_option('rsc_whatsapp_teks');
  $whatsapp_teks_layanan = get_option('rsc_whatsapp_teks_layanan');

  $whatsapp_teks = $whatsapp_umum;

  // if(is_singular('layanan')) {
  //   $whatsapp_teks = str_replace('%judul_layanan%', get_the_title(), $whatsapp_teks_layanan);
  // } else {
  //   $whatsapp_teks = $whatsapp_umum;
  // }
?>

<!-- Floating WhatsApp -->
<?php if($whatsapp) { ?>
<div class="rsc-fixed rsc-bottom-4 rsc-right-4 rsc-z-50">
  <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=' . rsc_get_formatted_phone_number($whatsapp) . '&text=' . $whatsapp_teks); ?>" target="_blank">
    <button type="button" class="rsc-floating-whatsapp">
      <i class="fa-brands fa-whatsapp fa-2xl"></i>
    </button>
  </a>
</div>
<?php } ?>
 
<footer id="rscFooter">
  <div class="rsc-space-y-8">
    <!-- Banner CTA -->
    <?php if($judul_konsultasi && $tautan_konsultasi) { ?>
    <div class="rsc-px-0 sm:rsc-px-4">
      <div class="rsc-custom-container">
        <div class="rsc-footer-cta">
          <div class="rsc-footer-wrap">
            <div class="rsc-grow">
              <div class="rsc-content">
                <h2 class="rsc-title"><?php echo esc_html($judul_konsultasi); ?></h2>
                
                <div>
                  <a href="<?php echo esc_url($tautan_konsultasi); ?>" target="_blank">
                    <button type="button" class="rsc-button medium center rounded rsc-mx-auto sm:rsc-mx-0">
                      <i class="fa-solid fa-comment-dots fa-lg rsc-text-rscprimary"></i>
                      <span><?php echo __('Buat Jadwal Konsultasi', 'rsc'); ?></span>
                    </button>
                  </a>
                </div>
              </div>
            </div>

            <div class="rsc-flex-none">
              <img width="auto" height="464" src="" data-image="<?php echo esc_url(get_template_directory_uri() . '/dist/img/banner-footer-photo.webp'); ?>" alt="" class="rsc-photo rsc-lazyload" />

              <noscript>
                <img width="auto" height="464" src="<?php echo esc_url(get_template_directory_uri() . '/dist/img/banner-footer-photo.webp'); ?>" alt="" class="rsc-photo" />
              </noscript>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } else { ?>
    <div class="rsc-mt-24"></div>
    <?php } ?>

    <!-- Mitra -->
    <?php if($catatan_kaki) { ?>
    <div class="rsc-px-4 -rsc-top-16 rsc-relative">
      <div class="rsc-custom-container">
        <article class="rsc-footer-desc">
          <?php echo $catatan_kaki; ?>
        </article>
      </div>
    </div>
    <?php } ?>

    <!-- Divider -->
    <div class="rsc-px-4 -rsc-top-16 rsc-relative">
      <div class="rsc-custom-container">
        <hr class="rsc-divider" />
      </div>
    </div>

    <!-- Menu -->
    <div class="rsc-px-4 -rsc-top-16 rsc-relative">
      <div class="rsc-custom-container">
        <div class="rsc-grid rsc-grid-cols-1 sm:rsc-grid-cols-2 lg:rsc-grid-cols-4 rsc-gap-8 sm:rsc-gap-16 lg:rsc-gap-4">
          <!-- Column 1 -->
          <div>
            <div class="rsc-space-y-4">
              <!-- Logo -->
              <div>
                <a href="<?php echo esc_url($home_url); ?>">
                  <img width="167" height="48" src="" data-image="<?php echo esc_url(($logo_url ? $logo_url : rsc_get_default_logo_url())); ?>" alt="" class="rsc-logo rsc-lazyload" />
            
                  <noscript>
                    <img width="167" height="48" src="<?php echo esc_url(($logo_url ? $logo_url : rsc_get_default_logo_url())); ?>" alt="" class="rsc-logo" />
                  </noscript>
                </a>
              </div>

              <!-- Contact -->
              <div>
                <nav class="rsc-contact-nav">
                  <ul>
                    <li>
                      <div class="rsc-flex-none">
                        <div class="rsc-icon">
                          <i class="fa-brands fa-whatsapp fa-lg"></i>
                        </div>
                      </div>
                      <div class="rsc-grow">
                        <div class="rsc-space-y-1">
                          <h5 class="rsc-label"><?php echo __('WhatsApp', 'rsc'); ?></h5>
                          <p class="rsc-text"><?php echo esc_html(($whatsapp ? $whatsapp : '&mdash;')); ?></p>
                        </div>  
                      </div>
                    </li>
                    <li>
                      <div class="rsc-flex-none">
                        <div class="rsc-icon">
                          <i class="fa-solid fa-envelope"></i>
                        </div>
                      </div>
                      <div class="rsc-grow">
                        <div class="rsc-space-y-1">
                          <h5 class="rsc-label"><?php echo __('Email', 'rsc'); ?></h5>
                          <p class="rsc-text"><?php echo esc_html(($email ? $email : '&mdash;')); ?></p>
                        </div>  
                      </div>
                    </li>
                    <li>
                      <div class="rsc-flex-none">
                        <div class="rsc-icon">
                          <i class="fa-solid fa-phone"></i>
                        </div>
                      </div>
                      <div class="rsc-grow">
                        <div class="rsc-space-y-1">
                          <h5 class="rsc-label"><?php echo __('Telepon', 'rsc'); ?></h5>
                          <p class="rsc-text"><?php echo esc_html(($telepon ? $telepon : '&mdash;')); ?></p>
                        </div>  
                      </div>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>

          <!-- Column 2 -->
          <?php if($has_footer_1_menu) { ?>
          <div>
            <div class="rsc-space-y-4">
              <h4 class="rsc-footer-label"><?php echo esc_html($footer_1_menu_name); ?></h4>

              <nav class="rsc-footer-nav">
                <ul>
                  <?php
                    $html_footer_1_menu = "";

                    foreach($footer_1_menu_items as $menu_item) {
                      $link = $menu_item->url;
                      $title = $menu_item->title;
                      $target = $menu_item->target;
                      $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);

                      if($is_parent) {
                        $html_footer_1_menu .= '<li>' . "\n";
                        $html_footer_1_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                        $html_footer_1_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                        $html_footer_1_menu .= '</a>' . "\n";
                        $html_footer_1_menu .= '</li>' . "\n";
                      }
                    }

                    echo $html_footer_1_menu;
                  ?>
                </ul>
              </nav>
            </div>
          </div>
          <?php } ?>

          <!-- Column 3 -->
          <?php if($has_footer_2_menu) { ?>
          <div>
            <div class="rsc-space-y-4">
              <h4 class="rsc-footer-label"><?php echo esc_html($footer_2_menu_name); ?></h4>

              <nav class="rsc-footer-nav">
                <ul>
                  <?php
                    $html_footer_2_menu = "";

                    foreach($footer_2_menu_items as $menu_item) {
                      $link = $menu_item->url;
                      $title = $menu_item->title;
                      $target = $menu_item->target;
                      $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);

                      if($is_parent) {
                        $html_footer_2_menu .= '<li>' . "\n";
                        $html_footer_2_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                        $html_footer_2_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                        $html_footer_2_menu .= '</a>' . "\n";
                        $html_footer_2_menu .= '</li>' . "\n";
                      }
                    }

                    echo $html_footer_2_menu;
                  ?>
                </ul>
              </nav>
            </div>
          </div>
          <?php } ?>

          <!-- Column 4 -->
          <?php if($google_play_url || $app_store_url) { ?>
          <div>
            <div class="rsc-space-y-4">
              <h4 class="rsc-footer-label"><?php echo ($label_unduh ? esc_html($label_unduh) : '&nbsp;'); ?></h4>

              <div class="rsc-space-y-2">
                <!-- Google play badge -->
                <?php if($google_play_url) { ?>
                <div>
                  <a href="<?php echo esc_url($google_play_url); ?>" target="_blank">
                    <img width="156" height="60" src="" data-image="<?php echo esc_url(get_template_directory_uri() . '/dist/img/google-play-badge.webp'); ?>" alt="" class="rsc-w-auto rsc-h-[60px] rsc-lazyload" />

                    <noscript>
                      <img width="156" height="60" src="<?php echo esc_url(get_template_directory_uri() . '/dist/img/google-play-badge.webp'); ?>" alt="" class="rsc-w-auto rsc-h-[60px]" />
                    </noscript>
                  </a>
                </div>
                <?php } ?>
                
                <!-- App store badge -->
                <?php if($app_store_url) { ?>
                <div>
                  <a href="<?php echo esc_url($app_store_url); ?>" target="_blank">
                    <img width="150" height="50" src="" data-image="<?php echo esc_url(get_template_directory_uri() . '/dist/img/app-store-badge.svg'); ?>" alt="" class="rsc-w-auto rsc-h-[50px] rsc-lazyload" />

                    <noscript>
                      <img width="150" height="50" src="<?php echo esc_url(get_template_directory_uri() . '/dist/img/app-store-badge.svg'); ?>" alt="" class="rsc-w-auto rsc-h-[50px]" />
                    </noscript>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="rsc-bg-rscprimary rsc-px-4 rsc-py-2">
    <div class="rsc-custom-container">
      <div class="rsc-flex rsc-flex-row rsc-gap-4 rsc-justify-center">
        <p class="rsc-copyright-text"><?php echo ($copyright_teks ? esc_html($copyright_teks) : __('&copy; Copyright 2024, Rumah Sakit Umum Daerah Ciawi.', 'rsc')); ?></p>
      </div>
    </div>
  </div>
</footer>