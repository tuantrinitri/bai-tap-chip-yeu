(function ($) {

  //OWL CAROUSEL
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    autoplay: false,
    items: 1,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
      375: {
        items: 2
      },
      768: {
        items: 2
      },
      1024: {
        items: 1
      },
      1200: {
        items: 2
      }
    }
  })

  //SLICK SLIDER
  $(document).ready(function () {

    // Sliders

    //// Slider Top
    $('.article-new .js-items-slider-container .slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      autoplay: false,
      pauseOnHover: true,
      asNavFor: '.article-new .js-items-slider-container .slider-nav'
    });
    $('.article-new .js-items-slider-container .slider-nav').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.article-new .js-items-slider-container .slider-for',
      dots: false,
      infinite: true,
      centerMode: false,
      focusOnSelect: true,
      arrows: true,
      accessibility: true,
      autoplay: false,
      pauseOnHover: true,
      onAfterChange: function (slide, index) {
        console.log("slider-nav change");
        console.log(this.$slides.get(index));
        $('.current-slide').removeClass('current-slide');
        $(this.$slides.get(index)).addClass('current-slide');
      },
      onInit: function (slick) {
        $(slick.$slides.get(0)).addClass('current-slide');
      },
      responsive: [
        {
          breakpoint: 1025,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 376,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 321,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  });

  //SLIDE VERTICAL 
  $(document).ready(function () {
    $('.slide-vertical').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            arrows: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
          }
        }
      ]
    });
  });

  //FANCY BOX
  $('[data-fancybox="gallery"]').fancybox({

  });

  //Hover image active text
  $(".article-feature__img").hover(function () {
    $(".article-feature__content h4").toggleClass("active")
  });

  $(".category category-post").mouseover(function () {
    if ($(this).find(".category-post__image img").hover()) {
      // console.log("123")
    }

  });

  $(".owl-item .item").hover(function () {
    $(this).find("h4").toggleClass("active")
  });

})(jQuery);
