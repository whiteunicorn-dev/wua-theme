<?php
/**
 * WhiteUnicorn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WhiteUnicorn
 */

define ( 'WUA_THEME_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define ( 'WUA_INC_DIR', WUA_THEME_DIR . 'inc' . DIRECTORY_SEPARATOR );
define ( 'WUA_RESOURCES_DIR', WUA_THEME_DIR . 'resources' . DIRECTORY_SEPARATOR );


/**
 * Header Hook
 */
function head_hook() {
$custom_code_hooks = get_field('theme_hooks', 'option');
	echo ($custom_code_hooks and $custom_code_hooks['header_hook']) ? '<!-- Custom Code Header Hook -->' . $custom_code_hooks['header_hook'] : '';
}
add_action('wp_head','head_hook');


/**
 * Body opening Hook
 */
function body_open_hook() {
$custom_code_hooks = get_field('theme_hooks', 'option');
	echo ($custom_code_hooks and $custom_code_hooks['body_open_hook']) ? '<!-- Custom Code Header Hook -->' . $custom_code_hooks['body_open_hook'] : '';
}
add_action('wp_body_open', 'body_open_hook');


/**
 * Footer Hook
 */
function footer_hook() {
$custom_code_hooks = get_field('theme_hooks', 'option');
$page_custom_styles = get_field('page_css');//Custom CSS on each page
$page_custom_js = get_field('page_javascript');//Custom JS on each page
?>
	
	<?php if ($custom_code_hooks and $custom_code_hooks['footer_hook']) : echo '<!-- Custom Code Footer Hook -->' . $custom_code_hooks['footer_hook']; endif; ?>

	<?php if ($page_custom_styles) : ?>
		<!-- Page Styles -->
		<style type="text/css"><?php echo $page_custom_styles; ?></style>
	<?php endif; ?>

	<?php if ($page_custom_js) : ?>
		<!-- Page JS -->
		<script type="text/javascript"><?php echo $page_custom_js; ?></script>
	<?php endif; ?>

<?php	
}
add_action('wp_footer','footer_hook');


/**
 * Theme Setup function
 */
if ( ! function_exists( 'wua_theme_setup' ) ) {
	function wua_theme_setup() {

		# Theme assets (head)
		add_action('wp_head', function() {
			echo '<style type="text/css" id="theme-styles">';
			require_once( WUA_THEME_DIR . 'style.css' );
			echo '</style>';
		}, 9);


		# Theme assets (footer)
		add_action('wp_footer', function() {
			
		}, 0);


		# Enqueue Stylesheets ($handle, $src, $dependencies, $version, $media)
		add_action( 'wp_enqueue_scripts', function() {
			$file = 'css/bundle.css';
			$path =  get_assets_bundle( $file );
			$ver = ( $path === "/dist/$file" ) ? date( "His", filemtime( get_stylesheet_directory() . $path ) ) : null;
			wp_enqueue_style(
				'theme-css-bundle',
				get_template_directory_uri() . $path,
				false,
				$ver //if running "npm run dev" will show version number using timestamp, else null
			);
		});


		# Enqueue Scripts ($handle, $src, $dependencies, $version, $in_footer)
		add_action( 'wp_enqueue_scripts', function() {
			$file = 'js/bundle.js';
			$path =  get_assets_bundle( $file );
			$ver = ( $path === "/dist/$file" ) ? date( "His", filemtime( get_stylesheet_directory() . $path ) ) : null;
			wp_enqueue_script(
				'theme-js-bundle',
				get_template_directory_uri() . $path,
				array( 'jquery' ),
				$ver, //if running "npm run dev" will show version number using timestamp, else null
				true
			);
			//Pass the wp admin ajax url as global variable to theme-js-bundle (in case ajax is needed in the script)
			wp_localize_script( 'theme-js-bundle', 'wua_localized', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ), ));
		});


		# Additional libraries and includes
		include_once( WUA_INC_DIR . 'custom-header.php' );
		include_once( WUA_INC_DIR . 'admin-login.php' );
		include_once( WUA_INC_DIR . 'theme-functions.php' );
		include_once( WUA_INC_DIR . 'template-functions.php' );
		include_once( WUA_INC_DIR . 'template-tags.php' );
		include_once( WUA_INC_DIR . 'helper-functions.php' );
		include_once( WUA_INC_DIR . 'gravity-forms.php' );
		include_once( WUA_INC_DIR . 'shortcode-functions.php' );
		include_once( WUA_INC_DIR . 'tinymce-functions.php' );
		include_once( WUA_INC_DIR . 'register_custom-post-types.php' );
		include_once( WUA_INC_DIR . 'register_taxonomies.php' );
		include_once( WUA_INC_DIR . 'asset-include-functions.php' );
		include_once( WUA_INC_DIR . 'acf-functions.php' );
		//include_once( WUA_INC_DIR . 'customizer.php' );//Customizes backend capabilities but needs to be updated


		# Theme supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'menus' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'custom-background', apply_filters( 'whiteunicorn_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );


		# Register Menu: This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-primary' => esc_html__( 'Main Menu', 'whiteunicorn' ),
		) );

		# Remove extra SVG code from WP
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );


		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WhiteUnicorn, use a find and replace
		 * to change 'whiteunicorn' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'whiteunicorn', get_template_directory() . '/languages' );

		
		
		
		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	}
}
add_action( 'after_setup_theme', 'wua_theme_setup' );




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function whiteunicorn_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'whiteunicorn_content_width', 640 );
}
add_action( 'after_setup_theme', 'whiteunicorn_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function whiteunicorn_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'whiteunicorn' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'whiteunicorn' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'whiteunicorn_widgets_init' );


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

