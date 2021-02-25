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

		endwhile; // End of the loop.
		?>

		<section class="cabins-overview">
		<?php
				if (function_exists ('get_field')){
					if(get_field('cabins_overview')){
						
						echo '<h2> Overview </h2>';
						the_field('cabins_overview');
					
					}//end if
				}//
		?>
		</section>

		<section class="places-nearby-gallery">
		<h2>Places nearby</h2>
		<?php 
		
				$images = get_field('places_nearby_images');

				if( $images ): ?>
					<div id="lightgallery">
						<?php foreach( $images as $image ): ?>
						
								<a href="<?php echo $image['url']; ?>">
									<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
								</a>
							
						
						<?php endforeach; ?>
				
				</div>
				<?php endif; ?>
		</section>

	</main><!-- #main -->
	

    
<?php

get_footer();
