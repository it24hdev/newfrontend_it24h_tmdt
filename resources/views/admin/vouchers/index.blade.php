@extends('admin.layouts.main')
@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        <a href="{{ route('vouchers.index')}}">{{ $title}}</a>
    </h2>
    @if ($errors->any())
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="alert alert-danger alert-dismissible show">
                    @foreach($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a class="btn btn-primary mr-2" href="javascript:;" data-toggle="modal" data-target="#add_new_voucher" >
                <span> Thêm voucher</span>
            </a>
            <form  action="{{ route('vouchers.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <div class="sm:w-42 2xl:w-full mt-2 sm:mt-0 sm:w-auto box">
                    <div class="w-full relative text-gray-700 dark:text-gray-300">
                        <input type="text" name="search" class="form-control w-full box pr-10 placeholder-theme-13" placeholder="Tìm kiếm..." value="{{request()->input('keywords')}}">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
        <!-- BEGIN: Data category -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="table_categories">
                <thead>
                <tr >
                    <th class="text-center whitespace-nowrap">ID</th>
                    <th class="text-center whitespace-nowrap">MÃ VOUCHER</th>
                    <th class="text-center whitespace-nowrap">TÊN VOUCHER</th>
                    <th class="text-center whitespace-nowrap">MÔ TẢ</th>
                    <th class="text-center whitespace-nowrap">GIÁ TRỊ TIỀN</th>
                    <th class="text-center whitespace-nowrap">GIÁ TRỊ PT(%)</th>
                    <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                    <th class="text-center whitespace-nowrap">CHỨC NĂNG</th>
                </tr>
                </thead>
                <tbody class="col-span-12 " id="table1" >
                @foreach($vouchers as $key => $voucher)
                        <tr class=" overflow-x-auto scrollbar-hidden" id="{{ $voucher->id }}">
                            <td class="text-center">
                                {{ $voucher->id }}
                            </td>
                            <td class="text-center">
                                {{$voucher->code}}
                            </td>
                            <td class="text-left">
                                {{$voucher->name}}
                            </td>
                            <td class="text-left">
                                {{$voucher->describe}}
                            </td>
                            <td class="text-right">
                                {{ number_format($voucher->value, 0, '', '.')  }}
                            </td>
                            <td class="text-right">
                                {{$voucher->percent}}
                            </td>
                            <td>
                                @if($voucher->status == 1)
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td class="w-20">
                                <div class="flex justify-center items-center">
                                        <a class="btn btn-sm btn-primary mr-2">
{{--                                           href="{{route('vouchers.edit',['id' => $vouchers->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>--}}
                                        </a>
                                        <a title="Xóa" data-toggle="modal"
                                           data-value="{{$voucher->id}}"
                                           data-target="#delete-confirmation-modal"
                                           class="btn btn-danger py-1 px-2 btn-delete">
                                            <i class="fa-solid fa-trash-can p-1"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.vouchers.delete')
        @include('admin.vouchers.create')
        <!-- END: Data category -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"  >
            <ul class="pagination" >
                <li> {{ $vouchers->withQueryString()->onEachSide(1)->links('admin.layouts.pagination') }}</li>
            </ul>
        </div>
        <!-- END: Pagination -->
    </div>
@endsection
