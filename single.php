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

  // CTA Konsultasi
  $judul_konsultasi = get_option('rsc_cta_konsultasi_judul');
  $tautan_konsultasi = get_option('rsc_cta_konsultasi_tautan');

  get_header();

  while(have_posts()) {
    the_post();

    $postingan_ID = get_the_ID();
    $judul_postingan = get_the_title();
    $gambar_postingan = rsc_get_the_post_thumbnail_url($postingan_ID, get_template_directory_uri() . '/dist/img/default-image.webp');
    $deskripsi_postingan = (has_excerpt() ? get_the_excerpt() : '');
    $tautan_postingan = get_the_permalink();
    $tanggal_postingan = get_the_date();
    $dokter_terkait = get_field('dokter_terkait', $postingan_ID);

    $tags = get_the_tags();

    // Halaman
    $halaman_postingan_url = get_option('rsc_halaman_postingan');

    // Semua postingan
    $args_postingan = array(
      'post__not_in' =>  array($postingan_ID),
      'post_type' => 'post',
      'post_status' => 'publish',
      'orderby' => array(
        'rand' => 'ASC',
        'title' => 'ASC'
      ),
      'posts_per_page' => 5
    );

    $semua_postingan = new WP_Query($args_postingan);

    // Halaman
    if($dokter_terkait) {
      $halaman_dokter_url = get_option('rsc_halaman_dokter');

      // Semua dokter
      $args_dokter = array(
        'post_type' => 'dokter',
        'post_status' => 'publish',
        'orderby' => array(
          'rand' => 'ASC',
          'title' => 'ASC'
        ),
        'posts_per_page' => 5,
        'tax_query' => array(
          'relation' => 'OR',
          array(
            'taxonomy' => 'bidang',
            'field' => 'slug',
            'terms' => $dokter_terkait->slug
          )
        )
      );

      $semua_dokter = new WP_Query($args_dokter);
    }
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
            <div class="rsc-grid rsc-grid-cols-6 xl:rsc-grid-cols-4 rsc-gap-8 xl:rsc-gap-4">
              <!-- Detail -->
              <div class="rsc-col-span-6 lg:rsc-col-span-4 xl:rsc-col-span-3">
                <div class="rsc-space-y-8">
                  <div>
                    <div class="rsc-space-y-2">
                      <p class="rsc-section-subtitle"><?php echo esc_html('Diposting pada ' . $tanggal_postingan); ?></p>
                      <h1 class="rsc-text-rscdark rsc-text-2xl lg:rsc-text-4xl rsc-font-semibold"><?php echo esc_html($judul_postingan); ?></h1>
                    </div>
                  </div>

                  <!-- Image -->
                  <?php if($gambar_postingan) { ?>
                  <div>
                    <img src="<?php echo esc_url($gambar_postingan); ?>" alt="" class="rsc-rounded-2xl rsc-object-cover rsc-object-center rsc-w-full rsc-mx-auto rsc-h-auto rsc-max-h-[230px] sm:rsc-max-h-[406px] md:rsc-max-h-[491px] lg:rsc-max-h-[434px] xl:rsc-max-h-[622px] 2xl:rsc-max-h-[638px]" />
                  </div>
                  <?php } ?>

                  <!-- Divider -->
                  <div>
                    <hr class="rsc-divider" />
                  </div>

                  <!-- Content -->
                  <div>
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

                  <!-- Divider -->
                  <div>
                    <hr class="rsc-divider">
                  </div>

                  <!-- Tags -->
                  <?php if(count($tags) > 0) { ?>
                  <div>
                    <div class="rsc-tags">
                      <span class="rsc-label"><?php echo __('Topik:', 'rsc'); ?></span>

                      <?php foreach($tags as $tag) { ?>
                      <a href="<?php echo esc_url(get_term_link($tag->term_id)); ?>" class="rsc-inline-block">
                        <span class="rsc-link"><?php echo esc_html($tag->slug); ?></span>
                      </a>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
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
                        <a href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . $tautan_postingan); ?>" title="<?php echo __('Facebook', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-facebook fa-lg rsc-text-[#4267B2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://twitter.com/intent/tweet?text=' . $judul_postingan . '&url=' . $tautan_postingan); ?>" title="<?php echo __('Twitter', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-twitter fa-lg rsc-text-[#1DA1F2]"></i>
                        </a>
                      </li>
                      <li>
                        <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=&text=' . $judul_postingan . '%20-%20' . $tautan_postingan); ?>" title="<?php echo __('WhatsApp', 'rsc'); ?>" target="_blank">
                          <i class="fa-brands fa-whatsapp fa-lg rsc-text-[#25D366]"></i>
                        </a>
                      </li>
                      <li class="rsc-relative">
                        <a href="<?php echo esc_url($tautan_postingan); ?>" title="<?php echo __('Salin tautan', 'rsc'); ?>" class="rsc-copy-url">
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

                <!-- Postingan -->
                <?php if($semua_postingan->have_posts()) { ?>
                <div class="rsc-space-y-4">
                  <h4 class="rsc-widget-title"><?php echo __('Artikel Lainnya', 'rsc'); ?></h4>

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

                <!-- Dokter Terkait -->
                <?php if($dokter_terkait && $semua_dokter->have_posts()) { ?>
                <div class="rsc-space-y-4">
                  <h4 class="rsc-widget-title"><?php echo __('Dokter Terkait', 'rsc'); ?></h4>

                  <?php while($semua_dokter->have_posts()) : $semua_dokter->the_post(); ?>
                  <?php
                    $dokter_ID = get_the_ID();
                    $foto_dokter = rsc_get_the_webp_image_url((get_field('profil', $dokter_ID)['foto'] ? get_field('profil', $dokter_ID)['foto'] : ''), get_template_directory_uri() . '/dist/img/default-image.webp');
                    $nama_dokter = get_the_title();
                    $bidang_dokter = wp_get_object_terms($dokter_ID, 'bidang', array('fields' => 'names'));
                    $tautan_dokter = get_the_permalink();
                  ?>
                  <div>
                    <a href="<?php echo esc_url($tautan_dokter); ?>">
                      <div class="rsc-widget-post">
                        <div class="rsc-flex-none">
                          <img width="72" height="72" src="" data-image="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-thumbnail rsc-lazyload" />
                          
                          <noscript>
                            <img width="72" height="72" src="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-thumbnail" />
                          </noscript>
                        </div>
                        <div class="rsc-grow">
                          <div class="rsc-space-y-1">
                            <h5 class="rsc-title"><?php echo esc_html($nama_dokter); ?></h5>
                            <p class="rsc-subtitle"><?php echo esc_html('Spesialis ' . $bidang_dokter[0]); ?></p>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?>

                  <?php if($halaman_dokter_url) { ?>
                  <div>
                    <a href="<?php echo esc_url($halaman_dokter_url); ?>">
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

                <!-- Konsultasi -->
                <?php if($judul_konsultasi && $tautan_konsultasi) { ?>
                <div class="rsc-space-y-4 rsc-sticky rsc-top-[132.8px]">
                  <a href="<?php echo esc_url($tautan_konsultasi); ?>" target="_blank">
                    <div class="rsc-widget-cta">
                      <h4 class="rsc-widget-title"><?php echo esc_html($judul_konsultasi); ?></h4>
                      
                      <button type="button" class="rsc-button-icon">
                        <i class="fa-solid fa-arrow-right rsc-animate-sliding"></i>
                      </button>
                    </div>
                  </a>
                </div>
                <?php } ?>
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