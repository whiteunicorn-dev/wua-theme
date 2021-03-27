<?php
/**
 * Template part for button elements
 *
 * @package WhiteUnicorn
 * @param $element
 */

$button = $element['button_group'];
$text = $button['button_text'];
$link_type = $button['link_type'];
$url = ( $link_type == 'internal' ) ? $button['page_link'] : $button['external_link'];
$target_blank = $button['target_blank'];
$classNames = $button['classnames'];
?>

<a href="<?php echo $url; ?>" class="<?php echo $classNames; ?>"<?php if ( $target_blank == 1 ) { ?> target="_blank"<?php } ?>><?php echo $text; ?></a>