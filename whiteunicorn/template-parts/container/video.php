<?php
/**
 * Template part for video containers
 *
 * @package WhiteUnicorn
 * @param $container
 */

$video_type = $container['video_type'];
$video = ( $video_type === 'uploaded' ) ? $container['video'] : $container['embedded_video'];
$placeholder = $container['placeholder'];
$content_container = $container['content_container'];
$content_position = $container['content_position'];
$class_names = ( $container['classnames'] ) ?: '';
?>

<?php if ( $video ) : ?>
<div class="video-cnt <?php echo $class_names; ?>">

	<?php if ( $content_position == 'above' and $content_container ) : ?>
		<?php echo render_container( $content_container, 'content' ); ?>
	<?php endif; ?>

	<div class="video-wrap">
		<div class="row video <?php echo $video_type; ?>" data-video-type="<?php echo $video_type; ?>">
			<?php if ( $video_type == 'embedded' ) : ?>
			<div class="iframe-cnt video-item">
				<?php echo $video; ?>
			</div>
			<?php else : ?>
			<?php if ( $placeholder ) : ?>
			<?php echo wp_get_attachment_image( $placeholder['ID'], 'custom-medium', '', array( "class" => "vid-placeholder bg-cover" ) ); ?>
			<button class="play-btn"><span class="arrow"></span></button>
			<?php endif; ?>
			<video playsinline preload muted loop controls>
				<source src="<?php echo $video['url']; ?>" type="video/mp4">
			</video>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $content_position == 'below' and $content_container ) : ?>
		<?php echo render_container( $content_container, 'content' ); ?>
	<?php endif; ?>

</div>
<?php endif; ?>
