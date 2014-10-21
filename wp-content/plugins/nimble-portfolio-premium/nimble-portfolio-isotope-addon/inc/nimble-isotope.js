jQuery(document).ready(function($) {


    if (typeof NimbleIsotope == 'undefined')
        NimbleIsotope = '{}';
    if (typeof NimbleIsotope == "string")
        eval("NimbleIsotope=" + NimbleIsotope);

    $.prettyLoader({offset_top: 20, loader: NimbleIsotope.url + '/inc/img/loading.gif'});

    NimbleIsotope.itemSelector = '.-item';
    NimbleIsotope.hiddenClass = 'isotope-hidden';

    $('.nimble-portfolio').each(function() {

        var nimble_portfolio = $(this);
        var default_filter = $(".isotope_default_filter", nimble_portfolio).val();
        var multisel_on = $(".isotope_multi_filters", nimble_portfolio).val();
        var ajax_filter = $(".isotope_ajax_filter", nimble_portfolio).val();
        var ajax_paginate = $(".isotope_ajax_paginate", nimble_portfolio).val();
        var atts = $(".isotope_addon_atts", nimble_portfolio).val();
        var grid = $(".-items", nimble_portfolio);
        var filtersMain = $(".-filters", nimble_portfolio);

        grid.isotope(NimbleIsotope, $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find("a[rel^='nimblebox']")}));

        if (default_filter) {
            grid.isotope({filter: "." + default_filter}, function() {
                $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find(" .-item:not(.isotope-hidden) a[rel^='nimblebox']")});
            });
            filtersMain.find('.active').removeClass('active');
            $('.-filter[rel="' + default_filter + '"]', filtersMain).addClass('active');
        }

        if (ajax_filter || ajax_paginate) {
            $('body').append('<div id="nimble_portfolio_temp"></div>');
            var nimble_portfolio_temp = $('#nimble_portfolio_temp');
            nimble_portfolio_temp.hide();
        }

        nimble_portfolio.on('click', '.-filter', function(e) {

            e.preventDefault();

            var filter = $(this);

            if (!multisel_on && filter.hasClass('active')) {
                return;
            }

            var value = filter.attr('rel');
            var activeFilters = filtersMain.find('.active');

            if (ajax_filter) {

                var _filters = [];
                if (value && value !== "*") {
                    if (multisel_on == 1) {

                        var _flag = true;
                        activeFilters.each(function() {
                            if ($(this).attr("rel") && $(this).attr("rel") != "*") {
                                if (filter.data('id') == $(this).data('id')) {
                                    _flag = false;
                                } else {
                                    _filters.push($(this).data('id'));
                                }
                            }
                        });

                        if (_flag) {
                            _filters.push(filter.data('id'));
                        }

                    } else {
                        _filters.push(filter.data('id'));
                    }
                }

                nimble_portfolio.append('<div class="loading-overlay"> </div>');

                $.prettyLoader.show();

                $.post(NimbleIsotope.ajaxurl,
                        {
                            'action': 'isotope_doajax',
                            'filters': (_filters.length > 0 ? _filters : 0),
                            'paged': 1,
                            'atts': atts
                        },
                function(response) {
                    grid.isotope('destroy');
                    nimble_portfolio_temp.html(response);
                    nimble_portfolio.html($('.nimble-portfolio', nimble_portfolio_temp).html());
                    atts = $(".isotope_addon_atts", nimble_portfolio).val();
                    grid = $(".-items", nimble_portfolio);
                    filtersMain = $(".-filters", nimble_portfolio);
                    if (_filters.length) {
                        filtersMain.find('.active').removeClass('active');
                        for (var i = 0; i < _filters.length; i++) {
                            $('.-filter[data-id="' + _filters[i] + '"]', filtersMain).addClass('active');
                        }
                    }
                    grid.isotope(NimbleIsotope, $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find("a[rel^='nimblebox']")}));
                    $.prettyLoader.hide();
                });
            } else {

                activeFilters.removeClass('active');

                var _filters = [];
                var filters = '';
                if (value && value !== "*") {
                    if (multisel_on == 1) {
                        var _flag = true;

                        activeFilters.each(function() {
                            if ($(this).attr("rel") !== "*") {
                                if (value == $(this).attr('rel')) {
                                    _flag = false;
                                } else {
                                    $(this).addClass("active");
                                    _filters.push($(this).attr("rel"));
                                }
                            }
                        });

                        if (_flag) {
                            filter.addClass('active');
                            _filters.push(value);
                        }

                    } else {
                        _filters.push(value);
                        filter.addClass('active');
                    }
                }


                if (_filters.length > 0) {
                    filters = "." + _filters.join(',.');
                } else {
                    $('.-filter[rel="*"], .-filter[rel=""]', filtersMain).addClass('active');
                }

                grid.isotope({filter: filters}, function() {
                    $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find(" .-item:not(.isotope-hidden) a[rel^='nimblebox']")});
                });
            }
        });



        if (ajax_paginate) {
            nimble_portfolio.on('click', '.-page-link', function(e) {
                e.preventDefault();
                var page = $(this);

                var pagenum = page.attr('rel');

                if (!pagenum) {
                    return;
                }

                var activeFilters = filtersMain.find('.active');
                var _filters = [];
                activeFilters.each(function() {
                    if ($(this).attr("rel") && $(this).attr("rel") != "*") {
                        _filters.push($(this).data('id'));
                    }
                });

                nimble_portfolio.append('<div class="loading-overlay"> </div>');

                $.prettyLoader.show();

                $.post(NimbleIsotope.ajaxurl,
                        {
                            'action': 'isotope_doajax',
                            'paged': pagenum,
                            'filters': (ajax_filter && _filters.length > 0 ? _filters : 0),
                            'atts': atts
                        },
                function(response) {
                    grid.isotope('destroy');
                    nimble_portfolio_temp.html(response);
                    nimble_portfolio.html($('.nimble-portfolio', nimble_portfolio_temp).html());
                    atts = $(".isotope_addon_atts", nimble_portfolio).val();
                    grid = $(".-items", nimble_portfolio);
                    filtersMain = $(".-filters", nimble_portfolio);
                    var _filtersTmp = [];
                    if (_filters.length) {
                        filtersMain.find('.active').removeClass('active');
                        for (var i = 0; i < _filters.length; i++) {
                            var _filter = $('.-filter[data-id="' + _filters[i] + '"]', filtersMain);
                            _filter.addClass('active');
                            _filtersTmp.push(_filter.attr('rel'));
                        }
                    }

                    if (!ajax_filter && _filtersTmp.length > 0) {
                        grid.isotope(NimbleIsotope);
                        grid.isotope({filter: "." + _filtersTmp.join(',.')}, function() {
                            $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find(" .-item:not(.isotope-hidden) a[rel^='nimblebox']")});
                        });

                    } else {
                        grid.isotope(NimbleIsotope, $('.nimble-portfolio').trigger("nimble_portfolio_lightbox", {items: nimble_portfolio.find("a[rel^='nimblebox']")}));

                    }
                    $.prettyLoader.hide();
                });
            });
        }

        $(window).smartresize(function() {
            grid.isotope('reLayout');
        });
    });
});