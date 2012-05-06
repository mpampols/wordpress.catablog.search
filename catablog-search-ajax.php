<?php
require_once("../../../wp-config.php");
global $wp_plugin_catablog_class;

if ($_POST['cs'])
{
	global $wpdb;
	$product=strtoupper(mysql_real_escape_string($_POST['cs']));
	$ids = $wpdb->get_col("SELECT ID FROM wp_posts WHERE UCASE(post_title) LIKE '%$product%' AND post_type='catablog-items' AND post_status='publish'");
	echo "<div class=\"catablogsearch_results\">";
	if ($ids) {

		$args=array(
		    'post__in' => $ids,
		    'posts_per_page' => -1,
		    'caller_get_posts'=> 1
		);

		$my_query = null;
		$my_query = new WP_Query($args);

		foreach ($ids as $key => $value) {
			echo "<a href=\"".catablog_get_item($value)->getPermalink()."\">";
			echo "<div class=\"catablogsearch_result\">";
			echo "<div class=\"catablogsearch_result_image\"><img src='".$wp_plugin_catablog_class->urls['thumbnails'] . '/' . catablog_get_item($value)->getImage()."' /></div>";
			echo "<div class=\"catablogsearch_result_title\">".catablog_get_item($value)->getTitle()."</div>";
			echo "</div>";
			echo "</a>";
		}

		wp_reset_query();

	} else
	{
		echo "No results found.";
	}
	echo "</div>";
	$options = get_option('catablog_search');
}
?>