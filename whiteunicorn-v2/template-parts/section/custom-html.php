<?php
/**
 * Template part for custom-html_row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @param $section_count
 */

$html = $section['custom-html_row']['html'];
$settings = $section['section_settings'];
$section_id = ( $settings['id_attribute'] ) ?: 'sec-' . $section_count;
$classnames = ( $settings['classnames'] ) ?: '';
$mw_settings = ( $settings['max_width'] ) ?: '';
$set_max_width = $mw_settings['set_max_width'];
?>

<section id="<?php echo $section_id; ?>" class="custom-html_row-sec sec-<?php echo $section_count; if ( $classnames != '' ) { ?> <?php echo $classnames; } ?>">

	<?php echo $html; ?>

</section>
