<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Homey_Cabins
 */

?>

	<footer id="colophon" class="site-footer">
	<div class= "footer-menus">
	
		<nav id="footer-nav" class="footer-nav">
				<?php
				wp_nav_menu( array( 'theme_location' => 'footer' ) );
				?>
		</nav> 

		<nav id="social-nav" class="social-nav">
				<?php
				wp_nav_menu( array( 'theme_location' => 'social' ) );
				?>
		</nav> 	
	</div>
		<div class="site-info">
			<p> 
          		<b>Designed and developed by </b> <br>
				<a href="http://rkaur.bcitwebdeveloper.ca/" target="_blank">Rajdeep Brar</a>
				&nbsp; | &nbsp; 
				<a href="http://eloginova.bcitwebdeveloper.ca/" target="_blank">Katerina Loginova</a>
                &nbsp; | &nbsp; 
				<a href="http://hsekhon.bcitwebdeveloper.ca/" target="_blank">Harman Sekhon</a><br>
					For Educational purposes only
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
