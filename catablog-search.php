<?php
/*
Plugin Name: Catablog Search
Version: 0.1
Description: Adds search feature to Catablog plugin
Author: Marc Pampols
Author URI: http://www.marcpampols.com
Plugin URI: TODO
catablog-search
*/

/* 
require_once('../catablog/lib/CataBlog.class.php');
require_once('../catablog/lib/CataBlogItem.class.php');
require_once('../catablog/lib/CataBlogGallery.class.php');
require_once('../catablog/lib/CataBlogDirectory.class.php');
require_once('../catablog/lib/CataBlogWidget.class.php');
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

	// get our options
	$options = get_option('catablog_search');
	$title = $options['catablogsearch_title'];

	// print the theme compatibility code
	echo $before_widget;
	echo $before_title . $title . $after_title;

	// include our widget
	include('catablog-search-widget.php');
	echo $after_widget;
}

function CatablogSearch_WidgetControl()
{
	// get saved options
	$options = get_option('catablog_search');

	// handle user input
	if ( $_POST["catablogsearch_submit"] )
	{
		$options['catablogsearch_title'] = strip_tags( stripslashes( $_POST["catablogsearch_title"]));
		update_option('catablog_search', $options);
	}

	$title = $options['catablogsearch_title'];

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
	wp_enqueue_script('catablogsearch_script', $catablogsearch_plugin_url . '/catablog-search.js', array('jquery', 'jquery-form'));
}

?>