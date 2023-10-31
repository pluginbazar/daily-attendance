(function ($, window, document) {
    "use strict";


    $(document).on('click', '.dailyattendance-sidebar ul > li', function () {
        let users_table, el_dailyattendance_container = $('.dailyattendance-container'),
            this_nav_item_wrap = $(this),
            this_nav_item = this_nav_item_wrap.find('> div'),
            target_content = this_nav_item.data('target'),
            content_wrap = $('.dailyattendance-content-wrap'),
            el_target_content = content_wrap.find('.dailyattendance-content.content-' + target_content);

        console.log(el_target_content);

        if (!el_target_content.hasClass('hidden')) {
            return;
        }

        console.log(target_content);

        this_nav_item_wrap.parent().find('> li > div').removeClass('active');
        this_nav_item.addClass('active');

        content_wrap.find('.dailyattendance-content').addClass('hidden');
        el_target_content.removeClass('hidden');

        if ('users' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            users_table = new DataTable('#dailyattendance-users', {
                "scrollY": 360,
                "ordering": false,
                "language": {
                    "lengthMenu": "Displaying _MENU_ Users",
                    "search": "Search Users  "
                }
            });
            el_dailyattendance_container.addClass('table-rendered');
        }
    });

    $(document).on('click', '#popup-btn', function () {
        $('.add-user').removeClass('hidden');
    });

    $(document).on('click', '.close-popup', function () {
        $('.add-user').addClass('hidden');
    });


})(jQuery, window, document);







