<?php
/**
 * Custom Helper Functions
 *
 * @package WhiteUnicorn
 */


/**
 * Get the path to a versioned bundle relative to the theme directory.
 *
 * @param {string} $path
 * @return {string}
 */
function get_assets_bundle( $path ) {
	static $manifest = null;

	if ( is_null( $manifest ) ) {
		$manifest_path = WUA_THEME_DIR . 'dist/manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$manifest = array();
		}
	}

	$path = isset( $manifest[ $path ] ) ? $manifest[ $path ] : $path;
	return '/dist/' . $path;
}


/**
 * Get custom image object
 * @param {int} $postID: (default: $post->ID)
 * @param {string} $size: attachment size (default:'full')
 * @param {array} $attr: (alt,title,caption,description) Optional
 * @return {array} (src,srcset,width,height,[alt,title,caption,description])
 */
function get_attachment( $postID, $size = 'full', $attr = false ) {
	$postID = ( $postID ) ?: get_the_ID();
	$src = wp_get_attachment_image_src( $postID, $size );
	$obj = array(
				"src" => $src[0],
				"srcset" => wp_get_attachment_image_srcset( $postID, $size ),
				"width" => $src[1],
				"height" => $src[2]
			);
	if ( $attr != false ) { 
		$attachment = get_post( $postID );
		if ( isset( $attr['alt'] ) ) { $obj['alt'] = get_post_meta($postID, '_wp_attachment_image_alt', TRUE); }
		if ( isset( $attr['title'] ) ) { $obj['title'] = $attachment->post_title; }
		if ( isset( $attr['caption'] ) ) { $obj['caption'] = $attachment->post_excerpt; }
		if ( isset( $attr['description'] ) ) { $obj['description'] = $attachment->post_content; }
	}
	return $obj;
}


/**
 * Shortcut for outputting: <pre><?php print_r( $var ); ?\></pre>
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
function get_featured_img( $postID, $size = 'full' ) {
	return get_attachment( get_post_thumbnail_id( $postID ), $size );
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
		$videoID = getYouTubeID( $url );
		if ( $videoID ) { $embed = "//youtube.com/embed/$videoID"; }
	}
	elseif ( $oembedType === "vimeo" ) {
		$videoID = getVimeoID( $url );
		if ( $videoID ) { $embed = "//player.vimeo.com/video/$videoID"; }
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
* Get Trimmed String Excerpt
* @param {string} string to trim
* @param {int} max character length (default: 100)
* @param {string} text to add at end of trimmed string (default: '...')
* @return {string} if string is longer than length limit will return trimmed string with ellipse
*/
function trim_string_length( $string = '', $length = 100, $ellipse = ' ...' ) {
   return ( strlen( $string ) > $length ) ? substr( $string, 0, $length ) . $ellipse : $string;
}


/**
 * Get Substring in between a start and end point
 * @param {string} string to parse
 * @param {string} starting point
 * @param {string} end point
 * @return {string} substring
 */
function get_string_between( $string, $start, $end ) {
    $string = ' ' . $string;
    $ini = strpos( $string, $start );
    if ( $ini == 0 ) return '';
    $ini += strlen( $start);
    $len = strpos( $string, $end, $ini ) - $ini;

    return substr( $string, $ini, $len );
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
 * Get substring between two strings(or characters)
 * @param {string} $string string to parse
 * @param {string} $start begining string
 * @param {string} $end ending string
 * @return {string} string in-between the start and end strings
 */
function getSubstring($string, $start, $end) {
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}//getSubstring("{{CONTENT TO EXTRACT}}, "{{", "}}");


/**
* Load an inline SVG with filename
*
* @param {string} $filename The filename of the SVG you want to load.
* @param {string} $svg_path The path to the folder that has the SVG you want to load. (Default: /dist/images/)
* @return {string} The content of the SVG you want to load.
*/
function load_inline_svg_filename( $filename, $svg_path = '/dist/images/' ) {
    // Check the SVG file exists
    if ( file_exists( get_stylesheet_directory() . $svg_path . $filename ) ) {
        // Load and return the contents of the file
        return file_get_contents( get_stylesheet_directory() . $svg_path . $filename );
    }
    // Return a blank string if we can't find the file.
    return '';
}


/**
 * Get Previous Post ID
 * @return {int} post ID
 * @link https://wordpress.stackexchange.com/questions/47957/reverse-next-prev-page-order
 */
function get_prev_post_ID() {
	global $post;
	$prevPost = ( get_next_post() )?: get_last_post();
	$prevPostID = $prevPost->ID;

	return $prevPostID;
}


/**
 * Get Next Post ID
 * @return {int} post ID
 * @link https://wordpress.stackexchange.com/questions/47957/reverse-next-prev-page-order
 */
function get_next_post_ID() {
	global $post;
	$nextPost = ( get_previous_post() ) ?: get_latest_post();
	$nextPostID = $nextPost->ID;

	return $nextPostID;
}


/**
 * Get Latest Post
 * @return {obj} post
 * @link https://wordpress.stackexchange.com/questions/47957/reverse-next-prev-page-order
 */
function get_latest_post( $postType = false ) {
	$postType = ( ! $postType ) ? get_post_type() : $postType;
	return get_posts("post_type={$postType}&numberposts=2&orderby=menu_order&order=ASC")[0];
	// [to sort without using menu_order] => post_type=${postType}&numberposts=1&order=DESC
}


/**
 * Get Last Post
 * @return {obj} post
 * @link https://wordpress.stackexchange.com/questions/47957/reverse-next-prev-page-order
 */
function get_last_post( $postType = false ) {
	$postType = ( ! $postType ) ? get_post_type() : $postType;
	return get_posts("post_type={$postType}&numberposts=2&orderby=menu_order&order=DESC")[0];
	// [to sort without using menu_order] => post_type=${postType}&numberposts=1&order=ASC
}


/**
 * Get contact object
 * @return {obj} phone,email,address,gmaps_link,hours,social_media_links
 */
function get_contact() {
	$contact = get_field('site_contact', 'option');
	return ( $contact ) ?: 'error getting contact info';
}


/**
 * Get Video Settings (For use with the ACF Page Builder Elements->Video Container field group)
 * @param {obj} $container (ACF field group)
 * @return {obj} $video: 
 */
function get_video_settings( $fieldGroup ) {
	$video_type = $fieldGroup['video_type'];
	$media = ( $video_type === 'uploaded' ) ? $fieldGroup['video'] : $fieldGroup['embedded_video'];
	$videoUrl = ( $video_type === 'uploaded' ) ? $media['url'] : getVideoEmbedUrl( $media );
	$placeholder = $fieldGroup['placeholder'];
	$aspectRatioClass = ( $fieldGroup['aspect_ratio_class'] ) ?: 'ar--16-9';
	$aspectRatioCustom = ( $fieldGroup['aspect_ratio_custom'] ) ?: false;
	$videoCntClass = ( $aspectRatioClass != 'ar--none' ) ? "$aspectRatioClass {$fieldGroup['video_container_class']}" : $fieldGroup['video_container_class'];

	$videoTagSettings = $fieldGroup['video_tag_settings'];
	$iframeSettings = $fieldGroup['iframe_settings'];
	$lazyLoad = ( $video_type === "uploaded" ) ? $videoTagSettings['lazyload'] : $iframeSettings['lazyload'];
	$autoplay = ( $video_type === "uploaded" ) ? $videoTagSettings['autoplay'] : $iframeSettings['autoplay'];
	$attributes = ( $video_type === "uploaded" ) ? $videoTagSettings['video_attributes'] : $iframeSettings['url_attributes'];
	$videoClass = "";
	$tagAttributes = "";
	$videoDOMString = "";
	//Uploaded Video Settings
	if ( $video_type === "uploaded" ) {
		$videoClass = ( $autoplay === 'js-video-scrollplay' ) ? $autoplay : "";
		$videoClass .= ( $videoTagSettings['object_fit'] != 'initial' ) ? " {$videoTagSettings['object_fit']}" : "";
		$videoClass .= ( $lazyLoad ) ? " js-lazy-video" : "";
		if ( $attributes ) {
			if ( $autoplay === 'default-autoplay' ) {
				$attributes .= ( !str_contains( $attributes, "autoplay" ) ) ? " autoplay" : "";
				$attributes .= ( !str_contains( $attributes, "muted" ) ) ? " muted" : "";
			}
			if ( $placeholder ) {
				$attributes .= ' poster="' . wp_get_attachment_url( $placeholder['ID'] ) . '"';
			}
		}
		$videoDOMString = '<video class="' . $videoClass . '" ' . $attributes . ">";
		$videoDOMString .= ( !$lazyLoad ) ? '<source src="' : '<source data-src="';
		$videoDOMString .= $videoUrl . '" type="video/mp4">';
		$videoDOMString .= '</video>';
	}
	//oEmbed Video Settings
	else {
		$videoClass = ( $lazyLoad ) ? "lazyload" : "";
		$tagAttributes = ' frameborder="0"';
		$tagAttributes .= ( $autoplay ) ? ' allow="autoplay"' : '';
		$attributes = ( str_starts_with( $attributes, "?" ) ) ? substr( $attributes, 1 ) : $attributes;
		if ( str_contains( $media, "vimeo" ) ) { // for vimeo videos set to hidden (accounts for token parameter "h" in the embed url)
			if ( str_contains( $media, "?h=" ) ) {
				preg_match('/src="([^"]+)"/', $media, $match);
				$url = $match[1];
				$urlParse = parse_url( $url );
				parse_str( $urlParse['query'], $params );
				if ( $params['h'] ) { $attributes = "h={$params['h']}" . ( !str_starts_with( $attributes, '&' ) ? "&" : "" ) . "$attributes"; }
			}
			else if ( preg_match( '#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*(?:[0-9]{6,11})*(/[0-9a-z]*)[?]?.*#', $media, $m ) ) {
				$videoUrl .= $m[1];
			}
		}
		$videoDOMString = '<iframe class="' . $videoClass . '" ';
		$videoDOMString .= ( $lazyLoad ) ? 'data-src="' . $videoUrl . '?' . $attributes . '"' : 'src="' . $videoUrl . '?' . $attributes . '"';
		$videoDOMString .= ' ' . $tagAttributes . '></iframe>';
	}

	$video = array(
		"type" => $video_type,
		"url" => $videoUrl,
		"placeholder" => ( $placeholder ) ?: false,
		"aspectRatioClass" => $aspectRatioClass,
		"aspectRatioCustom" => $aspectRatioCustom,
		"videoContainerClass" => $videoCntClass,
		"autoplay" => $autoplay,
		"lazyload" => $lazyLoad,
		"videoTagClass" => $videoClass,
		"tagAttributes" => $tagAttributes,
		"videoAttributes" => $attributes,
		"videoDOMString" => esc_html( $videoDOMString ),
		"embedFullUrl" => $videoUrl . '?' . $attributes,
		"portfolioPageVideoUrl" => ( $params['h'] ) ? "$videoUrl?h={$params['h']}" : $videoUrl,
		"vimeoUrlParse" => $urlParse,
		"vimeoUrlParams" => $params,
	);
	return $video;
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