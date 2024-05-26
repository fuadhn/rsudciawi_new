<?php

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since RSUD Ciawi 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function rsc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rsc_content_width', 675 );
}
add_action( 'after_setup_theme', 'rsc_content_width', 0 );

// Modify search query
if(!function_exists('rsc_modify_search_query')) {
	function rsc_modify_search_query( $query ) {
		if($query->is_main_query() && $query->is_search() && !is_admin()) {
			$query->set('post_type', array('post'));
			$query->set('post_status', 'publish');
		}
	}

	add_action( 'pre_get_posts', 'rsc_modify_search_query' );
}

// Delete all attached media before delete the post
add_action( 'before_delete_post', function( $id ) {
	$attachments = get_attached_media( '', $id );
	foreach ($attachments as $attachment) {
		wp_delete_attachment( $attachment->ID, 'true' );
	}
} );