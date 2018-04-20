<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * name from twentytwelve 
 * delete   get_sidebar();
 * 20160603 makita
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<!-- div id="primary" class="content-area" -->
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

<!-- /div --><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
