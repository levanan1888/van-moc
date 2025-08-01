$(document).ready(function () {
    if ($('#modalContact').length > 0) {
        $(document).on('show.bs.modal', '#modalContact', function(e){
            var randomFraction = Math.random();
            var randomNumber = Math.floor(randomFraction * 100000);
            var randomString = randomNumber.toString().padStart(6, 'a');
            $(this).find('.text-error').text("");
            $(this).find('input[name=rand_cls]').val(randomString);
            $(this).find('.contact-form-quote').attr('id', 'id-' + randomString);
        });
    }

    if ($(".lazy-load-background").length > 0) {
        const lazyLoadElements = document.querySelectorAll(".lazy-load-background");
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const imageUrl = element.getAttribute("data-bg-src");
                    element.style.backgroundImage = `url(${imageUrl})`;
                    observer.unobserve(element);
                }
            });
        });

        lazyLoadElements.forEach((element) => {
            observer.observe(element);
        });
    }

    var showError = function (message) {
        $('.contact-error-message').html(message).show();
    }

    var showSuccess = function (message) {
        $('.contact-success-message').html(message).show();
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

    $(document).on('click', '.contact-button', function (event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).addClass('button-loading');
        $('.contact-success-message').html('').hide();
        $('.contact-error-message').html('').hide();
        var rand_cls = $(this).closest('form').find('input[name=rand_cls]').val();
        var formId = '#id-' + rand_cls;

        $.ajax({
            type: 'POST',
            cache: false,
            url: $(this).closest('form').prop('action'),
            data: new FormData($(this).closest('form')[0]),
            contentType: false,
            processData: false,
            success: res => {
                $(formId).find('.text-error').text(" ");
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
                $(formId).find('.text-error').text(" ");
                let errors = res?.responseJSON?.errors;
                if (typeof(errors) != "undefined") {
                    if (Object.keys(errors).length > 0) {
                        for (var key in errors) {
                            $(formId).find('.' + key + '-error').text(errors[key][0]);
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
