// import 'bootstrap/dist/js/bootstrap';
// require('slick-carousel/slick/slick-theme.css');
// require('slick-carousel');
// // const inputmask = require('inputmask/dist/jquery.inputmask')
// // import './sass/main.scss'
import './catalog'
import './ajax'


$(document).ready(function() {
    $('.phone').inputmask("9(999) 999-9999");

    $('.dr_btn').click(function(e) {
        e.preventDefault()
    });
    $('[data-toggle="tooltip"]').tooltip();

    let imgWidth = $('.main_img, .card_category img');
    imgWidth.css({ 'height': `${imgWidth.width()}`, 'opacity': '1', 'max-height': 'none' });

    $('.dropdown_toggle').hover(function(e) {
        $(this).find('.dropdown-menu').finish().delay(20).fadeIn(10)
    }, function() {
        $(this).find('.dropdown-menu').finish().delay(20).fadeOut(10)
    });
    let size = 35;
    let text = $('.product_title p');
    text.each(function() {
        if ($(this).text().length > size) {
            $(this).text($(this).text().slice(0, size) + '...')
        }
    });



    let sizeCategoryText = 150;
    let textCategory = $('.card_category_text p');
    textCategory.each(function() {
        if ($(this).text().length > sizeCategoryText) {
            $(this).text($(this).text().slice(0, sizeCategoryText) + '...')
        }
    });


    $('.mobile_catalog a').click(function(e) {
        e.preventDefault()
        $('.catalog_links').slideToggle()
    })

    $('.burger_menu').click(function() {
        $('body').toggleClass('mobile_menu_active');
        $('html').toggleClass('overflow')
    });

    $('.exit_menu').click(function() {
        $('body').removeClass('mobile_menu_active');
    })

    $('.search_icon').click(function() {
        $('.nav_content').addClass('search_content_active');
    });

    $('.exit_search').click(function() {
        $('.nav_content').removeClass('search_content_active');
        $('.search_product').val('');
        $('.search_results').css('display', 'none').html('')
        $('.mobile_search').removeClass('mobile_search_active')
    });

    $('.search_mobile_toggle').click(function() {
        $('.mobile_search').addClass('mobile_search_active');
        $('html').toggleClass('overflow')
    });

    $(document).mouseup(function(e) {
        var searchContent = $(".search_product");
        if (!searchContent.is(e.target) &&
            searchContent.has(e.target).length === 0) {
            $('.nav_content').removeClass('search_content_active');
        }
        var searchContentMobile = $(".search_content_mobile");
        if (!searchContentMobile.is(e.target) &&
            searchContentMobile.has(e.target).length === 0) {
            $('.mobile_search').removeClass('mobile_search_active');
        }
    });
    $('.main_slider').on('init', function(event, slick) {
        $('.main_slider').css('opacity', '1')
    });
    $('.main_slider').slick({
        infinite: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true
            }
        }, ]
    });

    $('.brands_slider, .slider_services').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1100,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: true,
                    // centerMode: true,
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                    arrows: false,
                    centerMode: true,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    arrows: false
                }
            },

        ]
    });

    $('.show_mobile_category').click(function() {
        $('body').addClass('mobile_blogs_links_active');
        $('html').addClass('overflow')
    });
    $(document).mouseup(function(e) {
        var div = $(".mobile_blogs_links");
        if (!div.is(e.target) &&
            div.has(e.target).length === 0) {
            $('body').removeClass("mobile_blogs_links_active");
            $('html').removeClass('overflow')
        }
    });

    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 150) $('#ToTop').fadeIn();
    //     else $('#ToTop').fadeOut();
    // });

    // $('#ToTop').click(function() {
    //     $('body, html').animate({
    //         scrollTop: 0
    //     }, 1000);
    // });

    $('.map').css('height', `${$('.map').width()}`);
    $('.map_footer').css('height', `${$('.map_footer').width()}`);
})
