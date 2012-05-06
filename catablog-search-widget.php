<?php
/**
 * The template for displaying search forms in Catablog Search
 *
 */
?>
<form method="post" id="catablogsearch_form" action="<?php echo $catablogsearch_plugin_url . 'catablog-search-ajax.php'; ?>">
	<label for="cs" class="assistive-text"><?php _e( 'Search', 'wordpress' ); ?></label>
	<input type="text" class="field" name="cs" id="cs" placeholder="<?php esc_attr_e( 'Search', '' ); ?>" />
	<p><input name="catablogsearch_submit" type="submit" id="catablogsearch_submit" tabindex="3" value="Buscar" /></p>
	<div id="catablogsearchresponse">
	</div>
</form>