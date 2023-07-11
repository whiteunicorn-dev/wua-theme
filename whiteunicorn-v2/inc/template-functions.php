<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WhiteUnicorn
 */

/**
 * Render template part
 * @param string $path
 */
function render_template_part( $path ) {
	$tempate_part = 'template-parts/' . $path . '.php';
	
	if ( locate_template( $tempate_part ) != '' ) {
		include( locate_template( $tempate_part, false, false ) );
	}
	
	return;
}


/**
 * Render ACF Flexible Content Sections
 * @param obj $section
 */
function render_section( $section ) {
	$layout = str_replace( '_', '-', $section['acf_fc_layout'] );
	$tempate_part = "template-parts/section/$layout.php";
	
	if ( locate_template( $tempate_part ) != '' ) {
		include( locate_template( $tempate_part, false, false ) );
	}
	
	return;
}


/**
 * Render ACF Container Elements
 * @param obj $container: content
 * @param string $template_name = file name of container template
 */
function render_container( $container, $template_name ) {
	$tempate_part = 'template-parts/container/' . $template_name . '.php';
	
	if ( locate_template( $tempate_part ) != '' ) {
		include( locate_template( $tempate_part, false, false ) );
	}
	
	return;
}


/**
 * Render ACF Block Elements
 * @param obj $element: element
 * @param string $template_name = file name of column template
 */
function render_block_element( $element, $template_name ) {
	$tempate_part = 'template-parts/block-element/' . $template_name . '.php';
	
	if ( locate_template( $tempate_part ) != '' ) {
		include( locate_template( $tempate_part, false, false ) );
	}
	
	return;
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function whiteunicorn_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'whiteunicorn_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function whiteunicorn_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'whiteunicorn_pingback_header' );
