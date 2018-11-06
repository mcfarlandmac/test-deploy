(function($) {
  $(document).ready(function() {
    $('.taproom-view-options li a').on('click', function() {
      if (!$(this).hasClass("active")) {
        $('.taproom-view-options li a').removeClass("active");
        $(this).addClass("active");
        $(".beer-menu, .food-options, .taproom-360").hide();
        var view = "." + $(this).data('view');
        $(view).show();
      }   
    });
  });
})(jQuery);