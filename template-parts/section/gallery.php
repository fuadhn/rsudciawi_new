<?php
/**
 * Template parts
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */
?>

<section id="rscGallery">
  <div class="rsc-flex rsc-flex-col rsc-gap-0 rsc-h-full">
    <!-- Header -->
    <div class="rsc-header">
      <div class="rsc-custom-container">
        <div class="rsc-flex rsc-flex-row rsc-gap-4 rsc-items-center rsc-justify-between">
          <div>
            <h3 id="rscTitleGallery">Title</h3>
          </div>
          <div>
            <button type="button" id="rscCloseGallery">
              <i class="fa-solid fa-close fa-lg rsc-text-rscdark/50 hover:rsc-text-rscdark"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Body -->
    <div id="rscPreviewGallery" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/dist/img/default-image.webp'); ?>');"></div>
    
    <!-- Footer -->
    <div class="rsc-footer">
      <div class="rsc-custom-container">
        <div id="rscGalleryCarousel" class="owl-carousel owl-theme">
          <div class="item">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/dist/img/default-image.webp'); ?>" alt="" class="rsc-preview-item" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>