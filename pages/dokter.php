<?php
/**
 * Template Name: Dokter
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

  // Filter
  $is_filter = false;
  $semua_bidang = get_terms(array(
    'taxonomy' => 'bidang',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
  ));

  // Semua dokter
  $args_dokter = array(
    'post_type' => 'dokter',
    'post_status' => 'publish',
    'order' => 'ASC',
    'orderby' => 'title',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'tax_query' => array(
      'relation' => 'OR'
    ),
    'meta_query' => array(
      'relation' => 'OR'
    )
  );

  // Parameter
  $daftar_hari = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu');
  $daftar_waktu = array('pagi', 'siang', 'malam');

  // Nama
  if(isset($_GET['nama']) && $_GET['nama'] !== '') {
    $param_nama = sprintf($_GET['nama']);
    $is_filter = true;

    $args_dokter['s'] = $param_nama;
  }

  // Bidang
  if(isset($_GET['bidang']) && $_GET['bidang'] !== '') {
    $param_bidang = sprintf($_GET['bidang']);
    $is_filter = true;

    $args_dokter['tax_query'][] = array(
      'taxonomy' => 'bidang',
      'field' => 'slug',
      'terms' => $param_bidang
    );
  }

  // Hari
  if(isset($_GET['hari']) && $_GET['hari'] !== '') {
    $param_hari = sprintf($_GET['hari']);
    $is_filter = true;

    if(in_array($param_hari, $daftar_hari)) {
      $daftar_hari = array($param_hari);
    }
  }

  // Waktu
  if(isset($_GET['waktu']) && $_GET['waktu'] !== '') {
    $param_waktu = sprintf($_GET['waktu']);
    $is_filter = true;

    if(in_array($param_waktu, $daftar_waktu)) {
      $daftar_waktu = array($param_waktu);
    }
  }

  // Generate meta query
  foreach($daftar_hari as $hari) {
    foreach($daftar_waktu as $waktu) {
      $args_dokter['meta_query'][] = array(
        'key' => 'jadwal_praktek_' . $hari . '_' . $waktu . '_status',
        'value' => '1'
      );
    }
  }

  $semua_dokter = new WP_Query($args_dokter);
  $max_num_pages = $semua_dokter->max_num_pages;

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
            <div class="rsc-grid rsc-grid-cols-6 xl:rsc-grid-cols-4 rsc-gap-8 xl:rsc-gap-4">
              <!-- Filter -->
              <div class="rsc-col-span-6 lg:rsc-col-span-2 xl:rsc-col-span-1 rsc-order-3 lg:rsc-order-1">
                <div id="rscFilterForm" class="rsc-widget-wrap rsc-sticky rsc-top-[132.8px]">
                  <h4 class="rsc-widget-title"><?php echo __('Filter Lanjutan', 'rsc'); ?></h4>
                  <p class="rsc-widget-subtitle"><?php echo __('Cari dokter berdasarkan beberapa opsi.', 'rsc'); ?></p>

                  <form action="<?php echo esc_url($tautan_halaman); ?>" method="GET" class="rsc-form">
                    <p class="rsc-space-y-1">
                      <label for="nama"><?php echo __('Nama Dokter', 'rsc'); ?></label>
                      <input id="nama" type="text" name="nama" value="<?php echo (isset($_GET['nama']) && $_GET['nama'] !== '' ? esc_attr($_GET['nama']) : ''); ?>" class="rsc-w-full" autocomplete="off" placeholder="Ketik nama dokter yang dicari.." />
                    </p>
                    <p class="rsc-space-y-1">
                      <label for="bidang"><?php echo __('Bidang atau Spesialis', 'rsc'); ?></label>
                      <select id="bidang" name="bidang" class="rsc-w-full" autocomplete="off">
                        <option value="" selected="selected"><?php echo __('Semua Bidang', 'rsc'); ?></option>
                        
                        <?php foreach($semua_bidang as $bidang) { ?>
                        <option value="<?php echo esc_attr($bidang->slug); ?>" <?php echo (isset($_GET['bidang']) && $_GET['bidang'] === $bidang->slug ? 'selected="selected"' : ''); ?>><?php echo esc_html($bidang->name); ?></option>
                        <?php } ?>
                      </select>
                    </p>
                    <p class="rsc-space-y-1">
                      <label for="hari"><?php echo __('Hari Praktek', 'rsc'); ?></label>
                      <select id="hari" name="hari" class="rsc-w-full" autocomplete="off">
                        <option value="" selected="selected"><?php echo __('Semua Hari', 'rsc'); ?></option>
                        <option value="senin" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'senin' ? 'selected="selected"' : ''); ?>><?php echo __('Senin', 'rsc'); ?></option>
                        <option value="selasa" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'selasa' ? 'selected="selected"' : ''); ?>><?php echo __('Selasa', 'rsc'); ?></option>
                        <option value="rabu" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'rabu' ? 'selected="selected"' : ''); ?>><?php echo __('Rabu', 'rsc'); ?></option>
                        <option value="kamis" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'kamis' ? 'selected="selected"' : ''); ?>><?php echo __('Kamis', 'rsc'); ?></option>
                        <option value="jumat" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'jumat' ? 'selected="selected"' : ''); ?>><?php echo __('Jumat', 'rsc'); ?></option>
                        <option value="sabtu" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'sabtu' ? 'selected="selected"' : ''); ?>><?php echo __('Sabtu', 'rsc'); ?></option>
                        <option value="minggu" <?php echo (isset($_GET['hari']) && $_GET['hari'] === 'minggu' ? 'selected="selected"' : ''); ?>><?php echo __('Minggu', 'rsc'); ?></option>
                      </select>
                    </p>
                    <p class="rsc-space-y-1">
                      <label for="waktu"><?php echo __('Waktu Praktek', 'rsc'); ?></label>
                      <select id="waktu" name="waktu" class="rsc-w-full" autocomplete="off">
                        <option value="" selected="selected"><?php echo __('Semua Waktu', 'rsc'); ?></option>
                        <option value="pagi" <?php echo (isset($_GET['waktu']) && $_GET['waktu'] === 'pagi' ? 'selected="selected"' : ''); ?>><?php echo __('Pagi (07:00 - 12:00)', 'rsc'); ?></option>
                        <option value="siang" <?php echo (isset($_GET['waktu']) && $_GET['waktu'] === 'siang' ? 'selected="selected"' : ''); ?>><?php echo __('Siang (12:00 - 18:00)', 'rsc'); ?></option>
                        <option value="malam" <?php echo (isset($_GET['waktu']) && $_GET['waktu'] === 'malam' ? 'selected="selected"' : ''); ?>><?php echo __('Malam (18:00 - 24:00)', 'rsc'); ?></option>
                      </select>
                    </p>
                    <p>
                      <button type="submit" class="rsc-button fullwidth secondary center medium">
                        <span><?php echo __('Cari Dokter', 'rsc'); ?></span>
                      </button>
                    </p>
                  </form>
                </div>
              </div>

              <!-- Divider -->
              <div class="rsc-col-span-6 rsc-block lg:rsc-hidden rsc-order-2">
                <hr class="rsc-divider" />
              </div>

              <!-- Mobile navigation -->
              <div class="rsc-col-span-6 rsc-block lg:rsc-hidden">
                <button type="button" class="rsc-button primary-outline rsc-scrollto" data-target="#rscFilterForm" data-speed="0" data-minus="30">
                  <i class="fa-solid fa-filter fa-sm rsc-text-rscprimary"></i>
                  <span><?php echo __('Filter Lanjutan', 'rsc'); ?></span>
                </button>
              </div>

              <!-- List -->
              <div class="rsc-col-span-6 lg:rsc-col-span-4 xl:rsc-col-span-3 rsc-order-1 lg:rsc-order-2">
                <div class="rsc-space-y-4">
                  <!-- Page info -->
                  <div>
                    <div class="rsc-flex rsc-flex-row rsc-justify-between rsc-items-center rsc-gap-4">
                      <div>
                        <p class="rsc-page-info"><?php echo esc_html('Halaman ' . $paged . ' dari ' . ($max_num_pages > 0 ? $max_num_pages : '1') . ' (' . $semua_dokter->found_posts . ' dokter)'); ?></p>
                      </div>

                      <?php if($is_filter) { ?>
                      <div>
                        <a href="<?php echo esc_url($tautan_halaman); ?>">
                          <button type="button" class="rsc-button danger-text no-padding text-normal">
                            <i class="fa-solid fa-trash fa-xs rsc-text-red-600"></i>
                            <span><?php echo __('Hapus Filter', 'rsc'); ?></span>
                          </button>
                        </a>
                      </div>
                      <?php } ?>
                    </div>
                  </div>  
                
                  <!-- List -->
                  <?php if($semua_dokter->have_posts()) { ?>
                  <div class="rsc-grid rsc-grid-cols-1 sm:rsc-grid-cols-2 xl:rsc-grid-cols-3 rsc-gap-4">
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
                        <div class="rsc-doctor-item">
                          <img width="307" height="280" src="" data-image="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-photo rsc-lazyload" />

                          <noscript>
                            <img width="307" height="280" src="<?php echo esc_url($foto_dokter); ?>" alt="" class="rsc-photo" />
                          </noscript>

                          <div class="rsc-p-4 rsc-rounded-bl-2xl rsc-rounded-br-2xl">
                            <div class="rsc-flex rsc-flex-col rsc-justify-between rsc-gap-4">
                              <div>
                                <h3 class="rsc-fullname"><?php echo esc_html($nama_dokter); ?></h3>
                                <p class="rsc-role"><?php echo esc_html('Spesialis ' . $bidang_dokter[0]); ?></p>
                              </div>

                              <button type="button" class="rsc-button primary-text medium no-padding">
                                <span><?php echo __('Info Selengkapnya', 'rsc'); ?></span>
                                <i class="fa-solid fa-arrow-right fa-sm rsc-text-rscprimary rsc-animate-sliding"></i>
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
                  <div class="rsc-content-empty"><?php echo __('Mohon maaf, dokter yang Anda cari tidak ditemukan.', 'rsc'); ?></div>
                  <?php } ?>

                  <div>
                    <?php echo rsc_numeric_posts_nav($max_num_pages); ?>
                  </div>
                </div>
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