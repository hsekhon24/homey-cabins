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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		?>

		<section class="about-owners">
		<?php

				if (function_exists ('get_field')){
					if(get_field('about_owners')){
						
						echo '<h2> A little about Owners </h2>';
						echo '<p>';
						the_field('about_owners');
						echo '</p>';
					}//end if
				}

					$image = get_field('photo_owner');
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>

		</section>

		<section class="history-cabins">
		<?php
					if (function_exists ('get_field')){
					if(get_field('history')){
						
						echo '<h2> History of Cabins </h2>';
						the_field('history');
			
					}//end if
				}
			?>
		</section>

		<section class="surrounding-activities">
		<?php
					//Uses the template part to display surrounding activities
					get_template_part('template-parts/surrounding', 'activities');

		?>
		</section>

		<section class="surrounding-areas">
		<?php
				echo '<h2> Surrounding Areas </h2>';
				// ACF REPEATER - BASIC LOOP

				// check if the repeater field has rows of data
				if( have_rows('surrounding_areas') ):
				
					// loop through the rows of data
					while ( have_rows('surrounding_areas') ) : the_row();

	
			
							echo '<a href="' . get_sub_field('external_website_link'). '"> ';
							$image = get_sub_field('surrounding_area_image');
							if( !empty( $image ) ): ?>
								<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							<?php endif; ?>
						<?php
						echo '<h3> More info </h3>';
							echo '</a>';
			
					
					endwhile;

				else :

					// no rows found

				endif;

		?>
		</section>
		<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
