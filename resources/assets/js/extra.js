/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 13.08.16.
 */
jQuery(document).ready(() => {
    jQuery('.like-button').on('click', (event) => {
        event.preventDefault();
        let link = jQuery(event.target);
        if (!link.prop('disabled')) {
            link.prop('disabled', true);
            jQuery.ajax({
                method: 'POST',
                url: link.attr('href'),
                data: {id: link.data('key'), _token: Laravel.csrfToken}
            }).done((data) => {
                link.html(data);
                link.prop('disabled', false);
            });
        }
    });
    let date = new Date();
    let offset = date.getTimezoneOffset();
    jQuery.ajax({
        method: 'POST',
        url: '/update-browser-timezone-offset',
        data: {timezone_offset: offset, _token: Laravel.csrfToken}
    }).done((data) => {

    });
});