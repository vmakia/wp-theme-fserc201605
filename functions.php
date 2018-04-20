<?php
	/*
	 * from https://wpdocs.osdn.jp/子テーマ
	 *  そうでない場合は、同様にエンキューする必要があります。 
	 * 子テーマのcssを反映させるための追加 20160520 makita
	 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
	//20150220 add new from child theme
	function custom_widget() {
		class custom_Widget_Meta extends WP_Widget_Meta {
 			function __construct() {
				parent::__construct();
			}
 			function widget( $args, $instance ) {
				/** This filter is documented in wp-includes/default-widgets.php */
				$title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Meta' ) : $instance['title'], $instance, $this->id_base );
				echo $args['before_widget'];
				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}
?>
				<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<!-- custamized by makita at 20130702_20150220 from here -->
<?php
				global $current_user, $current_blog;
				$blog_id = $current_blog->blog_id;
				if ($current_user->user_level >0 && $blog_id == 1) {
?>
					<li>
					<a href="/wp/blog/topics/fserc_only">構成員専用ページの一覧</a>
					</li>
					<li>
					<a href="/wp/blog/topics/pending">準備中・非公開のページ一覧</a>
					</li>
<?php
				}
?>
				<!-- custamized by makita at 20130702_20150220 kokomade -->
<?php
				wp_meta();
?>
				</ul>
<?php
				echo $args['after_widget'];
			}
		}
		register_widget('custom_Widget_Meta');
	}
    add_action('widgets_init', 'custom_widget');
	//20160302 add for by makita widget Display Posts Shortcode
    add_filter('widget_text', 'do_shortcode');
	//20171018 add for by makita for more link display
    function modify_read_more_link() {
        return '<a class="more-link" href="' . get_permalink() . '"> [&hellip;]</a>';
        }
    add_filter( 'the_content_more_link', 'modify_read_more_link' );
?>