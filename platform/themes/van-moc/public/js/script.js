document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle functionality
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const productItem = this.closest('.product-item');
            const productName = productItem.querySelector('h3').textContent;
            alert(`Đã thêm "${productName}" vào giỏ hàng!`);
        });
    });

    // Product item click to go to detail page
    document.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't trigger if clicking on add to cart button
            if (!e.target.closest('.add-to-cart')) {
                const productLink = this.querySelector('.product-image img').closest('a') || 
                                   this.querySelector('.product-text h3').closest('a');
                if (productLink) {
                    window.location.href = productLink.href;
                }
            }
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Form submission handling
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Đang gửi...';
            }
        });
    });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}); 