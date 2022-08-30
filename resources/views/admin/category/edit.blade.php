@extends('admin.layouts.main')
@section('category')
 <div class="content">

                <h2 class="intro-y text-lg font-medium mt-10">
                   {{ $title}}
                </h2>
    <div class="form-group">
        <form action="{{ route('category.update',[$edit->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-heade">
            </div>
            <div class="grid grid-cols-12 gap-x-5">
            <div class="col-span-12 md:col-span-6">
            <div class="form-group mb-4">
                <label>Tên danh mục</label>
                <input type="text" class="form-control" name='name' value="{{old('name') ?? $edit->name}}"  id="typinginput">
               @error('name')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-4">
                <label>Tên danh mục(ngoại ngữ)</label>
                <input type="text" class="form-control" name='name2' value="{{old('name2') ?? $edit->name2}}">

            </div>
            <div class="form-group mb-4">
                <label>SLUG</label>
                <textarea type="text" class="form-control" rows="1" id="slugchanged" name='slug'> {{old('slug') ?? $edit->slug}}</textarea>
                @error('slug')<span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
            </div>
              <div class="form-group mb-4">
                <label>Icon</label>
                <input type="text" class="form-control" name='icon' value=" {{old('icon') ?? $edit->icon}}">
            </div>
             <div class="form-group mb-4">
                <a type="button" class="btn btn-primary" href="https://fontawesome.com/v5/search" target="_blank">Lấy icon</a>
             </div>
            <div class="form-group mb-4">
                <label>Danh mục cha</label>
                    <select name="parent_id"  class="tom-select w-full" >
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
                            @else <option value="0" >Mặc định</option>
                            @endif

                    </select>
            </div>
            <div class="form-group mb-4">
                <label>Trạng thái</label><br>
                 <input type="checkbox" class="form-check-switch" name='status' value="{{$edit->status == true ? '1' : '0'}}" {{$edit->status == true ? 'checked' : ' '}}>
            </div>
            <div class="form-group mb-4">
                <label>Hiện danh sách sản phẩm lên trang chủ</label><br>
                 <input type="checkbox" class="form-check-switch" name='show_push_product' value="{{$edit->show_push_product == true ? '1' : '0'}}" {{$edit->show_push_product == true ? 'checked' : ' '}}>
            </div>
            <div class="modal-footer">

                <a type="button" class="btn btn-default" href="{{ route('category.index')}}">Hủy</a>

                <input type="submit" class="btn btn-primary " value="Cập nhật">
            </div>
            </div>
            <div class="col-span-12 md:col-span-6">
                <label>Ảnh đại diện danh mục (<span class="italic">Danh mục cha</span>)</label><br>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                        class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                    <input name='thumb' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload2" />
                </div>
                <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                <div class="m-2" id="dvPreview2">
                    @if ($edit->thumb === '' || $edit->thumb === 'no-image-product.jpg')
                        <img src="{{ asset('/upload/images/common_img/no-image-product.jpg') }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                    @else
                        <img src="{{ asset('/upload/images/products') . '/' . $edit->thumb }}" style="object-fit: cover; object-position: 50% 0; width: 180px;height: auto;">
                    @endif
                    @error('thumb')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                </div>

                <div class="form-group mb-4">
                    <label>Banner danh mục trang chủ (<span class="italic">Danh mục cha</span>)</label><br>
                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                        <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                            class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                        <input name='banner' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload3" />
                    </div>
                    <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                    <div class="m-2" id="dvPreview3">
                        @if ($edit->banner === '' || $edit->banner === 'no-image-product.jpg')
                            <img src="{{ asset('/upload/images/common_img/no-image-product.jpg') }}" style="object-fit: cover; object-position: 50% 0; width: 180px;height: auto;">
                        @else
                            <img src="{{ asset('/upload/images/products') . '/' . $edit->banner }}" style="object-fit: cover; object-position: 50% 0; width: 180px;height: auto;">
                        @endif
                        @error('banner')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>
                </div>

            </div>

            </div>


    </form>
</div>
</div>
@endsection
