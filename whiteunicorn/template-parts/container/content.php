<?php
/**
 * Template part for content containers
 *
 * @package WhiteUnicorn
 * @param $container
 */

$header = $container['heading_text'];
$text = $container['content'];
$bg_color = $container['bg_color'];
$className = $container['classnames'];
?>

<div class="content-cnt<?php if ( $className ) { ?> <?php echo $className; ?><?php } ?>"<?php if ( $bg_color ) { ?> style="background:<?php echo $bg_color; ?>"<?php } ?>>
	<div class="inner-wrap">
		
		<?php if ( $header ) : ?>
		<h2 class="sec-heading"><?php echo $header; ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
		<div class="content"><?php echo $text; ?></div>
		<?php endif; ?>

	</div>
</div>
