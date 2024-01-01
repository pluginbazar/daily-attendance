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
                            "retrieve": true,
                            "paging": false,
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
        },

        dailyattendance_load_designations_table = () => {
            $.ajax({
                type: 'post',
                url: ajaxurl,
                data: {
                    'action': 'load_designations_table'
                },
                success: function (response) {
                    if (response.success) {
                        $('.dailyattendance-designations-wrap').html(response.data);

                        new DataTable('#dailyattendance-designations', {
                            "scrollY": 360,
                            "retrieve": true,
                            "paging": false,
                            "ordering": false,
                            "searching": false,
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
        },

        dailyattendance_load_leave_request_table = () => {
            $.ajax({
                type: 'post',
                url: ajaxurl,
                data: {
                    'action': 'load_leave_request_table'
                },
                success: function (response) {
                    if (response.success) {
                        $('.dailyattendance-leave-request-wrap').html(response.data);

                        new DataTable('#dailyattendance-leave-request', {
                            "scrollY": 360,
                            "retrieve": true,
                            "paging": false,
                            "ordering": false,
                            "searching": false,
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
        },

        dailyattendance_load_holidays_table = () => {
            $.ajax({
                type: 'post',
                url: ajaxurl,
                data: {
                    'action': 'load_holidays_table'
                },
                success: function (response) {
                    if (response.success) {
                        $('.dailyattendance-holidays-wrap').html(response.data);

                        new DataTable('#dailyattendance-holidays', {
                            "scrollY": 360,
                            "retrieve": true,
                            "paging": false,
                            "ordering": false,
                            "searching": false,
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

        el_dailyattendance_container.removeClass('table-rendered');
        this_nav_item_wrap.parent().find('> li > div').removeClass('active');
        this_nav_item.addClass('active');

        content_wrap.find('.dailyattendance-content').addClass('hidden');
        el_target_content.removeClass('hidden');

        if ('users' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            dailyattendance_load_users_table();
            el_dailyattendance_container.addClass('table-rendered');
        }

        console.log(target_content);

        if ('designations' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            dailyattendance_load_designations_table();
            el_dailyattendance_container.addClass('table-rendered');
        }

        if ('leave_request' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            dailyattendance_load_leave_request_table();
            el_dailyattendance_container.addClass('table-rendered');
        }

        if ('holidays' === target_content && !el_dailyattendance_container.hasClass('table-rendered')) {
            dailyattendance_load_holidays_table();
            el_dailyattendance_container.addClass('table-rendered');
        }
    });


    $('#modal-add-user form.modal-form').on('submit', function (e) {
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'create_user',
                'form_data': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_users_table();
                    $('#modal-add-user').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $(document).on('click', '#edit-user', function () {

        let editID = $(this).data('user-id');
        $('#modal-edit-user').removeClass('hidden');
        $('#modal-edit-user form.modal-form').attr('data-edit-id', editID);
    });


    $('#modal-edit-user form.modal-form').on('submit', function (e) {

        let editID = $(this).attr('data-edit-id');

        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'edit_user',
                'user_id': editID,
                'user_data': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_users_table();
                    $('#modal-edit-user').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $('#modal-add-designations form.modal-form').on('submit', function (e) {
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'add_designations',
                'designation': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_designations_table();
                    $('#modal-add-designations').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $(document).on('click', '#edit-designation', function () {
        let editID = $(this).data('edit-id');
        $('#modal-edit-designation').removeClass('hidden');
        $('#modal-edit-designation form.modal-form').attr('data-edit-id', editID);
    });


    $('#modal-edit-designation form.modal-form').on('submit', function (e) {

        let editID = $(this).attr('data-edit-id');

        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'edit_designation',
                'user_id': editID,
                'designation': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_designations_table();
                    $('#modal-edit-designation').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $(document).on('click', '#delete-designation', function () {

        let userID = $(this).data('delete-id');
        let confirmation = confirm("Are you sure you want to Delete!");

        if (confirmation === true) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'delete_designation',
                    'user_id': userID,
                },
                success: function (response) {
                    if (response.success) {
                        dailyattendance_load_designations_table();
                    }
                }
            });
        }
        return false;
    });


    $('#modal-add-leave-request form.modal-form').on('submit', function (e) {
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'leave_request',
                'form_data': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_leave_request_table();
                    $('#modal-add-leave-request').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $(document).on('click', '#approve-request', function () {

        let thisButton = $(this);
        let userID = thisButton.data('user-id'),
            confirmation = confirm("Are you sure want to approved!");

        if (confirmation === true) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'approve_request',
                    'user_id': userID,
                },
                success: function (response) {
                    if (response.success) {
                        thisButton.attributes('disabled', true);
                        dailyattendance_load_leave_request_table();
                    }
                }
            });
        }
        return false;
    });


    $(document).on('click', '#deny-request', function () {

        let userID = $(this).data('user-id');
        let confirmation = confirm("Are you sure you want to Deny!");

        if (confirmation === true) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'delete_request',
                    'user_id': userID,
                },
                success: function (response) {
                    if (response.success) {
                        dailyattendance_load_leave_request_table();
                    }
                }
            });
        }
        return false;
    });


    $('#modal-add-holidays form.modal-form').on('submit', function (e) {
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                'action': 'add_holidays',
                'form_data': $(this).serialize(),
            },
            success: function (response) {
                if (response.success) {
                    dailyattendance_load_holidays_table();
                    $('#modal-add-holidays').addClass('hidden');
                }
            }
        });
        e.preventDefault();
        return false;
    });


    $(document).on('click', '#delete-holiday', function () {

        let userID = $(this).data('user-id');
        let confirmation = confirm("Are you sure you want to Delete!");

        if (confirmation === true) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    'action': 'delete_holiday',
                    'user_id': userID,
                },
                success: function (response) {
                    if (response.success) {
                        dailyattendance_load_holidays_table();
                    }
                }
            });
        }
        return false;
    });


    $(document).on('click', '#btn-open-modal', function () {
        $('#' + $(this).data('target')).removeClass('hidden');
    });


    $(document).on('click', '#btn-close-modal', function () {
        $('#' + $(this).data('target')).addClass('hidden');
        $('#modal-add-designations').addClass('hidden');
        $('#modal-add-leave-request').addClass('hidden');
        $('#modal-add-holidays').addClass('hidden');
    });


    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });

})(jQuery, window, document);







