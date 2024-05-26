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
  $frontpage_ID = get_option('page_on_front');
  $posts_per_page = get_option('posts_per_page');

  get_header();

  while(have_posts()) {
    the_post();

    $halaman_ID = get_the_ID();
    $judul_halaman = get_the_title();
    $gambar_halaman = rsc_get_the_post_thumbnail_url($halaman_ID, false);
    $tautan_halaman = get_the_permalink();
    $terakhir_diperbarui = get_the_date();
?>
 
  <!-- Main -->
  <main id="rscMain" class="rsc-bg-white rsc-pb-16 sm:rsc-pb-[162px] md:rsc-pb-[250px] lg:rsc-pb-[260px]">
    <!-- Breadcrumb -->
    <section id="rscBreadcrumb" class="rsc-bg-white rsc-p-4">
      <div class="rsc-custom-container">
        <?php rsc_breadcrumb(); ?>
      </div>
    </section>

    <!-- Content -->
    <section class="rsc-bg-white rsc-px-4 rsc-pt-8 rsc-pb-12">
      <div class="rsc-custom-container">
        <div class="rsc-space-y-8">
          <div>
            <div class="rsc-grid rsc-grid-cols-1 rsc-gap-4 rsc-max-w-4xl rsc-mx-auto">
              <div>
                <div class="rsc-space-y-2">
                  <p class="rsc-section-subtitle"><?php echo esc_html('Terakhir diperbarui ' . $terakhir_diperbarui); ?></p>
                  <h1 class="rsc-section-title"><?php echo esc_html($judul_halaman); ?></h1>
                </div>
              </div>

              <!-- Image -->
              <?php if($gambar_halaman) { ?>
              <div>
                <img src="<?php echo esc_url($gambar_halaman); ?>" alt="" class="rsc-rounded-2xl rsc-object-cover rsc-object-center rsc-w-full rsc-h-auto" />
              </div>
              <?php } ?>

              <!-- Share to socmed -->
              <div>
                <div>
                  <nav class="rsc-widget-share-to-socmed">
                    <ul>
                      <li>
                        <span><?php echo __('Bagikan halaman:', 'rsc'); ?></span>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . $tautan_halaman); ?>" title="<?php echo __('Facebook', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-facebook fa-lg rsc-text-[#4267B2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . $judul_halaman . '&url=' . $tautan_halaman); ?>" title="<?php echo __('Twitter', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-twitter fa-lg rsc-text-[#1DA1F2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=&text=' . $judul_halaman . '%20-%20' . $tautan_halaman); ?>" title="<?php echo __('WhatsApp', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-whatsapp fa-lg rsc-text-[#25D366]"></i>
                        </a>
                      </li>
                      <li class="rsc-relative">
                        <a href="<?php echo esc_url($tautan_halaman); ?>" title="<?php echo __('Salin tautan', 'rsc'); ?>" class="rsc-copy-url">
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
              </div>

              <!-- Divider -->
              <div>
                <hr class="rsc-divider" />
              </div>

              <!-- Detail -->
              <div>
                <div class="rsc-space-y-8">
                  <!-- Content -->
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

              <!-- Divider -->
              <div>
                <hr class="rsc-divider" />
              </div>

              <!-- Share to socmed -->
              <div>
                <div>
                  <nav class="rsc-widget-share-to-socmed">
                    <ul>
                      <li>
                        <span><?php echo __('Bagikan halaman:', 'rsc'); ?></span>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . $tautan_halaman); ?>" title="<?php echo __('Facebook', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-facebook fa-lg rsc-text-[#4267B2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . $judul_halaman . '&url=' . $tautan_halaman); ?>" title="<?php echo __('Twitter', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-twitter fa-lg rsc-text-[#1DA1F2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=&text=' . $judul_halaman . '%20-%20' . $tautan_halaman); ?>" title="<?php echo __('WhatsApp', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-whatsapp fa-lg rsc-text-[#25D366]"></i>
                        </a>
                      </li>
                      <li class="rsc-relative">
                        <a href="<?php echo esc_url($tautan_halaman); ?>" title="<?php echo __('Salin tautan', 'rsc'); ?>" class="rsc-copy-url">
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