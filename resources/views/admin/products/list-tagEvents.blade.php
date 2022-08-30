@extends('admin.layouts.main')
@section('css')
    <style>
        p.event{
            border-radius: 20px;
            display: inline-block;
            font-size: 0;
            overflow: hidden;
            max-width: 100%;
            padding-right: 8px;
            text-transform: uppercase;
            font-size: 12px;
            margin-bottom: 0;
        }
        .event img{
            width: 100%;
            overflow: hidden;
            height: auto;
            float: left;
            max-width: 20px;
        }
        .event span{
            color: #fff;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            font-size: 10px;
            line-height: 13px;
            margin-left: 3px;
            overflow: hidden;
            padding: 4px 0 0 3px;
            text-transform: uppercase;
        }
        .event p{
            margin-bottom: 0;
        }
    </style>
@endsection
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <a href="{{ route('products.list_attr') }}" class="text-lg font-medium mr-auto uppercase">
        Danh sách Tag ưu đãi sản phẩm
    </a>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        @can('create', App\Models\Products::class)
        <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary">Thêm tag ưu đãi</a>
        @endcan
    </div>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6">

    <div class="intro-y box p-5 mt-5 overflow-x-auto col-span-12 md:col-span-6">
        <table class="table">
            <thead>
                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Tiêu đề</th>
                    <th class="whitespace-nowrap">Ảnh</th>
                    <th class="whitespace-nowrap">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t = 0;
                @endphp
                @foreach ($tags as $tag)
                    @php
                        $t++;
                    @endphp
                    <tr id="html-attr-{{ $tag->id }}">
                        <td class="border-b dark:border-dark-5">{{ $t }}</td>
                        <td class="border-b dark:border-dark-5 font-bold">{{ $tag->name }}</td>
                        <td class="border-b dark:border-dark-5">
                            <p class="event" style="background: linear-gradient(to right,{{$tag->color_left}},{{$tag->color_right}});">
                                <img src="{{asset('upload/images/products/thumb/'.$tag->icon)}}" alt="">
                                <span>{{$tag->name}}</span>
                            </p>
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <div class="flex">
                                @can('update', App\Models\Products::class)
                                    <a href="javascript:;" data-toggle="modal"
                                    data-target="#header-footer-modal-preview-{{ $tag->id }}" title="Chỉnh sửa"
                                        class="tooltip btn btn-sm btn-primary mr-2">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- END: Modal Toggle -->
                                    <!-- BEGIN: Modal Content -->
                                    <div id="header-footer-modal-preview-{{ $tag->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                <!-- BEGIN: Modal Header -->
                                                <form action="{{route('products.update_tag-event')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h2 class="text-lg uppercase font-medium text-base mr-auto">Chỉnh sửa Tag ưu đãi</h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12">
                                                            <label for="modal-form-6" class="form-label font-medium">Tiêu đề</label>
                                                            <input type="text" name="name" value="{{$tag->name}}" class="form-control">
                                                        </div>
                                                        <div class="col-span-12">
                                                            <label for="modal-form-2" class="form-label font-medium">Ảnh icon</label>
                                                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                                                <input name='icon' type="file" class="w-10 h-10 top-0 left-0 absolute opacity-0 fileupload2"/>
                                                            </div>
                                                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                                                            <div class="m-2 dvPreview2">
                                                                @if ($tag->icon === '' || $tag->icon === 'no-images.jpg')
                                                                    <img src="{{ asset('/upload/images/common_img/no-images.jpg') }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                                                @else
                                                                    <img src="{{ asset('/upload/images/products/thumb') . '/' . $tag->icon }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                                                @endif
                                                                @error('icon')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-span-12 change-color">
                                                            <label class="form-label mr-2 font-medium">Nền màu bên trái</label>
                                                            <input type="color" class="w-16 h-16 rounded-xl" name="color_left" value="{{$tag->color_left}}">
                                                        </div>
                                                        <div class="col-span-12 change-color">
                                                            <label class="form-label mr-2 font-medium">Nền màu bên phải</label>
                                                            <input type="color" class="w-16 h-16 rounded-xl" name="color_right" value="{{$tag->color_right}}">
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$tag->id}}">
                                                    </div> <!-- END: Modal Body -->
                                                    <!-- BEGIN: Modal Footer -->
                                                    <div class="modal-footer text-right"> <button type="button" data-dismiss="modal"
                                                            class="btn btn-outline-secondary w-20 mr-1">Hủy</button>
                                                            @can('update', App\Models\Role::class)
                                                            <button type="submit" class="btn btn-primary">Chỉnh
                                                                sửa</button>
                                                            @endcan
                                                    </div>
                                                </form>
                                                <!-- END: Modal Footer -->
                                            </div>
                                        </div>
                                    </div> <!-- END: Modal Content -->
                                @endcan
                                @can('delete', App\Models\Products::class)
                                    <a href="javascript:;" title="Xóa" data-toggle="modal"
                                        data-target="#delete-modal-preview-{{ $tag->id }}"
                                        class="tooltip btn btn-danger py-1 px-2"><i class="fa-solid fa-trash-can"
                                            style="padding: 1px"></i></a>
                                    <div id="delete-modal-preview-{{ $tag->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="p-5 text-center"> <i data-feather="x-circle"
                                                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">Xóa thẻ Tag này!</div>
                                                        <div class="text-gray-600 mt-2">Bạn có chắc muốn xóa thẻ Tag này?</div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center"> <button type="button"
                                                            data-dismiss="modal"
                                                            class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                                        <button type="button" data-dismiss="modal"
                                                            data-attr_id="{{ $tag->id }}"
                                                            class="delete-attr btn btn-danger w-24">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- Modal create attribute product --}}
@can('create', App\Models\Products::class)
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Thêm thẻ Tag ưu đãi sản phẩm</h2>
            </div>
            <form action="{{route('products.store_tag-event')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="modal-form" class="form-label font-medium">Tiêu đề</label>
                        <input id="modal-form" type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-span-12">
                        <label class="form-label mr-2 font-medium">Ảnh icon</label>
                        <input type="file" name="icon" class="form-control mb-1" required>
                        @error('icon')
                            <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-span-12 change-color">
                        <label class="form-label mr-2 font-medium">Nền màu bên trái</label>
                        <input type="color" class="w-16 h-16 rounded-xl" name="color_left" required>
                    </div>
                    <div class="col-span-12 change-color">
                        <label class="form-label mr-2 font-medium">Nền màu bên phải</label>
                        <input type="color" class="w-16 h-16 rounded-xl" name="color_right" required>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Hủy</button>
                    <button type="submit" class="btn btn-primary w-20">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('js')
    <script>
        $('.delete-attr').click(function() {
                var id = $(this).data('attr_id');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: "{{ route('products.delete_tag-event') }}",
                    method: "POST",
                    data: data,
                    success: function(data) {
                        $('#html-attr-' + id).remove();
                    }
                });
            });
    </script>
@endsection
