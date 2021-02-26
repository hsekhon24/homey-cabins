<?php
/**
 * Template part for displaying related testimnoials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Homey_Cabins
 */

?>

<?php
if (function_exists ('get_field')):
    $featured_posts = get_field('related_testimonial');
    $random_testimonial = shuffle($featured_posts);
    if( $featured_posts ): ?>
  <?php echo '<h3>Related Testimonial</h3>'; ?>
    <?php foreach( $featured_posts as $post ): 

        // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>

            <?php the_content(); ?>
                <?php break; ?>
           <?php endforeach; ?>
   
    <?php 
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>
<?php endif; ?>