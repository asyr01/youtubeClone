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
      $('.' + containerClass).prepend(comment);
    });
  } else {
    alert("You can't post an empty comment");
  }
}

function toggleReply(button) {
  let parent = $(button).closest('.itemContainer');
  let commentForm = parent.find('.commentForm').first();
  commentForm.toggleClass('hidden');
}

function likeComment(commentId, button, videoId) {
  $.post('ajax/likeVideo.php', { videoId: videoId }).done(function (data) {
    // Update button image
    let likeButton = $(button);
    let dislikeButton = $(button).siblings('.dislikeButton');

    likeButton.addClass('active');
    dislikeButton.removeClass('active');

    // parse the data
    let result = JSON.parse(data);
    updateLikesValue(likeButton.find('.text'), result.likes);
    updateLikesValue(dislikeButton.find('.text'), result.dislikes);

    // If they unlike it
    if (result.likes < 0) {
      likeButton.removeClass('active');
      likeButton
        .find('img:first')
        .attr('src', 'assets/images/icons/thumb-up.png');
    } else {
      likeButton
        .find('img:first')
        .attr('src', 'assets/images/icons/thumb-up-active.png');
    }
    dislikeButton
      .find('img:first')
      .attr('src', 'assets/images/icons/thumb-down.png');
  });
}

// It will make an ajax call to dislike the video
function dislikeVideo(commentId, button, videoId) {
  $.post('ajax/likeComment.php', {
    commentId: commentId,
    videoId: videoId,
  }).done(function (data) {
    // Update button image
    let dislikeButton = $(button);
    let likeButton = $(button).siblings('.likeButton');

    dislikeButton.addClass('active');
    likeButton.removeClass('active');

    // parse the data
    let result = JSON.parse(data);
    updateLikesValue(likeButton.find('.text'), result.likes);
    updateLikesValue(dislikeButton.find('.text'), result.dislikes);

    if (result.dislikes < 0) {
      dislikeButton.removeClass('active');
      dislikeButton
        .find('img:first')
        .attr('src', 'assets/images/icons/thumb-down.png');
    } else {
      dislikeButton
        .find('img:first')
        .attr('src', 'assets/images/icons/thumb-down-active.png');
    }
    likeButton
      .find('img:first')
      .attr('src', 'assets/images/icons/thumb-up.png');
  });
}

function dislikeComment(commentId, button, videeoId) {}
