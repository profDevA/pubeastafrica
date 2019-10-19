(function ($) {
    $(document).ready(function () {
        $('.ppview .handlediv').click(function () {
            $(this).parent().toggleClass("closed").addClass('postbox');
        });
    });
})(jQuery);