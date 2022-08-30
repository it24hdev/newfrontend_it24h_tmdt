@extends('admin.layouts.main')
@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
           <a href="{{ route('products.index') }}">{{ $title }}</a>
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('create', App\Models\Products::class)
                <a class="btn btn-primary shadow-md mr-2" href="{{ route('products.create') }}">Tạo sản phẩm</a>
            @endcan
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <form  action="{{ route('products.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                    <select id="limit" name="limit" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="10" {{request()->input('limit') =='10' ? 'selected' : ''}}>10</option>
                        <option value="25" {{request()->input('limit') =='25' ? 'selected' : ''}}>25</option>
                        <option value="35" {{request()->input('limit') =='35' ? 'selected' : ''}}>35</option>
                        <option value="50" {{request()->input('limit') =='50' ? 'selected' : ''}}>50</option>
                    </select>
                    <select id="orderby" name="orderby" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="id" {{request()->input('orderby') =='id' ? 'selected' : ''}} >Mã</option>
                        <option value="name" {{request()->input('orderby') =='name' ? 'selected' : ''}} >Tên SP</option>
                        <option value="category_id" {{request()->input('orderby') =='category_id' ? 'selected' : ''}}>Danh mục</option>
                        <option value="brand" {{request()->input('orderby') =='brand' ? 'selected' : ''}}>Nhãn</option>
                        <option value="quantity" {{request()->input('orderby') =='quantity' ? 'selected' : ''}}>Số lượng</option>
                        <option value="price" {{request()->input('orderby') =='price' ? 'selected' : ''}}>Giá</option>
                        <option value="limit_amount" {{request()->input('orderby') =='limit_amount' ? 'selected' : ''}}>Cảnh báo sl tồn</option>
                        <option value="status" {{request()->input('orderby') =='status' ? 'selected' : ''}}>Trạng thái</option>
                    </select>
                    <select id="sort" name="sort" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="asc" {{request()->input('sort') =='asc' ? 'selected' : ''}}>Tăng dần</option>
                        <option value="desc" {{request()->input('sort') =='desc' ? 'selected' : ''}}>Giảm dần</option>
                    </select>
                    <div class="sm:w-42 2xl:w-full mt-2 sm:mt-0 sm:w-auto box">
                        <div class="w-full relative text-gray-700 dark:text-gray-300">
                            <input id="search" type="text" name="keywords" class="form-control w-full box pr-10 placeholder-theme-13" placeholder="Tìm kiếm..." value="{{request()->input('keywords')}}">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2 p-1">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap w-28" style="padding: 0.25rem 0.25rem !important;">Ảnh sản phẩm</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Mã</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Tên</th>
                        <th class="text-center whitespace-nowrap w-24" style="padding: 0.25rem 0.25rem !important;">NCC</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Danh mục</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">SL</th>
                        <th class="text-center whitespace-nowrap w-32" style="padding: 0.25rem 0.25rem !important;">Giá bán</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Tồn kho</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Trạng thái</th>
                        <th class="text-center whitespace-nowrap" style="padding: 0.25rem 0.25rem !important;">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr id="{{ $product->id }}" >


                            <td style="padding: 0.25rem 0.25rem !important;">
                                @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan

                                @if ($product->thumb == \App\Models\Products::IMAGE)
                                    <img src="{{ asset('/upload/images/common_img/') . '/' . $product->thumb }}" style="object-fit: cover; object-position: 50% 0; width: auto;height: auto;">
                                @else
                                    <img src="{{ asset('/upload/images/products/medium') . '/' . $product->thumb }}" style="object-fit: cover; object-position: 50% 0; width: auto;height: auto;">
                                @endif
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                 @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                 <div class="font-medium text-center" >{{ $product->id }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                 @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: left;"> {{ $product->name }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                 @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis;max-height: 70px;">
                                    {{ $product->brand }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip; width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: left;">
                                    @foreach ($product->category as $cat)
                                        {{$cat->name}},
                                    @endforeach
                                <div>
                            </td>

                            <td style="padding: 0.25rem 0.25rem !important;">
                                @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium text-center" style=" white-space: nowrap; width: 50px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ number_format($product->quantity, 0, '', '.')  }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium text-center" style=" white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    {{ number_format($product->price, 0, '', '.') }}
                                </div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                @can('viewAny', \App\Models\Products::class)
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $product->id }}"title="Chi tiết sản phẩm">
                                @endcan
                                <div class="font-medium text-center"> {{ $product->limit_amount }} </div>
                            </td>
                            <td class="w-10" style="padding: 0.25rem 0.25rem !important;">
                                @if ($product->status == 0)
                                    <div class="text-theme-6 text-center"> <i data-feather="check-square"
                                            class="w-4 h-4 mr-2"></i></div>
                                @else
                                    <div class="text-theme-9 text-center"> <i data-feather="check-square"
                                            class="w-4 h-4 mr-2"></i></div>
                                @endif
                            </td>
                            <td class="table-report__action w-40" style="padding: 0.25rem 0.25rem !important;">
                                <div class="flex justify-center items-center">
                                    @can('update', App\Models\Products::class)
                                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" title="Chỉnh sửa"
                                            class="btn btn-sm btn-primary mr-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('delete', App\Models\Products::class)
                                        <a title="Xóa" data-toggle="modal" data-value="{{ $product->id }}"
                                            data-target="#delete-confirmation-modal"
                                            class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can" style="padding: 1px"></i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @include('admin.products.view')
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! $products->links('admin.layouts.pagination') !!}
        </div>
        <!-- END: Pagination -->
    </div>
    @include('admin.products.delete')
@endsection