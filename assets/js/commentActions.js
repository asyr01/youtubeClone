// replyTo for replying a comment, containerClass for adding comment to the DOM
function postComment(button, postedBy, videoId, replyTo, containerClass) {
  const textarea = $(button).siblings('textarea');
  const commentText = textarea.val();
  textarea.val('');

  // make an ajax call, insert it to the table
  if (commentText) {
    $.post('ajax/postComment.php', {
      commentText: commentText,
      postedBy: postedBy,
      videoId: videoId,
      responseTo: replyTo,
    }).done(function (comment) {
      $('.' + containerClass.prepend(comment));
    });
  } else {
    alert("You can't post an empty comment");
  }
}
