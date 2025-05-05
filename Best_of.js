function filterGames(platform) {
  $(".game-card").each(function () {
    if ($(this).hasClass(platform)) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
}
