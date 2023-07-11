<?php
/**
 * Template part for image-row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @uses image {array}
 */

//printR($section);
?>

<section class="image-row">
    <div class="section-wrap inner-wrap">
        <div class="img-cnt">
			<?php echo wp_img( $section['image']['ID'], "contain" ); ?>
        </div>
    </div>
</section>

