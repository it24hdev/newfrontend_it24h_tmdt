<div class="brand-slider-bottom" style="margin-bottom: 30px;">
    <div class="brand-slider owl-carousel owl-theme owl-loaded owl-drag" id="brand-slider">
        @foreach ($list_brand as $item)
            <a href="javascript:;" class="brand">
                <img class="owl-lazy lazy" data-src="{{asset('upload/images/products/large/'.$item->image)}}" alt="">
            </a>
        @endforeach
    </div>
</div>
<script src="{{ asset('asset/js/home.js') }}"></script>