document.addEventListener("DOMContentLoaded", function () {
  //jquery handle
  const $ = jQuery;
  //slider testemunhos
  $(".testimonials__wrap").slick({
    infinite: false,
    dots: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    autoplaySpeed: 15000,
    lazyLoad: "ondemand",
    prevArrow: $(".prev"),
    nextArrow: $(".next"),
    responsive: [
      {
        breakpoint: 920,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots:false
        }
      }
    ]
    // fade: true,
    //cssEase: 'linear',
  });

  
  
});
