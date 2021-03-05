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

		<?php homey_cabins_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'homey-cabins' ),
					'after'  => '</div>',
				)
			);
			?>
	


<section class="cabins-overview">
		<?php
				if (function_exists ('get_field')):
					if(get_field('cabins_overview')): ?>
						
						<h2> Overview </h2>
					<?php the_field('cabins_overview'); ?>
					
					<?php endif; ?>	
				<?php endif; ?>
	
		</section>

		<section class="places-nearby-gallery">
		<h2>Places nearby</h2>
		<?php 
			if (function_exists ('get_field')):
				$images = get_field('places_nearby_images'); ?>

				<?php if( $images ): ?>
					<div id="lightgallery">
						<?php foreach( $images as $image ): ?>
						
							<a href="<?php echo $image['url']; ?>">
								<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
							</a>		
						
						<?php endforeach; ?>
				
				</div>
				<?php endif; ?>
			
			<?php endif; ?>
		</section>
		</div><!-- .entry-content -->
	</main><!-- #main -->
	
  
<?php

get_footer();


