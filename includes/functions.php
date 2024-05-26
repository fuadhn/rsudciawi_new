<?php

/**
 * Calculate classes for the main <html> element.
 *
 * @since RSUD Ciawi 1.0
 *
 * @return void
 */
function rsc_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since RSUD Ciawi 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'rsc_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'rsc' );
	}
endif;

// Get default logo url
if(!function_exists('rsc_get_default_logo_url')) {
	function rsc_get_default_logo_url($style='') {
		return get_template_directory_uri() . '/dist/img/logo' . $style . '.webp';
	}
}

// Get post thumbnail with default image
if(!function_exists('rsc_get_the_post_thumbnail_url')) {
	function rsc_get_the_post_thumbnail_url($post_id, $default='') {
		$thumbnail_url = esc_url(get_the_post_thumbnail_url($post_id, 'full'));
		
		if($thumbnail_url === '') {
			return $default;
		} else {
			$attachment_id = attachment_url_to_postid($thumbnail_url);
			$thumbnail_path = wp_get_original_image_path($attachment_id);
			$thumbnail_origin = wp_get_original_image_url($attachment_id);

			$ext = pathinfo($thumbnail_url, PATHINFO_EXTENSION);
			$webp_img = str_replace('.' . $ext, '.webp', $thumbnail_path);

			if (file_exists($webp_img)) {
				return str_replace('.' . $ext, '.webp', $thumbnail_origin);
			}

			return $thumbnail_url;
		}
	}
}

// Replace default image ext to webp
if(!function_exists('rsc_get_the_webp_image_url')) {
	function rsc_get_the_webp_image_url($thumbnail_url, $default='') {
		if($thumbnail_url === '') {
			return $default;
		} else {
			$attachment_id = attachment_url_to_postid($thumbnail_url);
			$thumbnail_path = wp_get_original_image_path($attachment_id);
			$thumbnail_origin = wp_get_original_image_url($attachment_id);

			$ext = pathinfo($thumbnail_url, PATHINFO_EXTENSION);
			$webp_img = str_replace('.' . $ext, '.webp', $thumbnail_path);

			if (file_exists($webp_img)) {
				return str_replace('.' . $ext, '.webp', $thumbnail_origin);
			}

			return $thumbnail_url;
		}
	}
}

// Set post views
if(!function_exists('rsc_set_post_views')) {
	function rsc_set_post_views($post_id) {
		$count_key = "rsc_post_views_count";
		$count = get_post_meta($post_id, $count_key, true);

		if($count === '') {
			$count = 1;

			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, 1);
		} else {
			$count++;

			update_post_meta($post_id, $count_key, $count);
		}
	}
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Get the formatted phone number
if(!function_exists('rsc_get_formatted_phone_number')) {
	function rsc_get_formatted_phone_number($phone) {
		return preg_replace("/[^+0-9]/", '', $phone);
	}
}

// Get the formatted list items in HTML
if(!function_exists('rsc_get_formatted_list_items')) {
	function rsc_get_formatted_list_items($string) {
		$list = explode('<br />', $string);

		if(count($list) > 0) {
			$html = '<ul class="rsc-list">' . "\n";

			foreach($list as $item) {
				$values = explode('|', $item);

				if(count($values) > 0) {
					$html .= '<li>' . "\n";
					$html .= '<span>' . $values[0] . '</span>' . "\n";
					$html .= '<span>' . $values[1] . '</span>' . "\n";
					$html .= '</li>' . "\n";
				} else {
					$html .= '<li>' . "\n";
					$html .= '<span>' . $item . '</span>' . "\n";
					$html .= '</li>' . "\n";
				}
			}

			$html .= '</ul>' . "\n";

			return $html;
		} else {
			$html = '<p class="rsc-desc">' . $string .  '</p>';

			return $html;
		}
	}
}

// Get youtube video code from url
if(!function_exists('rsc_get_youtube_video_code_from_url')) {
	function rsc_get_youtube_video_code_from_url($url) {
		if(str_contains($url, 'https://youtu.be/')) {
			return str_replace('https://youtu.be/', '', $url);
		} else {
			$url_components = parse_url($url);

			parse_str($url_components['query'], $params);

			if(isset($params['v'])) {
				return $params['v'];
			} else {
				return $url;
			}
		}
	}
}

// Breadcrumb
if(!function_exists('rsc_breadcrumb')) {
	function rsc_breadcrumb() {
		ob_start();

		echo '<nav class="rsc-breadcrumb">' . "\n";
		echo '<ul>' . "\n";

		echo '<li><i class="fa-solid fa-home fa-sm rsc-text-rscprimary"></i></li>' . "\n";
		echo '<li><a href="' . esc_url(home_url()) . '">' . __('Beranda', 'rsc') . '</a></li>' . "\n";
		echo '<li><span class="rsc-separate">/</span></li>' . "\n";			
	
		if(is_category() || is_single() || is_archive()) {
			$categories = get_the_category();

			if(!empty($categories)) {
				if(is_single()) {
					$postspage_id = get_option('page_for_posts');

					if($postspage_id) {
						echo '<li><a href="' . esc_url(get_the_permalink($postspage_id)) . '">' . esc_html(get_the_title($postspage_id)) . '</a></li>' . "\n";
		
						echo '<li><span class="rsc-separate">/</span></li>' . "\n";
					}

					echo '<li><a href="' . esc_url(get_term_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></li>' . "\n";

					echo '<li><span class="rsc-separate">/</span></li>' . "\n";

					echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
				} else if(is_archive()) {
					$postspage_id = get_option('page_for_posts');
					$current_term_id = get_queried_object()->term_id;
					$current_term = get_term($current_term_id);
		
					if($postspage_id) {
						echo '<li><a href="' . esc_url(get_the_permalink($postspage_id)) . '">' . esc_html(get_the_title($postspage_id)) . '</a></li>' . "\n";
		
						echo '<li><span class="rsc-separate">/</span></li>' . "\n";
					}
		
					echo '<li><span class="rsc-current-page" title="' . esc_attr($current_term->name) . '">' . esc_html($current_term->name) . '</span></li>';
				} else {
					echo '<li><span class="rsc-current-page" title="' . esc_attr($categories[0]->name) . '">' . esc_html($categories[0]->name) . '</span></li>';
				}
			}

			if(is_singular('dokter')) {
				// Halaman
  			$halaman_dokter_url = get_option('rsc_halaman_dokter');
				$halaman_dokter_ID = url_to_postid($halaman_dokter_url);
				
				if($halaman_dokter_url && $halaman_dokter_ID) {
					echo '<li><a href="' . esc_url($halaman_dokter_url) . '">' . esc_html(get_the_title($halaman_dokter_ID)) . '</a></li>' . "\n";

					echo '<li><span class="rsc-separate">/</span></li>' . "\n";
				}

				echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
			}

			if(is_singular('layanan')) {
				echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
			}

			if(is_singular('promo')) {
				// Halaman
  			$halaman_promo_url = get_option('rsc_halaman_promo');
				$halaman_promo_title = url_to_postid($halaman_promo_url);
				
				if($halaman_promo_url && $halaman_promo_title) {
					echo '<li><a href="' . esc_url($halaman_promo_url) . '">' . esc_html(get_the_title($halaman_promo_title)) . '</a></li>' . "\n";

					echo '<li><span class="rsc-separate">/</span></li>' . "\n";
				}

				echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
			}

			if(is_singular('kegiatan')) {
				// Halaman
  			$halaman_pkrs_url = get_option('rsc_halaman_pkrs');
				$halaman_pkrs_title = url_to_postid($halaman_pkrs_url);
				
				if($halaman_pkrs_url && $halaman_pkrs_title) {
					echo '<li><a href="' . esc_url($halaman_pkrs_url) . '">' . esc_html(get_the_title($halaman_pkrs_title)) . '</a></li>' . "\n";

					echo '<li><span class="rsc-separate">/</span></li>' . "\n";
				}

				echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
			}
		} else if(is_page()) {
			echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
		} else if(is_home()) {
			$postspage_id = get_option('page_for_posts');

			echo '<li><span class="rsc-current-page" title="' . esc_attr(get_the_title($postspage_id)) . '">' . esc_html(get_the_title($postspage_id)) . '</span></li>';
		} else if(is_search()) {
			$postspage_id = get_option('page_for_posts');
			$judul_halaman = 'Kata kunci: "' . get_search_query() . '"';

			if($postspage_id) {
				echo '<li><a href="' . esc_url(get_the_permalink($postspage_id)) . '">' . esc_html(get_the_title($postspage_id)) . '</a></li>' . "\n";

				echo '<li><span class="rsc-separate">/</span></li>' . "\n";
			}

			echo '<li><span class="rsc-current-page" title="' . esc_attr($judul_halaman) . '">' . esc_html($judul_halaman) . '</span></li>';
		} else {
			echo '<li><span class="rsc-current-page" title="' . __('Tidak Ditemukan', 'rsc') . '">' . __('Tidak Ditemukan', 'rsc') . '</span></li>';
		}
		
		echo '</ul>' . "\n";
		echo '</nav>' . "\n";

		ob_flush();
		ob_end_clean();
	}
}

// Pagination numbers
if(!function_exists('rsc_numeric_posts_nav')) {
	function rsc_numeric_posts_nav($max_num_pages=null) {
		
		if( is_singular() && !is_page_template('pages/dokter.php') && !is_page_template('pages/promo.php') )
			return;

		global $wp_query;

		if(is_null($max_num_pages)) {
			$max_num_pages = $wp_query->max_num_pages;
		}

		/** Stop execution if there's only 1 page */
		if( $max_num_pages <= 1 )
			return;

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $max_num_pages );

		/** Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/** Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		ob_start();

		echo '<nav class="rsc-pagination"><ul>' . "\n";

		/** Previous Post Link */
		if ( get_previous_posts_link(null, $max) )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-solid fa-arrow-left"></i><span class="rsc-hidden lg:rsc-inline-block">' . __('Sebelumnya', 'rsc') . '</span>', $max) );

		/** Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( ! in_array( 2, $links ) )
				echo '<li><span class="dots">...</span></li>';
		}

		/** Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li><span class="dots">...</span></li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/** Next Post Link */
		if ( get_next_posts_link(null, $max) )
			printf( '<li>%s</li>' . "\n", get_next_posts_link('<span class="rsc-hidden lg:rsc-inline-block">' . __('Selanjutnya', 'rsc') . '</span><i class="fa fa-solid fa-arrow-right"></i>', $max) );

		echo '</ul></nav>' . "\n";
		
		ob_flush();
		ob_end_clean();
	}
}