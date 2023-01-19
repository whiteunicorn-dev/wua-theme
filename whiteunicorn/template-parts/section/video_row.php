<?php
/**
 * Template part for video_row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @param $section_count
 * @uses video_item object (ACF)
 */

$video_container = $section['video_container'];
$settings = ( isset( $section['project_section_settings'] ) ) ? $section['project_section_settings'] : $section['section_settings'];
$classnames = ( $settings['classnames'] ) ? $settings['classnames'] . " sec-$section_count" : "sec-$section_count";
$maxW = $settings['section_max_width'];
?>

<section class="video-row sec-<?php echo $section_count; ?> <?php echo $classnames; ?>">
	<div class="inner-wrap<?php if ( $maxW ) { echo ' max-width'; } ?>">
		<?php echo render_container( $video_container, 'video' ); ?>
	</div>
</section>
