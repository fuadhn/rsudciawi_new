<?php
/**
 * Template Name: Promo
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-front-page-templates/
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // Variabel
  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $posts_per_page = get_option('posts_per_page');

  // Semua Promo
  $args_promo = array(
    'post_type' => 'promo',
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'paged' => $paged,
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
  $max_num_pages = $semua_promo->max_num_pages;

  get_header();

  while(have_posts()) {
    the_post();

    $judul_halaman = get_the_title();
    $deskripsi_halaman = get_the_excerpt();
    $tautan_halaman = get_the_permalink();
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
          <!-- Title -->
          <div>
            <div class="rsc-space-y-2">
              <h1 class="rsc-section-title"><?php echo esc_html($judul_halaman); ?></h1>
              <p class="rsc-section-subtitle"><?php echo esc_html($deskripsi_halaman); ?></p>
            </div>
          </div>

          <!-- Divider -->
          <div>
            <hr class="rsc-divider" />
          </div>

          <!-- List -->
          <div>
            <div class="rsc-space-y-4">
              <!-- Page info -->
              <div>
                <div class="rsc-flex rsc-flex-row rsc-justify-between rsc-items-center rsc-gap-4">
                  <div>
                    <p class="rsc-page-info"><?php echo esc_html('Halaman ' . $paged . ' dari ' . ($max_num_pages > 0 ? $max_num_pages : '1') . ' (' . $semua_promo->found_posts . ' promo)'); ?></p>
                  </div>
                </div>
              </div>  
            
              <!-- List -->
              <?php if($semua_promo->have_posts()) { ?>
              <div class="rsc-grid rsc-grid-cols-1 sm:rsc-grid-cols-2 lg:rsc-grid-cols-3 xl:rsc-grid-cols-4 rsc-gap-4">
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
              <?php } else { ?>
              <div class="rsc-content-empty"><?php echo __('Mohon maaf, promo yang Anda cari tidak ditemukan atau belum tersedia.', 'rsc'); ?></div>
              <?php } ?>

              <div>
                <?php echo rsc_numeric_posts_nav($max_num_pages); ?>
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