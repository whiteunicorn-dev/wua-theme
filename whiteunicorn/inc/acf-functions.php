<?php
/**
 * ACF Custom Functions
 *
 * @package WhiteUnicorn
 */

/**
 * Add theme options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Site Contact',
		'menu_title'	=> 'Contact',
		'parent_slug'	=> 'theme-settings',
	));
	
}


/**
 * Google Map API Key
 */
function acf_gmap_update() {
	$theme_general_settings = get_field('theme_general_settings', 'option');
    $g_api_key = ($theme_general_settings and $theme_general_settings['google_api_key']) ? $theme_general_settings['google_api_key'] : false;
	if ($g_api_key) {
    	acf_update_setting('google_api_key', $g_api_key);
	}
}
//add_action('acf/init', 'acf_gmap_update');


/**
 * ACF Admin Functions
 */
function acf_admin_footer() {
	$screen = get_current_screen();
	/*?>

	<script type="text/javascript">
	(function() {
		acf.add_action('ready', function( $el ) {//console.log("READY");
		});
		acf.add_action('load', function( $el ) {//console.log("LOAD");
		});
		acf.add_action('append', function( $el ) {//console.log("elements appended: ", $el);
		});
		acf.add_action('sortstart', function( $el ) {//console.log("sortstart element: ", $el);
		});
		acf.add_action('sortstop', function( $el ) {//console.log("sortstop element: ", $el);
		});
		acf.add_action('invalid_field', function( $el ) {//console.log("invalid_field", $el);
		});
		
	})();
	</script>


	<?php*/
}
add_action('acf/input/admin_footer', 'acf_admin_footer');


/**
 * ACF Typography Field (Add custom fonts to font-family dropdown)
 * NOTE: Must add filter to ACF Typography Field Plugin (acf-Typography-v5.php -> line:429)
 * 		$options = apply_filters('typography_field_select_options', $options, $field, $f );
 * 
 *  REMOVED [1.5.23]
 */
function customize_typography_field( $options, $field, $f ) {
	$theme_typography = get_field('theme_typography', 'option');
	$theme_fonts = $theme_typography['custom_fonts'];
	
	if($theme_fonts and $f == 'font_family') :
		foreach ($theme_fonts as $font) :

			$options .= '<option val="'.$font['font_name'].'" '. ($field['value'][$f] == $font['font_name'] ? 'selected': '') .'>'.$font['font_name'].'</option>';

		endforeach;
	endif;
	
	return $options;
}
//add_filter('typography_field_select_options', 'customize_typography_field', 10, 3);