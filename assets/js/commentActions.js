// replyTo for replying a comment, containerClass for adding comment to the DOM
function postComment(button, postedBy, videoId, replyTo, containerClass) {
  const textarea = $(button).siblings('textarea');
  const commentText = textarea.val();
  textarea.val('');

  // insert it to the table
  if (commentText) {
    $.post('ajax/postComment.php').done(function () {
      alert('done');
    });
  } else {
    alert("You can't post an empty comment");
  }
}
