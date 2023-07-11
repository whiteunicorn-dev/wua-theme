<?php
/**
 * Template part for video-row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @uses video_item {object} (ACF)
 */

// printR($section);
$video_container = $section['video_container'];
?>

<section class="video-row">
	<div class="section-wrap inner-wrap">
		<?php echo render_container( $video_container, 'video' ); ?>
	</div>
</section>
