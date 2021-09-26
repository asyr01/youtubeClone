// It will make an ajax call
function likeVideo(button, videoId) {
  $.post('ajax/likeVideo.php', { videoId: videoId }).done(function (data) {
    alert(data);
  });
}
