<?php
/**
 * Template parts
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // Variabel
  $frontpage_ID = get_option('page_on_front');

  // Kolom
  $kolom_1 = get_field('kolom_1', $frontpage_ID);
  $kolom_2 = get_field('kolom_2', $frontpage_ID);
  $kolom_3 = get_field('kolom_3', $frontpage_ID);
  
  // Tentang
  $tentang = get_field('tentang', $frontpage_ID);
?>

<section id="rscAbout">
  <div class="rsc-space-y-8 lg:rsc-space-y-16">
    <!-- Cards -->
    <div class="rsc-px-0 sm:rsc-px-4">
      <div class="rsc-custom-container">
        <div class="rsc-grid rsc-grid-cols-1 lg:rsc-grid-cols-3 rsc-gap-0 rsc-relative -rsc-top-16">
          <?php if($kolom_1 && $kolom_2 && $kolom_3) { ?>
          <!-- Kolom 1 -->
          <div class="rsc-col-span-1">
            <div class="rsc-about-card first">
              <div class="rsc-space-y-4">
                <div class="rsc-space-y-2">
                  <h3 class="rsc-title"><?php echo esc_html($kolom_1['judul']); ?></h3>
                  <p class="rsc-desc"><?php echo esc_html($kolom_1['deskripsi_singkat']); ?></p>
                </div>

                <?php if($kolom_1['aktifkan_tombol_kolom']) { ?>
                <div>
                  <a href="<?php echo esc_url($kolom_1['tombol_kolom']['tautan']); ?>" target="<?php echo esc_attr($kolom_1['tombol_kolom']['target'] ? '_blank' : ''); ?>">
                    <button type="button" class="rsc-button secondary-text medium">
                      <span><?php echo esc_html($kolom_1['tombol_kolom']['teks']); ?></span>
                      <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
                    </button>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- Kolom 2 -->
          <div class="rsc-col-span-1">
            <div class="rsc-about-card second">
              <div class="rsc-space-y-4">
                <div class="rsc-space-y-2">
                  <h3 class="rsc-title"><?php echo esc_html($kolom_2['judul']); ?></h3>
                  <p class="rsc-desc"><?php echo esc_html($kolom_2['deskripsi_singkat']); ?></p>
                </div>

                <?php if($kolom_2['aktifkan_tombol_kolom']) { ?>
                <div>
                  <a href="<?php echo esc_url($kolom_2['tombol_kolom']['tautan']); ?>" target="<?php echo esc_attr($kolom_2['tombol_kolom']['target'] ? '_blank' : ''); ?>">
                    <button type="button" class="rsc-button secondary-text medium">
                      <span><?php echo esc_html($kolom_2['tombol_kolom']['teks']); ?></span>
                      <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
                    </button>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- Kolom 3 -->
          <div class="rsc-col-span-1">
            <div class="rsc-about-card third">
              <div class="rsc-space-y-4">
                <div class="rsc-space-y-2">
                  <h3 class="rsc-title"><?php echo esc_html($kolom_3['judul']); ?></h3>
                  <?php echo rsc_get_formatted_list_items($kolom_3['deskripsi_singkat']); ?>
                </div>
              </div>
            </div>
          </div>
          <?php } else { ?>
          <div class="rsc-mt-8 lg:rsc-mt-16"></div>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- About -->
    <?php if($tentang) { ?>
    <div class="rsc-px-4 -rsc-top-12 lg:-rsc-top-16 rsc-relative">
      <div class="rsc-custom-container">
        <div class="rsc-about-content">
          <!-- Content -->
          <div class="rsc-grow rsc-order-2 lg:rsc-order-1">
            <div class="rsc-space-y-4">
              <h3 class="rsc-title"><?php echo esc_html($tentang['judul']); ?></h3>

              <article class="rsc-content">
                <?php echo $tentang['deskripsi']; ?>
              </article>

              <?php if($tentang['aktifkan_tombol_detil']) { ?>
              <div>
                <a href="<?php echo esc_url($tentang['tombol_detil']['tautan']); ?>" target="<?php echo esc_attr($tentang['tombol_detil']['target'] ? '_blank' : ''); ?>">
                  <button type="button" class="rsc-button secondary-text medium no-padding">
                    <span><?php echo esc_html($tentang['tombol_detil']['teks']); ?></span>
                    <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
                  </button>
                </a>
              </div>
              <?php } ?>
            </div>
          </div>

          <!-- Video -->
          <?php if($tentang['youtube_url']) { ?>
          <div class="rsc-flex-none rsc-order-1 lg:rsc-order-2">
            <iframe width="560" height="315" src="" data-image="<?php echo esc_url('https://www.youtube.com/embed/' . rsc_get_youtube_video_code_from_url($tentang['youtube_url']) . '?controls=0&rel=0'); ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rsc-youtube-embed rsc-lazyload"></iframe>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>