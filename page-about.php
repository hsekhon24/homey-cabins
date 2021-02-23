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

		<?php

				if (function_exists ('get_field')){
					if(get_field('about_owners')){
						
						echo '<h2> A little about Owners </h2>';
						the_field('about_owners');
					
					}//end if
				}

					$image = get_field('photo_owner');
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
		<?php
					if (function_exists ('get_field')){
					if(get_field('history')){
						
						echo '<h2> History of Cabins </h2>';
						the_field('history');
			
					}//end if
				}
			?>

		<?php
					echo '<h2> Surrounding Activities </h2>';
		// ACF REPEATER - BASIC LOOP

		// check if the repeater field has rows of data
		if( have_rows('surrounding_activities') ):
		
			// loop through the rows of data
			while ( have_rows('surrounding_activities') ) : the_row();

					echo '<h3>';
					echo the_sub_field('activity_title');
					echo '</h3>';
		
		
					$image = get_sub_field('activity_image');
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
				<?php
					echo '<p>';
					echo the_sub_field('activity_description');
					echo '</p>';

					echo '<a href="' . get_sub_field('activity_link'). '"> More Info';
					echo '</a>';
	
			
			endwhile;

		else :

			// no rows found

		endif;

		?>

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

		<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
