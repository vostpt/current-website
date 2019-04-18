//onload
document.addEventListener("DOMContentLoaded", function() {
  //abrir menu
  const menu = document.querySelector(".menuicon");
  menu.addEventListener("click", () => {
    menu.classList.toggle("active");
    document.querySelector(".header__menu").classList.toggle("active");
  });

  //dar cor menu scroll
  var topMenu = document.querySelector("header");
  var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (lastScrollTop > 0) {
    topMenu.classList.add("scroll");
  }
  // element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
  document.addEventListener(
    "scroll",
    function() {
      // or window.addEventListener("scroll"....
      var st = window.pageYOffset || document.documentElement.scrollTop;
      //console.log(st);
      if (st > lastScrollTop) {
        // downscroll code
        topMenu.classList.add("scroll");
      }
      if (st < 10) {
        topMenu.classList.remove("scroll");
      }
      lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
    },
    false
  );

  //cookie consent - doesn't work with all browsers

  const getPrivacy = () => {
    const value = localStorage.getItem("vostcookiept");
    //console.log('value', value);
    //if not exists cookie
    if (value === null) {
      const cookie = document.getElementById("cookie");
      //show element
      cookie.addEventListener("click", function(){
        this.classList.add("hide");
        localStorage.setItem("vostcookiept", "read and agreed");
      });
      cookie.classList.remove("hide");
      //add listener to close
    }
  };

  getPrivacy();
});

/*

//################# scroll menu
document.addEventListener("DOMContentLoaded", function (event) {

  //scroll on move
  var topMenu = document.querySelector('.header-menu');
  var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (lastScrollTop > 200) {
    topMenu.classList.add('active');
  }
  // element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
  document.addEventListener("scroll", function () {
    // or window.addEventListener("scroll"....
    var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
    if (st > lastScrollTop) {
      // downscroll code
      topMenu.classList.add('active');
    } else {
      // upscroll code
      if (st < 250) {
        topMenu.classList.remove('active');
      }
    }
    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
  }, false);

});


//################ smooth jump
//https://pawelgrzybek.com/page-scroll-in-vanilla-javascript/
//until browsers support smooth-scroll
function scrollIt(destination, duration = 200, easing = 'linear', callback) {

  const easings = {
    linear(t) { return t; },
    easeInQuad(t) { return t * t; },
    easeOutQuad(t) { return t * (2 - t); },
    easeInOutQuad(t) { return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; },
    easeInCubic(t) { return t * t * t; },
    easeOutCubic(t) { return (--t) * t * t + 1; },
    easeInOutCubic(t) { return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1; },
    easeInQuart(t) { return t * t * t * t; },
    easeOutQuart(t) { return 1 - (--t) * t * t * t; },
    easeInOutQuart(t) { return t < 0.5 ? 8 * t * t * t * t : 1 - 8 * (--t) * t * t * t; },
    easeInQuint(t) { return t * t * t * t * t; },
    easeOutQuint(t) { return 1 + (--t) * t * t * t * t; },
    easeInOutQuint(t) { return t < 0.5 ? 16 * t * t * t * t * t : 1 + 16 * (--t) * t * t * t * t; }
  };

  const start = window.pageYOffset;
  const startTime = 'now' in window.performance ? performance.now() : new Date().getTime();

  const documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight);
  const windowHeight = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
  const destinationOffset = typeof destination === 'number' ? destination : destination.offsetTop;
  const destinationOffsetToScroll = Math.round(documentHeight - destinationOffset < windowHeight ? documentHeight - windowHeight : destinationOffset);

  if ('requestAnimationFrame' in window === false) {
    window.scroll(0, destinationOffsetToScroll);
    if (callback) {
      callback();
    }
    return;
  }

  function scroll() {
    const now = 'now' in window.performance ? performance.now() : new Date().getTime();
    const time = Math.min(1, ((now - startTime) / duration));
    const timeFunction = easings[easing](time);
    window.scroll(0, Math.ceil((timeFunction * (destinationOffsetToScroll - start)) + start));

    if (window.pageYOffset === destinationOffsetToScroll) {
      if (callback) {
        callback();
      }
      return;
    }

    requestAnimationFrame(scroll);
  }

  scroll();
}


*/
