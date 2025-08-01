/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************************************!*\
  !*** ./platform/plugins/contact/resources/assets/js/contact-public.js ***!
  \************************************************************************/
$(document).ready(function () {
  if ($('#modalContact').length > 0) {
    $(document).on('show.bs.modal', '#modalContact', function (e) {
      var randomFraction = Math.random();
      var randomNumber = Math.floor(randomFraction * 100000);
      var randomString = randomNumber.toString().padStart(6, 'a');
      $(this).find('.text-error').text("");
      $(this).find('input[name=rand_cls]').val(randomString);
      $(this).find('.contact-form-quote').attr('id', 'id-' + randomString);
    });
  }
  if ($(".lazy-load-background").length > 0) {
    var lazyLoadElements = document.querySelectorAll(".lazy-load-background");
    var observer = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var element = entry.target;
          var imageUrl = element.getAttribute("data-bg-src");
          element.style.backgroundImage = "url(".concat(imageUrl, ")");
          observer.unobserve(element);
        }
      });
    });
    lazyLoadElements.forEach(function (element) {
      observer.observe(element);
    });
  }
  var showError = function showError(message) {
    $('.contact-error-message').html(message).show();
  };
  var showSuccess = function showSuccess(message) {
    $('.contact-success-message').html(message).show();
  };
  var handleError = function handleError(data) {
    if (typeof data.errors !== 'undefined' && data.errors.length) {
      handleValidationError(data.errors);
    } else {
      if (typeof data.responseJSON !== 'undefined') {
        if (typeof data.responseJSON.errors !== 'undefined') {
          if (data.status === 422) {
            handleValidationError(data.responseJSON.errors);
          }
        } else if (typeof data.responseJSON.message !== 'undefined') {
          showError(data.responseJSON.message);
        } else {
          $.each(data.responseJSON, function (index, el) {
            $.each(el, function (key, item) {
              showError(item);
            });
          });
        }
      } else {
        showError(data.statusText);
      }
    }
  };
  var handleValidationError = function handleValidationError(errors) {
    var message = '';
    $.each(errors, function (index, item) {
      if (message !== '') {
        message += '<br />';
      }
      message += item;
    });
    showError(message);
  };
  $(document).on('click', '.contact-button', function (event) {
    var _this = this;
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
      success: function success(res) {
        $(formId).find('.text-error').text(" ");
        if (!res.error) {
          $(_this).closest('form').find('input[type=text]').val('');
          $(_this).closest('form').find('input[type=email]').val('');
          $(_this).closest('form').find('input[type=file]').val('');
          $(_this).closest('form').find('textarea').val('');
          showSuccess(res.message);
        } else {
          showError(res.message);
        }
        $(_this).removeClass('button-loading');
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
      },
      error: function error(res) {
        var _res$responseJSON;
        $(formId).find('.text-error').text(" ");
        var errors = res === null || res === void 0 || (_res$responseJSON = res.responseJSON) === null || _res$responseJSON === void 0 ? void 0 : _res$responseJSON.errors;
        if (typeof errors != "undefined") {
          if (Object.keys(errors).length > 0) {
            for (var key in errors) {
              $(formId).find('.' + key + '-error').text(errors[key][0]);
            }
          }
        }
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        $(_this).removeClass('button-loading');
        /*handleError(res);*/
      }
    });
  });
});
/******/ })()
;