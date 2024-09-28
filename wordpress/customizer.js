(function ($) {
    wp.customize('selected_color_theme', function (value) {
        value.bind(function (newVal) {
            $('body').removeClass('theme-default theme-black_white theme-white_black').addClass('theme-' + newVal);
        });
    });
})(jQuery);
