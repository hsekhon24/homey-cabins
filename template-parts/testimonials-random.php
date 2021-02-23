<?php
/**
 * Template part for displaying work categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

?>

<?php
            // echo '<h1>Test</h1>';
            //            
              
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


