<?php
/**
 * Template part for displaying list of surrounding activities
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Homey_Cabins
 */

?>
<section class="surrounding-activities">
<?php
			
		// ACF REPEATER - BASIC LOOP

		// check if the repeater field has rows of data

		if( have_rows('surrounding_activities', 24) ): ?> <!--  24 is page_id of about page where we have this acf field -->
		<h2> Surrounding Activities </h2>


	
	<?php		// loop through the rows of data
			while ( have_rows('surrounding_activities', 24) ) : the_row(); ?>
				<div class="surrounding-activities-content">	
					<h3>
						<?php echo the_sub_field('activity_title'); ?>
					</h3>
		
		
				<?php	$image = get_sub_field('activity_image');
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
				
				<p>
						<?php echo the_sub_field('activity_description'); ?>
				</p>

					<a href="<?php echo get_sub_field('activity_link'); ?>"> More Info
					</a>
				</div>
		<?php	
			endwhile;

		else :

			// no rows found

		endif;

?>
</section>
