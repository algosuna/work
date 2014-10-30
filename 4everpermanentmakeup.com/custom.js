/*

Author: Pixelart Inc.

Author URI: http://www.pixelartinc.com/

*/





jQuery(document).ready(function($) {



    "use strict";



    $('.header-wrapper').css('height', $(window).height());



    var current = 1;

    var height = $('.ticker').height();

    var numberDivs = $('.ticker').children().length;

    var first = $('.ticker div:nth-child(1)');

    setInterval(function() {

        var number = current * -height;

        first.css('margin-top', number + 'px');

        if (current === numberDivs) {

            first.css('margin-top', '0px');

            current = 1;

        } else current++;

    }, 2500);



    function detailSlider(){

        $('.detail-slider .slides, .detail-two .slides').cycle({

            fx:'scrollHorz',

            next:'.right',

            prev:'.left'

        });

    }



    detailSlider();



    function getDetail(){

        $('.home .get-detail').click(function(e)

        {

            e.preventDefault();

            var target_url = $(this).attr('href');

            $('#portfolio_detail').html('<p class="loading">Loading ...</p>');

            $('#portfolio_detail').slideDown(500);

            $('#portfolio_detail').load( target_url +" .portfolio_detail", function(){

                $(this).fadeIn(500);

                closeDetail();

                detailSlider();

            });

        });

    }



    getDetail();



    function closeDetail(){

        $(".home .close-detail").click(function(e){

            e.preventDefault();

            $('#portfolio_detail').slideUp(500);

            $('#portfolio_detail').empty();

        });

    }



    closeDetail();



    $('.post_slider .slides').cycle({

        fx:'scrollHorz',

        next:'.right',

        prev:'.left'

    });



    $('.paralax1').parallax("50%", 0.3);

    $('.paralax2').parallax("50%", 0.3);

    $('.paralax3').parallax("50%", 0.3);

    $('.paralax4').parallax("50%", 0.1);

    $('.paralax5').parallax("50%", 0.3);



    $("nav ul li a, .scroll-to").bind('click',function(event){

        var headerH = $('nav ul').height();

        $("nav ul li a").removeClass('active');

        $(this).addClass('active');

        $("html, body").animate({

            scrollTop: $($(this).attr("href")).offset().top - (headerH) + "px"

        }, {

            duration: 1200,

            easing: "easeInOutExpo"

        });

        return false;

        event.preventDefault();

    });



    $("header .nav ul li ").hover(function(){

        $(this).children('.sub-menu').stop(true, true).slideDown(500);

    }, function(){

        $(this).children('.sub-menu').stop(true, true).slideUp(500);

    });



    $(".team figure ").hover(function(){

        $(this).children('.team figure .overlay').stop(true, true).fadeIn(500);

    }, function(){

        $(this).children('.team figure .overlay').stop(true, true).fadeOut(500);

    });



    $(".portfolio figure ").hover(function(){

        $(this).children('.portfolio .kreis').stop(true, true).fadeIn(500);

    }, function(){

        $(this).children('.kreis').stop(true, true).fadeOut(500);

    });



    $(".warnings .bar a  ").click(function(e){

        e.preventDefault();

        $(this).parent('.bar').stop(true, true).fadeOut(500);

    });



    $(".header-wrapper header").sticky({topSpacing:0});



    function open_nav(){

        $(".responsive_nav .open").click(function(e){

            e.preventDefault();

            $(this).next('ul').stop(true, true).slideToggle(500);

        });

    }

    open_nav();



    $( ".quote" ).cycle({

        fx:'scrollHorz'

    });



    $('.flexslider').flexslider({

        animation: "slide",

        slideshowSpeed: 5000,

        animationSpeed:	1500

    });



    $(function() {

        $('.progress-bar').appear();

        $('.progress-bar').children('.bar').width('0');

        $(document.body).on('appear', '.progress-bar', function(e, $affected) {

            $affected.each(function() {

                $(this).children('.bar').animate({width: $(this).data('perc')}, 2000, 'easeOutBounce');

            })

        });

    });



    $(function() {

        var value;

        $('#counter1 a, #counter2 a, #counter3 a, #counter4 a').appear();

        $(document.body).on('appear', '#counter1 a, #counter2 a, #counter3 a, #counter4 a', function(e, $affected) {

            $affected.each(function() {

                value = $(this).data('fact');

                $(this).animateNumbers( value, false, 500, "easeOutBounce" );

            })

        });

    });



    var $container = $('#project-container');

    $container.isotope({

        itemSelector : '.element'

    });

    var $optionSets = $('.option-set'),

        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){

        var $this = $(this);

        if ( $this.hasClass('selected') ) {

            return false;

        }

        var $optionSet = $this.parents('.option-set');

        $optionSet.find('.selected').removeClass('selected');

        $this.addClass('selected');

        var options = {},

            key = $optionSet.attr('data-option-key'),

            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;

        options[ key ] = value;

        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

            changeLayoutMode( $this, options )

        } else {

            $container.isotope( options );

        }

        return false;

    });



    $('.animated').appear();



    $(document.body).on('appear', '.fade', function() {

        $(this).each(function(){ $(this).addClass('ae-animation-fade') });

    });

    $(document.body).on('appear', '.slide', function() {

        $(this).each(function(){ $(this).addClass('ae-animation-slide') });

    });

    $(document.body).on('appear', '.hatch', function() {

        $(this).each(function(){ $(this).addClass('ae-animation-hatch') });

    });

    $(document.body).on('appear', '.entrance', function() {

        $(this).each(function(){ $(this).addClass('ae-animation-entrance') });

    });



});



(function($) {

    $.fn.animateNumbers = function(stop, commas, duration, ease) {

        return this.each(function() {

            var $this = $(this);

            var start = parseInt($this.text().replace(/,/g, ""));

            commas = (commas === undefined) ? true : commas;

            $({value: start}).animate({value: stop}, {

                duration: duration == undefined ? 1000 : duration,

                easing: ease == undefined ? "swing" : ease,

                step: function() {

                    $this.text(Math.floor(this.value));

                    if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }

                },

                complete: function() {

                    if (parseInt($this.text()) !== stop) {

                        $this.text(stop);

                        if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }

                    }

                }

            });

        });

    };

})(jQuery);