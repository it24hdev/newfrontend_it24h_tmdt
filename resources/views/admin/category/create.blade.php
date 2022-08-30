@extends('admin.layouts.main')
@section('category')
 <div class="content">

                <h2 class="intro-y text-lg font-medium mt-10">
                   {{ $title }}
                </h2>
    <div class="form-group">
        <form action="{{ route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-heade">
            </div>
            <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 xl:col-span-6">
            <div class="form-group mb-4">
                <label>Tên danh mục</label>
                <input type="text" class=" form-control" name='name' id="typinginput" value="{{old('name')}}">
                @error('name') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Tên danh mục(ngoại ngữ)</label>
                <input type="text" class=" form-control" name='name2' value="{{old('name2')}}">
            </div>
            <div class="form-group mb-4">
                <label>SLUG</label>
                <textarea type="text" class="form-control" rows="1" id="slugchanged" name='slug'>{{old('slug')}}</textarea>
                @error('slug') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
             <div class="form-group mb-4">
                <label>Icon</label>
                <input type="text" class="form-control" name='icon' value=" {{old('icon')}}">
            </div>
             <div class="form-group mb-4">
                <a type="button" class="btn btn-primary" href="https://fontawesome.com/v5/search" target="_blank">Lấy icon</a>
             </div>
            <div class="form-group mb-4">
                <label>Danh mục cha</label>
                <select name="parent_id"  class="tom-select w-full">
                    <option value="0">Mặc định</option>
                    @foreach ($categorieslv as $val)
                    <option value="{{$val->id}}" class="form-control">
                        @php
                        $str ='';
                        for ($i=0; $i < $val->level; $i++) {
                            echo $str;
                            $str.='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                        }
                        @endphp
                        {{$val->name}}
                    </option>
                    @endforeach

            </select>
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label> <br>
                 <input type="checkbox" name='status' checked="checked" class="form-check-switch">
            </div>
             <div class="form-group mb-4">
                <label>Hiện danh sách sản phẩm lên trang chủ</label> <br>
                 <input type="checkbox" name='show_push_product' checked="checked" class="form-check-switch">
            </div>
            <div class="modal-footer">

                <a type="button" class="btn btn-default" href="{{ route('category.index')}}">Hủy</a>

            <input type="submit" class="btn btn-primary " value="Create">

        </div>
            </div>
            <div class="col-span-12 xl:col-span-6">
            <div class="form-group mb-4">
                <label>Ảnh đại diện danh mục (<span class="text-italic">Danh mục cha</span>)</label><br>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <i data-feather="image" class="w-4 h-4 mr-2"></i>
                    <span class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                    <input name='thumb' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload2">
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
            <div class="form-group mb-4">
                <label>Banner danh mục trang chủ (<span class="italic">Danh mục cha</span>)</label><br>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <i data-feather="image" class="w-4 h-4 mr-2"></i>
                    <span class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                    <input name='banner' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload3">
                </div>
                <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                    <div class="flex flex-wrap px-4 w-full">
                        <div id="dvPreview3">
                            @error('banner')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>

    </form>
</div>
</div>
@endsection
