@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
           <a href="{{ route('recruit_register.index') }}">{{ $title }}</a>
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <form  action="{{ route('recruit_register.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                    <select id="limit" name="limit" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="10" {{request()->input('limit') =='10' ? 'selected' : ''}}>10</option>
                        <option value="25" {{request()->input('limit') =='25' ? 'selected' : ''}}>25</option>
                        <option value="35" {{request()->input('limit') =='35' ? 'selected' : ''}}>35</option>
                        <option value="50" {{request()->input('limit') =='50' ? 'selected' : ''}}>50</option>
                    </select>
                    <select id="orderby" name="orderby" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="id" {{request()->input('orderby') =='id' ? 'selected' : ''}} >Mã</option>
                        <option value="first_name" {{request()->input('orderby') =='first_name' ? 'selected' : ''}} >Họ tên</option>
                        <option value="phone_number" {{request()->input('orderby') =='phone_number' ? 'selected' : ''}}>Số điện thoại</option>
                        <option value="vitriungtuyen" {{request()->input('orderby') =='vitriungtuyen' ? 'selected' : ''}}>Vị trí ứng tuyển</option>
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
                        <th class="text-center whitespace-nowrap">Họ và tên</th>
                        <th class="text-center whitespace-nowrap">Vị trí ứng tuyển</th>
                        <th class="text-center whitespace-nowrap">Số điện thoại</th>
                        <th class="text-center whitespace-nowrap">Email</th>
                        <th class="text-center whitespace-nowrap">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Recruit_registers as $Recruit_register)
                        <tr id="{{$Recruit_register->id}}">
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview-{{ $Recruit_register->id }}"title="Chi tiết">
                                 <div class="font-medium text-center" >{{ $Recruit_register->id }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: center; min-height: 40px; padding-top: 10px;"> {{ $Recruit_register->first_name }}</div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip;width: 120px;text-overflow: ellipsis; max-height: 70px; text-align: center; min-height: 40px; padding-top: 10px;"> {{ $Recruit_register->vitriungtuyen }} </div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip; width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: center; min-height: 40px; padding-top: 10px;"> {{$Recruit_register->phone_number}}
                                <div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style="overflow-y: hidden;overflow-x: clip; width: 120px;text-overflow: ellipsis;max-height: 70px; text-align: center; min-height: 40px; padding-top: 10px;"> {{$Recruit_register->email}}
                                <div>
                            </td>
                            <td style="padding: 0.25rem 0.25rem !important;">
                                <div class="font-medium text-center" style=" white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis;  text-align: center; min-height: 40px; padding-top: 10px;">
                                 @if($Recruit_register->status == 0) <div class="text-theme-10 text-center">Chờ duyệt</div>
                                 @elseif($Recruit_register->status == 1) <div class="text-theme-12 text-center">Duyệt</div>
                                 @elseif($Recruit_register->status == 2) <div class="text-theme-9 text-center">Hoàn thành</div>
                                 @else <div class="text-theme-6 text-center"> Hủy</div>
                                 @endif
                             </div>
                            </td>
                        </tr>
                        @include('admin.Recruit_register.view')
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {!! $Recruit_registers->links('admin.layouts.pagination') !!}
        </div>
        <!-- END: Pagination -->
    </div>
@endsection