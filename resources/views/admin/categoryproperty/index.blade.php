@extends('admin.layouts.main')
@section('category')
        <h2 class="intro-y text-lg font-medium mt-10">
            <a href="{{ route('category_property.index')}}">{{ $title}}</a>
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
                {{-- @can('create',App\Models\category_property::class) --}}
                    <a class="btn btn-primary shadow-md mr-2" href="{{ route('category_property.create')}}" >Thêm danh mục</a>
                {{-- @endcan --}}
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
               
            </div>
        </div>
        <div>
            <!-- BEGIN: Data category -->

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr >
                        <th class="text-center whitespace-nowrap text-center">STT</th>
                        <th class="text-center whitespace-nowrap">MÃ</th>
                        <th class="text-center whitespace-nowrap ">TÊN HIỂN THỊ</th>
                        <th class="text-center whitespace-nowrap">DANH MỤC ĐANG CÓ</th>
                        <th class="text-center whitespace-nowrap">THỨ TỰ</th>
                        <th class="text-center whitespace-nowrap w-30">TRẠNG THÁI</th>
                        <th class="text-center whitespace-nowrap ">CHỨC NĂNG</th>
                    </tr>
                    </thead>
                    <tbody class="col-span-12 " id="table1" >
                    @foreach($category_propertys as $key => $category_property)
                        <tr class=" overflow-x-auto scrollbar-hidden get_child" id="{{ $category_property->id }}">
                            <td class="text-center">
                            {{ $key+1 }}
                            </td>
                            <td class="text-center">
                                {{$category_property->ma}} </td>
                            <td class="text-center">
                                 {{$category_property->name}}
                            </td>
                            <td class="text-center">
                                 {{$category_property->detail_property_id}}
                            </td>
                            <td class="text-center">
                                 {{$category_property->stt}}
                            </td>
                            <td>
                                @if($category_property->status == 1)
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td class="w-20">
                                <div class="flex justify-center items-center">
                                    {{-- @can('update',App\Models\Category::class) --}}
                                        <a class="btn btn-sm btn-primary mr-2"
                                           href="{{route('category_property.edit',$category_property->id)}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete',App\Models\Category::class) --}}
                                    <a title="Xóa" data-toggle="modal"
                                       data-value="{{$category_property->id}}"
                                       data-target="#delete-confirmation-modal"
                                       class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                                    </a>
                                    {{-- @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @include('admin.categoryproperty.delete')
        <!-- END: Data category -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"  >

                <ul class="pagination" >

                    <li> {{ $category_propertys->withQueryString()->onEachSide(1)->links('admin.layouts.pagination') }}</li>
                </ul>
            </div>
            <!-- END: Pagination -->
        </div>
@endsection
