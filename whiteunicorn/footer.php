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

$footer = get_field('theme_footer', 'option');
$touUrl = ( $footer['terms_of_use'] ) ? $footer['terms_of_use'] : "#";
$ppUrl = ( $footer['privacy_policy'] ) ? $footer['privacy_policy'] : "#";
$copyright = get_field('theme_copyright', 'option')['text'];
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
			<div class="col terms-use-cnt d-flx flx-c flx-c--t ta-c--t">
				<div class="inner-wrap">
					<a href="<?php echo $touUrl; ?>" class="txt-link">Terms of Use</a>
				</div>
			</div>
			<div class="col privacy-pol-cnt d-flx jc-fe flx-c--t ta-c--t">
				<div class="inner-wrap">
					<a href="<?php echo $ppUrl; ?>" class="txt-link">Privacy Policy</a>
				</div>
			</div>
		</div>
	</footer><!-- #footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
