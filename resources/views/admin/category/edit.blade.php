@extends('admin.layouts.main')
@section('css')
    <script src="{{ asset('lib/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection
@section('category')
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ $title}}
        </h2>
        <div class="form-group">
            <form action="{{ route('category.update',[$edit->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 md:col-span-7">
                        <div class="form-group mb-4">
                            <label>Mã</label>
                            <input type="text" class="form-control" name='ma' value="{{old('ma') ?? $edit->ma}}">
                            @error('ma')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-4">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name='name' value="{{old('name') ?? $edit->name}}"
                                   id="typinginput">
                            @error('name') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-4 hidden">
                            <label>Tên danh mục(ngoại ngữ)</label>
                            <input type="text" class="form-control" name='name2'
                                   value="{{old('name2') ?? $edit->name2}}">
                        </div>
                        <div class="form-group mb-4">
                            <label>SLUG</label>
                            <textarea type="text" class="form-control" rows="1" id="slugchanged"
                                      name='slug'> {{old('slug') ?? $edit->slug}}</textarea>
                            @error('slug')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-4">
                            <label>Icon</label>
                            <input type="text" class="form-control" name='icon' value=" {{old('icon') ?? $edit->icon}}">
                        </div>
                        <div class="form-group mb-4">
                            <a type="button" class="btn btn-primary" href="https://fontawesome.com/v5/search"
                               target="_blank">Lấy icon</a>
                        </div>
                        <div class="form-group mb-4">
                            <label>Danh mục cha</label>
                            <select name="parent_id" class="form-control w-full">
                                @foreach ($categorieslv as $val)
                                    <option value="{{$val->id}}" class="form-control" {{old('parent_id') == $val->id ||
                            old('parent_id') == null && $edit->parent_id == $val->id ? 'selected':false}}>
                                        @php
                                            $str ='';
                                            for ($i=0; $i < $val->level; $i++) {
                                                echo $str;
                                                $str.='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                                                // code...
                                            }
                                        @endphp
                                        {{ $val->name}}
                                    </option>
                                @endforeach
                                @if($edit->parent_id == 0)
                                    <option value="0" selected>Mặc định</option>
                                @else
                                    <option value="0">Mặc định</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label>Trạng thái</label><br>
                            <input type="checkbox" class="form-check-switch" name='status'
                                   value="{{$edit->status == true ? '1' : '0'}}" {{$edit->status == true ? 'checked' : ' '}}>
                        </div>
                        <div class="form-group mb-4">
                            <label>Hiện danh sách sản phẩm lên trang chủ</label><br>
                            <input type="checkbox" class="form-check-switch" name='show_push_product'
                                   value="{{$edit->show_push_product == true ? '1' : '0'}}" {{$edit->show_push_product == true ? 'checked' : ' '}}>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <div>
                            <label>Ảnh đại diện danh mục (<span class="italic">Danh mục cha</span>)</label><br>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                <input name='thumb' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0"
                                       id="fileupload2"/>
                            </div>
                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                                <div class="m-2" id="dvPreview2">
                                    @if (empty($edit->thumb) || $edit->thumb == 'no-images.jpg')
                                        <img src="{{ asset('upload/images/common_img/no-images.jpg') }}"
                                             style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                    @else
                                        <img src="{{ asset('upload/images/products/'.$edit->thumb) }}"
                                             style="object-fit: cover; object-position: 50% 0; width: 180px;height: auto;">
                                    @endif
                                    @error('thumb')
                                    <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <label>Banner</label><br>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0"
                                       name="banner[]"
                                       multiple id="fileupload">
                            </div>
                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md pt-2">
                                <div class="flex flex-wrap px-4 w-full">
                                    <div class="mt-2 mb-4">
                                        <div id="dvPreview">
                                            @if (empty($img) || $edit->banner == 'no-images.jpg')
                                                <img class="rounded-md"
                                                     src="{{ asset('upload/images/common_img/no-images.jpg') }}"
                                                     style="object-fit: cover; object-position: 50% 0; width: 100px;height: 100px;">
                                            @else
                                                @foreach ($img as $item)
                                                    <div
                                                        class="inline-block w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in" id="">
                                                        <img class="rounded-md"
                                                             src="{{ asset('upload/images/products/'. $item)}}"
                                                             style="object-fit: cover; object-position: 50% 0; width: 100px;height: 100px;">
                                                        <div title="Xóa ảnh?" data-target="{{ $edit->id }}"
                                                             data-img="{{ $item }}"
                                                             class="xoa_anh tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                            <i data-feather="x" class="w-4 h-4"></i>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 md:col-span-6">
                        <div class="form-group mb-4">
                            <label>Danh mục thuộc tính</label>
                            <select name="property" id="properties" class="tom-select w-full" multiple>
                                @foreach ($categoryproperty as $key => $value)
                                    <option value="{{$value->id}}" class="form-control">
                                        {{ $value->name}} ━━━ {{ $value->ma}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="button" class="btn btn-primary" id="addproperty" value="Thêm">
                    </div>
                </div>
                <div>
                    <table class="table table-report -mt-2">
                        <thead>
                        <tr>
                            <th class="text-center whitespace-nowrap">STT</th>
                            <th class="text-center whitespace-nowrap">MÃ</th>
                            <th class="text-center whitespace-nowrap">THUỘC TÍNH</th>
                            <th class="text-center whitespace-nowrap">GIÁ TRỊ</th>
                            <th class="text-center whitespace-nowrap">CHỨC NĂNG</th>
                        </tr>
                        </thead>
                        <tbody id="addrowproperty">
                        @foreach($categoryproperties_manages as $key => $value)
                            <tr id="{{ $value->id }}">
                                <td class="text-center">{{$key+1}}</td>
                                <td class="text-center">{{$value->ma}}</td>
                                <td class="text-center">{{$value->name}}</td>
                                <td class="text-center"><a
                                        href="{{route('category_property.edit',$value->categoryproperties_id)}}">Quản lý
                                        giá trị</a></td>
                                <td class="w-20">
                                    <div class="flex justify-center items-center">
                                        <a title="Xóa" data-toggle="modal"
                                           data-value="{{$value->id}}"
                                           data-target="#delete-confirmation-modal"
                                           class="btn btn-danger py-1 px-2 btn-delete2"><i class="fa-solid fa-trash-can"
                                                                                           style="padding: 1px"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin.category.deleteproperties')
                </div>
                <div class="mt-3">
                    <label>Mô tả</label>
                    <div class="mt-2">
                        <textarea name="content_category" id="tiny-editor" rows="7">{{ old('content') ?? $edit->content }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" href="{{ route('category.index')}}">Hủy</a>
                    <input type="submit" class="btn btn-primary " value="Cập nhật">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js2')
    <script src="{{ asset('/js/post-form.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#addproperty').on('click', function () {
                var properties_id = $('#properties').val();
                var category_id = {{$edit->id}};
                if (properties_id != 0) {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        properties_id: properties_id,
                        category_id: category_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{ route('category.addproperty') }}",
                        method: "POST",
                        data: data,
                        dataType: "json",
                        success: function (data) {
                            $("#addrowproperty").append(data.html);
                            var id = data.id;
                            var url = "{{ route('category.edit', "cate_id") }}";
                            url = url.replace("cate_id", id);
                            window.location.href = url;
                        }
                    });
                }
            });
            $(document).on('click', ".btn-delete2", function (e) {
                e.preventDefault();
                var id = $(this).attr('data-value');
                $('#delete_id').val(id);
            });
            $('.xoa_anh').click(function () {
                var img = $(this).attr('data-img');
                var id = $(this).attr('data-target');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    img: img,
                    _token: _token,
                    id: id
                };
                var t = $(this).parent();
                $.ajax({
                    url: "{{ route('category.deleteImg') }}",
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        t.remove();
                    }
                });
            });
        });
    </script>
@endsection
