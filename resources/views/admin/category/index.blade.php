@extends('admin.layouts.main')
@section('category')
        <h2 class="intro-y text-lg font-medium mt-10">
            <a href="{{ route('category.index')}}">{{ $title}}</a>
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
                @can('create',App\Models\Category::class)
                    <a class="btn btn-primary shadow-md mr-2" href="{{ route('category.create')}}" >Thêm danh mục</a>
                @endcan
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block mx-auto text-gray-600">
                
                </div>
                <div class="hidden md:block mx-auto text-gray-600">
                     
                </div>
                <form  action="{{ route('category.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                    <select id="limit" name="limit" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3"
                            onchange="this.form.submit()"
                    >
                        <option value="10" {{request()->input('limit') =='10' ? 'selected' : ''}}>10</option>
                        <option value="25" {{request()->input('limit') =='25' ? 'selected' : ''}}>25</option>
                        <option value="35" {{request()->input('limit') =='35' ? 'selected' : ''}}>35</option>
                        <option value="50" {{request()->input('limit') =='50' ? 'selected' : ''}}>50</option>
                    </select>
                    <select id="orderby" name="orderby" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                        <option value="id" {{request()->input('orderby') =='id' ? 'selected' : ''}} >STT</option>
                        <option value="name" {{request()->input('orderby') =='name' ? 'selected' : ''}} >Tên danh mục</option>
                        <option value="parent_id" {{request()->input('orderby') =='parent_id' ? 'selected' : ''}}>Danh mục cha</option>
                        <option value="user_id" {{request()->input('orderby') =='user_id' ? 'selected' : ''}}>Người dùng</option>
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
                        </div></div>
                </form>
            </div>
        </div>
        <div style=" margin-top: 20px;">
        <form action="{{ route('category.import') }}" method="POST" enctype="multipart/form-data" style="
    display: contents;">
            @csrf
            <input type="file" name="file" class="" value="Chọn" style="height: 40px;width: 250px; border-width: 0;">
            <button type="submit" class="btn btn-success" >Import Data</button>
        </form>
        <a class="btn btn-warning" href="{{ route('category.export') }}">Export Data</a>
        </div>
        <div>
            <!-- BEGIN: Data category -->

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2" id="table_categories">
                    <thead>
                    <tr >
                        <th class="whitespace-nowrap text-center">STT</th>
                        <th class="whitespace-nowrap">TÊN DANH MỤC</th>
                        <th class="text-center whitespace-nowrap ">DANH MỤC CHA</th>
                        {{-- <th class="text-center whitespace-nowrap w-30">NGƯỜI DÙNG</th> --}}
                        <th style="display:none;"></th>
                        <th class="text-center whitespace-nowrap w-30">HIỆN DS</th>
                        <th class="text-center whitespace-nowrap w-30">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap ">CHỨC NĂNG</th>
                    </tr>
                    </thead>
                    <tbody class="col-span-12 " id="table1" >
                    @foreach($Categories as $key => $category)
                    @if($category->parent_id == 0)
                        <tr class=" overflow-x-auto scrollbar-hidden get_child" id="{{ $category->id }}">
                            <td class="text-left font-medium ">
                            @php
                                $str ='';
                                for ($i=0; $i < $category->level; $i++) {
                                    echo $str;
                                    $str.='&nbsp';
                                }
                            @endphp
                            {{ $category->id }}
                            </td>
                            <td class="category_name">
                                 @php
                                $str ='';
                                for ($i=0; $i < $category->level; $i++) {
                                    echo $str;
                                    $str.='━';
                                }
                            @endphp
                                {{$category->name}} </td>
                            <td class="text-center">
                                @if ($category->cat_parent)
                                 {{$category->cat_parent->name}}
                                @endif
                            </td>
                            <td>
                                @if($category->show_push_product == '1')
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td style="display:none;">{{$status = $category->status}}</td>
                            <td>
                                @if($status == '1')
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td class="w-20">
                                <div class="flex justify-center items-center">
                                    @can('update',App\Models\Category::class)
                                        <a class="btn btn-sm btn-primary mr-2"
                                           href="{{route('category.edit',['id'=>$category->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                                 
                                        </a>
                                    @endcan
                                    @can('delete',App\Models\Category::class)
                                    <a title="Xóa" data-toggle="modal"
                                       data-value="{{$category->id}}"
                                       data-target="#delete-confirmation-modal"
                                       class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                                    </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @include('admin.category.delete')
        <!-- END: Data category -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"  >

                <ul class="pagination" >

                    {{-- <li> {{ $Category->withQueryString()->onEachSide(1)->links('admin.layouts.pagination') }}</li> --}}
                </ul>
            </div>
            <!-- END: Pagination -->
        </div>
@endsection
@section('js2')
 <script>
        $(document).ready(function() {
           $('tbody').on('click', 'tr.get_child', function () {

            var tr_id = $(this).attr('id');
            // console.log(tr);
            var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    id: tr_id,
                    _token: _token
                };
                $.ajax({
                    url: "{{ route('category.getchild') }}",
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function(data) {
                        if( $("#"+tr_id).hasClass('active')){
                        $(".subid"+tr_id).remove();
                        $("#"+tr_id).removeClass('active');
                        }
                        else{
                        $("#"+tr_id).after(data.html);
                        $("#"+tr_id).addClass('active');
                        }
                    }
                });
        });
       });
    </script>
@endsection
