function subscribe(userTo, userFrom, button) {
  if (userTo == userFrom) {
    alert("You can't subscribe to yourself");
    return;
  }
  $.post('ajax/subscribe.php', { userTo: userTo, userFrom: userFrom }).done(
    function (count) {
      if (count != null) {
        $(button).toggleClass('subscribe unsubscribe');
      } else {
        alert('something went wrong');
      }
    }
  );
}
