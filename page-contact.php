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
		<section class="contact-info">
		<?php
				if (function_exists ('get_field')){
					if(get_field('address')){
						
						echo '<h2> Contact Us </h2>';
						the_field('address');
					
					}//end if
				}//
		?>
		<p><?php		
				if (function_exists ('get_field')){
					if(get_field('phone')){
						
						the_field('phone');
					
					}//end if
				}//
		?></p>
		</section>
		<?php echo do_shortcode ('[wpforms id="221"]') ?>

	</main><!-- #main -->

<?php
get_footer();
