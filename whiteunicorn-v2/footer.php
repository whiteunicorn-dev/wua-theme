<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WhiteUnicorn
 */

$footer = get_field('site_footer', 'option');
$copyright = ( $footer and $footer['copyright'] ) ? $footer['copyright'] : '';
$contact = get_contact();
?>

	</div><!-- #content -->

	<footer id="footer" class="site-footer">
		<div class="inner-wrap">
			<div class="col copyright-cnt d-flx flx-c--t ta-c--t">
				<div class="inner-wrap">
					<p class="copyright"><?php echo do_shortcode( $copyright ); ?></p>
				</div>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
