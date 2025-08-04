@php
    $title = $shortcode->title ?? 'PHÁT TRIỂN BỀN VỮNG – TẠO CHUỖI GIÁ TRỊ CHO CỘNG ĐỒNG';
    $item1_title = $shortcode->item1_title ?? 'Sản phẩm thuần tự nhiên';
    $item1_content = $shortcode->item1_content ?? 'Từ vườn thảo mộc đến tay bạn, mỗi sản phẩm đều được chọn lọc kỹ lưỡng, không hương liệu tổng hợp.';
    $item1_icon = $shortcode->item1_icon ?? 'themes/van-moc/images/icons/icon-thuan-tu-nhien.jpg';
    $item2_title = $shortcode->item2_title ?? 'Đối tác bền vững';
    $item2_content = $shortcode->item2_content ?? 'Hợp tác lâu dài với người nông dân, tạo ra sinh kế ổn định và phát triển cộng đồng.';
    $item2_icon = $shortcode->item2_icon ?? 'themes/van-moc/images/icons/icon-ben-vung.jpg';
    $item3_title = $shortcode->item3_title ?? 'Lan tỏa lối sống thuận tự nhiên';
    $item3_content = $shortcode->item3_content ?? 'Khai nguồn cảm hứng sống xanh, qua từng sản phẩm và hoạt động, lan tỏa những giá trị giản dị.';
    $item3_icon = $shortcode->item3_icon ?? 'themes/van-moc/images/icons/icon-lan-toa.jpg';
@endphp

<section class="sustainability">
    <div class="container">
        <div class="section-header">
            <h2>{{ $title }}</h2>
        </div>
        <div class="sustainability-flex">
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('themes/van-moc/images/icon-phat-trien-ben-vung/icon-thuan-tu-nhien.jpg') }}" alt="Icon 1">
                </div>
                <h3>{{ $item1_title }}</h3>
                <p>{{ $item1_content }}</p>
            </div>
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('themes/van-moc/images/icon-phat-trien-ben-vung/icon-ben-vung.jpg') }}" alt="Icon 2">
                </div>
                <h3>{{ $item2_title }}</h3>
                <p>{{ $item2_content }}</p>
            </div>
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('themes/van-moc/images/icon-phat-trien-ben-vung/icon-lan-toa.jpg') }}" alt="Icon 3">
                </div>
                <h3>{{ $item3_title }}</h3>
                <p>{{ $item3_content }}</p>
            </div>
        </div>
    </div>
</section>

<style>
/* Sustainability Section */
.sustainability {
    padding: 80px 0;
    background-color: #FFFFFF;
}

.sustainability .section-header h2 {
    font-family: 'Prata', serif;
    font-size: 28px;
    text-align: center;
    position: relative;
    margin: 0 auto 40px;
    padding-bottom: 10px;
}

.sustainability .section-header h2:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 2px;
    background-color: #4A7D4A;
}

.sustainability-flex {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.sustainability-item {
    background-color: #F9F9F9;
    padding: 50px 30px;
    border-radius: 8px;
    text-align: center;
}

.sustainability-item .icon-wrapper {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    background-color: #244317;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 25px;
}

.sustainability-item img {
    height: 120px;
    width: 120px;
}

.sustainability-item h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #244317;
}

.sustainability-item p {
    line-height: 1.8;
    max-width: 250px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 1200px) {
    .sustainability-flex {
        grid-template-columns: 1fr;
    }
}
</style> 