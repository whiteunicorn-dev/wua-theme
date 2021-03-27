<?php
/**
 * Template part for content_row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @param $section_count
 */

$content_container = $section['content_container'];
$settings = $section['section_settings'];
$section_id = ( $settings['id_attribute'] ) ?: 'sec-' . $section_count;
$classnames = ( $settings['classnames'] ) ?: '';
$mw_settings = ( $settings['max_width'] ) ?: '';
$set_max_width = $mw_settings['set_max_width'];
?>

<section id="<?php echo $section_id; ?>" class="content_row-sec sec-<?php echo $section_count; if ( $classnames != '' ) { ?> <?php echo $classnames; } ?>">

	<?php if ( $set_max_width == 1 ) : ?>
	<div class="inner-wrap" style="<?php echo render_max_w_style( $mw_settings ); ?>">
	<?php endif; ?>

	<?php echo render_container( $content_container, 'content' ); ?>

	<?php if ( $set_max_width == 1 ) : ?>
	</div>
	<?php endif; ?>

</section>
