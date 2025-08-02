@php Theme::layout('default'); @endphp

{!! Theme::partial('breadcrumbs') !!}

<section class="products-page-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="filters-sidebar">
                    <h3>Bộ lọc</h3>
                    
                    <!-- Category Filter -->
                    <div class="filter-group">
                        <h4>Danh mục</h4>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="checkbox" name="category" value="srisri">
                                <span>SRISRI</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="category" value="moc-huong">
                                <span>MỘC HƯƠNG</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="category" value="brands">
                                <span>BRANDS</span>
                            </label>
                            <label class="filter-option">
                                <input type="checkbox" name="category" value="forganic">
                                <span>FORGANIC</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Price Filter -->
                    <div class="filter-group">
                        <h4>Giá</h4>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="radio" name="price" value="0-100000">
                                <span>Dưới 100.000₫</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price" value="100000-300000">
                                <span>100.000₫ - 300.000₫</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price" value="300000-500000">
                                <span>300.000₫ - 500.000₫</span>
                            </label>
                            <label class="filter-option">
                                <input type="radio" name="price" value="500000+">
                                <span>Trên 500.000₫</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Clear Filters -->
                    <button class="btn btn-outline-primary clear-filters">Xóa bộ lọc</button>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="products-header">
                    <div class="products-count">
                        <span>Hiển thị 1-8 của 8 sản phẩm</span>
                    </div>
                    <div class="products-sort">
                        <select class="form-control">
                            <option>Sắp xếp theo</option>
                            <option>Giá tăng dần</option>
                            <option>Giá giảm dần</option>
                            <option>Tên A-Z</option>
                            <option>Tên Z-A</option>
                        </select>
                    </div>
                </div>
                
                <div class="products-grid">
                    <!-- Product items sẽ được load từ shortcode -->
                    {!! do_shortcode('[featured-products]') !!}
                </div>
                
                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <nav aria-label="Product pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Trước</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.products-page-section {
    padding: 60px 0;
    background: #f8f9fa;
}

/* Filters Sidebar */
.filters-sidebar {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: fit-content;
    position: sticky;
    top: 20px;
}

.filters-sidebar h3 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
}

.filter-group {
    margin-bottom: 25px;
}

.filter-group h4 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.filter-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.filter-option {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 14px;
    color: #666;
}

.filter-option input[type="checkbox"],
.filter-option input[type="radio"] {
    width: 16px;
    height: 16px;
    accent-color: #28a745;
}

.filter-option:hover {
    color: #28a745;
}

.clear-filters {
    width: 100%;
    margin-top: 20px;
}

/* Products Header */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.products-count {
    font-size: 14px;
    color: #666;
}

.products-sort select {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 14px;
    min-width: 150px;
}

/* Products Grid */
.products-grid {
    margin-bottom: 40px;
}

/* Override featured-products styles for products page */
.products-grid .featured-products {
    padding: 0;
    background: transparent;
}

.products-grid .section-header {
    display: none;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 5px;
}

.page-item {
    margin: 0;
}

.page-link {
    display: block;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.page-item.active .page-link {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.page-item.disabled .page-link {
    color: #999;
    cursor: not-allowed;
}

/* Responsive */
@media (max-width: 991px) {
    .filters-sidebar {
        position: static;
        margin-bottom: 30px;
    }
    
    .products-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .products-page-section {
        padding: 40px 0;
    }
    
    .filters-sidebar {
        padding: 20px;
    }
    
    .products-header {
        padding: 15px;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .filters-sidebar {
        padding: 15px;
    }
    
    .filter-options {
        gap: 8px;
    }
    
    .filter-option {
        font-size: 13px;
    }
    
    .products-header {
        padding: 12px;
    }
    
    .products-count {
        font-size: 13px;
    }
}
</style>

<script>
// Filter functionality
document.querySelectorAll('.filter-option input').forEach(input => {
    input.addEventListener('change', function() {
        // Filter logic here
        console.log('Filter changed:', this.name, this.value);
    });
});

// Clear filters
document.querySelector('.clear-filters').addEventListener('click', function() {
    document.querySelectorAll('.filter-option input').forEach(input => {
        input.checked = false;
    });
});

// Sort functionality
document.querySelector('.products-sort select').addEventListener('change', function() {
    // Sort logic here
    console.log('Sort changed:', this.value);
});
</script> 