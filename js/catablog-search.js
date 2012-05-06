// setup everything when document is ready
jQuery(document).ready(function($) {
	var mouse_is_inside = false;

	$('#catablogsearch_form').hover(function(){
        mouse_is_inside=true;
    }, function(){
        mouse_is_inside=false;
    });

    $("body").mouseup(function(){
        if(! mouse_is_inside) {
			$('#catablogsearch_response').hide();
        } else {
			$('#catablogsearch_response').show();
        }
    });

	$('#catablogsearch_form').ajaxForm({
		// handler function for success event
		success: function(responseText, statusText)
		{
			$('#catablogsearch_response').html('<span class="success">'+responseText+'</span>');
		},

		// handler function for errors
		error: function(request) {
			// parse it for WordPress error
			if (request.responseText.search(/<title>WordPress&rsaquo; Error<\/title>/) != -1)
			{
				var data = request.responseText.match(/<p>(.*)<\/p>/);
				$('#catablogsearch_response').html('<span class="catablogsearch-error">'+ data[1] +'</span>');
			} else {
				$('#catablogsearch_response').html('<span class="catablogsearch-error">An error occurred, please notify the administrator.</span>');
			}
		},
		beforeSubmit: function(formData, jqForm, options) {
		// clear response div
		$('#catablogsearch_response').empty();
		}
	});
});
