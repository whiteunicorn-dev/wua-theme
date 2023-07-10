<?php
/**
 * Template part for image containers
 *
 * @package WhiteUnicorn
 * @param $container
 */

$image = $container['image'];
$cnt_class_names = ( $container['container_class_names_classnames'] ) ?: '';
$img_class_names = ( $container['image_class_names_classnames'] ) ?: '';
$img_size = ( $container['image_size'] ) ?: 'custom-medium';
$img_obj_fit = ( $container['image_object_fit'] ) ?: 'cover';
$img_obj_pos = ( $container['image_object_position'] ) ?: 'initial';
$img_style_val = 'object-fit:' . $img_obj_fit . ';object-position:' . $img_obj_pos . ';';

if ( $image) : ?>
<div class="img-cnt<?php echo ' ' . $img_obj_fit . ' ' . $cnt_class_names; ?>">
	<?php if ( strpos($img_class_names, 'lazy') === false ) : ?>
	<?php echo wp_get_attachment_image( $image['ID'], $img_size, '', array( "class" => $img_class_names, "style" => $img_style_val ) ); ?>
	<?php else : ?>
	<?php $dsktp_src = wp_get_attachment_image_src( $image['ID'], $img_size )[0]; $mobile_src = wp_get_attachment_image_src( $image['ID'], 'custom-medium' )[0]; ?>
	<img data-src="<?php echo $dsktp_src; ?>" data-src-mobile="<?php echo $mobile_src; ?>" class="<?php echo $img_class_names; ?>" style="<?php echo $img_style_val; ?>" />
	<?php endif; ?>
<?php endif; ?>
