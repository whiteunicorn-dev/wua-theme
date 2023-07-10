<?php
/**
 * Template part for video containers
 *
 * @package WhiteUnicorn
 * @param $container
 */

$video = get_video_settings( $container );
if ( !$video['url'] ) { return; }
?>

<div class="video-group-cnt <?php echo $video['videoGroupContainerClass']; ?>">

	<div class="row video <?php echo $video['type']; ?>" data-video-type="<?php echo $video['type']; ?>">
		<?php if ( $video['type'] == 'embedded' ) : ?>
		<div class="oembed-cnt <?php echo $video['videoContainerClass']; ?><?php if ( str_contains( $video['videoAttributes'], "controls=1" ) ) { echo ' has-controls'; } ?>">
			<?php /*<iframe class="lazyload" data-src="<?php echo $videoUrl; ?>?&autoplay=1&loop=1&title=0&controls=0&muted=1" frameborder="0" allow="autoplay;"></iframe>*/ ?>
			<?php echo html_entity_decode( $video['videoDOMString'] ); ?>
		</div>
		<?php else : ?>
		<div class="video-cnt <?php echo $video['videoContainerClass']; ?>">
			<?php /*<video playsinline preload muted loop controls><source src="<?php echo $video['url']; ?>" type="video/mp4"></video>*/ ?>
			<?php echo html_entity_decode( $video['videoDOMString'] ); ?>
		</div>
		<?php endif; ?>
	</div>

</div>
