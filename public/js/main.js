/*
-----------------------------
Main Javascript 
-----------------------------
*/

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(function () {
    $('[data-toggle="popover"]').popover()
});

;(function ($) {
    'use strict';
    $('.alert[data-auto-dismiss]').each(function (index, element) {
        var $element = $(element),
            timeout  = $element.data('auto-dismiss') || 5000;

        setTimeout(function () {
            $element.alert('close');
        }, timeout);
    });
})(jQuery);

$(document).ready(function () {
    // Active disable with tool
    $('*[data-disable-with]').each(function () {
        // Prepare control and get basic values.
        var submitButton = $(this);
        var isButton = submitButton.is('button');
        var value = submitButton.attr('data-disable-with');
        var prevalue = '';
        if (isButton) {
            prevalue = submitButton.html();
        } else {
            prevalue = submitButton.val();
        }

        // Form of the control
        var firstForm = submitButton.parents().filter("form").first();

        // Handle form on submit to disable the control.
        firstForm.on('submit', function () {
            submitButton.attr('disabled', 'disabled');
            if (isButton) {
                submitButton.html(value);
            } else {
                submitButton.val(value);
            }
        });

        // Handle jquery validation invalid event.
        firstForm.bind('invalid-form.validate', function () {
            setTimeout(function () {
                submitButton.removeAttr('disabled');
                if (isButton) {
                    submitButton.html(prevalue);
                } else {
                    submitButton.val(prevalue);
                }
            }, 1);
        });
    });
});