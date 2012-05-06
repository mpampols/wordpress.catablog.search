<?php
require_once("../../../wp-config.php");

if ($_POST['cs'])
{
	global $wpdb;
	$product=strtoupper($_POST['cs']);
	$ids = $wpdb->get_col("SELECT ID FROM wp_posts WHERE UCASE(post_title) LIKE '%$product%' AND post_type='catablog-items' AND post_status='publish'");
	if ($ids) {

		$args=array(
		    'post__in' => $ids,
		    'posts_per_page' => -1,
		    'caller_get_posts'=> 1
		);

		$my_query = null;
		$my_query = new WP_Query($args);

		foreach ($ids as $key => $value) {
			print_r(catablog_get_item($value)->getImage());
		}

		wp_reset_query();

	}

	$options = get_option('catablog_search');
}
?>