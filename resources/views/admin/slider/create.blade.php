@extends('admin.layouts.main')
@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{$title}}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            @can('view',\App\Models\Slider::class)
                <a class="btn btn-primary shadow-md mr-2" href="{{route('slider.index')}}">Danh sách Slider</a>
            @endcan
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12">
            <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" id="form-slider">
                <div class="intro-y box p-5">
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 md:col-span-4">
                            <div class="mt-3">
                                <label for="crud-form-1" class="form-label">Tiêu đề</label>
                                <input id="crud-form-1" type="text" name="name" value="" class="form-control w-full" placeholder="Nhập tiêu đề">
                            </div>
                            <div class="mt-3">
                                <label for="crud-form-1" class="form-label">Tiêu đề phụ</label>
                                <input id="crud-form-1" type="text" name="subtitle" value="" class="form-control w-full" placeholder="Nhập tiêu đề phụ">
                            </div>
                            <div class="mt-3">
                                <label for="crud-form-1" class="form-label">Mô tả</label>
                                <input id="crud-form-1" type="text" name="description" value="" class="form-control w-full" placeholder="Nhập mô tả">
                            </div>
                            <div class="mt-3">
                                <label for="crud-form-1" class="form-label">Link</label>
                                <input id="crud-form-1" type="text" name="link_target" value="" class="form-control w-full" placeholder="Nhập đường dẫn">
                            </div>
                            <div class="mt-3">
                                <label for="crud-form-2" class="form-label">Vị trí hiển thị</label>
                                <select name="location" data-placeholder="Chọn vị trí hiển thị" class="tom-select w-full" id="crud-form-2">
                                    @foreach($arrLocation as $index => $item)
                                        <option value="{{$index}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="crud-form-2" class="form-label">Thứ tự hiển thị(<span class="text-red-600">*</span>)</label>
                                <input id="crud-form-2" type="number" name="position" value="" min="1" class="form-control w-full" placeholder="Nhập thứ tự">
                                @error('position')
                                <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <div class="mt-3">
                                <label>Ảnh tiêu đề</label>
                                <div class="mt-2">
                                    <div class="w-40 show-title-img">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img src="{{asset('/upload/images/common_img/no-images.jpg')}}">
                                        </div>
                                    </div>
                                    <input type="file" name="title_img" id="file-title-image">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label>Trạng thái</label>
                                <div class="mt-3">
                                    <input type="checkbox" name="status" checked class="form-check-switch">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="mt-3 form-group">
                                <label>Ảnh Slider</label>
                                <div class="mt-2">
                                    <div class="w-40 show-image">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img src="{{asset('/upload/images/common_img/no-images.jpg')}}">
                                        </div>
                                    </div>
                                    <input name="image" type="file" class="mt-2" id="file-image"/>
                                    @error('image')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="color" class="w-16 h-16 rounded-xl" name="colortop" value="">
                                <label>Màu nền trên</label>
                            </div>
                            <div class="mt-3">
                                <input type="color" class="w-16 h-16 rounded-xl" name="colorbottom" value="">
                                <label>Màu nền dưới</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        @can('view',\App\Models\Slider::class)
                            <a type="button" href="{{route('slider.index')}}" class="btn btn-outline-secondary w-24 mr-1">Hủy</a>
                        @endcan
                        <button type="submit" class="btn btn-primary w-24">Tạo mới</button>
                    </div>
                    @csrf
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('change','#file-title-image',function () {
                var show_image = $(".show-title-img");
                var selectedFile = event.target.files[0];
                var reader = new FileReader();
                reader.onload = function(event) {
                    var image = '<div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in"><img src="'+event.target.result+'"></div>';
                    show_image.empty();
                    show_image.append(image);
                };
                reader.readAsDataURL(selectedFile);
            })
        });
    </script>
@endsection
