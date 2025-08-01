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
        <div class="sustainability-grid">
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset($item1_icon) }}" alt="Icon 1">
                </div>
                <h3>{{ $item1_title }}</h3>
                <p>{{ $item1_content }}</p>
            </div>
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset($item2_icon) }}" alt="Icon 2">
                </div>
                <h3>{{ $item2_title }}</h3>
                <p>{{ $item2_content }}</p>
            </div>
            <div class="sustainability-item">
                <div class="icon-wrapper">
                    <img src="{{ asset($item3_icon) }}" alt="Icon 3">
                </div>
                <h3>{{ $item3_title }}</h3>
                <p>{{ $item3_content }}</p>
            </div>
        </div>
    </div>
</section> 