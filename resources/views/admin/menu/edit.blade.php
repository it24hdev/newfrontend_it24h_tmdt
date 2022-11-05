@extends('admin.layouts.main')
@section('subcontent')
    <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ $title}}
        </h2>
        <div class="form-group">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="menu" value="{{$admin_menu_items->menu}}">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-4">
                            <div class="form-group mb-4">
                                <label>Tên hiển thị</label>
                                <input type="text" class=" form-control" name='label' value="{{old('label') ?? $admin_menu_items->label}}" required>
                            </div>
                            <div class="form-group mb-4">
                                <label>Vị trí</label>
                                <select name="parent" class="form-control parent">
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="form-group mb-4">
                                <label>Mã</label>
                                <input type="text" class=" form-control" name='ma' value="{{old('ma') ?? $admin_menu_items->ma}}">
                                @error('ma') <span style="color: rgb(239 68 68);">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group mb-4">
                                <label>STT</label>
                                <input type="number" class="form-control" name='stt' value="{{old('stt') ?? $admin_menu_items->stt}}">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <div class="form-group mb-4">
                                <label>Icon</label>
                                <div class="flex">
                                    <input type="text" class="form-control" name='class' value=" {{old('class') ?? $admin_menu_items->class}}">
                                    <a type="button" class="btn w-32 btn-primary w-30 ml-6" href="https://fontawesome.com/v5/search" target="_blank">Lấy icon</a>
                                </div>
                            </div>
                            <div class="form-group mb-4 flex-initial">
                                <div class="form-group mb-2"><label>Trạng thái</label> <br>
                                    <input type="checkbox" class="form-check-switch" name='status' value="{{$admin_menu_items->status == true ? '1' : '0'}}" {{$admin_menu_items->status == true ? 'checked' : ' '}}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-5 mt-4">
                        <div class="col-span-12 xl:col-span-12">
                            <div class="form-group mb-2.5 flex">
                                <label class="w-20 mt-2">Liên kết</label>
                                <input value="{{old('class') ?? $admin_menu_items->class}}" id="link_web" type="text" class="form-control" name='link' placeholder="https://">
                            </div>
                        </div>
                    </div>
                    <div class="border-t mt-4">
                        <div class="grid grid-cols-12 gap-x-5 mt-4">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-2.5 flex">
                                    <label class="w-1/2 mt-2">Loại menu</label>
                                    <select name="type_menu" class="form-control type_menu">
                                        <option value="0" {{($admin_menu_items->type_menu == 0) ? 'selected' : ''}}>Liên kết tự tạo</option>
                                        <option value="1" {{($admin_menu_items->type_menu == 1) ? 'selected' : ''}}>Danh mục sản phẩm</option>
                                        <option value="2" {{($admin_menu_items->type_menu == 2) ? 'selected' : ''}}>Danh mục bài viết</option>
                                        <option value="3" {{($admin_menu_items->type_menu == 3) ? 'selected' : ''}}>Bài viết</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5 mb-16">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-3 categories_product hidden">
                                    <label>Danh mục</label>
                                    <select name="categories_product" class="form-control cat_product">
                                        <option value="0">=============  Chọn  ============</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 categories_post hidden">
                                    <label>Danh mục</label>
                                    <select name="categories_post" class="form-control cat_post">
                                        <option value="0">=============  Chọn  ============</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 post hidden">
                                    <label>Bài viết</label>
                                    <select name="post" class="form-control post_single">
                                        <option value="0">=============  Chọn  ============</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-4 filter_by hidden">
                                    <label>Lọc theo</label>
                                    <select name="filter_by" id="filter_by" class="form-control">
                                        <option value="0" {{($admin_menu_items->filter_by == 0) ? 'selected' : ''}} ">=============  Chọn  ============</option>
                                        <option value="1" {{($admin_menu_items->filter_by == 1) ? 'selected' : ''}}>Thuộc tính</option>
                                        <option value="2" {{($admin_menu_items->filter_by == 2) ? 'selected' : ''}}>Giá</option>
                                        <option value="3" {{($admin_menu_items->filter_by == 3) ? 'selected' : ''}}>Thương hiệu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="form-group mb-4 filter_value hidden" >
                                    <label>Giá trị</label>
                                    <div class="flex">
                                        <div class="property mr-4 w-1/2 hidden">
                                            <select name="property" class="form-control attributes">
                                                <option value="0">Thuộc tính</option>
                                            </select>
                                        </div>
                                        <div class="detailproperty w-1/2 hidden">
                                            <select name="detailproperty" class="form-control detail_attr">
                                                <option value="0">Chi tiết</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="price hidden">
                                        <input type="number" class="form-control mb-4" id="price_from" name='price_from' placeholder="Giá từ">
                                        <input type="number" class="form-control" id="price_to" name='price_to' placeholder="Đến">
                                    </div>
                                    <div class="brand hidden">
                                        <select name="brand" class="form-control" id="brand">
                                            <option value="0">=============  Chọn  ============</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" href="{{ route('menu.index',['menu' => $admin_menu_items->menu])}}">Hủy</a>
                        <input type="submit" class="btn btn-primary " value="Cập nhật">
                    </div>
                </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function (){

            var id_menu = {{$admin_menu_items->menu}};
            var _token = $('meta[name="csrf-token"]').attr('content');
            var data = {
                id_menu: id_menu,
                _token: _token
            };
            //load vị trí menu
            $.ajax({
                url: "{{route('get_location_menu')}}",
                data: data,
                method: "POST",
                dataType: "json",
                success: function (data) {
                    $.each(data.listmenu, function (key, value) {
                        str ='━ ';
                        str = str.repeat(value.depth)
                        if(value.id == {{$admin_menu_items->parent}}) {
                            $("select[name='parent']").append(
                                "<option selected value=" + value.id + ">" +str+ value.label + "</option>"
                            );
                        }
                        else{
                            $("select[name='parent']").append(
                                "<option value=" + value.id + ">" +str+ value.label + "</option>"
                            );
                        }
                    });
                }
            });
            //load danh mục sản phẩm khi mục này thuộc danh mục sản phẩm
            if({{$admin_menu_items->type_menu}} == 1)
            {
                $("#link_web").attr('readonly', true);
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
                                str = str.repeat(value.level-1)
                                if(value.id == {{$admin_menu_items->category_id}}) {
                                    $("select[name='categories_product']").append(
                                        "<option selected get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                }
                                else {
                                    $("select[name='categories_product']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                }
                            });
                        }
                    });
                    $(".categories_product").addClass('loaded');
                };
            }
            //load danh mục bài viết khi mục này thuộc danh mục bài viết
            else if({{$admin_menu_items->type_menu}} == 2){
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
                                str = '━ ';
                                str = str.repeat(value.level - 1)
                                if (value.id == {{$admin_menu_items->category_id}}) {
                                    $("select[name='categories_post']").append(
                                        "<option selected get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                }
                                else {
                                    $("select[name='categories_post']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                }
                            });
                        }
                    });
                    $(".categories_post").addClass('loaded');
                };
            }
            //load bài viết khi mục này thuộc dạng bài viết
            else if({{$admin_menu_items->type_menu}} == 3){
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
                                if(value.id == {{$admin_menu_items->category_id}}) {
                                    $("select[name='post']").append(
                                        "<option selected get-slug=" + value.slug + " value=" + value.id + ">" + value.title + "</option>"
                                    );
                                }
                                else{
                                    $("select[name='post']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + value.title + "</option>"
                                    );
                                }
                            });
                        }
                    });
                    $(".post").addClass('loaded');
                };
            }
            // ẩn các trường khi mục này liên kết tự tạo
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

            // load chi tiết thuộc tính khi loại lọc là thuộc tính
            if({{$admin_menu_items->filter_by}} == 1) {
                $(".filter_value").removeClass('hidden');
                $(".detailproperty").removeClass('hidden');
                var cat_id = $('.cat_product option:selected').val();
                var data = {
                    cat_id: cat_id,
                    _token: _token
                };
                 var filter_value ='{{$admin_menu_items->filter_value}}';
                 console.log(cat_id);
                $.ajax({
                    url: "{{route('get_property')}}",
                    data: data,
                    method: "POST",
                    dataType: "json",
                    success: function (data) {
                        $.each(data.listproperty, function (key, value) {
                            if( filter_value != ''){
                                if (value.ma == filter_value) {
                                    $("select[name='property']").append(
                                        "<option selected get-code=" + value.ma + " value=" + value.categoryproperties_id + ">" + value.name + "</option>"
                                    );
                                } else {
                                    $("select[name='property']").append(
                                        "<option get-code=" + value.ma + " value=" + value.categoryproperties_id + ">" + value.name + "</option>"
                                    );
                                }
                            }
                            else{
                                $("select[name='property']").empty().append('<option selected="selected" value="0">Thuộc tính</option>');
                            }
                        });
                    }
                });
            }

            //Hàm thay đổi loại menu thì sẽ thay đổi chi tiết nhập bên dưới
            $(document).on('change','.type_menu', function (){
                var type_menu =  $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var data = {
                    _token: _token
                };
                $('#link_web').val("");
                // Khi chọn loại menu là danh mục sản phẩm
                if(type_menu == 1){
                    $("#link_web").attr('readonly', true);
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
                                    str = '━ ';
                                    str = str.repeat(value.level - 1)
                                    $("select[name='categories_product']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str + value.name + "</option>"
                                    );
                                });
                            }
                        });
                        $(".categories_product").addClass('loaded');
                    };
                }
                // Khi chọn loại menu lả danh mục bài viết
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
                                    str = '━ ';
                                    str = str.repeat(value.level - 1)
                                    $("select[name='categories_post']").append(
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + str+ value.name + "</option>"
                                    );
                                });
                            }
                        });
                        $(".categories_post").addClass('loaded');
                    };
                }
                // Khi chọn loại menu là bài viết
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
                                        "<option get-slug=" + value.slug + " value=" + value.id + ">" + value.title + "</option>"
                                    );
                                });
                            }
                        });
                        $(".post").addClass('loaded');
                    };
                }
                // Khi chọn lọa menu là liên kết tự tạo
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

            // Khi thay đổi lọc theo (thuộc tính/ giá/ thương hiệu) thì hiển thị/ ẩn các trường- sửa đổi link
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

                // thuộc tính
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
                //giá
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
                }//thương hiệu
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
                //chọn
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
        })
    </script>
@endsection
