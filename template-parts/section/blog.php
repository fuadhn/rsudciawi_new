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

  // Judul postingan
  $postingan = get_field('postingan', $frontpage_ID);

  // Halaman
  $halaman_postingan_url = get_option('rsc_halaman_postingan');

  // Semua postingan
  $args_postingan = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $posts_per_page
  );

  $semua_postingan = new WP_Query($args_postingan);

  if($semua_postingan->have_posts()) {
?>

<div>
  <div class="rsc-custom-container">
    <div class="rsc-space-y-8">
      <div class="rsc-space-y-4">
        <!-- Title -->
        <h2 class="rsc-section-title"><?php echo (isset($postingan['judul']) ? esc_html($postingan['judul']) : __('Semua Postingan', 'rsc')); ?></h2>

        <!-- Category -->
        <?php if($halaman_postingan_url || $postingan['kategori']) { ?>
        <div id="rscCategoryCarousel" class="owl-carousel owl-theme">
          <?php if($halaman_postingan_url) { ?>
          <div class="item">
            <a href="<?php echo esc_url($halaman_postingan_url); ?>">
              <button type="button" class="rsc-category-item active">
                <span><?php echo __('Lihat Semua', 'rsc'); ?></span>
              </button>
            </a>
          </div>
          <?php } ?>

          <?php if($postingan['kategori'] && count($postingan['kategori']) > 0) { ?>
          <?php foreach($postingan['kategori'] as $category) { ?>
          <div class="item">
            <a href="<?php echo esc_url(get_term_link($category->term_id, 'category')); ?>">
              <button type="button" class="rsc-category-item">
                <span><?php echo esc_html($category->name); ?></span>
              </button>
            </a>
          </div>
          <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>

      <!-- List -->
      <div id="rscBlogCarousel" class="owl-carousel owl-theme">
        <?php while($semua_postingan->have_posts()) : $semua_postingan->the_post(); ?>
        <?php
          $postingan_ID = get_the_ID();
          $judul_postingan = get_the_title();
          $gambar_postingan = rsc_get_the_post_thumbnail_url($postingan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
          $tautan_postingan = get_the_permalink();
          $tanggal_postingan = get_the_date();
        ?>
        <div class="item">
          <a href="<?php echo esc_url($tautan_postingan); ?>">
            <div class="rsc-post-item">
              <div class="rsc-space-y-2">
                <img width="308" height="180" src="" data-image="<?php echo esc_url($gambar_postingan); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />
                
                <noscript>
                  <img width="308" height="180" src="<?php echo esc_url($gambar_postingan); ?>" alt="" class="rsc-thumbnail" />
                </noscript>
                
                <div class="rsc-space-y-1">
                  <p class="rsc-date"><?php echo esc_html('Diposting pada ' . $tanggal_postingan); ?></p>
                  <h3 class="rsc-title"><?php echo esc_html($judul_postingan); ?></h3>
                </div>
                <button type="button" class="rsc-button fullwidth center primary-gradient medium">
                  <span><?php echo __('Baca Selengkapnya', 'rsc'); ?></span>
                  <i class="fa-solid fa-chevron-right rsc-text-white"></i>
                </button>
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