<?php
/**
 * Template parts
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  // Variabel
  $posts_per_page = get_option('posts_per_page');

  // Spanduk
  $args_spanduk = array(
    'post_type' => 'spanduk',
    'post_status' => 'publish',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => $posts_per_page
  );

  $semua_spanduk = new WP_Query($args_spanduk);

  if($semua_spanduk->have_posts()) {
    $index_spanduk = 1;
?>

<section>
  <div id="rscSlideshowCarousel" class="owl-carousel owl-theme">
    <?php while($semua_spanduk->have_posts()) : $semua_spanduk->the_post(); ?>
    <?php
      $spanduk_ID = get_the_ID();
      $judul_spanduk = get_the_title();
      $gambar_spanduk = get_field('gambar_spanduk', $spanduk_ID);
      $deskripsi_spanduk = get_field('deskripsi_spanduk', $spanduk_ID);
      $aktifkan_tombol_spanduk = get_field('aktifkan_tombol_spanduk', $spanduk_ID);
    ?>
    <div class="item">
      <div data-image="<?php echo ($index_spanduk == 1 ? '' : esc_url($gambar_spanduk)); ?>" class="rsc-slideshow-item <?php echo ($index_spanduk == 1 ? '' : 'rsc-lazyload'); ?>" style="<?php echo ($index_spanduk == 1 ? 'background-image: url(' . esc_url($gambar_spanduk) . ')' : ''); ?>">
        <!-- Overlay -->
        <div class="rsc-overlay"></div>

        <!-- Content -->
        <div class="rsc-custom-container">
          <div class="rsc-relative rsc-z-20 rsc-space-y-8 rsc-max-w-none sm:rsc-max-w-md lg:rsc-max-w-lg rsc-px-4 rsc-py-16">
            <div class="rsc-space-y-4">
              <h2 class="rsc-title"><?php echo esc_html($judul_spanduk); ?></h2>

              <?php if($deskripsi_spanduk) { ?>
              <p class="rsc-desc"><?php echo esc_html($deskripsi_spanduk); ?></p>
              <?php } ?>
            </div>
            
            <?php if($aktifkan_tombol_spanduk) { ?>
            <?php $tombol_spanduk = get_field('tombol_spanduk', $spanduk_ID); ?>
            <div>
              <a href="<?php echo esc_url($tombol_spanduk['tautan']); ?>" target="<?php echo esc_attr($tombol_spanduk['target'] ? '_blank' : ''); ?>">
                <button type="button" class="rsc-button medium secondary shadow">
                  <span><?php echo esc_html($tombol_spanduk['teks']); ?></span>
                  <i class="fa-solid fa-arrow-right rsc-text-white rsc-animate-sliding"></i>
                </button>
              </a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php $index_spanduk++; ?>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php } ?>