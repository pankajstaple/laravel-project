



(function() {
  $('.toggle-wrap').on('click', function() {
    $(this).toggleClass('active');
    $('aside').animate({width: 'toggle'}, 200);
  });
})();

  $(document).ready(function() {
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        loop: true,
        margin: 20,
        // autoplay: true,
        // autoplayTimeout: 1000,
        // autoplayHoverPause: true
        nav: true,
          // navText: [
          //   "<i class='fa fa-angle-left'></i>",
          //   "<i class='fa fa-angle-right'></i>"
          // ],
          navText: [
            "<img src='assets/images/left_arrow.png' alt='' class='arrow left-arrow'>",
            "<img src='assets/images/right_arrow.png' alt='' class='arrow right-arrow'>"
          ],
          responsive: {
            0: {
              items: 1
            },
            600: {
              items: 2
            },
            1000: {
              items: 3
            }
          }
      });
      });