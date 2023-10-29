(function ($) {
  setTimeout(() => {
    $(".transition").addClass("out");
  }, 100);

  $("a").click((e) => {
    e.preventDefault();

    let href = e.target.href;

    $.ajax({
      url: href,
      beforeSend: () => {
        $(".transition").removeClass("out");
      },
    }).done((res) => {
      scrollTo(0, 0);
      history.pushState(null, null, href);
      document.open();
      document.write(res);
      document.close();
    });
  });
})(jQuery);
