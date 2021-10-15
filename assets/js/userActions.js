function subscribe(userTo, userFrom, button) {
  if (userTo == userFrom) {
    alert("You can't subscribe to yourself");
    return;
  }
  $.post('ajax/subscribe.php', { userTo: userTo, userFrom: userFrom }).done(
    function (count) {
      if (count != null) {
      } else {
        alert('something went wrong');
      }
    }
  );
}
