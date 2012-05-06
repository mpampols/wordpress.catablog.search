<?php
/**
 * Template for displaying widget control
 *
 */
$options = get_option('catablog_search');
?>
<p>
	<p><label for="cs_title">Title: <input name="cs_title" type="text" value="<?php echo $options['cs_title'] ?>" /></label></p>
	<input type="hidden" id="cs_submit" name="cs_submit" value="1"/>
</p>