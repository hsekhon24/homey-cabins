<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Homey_Cabins
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Sorry, we can’t find the page you were looking for :(', 'homey-cabins' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Please try one of the links below.', 'homey-cabins' ); ?></p>

				<ul class="error-page-ul">
					<li><a href="https://homeycabins.bcitwebdeveloper.ca/">Home </a> </li>
					<li><a href="https://homeycabins.bcitwebdeveloper.ca/shop/">Cabins </a> </li>
				</ul>
			

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
