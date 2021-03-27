<?php
/**
 * Template part for card block elements
 *
 * @package WhiteUnicorn
 * @param $element
 */

$item = $element['card_column'];
$title = $item['title'];
$image = $item['image'];
$text = $item['text'];
?>

<div class="col card-item">
	<div class="img-cnt"><?php echo wp_get_attachment_image( $image['ID'], 'custom-medium' ); ?></div>
	<div class="label"><?php echo $title; ?></div>
	<div class="content"><?php echo $text; ?></div>
</div>