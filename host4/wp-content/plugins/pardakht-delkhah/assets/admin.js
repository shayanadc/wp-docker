jQuery(document).ready(function($) {
	$('._cupri_delete_row').on('click',function(e){
		e.preventDefault();
		var ths = $(this);
		var post_id = $(this).data('post-id');
		if(confirm('اطمینان دارید؟'))
		{
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'cupri_delete_post',
					post_id:post_id,
					nonce:$(this).data('nonce')
				},
			})
			.done(function(data) {
				ths.closest('tr').fadeOut('slow');
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}
	});
});