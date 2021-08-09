<?php
/**
 * Custom Helper Functions
 *
 * @package WhiteUnicorn
 */


/**
 * Get contact object
 * @return {obj} $obj->contact, $obj->location, $obj->hours
 */
function get_contact() {
	$contact = get_field('site_contact', 'option');
	$contactInfo = $contact['contact'];
	$location = $contact['location'];
	$hours = $contact['hours'];
	$obj = array(
				"contact" => $contactInfo,
				"location" => $location,
				"hours" => $hours
			);
	return $obj;
}


/**
 * Get custom image object
 * @param {int} $postID: (default: $post->ID)
 * @param {string} $size: attachment size (default:'full')
 * @return {obj} $obj->src, $obj->srcset
 */
function get_attachment( $postID, $size = 'full' ) {
	$postID = ( $postID ) ?: get_the_ID();
	$attachment = wp_get_attachment_image_src( $postID, $size );
	$imgAlt = get_post_meta($postID, '_wp_attachment_image_alt', TRUE);
	$obj = array(
				"src" => $attachment[0],
				"srcset" => wp_get_attachment_image_srcset( $postID, $size ),
				"width" => $attachment[1],
				"height" => $attachment[2],
				"alt" => $imgAlt,
			);
	return $obj;
}


/**
 * Shortcut for outputting: <pre><?php print_r( $var ); ?></pre>
 * @param {obj} $var: variable that you're trying to output
 * @param {bool} $display: hide or display the content
 * @return {string} render print_r( $var ) wrapped in pre tags
 */
function printR( $var, $display = false ) {
	echo ( $display != false ) ? '<pre>' : '<pre style="display:none;">';
	print_r( $var );
	echo '</pre>';
	return;
}


/**
 * Get wp attachment image
 * @param {int} $imgID
 * @param {string} $size: (default: 'full')
 * @param {string} $classes: classnames for image (default: '')
 * @return {obj} echo wp_get_attachment_image()
 */
function wp_img( $imgID, $size = 'full', $classes = '' ) {
	echo wp_get_attachment_image( $imgID, $size, '', array( "class" => $classes ) );
	return;
}


/**
 * Render wp attachment image with cover class
 * @param {int} $imgID
 * @param {string} $size: (default: 'full')
 * @return {string} echo wp_get_attachment_image()
 */
function wp_img_cvr( $imgID, $size = 'full' ) {
	echo wp_get_attachment_image( $imgID, $size, '', array( "class" => "cover img-cv" ) );
	return;
}


/**
* Get attachment object of the featured image
*
* @param {int} post ID for the featured image
* @return {obj} custom attachment object (src,srcset,w,h)
*/
function get_featured_img( $postID ) {
	return get_attachment( get_post_thumbnail_id( $postID ) );
}


/**
* Render JSON encoded PHP object
*
* @param {obj} PHP object to convert to JSON
* @return {string} JSON encoded string
*/
function render_json( $obj ) {
	echo json_encode( $obj, JSON_UNESCAPED_SLASHES );//unescaped slashes to use with html inside $obj
	return;
}


/**
* Get embed url for youtube/vimeo links
*
* @param {string} video url
* @return {string} returns embed url
*/
function getVideoEmbedUrl( $url ) {
	$embed = false;
	$oembedType = getOembedType( $url );
	if ( $oembedType === "youtube" ) {
		$videoID = getYouTubeID( $video );
		if ( $videoID ) { $embed = "http://youtube.com/embed/$videoID"; }
	}
	elseif ( $oembedType === "vimeo" ) {
		$videoID = getVimeoID( $video );
		if ( $videoID ) { $embed = "http://player.vimeo.com/video/$videoID"; }
	}

	return $embed;
}


/**
* Get oEmbed type from url
*
* @param {string} video url
* @return {string} returns youtube,vimeo or false
*/
function getOembedType( $url ) {
	$oembedType = false;
	if ( preg_match('%youtube|youtu\.be%i', $url) ) {
		$oembedType = "youtube";
	}
	elseif ( preg_match('%vimeo%i', $url) ) {
		$oembedType = "vimeo";
	}

	return $oembedType;
}


/**
 * Get Video ID for Vimeo oEmbed
 * 
 * @param {string} video url
 * @return {string || boolen} returns video id or false
 */
function getVimeoID( $url ) {
    if ( preg_match( '#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m ) ) {
        return $m[1];
    }
    return false;
}
 

/**
 * Get Video Thumbnail for Vimeo oEmbed
 * 
 * @param {string} video id
 * @return {string} returns thumbnail source
 */
function getVimeoThumb( $id ) {
    $arr_vimeo = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$id.php" ) );
    //return $arr_vimeo[0]['thumbnail_small']; // returns small thumbnail
    // return $arr_vimeo[0]['thumbnail_medium']; // returns medium thumbnail
    return $arr_vimeo[0]['thumbnail_large']; // returns large thumbnail
}


/**
* Get Video ID for YouTube oEmbed
* 
* @param {string} video url
* @return {string} returns video id
*/
function getYouTubeID( $url ) {
    $regExp = "/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/";
    preg_match( $regExp, $url, $video );
    return $video[7];
}
 

/**
* Get Video Thumbnail for YouTube oEmbed
* 
* @param {string} video id
* @return {string} returns thumbnail source
*/
function getYouTubeThumb( $video_id ) {
    return "//i3.ytimg.com/vi/$video_id/hqdefault.jpg";
}


/**
* Sanitize phone number
*
* @param {string} phone number
* @return {string} hyperlink friendly number (123-456-7890)
*/
function sanitize_phone_number( $phoneNumber ) {
	if ( strlen( $phoneNumber ) < 10 ) { return $phoneNumber; }
	$number = preg_replace( "/[^0-9]/", "", $phoneNumber );
	$number = substr_replace( $number, '-', 6, 0 );//123456-7890
	$number = substr_replace( $number, '-', 3, 0 );//123-456-7890
	return $number;
}


/**
* Split a string intro array by new line
*
* @param {string} string to split (usually comes from a textarea input value)
* @return {array} an array of strings
*/
function split_newline( $string ) {
	return preg_split("/\r\n|\n|\r/", $string );
}


/**
* Load an inline SVG with wp attachment
*
* @param {int} $attachment_id The filename of the SVG you want to load.
* @return {string} The content of the SVG you want to load.
*/
function load_inline_svg( $attachmentID ) {
    $svg = get_attached_file( $attachmentID );

    // Check the SVG file exists
    if ( file_exists( $svg ) ) {
        // Load and return the contents of the file
        return file_get_contents( $svg );
    }
    // Return a blank string if we can't find the file.
    return '';
}


/**
* Load an inline SVG with filename
*
* @param {string} $filename The filename of the SVG you want to load.
* @return {string} The content of the SVG you want to load.
*/
function load_inline_svg_filename( $filename ) {
    // Add the path to your SVG directory inside your theme.
    $svg_path = '/resources/images/';
 
    // Check the SVG file exists
    if ( file_exists( get_stylesheet_directory() . $svg_path . $filename ) ) {
        // Load and return the contents of the file
        return file_get_contents( get_stylesheet_directory_uri() . $svg_path . $filename );
    }
    // Return a blank string if we can't find the file.
    return '';
}


/**
 * Never worry about cache again!
 *  NOTE: 
 * 		This is a little trick I’ve picked up along the way.
 *  	The version of the .js and .css files is made from the time of it’s last update.
 * 		That way, you will always use the cached versions, except in case the files were changed in the meanwhile, which is the most optimum scenario.
 *		- This was taken from (https://developer.wordpress.org/reference/functions/wp_enqueue_script/) -> user contributed notes
 */
function my_load_scripts($hook) {
 
    // create my own version codes
    $my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/custom.js' ));
    $my_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'style.css' ));
     
    // 
    wp_enqueue_script( 'custom_js', plugins_url( 'js/custom.js', __FILE__ ), array(), $my_js_ver );
    wp_register_style( 'my_css',    plugins_url( 'style.css',    __FILE__ ), false,   $my_css_ver );
    wp_enqueue_style ( 'my_css' );
 
}
//add_action('wp_enqueue_scripts', 'my_load_scripts');