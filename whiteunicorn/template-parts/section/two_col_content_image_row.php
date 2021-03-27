<?php
/**
 * Template part for two_col_content_image_row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @param $section_count
 */

$content = $section['two_column_blocks'];
$content_cnt = $content['content_container'];
$image_cnt = $content['image_container'];
$sec_settings = $section['section_settings'];
$id_attr = $sec_settings['id_attribute'];
$bg_color = $sec_settings['bg_color'];
$className = $sec_settings['classnames'];
$mw_settings = ( $sec_settings['max_width'] ) ?: '';
$set_max_width = $mw_settings['set_max_width'];
?>

<section id="<?php echo $id_attr; ?>" class="two-col-row sec-<?php echo $section_count; ?> <?php if ( $className ) { ?> <?php echo $className; } ?>"<?php if ( $bg_color ) { ?> style="background:<?php echo $bg_color; ?>"<?php } ?>>

	<div class="inner-wrap flex-cnt col-2"<?php if ( $set_max_width == 1 ) : ?> style="<?php echo render_max_w_style( $mw_settings ); ?>"<?php endif; ?>>

		<?php echo render_container( $content_cnt, 'content' ); ?>

		<?php echo render_container( $image_cnt, 'image' ); ?>

	</div>

</section>
