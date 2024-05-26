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

  // Judul Promo
  $promo = get_field('promo', $frontpage_ID);

  // Halaman
  $halaman_promo_url = get_option('rsc_halaman_promo');

  // Semua Promo
  $args_promo = array(
    'post_type' => 'promo',
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $posts_per_page,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'tanggal_kadaluarsa',
        'value' => date('Ymd'),
        'compare' => '>=',
      )
    )
  );

  $semua_promo = new WP_Query($args_promo);

  if($semua_promo->have_posts()) {
?>

<div>
  <div class="rsc-custom-container">
    <div class="rsc-space-y-8">
      <!-- Title -->
      <div class="rsc-flex rsc-flex-col lg:rsc-flex-row rsc-gap-2 lg:rsc-gap-4 rsc-items-start lg:rsc-items-center rsc-justify-between">
        <div>
          <h2 class="rsc-section-title"><?php echo (isset($promo['judul']) ? esc_html($promo['judul']) : __('Semua Promo', 'rsc')); ?></h2>
        </div>
        <?php if($halaman_promo_url) { ?>
        <div>
          <a href="<?php echo esc_url($halaman_promo_url); ?>">
            <button type="button" class="rsc-button secondary-text no-padding">
              <span><?php echo __('Lihat Semua', 'rsc'); ?></span>
              <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
            </button>
          </a>
        </div>
        <?php } ?>
      </div>

      <!-- List -->
      <div id="rscPromoCarousel" class="owl-carousel owl-theme">
        <?php while($semua_promo->have_posts()) : $semua_promo->the_post(); ?>
        <?php
          $promo_ID = get_the_ID();
          $judul_promo = get_the_title();
          $gambar_promo = rsc_get_the_post_thumbnail_url($promo_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
          $tautan_promo = get_the_permalink();
          $tanggal_kadaluarsa = get_field('tanggal_kadaluarsa', $promo_ID);
        ?>
        <div class="item">
          <a href="<?php echo esc_url($tautan_promo); ?>">
            <div class="rsc-post-item">
              <div class="rsc-space-y-2">
                <img width="308" height="180" src="" data-image="<?php echo esc_url($gambar_promo); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />

                <noscript>
                  <img width="308" height="180" src="<?php echo esc_url($gambar_promo); ?>" alt="" class="rsc-thumbnail" />
                </noscript>

                <div class="rsc-space-y-1">
                  <p class="rsc-date"><?php echo esc_html('Berlaku hingga ' . $tanggal_kadaluarsa); ?></p>
                  <h3 class="rsc-title"><?php echo esc_html($judul_promo); ?></h3>
                </div>
                <div>
                  <button type="button" class="rsc-button fullwidth center secondary-gradient medium">
                    <span><?php echo __('Ambil Penawaran', 'rsc'); ?></span>
                    <i class="fa-solid fa-ticket rsc-text-white"></i>
                  </button>
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