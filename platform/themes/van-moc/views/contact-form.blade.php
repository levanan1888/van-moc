@if (is_plugin_active('contact'))
    {!! do_shortcode('[contact-form title="LIÊN HỆ TƯ VẤN" bg="0"][/contact-form]') !!}
@else
    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-wrapper">
                <h3>LIÊN HỆ TƯ VẤN</h3>
                <form class="contact-form" method="POST" action="{{ route('public.send.contact') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="4" placeholder="Nội dung tư vấn" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </section>
@endif 