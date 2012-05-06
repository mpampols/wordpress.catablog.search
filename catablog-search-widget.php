<?php
/**
 * Template for displaying search forms in Catablog Search
 *
 */
global $catablogsearch_plugin_url;
$options = get_option('catablog_search');
?>

<form method="post" id="catablogsearch_form" action="<?php echo $catablogsearch_plugin_url . 'catablog-search-ajax.php'; ?>">
	<input type="text" class="field" name="cs" id="cs" placeholder="<?php echo $options['cs_title'] ?>" />
	<div id="catablogsearch_response"></div>
</form>