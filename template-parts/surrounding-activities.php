<?php
/**
 * Template part for displaying list of surrounding activities
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Homey_Cabins
 */

?>

<?php
			
		// ACF REPEATER - BASIC LOOP

	if (function_exists ('get_field')):
		 if(get_field('surrounding_activities', 24)): // 24 is page_id of about page where we have this acf field

		// check if the repeater field has rows of data

		if( have_rows('surrounding_activities', 24) ):
			echo '<h2> Surrounding Activities </h2>';
		
			// loop through the rows of data
			while ( have_rows('surrounding_activities', 24) ) : the_row();

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
	endif;
endif;
?>