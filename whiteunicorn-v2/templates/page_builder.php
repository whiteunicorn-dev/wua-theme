<?php
/**
 * Template Name: Page Builder
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WhiteUnicorn
 */

$page_content = get_field('page_content');
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main pg-<?php echo sanitize_title( get_the_title() ); ?>">
			
			<?php
			if ( $page_content ) {
				foreach ( $page_content as $section ) {
					echo render_section( $section );
				}
			}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
