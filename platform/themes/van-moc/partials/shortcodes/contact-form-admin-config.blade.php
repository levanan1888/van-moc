<div class="form-group">
    <label for="title">Tiêu đề</label>
    <input type="text" name="title" value="{{ $shortcode->title ?? 'Để lại thông tin' }}" class="form-control" placeholder="Nhập tiêu đề form">
</div>

<div class="form-group">
    <label for="description">Mô tả</label>
    <textarea name="description" class="form-control" rows="3" placeholder="Nhập mô tả form">{{ $shortcode->description ?? 'Hãy để lại thông tin để chúng tôi có thể liên hệ với bạn' }}</textarea>
</div> 