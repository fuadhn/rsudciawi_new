<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-front-page-templates/
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // Variabel
  $daftar_hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu');
  $daftar_waktu = array('pagi', 'siang', 'malam');

  // CTA Konsultasi
  $judul_konsultasi = get_option('rsc_cta_konsultasi_judul');
  $tautan_konsultasi = get_option('rsc_cta_konsultasi_tautan');

  // Alamat
  $foto_alamat = rsc_get_the_webp_image_url(wp_get_attachment_url(get_option('rsc_alamat_foto')), get_template_directory_uri() . '/dist/img/rsud-ciawi.jpg');
  $nama_alamat = (get_option('rsc_alamat_nama') ? get_option('rsc_alamat_nama') : get_bloginfo('title'));
  $lokasi_alamat = get_option('rsc_alamat_lokasi');
  $google_maps_alamat = (get_option('rsc_alamat_google_maps') ? get_option('rsc_alamat_google_maps') : 'https://www.google.com/maps/place/' . $lokasi_alamat . '/');

  // Catatan
  $catatan_pendaftaran = get_option('rsc_catatan_pendaftaran');

  get_header();

  while(have_posts()) {
    the_post();

    $dokter_ID = get_the_ID();
    $foto_dokter = rsc_get_the_webp_image_url((get_field('profil', $dokter_ID)['foto'] ? get_field('profil', $dokter_ID)['foto'] : ''), get_template_directory_uri() . '/dist/img/default-image.webp');
    $nama_dokter = get_the_title();
    $bidang_dokter = wp_get_object_terms($dokter_ID, 'bidang', array('fields' => 'names'));
    $tautan_dokter = get_the_permalink();
?>
 
  <!-- Main -->
  <main id="rscMain" class="rsc-bg-white rsc-pb-16 sm:rsc-pb-[162px] md:rsc-pb-[250px] lg:rsc-pb-[260px]">
    <!-- Breadcrumb -->
    <section class="rsc-bg-white rsc-p-4">
      <div class="rsc-custom-container">
        <?php rsc_breadcrumb(); ?>
      </div>
    </section>

    <!-- Content -->
    <section class="rsc-bg-white rsc-px-4 rsc-pt-8 rsc-pb-12">
      <div class="rsc-custom-container">
        <div class="rsc-space-y-8">
          <div>
            <div class="rsc-grid rsc-grid-cols-6 xl:rsc-grid-cols-4 rsc-gap-8 xl:rsc-gap-4">
              <!-- Detail -->
              <div class="rsc-col-span-6 lg:rsc-col-span-4 xl:rsc-col-span-3">
                <div class="rsc-space-y-8">
                  <!-- Profile -->
                  <div>
                    <div class="rsc-doctor-profile">
                      <div class="rsc-flex-none">
                        <img width="102" height="102" src="" data-image="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-photo rsc-lazyload" />

                        <noscript>
                          <img width="102" height="102" src="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-photo" />
                        </noscript>
                      </div>
                      <div class="rsc-grow">
                        <div class="rsc-space-y-0">
                          <h1 class="rsc-section-title"><?php echo esc_html($nama_dokter); ?></h1>
                          <p class="rsc-section-subtitle"><?php echo esc_html('Spesialis ' . $bidang_dokter[0]); ?></p>

                          <div class="rsc-block lg:rsc-hidden">
                            <button type="button" class="rsc-button primary-text no-padding rsc-scrollto" data-target="#rscJadwalPraktek" data-speed="0" data-minus="15">
                              <span><?php echo __('Jadwal Praktek', 'rsc'); ?></span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Divider -->
                  <div>
                    <hr class="rsc-divider" />
                  </div>

                  <!-- Article -->
                  <div>
                    <article class="rsc-content">
                      <?php
                        $the_content = apply_filters('the_content', get_the_content());
                        
                        if(!empty($the_content)) {
                          echo $the_content;
                        } else {
                          echo '<div class="rsc-content-empty">' . __('Mohon maaf, isi konten belum tersedia atau masih dalam proses penyuntingan.', 'rsc') . '</div>';
                        }
                      ?>
                    </article>
                  </div>
                </div>
              </div>

              <!-- Widget -->
              <div class="rsc-col-span-6 lg:rsc-col-span-2 xl:rsc-col-span-1">
                <!-- Share to socmed -->
                <div>
                  <nav class="rsc-widget-share-to-socmed">
                    <ul>
                      <li>
                        <span><?php echo __('Bagikan halaman:', 'rsc'); ?></span>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . $tautan_dokter); ?>" title="<?php echo __('Facebook', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-facebook fa-lg rsc-text-[#4267B2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . $nama_dokter . '&url=' . $tautan_dokter); ?>" title="<?php echo __('Twitter', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-twitter fa-lg rsc-text-[#1DA1F2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=&text=' . $nama_dokter . '%20-%20' . $tautan_dokter); ?>" title="<?php echo __('WhatsApp', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-whatsapp fa-lg rsc-text-[#25D366]"></i>
                        </a>
                      </li>
                      <li class="rsc-relative">
                        <a href="<?php echo esc_url($tautan_dokter); ?>" title="<?php echo __('Salin tautan', 'rsc'); ?>" class="rsc-copy-url">
                          <i class="fa-solid fa-link fa-lg"></i>
                        </a>

                        <div class="rsc-popup-message">
                          <div class="rsc-triangle"></div>

                          <div class="rsc-content">
                            <span class="rsc-text"><?php echo __('Tautan Disalin', 'rsc'); ?></span>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </nav>
                </div>

                <!-- Divider -->
                <div class="rsc-my-2">
                  <hr class="rsc-divider rsc-invisible">
                </div>

                <!-- Konsultasi -->
                <?php if($judul_konsultasi && $tautan_konsultasi) { ?>
                <div>
                  <a href="<?php echo esc_url($tautan_konsultasi); ?>" target="_blank">
                    <div class="rsc-widget-cta">
                      <h4 class="rsc-widget-title"><?php echo esc_html($judul_konsultasi); ?></h4>
                      
                      <button type="button" class="rsc-button-icon">
                        <i class="fa-solid fa-arrow-right rsc-animate-sliding"></i>
                      </button>
                    </div>
                  </a>
                </div>
                
                <!-- Divider -->
                <div class="rsc-my-4">
                  <hr class="rsc-divider">
                </div>
                <?php } ?>

                <!-- Jadwal Praktek -->
                <div id="rscJadwalPraktek" class="rsc-widget-wrap rsc-sticky rsc-top-[132.8px]">
                  <div class="rsc-space-y-4">
                    <!-- Title -->
                    <h4 class="rsc-widget-title"><?php echo __('Jadwal Praktek', 'rsc'); ?></h4>

                    <!-- Address -->
                    <?php if($lokasi_alamat) { ?>
                    <div>
                      <a href="<?php echo esc_url($google_maps_alamat); ?>" target="_blank">
                        <div class="rsc-address-item">
                          <div class="rsc-flex-none">
                            <img width="56" height="56" src="" data-image="<?php echo esc_url($foto_alamat); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />
                            
                            <noscript>
                              <img width="56" height="56" src="<?php echo esc_url($foto_alamat); ?>" alt="" class="rsc-thumbnail" />
                            </noscript>
                          </div>
                          <div class="rsc-grow">
                            <div class="rsc-space-y-1">
                              <h5 class="rsc-title"><?php echo esc_html($nama_alamat); ?></h5>
                              <p class="rsc-address"><?php echo esc_html($lokasi_alamat); ?></p>
                            </div>
                          </div>
                          <div class="rsc-flex-none">
                            <i class="fa-solid fa-map-location-dot fa-lg rsc-text-rscprimary"></i>
                          </div>
                        </div>
                      </a>
                    </div>

                    <!-- Divider -->
                    <div>
                      <hr class="rsc-divider">
                    </div>
                    <?php } ?>

                    <!-- List -->
                    <div class="rsc-space-y-4">
                      <?php
                        $jumlah_jadwal = 0;

                        // Menampilkan jadwal
                        foreach($daftar_hari as $hari) {
                          $jadwal_ditemukan = false;

                          $html = '<div>' . "\n";
                            $html .= '<div class="rsc-grid rsc-grid-cols-3 rsc-gap-2">' . "\n";
                              $html .= '<div class="rsc-col-span-1">' . "\n";
                                $html .= '<span class="rsc-text-gray-600">' . esc_html(ucfirst($hari)) . '</span>' . "\n";
                              $html .= '</div>' . "\n";
                              $html .= '<div class="rsc-col-span-2">' . "\n";
                                $html .= '<div class="rsc-space-y-2">' . "\n";

                                foreach($daftar_waktu as $waktu) {
                                  $jadwal_praktek = get_field('jadwal_praktek_' . $hari, $dokter_ID)[$waktu];
                                  
                                  if($jadwal_praktek['status']) {
                                    $jadwal_ditemukan = true;
                                    $jumlah_jadwal += 1;

                                    $html .= '<p class="rsc-text-right">' . esc_html('Pukul ' . $jadwal_praktek['mulai'] . ' - ' . $jadwal_praktek['selesai']) . '</p>';
                                  }
                                }

                                $html .= '</div>' . "\n";
                              $html .= '</div>' . "\n";
                            $html .= '</div>' . "\n";
                          $html .= '</div>' . "\n";

                          echo ($jadwal_ditemukan ? $html : '');
                        }

                        // Jika jadwal belum ditentukan
                        if($jumlah_jadwal === 0) {
                          $html = '<div>' . "\n";
                            $html .= '<span class="rsc-text-gray-600">' . __('Belum ada jadwal praktek.', 'rsc') . '</span>' . "\n";
                          $html .= '</div>' . "\n";

                          echo $html;
                        }
                      ?>
                    </div>

                    <!-- Divider -->
                    <?php if($catatan_pendaftaran) { ?>
                    <div>
                      <hr class="rsc-divider">
                    </div>

                    <!-- Notes -->
                    <div>
                      <p class="rsc-text-sm">
                        <span class="rsc-text-rscsecondary-third"><?php echo __('Catatan:', 'rsc'); ?></span>
                        <br />
                        <span class="rsc-text-gray-600"><?php echo esc_html($catatan_pendaftaran); ?></span>
                      </p>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
 
<?php
  }

  get_footer();
?>