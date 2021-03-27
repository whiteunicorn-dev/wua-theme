<?php
/**
 * Custom TinyMCE Functions
 *
 * @package WhiteUnicorn
 */


/**
 * Add shortcode buttons to TinyMCE
 */
function wua_add_mce_button() {
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) &&  ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'wua_add_tinymce_script' );
		add_filter( 'mce_buttons', 'wua_register_mce_button' );
	}
}
add_action( 'admin_head', 'wua_add_mce_button' );


/**
 * Register buttons
 */
function wua_register_mce_button( $buttons ) {
	array_push( $buttons, 'cols', 'col-1of2', 'col-1of3' );
	
	return $buttons;
}


/**
 * Add JS files for buttons
 */
function wua_add_tinymce_script( $plugin_array ) {
	$plugin_array['cols'] = get_stylesheet_directory_uri() .'/js/tinymce/cols.js';
	$plugin_array['col-1of2'] = get_stylesheet_directory_uri() .'/js/tinymce/col-1of2.js';
	$plugin_array['col-1of3'] = get_stylesheet_directory_uri() .'/js/tinymce/col-1of3.js';
	
	return $plugin_array;
}






