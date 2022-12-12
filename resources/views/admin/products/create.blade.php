@extends('admin.layouts.main')
@section('css')
    <script src="{{ asset('lib/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection
@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{$title}}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            @can('viewAny',App\Models\Products::class)
                <a class="btn btn-primary shadow-md mr-2" href="{{route('products.index')}}">Danh sách sản phẩm</a>
            @endcan
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <!-- BEGIN: Form Layout -->
            <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" id="form-post">
                <div class="intro-y box p-5">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <label for="crud-form-z" class="form-label">Mã(<span
                                    class="text-red-600">*</span>)</label>
                            <input id="crud-form-z" type="text" name="ma" value="{{ old('ma')}}"
                                   class="form-control w-full" required>
                            @error('ma')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="crud-form-1" class="form-label">Tên sản phẩm(<span
                                    class="text-red-600">*</span>)</label>
                            <input id="crud-form-1" type="text" name="name" value="{{ old('name')}}"
                                   class="form-control w-full" required>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="form-group mb-3">
                                <label>Trạng thái</label><br>
                                <input type="checkbox" class="form-check-switch mt-3" name='status' checked>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5 mt-3">
                        <div class="col-span-12 xl:col-span-4">
                            <label>Ảnh đại diện</label><br>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                <input name='thumb' type="file" class="top-0 left-0 absolute opacity-0"
                                       id="fileupload2"/>
                            </div>
                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                                <div class="m-2" id="dvPreview2">
                                     <img src="{{ asset('/upload/images/common_img/no-images.jpg') }}"
                                             style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                    @error('thumb')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-7">
                            <label>Ảnh chi tiết</label><br>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" name="image[]" multiple id="fileupload">
                            </div>
                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-2">
                                <div class="flex flex-wrap px-4 w-full">
                                    <div class="mt-2 ">
                                        <div id="dvPreview">
                                            <img class="rounded-md"  src="{{ asset('/upload/images/common_img/no-images.jpg') }}"
                                                 style="object-fit: cover; object-position: 50% 0; width: 100px;height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Giá bán</label>
                                <div class="mt-2">
                                    <input type="int-number" min="0" max="1000000000000" class="form-control tiente "
                                           id="price" name="price" value="{{ old('price')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Giá khuyến mại</label>
                                <div class="mt-2">
                                    <input type="int-number" min="0" max="100" class="form-control tiente"
                                           id="price_onsale" name="price_onsale"
                                           value="{{ old('price_onsale')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>% giảm giá</label>
                                <div class="mt-2">
                                    <input type="number" min="0" max="100" class="form-control" id="onsale"
                                           name="onsale" value="{{ old('onsale')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Số lượng</label>
                                <div class="mt-2">
                                    <input type="int-number" min="0" max="10000000" class="form-control tiente"
                                           name="quantity" value="{{ old('quantity')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Số lượng đã bán</label>
                                <div class="mt-2">
                                    <input type="number" class="form-control" defaultValue="0" min="0" max="100000"
                                           name="sold" value="{{ old('quantity')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Đơn vị tính</label>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="unit" value="{{ old('unit')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Danh mục sản phẩm</label>
                                <div class="mt-2">
                                    <select name="cat_id[]" class="tom-select w-full" multiple>
                                        @foreach ($listcategory as $val)
                                            <option value="{{$val->id}}" class="form-control">
                                                @php
                                                    $str ='';
                                                    for ($i=0; $i < $val->level; $i++) {
                                                        echo $str;
                                                        $str.='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                                                    }
                                                @endphp
                                                {{ $val->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Thương hiệu</label>
                                <div class="mt-2">
                                    <select name="brand" class="tom-select w-full">
                                        <option value="0">Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <div class="mt-3">
                                    <label for="" class="form-label">Link video Youtube</label>
                                    <input type="text" name="youtube" class="form-control block mx-auto" id="year" placeholder="Nhập link video sản phẩm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label for="">Thẻ tag thông số kt</label>
                                <select name="specifications[]" data-placeholder="Nhập các thông số mô tả cho sản phẩm"
                                        class="tom-select w-full" multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label for="year" class="form-label">Thẻ tag 1</label>
                                <input type="text" name="year" class="form-control block mx-auto"
                                       id="year" placeholder="Sản phẩm mới">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3"> <label for="installment" class="form-label">Thẻ tag 2</label>
                                <input type="text" name="installment" class="form-control block mx-auto" id="installment" placeholder="Trả góp 0%">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label for="time_deal" class="form-label">Thời hạn ưu đãi</label>
                                <input type="date" name="time_deal" class="form-control block mx-auto"
                                       id="time_deal">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3">
                                <label>Thẻ tag ưu đãi</label>
                                <div class="mt-2">
                                    <select name="event" class="tom-select w-full">
                                        <option value="0">Chọn Tag ưu đãi</option>
                                        @foreach ($tag_events as $tag_event)
                                            <option
                                                value="{{$tag_event->id}}">{{$tag_event->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2">
                            <div class="mt-3">
                                <label for="warranty" class="form-label">Bảo hành</label>
                                <input id="warranty" type="text" name="warranty" value="{{ old('warranty')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2">
                            <div class="mt-3">
                                <label for="view" class="form-label">Lượt xem</label>
                                <input id="view" type="text" name="view" value="{{ old('view')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="mt-3">
                            <div class="form-check px-3 py-2">
                                <input name="is_new"
                                       class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                       type="checkbox">
                                <label class="form-check-label inline-block text-gray-800"
                                       for="is_new">
                                    Sản phẩm mới
                                </label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check px-3 py-2">
                                <input name="is_hot"
                                       class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                       type="checkbox" id="is_hot">
                                <label class="form-check-label inline-block text-gray-800"  for="is_hot"> Sản phẩm bán chạy </label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check px-3 py-2">
                                <input name="is_promotion"
                                       class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                       type="checkbox" id="is_promotion">
                                <label class="form-check-label inline-block text-gray-800"
                                       for="is_promotion">
                                    Sản phẩm khuyến mại
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="mt-3 col-span-12 xl:col-span-6">
                            <label>Mô tả ngắn</label>
                            <div class="mt-2">
                                <textarea name="short_content" id="tiny-editor2"
                                          rows="3">{{ old('short_content')}}</textarea>
                            </div>
                        </div>
                        <div class="mt-3 col-span-12 xl:col-span-6">
                            <label>Khuyến mại</label>
                            <div class="mt-2">
                                <textarea name="gift" id="tiny-editor3" rows="2">{{old('gift')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 col-span-12">
                        <label>Thông số kỹ thuật</label>
                        <div class="mt-2">
                            <textarea class="form-control" name="property" id="tiny-editor4" rows="7">{{ old('property') }}</textarea>
                        </div>
                    </div>
                    <div class="mt-3 col-span-12">
                        <label>Mô tả chi tiết</label>
                        <div class="mt-2">
                            <textarea name="content_product" id="tiny-editor" rows="7">{{ old('content')}}</textarea>
                        </div>
                    </div>
            <div class="text-right mt-5">
                @can('viewAny',App\Models\Products::class)
                    <a type="button" href="{{route('products.index')}}" class="btn btn-outline-secondary w-24 mr-1">Hủy</a>
                @endcan
                @can('update',App\Models\Products::class)
                    <button type="submit" class="btn btn-primary w-24">Lưu</button>
                @endcan
            </div>
                @csrf
            </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/post-form.js') }}"></script>
    <script>
        $(document).ready(function() {
            //xu ly show tien te
            var tiente = document.querySelectorAll('.tiente');
            for (var i = 0; i < tiente.length; i++) {
                tiente[i].value = new Intl.NumberFormat('vi-VN').format(tiente[i].value);
            }

            $('#onsale').on('keyup',  function(){
            const percent = this.value;
            const giaban  = document.getElementById('price').value;
            const giaban1 =  giaban.replace(/[^a-zA-Z0-9 ]/g, '');
            const price_onsale = giaban1 - giaban1*percent/100;
            document.getElementById('price_onsale').value = new Intl.NumberFormat('vi-VN').format(price_onsale);
            });

            $('#price').on('keyup',  function(){
            const giaban= this.value;
            const percent  = document.getElementById('onsale').value;
            const giaban1 =  giaban.replace(/[^a-zA-Z0-9 ]/g, '');
            const price_onsale = giaban1 - giaban1*percent/100;
            document.getElementById('price_onsale').value = new Intl.NumberFormat('vi-VN').format(price_onsale);
            });

            $('#price_onsale').on('keyup',  function(){
            const giadagiam= this.value;
            const giaban  = document.getElementById('price').value;
            const giaban1 =  giaban.replace(/[^a-zA-Z0-9 ]/g, '');
            const giadagiam1 =  giadagiam.replace(/[^a-zA-Z0-9 ]/g, '');
            const onsale = parseInt(100-giadagiam1/giaban1*100);
            document.getElementById('onsale').value = onsale;
            });
        });
    </script>
@endsection
