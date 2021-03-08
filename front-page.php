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
	<div class="banner-video-container">
			 <?php
				$file = get_field('banner_video');
				if( $file ): ?>
				<video src="<?php echo $file['url']; ?>" autoplay="on">
				
				<?php endif; ?>
						
	</div>

	<div class="content-on-video">
	<?php
				if (function_exists ('get_field')):
					if(get_field('tagline')): ?>
					<p class="tagline">	
					<?php the_field('tagline'); ?>
					</p>
					<?php endif; ?>	
				<?php endif; ?>

		<?php		if (function_exists ('get_field')):  ?>
								
						<?php 
							$link = get_field('book_now_button');
							if( $link ): 
								$link_url = $link['url'];
						?>
						<a href="<?php echo esc_url( $link_url ); ?>">Book now</a>
				
					<?php endif; ?>	
				<?php endif; ?>
	</div>


<section class="cabins-overview">
	<div class="cabins-overview-content">
				<?php	if (function_exists ('get_field')):
					$image = get_field('overview_image');
					if( !empty( $image ) ): ?>
						<img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
				<?php endif; ?>
	</div>
	<div class="cabins-overview-content">
				<?php
				if (function_exists ('get_field')):
					if(get_field('cabins_overview')): ?>
						
						<h2> #1 Place to Visit </h2>
					<p>
						<?php the_field('cabins_overview'); ?>
					</p>
					<?php endif; ?>	
				<?php endif; ?>
	</div>
		</section>

		<section class="places-nearby-gallery">
		<h2>Explore Places nearby</h2>
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


