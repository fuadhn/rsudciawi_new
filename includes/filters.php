<?php

// Add body class
add_filter( 'body_class', 'rsc_default_body_class' );
function rsc_default_body_class( $classes ) {
	$classes[] = 'antialiased bg-body text-body font-body rsc-bg-white';

	return $classes;
}

// Set upload size limit (media)
add_filter( 'upload_size_limit', 'rsc_set_upload_size_limit' );
function rsc_set_upload_size_limit( $bytes ) {
  return 1000000; // 1 megabytes
}

// Auto create webp image from jpeg/png
if(!function_exists('rsc_create_webp_image')) {
	add_filter('wp_handle_upload', 'rsc_create_webp_image');
	function rsc_create_webp_image($file) {
		$ext = pathinfo($file['url'], PATHINFO_EXTENSION);

		if($file['type'] == 'image/png') {
			$img = imagecreatefrompng($file['file']);
			
			imagepalettetotruecolor($img);  
			imagealphablending($img, true);
			imagesavealpha($img, true);
			imagewebp($img, str_replace('.' . $ext, '.webp', $file['file']), 50);
			imagedestroy($img);
		}

		if($file['type'] == 'image/jpeg') {
			$img = imagecreatefromjpeg($file['file']);
			
			imagepalettetotruecolor($img);  
			imagealphablending($img, true);
			imagesavealpha($img, true);
			imagewebp($img, str_replace('.' . $ext, '.webp', $file['file']), 50);
			imagedestroy($img);
		}

		return $file;
	}
}

// Auto delete webp image if exists
if(!function_exists('rsc_delete_webp_image')) {
	add_filter('wp_delete_file', 'rsc_delete_webp_image');
	function rsc_delete_webp_image($file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		if(file_exists(str_replace('.' . $ext, '.webp', $file))) {
			@unlink(str_replace('.' . $ext, '.webp', $file));
		}

		return $file;
	}
}

// Lazyload img for the content
if(!function_exists('rsc_lazyload_img_the_content')) {
	function rsc_lazyload_img_the_content($the_content) {
		if(is_admin() || !is_singular()) {
			return;
		}

		if($the_content === '') {
			return;
		}
		
		// Create a new istance of DOMDocument
		$post = new DOMDocument();
		libxml_use_internal_errors(true);
		// Load $the_content as HTML
		$post->loadHTML($the_content);
		libxml_clear_errors();
		// Look up for all the <img> tags.
		$imgs = $post->getElementsByTagName('img');

		// Iteration time
		foreach( $imgs as $img ) {
			// Let's make sure the img has not been already manipulated by us
			// by checking if it has a data-src attribute (we could also check
			// if it has the fs-img class, or whatever check you might feel is
			// the most appropriate.
			if( $img->hasAttribute('data-image') ) continue;

			// Also, let's check that the <img> we found is not child of a <noscript>
			// tag, we want to leave those alone as well.
			if( $img->parentNode->tagName == 'noscript' ) continue;

			// Let's clone the node for later usage.
			$clone = $img->cloneNode();

			// Get the src attribute, remove it from the element, swap it with
			// data-src
			$src = $img->getAttribute('src');
			$img->removeAttribute('src');   
			$img->setAttribute('data-image', $src);

			// Get the class and add rsc-lazyload to the existing classes
			$imgClass = $img->getAttribute('class');
			$img->setAttribute('class', $imgClass . ' rsc-lazyload');

			// Let's create the <noscript> element and append our original
			// tag, which we cloned earlier, as its child. Then, let's insert
			// it before our manipulated element
			$no_script = $post->createElement('noscript');
			$no_script->appendChild($clone);
			$img->parentNode->insertBefore($no_script, $img);
		};

		return $post->saveHTML();
	}

	add_filter('the_content', 'rsc_lazyload_img_the_content');
}

// Fix duplicate posts and pagination issues
if(!function_exists('rsc_preserve_random_order')) {
	function rsc_preserve_random_order( $orderby ) {
		$seed = floor( time() / 10800 ); // randomize every 3 hours
		$orderby = str_replace( 'RAND()', "RAND({$seed})", $orderby );
		
		return $orderby;
	}

	add_filter( 'posts_orderby', 'rsc_preserve_random_order' );
}