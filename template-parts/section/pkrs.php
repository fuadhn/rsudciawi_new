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
  $posts_per_page = get_option('posts_per_page');

  // Judul pkrs
  $pkrs = get_field('pkrs', $frontpage_ID);

  // Halaman
  $halaman_pkrs_url = get_option('rsc_halaman_pkrs');

  // Semua kegiatan
  $args_kegiatan = array(
    'post_type' => 'kegiatan',
    'post_status' => 'publish',
    'meta_key' => 'tanggal_kegiatan',
    'meta_type' => 'DATE',
    'order' => 'DESC',
    'orderby' => 'meta_value_num',
    'posts_per_page' => $posts_per_page
  );

  $semua_kegiatan = new WP_Query($args_kegiatan);

  if($semua_kegiatan->have_posts()) {
?>

<div>
  <div class="rsc-custom-container">
    <div class="rsc-space-y-8">
      <!-- Title -->
      <div class="rsc-flex rsc-flex-col lg:rsc-flex-row rsc-gap-2 lg:rsc-gap-4 rsc-items-start lg:rsc-items-center rsc-justify-between">
        <div>
          <h2 class="rsc-section-title"><?php echo (isset($pkrs['judul']) ? esc_html($pkrs['judul']) : __('Promosi Kesehatan Rumah Sakit', 'rsc')); ?></h2>
        </div>

        <?php if($halaman_pkrs_url) { ?>
        <div>
          <a href="<?php echo esc_url($halaman_pkrs_url); ?>">
            <button type="button" class="rsc-button secondary-text no-padding">
              <span><?php echo __('Lihat Semua', 'rsc'); ?></span>
              <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
            </button>
          </a>
        </div>
        <?php } ?>
      </div>

      <!-- List -->
      <div id="rscPKRSCarousel" class="owl-carousel owl-theme">
        <?php while($semua_kegiatan->have_posts()) : $semua_kegiatan->the_post(); ?>
        <?php
          $kegiatan_ID = get_the_ID();
          $judul_kegiatan = get_the_title();
          $gambar_kegiatan = rsc_get_the_post_thumbnail_url($kegiatan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
          $tautan_kegiatan = get_the_permalink();
          $tanggal_postingan = get_the_date();
          $tanggal_kegiatan = get_field('tanggal_kegiatan', $kegiatan_ID);
          $galeri = get_field('galeri', $kegiatan_ID);

          $arr_gallery = array();

          array_push($arr_gallery, $gambar_kegiatan);

          if($galeri) {
            foreach($galeri as $key => $value) {
              if($value) {
                array_push($arr_gallery, $value);
              }
            }
          }

          $list_gallery = implode(',', $arr_gallery) . ",";
        ?>
        <div class="item">
          <a href="<?php echo esc_url($tautan_kegiatan); ?>">
            <div class="rsc-post-item">
              <div class="rsc-space-y-2">
                <img width="308" height="180" src="" data-image="<?php echo esc_url($gambar_kegiatan); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />

                <noscript>
                  <img width="308" height="180" src="<?php echo esc_url($gambar_kegiatan); ?>" alt="" class="rsc-thumbnail" />
                </noscript>
                
                <div class="rsc-space-y-1">
                  <p class="rsc-date"><?php echo esc_html('Dilaksanakan pada ' . ($tanggal_kegiatan ? $tanggal_kegiatan : $tanggal_postingan)); ?></p>
                  <h3 class="rsc-title"><?php echo esc_html($judul_kegiatan); ?></h3>
                </div>
                <div>
                  <div class="rsc-flex rsc-flex-row rsc-gap-2 rsc-items-center">
                    <div>
                      <button type="button" class="rsc-button fullwidth center secondary-outline medium rsc-h-[44px] rsc-open-gallery" data-gallery="<?php echo esc_attr($list_gallery); ?>" data-title="<?php echo esc_attr($judul_kegiatan); ?>">
                        <i class="fa-regular fa-images rsc-text-rscsecondary"></i>
                      </button>
                    </div>

                    <div class="rsc-grow">
                      <button type="button" class="rsc-button fullwidth center secondary-gradient medium">
                        <span><?php echo __('Lihat Selengkapnya', 'rsc'); ?></span>
                        <i class="fa-solid fa-chevron-right rsc-text-white"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>