<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

  //  Topbar
  $has_topbar_menu = has_nav_menu('topbar');

  $topbar_menu_name = "";
  $topbar_menu_items = array();

  if($has_topbar_menu) {
    $locations = get_nav_menu_locations();
    $topbar_menu = get_term($locations['topbar'], 'nav_menu');
    $topbar_menu_items = wp_get_nav_menu_items($topbar_menu->term_id);

    $topbar_menu_name = $topbar_menu->name;
  }

  // Socmed
  $facebook_url = get_option('rsc_media_sosial_facebook');
  $instagram_url = get_option('rsc_media_sosial_instagram');
  $twitter_url = get_option('rsc_media_sosial_twitter');
  $youtube_url = get_option('rsc_media_sosial_youtube');
  $has_media_sosial = ($facebook_url || $instagram_url || $twitter_url || $youtube_url ? true : false);

  // Logo
  $home_url = home_url();
  $logo_url = wp_get_attachment_url(get_theme_mod('custom_logo'));

  //  Primary
  $has_primary_menu = has_nav_menu('primary');

  $primary_menu_name = "";
  $primary_menu_items = array();

  if($has_primary_menu) {
    $locations = get_nav_menu_locations();
    $primary_menu = get_term($locations['primary'], 'nav_menu');
    $primary_menu_items = wp_get_nav_menu_items($primary_menu->term_id);

    $primary_menu_name = $primary_menu->name;
  }

  // Halaman
  $halaman_dokter_url = get_option('rsc_halaman_dokter');
?>

<header id="rscHeader">
  <!-- Topbar -->
  <div id="rscTopbar">
    <div class="rsc-custom-container">
      <div class="rsc-flex rsc-flex-row rsc-gap-4 rsc-items-center rsc-justify-start lg:rsc-justify-between">
        <!-- Left -->
        <?php if($has_topbar_menu) { ?>
        <div>
          <!-- Mobile -->
          <nav class="rsc-topbar-mobile">
            <ul>
              <li>
                <a href="#">
                  <span><?php echo esc_html($topbar_menu_name); ?></span>
                  <i class="fa-solid fa-caret-down fa-xs"></i>
                </a>

                <div class="rsc-submenu-wrap">
                  <ul>
                    <?php
                      $html_topbar_menu = "";

                      foreach($topbar_menu_items as $menu_item) {
                        $link = $menu_item->url;
                        $title = $menu_item->title;
                        $target = $menu_item->target;
                        $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);

                        if($is_parent) {
                          $html_topbar_menu .= '<li>' . "\n";
                          $html_topbar_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                          $html_topbar_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                          $html_topbar_menu .= '</a>' . "\n";
                          $html_topbar_menu .= '</li>' . "\n";
                        }
                      }

                      echo $html_topbar_menu;
                    ?>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>

          <!-- Desktop -->
          <nav class="rsc-topbar-desktop">
            <ul>
              <?php
                $html_topbar_menu = "";

                foreach($topbar_menu_items as $menu_item) {
                  $link = $menu_item->url;
                  $title = $menu_item->title;
                  $target = $menu_item->target;
                  $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);

                  if($is_parent) {
                    $html_topbar_menu .= '<li>' . "\n";
                    $html_topbar_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                    $html_topbar_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                    $html_topbar_menu .= '</a>' . "\n";
                    $html_topbar_menu .= '</li>' . "\n";
                  }
                }

                echo $html_topbar_menu;
              ?>
            </ul>
          </nav>
        </div>
        <?php } ?>

        <!-- Right -->
        <?php if($has_media_sosial) { ?>
        <div>
          <!-- Mobile -->
          <nav class="rsc-topbar-mobile">
            <ul>
              <li>
                <a href="#">
                  <span><?php echo __('Media Sosial', 'rsc'); ?></span>
                  <i class="fa-solid fa-caret-down fa-xs"></i>
                </a>

                <div class="rsc-submenu-wrap">
                  <ul>
                    <?php if($facebook_url) { ?>
                    <li>
                      <a href="<?php echo esc_url($facebook_url); ?>" target="_blank">
                        <span><?php echo __('Facebook', 'rsc'); ?></span>
                      </a>
                    </li>
                    <?php } ?>

                    <?php if($instagram_url) { ?>
                    <li>
                      <a href="<?php echo esc_url($instagram_url); ?>" target="_blank">
                        <span><?php echo __('Instagram', 'rsc'); ?></span>
                      </a>
                    </li>
                    <?php } ?>

                    <?php if($twitter_url) { ?>
                    <li>
                      <a href="<?php echo esc_url($twitter_url); ?>" target="_blank">
                        <span><?php echo __('Twitter', 'rsc'); ?></span>
                      </a>
                    </li>
                    <?php } ?>

                    <?php if($youtube_url) { ?>
                    <li>
                      <a href="<?php echo esc_url($youtube_url); ?>" target="_blank">
                        <span><?php echo __('YouTube', 'rsc'); ?></span>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>

          <!-- Desktop -->
          <nav class="rsc-topbar-desktop">
            <ul>
              <?php if($facebook_url) { ?>
              <li>
                <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" title="<?php echo __('Facebook', 'rsc'); ?>">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
              </li>
              <?php } ?>

              <?php if($instagram_url) { ?>
              <li>
                <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" title="<?php echo __('Instagram', 'rsc'); ?>">
                  <i class="fa-brands fa-instagram"></i>
                </a>
              </li>
              <?php } ?>

              <?php if($twitter_url) { ?>
              <li>
                <a href="<?php echo esc_url($twitter_url); ?>" target="_blank" title="<?php echo __('Twitter', 'rsc'); ?>">
                  <i class="fa-brands fa-twitter"></i>
                </a>
              </li>
              <?php } ?>

              <?php if($youtube_url) { ?>
              <li>
                <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" title="<?php echo __('YouTube', 'rsc'); ?>">
                  <i class="fa-brands fa-youtube"></i>
                </a>
              </li>
              <?php } ?>
            </ul>
          </nav>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Menu -->
  <div id="rscMenu">
    <div class="rsc-custom-container">
      <div class="rsc-flex rsc-flex-row rsc-gap-4 rsc-items-center rsc-justify-between">
        <!-- Left -->
        <div>
          <a href="<?php echo esc_url($home_url); ?>">  
            <img width="167" height="48" src="<?php echo esc_url(($logo_url ? $logo_url : rsc_get_default_logo_url())); ?>" alt="" class="rsc-logo" />
          </a>
        </div>

        <!-- Right -->
        <div>
          <!-- Mobile nav -->
          <nav class="rsc-mobile-nav">
            <ul>
              <li>
                <a href="#">
                  <i class="fa-solid fa-bars"></i>
                </a>

                <div class="rsc-submenu-wrap">
                  <ul>
                    <?php
                      $html_primary_menu = '';

                      if($has_primary_menu) {
                        $index_primary_menu = 0;
                        
                        $before_is_parent = false;

                        foreach($primary_menu_items as $menu_item) {
                          $link = esc_url($menu_item->url);
                          $title = $menu_item->title;
                          $target = $menu_item->target;
                          $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);
                          $has_child = (isset($primary_menu_items[$index_primary_menu+1]) && $primary_menu_items[$index_primary_menu+1]->menu_item_parent == $menu_item->ID ? true : false);
                          $next_is_parent = (isset($primary_menu_items[$index_primary_menu+1]) && $primary_menu_items[$index_primary_menu+1]->menu_item_parent == 0 ? true : false);
                          
                          if($is_parent && !$before_is_parent) {
                            if(!$has_child) {
                              $html_primary_menu .= '<li>' . "\n";
                              $html_primary_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                              $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                              $html_primary_menu .= '</a>' . "\n";
                              $html_primary_menu .= '</li>' . "\n";
                            } else {
                              $html_primary_menu .= '<li>' . "\n";
                              
                              $html_primary_menu .= '<a href="#">' . "\n";
                              $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                              $html_primary_menu .= '<i class="fa-solid fa-chevron-down"></i>' . "\n";
                              $html_primary_menu .= '</a>' . "\n";
                
                              $html_primary_menu .= '<div class="rsc-dropdown-wrap">' . "\n";
                              $html_primary_menu .= '<ul>' . "\n";
                
                              $before_is_parent = true;
                            }
                          } else {
                            $html_primary_menu .= '<li>' . "\n";
                            $html_primary_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                            $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                            $html_primary_menu .= '</a>' . "\n";
                            $html_primary_menu .= '</li>' . "\n";
                          }
                          
                          if($next_is_parent && $before_is_parent) {
                            $html_primary_menu .= '</ul>' . "\n";
                            $html_primary_menu .= '</div>' . "\n";
                            
                            $html_primary_menu .= '</li>' . "\n";
                
                            $before_is_parent = false;
                          }
            
                          if($index_primary_menu == (count($primary_menu_items) - 1) && $before_is_parent) {
                            $html_primary_menu .= '</ul>' . "\n";
                            $html_primary_menu .= '</div>' . "\n";
                            
                            $html_primary_menu .= '</li>' . "\n";
                          }

                          $index_primary_menu++;
                        }
                      }

                      if($halaman_dokter_url) {
                        $html_primary_menu .= '<li>' . "\n";
                        $html_primary_menu .= '<a href="' . esc_url($halaman_dokter_url) . '">' . "\n";
                        $html_primary_menu .= '<button type="button" class="rsc-button primary-gradient fullwidth center medium">' . "\n";
                        $html_primary_menu .= '<span>' . __('Cari Dokter', 'rsc') . '</span>' . "\n";
                        $html_primary_menu .= '</button>' . "\n";
                        $html_primary_menu .= '</a>' . "\n";
                        $html_primary_menu .= '</li>';
                      }

                      echo $html_primary_menu;
                    ?>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
          
          <!-- Desktop nav -->
          <nav class="rsc-desktop-nav">
            <ul>
              <?php
                $html_primary_menu = '';

                if($has_primary_menu) {
                  $index_primary_menu = 0;
                  
                  $before_is_parent = false;

                  foreach($primary_menu_items as $menu_item) {
                    $link = esc_url($menu_item->url);
                    $title = $menu_item->title;
                    $target = $menu_item->target;
                    $is_parent = ($menu_item->menu_item_parent == 0 ? true : false);
                    $has_child = (isset($primary_menu_items[$index_primary_menu+1]) && $primary_menu_items[$index_primary_menu+1]->menu_item_parent == $menu_item->ID ? true : false);
                    $next_is_parent = (isset($primary_menu_items[$index_primary_menu+1]) && $primary_menu_items[$index_primary_menu+1]->menu_item_parent == 0 ? true : false);
                    
                    if($is_parent && !$before_is_parent) {
                      if(!$has_child) {
                        $html_primary_menu .= '<li>' . "\n";
                        $html_primary_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                        $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                        $html_primary_menu .= '</a>' . "\n";
                        $html_primary_menu .= '</li>' . "\n";
                      } else {
                        $html_primary_menu .= '<li>' . "\n";
                        
                        $html_primary_menu .= '<a href="#">' . "\n";
                        $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                        $html_primary_menu .= '<i class="fa-solid fa-chevron-down"></i>' . "\n";
                        $html_primary_menu .= '</a>' . "\n";
          
                        $html_primary_menu .= '<div class="rsc-submenu-wrap">' . "\n";
                        $html_primary_menu .= '<ul>' . "\n";
          
                        $before_is_parent = true;
                      }
                    } else {
                      $html_primary_menu .= '<li>' . "\n";
                      $html_primary_menu .= '<a href="' . esc_url($link) . '" target="' . esc_attr($target) . '">' . "\n";
                      $html_primary_menu .= '<span>' . esc_html($title) . '</span>' . "\n";
                      $html_primary_menu .= '</a>' . "\n";
                      $html_primary_menu .= '</li>' . "\n";
                    }
                    
                    if($next_is_parent && $before_is_parent) {
                      $html_primary_menu .= '</ul>' . "\n";
                      $html_primary_menu .= '</div>' . "\n";
                      
                      $html_primary_menu .= '</li>' . "\n";
          
                      $before_is_parent = false;
                    }
      
                    if($index_primary_menu == (count($primary_menu_items) - 1) && $before_is_parent) {
                      $html_primary_menu .= '</ul>' . "\n";
                      $html_primary_menu .= '</div>' . "\n";
                      
                      $html_primary_menu .= '</li>' . "\n";
                    }

                    $index_primary_menu++;
                  }
                }

                if($halaman_dokter_url) {
                  $html_primary_menu .= '<li>' . "\n";
                  $html_primary_menu .= '<a href="' . esc_url($halaman_dokter_url) . '">' . "\n";
                  $html_primary_menu .= '<button type="button" class="rsc-button primary-gradient">' . "\n";
                  $html_primary_menu .= '<span>' . __('Cari Dokter', 'rsc') . '</span>' . "\n";
                  $html_primary_menu .= '</button>' . "\n";
                  $html_primary_menu .= '</a>' . "\n";
                  $html_primary_menu .= '</li>';
                }

                echo $html_primary_menu;
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <!-- Dropdown Menu -->
</header>