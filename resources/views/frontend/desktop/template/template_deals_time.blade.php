<script id="template_deals_time" type="text/x-custom-template">
<div class="wp-supper-deal mgb_deal">
    <div class="block-filterproducts clearfix" >
        <div class="block-title">
        <strong>Siêu Ưu Đãi <br> trong Tháng Này</strong>
        <p class="note-deal">
            Chương trình ưu đãi, giảm giá cực lớn. Nhanh tay mua hàng!
        </p>
        <div class="time-sale time-deal" data-target="">
            <div class="countdown">
                <div class="countdown-item">
                    <div class="countdown-digits countdown-days" id="d"></div>
                    <div class="countdown-label">Ngày</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-digits countdown-hours" id="h"></div>
                    <div class="countdown-label">Giờ</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-digits countdown-minutes" id="m"></div>
                    <div class="countdown-label">Phút</div>
                    </div>
                <div class="countdown-item">
                    <div class="countdown-digits countdown-seconds" id="s"></div>
                    <div class="countdown-label">Giây</div>
                </div>
            </div>
        </div>
        </div>
        <div class="block-content">
        <div class="slider-content" >
            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="slider-deal-supper">

            </div>
            <div class="viewall_deal">
                <a href="{{route('list_product',['promotion'=>'deal'])}}">Xem tất cả<i class="fal fa-angle-down"></i></a>
            </div>
        </div>
        </div>
    </div>
</div>
</script>
