// Product Category Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize product category functionality
    initProductCategory();
    
    // Initialize filter dropdowns
    initFilterDropdowns();
    
    // Initialize load more functionality
    initLoadMore();
    
    // Initialize add to cart animations
    initAddToCartAnimations();
});

function initProductCategory() {
    // Add smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
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
    
    // Add intersection observer for product items
    const productItems = document.querySelectorAll('.product-item');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    productItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(item);
    });
}

function initFilterDropdowns() {
    const filterDropdowns = document.querySelectorAll('.filter-dropdown, .sort-dropdown');
    
    filterDropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
            
            // Toggle dropdown functionality (placeholder)
            console.log('Filter dropdown clicked:', this.querySelector('.filter-label, .sort-label').textContent);
        });
        
        // Add hover effects
        dropdown.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        dropdown.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

function initLoadMore() {
    const loadMoreBtn = document.querySelector('.btn-load-more');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Add loading state
            const originalText = this.textContent;
            this.textContent = 'Đang tải...';
            this.disabled = true;
            
            // Simulate loading (replace with actual AJAX call)
            setTimeout(() => {
                this.textContent = originalText;
                this.disabled = false;
                
                // Add success animation
                this.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                setTimeout(() => {
                    this.style.background = 'linear-gradient(135deg, #4A7D4A, #6B9E6B)';
                }, 1000);
                
            }, 2000);
        });
    }
}

function initAddToCartAnimations() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart button');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Add click animation
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
            
            // Create ripple effect
            createRippleEffect(this, e);
            
            // Add success feedback
            showAddToCartSuccess(this);
        });
    });
}

function createRippleEffect(button, event) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    button.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

function showAddToCartSuccess(button) {
    // Create success message
    const successMsg = document.createElement('div');
    successMsg.textContent = 'Đã thêm vào giỏ hàng!';
    successMsg.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        z-index: 1000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        font-weight: 600;
    `;
    
    document.body.appendChild(successMsg);
    
    // Animate in
    setTimeout(() => {
        successMsg.style.transform = 'translateX(0)';
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        successMsg.style.transform = 'translateX(100%)';
        setTimeout(() => {
            successMsg.remove();
        }, 300);
    }, 3000);
}

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .add-to-cart button {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .product-item {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .product-item:hover {
        transform: translateY(-8px);
    }
    
    .filter-dropdown,
    .sort-dropdown {
        transition: all 0.3s ease;
    }
    
    .btn-load-more {
        transition: all 0.3s ease;
    }
    
    .btn-load-more:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
`;
document.head.appendChild(style); 