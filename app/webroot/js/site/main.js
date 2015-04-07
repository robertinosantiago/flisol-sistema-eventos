(function ($) {
    //paralax
    var isMobile = false;

    if (Modernizr.mq('only all and (max-width: 1024px)')) {
        isMobile = true;
    }


    if (isMobile == false && ($('#programacao').length)) {
        $(window).stellar({
            responsive: true,
            scrollProperty: 'scroll',
            parallaxElements: false,
            horizontalScrolling: false,
            horizontalOffset: 0,
            verticalOffset: 0
        });
    }

    jQuery('.navbar').localScroll({hash: true, offset: {top: -30}, duration: 800, easing: 'easeInOutExpo'});

    if (Modernizr.mq("screen and (max-width:1024px)")) {
        jQuery("body").toggleClass("body");

    } else {
        var s = skrollr.init({
            mobileDeceleration: 1,
            edgeStrategy: 'set',
            forceHeight: true,
            smoothScrolling: true,
            smoothScrollingDuration: 200,
            easing: {
                WTF: Math.random,
                inverted: function (p) {
                    return 1 - p;
                }
            }
        });
    }

    //scroll menu
    jQuery('.appear').appear();
    jQuery(".appear").on("appear", function (data) {
        var id = $(this).attr("id");
        jQuery('.nav li').removeClass('active');
        if (id === 'header') {
            jQuery("ul.navbar-main li:nth-child(1)").addClass("active");
        } else {
            jQuery(".nav a[href='#" + id + "']").parent().addClass("active");
        }

    });

})(jQuery);


