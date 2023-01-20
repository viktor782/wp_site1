jQuery(document).ready(function () {

    $ = jQuery;


    // Cache selectors
    var lastId,
        topMenu = $("#top-menu"),
        topMenuHeight = topMenu.outerHeight() + 15,
    // All list items
        menuItems = topMenu.find("a"),
    // Anchors corresponding to menu items
        scrollItems = menuItems.map(function () {
            var item = $($(this).attr("href"));
            if (item.length) {
                return item;
            }
        });

// Bind click handler to menu items
// so we can get a fancy scroll animation
    menuItems.click(function (e) {
        var href = $(this).attr("href"),
            offsetTop = href === "#" ? 0 : $(href).offset().top - topMenuHeight + 1;
        $('html, body').stop().animate({
            scrollTop: offsetTop
        }, 300);
        e.preventDefault();
    });

// Bind to scroll
    $(window).scroll(function () {
        // Get container scroll position
        var fromTop = $(this).scrollTop() + topMenuHeight;

        // Get id of current scroll item
        var cur = scrollItems.map(function () {
            if ($(this).offset().top < fromTop)
                return this;
        });
        // Get the id of the current element
        cur = cur[cur.length - 1];
        var id = cur && cur.length ? cur[0].id : "";

        if (lastId !== id) {
            lastId = id;
            // Set/remove active class
            menuItems
                .parent().removeClass("active")
                .end().filter("[href='#" + id + "']").parent().addClass("active");
        }
    });


    jQuery('#top-menu span').on('click', function (e) {
        e.preventDefault();
        var activeLink = parseInt(jQuery(this).closest('#top-menu').find('.active').data('num'));
        var prevlink = activeLink - 1;
        var nextlink = activeLink + 1;

        if (activeLink == 0) {
            prevlink = 3;
        }
        if (activeLink == 3) {
            nextlink = 0;
        }

        if ((activeLink >= 0) && (activeLink <= 4)) {
            if (jQuery(this).hasClass('up')) {
                jQuery('[data-num ="' + prevlink + '" ]').find('a').trigger('click');
            }
            if (jQuery(this).hasClass('down')) {
                jQuery('[data-num ="' + nextlink + '" ]').find('a').trigger('click');
            }
        }
    });

    //end-scroll-menu

    jQuery('.menu-toggle').on('click', function (e) {
        e.preventDefault();
        jQuery(this).toggleClass('active');
        jQuery('.menu_mother').toggle();
    });


    jQuery('.fltr').on('click', function () {
        jQuery('.for_filter').addClass('active');
        jQuery('#overflow').fadeIn(300);
    });

    jQuery('.for_filter .for_exit').on('click', function () {
        jQuery('.for_filter').removeClass('active');
    });

    if (jQuery(window).width() < 992) {
        jQuery('.menu_mother').html(jQuery('.navbar-collapse.collapse').html());
        jQuery('.menu_mother #menu-main').after(jQuery('.other__menu .navbar-collapse.collapse').html());

        jQuery('.menu-item-has-children a').after('<div class="t_sub"></div>');

        jQuery('.menu-item-has-children').on('click', '.t_sub', function () {
            jQuery(this).parent().find('.sub-menu').toggle();
        });
    }

    jQuery('#site-header-cart').on('click', function () {
        jQuery('.woocommerce > .dropdown-menu.dropdown-menu-mini-cart').addClass('active');
        jQuery('#overflow').fadeIn(300);
    });

    jQuery('.go__cat__menu').on('click', function () {
        jQuery('.mob__cat__menu').addClass('active');
        jQuery('#overflow').fadeIn(300);
    });

    jQuery('.for_exit').on('click', function () {
        jQuery(this).closest('.mob__cat__menu').removeClass('active');
    });


    jQuery('.ced ul').addClass('owl-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 4
            },
            1000: {
                items: 5
            }
        }
    });
    function del_filter() {
        var list_html = '';
        jQuery('.for_filter li.chosen').each(function (index, el) {
            list_html = list_html + jQuery(el).html();
        });
        jQuery('.abort_filter .title').after(list_html);
    }

    del_filter();


    jQuery('h3.widget-title').on('click', function (e) {
        e.preventDefault();
        jQuery(this).toggleClass('plus');
        jQuery(this).parent().find('.woocommerce-widget-layered-nav-list').toggleClass('hide');
    });

    jQuery('body').on('click', 'a.for_exit', function (e) {
        e.preventDefault();
        jQuery('.dropdown-menu-mini-cart').removeClass('active');
        jQuery('#overflow').fadeOut(300);
    });


    $('[data-fancybox]').fancybox({
        youtube: {
            controls: 1,
            showinfo: 0,
            color: '00ffff'
        },
        vimeo: {
            color: 'f00'
        }
    });

    var manufacturer = $('.manufacturers .owl-carousel');
    manufacturer.owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 5,
                dots: true,
            },
            1000: {
                items: 7,
                dots: true,
            }
        }
    });

    $('#manufacurer_nav .next').click(function () {
        manufacturer.trigger('next.owl.carousel');
    });
    $('#manufacurer_nav .prev').click(function () {
        manufacturer.trigger('prev.owl.carousel', [300]);
    });


    var one_slider = $('.one_slider .owl-carousel');
    one_slider.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        items: 1,
    });

    $('#one_slider .next').click(function () {
        one_slider.trigger('next.owl.carousel');
    });
    $('#one_slider .prev').click(function () {
        one_slider.trigger('prev.owl.carousel', [300]);
    });

    $("[type=tel]").mask("38 (099) 999 99 99");

    jQuery('.to_pop').on('click', function (e) {
        e.preventDefault();
        jQuery('.popup_1').fadeIn(300);
        jQuery('.popup_flow').fadeIn(300);
    });

    jQuery('.popup_flow').on('click', function (e) {
        e.preventDefault();
        jQuery('.popup_1').fadeOut(300);
        jQuery('.popup_flow').fadeOut(300);
    });

    jQuery('.popup_1 .exit').on('click', function (e) {
        e.preventDefault();
        jQuery('.popup_1').fadeOut(300);
        jQuery('.popup_flow').fadeOut(300);
    });

    if (jQuery('body').hasClass('single-product')) {
        jQuery('.customed_tabs ul').html(jQuery('.tabs.wc-tabs').html());
        jQuery('.customed_tabs ul a').on('click', function (e) {
            e.preventDefault();
            var sel_a = jQuery(this).attr('href');
            jQuery('.tabs.wc-tabs a[href=' + sel_a + ']').trigger('click');
            jQuery('body').animate({scrollTop: jQuery('.woocommerce-tabs.wc-tabs-wrapper').offset().top }, 500);
        });
    }

    jQuery('#to__upsell').on('click', function (e) {
        e.preventDefault();
        $('body').animate({
            scrollTop: jQuery('.up-sells.upsells.products').offset().top
        }, 500);
    });

    jQuery('#get__call').on('click', function (e) {
        e.preventDefault();

    });

    jQuery('.for__slider .owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,

    });


    jcf.replaceAll();
});

