jQuery(function($){

	$('.load-more-comments').click(function(e){

		var oldComments = $('body').find('.entry-comments .comment-list'),
			button = $(this);

		e.preventDefault();
		$(this).text('Loading...');
		$.get( $(this).attr('href'), function(data) {
			var newComments = $(data).find('.entry-comments .comment-list');
			newComments.insertAfter( button.parent() );
			oldComments.remove();
			button.remove();
			cleanCommentUrl();
		});
	});
});
