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
            // echo '<h1>Test</h1>';
            //            
            // $related = get_field('hc-testimonials');
            //             $args = array(
  			// 			'post_type'      => 'hc-testimonials',
			// 			'posts_per_page' => 1,
			// 			'orderby'        => 'rand',
            //             'post__in' => $related
			// 		);

			// 		$query = new WP_Query( $posts );

            //         if ( $query -> have_posts() )
            //         {
            //             echo '<section>';
            //             while($query -> have_posts())
            //             {
            //                 $query -> the_post();
            //                 the_field('related_testimonial');
            //             }
            //             wp_reset_postdata();
            //             echo '</section>';
			//         }

            $args = array(
                'post_type'      => 'hc-testimonials',
                'posts_per_page' => 1,
                'orderby'        => 'rand',
  
            );

            $query = new WP_Query( $args );

            if ( $query -> have_posts() )
            {

                echo '<section><h3>Random Testimonial</h3>';
                while($query -> have_posts())
                {
                    $query -> the_post();
                    the_content();
                }
                wp_reset_postdata();
                echo '</section>';
            }
?>


