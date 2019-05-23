"use strict";
function subscribeEmail() {
    let e=jQuery,
    s=e("#email_signup").val();
    e("#subscribers_signup .form-group").html('<img src="/wp-content/themes/vost/assets/media/wave-preloader.gif" />'),
    e.post("/wp-content/themes/vost/subscribe.php", {
        email: s
    }
    , function(s) {
        e("#subscribers_signup").hide(), e("#subscribers_complete").show()
    }
    )
}

document.addEventListener("DOMContentLoaded", function() {
    var e=jQuery;
	let number_of_slides = 3;
	if (screen.width >= 960) {
		number_of_slides = 4;
	}
    e(".teams__wrap").slick( {
        infinite:!1, dots:!0, speed:300, slidesToShow:number_of_slides, slidesToScroll:number_of_slides, autoplay:!0, autoplaySpeed:15e3, lazyLoad:"ondemand", prevArrow:e(".prev"), nextArrow:e(".next"), responsive:[ {
            breakpoint:920, settings: {
                slidesToShow: 1, slidesToScroll: 1, dots: !1
            }
        }
        ]
    }
    ), e(".testimonials__wrap").slick( {
        infinite:!1, dots:!0, speed:300, slidesToShow:number_of_slides, slidesToScroll:number_of_slides, autoplay:!0, autoplaySpeed:15e3, lazyLoad:"ondemand", prevArrow:e(".prev"), nextArrow:e(".next"), responsive:[ {
            breakpoint:920, settings: {
                slidesToShow: 1, slidesToScroll: 1, dots: !1
            }
        }
        ]
    }
    ), e(".media_entries__wrap").slick( {
        infinite:!1, dots:!0, speed:300, slidesToShow:number_of_slides, slidesToScroll:number_of_slides, autoplay:!0, autoplaySpeed:15e3, lazyLoad:"ondemand", prevArrow:e(".prev"), nextArrow:e(".next"), responsive:[ {
            breakpoint:920, settings: {
                slidesToShow: 1, slidesToScroll: 1, dots: !1
            }
        }
        ]
    }
    )
}

);