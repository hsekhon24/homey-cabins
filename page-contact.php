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
<div class="contact">
	<section class="contact-info">

		<?php
				if (function_exists ('get_field')):
					if(get_field('address')): ?>
				
					<h2> Contact Us </h2>
					<h3> We'd love to hear from you! </h3>
					<p>
						<?php the_field('address'); ?>
					</p>
					
				<?php endif; ?>
				<?php endif; ?>

		<?php		
		if (function_exists ('get_field')):
			if(get_field('phone')): ?>
				
			<a href="tel:<?php get_field('phone'); ?>">Phone: 
				<?php the_field('phone'); ?> 
			</a>	
			<?php endif; ?>
		<?php endif; ?>

		<?php
				if (function_exists ('get_field')):
					if(get_field('contact_email')): ?>
			<p>	
			<a href="mailto:<?php get_field('contact_email'); ?>"> 
				<?php the_field('contact_email'); ?> 
			</a>
			</p>				
				<?php endif; ?>
				<?php endif; ?>

		
		</section>
		<?php echo do_shortcode ('[wpforms id="221"]') ?>
</div>
	</main><!-- #main -->

<?php
get_footer();
