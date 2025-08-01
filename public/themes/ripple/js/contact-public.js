$(document).ready(function () {
    var showError = function (message) {
        $('.contact-error-message').html(message).show();
    }

    var showSuccess = function (message) {
        $('.contact-success-message').html(message).show();
    }

    var closeModel = function (id) {
        $(id).modal("hide");
    }

    var loadModal = function(url) {
        $.ajax(url, {
            method: "GET",
            success: function (res) {
                console.log(res);
                $("#modalContact .modal-bodys").html(res.html);
                $("#modalContact").modal("show");
            },
        }).always(function () {

        });
        return false
    }

    var handleError = function (data) {
        if (typeof (data.errors) !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors);
        } else {
            if (typeof (data.responseJSON) !== 'undefined') {
                if (typeof (data.responseJSON.errors) !== 'undefined') {
                    if (data.status === 422) {
                        handleValidationError(data.responseJSON.errors);
                    }
                } else if (typeof (data.responseJSON.message) !== 'undefined') {
                    showError(data.responseJSON.message);
                } else {
                    $.each(data.responseJSON, (index, el) => {
                        $.each(el, (key, item) => {
                            showError(item);
                        });
                    });
                }
            } else {
                showError(data.statusText);
            }
        }
    }

    var handleValidationError = function (errors) {
        let message = '';
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />';
            }
            message += item;
        });
        showError(message);
    }

    $('.load-modal-form').click(function () {
        loadModal('/contact/modal');
    });

    $(document).on('click', '.contact-form button[type=submit]', function (event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).addClass('button-loading');
        $('.contact-success-message').html('').hide();
        $('.contact-error-message').html('').hide();

        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).closest('form').prop('action'),
            data: new FormData($(this).closest('form')[0]),
            contentType: false,
            processData: false,
            success: res => {
                $('.text-error').text(" ");
                if (!res.error) {
                    $(this).closest('form').find('input[type=text]').val('');
                    $(this).closest('form').find('input[type=email]').val('');
                    $(this).closest('form').find('input[type=file]').val('');
                    $(this).closest('form').find('textarea').val('');
                    showSuccess(res.message);
                } else {
                    showError(res.message);
                }

                $(this).removeClass('button-loading');

                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha();
                }
            },
            error: res => {
                console.log(res);
                $('.text-error').text(" ");
                let errors = res?.responseJSON?.errors;
                if (typeof(errors) != "undefined") {
                    if (Object.keys(errors).length > 0) {
                        for (var key in errors) {
                            $('.' + key + '-error').text(errors[key][0]);
                        }
                    }
                }
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha();
                }
                $(this).removeClass('button-loading');
                /*handleError(res);*/
            }
        });
    });
});
