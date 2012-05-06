<?php
/**
 * Template for displaying search forms in Catablog Search
 *
 */

global $catablogsearch_plugin_url;
?>

<form method="post" id="catablogsearch_form" action="<?php echo $catablogsearch_plugin_url . 'catablog-search-ajax.php'; ?>">
	<label for="cs" class="assistive-text"><?php _e( 'Search', 'wordpress' ); ?></label>
	<input type="text" class="field" name="cs" id="cs" placeholder="<?php esc_attr_e( 'Search', '' ); ?>" />
	<div id="catablogsearch_response"></div>
</form>