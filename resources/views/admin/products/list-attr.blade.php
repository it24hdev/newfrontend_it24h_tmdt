@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <a href="{{ route('products.list_attr') }}" class="text-lg font-medium mr-auto uppercase">
        Danh sách thuộc tính sản phẩm
    </a>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        @can('create', App\Models\Products::class)
        <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" class="btn btn-primary">Thêm thuộc tính</a>
        @endcan
    </div>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6">

    <div class="intro-y box p-5 mt-5 overflow-x-auto col-span-12 md:col-span-6">
        <h3 class="text-xl mb-7">Danh sách màu</h3>
        <table class="table">
            <thead>
                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Tên Màu</th>
                    <th class="whitespace-nowrap">Mô tả</th>
                    <th class="whitespace-nowrap">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t = 0;
                @endphp
                @foreach ($colors as $color)
                    @php
                        $t++;
                    @endphp
                    <tr id="html-attr-{{ $color->id }}">
                        <td class="border-b dark:border-dark-5">{{ $t }}</td>
                        <td class="border-b dark:border-dark-5 font-bold">{{ $color->name }}</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="box-color w-16 h-8 rounded" style="background-color: {{$color->color}};">
                            </div>
                        </td>
                        <td class="border-b dark:border-dark-5">
                            <div class="flex">
                                @can('update', App\Models\Products::class)
                                    <a href="javascript:;" data-toggle="modal"
                                    data-target="#header-footer-modal-preview-{{ $color->id }}" title="Chỉnh sửa"
                                        class="tooltip btn btn-sm btn-primary mr-2">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- END: Modal Toggle -->
                                    <!-- BEGIN: Modal Content -->
                                    <div id="header-footer-modal-preview-{{ $color->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                <!-- BEGIN: Modal Header -->
                                                <form action="{{route('products.update_attr')}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h2 class="text-lg uppercase font-medium text-base mr-auto">Chỉnh sửa thuộc tính</h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12">
                                                            <label for="modal-form-6" class="form-label font-medium">Loại thuộc tính</label>
                                                            <input type="text" value="Màu" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-span-12">
                                                            <label for="modal-form-2" class="form-label font-medium">Tên</label>
                                                            <input id="modal-form-2" type="text" name="name" value="{{$color->name}}" class="form-control" required>
                                                        </div>
                                                        <div class="col-span-12 change-color">
                                                            <label for="modal-form-1" class="form-label mr-2 font-medium">Chọn màu</label>
                                                            <input id="modal-form-1" type="color" class="w-16 h-16 rounded-xl" name="value" value="{{$color->color}}">
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$color->id}}">
                                                        <input type="hidden" name="attr" value="color">
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
                                        data-target="#delete-modal-preview-{{ $color->id }}"
                                        class="tooltip btn btn-danger py-1 px-2"><i class="fa-solid fa-trash-can"
                                            style="padding: 1px"></i></a>
                                    <div id="delete-modal-preview-{{ $color->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="p-5 text-center"> <i data-feather="x-circle"
                                                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">Xóa thuộc tính!</div>
                                                        <div class="text-gray-600 mt-2">Bạn có chắc muốn xóa thuộc tính này</div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center"> <button type="button"
                                                            data-dismiss="modal"
                                                            class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                                        <button type="button" data-dismiss="modal"
                                                            data-attr_id="{{ $color->id }}"
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

    <div class="intro-y box p-5 mt-5 overflow-x-auto col-span-12 md:col-span-6">
        <h3 class="text-xl mb-7">Danh sách size</h3>
        <table class="table">
            <thead>
                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Tên size</th>
                    <th class="whitespace-nowrap">Mô tả</th>
                    <th class="whitespace-nowrap">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $t = 0;
                @endphp
                @foreach ($sizes as $size)
                    @php
                        $t++;
                    @endphp
                    <tr id="html-attr-{{ $size->id }}">
                        <td class="border-b dark:border-dark-5">{{ $t }}</td>
                        <td class="border-b dark:border-dark-5 font-bold">{{ $size->name }}</td>
                        <td class="border-b dark:border-dark-5"></td>
                        <td class="border-b dark:border-dark-5">
                            <div class="flex">
                                @can('update', App\Models\Products::class)
                                    <a href="javascript:;" data-toggle="modal"
                                    data-target="#header-footer-modal-preview-{{ $size->id }}" title="Chỉnh sửa"
                                        class="tooltip btn btn-sm btn-primary mr-2">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- END: Modal Toggle -->
                                    <!-- BEGIN: Modal Content -->
                                    <div id="header-footer-modal-preview-{{ $size->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog" style="width:60%;">
                                            <div class="modal-content">
                                                <!-- BEGIN: Modal Header -->
                                                <form action="{{route('products.update_attr')}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h2 class="text-lg uppercase font-medium text-base mr-auto">Chỉnh sửa thuộc tính</h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                        <div class="col-span-12">
                                                            <label for="modal-form-6" class="form-label font-medium">Loại thuộc tính</label>
                                                            <input type="text" value="Size" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-span-12">
                                                            <label for="modal-form-2" class="form-label font-medium">Tên</label>
                                                            <input id="modal-form-2" type="text" name="name" value="{{$size->name}}" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$size->id}}">
                                                        <input type="hidden" name="attr" value="size">
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
                                        data-target="#delete-modal-preview-{{ $size->id }}"
                                        class="tooltip btn btn-danger py-1 px-2"><i class="fa-solid fa-trash-can"
                                            style="padding: 1px"></i></a>
                                    <div id="delete-modal-preview-{{ $size->id }}" class="modal" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="p-5 text-center"> <i data-feather="x-circle"
                                                            class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                                                        <div class="text-3xl mt-5">Xóa thuộc tính!</div>
                                                        <div class="text-gray-600 mt-2">Bạn có chắc muốn xóa thuộc tính này</div>
                                                    </div>
                                                    <div class="px-5 pb-8 text-center"> <button type="button"
                                                            data-dismiss="modal"
                                                            class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                                                        <button type="button" data-dismiss="modal"
                                                            data-attr_id="{{ $size->id }}"
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
                <h2 class="font-medium text-base mr-auto">Thêm thuộc tính sản phẩm</h2>
            </div>
            <form action="{{route('products.store_attr')}}" method="post">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="modal-form-6" class="form-label font-medium">Loại thuộc tính</label>
                        <select id="modal-form-6" class="tom-select" name="attr">
                            <option value="color">Màu</option>
                            <option value="size">Size</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label for="modal-form-2" class="form-label font-medium">Tên</label>
                        <input id="modal-form-2" type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-span-12 change-color">
                        <label for="modal-form-1" class="form-label mr-2 font-medium">Chọn màu</label>
                        <input id="modal-form-1" type="color" class="w-16 h-16 rounded-xl" name="value">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-20">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('js')
    <script>
        $('.tom-select').change(function(){
            var type = $(this).val();
            if(type == 'color'){
                $('.change-color').css('display', 'block');
            }else{
                $('.change-color').css('display', 'none');
            }
        });
        $('.delete-attr').click(function() {
                var id = $(this).data('attr_id');
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: "{{ route('products.delete_attr') }}",
                    method: "POST",
                    data: data,
                    success: function(data) {
                        $('#html-attr-' + id).remove();
                    }
                });
            });
    </script>
@endsection
