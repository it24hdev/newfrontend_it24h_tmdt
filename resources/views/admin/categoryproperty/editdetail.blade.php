@extends('admin.layouts.main')
@section('category')
 <div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">{{ $title }}</h2>
    <div class="form-group">
        <form action="{{ route('detailproperty.update',[$id_detailproperty])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 xl:col-span-6">
            <input type="text" style="display: none;" name='id' value="{{ $id_categoryproperty}}">
            <div class="form-group mb-4">
                <label>Tên thuộc tính</label>
                <input type="text" class=" form-control" name='name' value="{{old('name') ?? $detail_property->name}}">
                @error('name') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Mô tả tóm tắt</label>
                <textarea type="text" class="form-control" rows="2" name='explain'>{{old('explain') ?? $detail_property->explain}}</textarea>
            </div>
            <div class="form-group mb-4">
                <label>Thứ tự hiển thị</label>
                <input type="number" class=" form-control" name='stt' value="{{old('stt') ?? $detail_property->stt}}">
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label> <br>
                 <input type="checkbox" name='status' checked="checked" class="form-check-switch">
            </div>
            <div class="modal-footer">
            <a type="button" class="btn btn-default" href="{{route('category_property.edit',[$id_categoryproperty])}}">Hủy</a>
            <input type="submit" class="btn btn-primary" value="Lưu">
            </div>
            </div>
            <div class="col-span-12 xl:col-span-6">
            </div>
        </div>
    </form>
</div>
</div>
@endsection
