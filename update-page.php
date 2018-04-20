<?php
/**
 * Template Name: UPDATE PAGE TEMPLATE 20130314 makita
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

			
			<?php /* for update page added by makita 20120208 20130314*/
				$today = current_time('mysql', 1);
				$howMany = 100; //表示する記事数
				if ( $recentposts = $wpdb->get_results("
					SELECT ID, post_title, post_date, post_modified 
					FROM $wpdb->posts 
					WHERE (post_type = 'post' OR post_type = 'page') AND post_status = 'publish' AND post_modified_gmt < '$today' 
					ORDER BY post_modified_gmt DESC 
					/* LIMIT $howMany */
				")):
			?>
			
			<h2><?php _e("update contents including page page"); ?></h2>
			<ul>
			<?php
			foreach ($recentposts as $post) {
				if ($post->post_title == '') $post->post_title = sprintf(__('Post #%s'), $post->ID);
				echo "<li>";
				echo "<a href='https://fserc.kyoto-u.ac.jp/wp/wp-admin/post.php?post=".$post->ID."&action=edit'>";
				echo "- ";
				echo '</a> ';
				echo date("Y-m-d H:i", strtotime($post->post_modified));
				echo " (";
				echo date("Y-m-d", strtotime($post->post_date));
				echo ") ";
				echo " <a href='".get_permalink($post->ID)."'>";
				// echo " <a href='https://fserc.kyoto-u.ac.jp/wp/?p=".$post->ID."'>";  //固定ページへのリンクが sslではなくなってしまうが、こうしても変更できない 20160226 makita
				the_title();
				echo '</a> ';
				echo get_permalink($post->ID);
				echo "</li>";
				echo "\n";
			}
			?>
			</ul>
			<?php endif; ?>
				
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>