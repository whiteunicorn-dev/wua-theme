<?php
/**
 * Template Name: Page Builder
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WhiteUnicorn
 */

$hero = get_the_post_thumbnail( get_the_ID(), 'full', array( "class" => "cover" ) );
$page_content = get_field('page_content');
$contact_sec = get_field('contact_section');
$shortlinks_navigation = get_field('single_page_navigation');

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			<?php if ( $hero ) : ?>
			<div id="hero-cnt">
				<?php echo $hero; ?>
			</div>
			<?php endif; ?>

			<?php if ( $page_content ) : $section_count = 0; ?>
			<?php foreach ( $page_content as $section ) : $section_count++; ?>

				<?php echo render_section( $section, $section_count ); ?>

			<?php endforeach; ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
