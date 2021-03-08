<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Homey_Cabins
 */

get_header();
?>

	<main id="primary" class="site-main">
	<header class="entry-header">
			<?php the_title( '<h1 class="entry-title screen-reader-text">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<section class="about-owners">
			<div class="about-owners-content">
				<?php	if (function_exists ('get_field')):
						$image = get_field('photo_owner');
						if( !empty( $image ) ): ?>
							<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
					<?php endif; ?>
			</div>

			<div class="about-owners-content">
			<?php if (function_exists ('get_field')):
					if(get_field('about_owners')): ?>
						
						<h2> A little about Owners </h2>
						<p>
						 	<?php the_field('about_owners'); ?>
						</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</section>

		<section class="history-cabins">
		<?php
					if (function_exists ('get_field')):
						if(get_field('history')): ?>
							
							<h2> History of Cabins </h2>
							<?php the_field('history'); ?>
				
						<?php endif; ?>
					<?php endif; ?>
		</section>

		<section class="surrounding-activities">
			<?php
						//Uses the template part to display surrounding activities
						get_template_part('template-parts/surrounding', 'activities');

			?>
		</section>

		<section class="surrounding-areas">
			<h2> Surrounding Areas </h2>
				<div class="surrounding-areas-content">
			
								
<?php		// ACF REPEATER - BASIC LOOP

			if (function_exists ('get_field')):
				// check if the repeater field has rows of data
				if( have_rows('surrounding_areas') ):
				
					// loop through the rows of data
					while ( have_rows('surrounding_areas') ) : the_row(); ?>
			
							<a href="<?php echo get_sub_field('external_website_link'); ?>"> 
						<?php	$image = get_sub_field('surrounding_area_image'); ?>
						<?php	if( !empty( $image ) ): ?>
								<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							<?php endif; ?>
						<?php
						echo '<h3> More info </h3>';
							echo '</a>';
			
					
					endwhile;
			endif;
				else :

					// no rows found

				endif;


		?>
		</div>
		</section>
<section class="location-map">
<?php 
	$location = get_field('location_map');
		if( $location ): ?>
			<div class="acf-map" data-zoom="16">
				<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
			</div>
		<?php endif; ?>
		
		</section>

	</main><!-- #main -->

<?php

get_footer();
