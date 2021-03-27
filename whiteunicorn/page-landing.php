<?php
/**
 * Template Name: Landing Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WhiteUnicorn
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main p-r">
			
			<?php $bgImg = get_field('bg_image'); ?>
			<?php if ( $bgImg ) : ?>
			<div class="bg-img-cnt abs-cv">
				<?php echo wp_get_attachment_image( $bgImg['ID'], 'full', '', array( "class" => "cover" ) ); ?>
			</div>
			<?php endif; ?>
			
			<div class="inner-wrap d-flx fd-c jc-sb p-20 mh-100vh p-r zi-1">		
				<?php $topRow = get_field('top_row'); ?>
				<div class="row top d-flx jc-sb ai-c">
					<div class="col">
						TOP LEFT
					</div>
					<div class="col">
						TOP RIGHT
					</div>
				</div>


				<?php $midRow = get_field('middle_row'); ?>
				<div class="row middle d-flx flx-c">
					<h1>
						MIDDLE
					</h1>
				</div>


				<?php $botRow = get_field('bottom_row'); ?>
				<div class="row bottom d-flx jc-sb ai-c">
					<div class="col">
						BOTTOM LEFT
					</div>
					
					<div class="col">
						BOTTOM RIGHT
					</div>
				</div>
			</div>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
