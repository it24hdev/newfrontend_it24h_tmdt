@extends('admin.layouts.main')
@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        <a href="{{ route('menu.index')}}">{{ $title}}</a>
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
            <a id="add_menu" class="btn btn-primary shadow-md mr-2" href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" title="Thêm mới">Thêm mới</a>
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
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="hidden md:block mx-auto text-gray-600"></div>
        </div>
    </div>
    @include('admin.menu.create')
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table">
            <thead>
            <tr >
                <th class="whitespace-nowrap">Tên hiển thị</th>
                <th class="whitespace-nowrap">Link web</th>
                <th class="whitespace-nowrap">STT</th>
                <th class="whitespace-nowrap">Trạng thái</th>
                <th class="whitespace-nowrap">Chức năng</th>
            </tr>
            </thead>
            <tbody class="col-span-12" >
            @foreach($menus as $key => $menu)
                @if($menu->parent==0)
                    <tr id="{{$menu->id}}" class="overflow-x-auto scrollbar-hidden border-separate" @if($menu->parent != 0) style="display: none;" @endif>
                        <td class="text-left  rowparent parent_{{$menu->parent}}" get-id="{{$menu->id}}">
                            @php
                                $str ='';
                                for ($i=0; $i < $menu->depth; $i++) {
                                    $str.='━ ';
                                    echo $str;
                                }
                            @endphp
                            {{$menu->label}}
                        </td>
                        <td class="text-left">{{$menu->link}}</td>
                        <td class="text-left">
                        <input class="td_stt w-10 text-center" type="number" name="stt" value="{{$menu->stt}}" get-id="{{$menu->id}}">
                        </td>
                        <td>
                            @if($menu->status == '1')
                                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                            @else
                                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                            @endif
                        </td>
                        <td class="w-20">
                            <div class="flex justify-center items-center">
                                    <a class="btn btn-sm btn-primary mr-2"
                                       href="#" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a title="Xóa" data-toggle="modal"
                                       data-value="{{$menu->id}}"
                                       data-target="#delete-confirmation-modal"
                                       class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                                    </a>
                            </div>
                        </td>
                    </tr>
                    @endif
            @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.menu.delete')
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click','.rowparent' ,function (){
                var get_id= $(this).attr('get-id');
                if($(this).parent().hasClass('loaded')==false){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        id: get_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_menuitem_ajax')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function(data){
                            $('#'+get_id).after(data.html);
                        }
                    })
                    $(this).parent().addClass('loaded');
                }
                if($(this).parent().hasClass('active')){
                    var parent_id = ".parent_"+get_id;
                    $(parent_id).each(function (){
                        $(this).parent().css('display','none');
                    });
                    $(this).parent().removeClass('active')
                }
                else{
                    var parent_id = ".parent_"+get_id;
                    $(parent_id).each(function (){
                        $(this).parent().css('display','table-row');
                    });
                    $(this).parent().addClass('active')
                }
            });
           $(document).on('change','.td_stt', function (){
               var id = $(this).attr('get-id');
               var val = $(this).val();
               var _token = $('meta[name="csrf-token"]').attr('content');
               var data = {
                   id: id,
                   val: val,
                   _token: _token
               };
               $.ajax({
                   url: "{{route('change_number_menuitem')}}",
                   data: data,
                   method: "POST",
                   dataType: "json",
                   success: function(data){
                    if(data.success){
                        alert(data.success);
                    }
                    else{
                        alert(data.error)
                    }
                   }
               })
           })
            $(document).on('click','#add_menu', function (){
                if($(this).hasClass('loaded')==false) {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_menu')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listmenu, function (key, value) {
                                $("select[name='parent']").append(
                                    "<option value=" + value.id + ">" + value.label + "</option>"
                                );
                            });
                            $.each(data.listcategory, function (key, value) {
                                $("select[name='category_id']").append(
                                    "<option value=" + value.id + ">" + value.name + "</option>"
                                );
                            });
                        }
                    });
                    $(this).addClass('loaded');
                };
            })

        });
    </script>
@endsection
