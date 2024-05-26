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

  // Judul Promo
  $promo = get_field('promo', $frontpage_ID);

  // Semua Promo
  $args_promo = array(
    'post_type' => 'promo',
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => 5,
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

  // Halaman
  $halaman_promo_url = get_option('rsc_halaman_promo');

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
    'posts_per_page' => 5
  );

  $semua_postingan = new WP_Query($args_postingan);

  // Kontak
  $panggilan_darurat = get_option('rsc_kontak_panggilan_darurat');
  $panggilan_operator = get_option('rsc_kontak_panggilan_operator');
  $layanan_sms = get_option('rsc_kontak_layanan_sms');

  get_header();

  while(have_posts()) {
    the_post();

    $kegiatan_ID = get_the_ID();
    $judul_kegiatan = get_the_title();
    $gambar_kegiatan = rsc_get_the_post_thumbnail_url($kegiatan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
    $deskripsi_kegiatan = (has_excerpt() ? get_the_excerpt() : '');
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
 
  <!-- Main -->
  <main id="rscMain" class="rsc-bg-white rsc-pb-16 sm:rsc-pb-[162px] md:rsc-pb-[250px] lg:rsc-pb-[260px]">
    <!-- Hero -->
    <section class="rsc-kegiatan-hero" style="background-image: url('<?php echo esc_url($gambar_kegiatan); ?>');">
      <div class="rsc-overlay"></div>

      <div class="rsc-custom-container">
        <div class="rsc-relative rsc-z-20 rsc-space-y-8 rsc-max-w-none sm:rsc-max-w-lg lg:rsc-max-w-xl rsc-px-4 rsc-py-16 rsc-mx-auto">
          <div class="rsc-space-y-4">
            <h1 class="rsc-title"><?php echo esc_html($judul_kegiatan); ?></h1>

            <p class="rsc-desc"><?php echo esc_html('Dilaksanakan pada ' . ($tanggal_kegiatan ? $tanggal_kegiatan : $tanggal_postingan)); ?></p>

            <div class="rsc-text-center">
              <button type="button" class="rsc-animate-bounce rsc-mt-4 rsc-scrollto" data-target="#rscBreadcrumb" data-speed="300" data-minus="-1">
                <i class="fa-solid fa-circle-arrow-down fa-2xl rsc-text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

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
            <div class="rsc-grid rsc-grid-cols-6 xl:rsc-grid-cols-4 rsc-gap-8 xl:rsc-gap-4">
              <!-- Detail -->
              <div class="rsc-col-span-6 lg:rsc-col-span-4 xl:rsc-col-span-3">
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
                        <a href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . $tautan_kegiatan); ?>" title="<?php echo __('Facebook', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-facebook fa-lg rsc-text-[#4267B2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . $judul_kegiatan . '&url=' . $tautan_kegiatan); ?>" title="<?php echo __('Twitter', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-twitter fa-lg rsc-text-[#1DA1F2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=&text=' . $judul_kegiatan . '%20-%20' . $tautan_kegiatan); ?>" title="<?php echo __('WhatsApp', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-whatsapp fa-lg rsc-text-[#25D366]"></i>
                        </a>
                      </li>
                      <li class="rsc-relative">
                        <a href="<?php echo esc_url($tautan_kegiatan); ?>" title="<?php echo __('Salin tautan', 'rsc'); ?>" class="rsc-copy-url">
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
                
                <!-- Galeri -->
                <?php if(count($arr_gallery) > 1) { ?>
                <div>
                  <a href="#" class="rsc-open-gallery" data-gallery="<?php echo esc_attr($list_gallery); ?>" data-title="<?php echo esc_attr($judul_kegiatan); ?>">
                    <div class="rsc-widget-gallery">
                      <h4 class="rsc-widget-title"><?php echo esc_html((count($arr_gallery) - 1) . ' Foto Lainnya'); ?></h4>

                      <div class="rsc-gallery-images">
                        <?php if(isset($arr_gallery[1]) && $arr_gallery[1]) { ?>
                        <div>
                          <img width="67" height="64" src="" data-image="<?php echo esc_url($arr_gallery[1]); ?>" alt="" class="rsc-img rsc-lazyload" />

                          <noscript>
                            <img width="67" height="64" src="<?php echo esc_url($arr_gallery[1]); ?>" alt="" class="rsc-img" />
                          </noscript>
                        </div>
                        <?php } ?>

                        <?php if(isset($arr_gallery[2]) && $arr_gallery[2]) { ?>
                        <div>
                          <img width="67" height="64" src="" data-image="<?php echo esc_url($arr_gallery[2]); ?>" alt="" class="rsc-img rsc-lazyload" />

                          <noscript>
                            <img width="67" height="64" src="<?php echo esc_url($arr_gallery[2]); ?>" alt="" class="rsc-img" />
                          </noscript>
                        </div>
                        <?php } ?>
                      </div>
                      
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

                <!-- Postingan -->
                <?php if($semua_postingan->have_posts()) { ?>
                <div class="rsc-space-y-4">
                  <h4 class="rsc-widget-title"><?php echo (isset($postingan['judul']) ? esc_html($postingan['judul']) : __('Artikel Terbaru', 'rsc')); ?></h4>

                  <?php while($semua_postingan->have_posts()) : $semua_postingan->the_post(); ?>
                  <?php
                    $w_postingan_ID = get_the_ID();
                    $judul_w_postingan = get_the_title();
                    $gambar_w_postingan = rsc_get_the_post_thumbnail_url($w_postingan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
                    $tautan_w_postingan = get_the_permalink();
                    $tanggal_w_postingan = get_the_date();
                  ?>
                  <div>
                    <a href="<?php echo esc_url($tautan_w_postingan); ?>">
                      <div class="rsc-widget-post">
                        <div class="rsc-flex-none">
                          <img width="72" height="72" src="" data-image="<?php echo esc_url($gambar_w_postingan); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />
                          
                          <noscript>
                            <img width="72" height="72" src="<?php echo esc_url($gambar_w_postingan); ?>" alt="" class="rsc-thumbnail" />
                          </noscript>
                        </div>
                        <div class="rsc-grow">
                          <div class="rsc-space-y-1">
                            <h5 class="rsc-title"><?php echo esc_html($judul_w_postingan); ?></h5>
                            <p class="rsc-subtitle"><?php echo esc_html('Diposting pada ' . $tanggal_w_postingan); ?></p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>

                  <?php if($halaman_postingan_url) { ?>
                  <div>
                    <a href="<?php echo esc_url($halaman_postingan_url); ?>">
                      <button type="button" class="rsc-button secondary-text no-padding">
                        <span><?php echo __('Lihat Semua', 'rsc'); ?></span>
                        <i class="fa-solid fa-arrow-right rsc-text-rscsecondary rsc-animate-sliding"></i>
                      </button>
                    </a>
                  </div>
                  <?php } ?>
                </div>
                
                <!-- Divider -->
                <div class="rsc-my-4">
                  <hr class="rsc-divider">
                </div>
                <?php } ?>

                <!-- Promo -->
                <?php if($semua_promo->have_posts()) { ?>
                <div class="rsc-space-y-4">
                  <h4 class="rsc-widget-title"><?php echo (isset($promo['judul']) ? esc_html($promo['judul']) : __('Semua Promo', 'rsc')); ?></h4>

                  <?php while($semua_promo->have_posts()) : $semua_promo->the_post(); ?>
                  <?php
                    $promo_ID = get_the_ID();
                    $judul_promo = get_the_title();
                    $gambar_promo = rsc_get_the_post_thumbnail_url($promo_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
                    $tautan_promo = get_the_permalink();
                    $tanggal_kadaluarsa = get_field('tanggal_kadaluarsa', $promo_ID);
                  ?>
                  <div>
                    <a href="<?php echo esc_url($tautan_promo); ?>">
                      <div class="rsc-widget-post">
                        <div class="rsc-flex-none">
                          <img width="72" height="72" src="" data-image="<?php echo esc_url($gambar_promo); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />
                          
                          <noscript>
                            <img width="72" height="72" src="<?php echo esc_url($gambar_promo); ?>" alt="" class="rsc-thumbnail" />
                          </noscript>
                        </div>
                        <div class="rsc-grow">
                          <div class="rsc-space-y-1">
                            <h5 class="rsc-title"><?php echo esc_html($judul_promo); ?></h5>
                            <p class="rsc-subtitle"><?php echo esc_html('Berlaku hingga ' . $tanggal_kadaluarsa); ?></p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>

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
                
                <!-- Divider -->
                <div class="rsc-my-4">
                  <hr class="rsc-divider">
                </div>
                <?php } ?>

                <!-- Contact -->
                <?php if($panggilan_darurat || $panggilan_operator || $layanan_sms) { ?>
                <div class="rsc-space-y-4 rsc-sticky rsc-top-[132.8px]">
                  <h4 class="rsc-widget-title"><?php echo __('Informasi Kontak', 'rsc'); ?></h4>

                  <div class="rsc-widget-contact">
                    <div>
                      <i class="fa-solid fa-phone-volume fa-2xl rsc-text-rscsecondary"></i>
                    </div>
                    <div class="rsc-space-y-1">
                      <p class="rsc-label"><?php echo __('Panggilan Darurat', 'rsc'); ?></p>
                      <h5 class="rsc-text"><?php echo esc_html(($panggilan_darurat ? $panggilan_darurat : '&mdash;')); ?></h5>
                    </div>
                  </div>

                  <div class="rsc-widget-contact">
                    <div>
                      <i class="fa-solid fa-headset fa-2xl rsc-text-rscsecondary"></i>
                    </div>
                    <div class="rsc-space-y-1">
                      <p class="rsc-label"><?php echo __('Panggilan Operator', 'rsc'); ?></p>
                      <h5 class="rsc-text"><?php echo esc_html(($panggilan_operator ? $panggilan_operator : '&mdash;')); ?></h5>
                    </div>
                  </div>

                  <div class="rsc-widget-contact">
                    <div>
                      <i class="fa-solid fa-envelope fa-2xl rsc-text-rscsecondary"></i>
                    </div>
                    <div class="rsc-space-y-1">
                      <p class="rsc-label"><?php echo __('Layanan SMS', 'rsc'); ?></p>
                      <h5 class="rsc-text"><?php echo esc_html(($layanan_sms ? $layanan_sms : '&mdash;')); ?></h5>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_template_part('template-parts/section/gallery'); ?>
 
<?php
  }

  get_footer();
?>