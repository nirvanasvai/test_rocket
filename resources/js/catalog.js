import 'jquery'
require('jquery-bar-rating/dist/jquery.barrating.min.js')
require('jquery-bar-rating/dist/themes/fontawesome-stars.css')
require('@fancyapps/fancybox/dist/jquery.fancybox')
require('@fancyapps/fancybox/dist/jquery.fancybox.min.css')

$(document).ready(function() {
    $('.category_dropdown_toggle').click(function() {
        $(this).children('.category_icon').toggleClass('active_dropdown')
        $(this).next('.collapse').slideToggle()
    });
    $('.collapse ul').each(function(index, item) {
        $(item.children).each(function(li, i, e) {
            if (li > 6) {
                $(item.children).slice(6).hide();
            };
        });
        if (item.children.length > 6) {
            $(item.children).last().css('display', 'block')
            $(item.children).last().click(function(e) {
                e.preventDefault();
                $(item.children).show();
                $(this).hide()
            });
        }
    })
    $('.filter_toggle').click(function() {
        $('.mobile_filter').addClass('mobile_filter_active')
        $('body').css('overflow', 'hidden')
    });
    $('.submit_filter').click(function() {
        $('.mobile_filter').removeClass('mobile_filter_active');
    })
    $('.close_mobile_filter, .back_filter').click(function() {
        $('.mobile_filter ').removeClass('mobile_filter_active')
        $('body').css('overflow', 'scroll')
    });
    let size = 70;
    $('.product_img_title p').each(function() {
        if ($(this).text().length > size) {
            $(this).text($(this).text().slice(0, size) + '...')
        }
    });
    $('.slider-for').on('init', function(event, slick) {
        $('.product_info_main_slider').css('opacity', '1')
    });
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        responsive: [{
                breakpoint: 1300,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: false,
                    asNavFor: false,
                    fade: false,
                }
            },
            {
                breakpoint: 1020,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    asNavFor: false,
                    fade: false,
                    centerMode: true,
                    focusOnSelect: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    arrows: false,
                    asNavFor: false,
                    fade: false,
                    centerMode: true,
                    focusOnSelect: true
                }
            },

        ]
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: true,
        asNavFor: '.slider-for',
        centerMode: false,
        focusOnSelect: true,
    });

    $('.example').barrating({
        theme: 'fontawesome-stars',
        initialRating: '3',
        readonly: 'true'
    });


    $('.product_info_slider').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1450,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: true,
                    arrows: false,
                    asNavFor: false,
                    fade: false,
                    centerMode: true,
                    focusOnSelect: true,
                }
            },
        ]
    });
    $('.gallery_slider').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
                breakpoint: 1450,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    infinite: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    arrows: false,
                    asNavFor: false,
                    fade: false,
                    focusOnSelect: true,
                    centerPadding: '50px',
                }
            },
        ]
    })
    $('[data-fancybox="gallery"]').fancybox({
        toolbar: "smallBtn",
    });

    let str = $('.user_avatar p');
    str.each((i, item) => {
        $(item).text($(item).text().slice(0, 1));
    });
})
