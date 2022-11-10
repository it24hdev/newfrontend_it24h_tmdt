@extends('admin.layouts.main')
@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{ $title }} {{$registerservice->name}}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           <a class="btn btn-primary shadow-md mr-2" href="{{ route('registerservice.index') }}">Danh sách yêu cầu</a>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="intro-y box p-5">
                    <div class="mt-3">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-5">
                                <label>Tên khách hàng</label>
                                <input type="text">
                            </div>
                            <div class="col-span-12 xl:col-span-7">
                                <label>Ảnh giới thiệu sản phẩm</label><br>
                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                        class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" name="image[]"
                                           multiple id="fileupload">
                                </div>
                                <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-2">
                                    <div class="flex flex-wrap px-4 w-full">
                                        <div class="mt-2 ">
                                            <div id="dvPreview">
{{--                                                @if ($edit->image === '' || $edit->image === 'no-images.jpg')--}}
{{--                                                    <img class="rounded-md"src="{{ asset('/upload/images/common_img/no-images.jpg') }}"style="object-fit: cover; object-position: 50% 0; width: 100px;height: 100px;">--}}
{{--                                                @else--}}
{{--                                                    @foreach ($img as $item)--}}
{{--                                                        <div class="inline-block w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in" id="">--}}
{{--                                                            <img class="rounded-md" src="{{ asset('/upload/images/products') . '/' . $item }}" style="object-fit: cover; object-position: 50% 0; width: 100px;height: 100px;">--}}
{{--                                                            <div title="Xóa ảnh?" data-product_id="{{ $edit->id }}"data-img="{{ $item }}"--}}
{{--                                                                 class="xoa_anh tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">--}}
{{--                                                                <i data-feather="x" class="w-4 h-4"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <a type="button" href="{{ route('registerservice.index') }}"
                           class="btn btn-outline-secondary w-24 mr-1">Hủy</a>
                        <button type="submit" class="btn btn-primary w-24">Cập nhật</button>
                    </div>
                    @csrf
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('js')
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.xoa_anh').click(function() {--}}
{{--                var img = $(this).data('img');--}}
{{--                var product_id = $(this).data('product_id');--}}
{{--                var _token = $('meta[name="csrf-token"]').attr('content');--}}
{{--                var data = {--}}
{{--                    img: img,--}}
{{--                    _token: _token,--}}
{{--                    product_id: product_id--}}
{{--                };--}}
{{--                var t =  $(this).parent();--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('products.deleteImg') }}",--}}
{{--                    method: "POST",--}}
{{--                    data: data,--}}
{{--                    dataType: "json",--}}
{{--                    success: function(data) {--}}
{{--                        t.remove();--}}
{{--                    }--}}

{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
