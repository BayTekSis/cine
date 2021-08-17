$(document).ready(function () {
    "use strict"; // start of use strict
    var selected_seats=[];
    var film_id = $('#film_id').val();

    $('.filter__btn_x').on('click', function () {
        var clicked_seat=$(this).attr('id');
        // if(selected_seats.includes(clicked_seat)){
        //     alert('Bu Koltuğu Zaten Seçtiniz.')
        // }else{
        //
        // }
        if(jQuery.inArray(clicked_seat,selected_seats)<0){
            selected_seats.push(clicked_seat);
            $(this).addClass('filter_btn_selected');
        }else{
            selected_seats.splice(jQuery.inArray(clicked_seat,selected_seats),1)
            $(this).removeClass('filter_btn_selected');


        }
        $('#seat_numbers').val(selected_seats.toString());


        console.log(selected_seats);

    });
    $('.filter_btn_selected').on('click', function () {
        $(this).removeClass('filter_btn_selected');
    });

    $('.filter__btn__disabled').on('click', function () {

        alert('Bu Koltuk Seçilemez');
    });

    $('#make_reservation').on('click', function () {

        $('#accordion').show();
        $('#make_reservation').hide();

        console.log('film_id:' + film_id);

        // $.ajax({
        //     type: "GET",
        //     url: "/api/film-cities/"+film_id,
        //     success: function (data) {
        //         var string1 = JSON.stringify(data);
        //         var html_result = '';
        //         var json = JSON.parse(string1);
        //         console.log(json)
        //
        //         json.forEach(function (element, index) {
        //             html_result.append('<li>'+json[index]['city_name']+'</li>')
        //             // html_result+='<li id="city_id-';
        //             // html_result+= json[index]['id'];
        //             // html_result+='">';
        //             // html_result+= json[index]['city_name'];
        //             // html_result+='</li>';
        //
        //
        //         });
        //         console.log(html_result)
        //         // $('#filter__city_ul').html(html_result);
        //         // $.each()
        //         // foreach(data)
        //         // // var json = JSON.parse(data)
        //         // console.log(data);
        //
        //         // if (json['ok']) {
        //         //
        //         // }
        //     }
        // });

    });
    /*==============================
    Menu
    ==============================*/
    $('.header__btn').on('click', function () {
        $(this).toggleClass('header__btn--active');
        $('.header__nav').toggleClass('header__nav--active');
        $('.body').toggleClass('body--active');

        if ($('.header__search-btn').hasClass('active')) {
            $('.header__search-btn').toggleClass('active');
            $('.header__search').toggleClass('header__search--active');
        }
    });

    /*==============================
    Search
    ==============================*/
    $('.header__search-btn').on('click', function () {
        $(this).toggleClass('active');
        $('.header__search').toggleClass('header__search--active');

        if ($('.header__btn').hasClass('header__btn--active')) {
            $('.header__btn').toggleClass('header__btn--active');
            $('.header__nav').toggleClass('header__nav--active');
            $('.body').toggleClass('body--active');
        }
    });

    /*==============================
    Home
    ==============================*/
    $('.home__bg').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        mouseDrag: false,
        touchDrag: false,
        items: 1,
        dots: false,
        loop: true,
        autoplay: false,
        smartSpeed: 600,
        margin: 0,
    });

    $('.home__bg .item').each(function () {
        if ($(this).attr("data-bg")) {
            $(this).css({
                'background': 'url(' + $(this).data('bg') + ')',
                'background-position': 'center center',
                'background-repeat': 'no-repeat',
                'background-size': 'cover'
            });
        }
    });

    $('.home__carousel').owlCarousel({
        mouseDrag: false,
        touchDrag: false,
        dots: false,
        loop: true,
        autoplay: false,
        smartSpeed: 600,
        margin: 30,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
            1200: {
                items: 4,
            },
        }
    });

    $('.home__nav--next').on('click', function () {
        $('.home__carousel, .home__bg').trigger('next.owl.carousel');
    });
    $('.home__nav--prev').on('click', function () {
        $('.home__carousel, .home__bg').trigger('prev.owl.carousel');
    });

    $(window).on('resize', function () {
        var itemHeight = $('.home__bg').height();
        $('.home__bg .item').css("height", itemHeight + "px");
    });
    $(window).trigger('resize');

    /*==============================
    Tabs
    ==============================*/
    $('.content__mobile-tabs-menu li').each(function () {
        $(this).attr('data-value', $(this).text().toLowerCase());
    });

    $('.content__mobile-tabs-menu li').on('click', function () {
        var text = $(this).text();
        var item = $(this);
        var id = item.closest('.content__mobile-tabs').attr('id');
        $('#' + id).find('.content__mobile-tabs-btn input').val(text);
    });

    /*==============================
    Section bg
    ==============================*/
    $('.section--bg, .details__bg').each(function () {
        if ($(this).attr("data-bg")) {
            $(this).css({
                'background': 'url(' + $(this).data('bg') + ')',
                'background-position': 'center center',
                'background-repeat': 'no-repeat',
                'background-size': 'cover'
            });
        }
    });

    /*==============================
    Filter
    ==============================*/
    $('.filter__item-menu li').each(function () {
        $(this).attr('data-value', $(this).text().toLowerCase());
    });



    $('.filter__item-menu li').on('click', function () {
        var text = $(this).text();
        console.log('li Tıklandı:'+text);
        var city_id = $('.city_id').val();
        var genre_id = $('.genre_id').val();
        var cinema_id = $('.cinema_id').val();

        var item = $(this);
        var id = item.closest('.filter__item').attr('id');
        console.log('id'+id)
        var city_id_raw = $(this).attr('id')
        var result_id = city_id_raw.split('-')[1];
        switch (city_id_raw.split('-')[0]) {
            case "city_id":
                city_id = result_id;
                $('.city_id').val(result_id);
                break;
            case "genre_id":
                genre_id = result_id;

                $('.genre_id').val(result_id);
                break;
            case "cinema_id":
                cinema_id = result_id;
                $('.cinema_id').val(result_id);
                break;
            case "detail_city_id":
                var url='/'+window.location.pathname.split('/')[1]+'/city='+result_id;
                   location.href = url;
                break;
            case "detail_cinema_id":
                var url='/'+window.location.pathname.split('/')[1]+'/'+window.location.pathname.split('/')[2]+'/cinema='+result_id;
                location.href = url;
                break;
        }


        $('#' + id).find('.filter__item-btn input').val(text);

        $.ajax({
            type: "GET",
            url: "/api/films/city=" + city_id + "&genre=" + genre_id + "&cinema=" + cinema_id,
            // data: {
            //     'address_id': address_id,
            //     'payment_method': payment_method,
            //     'user_type': user_type
            // },
            success: function (data) {
                var string1 = JSON.stringify(data);
                var html_result = '';
                var json = JSON.parse(string1);

                json.forEach(function (element, index) {
                    html_result += '<div class="col-6 col-sm-4 col-lg-3 col-xl-2">\n' +
                        '                    <div class="card">\n' +
                        '                        <div class="card__cover">\n' +
                        '                            <img src="/images/';
                    html_result += json[index]['film_file'];
                    html_result += '" alt="';
                    html_result += json[index]['film_name'];
                    html_result += '">\n' +
                        '                            <a href="/'

                    html_result += json[index]['film_slug'];
                    html_result += '" class="card__play">\n' +
                        '                                <i class="icon ion-ios-play"></i>\n' +
                        '                            </a>\n' +
                        '                        </div>\n' +
                        '                        <div class="card__content">\n' +
                        '                            <h3 class="card__title"><a href="/';
                    html_result += json[index]['film_slug'];
                    html_result += '">';

                    html_result += json[index]['film_name'];
                    html_result += '</a></h3>\n' +
                        '                            <span class="card__category">\n' +
                        '\t\t\t\t\t\t\t\t<a href="#">'
                    html_result += json[index]['genre_name'];
                    html_result += '</a>\n' +
                        '\t\t\t\t\t\t\t</span>\n' +
                        '                            <span class="card__rate"><i class="icon ion-ios-star"></i>';
                    html_result += json[index]['film_rate'];
                    html_result += '</span>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>'


                });

                $('#film_area').html(html_result);
                // $.each()
                // foreach(data)
                // // var json = JSON.parse(data)
                // console.log(data);

                // if (json['ok']) {
                //
                // }
            }
        });


    });
    // $('#filter__city_ul li').on('click', function () {
    //
    //     console.log('li Tıklandı');
    //
    // });
    /*==============================
    Scroll bar
    ==============================*/
    $('.scrollbar-dropdown').mCustomScrollbar({
        axis: "y",
        scrollbarPosition: "outside",
        theme: "custom-bar"
    });

    $('.accordion').mCustomScrollbar({
        axis: "y",
        scrollbarPosition: "outside",
        theme: "custom-bar2"
    });

    /*==============================
    Morelines
    ==============================*/
    $('.card__description--details').moreLines({
        linecount: 6,
        baseclass: 'b-description',
        basejsclass: 'js-description',
        classspecific: '_readmore',
        buttontxtmore: "",
        buttontxtless: "",
        animationspeed: 400
    });

    /*==============================
    Gallery
    ==============================*/
    var initPhotoSwipeFromDOM = function (gallerySelector) {
        // parse slide data (url, title, size ...) from DOM elements
        // (children of gallerySelector)
        var parseThumbnailElements = function (el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for (var i = 0; i < numNodes; i++) {

                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes
                if (figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };

                if (figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if (linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function (e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function (el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if (!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }

            if (index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function () {
            var hash = window.location.hash.substring(1),
                params = {};

            if (hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if (!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if (pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if (params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function (index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                }

            };

            // PhotoSwipe opened from URL
            if (fromURL) {
                if (options.galleryPIDs) {
                    // parse real index when custom PIDs are used
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for (var j = 0; j < items.length; j++) {
                        if (items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll(gallerySelector);

        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if (hashData.pid && hashData.gid) {
            openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
        }
    };
    // execute above function
    initPhotoSwipeFromDOM('.gallery');

    /*==============================
    Player
    ==============================*/
    function initializePlayer() {
        if ($('#player').length) {
            const player = new Plyr('#player');
        } else {
            return false;
        }
        return false;
    }

    $(window).on('load', initializePlayer());

    /*==============================
    Range sliders
    ==============================*/

    /*1*/
    function initializeFirstSlider() {
        if ($('#filter__years').length) {
            var firstSlider = document.getElementById('filter__years');
            noUiSlider.create(firstSlider, {
                range: {
                    'min': 2000,
                    'max': 2018
                },
                step: 1,
                connect: true,
                start: [2005, 2015],
                format: wNumb({
                    decimals: 0,
                })
            });
            var firstValues = [
                document.getElementById('filter__years-start'),
                document.getElementById('filter__years-end')
            ];
            firstSlider.noUiSlider.on('update', function (values, handle) {
                firstValues[handle].innerHTML = values[handle];
            });
        } else {
            return false;
        }
        return false;
    }

    $(window).on('load', initializeFirstSlider());

    /*2*/
    function initializeSecondSlider() {
        if ($('#filter__imbd').length) {
            var secondSlider = document.getElementById('filter__imbd');
            noUiSlider.create(secondSlider, {
                range: {
                    'min': 0,
                    'max': 10
                },
                step: 0.1,
                connect: true,
                start: [2.5, 8.6],
                format: wNumb({
                    decimals: 1,
                })
            });

            var secondValues = [
                document.getElementById('filter__imbd-start'),
                document.getElementById('filter__imbd-end')
            ];

            secondSlider.noUiSlider.on('update', function (values, handle) {
                secondValues[handle].innerHTML = values[handle];
            });

            $('.filter__item-menu--range').on('click.bs.dropdown', function (e) {
                e.stopPropagation();
                e.preventDefault();
            });
        } else {
            return false;
        }
        return false;
    }

    $(window).on('load', initializeSecondSlider());

    /*3*/
    function initializeThirdSlider() {
        if ($('#slider__rating').length) {
            var thirdSlider = document.getElementById('slider__rating');
            noUiSlider.create(thirdSlider, {
                range: {
                    'min': 0,
                    'max': 10
                },
                connect: [true, false],
                step: 0.1,
                start: 8.6,
                format: wNumb({
                    decimals: 1,
                })
            });

            var thirdValue = document.getElementById('form__slider-value');

            thirdSlider.noUiSlider.on('update', function (values, handle) {
                thirdValue.innerHTML = values[handle];
            });
        } else {
            return false;
        }
        return false;
    }

    $(window).on('load', initializeThirdSlider());
});
