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
            <form method="get" action="{{url()->current()}}" class="w-1/4 flex">
            <select name="select_menu" id="select_menu" class="form-select mr-4">
                <option selected="selected" value="0">Chọn menu</option>
                @foreach($listmenu as $key => $value)
                    <option value="{{$value->id}}" @if(request()->input('select_menu') == $value->id) selected="selected" @endif>{{ $value->name }}</option>
                @endforeach
            </select>
                <input type="submit" class="btn btn-primary" value="Chọn">
            </form>
            <form method="get" action="{{route('menu.destroymenu')}}">
                <input type="hidden" value="{{request()->input('select_menu')}}" name="id_menu" class="btn btn-primary form-control ml-4 w-16">
                <input type="submit" value="Xóa" class="btn btn-primary destroymenu form-control ml-4 w-16">
            </form>
            <div class="dropdown">
                <a id="add_menu" get-id-menu="{{request()->input('select_menu')}}" class="btn btn-primary form-control ml-4 w-32" href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" title="Thêm mới"> <span> Thêm mục mới</span></a>
            </div>
            <div class="hidden md:block mx-auto text-gray-600">
                <form method="get" action="{{route('menu.addnewmenu')}}" class="flex">
                    <input name="new_menu" placeholder="Tên menu" class="form-control mr-4">
                    <input type="submit" class="btn btn-primary" value="Tạo mới">
                </form>
            </div>
            <div class="hidden md:block mx-auto text-gray-600"></div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="hidden md:block mx-auto text-gray-600"></div>
        </div>
    </div>
    @include('admin.menu.create')
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible bg-white">
        <table class="table">
            <thead class="border-b">
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
                        <td class="text-left">
                            @if(!empty($menu->link))<a href="{{$menu->link}}" title="Xem trên web">Xem trên web</a>
                            @else Chưa có link
                            @endif

                        </td>
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
                                       href="{{route('menu.edit',['id'=>$menu->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
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
                    var id_menu = $(this).attr('get-id-menu');
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    var data = {
                        id_menu: id_menu,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_location_menu')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listmenu, function (key, value) {
                                str ='━ ';
                                str = str.repeat(value.depth)
                                $("select[name='parent']").append(
                                    "<option value=" + value.id + ">" + str +value.label + "</option>"
                                );
                            });
                        }
                    });
                    $(this).addClass('loaded');
                };
            })
            $(document).on('change','.type_menu', function (){
                var type_menu =  $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $('#link_web').val("");
                if(type_menu == 1){
                    $("#link_web").attr('readonly', true);
                    // $('select[name="property"]').val('0');
                    $(".categories_product").removeClass('hidden');
                    $(".filter_by").removeClass('hidden');
                    if($(".categories_post").hasClass('hidden')==false){
                        $(".categories_post").addClass('hidden');
                    }
                    if($(".post").hasClass('hidden')==false){
                        $(".post").addClass('hidden');
                    }
                    if($(".categories_product").hasClass('loaded')==false) {
                        $.ajax({
                            url: "{{route('get_categories_product')}}",
                            data: data,
                            method: "POST",
                            dataType: "json",
                            success: function (data) {
                                $.each(data.listcategory, function (key, value) {
                                    str ='━ ';
                                    str = str.repeat(value.level-1);
                                    $("select[name='categories_product']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                });
                            }
                        });
                        $(".categories_product").addClass('loaded');
                    };
                }
                else if(type_menu == 2){
                    $("#link_web").attr('readonly', true);
                    if($(".categories_product").hasClass('hidden')==false){
                        $(".categories_product").addClass('hidden');
                    }
                    if($(".filter_by").hasClass('hidden')==false){
                        $(".filter_by").addClass('hidden');
                    }
                    if($(".filter_value").hasClass('hidden')==false){
                        $(".filter_value").addClass('hidden');
                    }
                    if($(".post").hasClass('hidden')==false){
                        $(".post").addClass('hidden');
                    }
                    $(".categories_post").removeClass('hidden');
                    if($(".categories_post").hasClass('loaded')==false) {
                        $.ajax({
                            url: "{{route('get_categories_post')}}",
                            data: data,
                            method: "POST",
                            dataType: "json",
                            success: function (data) {
                                $.each(data.listcategory, function (key, value) {
                                    str ='━ ';
                                    str = str.repeat(value.level-1);
                                    $("select[name='categories_post']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                });
                            }
                        });
                        $(".categories_post").addClass('loaded');
                    };
                }
                else if(type_menu == 3) {
                    $("#link_web").attr('readonly', true);
                    if ($(".categories_product").hasClass('hidden') == false) {
                        $(".categories_product").addClass('hidden');
                    }
                    if ($(".filter_by").hasClass('hidden') == false) {
                        $(".filter_by").addClass('hidden');
                    }
                    if ($(".filter_value").hasClass('hidden') == false) {
                        $(".filter_value").addClass('hidden');
                    }
                    if ($(".categories_post").hasClass('hidden') == false) {
                        $(".categories_post").addClass('hidden');
                    }
                    $(".post").removeClass('hidden');
                    if($(".post").hasClass('loaded')==false) {
                        $.ajax({
                            url: "{{route('get_post')}}",
                            data: data,
                            method: "POST",
                            dataType: "json",
                            success: function (data) {
                                $.each(data.listpost, function (key, value) {
                                    $("select[name='post']").append(
                                        "<option get-slug=" + value.slug +" value=" + value.id + ">" + value.title + "</option>"
                                    );
                                });
                            }
                        });
                        $(".post").addClass('loaded');
                    };
                }
                else{
                    $("#link_web").attr('readonly', false);
                    if ($(".categories_product").hasClass('hidden') == false) {
                        $(".categories_product").addClass('hidden');
                    }
                    if ($(".filter_by").hasClass('hidden') == false) {
                        $(".filter_by").addClass('hidden');
                    }
                    if ($(".filter_value").hasClass('hidden') == false) {
                        $(".filter_value").addClass('hidden');
                    }
                    if ($(".categories_post").hasClass('hidden') == false) {
                        $(".categories_post").addClass('hidden');
                    }
                    if ($(".post").hasClass('hidden') == false) {
                        $(".post").addClass('hidden');
                    }
                }
            });
            $(document).on('change','.filter_by', function (){
                var filter_by = $("#filter_by").val();
                var cat_id = $(".cat_product").val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                $('#link_web').val("");
                var slug = $(".cat_product option:selected").attr('get-slug');
                var url =   "{{route('product_cat',['slug' => '_url_'])}}";
                if(typeof slug === "undefined"){
                    url = url.replace('_url_', '');
                }
                else{
                    url = url.replace('_url_', slug);
                }
                $('#link_web').val(url);
                if(filter_by==1){
                    $(".filter_value").removeClass('hidden');
                    $(".property").removeClass('hidden');
                    $(".detailproperty").removeClass('hidden');
                    if ($(".price").hasClass('hidden') == false) {
                        $(".price").addClass('hidden');
                    }
                    if ($(".brand").hasClass('hidden') == false) {
                        $(".brand").addClass('hidden');
                    }
                    $("select[name='property']").empty().append('<option selected="selected" value="0">Thuộc tính</option>');
                    $("select[name='detailproperty']").empty().append('<option selected="selected" value="0">Chi tiết</option>');
                    var data = {
                        cat_id: cat_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_property')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listproperty, function (key, value) {
                                $("select[name='property']").append(
                                    "<option get-code=" + value.ma +" value=" + value.categoryproperties_id + ">" + value.name + "</option>"
                                );
                            });
                        }
                    });
                }
                else if(filter_by==2){
                    $(".filter_value").removeClass('hidden');
                    $(".price").removeClass('hidden');
                    if ($(".detailproperty").hasClass('hidden') == false) {
                        $(".detailproperty").addClass('hidden');
                    }
                    if ($(".property").hasClass('hidden') == false) {
                        $(".property").addClass('hidden');
                    }
                    if ($(".brand").hasClass('hidden') == false) {
                        $(".brand").addClass('hidden');
                    }
                }
                else if(filter_by==3){
                    $(".filter_value").removeClass('hidden');
                    $(".brand").removeClass('hidden');
                    if ($(".detailproperty").hasClass('hidden') == false) {
                        $(".detailproperty").addClass('hidden');
                    }
                    if ($(".property").hasClass('hidden') == false) {
                        $(".property").addClass('hidden');
                    }
                    if ($(".price").hasClass('hidden') == false) {
                        $(".price").addClass('hidden');
                    }
                    var data = {
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_brand')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listbrand, function (key, value) {
                                $("select[name='brand']").append(
                                    "<option value=" + value.name + ">" + value.name + "</option>"
                                );
                            });
                        }
                    });
                }
                else{
                    if ($(".filter_value").hasClass('hidden') == false) {
                        $(".filter_value").addClass('hidden');
                    }
                    if ($(".property").hasClass('hidden') == false) {
                        $(".property").addClass('hidden');
                    }
                    if ($(".detailproperty").hasClass('hidden') == false) {
                        $(".detailproperty").addClass('hidden');
                    }
                    if ($(".price").hasClass('hidden') == false) {
                        $(".price").addClass('hidden');
                    }
                    if ($(".brand").hasClass('hidden') == false) {
                        $(".brand").addClass('hidden');
                    }
                    $('#price_from').val("");
                    $('#price_to').val("");
                }
            });
            $(document).on('change','.cat_product', function (){
                var cat_id = $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                if(cat_id != 0){
                    $('#link_web').val("");
                    var slug = $('option:selected', this).attr('get-slug');
                    var url =   "{{route('product_cat',['slug' => '_url_'])}}";
                    url = url.replace('_url_', slug);
                    $('#link_web').val(url);
                    $("select[name='property']").empty().append('<option selected="selected" value="0">Thuộc tính</option>');
                    $("select[name='detailproperty']").empty().append('<option selected="selected" value="0">Chi tiết</option>');
                    var data = {
                        cat_id: cat_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_property')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listproperty, function (key, value) {
                                $("select[name='property']").append(
                                    "<option get-code=" + value.ma +"  value=" + value.categoryproperties_id + ">" + value.name + "</option>"
                                );
                            });
                        }
                    });
                }
                else{
                    $('#link_web').val("");
                    $("select[name='property']").empty().append('<option selected="selected" value="0">Thuộc tính</option>');
                    $("select[name='detailproperty']").empty().append('<option selected="selected" value="0">Chi tiết</option>');
                }
            });

            $(document).on('change','.post_single', function (){
                $('#link_web').val("");
                var slug = $(".post_single option:selected").attr('get-slug');
                var url =   "{{route('singlePost',['slug' => '_url_'])}}";
                url = url.replace('_url_', slug);
                $('#link_web').val(url);
            });

            $(document).on('change','.cat_post', function (){
                $('#link_web').val("");
                var slug = $(".cat_post option:selected").attr('get-slug');
                var url =   "{{route('categoryBlog',['slug' => '_url_'])}}";
                url = url.replace('_url_', slug);
                $('#link_web').val(url);
            });
            $(document).on('change','.attributes', function (){
                var attr_id =  $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                if(attr_id !=0){
                    $("select[name='detailproperty']").empty().append('<option selected="selected" value="0">Chi tiết</option>');
                    var data = {
                        attr_id: attr_id,
                        _token: _token
                    };
                    $.ajax({
                        url: "{{route('get_detail_property')}}",
                        data: data,
                        method: "POST",
                        dataType: "json",
                        success: function (data) {
                            $.each(data.listdetailproperty, function (key, value) {
                                $("select[name='detailproperty']").append(
                                    "<option get-code=" + value.ma +" value=" + value.ma + ">" + value.name + "</option>"
                                );
                            });
                        }
                    });
                }
                else{
                    $("select[name='detailproperty']").empty().append('<option selected="selected" value="0">Chi tiết</option>');
                }
            });
            $(document).on('change','.detail_attr', function (){
                var detail_attr_id = $(this).val();
                var detail_attr_code = $("option:selected", this).attr('get-code');
                var filter_name = $(".attributes option:selected").attr('get-code');
                $('#link_web').val("");
                var slug = $(".cat_product option:selected").attr('get-slug');
                var url =   "{{route('product_cat',['slug' => '_url_'])}}";
                url = url.replace('_url_', slug);
                console.log(url);
                if(detail_attr_id !=0){
                    url =  $.trim(url,'/')+"?"+filter_name+"="+detail_attr_code;
                }
                $('#link_web').val(url);
            });

            $(document).on('change','#price_from, #price_to', function (){
                var price_from = $("#price_from").val();
                var price_to = $("#price_to").val();
                if(price_from == ''){
                    price_from = 0;
                }
                if(price_to == ''){
                    price_to = 0;
                }
                $('#link_web').val("");
                var url =   "{{route('product_cat',['slug' => '_url_'])}}";
                var slug = $(".cat_product option:selected").attr('get-slug');
                if(typeof slug === "undefined"){
                    url = url.replace('_url_', '');
                }
                else{
                    url = url.replace('_url_', slug);
                    url =  $.trim(url,'/')+"?p="+price_from+"%3B"+price_to;
                }
                $('#link_web').val(url);
            });

            $(document).on('change','#brand', function (){
                var brand =  $(this).val();
                $('#link_web').val("");
                var url =   "{{route('product_cat',['slug' => '_url_'])}}";
                var slug = $(".cat_product option:selected").attr('get-slug');
                if(typeof slug === "undefined"){
                    url = url.replace('_url_', '');
                }
                else{
                    url = url.replace('_url_', slug);
                    url =  $.trim(url,'/')+"?brand="+brand;
                }
                $('#link_web').val(url);

            });

            $(document).on('click','.destroymenu', function (){
                var id_menu = $("#select_menu option:selected").val()
                console.log(id_menu);
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    id_menu: id_menu,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('menu.destroymenu')}}",
                    data: data,
                    method: "get",
                    dataType: "json",
                    success: function (data) {
                    }
                });
            });
        });
    </script>
@endsection
