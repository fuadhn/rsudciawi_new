<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-front-page-templates/
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  global $wp_query, $wp;

  // Variabel
  $frontpage_ID = get_option('page_on_front');
  $postspage_id = get_option('page_for_posts');
  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

  // Judul postingan
  $postingan = get_field('postingan', $frontpage_ID);

  // Halaman
  $halaman_postingan_url = get_option('rsc_halaman_postingan');

  // Search
  $search_url = home_url();

  $max_num_pages = $wp_query->max_num_pages;

  get_header();
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
            <div class="rsc-space-y-4">
              <div class="rsc-flex rsc-flex-col lg:rsc-flex-row rsc-gap-2 rsc-items-start lg:rsc-items-center rsc-justify-between">
                <div>
                  <h1 class="rsc-section-title">
                    <?php
                      printf(
                        esc_html__( 'Pencarian "%s"', 'rsc' ),
                        esc_html( get_search_query() )
                      );
                    ?>
                  </h1>
                </div>
                <div class="rsc-w-full lg:rsc-w-auto">
                  <form action="<?php echo esc_url($search_url); ?>" method="GET" class="rsc-search-form">
                    <i class="fa-solid fa-search fa-lg rsc-search-icon"></i>

                    <input type="search" name="s" class="rsc-search-input" placeholder="<?php echo __('Ketik kata kunci..', 'rsc'); ?>" autocomplete="off" />
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Divider -->
          <div>
            <hr class="rsc-divider" />
          </div>

          <!-- Category -->
          <div>
            <?php if($halaman_postingan_url || $postingan['kategori']) { ?>
            <div id="rscCategoryCarousel" class="owl-carousel owl-theme">
              <?php if($halaman_postingan_url) { ?>
              <div class="item">
                <a href="<?php echo esc_url($halaman_postingan_url); ?>">
                  <button type="button" class="rsc-category-item">
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
          <div>
            <div class="rsc-space-y-4">
              <!-- Page info -->
              <div>
                <div class="rsc-flex rsc-flex-row rsc-justify-between rsc-items-center rsc-gap-4">
                  <div>
                    <p class="rsc-page-info"><?php echo esc_html('Halaman ' . $paged . ' dari ' . ($max_num_pages > 0 ? $max_num_pages : '1') . ' (' . $wp_query->found_posts . ' postingan)'); ?></p>
                  </div>
                </div>
              </div>

              <!-- List -->
              <?php if(have_posts()) { ?>
              <div class="rsc-grid rsc-grid-cols-1 sm:rsc-grid-cols-2 lg:rsc-grid-cols-3 xl:rsc-grid-cols-4 rsc-gap-4">
                <?php while(have_posts()) : the_post(); ?>
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
              </div>
              <?php } else { ?>
              <div class="rsc-content-empty"><?php echo __('Mohon maaf, postingan yang Anda cari tidak ditemukan atau masih dalam proses penyuntingan.', 'rsc'); ?></div>
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
 
<?php get_footer(); ?>