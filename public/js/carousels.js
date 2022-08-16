$(document).ready(function() {
    /* $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 25,
        center: true,
        nav: false,
        dots: true
    }) */
    $('.ttd-carousel').owlCarousel({
        loop: true,
        margin: 25,
        center: true,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        animateOut: 'fadeOut',
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 2
            },
            700: {
                items: 3
            }
        }
    });

    $('.things-vip-carousel').owlCarousel({
        loop: true,
        margin: 15,
        center: true,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        animateOut: 'fadeOut',
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 2
            },
            700: {
                items: 3
            }
        }
    });
    $('#events-carousel').owlCarousel({
        loop: true,
        margin: 25,
        center: false,
        nav: false,
        dots: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    });
});