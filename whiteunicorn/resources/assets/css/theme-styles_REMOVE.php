<?php
/**
 * WUA theme styles
 *
 * Includes theme stylesheet (style.css) and styles set from theme option pages in WP Admin.
 *
 * @package WhiteUnicorn
 */
$theme_typography = get_field('theme_typography', 'option');
$theme_fonts = $theme_typography['custom_fonts'];
$disable_body = $theme_typography['disable_group_body'];
$body_typography = $theme_typography['body_typography'];
$headers_typography = $theme_typography['headers_group'];
$h1_typography = $headers_typography['h1_settings'];
$disable_h1 = $headers_typography['disable_group_h1'];
$h2_typography = $headers_typography['h2_settings'];
$disable_h2 = $headers_typography['disable_group_h2'];
$h3_typography = $headers_typography['h3_settings'];
$disable_h3 = $headers_typography['disable_group_h3'];
$h4_typography = $headers_typography['h4_settings'];
$disable_h4 = $headers_typography['disable_group_h4'];
$h5_typography = $headers_typography['h5_settings'];
$disable_h5 = $headers_typography['disable_group_h5'];
$responsive_settings = $theme_typography['responsive_group'];
?>

<style type="text/css" id="theme-styles">

<?php 
//WUA Theme basic styles and normalize/browser style resets
require_once( WUA_THEME_DIR . 'style.css' ); ?>


<?php if( $theme_fonts ) :
	foreach ( $theme_fonts as $font ) : ?>
	/*** Custom Fonts ***/
	@font-face {
		font-family: <?php echo $font['font_name']; ?>;
		font-display: swap;
		src: url(<?php echo $font['font_file']; ?>);
	}
	<?php
	endforeach;
endif;
?>


<?php if( $body_typography and !$disable_body ) : ?>
	/*** Body ***/
	* {
		<?php if ( $body_typography['font_size'] ) : ?>font-size: <?php echo $body_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $body_typography['font_family'] ) : ?>font-family: <?php echo $body_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $body_typography['font_weight'] ) : ?>font-weight: <?php echo $body_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $body_typography['font_style'] ) : ?>font-style: <?php echo $body_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $body_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $body_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $body_typography['line_height'] ) : ?>line-height: <?php echo $body_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $body_typography['text_color'] ) : ?>color: <?php echo $body_typography['text_color']; ?>;<?php endif; ?>
	}

<?php endif; ?>



	/*** Headers ***/
<?php if( $h1_typography && !$disable_h1 ) : ?>
	h1 {
		<?php if ( $h1_typography['font_size'] ) : ?>font-size: <?php echo $h1_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $h1_typography['font_family'] ) : ?>font-family: <?php echo $h1_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $h1_typography['font_weight'] ) : ?>font-weight: <?php echo $h1_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $h1_typography['font_style'] ) : ?>font-style: <?php echo $h1_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $h1_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $h1_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $h1_typography['line_height'] ) : ?>line-height: <?php echo $h1_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $h1_typography['text_color'] ) : ?>color: <?php echo $h1_typography['text_color']; ?>;<?php endif; ?>
		<?php if ( $h1_typography['text_transform'] ) : ?>text-transform: <?php echo $h1_typography['text_transform']; ?>;<?php endif; ?>
	}
<?php endif; ?>

<?php if( $h2_typography && !$disable_h2 ) : ?>
	h2 {
		<?php if ( $h2_typography['font_size'] ) : ?>font-size: <?php echo $h2_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $h2_typography['font_family'] ) : ?>font-family: <?php echo $h2_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $h2_typography['font_weight'] ) : ?>font-weight: <?php echo $h2_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $h2_typography['font_style'] ) : ?>font-style: <?php echo $h2_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $h2_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $h2_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $h2_typography['line_height'] ) : ?>line-height: <?php echo $h2_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $h2_typography['text_color'] ) : ?>color: <?php echo $h2_typography['text_color']; ?>;<?php endif; ?>
		<?php if ( $h2_typography['text_transform'] ) : ?>text-transform: <?php echo $h2_typography['text_transform']; ?>;<?php endif; ?>
	}
<?php endif; ?>

<?php if( $h3_typography && !$disable_h3 ) : ?>
	h3 {
		<?php if ( $h3_typography['font_size'] ) : ?>font-size: <?php echo $h3_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $h3_typography['font_family'] ) : ?>font-family: <?php echo $h3_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $h3_typography['font_weight'] ) : ?>font-weight: <?php echo $h3_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $h3_typography['font_style'] ) : ?>font-style: <?php echo $h3_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $h3_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $h3_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $h3_typography['line_height'] ) : ?>line-height: <?php echo $h3_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $h3_typography['text_color'] ) : ?>color: <?php echo $h3_typography['text_color']; ?>;<?php endif; ?>
		<?php if ( $h3_typography['text_transform'] ) : ?>text-transform: <?php echo $h3_typography['text_transform']; ?>;<?php endif; ?>
	}
<?php endif; ?>

<?php if( $h4_typography && !$disable_h4 ) : ?>
	h4 {
		<?php if ( $h4_typography['font_size'] ) : ?>font-size: <?php echo $h4_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $h4_typography['font_family'] ) : ?>font-family: <?php echo $h4_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $h4_typography['font_weight'] ) : ?>font-weight: <?php echo $h4_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $h4_typography['font_style'] ) : ?>font-style: <?php echo $h4_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $h4_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $h4_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $h4_typography['line_height'] ) : ?>line-height: <?php echo $h4_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $h4_typography['text_color'] ) : ?>color: <?php echo $h4_typography['text_color']; ?>;<?php endif; ?>
		<?php if ( $h4_typography['text_transform'] ) : ?>text-transform: <?php echo $h4_typography['text_transform']; ?>;<?php endif; ?>
	}
<?php endif; ?>

<?php if( $h5_typography && !$disable_h5 ) : ?>
	h5 {
		<?php if ( $h5_typography['font_size'] ) : ?>font-size: <?php echo $h5_typography['font_size']; ?>px;<?php endif; ?>
		<?php if ( $h5_typography['font_family'] ) : ?>font-family: <?php echo $h5_typography['font_family']; ?>;<?php endif; ?>
		<?php if ( $h5_typography['font_weight'] ) : ?>font-weight: <?php echo $h5_typography['font_weight']; ?>;<?php endif; ?>
		<?php if ( $h5_typography['font_style'] ) : ?>font-style: <?php echo $h5_typography['font_style']; ?>;<?php endif; ?>
		<?php if ( $h5_typography['letter_spacing'] ) : ?>letter-spacing: <?php echo $h5_typography['letter_spacing']; ?>px;<?php endif; ?>
		<?php if ( $h5_typography['line_height'] ) : ?>line-height: <?php echo $h5_typography['line_height']; ?>px;<?php endif; ?>
		<?php if ( $h5_typography['text_color'] ) : ?>color: <?php echo $h5_typography['text_color']; ?>;<?php endif; ?>
		<?php if ( $h5_typography['text_transform'] ) : ?>text-transform: <?php echo $h5_typography['text_transform']; ?>;<?php endif; ?>
	}
<?php endif; ?>
	
	
/*-----------------------------------------------------------------------
--	MEDIA QUERIES
-----------------------------------------------------------------------*/
@media only screen and (max-width: 1023px) {
	<?php
	if( $responsive_settings['body_tablet_font_size'] ) : ?>
		/*** Body ***/
		* {
			font-size: <?php echo $responsive_settings['body_tablet_font_size']; ?>px;
		}

	<?php
	endif;
	?>
		/*** Headers ***/
	<?php 
	if( $responsive_settings['h1_tablet_font_size'] ) : ?>
		h1 {
			font-size: <?php echo $responsive_settings['h1_tablet_font_size']; ?>px;
		}
	<?php
	endif;
	?>

	<?php 
	if( $responsive_settings['h2_tablet_font_size'] ) : ?>
		h2 {
			font-size: <?php echo $responsive_settings['h2_tablet_font_size']; ?>px;
		}
	<?php
	endif;
	?>

	<?php 
	if( $responsive_settings['h3_tablet_font_size'] ) : ?>
		h3 {
			font-size: <?php echo $responsive_settings['h3_tablet_font_size']; ?>px;
		}
	<?php
	endif;
	?>

	<?php 
	if( $responsive_settings['h4_tablet_font_size'] ) : ?>
		h4 {
			font-size: <?php echo $responsive_settings['h4_tablet_font_size']; ?>px;
		}
	<?php
	endif;
	?>

	<?php 
	if( $responsive_settings['h5_tablet_font_size'] ) : ?>
		h5 {
			font-size: <?php echo $responsive_settings['h5_tablet_font_size']; ?>px;
		}
	<?php
	endif;
	?>
	
}/*1023px*/
	
	
@media only screen and (max-width: 650px) {
	<?php if( $responsive_settings['body_mobile_font_size'] ) : ?>
		/*** Body ***/
		* {
			font-size: <?php echo $responsive_settings['body_mobile_font_size']; ?>px;
		}
	<?php endif; ?>
		/*** Headers ***/
	<?php if( $responsive_settings['h1_mobile_font_size'] ) : ?>
		h1 {
			font-size: <?php echo $responsive_settings['h1_mobile_font_size']; ?>px;
		}
	<?php endif; ?>

	<?php if( $responsive_settings['h2_mobile_font_size'] ) : ?>
		h2 {
			font-size: <?php echo $responsive_settings['h2_mobile_font_size']; ?>px;
		}
	<?php endif; ?>

	<?php if( $responsive_settings['h3_mobile_font_size'] ) : ?>
		h3 {
			font-size: <?php echo $responsive_settings['h3_mobile_font_size']; ?>px;
		}
	<?php endif; ?>

	<?php if( $responsive_settings['h4_mobile_font_size'] ) : ?>
		h4 {
			font-size: <?php echo $responsive_settings['h4_mobile_font_size']; ?>px;
		}
	<?php endif; ?>

	<?php if( $responsive_settings['h5_mobile_font_size'] ) : ?>
		h5 {
			font-size: <?php echo $responsive_settings['h5_mobile_font_size']; ?>px;
		}
	<?php endif; ?>
	
}/*650px*/
	

</style>

<?php
