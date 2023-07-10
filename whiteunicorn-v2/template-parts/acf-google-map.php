<?php
/**
 * Template part for displaying ACF Google Map
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WhiteUnicorn
 */

global $post;

$map = get_field('map');
$map_settings = get_field('map_settings');

if( !empty($map) ): ?>
	<section id="g-map">
		<div id="<?php echo $map_settings['container_id']; ?>" class="acf-map <?php echo $map_settings['container_class']; ?>">
			<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
		</div>
	</section>

	<style type="text/css">
	#g-map .acf-map {
		height: <?php echo $map_settings['map_height']; ?>;
	}
	</style>
	
<?php 
	include( locate_template( 'inc/acf-map-script.php', false, false ) );
endif; ?>


