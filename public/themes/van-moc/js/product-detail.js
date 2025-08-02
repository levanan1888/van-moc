// Product Detail Page JavaScript

// Change main image when clicking thumbnails
function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.thumbnail-item').classList.add('active');
}

// Quantity selector
function changeQuantity(delta) {
    const quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + delta;
    
    if (newValue >= 1 && newValue <= 99) {
        quantityInput.value = newValue;
    }
}

// Tab functionality
function showTab(tabName) {
    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab pane
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}

// Add to cart functionality
function addToCart() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    
    alert(`Đã thêm ${quantity} sản phẩm "${productName}" vào giỏ hàng!`);
}

// Buy now functionality
function buyNow() {
    const quantity = document.getElementById('quantity').value;
    const productName = document.querySelector('.product-title').textContent;
    
    alert(`Chuyển đến trang thanh toán cho ${quantity} sản phẩm "${productName}"!`);
}

// Add to cart mini buttons
function addToCartMini(productName) {
    alert(`Đã thêm sản phẩm "${productName}" vào giỏ hàng!`);
}

// Review form submission
function submitReview(event) {
    event.preventDefault();
    alert('Cảm ơn bạn đã đánh giá sản phẩm!');
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set first thumbnail as active
    const firstThumbnail = document.querySelector('.thumbnail-item');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
    
    // Add event listeners for mini cart buttons
    document.querySelectorAll('.add-to-cart-mini').forEach(btn => {
        btn.addEventListener('click', function() {
            const productName = this.closest('.related-product-item').querySelector('h4').textContent;
            addToCartMini(productName);
        });
    });
    
    // Add event listener for review form
    const reviewForm = document.querySelector('.review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', submitReview);
    }
    
    // Add smooth scrolling for anchor links
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
    
    // Add loading state for buttons
    document.querySelectorAll('.btn-buy-now, .btn-add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const originalText = this.textContent;
            this.textContent = 'Đang xử lý...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = originalText;
                this.disabled = false;
            }, 2000);
        });
    });
    
    // Add lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
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
    
    images.forEach(img => imageObserver.observe(img));
}); 