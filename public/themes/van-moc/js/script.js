/******/ (() => { // webpackBootstrap
/*!*****************************************************!*\
  !*** ./platform/themes/van-moc/assets/js/script.js ***!
  \*****************************************************/
document.addEventListener('DOMContentLoaded', function () {
  var menuToggle = document.querySelector('.menu-toggle');
  var mainNav = document.querySelector('.main-nav');
  if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', function () {
      mainNav.classList.toggle('active');
      menuToggle.classList.toggle('active');
    });
  }

  // Handle mobile menu sub-menu toggles
  var menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
  menuItemsWithChildren.forEach(function (menuItem) {
    var link = menuItem.querySelector('a');
    var toggleIcon = menuItem.querySelector('.toggle-icon');
    if (link && toggleIcon) {
      link.addEventListener('click', function (e) {
        // Only handle on mobile
        if (window.innerWidth <= 992) {
          e.preventDefault();
          menuItem.classList.toggle('active');

          // Rotate icon
          if (menuItem.classList.contains('active')) {
            toggleIcon.style.transform = 'rotate(90deg)';
          } else {
            toggleIcon.style.transform = 'rotate(0deg)';
          }
        }
      });
    }
  });

  // Close mobile menu when clicking outside
  document.addEventListener('click', function (e) {
    if (window.innerWidth <= 992) {
      if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
        mainNav.classList.remove('active');
      }
    }
  });

  // Handle window resize
  window.addEventListener('resize', function () {
    if (window.innerWidth > 992) {
      mainNav.classList.remove('active');
      menuToggle.classList.remove('active');
      menuItemsWithChildren.forEach(function (menuItem) {
        menuItem.classList.remove('active');
        var toggleIcon = menuItem.querySelector('.toggle-icon');
        if (toggleIcon) {
          toggleIcon.style.transform = 'rotate(0deg)';
        }
      });
    }
  });

  // Handle custom contact form submission
  var customContactForm = document.querySelector('.custom-contact-form');
  if (customContactForm) {
    customContactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var form = this;
      var submitBtn = form.querySelector('button[type="submit"]');
      var originalText = submitBtn.textContent;

      // Add loading state
      form.classList.add('loading');
      submitBtn.disabled = true;
      submitBtn.textContent = 'Đang gửi...';

      // Remove any existing alerts
      var existingAlerts = form.querySelectorAll('.alert');
      existingAlerts.forEach(function (alert) {
        return alert.remove();
      });
      var formData = new FormData(form);
      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        // Remove loading state
        form.classList.remove('loading');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;

        // Show success/error message
        var alertDiv = document.createElement('div');
        alertDiv.className = data.error ? 'alert alert-danger' : 'alert alert-success';
        alertDiv.textContent = data.message;
        form.insertBefore(alertDiv, form.firstChild);
        if (!data.error) {
          // Reset form on success
          form.reset();

          // Remove alert after 5 seconds
          setTimeout(function () {
            alertDiv.remove();
          }, 5000);
        }
      })["catch"](function (error) {
        // Remove loading state
        form.classList.remove('loading');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;

        // Show error message
        var alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.textContent = 'Có lỗi xảy ra, vui lòng thử lại sau!';
        form.insertBefore(alertDiv, form.firstChild);
      });
    });
  }

  // Back to top functionality
  var backToTop = document.getElementById('back2top');
  if (backToTop) {
    window.addEventListener('scroll', function () {
      if (window.pageYOffset > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });
    backToTop.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});
/******/ })()
;