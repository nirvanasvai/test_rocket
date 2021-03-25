$(document).ready(function() {
    let url = $(location).attr('pathname').substring($(location).attr('pathname').lastIndexOf('/') + 1);
    let productLink = $(location).attr('pathname')
    $('.change_form :input').change(function() {
        let filtersArr = [];
        let brandArr = [];
        let colorArr = [];
        // let minPrice = 0;
        // let maxPrice = 0;
        $('.product_value').each(function(index, item) {
            if ($(this).attr('name') === 'filters' && $(this).is(':checked')) {
                value = parseInt($(this).val());
                filtersArr.push(value);
            } else {
                filtersArr.splice(index, 1)
            }
            if ($(this).attr('name') === 'brand' && $(this).is(':checked')) {
                value = parseInt($(this).val());
                brandArr.push(value);
            } else {
                brandArr.splice(index, 1);
            }
            if ($(this).attr('name') === 'color' && $(this).is(':checked')) {
                value = parseInt($(this).val());
                colorArr.push(value);
            } else {
                colorArr.splice(index, 1)
            }
        });

        // $(".min").keyup(function() {
        //     minPrice = $(this).val();
        // }).keyup();
        // $(".max").keyup(function() {
        //     maxPrice = $(this).val();
        // }).keyup();

        $.ajax({
            method: "POST",
            url: "/api-filter",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                category_slug: url,
                collection: filtersArr,
                brand: brandArr,
                color: colorArr,
                // min: minPrice, max: maxPrice
            },
            beforeSend: function() {
                $('.products_wrapper').prepend(`<div class="loader">
                <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>
                </div>`);
            },
        })

        .done(function(response) {
            $('.loader').remove();
            let parse = JSON.parse(response);
            dataProduct(parse)
        });
    });

    function dataProduct(productData) {
        let productHtml = ``;
        console.log(productData);
        productData.forEach(product => {
            productHtml += `
            <div class="col-xl-3 col-lg-4 col-6">
                <div class="product_card">
                    <a href="${'/product/' + product.product_url}">
                        <div class="product_img_title">
                            <div class="product_img">
                                <img class="main_img" src="${product.children_img.length ? '/storage/test/' + product.children_img[0].product_img : '/dist/images/no_image.jpg'}" alt="${product.name}">
                                <span class="like">
                                    <i class="far fa-heart like_icon" id="${product.id}"></i>
                                </span>
                                <span class="percent">
                                    ${product.sale !== null ? '<img src="/dist/images/percent.svg" alt="">'  : '<span></span>'}
                                </span>
                            </div>
                            <div class="product_title">
                                <p>${product.name}</p>
                            </div>
                        </div>
                        <div class="product_info">
                            <p><span class="silver_text">Артикул:&nbsp; </span>${product.article}</p>
                            <p><span class="silver_text">Бренд:&nbsp; </span>${product.brands[0].brand_name}</p>
                        </div>
                        <div class="price">
                            ${product.price !== null ? '<div class="price"><p>Цена: <span class="red_text">' + product.price + '<img src="/dist/images/tg.svg" alt=""></span></div>' : '<span></span>'}
                        </div>
                    </a>
                </div>
            </div>`;
        });
        $('.product_content').html(productHtml);
        let imgWidth = $('.main_img');
        imgWidth.css({ 'height': `${imgWidth.width()}`, 'opacity': '1', 'max-height': 'none' });
    };

    $(".search_product").keyup(function() {
        let searchVal = $(this).val();
        if ($(this).val().length > 2) {
            $('.search_results').css('display', 'block')
            $.ajax({
                    method: "POST",
                    url: "/ajax-search",
                    data: { _token: $('meta[name="csrf-token"]').attr('content'), text: searchVal },
                    beforeSend: function() {
                        $('.search_results').html('Загрузка...');
                    },
                })
                .done(function(response) {
                    let parse = JSON.parse(response)
                    searchData(parse);
                    if (parse.length === 0) {
                        $('.search_results').html('Ничего не найдено !');
                    }
                });
        } else {
            $('.search_results').css('display', 'none')
            $('.search_results').html('');
        }
    });

    function searchData(date) {
        let searchHtml = ``;
        console.log(date);
        date.forEach(product => {
            searchHtml += `
                        <a href="${'/product/' + product.product_link}">${product.product_name}</a>`;
        });
        $('.search_results').html($(searchHtml))
    };

    let favoritesArr = [];
    $(document).on('click', '.like_icon', function(e) {
        let id = $(this).attr('id');
        favoritesArr = JSON.parse(localStorage.getItem('favorite'));
        e.preventDefault();
        if (favoritesArr == null) {
            $(this).addClass('fas');
            localStorage.setItem('favorite', JSON.stringify([id]));
        } else if (favoritesArr == []) {
            favoritesArr.push(id)
            localStorage.setItem('favorite', JSON.stringify(favoritesArr))
        } else if (favoritesArr.find(item => item == id)) {
            favoritesArr.forEach((item, index) => {
                if (item == id) {
                    favoritesArr.splice(index, 1);
                    $(this).removeClass('fas')
                }
            })
            $('.favorites_link i').css('color', '#646464')
            localStorage.setItem('favorite', JSON.stringify(favoritesArr));
        } else {
            favoritesArr.push(id);
            localStorage.setItem('favorite', JSON.stringify(favoritesArr));
            $(this).addClass('fas');
        }
        if (JSON.parse(localStorage.getItem('favorite')).length > 0) {
            $('.favorites_count').css('display', 'flex')
            $('.favorites_count').html(JSON.parse(localStorage.getItem('favorite')).length);
            $('.favorites_link i').css('color', '#cc4a4a')
        } else {
            $('.favorites_count').hide()
        }
    });

    if (JSON.parse(localStorage.getItem('favorite')) && JSON.parse(localStorage.getItem('favorite')).length) {
        $('.favorites_count').html(JSON.parse(localStorage.getItem('favorite')).length);
        $('.favorites_count').css('display', 'flex');
        $('.favorites_link i').css('color', '#646464')
        JSON.parse(localStorage.getItem('favorite')).forEach((i) => {
            let localStorageItem = JSON.parse(i);
            $('.like_icon').each((item, i) => {
                if (localStorageItem === Number($(i).attr('id'))) {
                    $(i).addClass('fas');
                } else {

                }
            })
        })
    }

    if (url === 'favorites') {
        let dataFavoriteArr = JSON.parse(localStorage.getItem('favorite'));
        $.ajax({
            method: "POST",
            url: "/api-favorites",
            data: { _token: $('meta[name="csrf-token"]').attr('content'), id: dataFavoriteArr },
            beforeSend: function() {
                $('.favorites_wrapper').prepend(`
                    <div class="loader">
                        <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>`);
            },
            success: (response) => {
                let parse = JSON.parse(response);
                let productHtml = ``;
                parse.forEach(item => {
                    productHtml += `
                        <div class="col-xl-3 col-lg-4 col-6 col-md-4">
                        <div class="product_card">
                            <a href="${'/product/' + item.product_url}">
                                <div class="product_img_title">
                                    <div class="product_img">
                                        <img class="main_img" src="${item.children_img.length ? '/storage/test/' + item.children_img[0].product_img : '/dist/images/no_image.jpg'}" alt="${item.name}">
                                        <span class="like" >
                                            <i class="far fa-heart like_icon fas" id="${item.id}"></i>
                                        </span>
                                        <span class="percent">
                                            ${item.sale !== null ? '<img src="/dist/images/percent.svg" alt="">'  : '<span></span>'}
                                        </span>
                                    </div>
                                    <div class="product_title">
                                    <p>${item.name}</p>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <p><span class="silver_text">Артикул: </span>${item.article}</p>
                                    <p><span class="silver_text">Бренд: </span>${item.brands[0].brand_name}</p>
                                </div>
                                ${item.price !== null ? '<div class="price"><p>Цена: <span class="red_text">' + item.price + '<img src="/dist/images/tg.svg" alt=""></span></div>' : '<span></span>'}
                            </a>
                        </div>
                    </div>`;
                });
                $('.favorites_wrapper').html(productHtml);
                let imgWidth = $('.main_img');
                imgWidth.css({ 'height': `${imgWidth.width()}`, 'opacity': '1', 'max-height': 'none' });
            },
            error: (error) => {
                $('.favorites_wrapper').html('<div class="text-center title_block w-100 mt-5"><h3 class="m-auto">У вас нет избранных товаров !</h3></div>')
            }
        })
    }


    let emailCheck = false;
    let phoneCheck = false;
    let name = false;
    let lastName = false;
    let coment = false;
    let ratingVal = null;

    $('.emailCall').blur(function() {
        if ($(this).val() != '') {
            let pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if (pattern.test($(this).val())) {
                emailCheck = true;
                $(this).next('.error_text').html('');
            } else {
                emailCheck = false;
                $(this).next('.error_text').html('Ошибка в поле E-mail!');

            }
        }
    })

    $('.phone').blur(function() {
        let numberArr = [700, 701, 702, 703, 704, 705, 706, 707, 708, 709, 747, 750, 751, 760, 761, 762, 763, 764, 771, 775, 776, 777, 778];
        let phoneNum = parseInt($(this).val().substr(2, 3));
        let numLength = $(this).val().replace(/[^0-9]/gi, '');
        if (jQuery.inArray(phoneNum, numberArr) !== -1 && numLength.length === 11) {
            phoneCheck = true;
            $(this).next('.error_text').html('');
        } else {
            phoneCheck = false;
            $(this).next('.error_text').html('Ошибка в поле телефон! Минмальное значение 11 симоволов!');

        }
    })
    $('.name').blur(function() {
        if ($(this).val().length < 3 || $(this).val().length > 15) {
            name = false;
            $(this).next('.error_text').html('Ошибка в поле имя!');
        } else {
            name = true;
            $(this).next('.error_text').html('');
        }
    })
    $('.last_name').blur(function() {
        if ($(this).val().length < 3 || $(this).val().length > 15) {
            lastName = false;
            $(this).next('.error_text').html('Ошибка в поле фамилия!');
        } else {
            lastName = true;
            $(this).next('.error_text').html('');
        }
    });
    $('.coment').blur(function() {
        if ($(this).val().length > 250) {
            coment = false;
            $(this).next('.error_text').html('Ошибка в поле имя!');
        } else {
            coment = true;
            $(this).next('.error_text').html('');
        }
    });

    if ($("div").is(".catalog_innder_page")) {
        let productId = $('.product_info_main').attr('data-id');
        $.ajax({
            method: "POST",
            url: "/rating_count",
            data: { _token: $('meta[name="csrf-token"]').attr('content'), id: productId },
            success: (response) => {
                let ratingCount = parseInt(response);
                $('.add_rating').barrating({
                    theme: 'fontawesome-stars',
                    initialRating: ratingCount,
                    showSelectedRating: true,
                    triggerChange: true
                });
                $('.review_star').css('opacity', '1');
                $('.review_star_modal .br-widget a').click(function(e) {
                    e.preventDefault();
                    ratingVal = $(this).attr('data-rating-value');
                    $('#product_review').modal('show');
                    $('body').addClass('modal-open');
                    $('.review_star').next('.error_text').html('');

                });
                $('.br-widget a').click(function(e) {
                    e.preventDefault();
                    $('.review_star').next('.error_text').html('');
                    ratingVal = $(this).attr('data-rating-value');
                    $('body').addClass('modal-open');
                });
            },
            error: (errors) => {
                console.log(errors);
            }
        })
    }

    $('#requestCallFormButton').click(function(e) {
        e.preventDefault();
        let typeOrder = $(this).attr('data-type');
        $('.error_text').html('');
        $('#email').html("");
        let form = $('#requestCallForm').serializeArray();
        form.push({ name: 'product_id', value: $('.product_info_main').data('id') });
        form.push({ name: '_token', value: $('meta[name="csrf-token"]').attr('content') });;
        form.push({ name: 'type', value: typeOrder });
        $('#product_modal .modal-header .success').html('');
        if (!phoneCheck) {
            $('#requestCallForm').find('.phone').next('.error_text').html('Ошибка в поле телефон!');
        };
        if (!emailCheck) {
            $('#requestCallForm').find('.emailCall').next('.error_text').html('Ошибка в поле E-mail!');
        };
        if (!name) {
            $('#requestCallForm').find('.name').next('.error_text').html('Ошибка в поле имя!');
        };
        if (!coment) {
            $('#requestCallForm').find('.coment').next('.error_text').html('Ошибка в поле отзыв!');
        };
        if (!capcha3) {
            $('#requestCallForm').find('.g-recaptcha').next('.error_text').html('Подтвердите что вы не робот!');
        } else {
            $('#requestCallForm').find('.g-recaptcha').next('.error_text').html('');
        };


        if (phoneCheck && emailCheck && name && capcha3) {
            $.ajax({
                method: "POST",
                url: "/product_url",
                data: form,
                beforeSend: function() {
                    $('#requestCallFormButton').append(`
                            <div class="loader_btn">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`);
                },
                success: () => {
                    emailCheck = false;
                    phoneCheck = false;
                    name = false;
                    lastName = false;
                    coment = false;
                    ratingVal = null;
                    capcha = false;
                    $('#requestCallForm input, #requestCallForm textarea').val('');
                    $('#requestCallFormButton .loader_btn').remove()
                    $('#product_modal .modal-header').append(`
                                <div class="success">
                                    <i class="fas fa-check"></i>
                                    <p>Ваша заявка успешна!</p>
                                </div>
                        `);
                    setTimeout(function() {
                        $('.success').remove();
                        $('.error_text').html('');
                        $('#product_modal').modal('hide');
                    }, 1000);
                    grecaptcha.reset();
                },
                error: (errors) => {
                    console.log(errors);

                    $('#product_modal .modal-header .success').remove()
                    let errorCapcha = errors.responseJSON.errors;
                    let errorText = JSON.parse(errors.responseText);
                    for (error in errorText.errors) {
                        $('#' + error).html(errorText.errors[error]);
                    }
                    $('#requestCallForm').find('.g-recaptcha').next('.error_text').html(errorCapcha['g-recaptcha-response'][0] + '!');
                    $('#product_modal .loader_btn').remove();
                }
            })
        }
    });

    $('#requestCallTopButton').click(function(e) {
        let typeOrder = $(this).attr('data-type');
        e.preventDefault();
        $('.error_text').html('');
        $('#email').html("");

        let form = $('#requestTopCallForm').serializeArray();
        form.push({ name: '_token', value: $('meta[name="csrf-token"]').attr('content') });;
        form.push({ name: 'type', value: typeOrder });

        $('#product_modal .modal-header .success').html('');
        if (!phoneCheck) {
            $('#requestTopCallForm').find('.phone').next('.error_text').html('Ошибка в поле телефон! Минмальное значение 11 симоволов!');
        };
        if (!name) {
            $('#requestTopCallForm').find('.name').next('.error_text').html('Ошибка в поле имя!');
        };
        if (!coment) {
            $('#requestTopCallForm').find('.coment').next('.error_text').html('Ошибка в поле отзыв!');
        };
        if (!capcha1) {
            $('#requestTopCallForm').find('.g-recaptcha').next('.error_text').html('Подтвердите что вы не робот!');
        } else {
            $('#requestTopCallForm').find('.g-recaptcha').next('.error_text').html('');
        }
        if (phoneCheck && name && coment && capcha1) {
            $.ajax({
                method: "POST",
                url: "/product_url",
                data: form,
                beforeSend: function() {
                    $('#requestCallTopButton').append(`
                            <div class="loader_btn">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`);
                },
                success: () => {
                    emailCheck = false;
                    phoneCheck = false;
                    name = false;
                    lastName = false;
                    coment = false;
                    ratingVal = null;
                    capcha = false;
                    $('#requestCallTopButton .loader_btn').remove()
                    $('#requestTopCallForm input, #requestTopCallForm textarea').val('');
                    $('#modalTopForm .modal-header').append(`
                                <div class="success">
                                    <i class="fas fa-check"></i>
                                    <p>Ваша заявка успешна!</p>
                                </div>
                        `);
                    setTimeout(function() {
                        $('#modalTopForm').modal('hide');
                        $('.success').remove();
                        $('.error_text').html('');
                    }, 1000);
                    grecaptcha.reset();
                },
                error: (errors) => {
                    $('#requestTopCallForm .modal-header .success').remove();
                    let errorCapcha = errors.responseJSON.errors;
                    let errorText = JSON.parse(errors.responseText);
                    for (error in errorText.errors) {
                        $('#' + error).html(errorText.errors[error]);
                    }
                    $('#requestTopCallForm').find('.g-recaptcha').next('.error_text').html(errorCapcha['g-recaptcha-response'][0] + '!');
                    $('#requestCallTopButton .loader_btn').remove();
                }
            })
        }
    });

    $('#send_review').click(function(e) {
        e.preventDefault();
        $('.error_text').html('');
        let form = $('#requestReviewForm').serializeArray();
        form.push({ name: 'id_product', value: $('.product_info_main').data('id') });
        form.push({ name: 'rating', value: ratingVal });
        form.push({ name: '_token', value: $('meta[name="csrf-token"]').attr('content') });
        $('#send_review .modal-header .success').html('');
        if (!name) {
            $('#requestReviewForm').find('.name').next('.error_text').html('Ошибка в поле имя!');
        };
        if (!emailCheck) {
            $('#requestReviewForm').find('.emailCall').next('.error_text').html('Ошибка в поле E-mail!');
        };
        if (!lastName) {
            $('#requestReviewForm').find('.last_name').next('.error_text').html('Ошибка в поле фамилия!');
        };
        if (!coment) {
            $('#requestReviewForm').find('.coment').next('.error_text').html('Ошибка в поле отзыв!');
        };
        if (ratingVal === null) {
            $('#requestReviewForm').find('.review_star').next('.error_text').html('Поставьте оценку!');
        };
        if (!capcha4) {
            $('#requestReviewForm').find('.g-recaptcha').next('.error_text').html('Подтвердите что вы не робот!');
        } else {
            $('#requestReviewForm').find('.g-recaptcha').next('.error_text').html('');
        }
        if (emailCheck && name && lastName && coment && ratingVal !== null && capcha4) {
            $.ajax({
                method: "POST",
                url: "/api-review",
                data: form,
                beforeSend: function() {
                    $('#send_review').append(`
                            <div class="loader_btn">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`);
                },
                success: (response) => {
                    emailCheck = false;
                    phoneCheck = false;
                    name = false;
                    lastName = false;
                    coment = false;
                    ratingVal = null;
                    capcha = false;
                    $('#send_review .loader_btn').remove();
                    $('#requestReviewForm input, #requestReviewForm textarea').val('');
                    $('#product_review .modal-header').append(`
                                <div class="success">
                                    <i class="fas fa-check"></i>
                                    <p>Ваша заявка успешна!</p>
                                </div>
                        `)
                    setTimeout(function run() {
                        $('#product_review').modal('hide');
                        $('#product_review .modal-header .success').remove();
                        $('.error_text').html('');
                    }, 1000);
                    grecaptcha.reset();
                },
                error: (errors) => {
                    $('#product_review .modal-header .success').remove();
                    let errorText = JSON.parse(errors.responseText);
                    for (error in errorText.errors) {
                        $('#' + error).html(errorText.errors[error]);
                    }
                    // $('#requestReviewForm').find('.g-recaptcha').next('.error_text').html(errorText['g-recaptcha-response'][0] + '!');
                    $('#send_review .loader_btn').remove();
                }
            })
        }
    });

    $('#send_review_tab').click(function(e) {
        e.preventDefault();
        $('.error_text').html('');
        let form = $('#requestReviewFormTab').serializeArray();
        form.push({ name: 'id_product', value: $('.product_info_main').data('id') });
        form.push({ name: 'rating', value: ratingVal });
        form.push({ name: '_token', value: $('meta[name="csrf-token"]').attr('content') });

        if (!name) {
            $('#requestReviewFormTab').find('.name').next('.error_text').html('Ошибка в поле имя!');
        };
        if (!emailCheck) {
            $('#requestReviewFormTab').find('.emailCall').next('.error_text').html('Ошибка в поле E-mail!');
        };
        if (!lastName) {
            $('#requestReviewFormTab').find('.last_name').next('.error_text').html('Ошибка в поле фамилия!');
        };
        if (!coment) {
            $('#requestReviewFormTab').find('.coment').next('.error_text').html('Ошибка в поле отзыв!');
        };
        if (ratingVal === null) {
            $('#requestReviewFormTab').find('.review_star').next('.error_text').html('Поставьте оценку!');
        };
        if (!capcha2) {
            $('#requestReviewFormTab').find('.g-recaptcha').next('.error_text').html('Подтвердите что вы не робот!');
        } else {
            $('#requestReviewFormTab').find('.g-recaptcha').next('.error_text').html('');
        }
        if (name && emailCheck && lastName && coment && ratingVal !== null && capcha2) {
            $.ajax({
                method: "POST",
                url: "/api-review",
                data: form,
                beforeSend: function() {
                    $('#send_review_tab').append(`
                            <div class="loader_btn">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`);
                },
                success: (response) => {
                    emailCheck = false;
                    phoneCheck = false;
                    name = false;
                    lastName = false;
                    coment = false;
                    ratingVal = null;
                    capcha = false;
                    $('#send_review_tab .loader_btn').remove();
                    $('#requestReviewFormTab input, #requestReviewFormTab textarea').val('');
                    $('#requestReviewFormTab .modal-footer').prepend(`
                                <div class="success">
                                    <i class="fas fa-check"></i>
                                    <p>Ваша заявка успешна!</p>
                                </div>
                        `)
                    setTimeout(function run() {
                        $('.error_text').html('');
                        $('#requestReviewFormTab .modal-footer .success').remove()
                    }, 1000);
                    grecaptcha.reset();
                },
                error: (errors) => {
                    $('#requestReviewFormTab .modal-footer .success').remove();
                    let errorText = JSON.parse(errors.responseText);
                    for (error in errorText.errors) {
                        console.log(errorText.errors[error]);
                        $('#' + error).html(errorText.errors[error]);
                    }
                    // $('#requestReviewForm').find('.g-recaptcha').next('.error_text').html(errorText['g-recaptcha-response'][0] + '!');
                    $('#send_review_tab .loader_btn').remove();
                }
            })
        }
    });

    $('.modal-header .close').click(function() {
        $('.success').remove();
        $('.error_text').html('')
    });

    let youWatchedArr = [];

    $('.save_product').click(function(e) {
        let id = $(this).attr('data-id');
        youWatchedArr = JSON.parse(localStorage.getItem('watch'));
        if (youWatchedArr == null) {
            localStorage.setItem('watch', JSON.stringify([id]));
        } else if (youWatchedArr == []) {
            youWatchedArr.push(id)
            localStorage.setItem('watch', JSON.stringify(youWatchedArr))
        } else if (youWatchedArr.find(item => item == id)) {
            localStorage.setItem('watch', JSON.stringify(youWatchedArr));
        } else {
            youWatchedArr.push(id);
            localStorage.setItem('watch', JSON.stringify(youWatchedArr));
        }
    });

    if (JSON.parse(localStorage.getItem('watch')) !== null) {
        let localWatch = JSON.parse(localStorage.getItem('watch'));
        let productid = $('.like_icon').attr('id');
        let prouductArr = localWatch.filter(item => item !== productid);
        $.ajax({
            method: "POST",
            url: "/api-favorites",
            data: { _token: $('meta[name="csrf-token"]').attr('content'), id: prouductArr },
            beforeSend: function() {},
            success: (response) => {
                let parse = JSON.parse(response);
                let start = parse.length - 5;
                let end = parse.length;
                let watchEl = parse.slice(start, end);
                let productHtml = ``;
                if (parse.length < 5) {
                    parse.forEach((item, index) => {
                        productHtml += `
                            <div class="col-xl-3 col-lg-3 col-6 col-md-4">
                            <div class="product_card">
                                <a href="${'/product/' + item.product_url}">
                                    <div class="product_img_title">
                                        <div class="product_img">
                                            <img class="img_watch" src="${item.children_img.length ? '/storage/test/' + item.children_img[0].product_img : '/dist/images/no_image.jpg'}" alt="">
                                            <span class="like" >
                                                <i class="far fa-heart like_icon" id="${item.id}"></i>
                                            </span>
                                            <span class="percent">
                                                ${item.sale !== null ? '<img src="/dist/images/percent.svg" alt="">'  : '<span></span>'}
                                            </span>
                                        </div>
                                        <div class="product_title">
                                        <p>${item.name}</p>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <p><span class="silver_text">Артикул: </span>${item.article}</p>
                                        <p><span class="silver_text">Бренд: </span>${item.brands[0].brand_name}</p>
                                    </div>
                                    ${item.price !== null ? '<div class="price"><p>Цена: <span class="red_text">' + item.price + '<img src="/dist/images/tg.svg" alt=""></span></div>' : '<span></span>'}
                                </a>
                            </div>
                        </div>`;
                    });
                } else {
                    watchEl.forEach((item, index) => {
                        productHtml += `
                            <div class="col-xl-3 col-lg-3 col-6 col-md-4">
                            <div class="product_card">
                                <a href="${'/product/' + item.product_url}">
                                    <div class="product_img_title">
                                        <div class="product_img">
                                            <img class="img_watch" src="${item.children_img.length ? '/storage/test/' + item.children_img[0].product_img : '/dist/images/no_image.jpg'}" alt="">
                                            <span class="like" >
                                                <i class="far fa-heart like_icon" id="${item.id}"></i>
                                            </span>
                                            <span class="percent">
                                                ${item.sale !== null ? '<img src="/dist/images/percent.svg" alt="">'  : '<span></span>'}
                                            </span>
                                        </div>
                                        <div class="product_title">
                                        <p>${item.name}</p>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <p><span class="silver_text">Артикул: </span>${item.article}</p>
                                        <p><span class="silver_text">Бренд: </span>${item.brands[0].brand_name}</p>
                                    </div>
                                    ${item.price !== null ? '<div class="price"><p>Цена: <span class="red_text">' + item.price + '<img src="/dist/images/tg.svg" alt=""></span></div>' : '<span></span>'}
                                </a>
                            </div>
                        </div>`;
                    });
                }
                $('.product_watch').html(productHtml);
                let imgWidth = $('.img_watch');
                imgWidth.css({ 'height': `${imgWidth.width()}`, 'opacity': '1', 'max-height': 'none' });
            },
            error: (error) => {
                console.log(error);
            }
        })
    };

    $('.name').keyup(function() {
        $(this).next('.error_text').html('')
        if ($(this).val().length >= 18) {
            $(this).next('.error_text').html('Максимальное значение 20 символов')
        }
    });
});
