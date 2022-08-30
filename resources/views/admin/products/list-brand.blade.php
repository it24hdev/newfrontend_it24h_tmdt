@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <a href="{{ route('products.list_attr') }}" class="text-lg font-medium mr-auto uppercase">
        Danh sách thương hiệu sản phẩm
    </a>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        @can('create', App\Models\Products::class)
        <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary">Thêm thương hiệu</a>
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
                    <th class="whitespace-nowrap">Tên thương hiệu</th>
                    <th class="whitespace-nowrap">Ảnh</th>
                    <th class="whitespace-nowrap">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t = 0;
                @endphp
                @foreach ($brands as $brand)
                    @php
                        $t++;
                    @endphp
                    <tr id="html-attr-{{ $brand->id }}">
                        <td class="border-b dark:border-dark-5">{{ $t }}</td>
                        <td class="border-b dark:border-dark-5 font-bold">{{ $brand->name }}</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="rounded">
                                <img src="{{asset('upload/images/products/medium/'.$brand->image)}}" alt="">
                            </div>
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <div class="flex">
                                @can('update', App\Models\Products::class)
                                    <a href="javascript:;" data-toggle="modal"
                                    data-target="#header-footer-modal-preview-{{ $brand->id }}" title="Chỉnh sửa"
                                        class="tooltip btn btn-sm btn-primary mr-2">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- END: Modal Toggle -->
                                    <!-- BEGIN: Modal Content -->
                                    <div id="header-footer-modal-preview-{{ $brand->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                <!-- BEGIN: Modal Header -->
                                                <form action="{{route('products.update_brand')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h2 class="text-lg uppercase font-medium text-base mr-auto">Chỉnh sửa thương hiệu</h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12">
                                                            <label for="modal-form-6" class="form-label font-medium">Tên thương hiệu</label>
                                                            <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                                                        </div>
                                                        <div class="col-span-12">
                                                            <label for="modal-form-2" class="form-label font-medium">Ảnh</label>
                                                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                                <i data-feather="image" class="w-4 h-4 mr-2"></i> <span
                                                                    class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                                                                <input name='image' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0 fileupload2" />
                                                            </div>
                                                            <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                                                            <div class="m-2 dvPreview2">
                                                                @if ($brand->image === '' || $brand->image === 'no-images.jpg')
                                                                    <img src="{{ asset('/upload/images/common_img/no-images.jpg') }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                                                @else
                                                                    <img src="{{ asset('/upload/images/products/medium') . '/' . $brand->image }}" style="object-fit: cover; object-position: 50% 0; width: 300px;height: 300px;">
                                                                @endif
                                                                @error('image')
                                                                    <span style="color:red">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$brand->id}}">
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
                                        data-target="#delete-modal-preview-{{ $brand->id }}"
                                        class="tooltip btn btn-danger py-1 px-2"><i class="fa-solid fa-trash-can"
                                            style="padding: 1px"></i></a>
                                    <div id="delete-modal-preview-{{ $brand->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="p-5 text-center"> <i data-feather="x-circle"
                                                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">Xóa thương hiệu này!</div>
                                                        <div class="text-gray-600 mt-2">Bạn có chắc muốn xóa thương hiệu này</div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center"> <button type="button"
                                                            data-dismiss="modal"
                                                            class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                                        <button type="button" data-dismiss="modal"
                                                            data-attr_id="{{ $brand->id }}"
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
                <h2 class="font-medium text-base mr-auto">Thêm thương hiệu sản phẩm</h2>
            </div>
            <form action="{{route('products.store_brand')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="modal-form-2" class="form-label font-medium">Tên</label>
                        <input id="modal-form-2" type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-span-12 change-color">
                        <label for="modal-form-1" class="form-label mr-2 font-medium">Ảnh thương hiệu</label>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                            <i data-feather="image" class="w-4 h-4 mr-2"></i>
                            <span class="text-theme-1 dark:text-theme-10 mr-1">Upload ảnh</span>
                            <input name='image' type="file" class="w-56 h-56 top-0 left-0 absolute opacity-0" id="fileupload3" required/>

                        </div>
                        <div class="border-2 border-dashed dark:border-dark-5 rounded-md p-2">
                            <div class="flex flex-wrap px-4 w-full">
                                <div id="dvPreview3">
                                    @error('image')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
                    url: "{{ route('products.delete_brand') }}",
                    method: "POST",
                    data: data,
                    success: function(data) {
                        $('#html-attr-' + id).remove();
                    }
                });
            });
    </script>
@endsection
