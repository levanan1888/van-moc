<!-- CONTACT -->
<div class="modal fade" id="modalContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><strong>{{ Str::upper(__('Contact for a quote')) }}</strong></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-bodys">
                {!! do_shortcode('[contact-form title="" bg="0" single="1"][/contact-form]') !!}
            </div>
        </div>
    </div>
</div>
