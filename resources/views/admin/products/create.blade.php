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
                    <div>
                        <label for="crud-form-1" class="form-label">Tên sản phẩm(<span class="text-red-600">*</span>)</label>
                        <input id="crud-form-1" type="text" name="name" value="{{old('name')}}" class="form-control w-full" required>
                        @error('name')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                     <label>Trạng thái</label> <br>
                     <input type="checkbox" name='status' checked="checked" class="form-check-switch">
                     </div>
                    <div class="mt-3">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">
                                <label>Ảnh sản phẩm</label><br>
                                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                    <i data-feather="image" class="w-4 h-4 mr-2"></i>
                                    <span class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                    <input name='thumb' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload2" required/>

                                </div>
                                <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                                    <div class="flex flex-wrap px-4 w-full">
                                        <div id="dvPreview2">
                                            @error('thumb')
                                                <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-12 xl:col-span-7 ">
                        <label>Ảnh giới thiệu sản phẩm</label><br>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i>
                                <span class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" name="image[]" multiple id="fileupload">
                        </div>
                        <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                            <div class="flex flex-wrap px-4 w-full">
                                <div class="mt-2 ">
                                <div id="dvPreview" >
                                </div>
                                @error('image')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
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
                    <input type="int-number" min="0" max="1000000000000" class="form-control tiente " id="price" name="price">
                    </div>
                    </div>
                    <div class="mt-3">
                    <label>Giảm giá(%)</label>
                    <div class="mt-2">
                    <input type="number" min="0" max="100" class="form-control" id="onsale" name="onsale">
                    </div>
                    </div>
                    <div class="mt-3">
                    <label>Giá đã giảm</label>
                    <div class="mt-2">
                    <input type="int-number" min="0" max="100" class="form-control tiente" id="price_onsale" name="price_onsale">
                    </div>
                    </div>
                    <div class="mt-3">
                    <label>Số lượng</label>
                    <div class="mt-2">
                    <input type="int-number" min="0" max="10000000" class="form-control tiente" name="quantity" >
                    </div>
                    </div>
                    <div class="mt-3">
                    <label>Đơn vị tính</label>
                    <div class="mt-2">
                            <input type="text" class="form-control" name="unit">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Số lượng đã bán</label>
                        <div class="mt-2">
                        <input type="number" class="form-control" defaultValue="0" min="0" max="100000" name="sold">
                        </div>
                    </div>
                    </div>
                    <div class="col-span-12 xl:col-span-4">
                    <div class="mt-3">
                        <label>Thương hiệu</label>
                        <div class="mt-2">
                            <select name="brand"  class="tom-select w-full">
                                <option value="0">Chọn thương hiệu</option>
                                @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                    <label>Danh mục sản phẩm</label>
                    <div class="mt-2">
                    <select name="cat_id[]"  class="tom-select w-full" multiple>
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
                    <div class="mt-3">
                        <label for="">Màu sản phẩm</label>
                        <select name="attr_id[]"  class="tom-select w-full" multiple>
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="">Size sản phẩm</label>
                        <select name="attr_id[]"  class="tom-select w-full" multiple>
                            @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="">Thông số kỹ thuật mô tả dạng thẻ tag</label>
                        <select name="specifications[]" data-placeholder="Nhập các thông số mô tả cho sản phẩm" class="tom-select w-full" multiple>
                        </select>
                    </div>
                    <div class="mt-3">
                        <div class="form-check px-3 py-2">
                            <input name="new"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="1"
                                id="new">
                            <label class="form-check-label inline-block text-gray-800"
                                for="new"
                                style="font-size: 1rem">
                                Sản phẩm mới
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-check px-3 py-2">
                            <input name="hot_sale"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="1"
                                id="hot_sale">
                            <label class="form-check-label inline-block text-gray-800"
                                for="hot_sale"
                                style="font-size: 1rem">
                                Sản phẩm bán chạy
                            </label>
                        </div>
                    </div>

                </div>
                <div class="col-span-12 xl:col-span-4">
                    <div class="mt-3">
                        <label>Thuộc tính sản phẩm</label>
                        <p><i>( Màu sắc: đen, trắng; Chiều cao: 15 inch; )</i></p>
                        <div class="mt-2">
                       <textarea class="form-control" name="property" rows="7">{{ old('property') }}
                       </textarea>
                   </div>
                    </div>
                     <div class="mt-3">
                        <div class="mt-3">
                            <label for="time_deal" class="form-label">Thời hạn ưu đã cho sản phẩm</label>
                            <input type="date" name="time_deal" class="form-control w-56 block mx-auto"
                                id="time_deal" value="{{ old('time_deal') }}">
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mt-3">
                            <label for="year" class="form-label">Tag năm sản xuất</label>
                            <input type="text" name="year" class="form-control w-56 block mx-auto"
                                id="year" value="{{ old('year') }}" placeholder="VD: New 2022">
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-check px-3 py-2">
                            <input name="installment"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="checkbox" value="1"
                                id="installment">
                            <label class="form-check-label inline-block text-gray-800"
                                for="installment"
                                style="font-size: 1rem">
                                Trả góp 0%
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Thương hiệu</label>
                        <div class="mt-2">
                            <select name="event"  class="tom-select w-full">
                                <option value="0">Chọn Tag ưu đãi</option>
                                @foreach ($tag_events as $tag_event)
                                    <option value="{{$tag_event->id}}">{{$tag_event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mt-3">
                            <label for="" class="form-label">Link video Youtube</label>
                            <input type="text" name="youtube" class="form-control block mx-auto"
                                id="year" value="{{ old('youtube') }}" placeholder="Nhập link video sản phẩm">
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mt-3">
                            <label for="" class="form-label">Tình trạng sản phẩm</label>
                            <input type="text" name="still_stock" class="form-control w-56 block mx-auto"
                                id="year" value="{{ old('still_stock') }}" placeholder="VD: Còn hàng" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label>Mô tả ngắn</label>
                <div class="mt-2">
                    <textarea name="short_content" id="tiny-editor2" rows="2">{{old('short_content')}}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <label>Nội dung quà tặng ưu đãi</label>
                <div class="mt-2">
                    <textarea name="gift" id="tiny-editor3" rows="2">{{old('gift')}}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <label>Nội dung chi tiết</label>
                <div class="mt-2">
                    <textarea name="content" id="tiny-editor" rows="7">{{old('content')}}</textarea>
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
        });
    </script>
@endsection
