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

  // Judul Layanan
  $layanan = get_field('layanan', $frontpage_ID);

  // Semua Layanan
  $args_layanan = array(
    'post_type' => 'layanan',
    'post_status' => 'publish',
    'post_parent' => 0,
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => -1,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'layanan_unggulan',
        'value' => '1'
      )
    )
  );

  $semua_layanan = new WP_Query($args_layanan);

  if($semua_layanan->have_posts()) {
?>

<section id="rscService">
  <div class="rsc-custom-container">
    <div class="rsc-grid rsc-grid-cols-1 xl:rsc-grid-cols-3 rsc-gap-4 sm:rsc-gap-8 rsc-items-center">
      <!-- Navigation and label -->
      <div class="rsc-col-span-1">
        <div class="rsc-space-y-4">
          <h2 class="rsc-section-title"><?php echo (isset($layanan['judul']) ? esc_html($layanan['judul']) : __('Semua Layanan', 'rsc')); ?></h2>
          
          <?php if(isset($layanan['deskripsi_singkat'])) { ?>
          <p class="rsc-section-subtitle"><?php echo esc_html($layanan['deskripsi_singkat']); ?></p>
          <?php } ?>

          <div class="rsc-hidden xl:rsc-flex rsc-flex-row rsc-gap-2 rsc-items-center rsc-mt-4 rsc-justify-center xl:rsc-justify-start">
            <div>
              <button type="button" class="rsc-prev-carousel" data-target="#rscServiceCarousel">
                <i class="fa-solid fa-chevron-left fa-xl"></i>
              </button>
            </div>
            <div>
              <button type="button" class="rsc-next-carousel" data-target="#rscServiceCarousel">
                <i class="fa-solid fa-chevron-right fa-xl"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="rsc-col-span-2">
        <div id="rscServiceCarousel" class="owl-carousel owl-theme">
          <?php while($semua_layanan->have_posts()) : $semua_layanan->the_post(); ?>
          <?php
            $layanan_ID = get_the_ID();
            $judul_layanan = get_the_title();
            $gambar_layanan = rsc_get_the_post_thumbnail_url($layanan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
            $deskripsi_layanan = get_the_excerpt();
            $tautan_layanan = get_the_permalink();
          ?>
          <div class="item">
            <a href="<?php echo esc_url($tautan_layanan); ?>">
              <div data-image="<?php echo esc_url($gambar_layanan); ?>" class="rsc-lazyload rsc-service-item">
                <div class="rsc-overlay"></div>

                <div class="rsc-content">
                  <h3 class="rsc-title"><?php echo esc_html($judul_layanan); ?></h3>
                  <p class="rsc-desc"><?php echo esc_html($deskripsi_layanan); ?></p>
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
</section>

<?php } ?>