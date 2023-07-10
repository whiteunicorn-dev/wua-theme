<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WhiteUnicorn
 */

$headerSettings = get_field('site_header', 'option');
$headerLogo = ( $headerSettings and $headerSettings['logo'] ) ? $headerSettings['logo'] : false;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<!-- For Screen Readers -->
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'whiteunicorn' ); ?></a>

	<header id="site-header">
		<div class="inner-wrap">
			<!-- Logo -->
			<div class="site-branding">
				<?php if ( $headerLogo ) : ?>
				<a href="/" id="header-logo" class="logo-cnt"><?php echo wp_get_attachment_image( $headerLogo, 'full' ); ?></a>
				<?php else : ?>
				<a href="/" class="site-title"><?php echo get_bloginfo(); ?></a>
				<?php endif; ?>
			</div>

			<!-- Nav -->
			<nav id="site-navigation" class="main-navigation">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-primary',
						'menu_id'        => 'main-nav',
						'container_class'=>	'main-nav-cnt',
					) );
				?>
			</nav>

			<!-- Menu Button -->
			<button class="js-menu-toggle header-menu-btn mobile-menu-btn"><span class="a"></span><span class="b"></span><span class="c"></span></button>
		</div>
	</header><!-- #site-header -->

	<div id="content" class="site-content">
