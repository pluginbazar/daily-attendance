(function ($, window, document) {
    "use strict";

    let dailyattendance_load_users_table = () => {
        $.ajax({
            type: "post",
            url: ajaxurl,
            data: {
                'action': 'load_users_table'
            },
            success: function (response) {
                if (response.success) {
                    $('.dailyattendance-users-wrap').html(response.data);

                    new DataTable('#dailyattendance-users', {
                        "scrollY": 360,
                        "ordering": false,
                        "language": {
                            "lengthMenu": "Displaying _MENU_ Users",
                            "search": "Search Users  "
                        }
                    });
                } else {
                    console.log(response);
                }
            }
        });
    };

    $(document).on('click', '.dailyattendance-sidebar ul > li', function () {
        let users_table, el_dailyattendance_container = $('.dailyattendance-container'),
            this_nav_item_wrap = $(this),
            this_nav_item = this_nav_item_wrap.find('> div'),
            target_content = this_nav_item.data('target'),
            content_wrap = $('.dailyattendance-content-wrap'),
            el_target_content = content_wrap.find('.dailyattendance-content.content-' + target_content);

        if (!el_target_content.hasClass('hidden')) {
            return;
        }

        this_nav_item_wrap.parent().find('> li > div').removeClass('active');
        this_nav_item.addClass('active');

        content_wrap.find('.dailyattendance-content').addClass('hidden');
        el_target_content.removeClass('hidden');

        if ('users' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            dailyattendance_load_users_table();
            el_dailyattendance_container.addClass('table-rendered');
        }
    });

    $('#modal-add-users form.modal-form').on('submit', function (e) {
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'create_user',
                'form_data': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_users_table();
                    $('#modal-add-users').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });



    $(document).on('click', '#btn-open-modal', function () {
        $('#' + $(this).data('target')).removeClass('hidden');
    });

    $(document).on('click', '#btn-close-modal', function () {
        $('#' + $(this).data('target')).addClass('hidden');
    });
})(jQuery, window, document);







