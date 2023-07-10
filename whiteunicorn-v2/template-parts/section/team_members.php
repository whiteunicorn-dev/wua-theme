<?php
/**
 * Template part for team_members sections
 *
 * @package WhiteUnicorn
 * @param $section
 * @param $section_count
 */

$content = $section['team_members_section'];
$heading = $content['title'];
$subtitle = $content['subtitle'];
$sec_settings = $section['section_settings'];
$id_attr = $sec_settings['id_attribute'];
// WP_Query arguments
$args = array(
	'post_type'              => array( 'team_members' ),
	'post_status'            => array( 'publish' ),
	'nopaging'               => true,
);

// The Query
$query = new WP_Query( $args );

if ( $query->have_posts() ) : $count = 0; ?>
<section id="<?php echo $id_attr; ?>" class="team_members-sec sec-<?php echo $section_count; ?>">
	
	<?php if ( $heading ) : ?>
	<div class="heading-cnt">
		<?php if ( $subtitle ) : ?>
		<p class="subtitle gold-txt"><?php echo $subtitle; ?></p>
		<?php endif; ?>
		<?php if ( $heading ) : ?>
		<h2 class="sec-heading"><?php echo $heading; ?></h2>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div class="team-cnt">

		<?php while ( $query->have_posts() ) : $query->the_post(); $count++; ?>
		<?php if ( $count === 1 ) : ?>
		<div class="inner-wrap flex-cnt col-2 featured-team">
		<?php elseif ( $count === 3 ) : ?>
		<div class="inner-wrap flex-cnt col-4 mobile-team-slider">
		<?php endif; ?>
			
			<?php if ( $count == 7 ) : ?>
			<div class="view-all-sep flex-cnt">
				<button class="view-all">View All</button>
			</div>
			<?php endif; ?>
			
			<div class="member col<?php if ( $count > 6 ) { ?> hidden<?php } ?>">
				<a href="<?php echo the_permalink(); ?>" class="img-cnt">
					<?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( "class" => "cover" ) ); ?>
				</a>

				<div class="meta-cnt">
					<p class="name blue-txt"><?php echo get_the_title(); ?></p>
					<?php if ( get_field('title') ) : ?><p class="job-title blue-txt italic-txt"><?php echo get_field('title'); ?></p><?php endif; ?>
					<?php if ( get_field('subtitle') ) : ?><p class="subtitle blue-txt"><?php echo get_field('subtitle'); ?></p><?php endif; ?>
					<a href="<?php echo the_permalink(); ?>" class="member-link readmore gold-txt">Read More ></a>
				</div>
			</div>

		<?php if ( $count === 2 or $count === $query->post_count ) : ?>
		</div>
		<?php endif; ?>
		
		<?php endwhile; ?>

	</div><!-- /.team-cnt -->

</section>
<?php endif; ?>
