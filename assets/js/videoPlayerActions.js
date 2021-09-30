// It will make an ajax call
function likeVideo(button, videoId) {
  $.post('ajax/likeVideo.php', { videoId: videoId }).done(function (data) {
    // Update button image
    let likeButton = $(button);
    let dislikeButton = $(button).siblings('.dislikeButton');

    likeButton.addClass('active');
    dislikeButton.removeClass('active');

    // parse the data
    let result = JSON.parse(data);
    console.log(result);
  });
}

function updateLikesValue(element, num) {
  let likesCountVal = element.text() || 0;
  element.text(parseInt(likesCountVal));
}
