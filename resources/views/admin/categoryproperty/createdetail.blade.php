@extends('admin.layouts.main')
@section('category')
 <div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">{{ $title }}</h2>
    <div class="form-group">
        <form action="{{ route('detailproperty.store',$categoryproperty_id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 xl:col-span-6">

            <div class="form-group mb-4">
                <label>Tên thuộc tính</label>
                <input type="text" class=" form-control" name='name' value="{{old('name')}}">
                @error('name') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Mã nhận dạng cho quản trị</label>
                <input type="text" class=" form-control" name='ma' value="{{old('ma')}}">
                @error('ma') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Mô tả tóm tắt</label>
                <textarea type="text" class="form-control" rows="2" name='explain'>{{old('explain')}}</textarea>
            </div>
            <div class="form-group mb-4">
                <label>Thứ tự xuất hiện</label>
                <input type="number" class=" form-control" name='stt' value="{{old('stt')}}">
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label> <br>
                 <input type="checkbox" name='status' checked="checked" class="form-check-switch">
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
                        @error('image')
                        <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer col-span-12">
                <a type="button" class="btn btn-default" href="{{route('category_property.edit',$categoryproperty_id)}}">Hủy</a>
                <input type="submit" class="btn btn-primary " value="Tạo mới">
            </div>
        </div>

    </form>
</div>
</div>
@endsection
