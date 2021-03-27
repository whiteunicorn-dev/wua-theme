<?php
/**
 * Custom Theme Functions
 *
 * @package WhiteUnicorn
 */

/**
 * Add classes to body tag
 */
function customize_body_classes( $classes ) {
	$headerSettings = get_field('theme_header_settings', 'option');
	$headerType = $headerSettings['header_type'][0];
	$className = '';
	if ( $headerType != 'standard' ) {
		$className = 'header-' . $headerType;
	}
	
	return array_merge( $classes, array( $className ) );
}
add_filter( 'body_class', 'customize_body_classes' );


/**
 * Custom Image Sizes
 */
function custom_image_sizes() {
    add_image_size( 'custom-large', 1500 );//1500px wide (and unlimited height)
	add_image_size( 'custom-medium', 800 );
	add_image_size( 'custom-small', 500 );
    //add_image_size( 'custom-thumb', 350, 300, true );//350 x 300 (cropped)
}
add_action( 'init', 'custom_image_sizes' );


/**
 * Fix svg preview in media
 */
function svg_preview_fix( $response ) {
	if ( $response['mime'] === 'image/svg+xml') {
		$response['sizes'][ 'full' ] =  array(
			'orientation' => 'portrait',
			'url'         => $response['url'],
			'width'       => 0,
			'height'      => 0,
		);

		$response['image'] = compact( 'width', 'height' );
		$response['thumb'] = compact( 'width', 'height' );
	}

	return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'svg_preview_fix' );
function crb_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'crb_mime_types' );


/**
 * Hide Editor From Templates
 */
function crb_hide_editor() {
	$post_id = false;
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	else if ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	$post_id = intval( $post_id );
	if ( ! $post_id ) {
		return;
	}
	
	$current_template = get_page_template_slug( $post_id );
	$exclude_on = array(
		'templates/home.php',
		'templates/biographic.php',
		'templates/events.php',
		'templates/fan-club.php',
		'templates/press.php'
	);
	if( in_array( $current_template, $exclude_on ) ){
		remove_post_type_support('page', 'editor');
		remove_post_type_support('page', 'thumbnail');
	}
}
//add_action( 'admin_init', 'crb_hide_editor' );