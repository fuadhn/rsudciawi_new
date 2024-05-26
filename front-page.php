<?php
/**
 * The template for displaying front page
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-front-page-templates/
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  get_header();

  while(have_posts()) {
    the_post();
?>
 
  <!-- Main -->
  <main id="rscMain" class="rsc-bg-white rsc-pb-16 sm:rsc-pb-[162px] md:rsc-pb-[250px] lg:rsc-pb-[260px]">
    <!-- Slideshow -->
    <?php get_template_part('template-parts/section/slideshow'); ?>
    
    <!-- Contact -->
    <?php get_template_part('template-parts/section/contact'); ?>
    <!-- About -->
    <?php get_template_part('template-parts/section/about'); ?>
    
    <?php get_template_part('template-parts/section/service'); ?>
    
    <section class="rsc-bg-white rsc-px-4 rsc-pt-8 rsc-pb-4 sm:rsc-pt-16">
      <div class="rsc-space-y-8 sm:rsc-space-y-16">
        <!-- Promo -->
        <?php get_template_part('template-parts/section/promo'); ?>
        
        <!-- Divider -->
        <div>
          <div class="rsc-custom-container">
            <hr class="rsc-divider" />
          </div>
        </div>
        
        <!-- Blog -->
        <?php get_template_part('template-parts/section/blog'); ?>
        
        <!-- Divider -->
        <div>
          <div class="rsc-custom-container">
            <hr class="rsc-divider" />
          </div>
        </div>
        
        <!-- PKRS -->
        <?php get_template_part('template-parts/section/pkrs'); ?>
      </div>
    </section>
  </main>

  <?php get_template_part('template-parts/section/gallery'); ?>
 
<?php
  }

  get_footer();
?>