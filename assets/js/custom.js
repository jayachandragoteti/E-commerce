/*
Template Name: Osahan Fashion - Bootstrap 4 E-Commerce Theme
Author: Askbootstrap
Author URI: https://wrapbootstrap.com/user/gurdeep
Version: 1.0
*/
$(document).ready(function() {
    "use strict";

    // ===========Featured Owl Carousel============
    var objowlcarousel = $(".owl-carousel-featured");
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            items: 5,
            lazyLoad: true,
            pagination: false,
            autoPlay: 2000,
            navigation: true,
            stopOnHover: true
        });
    }

    // ===========Categories List Page============
    var mycategorylistpage = $(".categories-list-page");
    if (mycategorylistpage.length > 0) {
        mycategorylistpage.owlCarousel({
            items: 4,
            lazyLoad: true,
            pagination: false,
            navigation: true,
            autoPlay: 2000,
            stopOnHover: true
        });
    }
	
	// ===========Hover Nav============	
	$('.navbar-nav li.dropdown').on('mouseenter', function(){ $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(500); })
	$('.navbar-nav li.dropdown').on('mouseleave', function(){ $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(500); });

    // ===========Slider============
    var mainslider = $(".owl-carousel-slider");
    if (mainslider.length > 0) {
        mainslider.owlCarousel({
            items: 1,
            lazyLoad: true,
            pagination: true,
            autoPlay: 4000,
			singleItem: true,
            navigation: true,
            stopOnHover: true
        });
    }

    // ===========Select2============
    $('select').select2();

    // ===========Popover============
    $('[data-toggle="popover"]').popover()

    // ===========Scrollspy============
    $('body').scrollspy({
        target: '#navbar-example'
    })
    $('[data-spy="scroll"]').each(function() {
        var $spy = $(this).scrollspy('refresh')
    })

    // ===========Tooltip============
    $('[data-toggle="tooltip"]').tooltip()

    // ===========Countdown============
    var target_date = new Date('Jan, 31, 2018').getTime();
    var days, hours, minutes, seconds;
    var countdown = document.getElementById('countdown');
    setInterval(function() {
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;
        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;
        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);
        countdown.innerHTML = '<span class="days">' + days + ' <b>Days</b></span> <span class="hours">' + hours + ' <b>Hours</b></span> <span class="minutes">' +
            minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';

    }, 1000);

    // ===========Single Items Slider============	
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    sync1.owlCarousel({
        singleItem: true,
        slideSpeed: 1000,
        pagination: false,
        navigation: true,
       autoPlay: 2500,
        afterAction: syncPosition,
        responsiveRefreshRate: 200,
    });
    sync2.owlCarousel({
        items: 5,
        navigation: true,
        itemsDesktop: [1199, 10],
        itemsDesktopSmall: [979, 10],
        itemsTablet: [768, 8],
        itemsMobile: [479, 4],
        pagination: false,
        responsiveRefreshRate: 100,
        afterInit: function(el) {
            el.find(".owl-item").eq(0).addClass("synced");
        }
    });
    function syncPosition(el) {
        var current = this.currentItem;
        $("#sync2")
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
        if ($("#sync2").data("owlCarousel") !== undefined) {
            center(current)
        }
    }
    $("#sync2").on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo", number);
    });
    function center(number) {
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for (var i in sync2visible) {
            if (num === sync2visible[i]) {
                var found = true;
            }
        }
        if (found === false) {
            if (num > sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", num - sync2visible.length + 2)
            } else {
                if (num - 1 === -1) {
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if (num === sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if (num === sync2visible[0]) {
            sync2.trigger("owl.goTo", num - 1)
        }
    }
	
	var imported = document.createElement('script');
		imported.src = 'https://www.googletagmanager.com/gtag/js?id=UA-120909275-1';
		document.head.appendChild(imported);
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-120909275-1');	

});