@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
           <a href="{{ route('recruit.index') }}">{{ $title }}</a>
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('create', App\Models\Recruit::class)
                <a class="btn btn-primary shadow-md mr-2" href="{{ route('recruit.create') }}">Tạo mới</a>
            @endcan
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <form  action="{{ route('recruit.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                    <select id="limit" name="limit" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="10" {{request()->input('limit') =='10' ? 'selected' : ''}}>10</option>
                        <option value="25" {{request()->input('limit') =='25' ? 'selected' : ''}}>25</option>
                        <option value="35" {{request()->input('limit') =='35' ? 'selected' : ''}}>35</option>
                        <option value="50" {{request()->input('limit') =='50' ? 'selected' : ''}}>50</option>
                    </select>
                    <select id="orderby" name="orderby" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="id" {{request()->input('orderby') =='id' ? 'selected' : ''}} >Mã</option>
                        <option value="location" {{request()->input('orderby') =='location' ? 'selected' : ''}} >Khu vực</option>
                        <option value="vacancies" {{request()->input('orderby') =='vacancies' ? 'selected' : ''}}>Vị trí</option>
                        <option value="type" {{request()->input('orderby') =='type' ? 'selected' : ''}}>Phân loại</option>
                        <option value="quantum" {{request()->input('orderby') =='quantum' ? 'selected' : ''}}>Số lượng</option>
                        <option value="incom" {{request()->input('orderby') =='incom' ? 'selected' : ''}}>Thu thập</option>
                        <option value="deadline" {{request()->input('orderby') =='deadline' ? 'selected' : ''}}>Hạn nộp</option>
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
                        <th class="text-center whitespace-nowrap">Mã</th>
                        <th class="text-center whitespace-nowrap">Khu vực</th>
                        <th class="text-center whitespace-nowrap">Vị trí</th>
                        <th class="text-center whitespace-nowrap">Phân loại</th>
                        <th class="text-center whitespace-nowrap">Số lượng</th>
                        <th class="text-center whitespace-nowrap">Thu nhập</th>
                        <th class="text-center whitespace-nowrap">Hạn nộp</th>
                        <th class="text-center whitespace-nowrap">Trạng thái</th>
                        <th class="text-center whitespace-nowrap">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recruits as $recruit)
                        <tr id="{{$recruit->id}}">
                            <td style="padding: 0.25rem 0.25rem !important;">
                                 <div class="font-medium text-center" >{{ $recruit->id }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: center;"> {{ $recruit->location_name }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis; max-height: 70px; text-align: center;"> {{ $recruit->vacancies }} </div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip; width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: center;"> {{$recruit->type}}
                                <div>
                            </td>

                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style=" white-space: nowrap; width: 50px; overflow: hidden; text-overflow: ellipsis; text-align: center;"> {{ number_format($recruit->quantum, 0, '', '.')  }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style=" white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis;"> {{ $recruit->income }}
                                </div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center"> {{ $recruit->deadline }} </div>
                            </td>
                            <td class="w-10" style="padding: 0.25rem 0.25rem !important;">
                                @if ($recruit->status == 0)
                                    <div class="text-theme-6 text-center"> <i data-feather="check-square"
                                            class="w-4 h-4 mr-2"></i></div>
                                @else
                                    <div class="text-theme-9 text-center"> <i data-feather="check-square"
                                            class="w-4 h-4 mr-2"></i></div>
                                @endif
                            </td>
                            <td class="table-report__action w-40" style="padding: 0.25rem 0.25rem !important;">
                                <div class="flex justify-center items-center">
                                    @can('update', App\Models\Recruit::class)
                                        <a href="{{ route('recruit.edit', ['id' => $recruit->id]) }}" title="Chỉnh sửa"
                                            class="btn btn-sm btn-primary mr-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('delete', App\Models\Recruit::class)
                                        <a title="Xóa" data-toggle="modal" data-value="{{ $recruit->id }}"
                                            data-target="#delete-confirmation-modal"
                                            class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can" style="padding: 1px"></i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        {{-- @include('admin.products.view') --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! $recruits->links('admin.layouts.pagination') !!}
        </div>
        <!-- END: Pagination -->
    </div>
    @include('admin.recruit.delete')
@endsection