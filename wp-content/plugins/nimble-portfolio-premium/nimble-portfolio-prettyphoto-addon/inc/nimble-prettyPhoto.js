(function($) {

    if (typeof NimblePrettyPhoto == 'undefined')
        NimblePrettyPhoto = '{}';
    if (typeof NimblePrettyPhoto == "string")
        eval("NimblePrettyPhoto=" + NimblePrettyPhoto);

    NimblePrettyPhoto.social_tools = false;

    NimblePrettyPhoto.changepicturecallback = function() {

        if (typeof NimblePrettyPhoto.AddThis !== 'undefined' && typeof addthis !== 'undefined' ) {

            var _size = 'default';
            if (typeof NimblePrettyPhoto.AddThis.size !== 'undefined' && NimblePrettyPhoto.AddThis.size) {
                _size = NimblePrettyPhoto.AddThis.size + "x" + NimblePrettyPhoto.AddThis.size;
            }

            $pp_pic_holder.find("#nimble_portfolio_social").remove();
            $pp_pic_holder.find('.pp_fade').append('<div id="nimble_portfolio_social" class="addthis_toolbox addthis_' + _size + '_style"></div>');

            for (var i in NimblePrettyPhoto.AddThis.services) {
                $('#nimble_portfolio_social').append('<a class="addthis_button_' + NimblePrettyPhoto.AddThis.services[i] + '"></a>')
            }

            addthis.toolbox("#nimble_portfolio_social", {}, {url: pp_images[set_position], title: pp_titles[set_position] + " — " + pp_descriptions[set_position]});
        }
    };

    $(document).on('nimble_portfolio_lightbox', function(event, obj) {
        obj.items.prettyPhoto(NimblePrettyPhoto);
    });

})(jQuery);