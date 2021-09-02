<?php
/**
 * Change the login header logo href attribute to open the homepage
 * instead of the default https://wordpress.org/.
 *
 * @link https://developer.wordpress.org/reference/hooks/login_headerurl/
 *
 * @param  string $login_header_url Login header logo URL.
 * @return string Homepage URL.
 */
function wua_change_login_header_url( $login_header_url ) {
	return home_url();
}
add_filter( 'login_headerurl', 'wua_change_login_header_url' );

/**
 * Change the login header logo title attribute to display the Site Title
 * instead of the default "Powered by WordPress".
 *
 * @link https://developer.wordpress.org/reference/hooks/login_headertitle/
 *
 * @param  string $login_header_title Login header logo URL.
 * @return string Site Title.
 */
function wua_change_login_header_title( $login_header_title ) {
	return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'wua_change_login_header_title' );

function wua_change_login_styles() {
	$logo = get_field('theme_header_logo', 'option');
	$main_color = '#1a1a1a';
	$alt_color = 'black';
	?>
	<style type="text/css">

		.login { font-family: saveaur-semi, sans-serif; background-color: #fff; color: #fff; }
		/*Logo*/
		#login h1 a { width: 98px; height: 98px; background: url(<?php echo wp_get_attachment_image_src( $logo, 'full' )[0]; ?>) center no-repeat; background-size: contain; }
		/*Message*/
		#login_error, #login .message, #login .success { border-left: 4px solid #000; font-size: 18px; color: #32373c; border-radius: 0 3px 3px 0; }
		#loginform input:focus { border: 1px solid #888; box-shadow: 0 0 2px rgb( 0, 0, 0, .7 ); }
		p.admin-email__details {
			color: black;
		}
		/*Form*/
		#loginform { background-color: #fff; border-radius: 0; box-shadow: 0 2px 20px 4px rgba(0,0,0,.15); }
		#loginform label { color: <?php echo $main_color; ?>; font-size: 18px;  }
		/*Submit Button*/
		#loginform #wp-submit { background-color: <?php echo $main_color; ?>; color: white; border: 2px solid <?php echo $alt_color; ?>; box-shadow: none; text-shadow: none; border-radius: 0; vertical-align: middle; text-transform: uppercase; font-family: Gotham-Condensed-Bold, sans-serif; letter-spacing: 4px; font-weight: 400!important; transition: all .4s;  }
		#loginform #wp-submit:hover { background-color:<?php echo $alt_color; ?>; border: 2px solid <?php echo $main_color; ?>; color: <?php echo $main_color; ?>; }
		/*Lost Password*/
		.login #nav a,
		.login #backtoblog a { color: <?php echo $main_color; ?> !important; font-size: 16px; transition: all .4s; }
		/*Home Link*/
		.login #backtoblog { margin-top: 5px; }
		.login #nav a:hover,
		.login #backtoblog a:hover { color: #888 !important; }
		/*Remember Me*/
		input[type="checkbox"]:checked:before { color: #000 !important; }
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'wua_change_login_styles', 10 );