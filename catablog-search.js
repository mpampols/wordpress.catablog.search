// setup everything when document is ready
jQuery(document).ready(function($) {
	$('#catablogsearch_form').ajaxForm({
		// handler function for success event
		success: function(responseText, statusText)
		{
			$('#catablogsearchresponse').html('<span class="success">'+responseText+'</span>');
		},

		// handler function for errors
		error: function(request) {
			// parse it for WordPress error
			if (request.responseText.search(/<title>WordPress&rsaquo; Error<\/title>/) != -1)
			{
				var data = request.responseText.match(/<p>(.*)<\/p>/);
				$('#catablogsearchresponse').html('<span class="catablogsearch-error">'+ data[1] +'</span>');
			} else 
			{
				$('#catablogsearchresponse').html('<span class="catablogsearch-error">An error occurred, please notify the administrator.</span>');
			}
		},
		beforeSubmit: function(formData, jqForm, options) {
		// clear response div
		$('#catablogsearchresponse').empty();
		}
	});
});