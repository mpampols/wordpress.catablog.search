<?php
/*
Plugin Name: Catablog Search
Version: 0.2 beta
Description: Adds search feature to Catablog plugin
Author: Marc Pampols
Author URI: https://github.com/mpampols/wordpress.catablog.search
Plugin URI: TODO
catablog-search
*/

/* Version check */
global $wp_version;
$exit_msg='Catablog Search requires WordPress 3.3.2 or newer, and <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';

if (version_compare($wp_version,"3.3.2","<"))
{
	exit ($exit_msg);
}

$catablogsearch_plugin_url = trailingslashit( WP_PLUGIN_URL.'/'.dirname( plugin_basename(__FILE__) ));

function CatablogSearch_Widget($args = array())
{
	// extract the parameters
	extract($args);

	// print the theme compatibility code
	echo $before_widget;

	// include our widget
	include('catablog-search-widget.php');
	echo $after_widget;
}

function CatablogSearch_WidgetControl()
{
	// get saved options
	$options = get_option('catablog_search');

	// handle user input
	if ( $_POST["cs_submit"] )
	{
		$options['cs_title'] = strip_tags( stripslashes( $_POST["cs_title"]));
		update_option('catablog_search', $options);
	}

	$title = $options['cs_title'];

	// print out the widget control
	include('catablog-search-widget-control.php');
}

function CatablogSearch_Init()
{
	// register widget
	register_sidebar_widget('Catablog Search', 'CatablogSearch_Widget');

	// register widget control
	register_widget_control('Catablog Search', 'CatablogSearch_WidgetControl');
}

add_action('init', 'CatablogSearch_Init');
add_action('wp_print_scripts', 'CatablogSearch_ScriptsAction');

function CatablogSearch_ScriptsAction()
{
	global $catablogsearch_plugin_url;

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('catablogsearch_script', $catablogsearch_plugin_url . '/js/catablog-search.js', array('jquery', 'jquery-form'));
}

add_action('wp_head', 'CatablogSearch_HeadAction' );

function CatablogSearch_HeadAction()
{
	global $catablogsearch_plugin_url;
	echo '<link rel="stylesheet" href="'.$catablogsearch_plugin_url.'/css/catablog-search.css" type="text/css" />';
}

?>
