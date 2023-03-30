<?php
/**
 * Functions to include single or bundled assets.
 * - To use call function on the main template file or call in the functions file
 *
 * @package WhiteUnicorn
 */

define ( 'WUA_CSS_DIR', WUA_RESOURCES_DIR . 'assets/css' . DIRECTORY_SEPARATOR );
define ( 'WUA_JS_DIR', WUA_RESOURCES_DIR . 'assets/js' . DIRECTORY_SEPARATOR );

/**
 * Include Browser JS
 */
function include_browser_js() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'jquery.browser-js.php' );
	}, 0);
}

/**
 * Include Arrive JS
 */
function include_arrive_js() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'arrive-js.php' );
	}, 0);
}

/**
 * Include Slick Carousel
 */
function include_slick() {
	add_action('wp_footer', function() {
		require_once( WUA_INC_DIR . 'assets/slick-carousel.php' );
	}, 0);
}

/**
 * Include Swiper JS
 */
function include_swiper_js() {
	add_action('wp_footer', function() {
		require_once( WUA_INC_DIR . 'assets/swiper-js.php' );
	}, 0);
}

/**
 * Include Shuffle JS
 */
function include_shuffle_js() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'shuffle-js.php' );
	}, 0);
}

/**
 * Include Magnific Popup
 */
function include_magnific_popup() {
	add_action('wp_footer', function() {
		require_once( WUA_INC_DIR . 'assets/magnific-popup.php' );
	}, 0);
}

/**
 * Include Photoswipe JS Lightbox
 */
function include_lightbox() {
	add_action('wp_footer', function() {
		require_once( WUA_INC_DIR . 'assets/photoswipe-lightbox_v4.php' );
	}, 0);
	add_action('wp_footer', function() {
		require_once( WUA_THEME_DIR . 'template-parts/photoswipe_v4.php' );
	}, 0);
}

/**
 * Include GSAP
 */
function include_gsap() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-js.php' );
	}, 0);
}

/**
 * Include ScrollMagic GSAP Plugin
 */
function include_scrollmagic_gsap() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'animation.gsap-js.php' );
	}, 0);
}

/**
 * Include SplitText Plugin
 */
function include_splittext() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-splittext-js.php' );
	}, 0);
}

/**
 * Include GSAP Text Plugin
 */
function include_gsap_text() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-text-js' );
	}, 0);
}

/**
 * Include GSAP DrawSVG Plugin
 */
function include_gsap_drawsvg() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-drawsvg-js.php' );
	}, 0);
}

/**
 * Include GSAP Morph SVG Plugin
 */
function include_gsap_morphsvg() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-morph-svg-js' );
	}, 0);
}

/**
 * Include GSAP ScrollTo Plugin
 */
function include_gsap_scrollTo() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-scroll-to-js' );
	}, 0);
}

/**
 * Include GSAP DEV Tools Plugin
 */
function include_gsap_devtools() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-dev-tools-js' );
	}, 0);
}

/**
 * Include GSAP Motion Path Plugin
 */
function include_gsap_motion_path() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-motion-path-js' );
	}, 0);
}

/**
 * Include GSAP Motion Path Helper Plugin
 */
function include_gsap_motion_path_helper() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-motion-path-helper-js' );
	}, 0);
}

/**
 * Include GSAP Ease Pack Plugin
 */
function include_gsap_ease_pack() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-ease-pack-js' );
	}, 0);
}

/**
 * Include GSAP Custom Ease Plugin
 */
function include_gsap_custom_ease() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-custom-ease-js' );
	}, 0);
}

/**
 * Include GSAP Draggable Plugin
 */
function include_gsap_draggable() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'gsap-draggable-js' );
	}, 0);
}

/**
 * Include ScrollLock JS
 */
function include_scrolllock_js() {
	add_action('wp_footer', function() {
		require_once( WUA_JS_DIR . 'scrolllock-js.php' );
	});
}