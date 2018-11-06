(function($) {
  $(document).ready(function() {
    $('.toggle-menu').on('click touchstart MSPointerDown', function(e) {
      e.preventDefault();
      $('body').toggleClass('nav-open');
    });
    initAgeGate();
  });

  function initAgeGate() {
    if (!getCookie()) {
      $('#age-gate').modal({
        keyboard: false,
        backdrop: false
      });
      $('body').addClass('age-gate-active');

      $('#age-gate').on('hide.bs.modal', function() {
        setCookie();
        $('body').removeClass('age-gate-active');
      });
    }
  }

  function setCookie() {
    var expDate = new Date();
    expDate.setHours(expDate.getHours() + 2);

    document.cookie = 'braxton_21_or_over=true; expires=' + expDate.toGMTString() + '; path=/';
  }

  function getCookie() {
    var value = '; ' + document.cookie;
    var parts = value.split('; braxton_21_or_over=');
    if (parts.length == 2) return parts.pop().split(';').shift();
  }
})(jQuery);