(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.newsCarousel = {
    attach: function (context, settings) {
        $('.slick-home').slick({
          dots: true,
          autoplay: true,
          infinite: true,
          speed: 300,
          slidesToShow: 1,
          adaptiveHeight: true
        });
      /*once('newsCarousel', '.css-news-carrosel .owl-carousel', context)
        .forEach(function (el) {
          var $carousel = $(el);

          var $items = $carousel.children();


          $items.eq(0).remove();

          $carousel.owlCarousel({
            loop: true,
            dots: true,
            items: 1,
            slideBy: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            lazyLoad: true,
          });
        });*/

    }
  };

})(jQuery, Drupal, drupalSettings);
