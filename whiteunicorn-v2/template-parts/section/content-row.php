<?php
/**
 * Template part for content-row sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @uses content {text/wysiwyg}
 */

//printR($section);
?>

<section class="content-row">
    <div class="section-wrap inner-wrap">
        <div class="content-cnt">
            <?php do_shortcode($section['content']); ?>
        </div>
    </div>
</section>
