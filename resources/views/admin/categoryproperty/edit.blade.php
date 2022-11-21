@extends('admin.layouts.main')
@section('category')
 <div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">{{ $title }}</h2>
    <div class="form-group">
        <form action="{{ route('category_property.update',[$category_property->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 xl:col-span-6">

            <div class="form-group mb-4">
                <label>Tên thuộc tính</label>
                <input type="text" class=" form-control" name='name' value="{{old('name') ?? $category_property->name}}">
                @error('name') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Mã nhận dạng cho quản trị</label>
                <input type="text" class=" form-control" name='ma' value="{{old('ma') ?? $category_property->ma}}" required>
                @error('ma') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Mô tả tóm tắt</label>
                <textarea type="text" class="form-control" rows="2" name='explain'>{{old('explain') ?? $category_property->explain}}</textarea>
            </div>
            <div class="form-group mb-4">
                <label>Thứ tự xuất hiện</label>
                <input type="number" class=" form-control" name='stt' value="{{old('stt') ?? $category_property->stt}}">
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label> <br>
                 <input type="checkbox" name='status' class="form-check-switch" value="{{$category_property->status == true ? '1' : '0'}}" {{$category_property->status == true ? 'checked' : ' '}}>
            </div>
            </div>
            <div class="col-span-12 xl:col-span-3">
                <label>Ảnh thuộc tính</label><br>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                        class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                    <input name='image' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload2" />
                </div>
                <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                    <div class="m-2" id="dvPreview2">
                        @if ($category_property->image === '' || $category_property->image === 'no-images.jpg')
                            <img src="{{ asset('/upload/images/common_img/no-images.jpg') }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                        @else
                            <img src="{{ asset('/upload/images/properties') . '/' . $category_property->image }}" style="object-fit: cover; object-position: 50% 0; width: 180px;height: auto;">
                        @endif
                        @error('image')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-span-12 xl:col-span-12">
            <div class="form-group mb-4">
                 <a class="btn btn-primary shadow-md mr-2" href="{{ route('detailproperty.create',[$category_property->id])}}" >Thêm chi tiết thuộc tính</a>
            </div>


            <table  class="table table-report -mt-2">
                <thead>
                    <tr >
                        <th class="text-center whitespace-nowrap">STT</th>
                        <th class="text-center whitespace-nowrap">MÃ</th>
                        <th class="text-center whitespace-nowrap">TÊN</th>
                        <th class="text-center whitespace-nowrap">MÔ TẢ</th>
                        <th class="text-center whitespace-nowrap">THỨ TỰ HIỂN THỊ</th>
                        <th class="text-center whitespace-nowrap">CHỨC NĂNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailproperties as $key => $value)
                    <tr id="{{ $value->id }}">
                        <td class="text-left">{{$key+1}}</td>
                        <td class="text-left">{{$value->ma}}</td>
                        <td class="text-left">{{$value->name}}</td>
                        <td class="text-left">{{$value->explain}}</td>
                        <td class="text-left">{{$value->stt}}</td>
                        <td class="w-20">
                            <div class="flex justify-center items-center">
                                <a class="btn btn-sm btn-primary mr-2"
                                   href="{{route('detailproperty.edit',['id' => $value->id, 'id_categoryproperty' => $category_property->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a title="Xóa" data-toggle="modal"
                                   data-value="{{$value->id}}"
                                   data-target="#delete-confirmation-modal"
                                   class="btn btn-danger py-1 px-2 btn-delete2"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('admin.categoryproperty.deletedetail')
            </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-default" href="{{ route('category_property.index')}}">Hủy</a>
            <input type="submit" class="btn btn-primary " value="Cập nhật">
        </div>
    </form>
</div>
</div>
@endsection
@section('js2')
 <script>
    $(document).ready(function () {
        $(document).on('click',".btn-delete2",function (e) {
                e.preventDefault();
                var id = $(this).attr('data-value');
                $('#delete_id').val(id);
        });
    });
</script>
@endsection
