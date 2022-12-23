@extends('admin.layouts.main')
@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        <a href="{{ route('deals.index')}}">{{ $title}}</a>
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
            <form class="w-1/4 flex mr-2">
                <select class="form-select mr-4">
                    <option selected="selected" value="0">Chọn nhóm deal</option>
                </select>
                <input type="submit" class="btn btn-primary" value="Chọn">
            </form>
            <a class="btn btn-primary mr-2" href="javascript:" data-toggle="modal" data-target="#view_product"
               id="add_new_deal">
                <span> Thêm deal</span>
            </a>
            <form action="{{ route('deals.index')}}" method="get" class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <select name="orderby" class="form-select  sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto box mr-3" onchange="this.form.submit()">
                    <option value="">Tình trạng</option>
                    <option value="not_started" {{request()->input('orderby') =='not_started' ? 'selected' : ''}} >Chưa bắt đầu</option>
                    <option value="starting" {{request()->input('orderby') =='starting' ? 'selected' : ''}} >Đang bắt đầu</option>
                    <option value="time_out" {{request()->input('orderby') =='time_out' ? 'selected' : ''}} >Hết thời gian</option>
                    <option value="status_deal" {{request()->input('orderby') =='status_deal' ? 'selected' : ''}} >Hiển thị</option>
                </select>
                <div class="sm:w-42 2xl:w-full mt-2 sm:mt-0 sm:w-auto box">
                    <div class="w-full relative text-gray-700 dark:text-gray-300">
                        <input type="text" name="search" class="form-control w-full box pr-10 placeholder-theme-13"
                               placeholder="Tìm kiếm..." value="{{request()->input('search')}}">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
            </form>
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
            <input class="btn btn-sm btn-primary mr-2" value="Xoá đã chọn" id="delete_selected">
        </div>
    </div>
    <div>
        <!-- BEGIN: Data category -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="table_categories">
                <thead>
                <tr>
                    <th class="text-center whitespace-nowrap"><input type="checkbox" class="form-check" name="checkall"></th>
                    <th class="text-center whitespace-nowrap">ẢNH</th>
                    <th class="text-center whitespace-nowrap">SẢN PHẨM</th>
                    <th class="text-center whitespace-nowrap">THỜI GIAN</th>
                    <th class="text-center whitespace-nowrap">TRẠNG THÁI</th>
                    <th class="text-center whitespace-nowrap">CHỨC NĂNG</th>
                </tr>
                </thead>
                <tbody class="col-span-12 " id="table1">
                @foreach($deals as $key => $item)
                    <tr class=" overflow-x-auto scrollbar-hidden" id="{{ $item->id }}">
                        <td class="text-center">
                            <input type="checkbox" class="form-check" value="{{$item->id}}" name="product_selected[]">
                        </td>
                        <td class="text-center w-28" style="padding: 0.25rem 0.25rem !important;">
                            <img style="box-shadow: none" src="{{asset('upload/images/products/thumb/'.$item->thumb)}}">
                        </td>
                        <td class="text-left" style="padding: 0.25rem 0.25rem !important;">
                            <p class="whitespace-nowrap w-56"
                               style="overflow-y: hidden;overflow-x: clip;text-overflow: ellipsis;max-height: 70px; text-align: left; font-weight: 700">
                                <a href="{{route('products.edit',['id'=>$item->product_id])}}"
                                   class="name_deal" style="text-decoration: underline;">{{$item->name_deal}}</a></p>
                            <p>Giá deal: <span class="price_deal">{{$item->price_deal}}</span> vnd - Giá thường: <span class="price">{{$item->price}}</span></p>
                            <p>Số lượng: <span class="quantity_deal">{{$item->quantity_deal}}</span></p>
                        </td>
                        <td class="text-left w-56 datetime_deal" style="padding: 0.25rem 0.25rem !important;">
                            @if($item->start_time)
                            <p>BĐ: <span class="start_time_date">{{date('y-m-d', strtotime($item->start_time))}} </span>|
                                <span class="start_time_time">{{date('H:I', strtotime($item->start_time))}}</span></p>
                            @endif
                            @if($item->end_time)
                            <p>KT: <span class="end_time_date">{{date('y-m-d', strtotime($item->end_time))}} </span>|
                                <span class="end_time_time">{{date('H:I', strtotime($item->end_time))}}</span></p>
                            @endif
                            @if($item->end_time && $item->start_time)
                                @if($item->end_time < now() && $item->start_time < now())
                                    <p class="processing">(Hết thời gian)</p>
                                @elseif($item->end_time > now() && $item->start_time < now())
                                    <p class="processing">(Đang bắt đầu)</p>
                                @elseif($item->end_time > now() && $item->start_time > now())
                                    <p class="processing">(Chưa bắt đầu)</p>
                                @else
                                @endif
                            @endif
                        </td>
                        <td class="p-1 text-center">
                            <input type="checkbox" class="form-check-switch" name='status_deal[]'
                                   value="{{$item->status_deal == true ? '1' : '0'}}" {{$item->status_deal == true ? 'checked' : ' '}}>
                        </td>
                        <td class="w-20" style="padding: 0.25rem 0.25rem !important;">
                            <div class="flex justify-center items-center">
                                <a href="javascript:" title="Chỉnh sửa"
                                   data-value="{{$item->id}}"
                                   data-toggle="modal"
                                   data-target="#edit_product"
                                   class="btn btn-sm btn-primary btn-edit mr-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a title="Xóa" data-toggle="modal"
                                   data-value="{{$item->id}}"
                                   data-target="#delete-confirmation-modal"
                                   class="btn btn-danger btn-delete btn-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.deals.delete')
        @include('admin.deals.create')
        @include('admin.deals.edit')
        <!-- END: Data category -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <ul class="pagination">
                <li> {{ $deals->withQueryString()->onEachSide(1)->links('admin.layouts.pagination') }}</li>
            </ul>
        </div>
        <!-- END: Pagination -->
    </div>
@endsection
@section('js')
    <script id="template_row" type="text/x-custom-template">
        <tr class="overflow-x-auto scrollbar-hidden">
            <td class="text-center">
                <input type="checkbox" class="form-check" value="" name="product_selected[]">
            </td>
            <td class="text-center w-28" style="padding: 0.25rem 0.25rem !important;">
                <img style="box-shadow: none" src="">
            </td>
            <td class="text-left" style="padding: 0.25rem 0.25rem !important;">
                <p class="whitespace-nowrap w-56"
                   style="overflow-y: hidden;overflow-x: clip;text-overflow: ellipsis;max-height: 70px; text-align: left; font-weight: 700">
                    <a href="" class="name_deal" style="text-decoration: underline;"></a></p>
                <p>Giá deal: <span class="price_deal"></span> vnd - Giá thường: <span class="price"></span></p>
                <p>Số lượng: <span class="quantity_deal"></span></p>
            </td>
            <td class="text-left w-56 datetime_deal" style="padding: 0.25rem 0.25rem !important;">
            </td>
            <td class="p-1 text-center">
                <input type="checkbox" class="form-check-switch" name='status_deal[]' value=''>
            </td>
            <td class="w-20" style="padding: 0.25rem 0.25rem !important;">
                <div class="flex justify-center items-center">
                    <a href="javascript:" title="Chỉnh sửa"
                       data-value=""
                       data-toggle="modal"
                       data-target="#edit_product"
                       class="btn btn-sm btn-primary btn-edit mr-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a title="Xóa" data-toggle="modal"
                       data-value=""
                       data-target="#delete-confirmation-modal"
                       class="btn btn-danger btn-delete btn-sm">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </td>
        </tr>
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        $(document).ready(function () {
            var _token = $('meta[name="csrf-token"]').attr('content');
            // them moi
            $(document).on('click', "#add_new_deal", function () {
                $('#view_product').show();
                $.ajax({
                    url: '{{route('product_deal')}}',
                    type: "get",
                    dataType: "json",
                    data: {
                        _token: _token,
                    },
                    success: function (data) {
                        $('#products').DataTable().destroy();
                        $('#products').DataTable({
                            data: data,
                            "columns": [
                                {
                                    data: "name",
                                    render: function (data) {
                                        return '<div style="max-height: 40px;overflow: hidden">' + data + '</div>';
                                    },
                                },
                                {
                                    data: "price",
                                    render: function (data) {
                                        return '<div class="text-right">' + data + '</div>';
                                    },
                                },
                                {
                                    data: "quantity",
                                    render: function (data) {
                                        return '<div class="text-center">' + data + '</div>';
                                    },
                                },
                                {
                                    data: "warranty",
                                    render: function (data) {
                                        return '<div class="text-center">' + data + '</div>';
                                    },
                                },
                                {
                                    data: "id",
                                    render: function (data) {
                                        return '<div class="text-center"><input type="button" data-dismiss="modal" data-target="' + data + '" class="btn btn-primary product_selected" value="Chọn sản phẩm"></div>';
                                    },
                                }
                            ]
                        });
                    }
                });
            });
            // chon san pham
            $(document).on('click', ".product_selected", function () {
                var id = $(this).attr('data-target');
                $('#view_product').hide();
                $.ajax({
                    url: '{{route('deals.store')}}',
                    type: "post",
                    dataType: "json",
                    data: {
                        _token: _token,
                        id: id
                    },
                    success: function (data) {
                        if (data.success && data.item) {
                            var template_row = $('#template_row').html();
                            var tmp = $(template_row).clone();
                            $(tmp).find('.id_deal').attr('id',data.item.id);
                            $(tmp).find('input[name="product_selected[]"]').val(data.item.id);
                            var img = '{{asset("upload/images/products/thumb/img_name")}}';
                            img = img.replace('img_name', data.item.thumb);
                            var slug = '{{route('products.edit',['id'=>'product_id'])}}';
                            slug = slug.replace('product_id', data.item.product_id);
                            $(tmp).find('.name_deal').attr('href',slug);
                            $(tmp).find('.name_deal').html(data.item.name_deal);
                            $(tmp).find('img').attr('src',img);
                            $(tmp).find('.price_deal').html(data.item.price_deal);
                            $(tmp).find('.price').html(data.item.price);
                            $(tmp).find('.quantity_deal').html(data.item.quantity_deal);
                            $(tmp).find('input[name="status_deal[]"]').val(data.item.status_deal);
                            if(data.item.status_deal == 1){
                                $(tmp).find('input[name="status_deal[]"]').attr('checked',true);
                            }
                            $(tmp).find('.btn-delete').attr('data-value',data.item.id);
                            $(tmp).find('.btn-edit').attr('data-value',data.item.id);
                            $('#table1').prepend(tmp);
                            var $row = $('tbody').children('tr:first');
                            $row.attr('id',data.item.id);
                            // alert('Thêm thành công');
                        }
                        else {
                            // alert('Đã xảy ra lỗi, vui lòng thử lại');
                        }
                        $('body').removeClass('overflow-y-hidden');
                    }
                });
            });
            // xoa
            $(document).on('click', '.delete', function () {
                var id = $("#delete_id").val();
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: "{{ route('deals.destroy') }}",
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            $('#' + id).remove();
                            // alert('Xoá thành công');
                        }
                    }
                });
            });
            // chinh sua
            $(document).on('click', '.btn-edit', function () {
                $('#form_edit')[0].reset();
                $('#form_edit').find('input[name="update"]').attr('data-target','');
                var id = $(this).attr('data-value');
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: '{{ route('deals.edit')}}',
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            $('#form_edit').find('input[name="name_deal"]').val(data.item.name_deal);
                            $('#form_edit').find('input[name="price_deal"]').val(data.item.price_deal);
                            $('#form_edit').find('input[name="quantity_deal"]').val(data.item.quantity_deal);
                            $('#form_edit').find('input[name="order_display"]').val(data.item.order_display);
                            $('#form_edit').find('textarea[name="describe"]').val(data.item.describe);
                            $('#form_edit').find('input[name="status_deal"]').val(data.item.status_deal);
                            if(data.item.status_deal==1){
                                $('#form_edit').find('input[name="status_deal"]').attr('checked',true);
                                $('#form_edit').find('input[name="status_deal"]').val(1);
                            }
                            else {
                                $('#form_edit').find('input[name="status_deal"]').attr('checked',false);
                                $('#form_edit').find('input[name="status_deal"]').val(0);
                            }
                            $('#form_edit').find('input[name="product_name"]').val(data.item.product_name);
                            $('#form_edit').find('input[name="price"]').val(data.item.price);

                            var start_time = data.item.start_time;
                            if(start_time){
                                $('#form_edit').find('input[name="start_time"]').val(moment(start_time).format("YYYY-MM-DD"));
                                $('#form_edit').find('input[name="start_time_hour"]').val(moment(start_time).format("HH:MM"));
                            }
                            var end_time = data.item.end_time;
                            if(end_time){
                                $('#form_edit').find('input[name="end_time"]').val(moment(end_time).format("YYYY-MM-DD"));
                                $('#form_edit').find('input[name="end_time_hour"]').val(moment(end_time).format("HH:MM"));
                            }
                            $('#form_edit').find('input[name="update"]').attr('data-target',id);
                        }
                    }
                });
            });
            // cap nhat
            $(document).on('click', '.btn-update', function () {
                $('body').removeClass('overflow-y-hidden');
                var id = $(this).attr('data-target');
                var name_deal = $('#form_edit').find('input[name="name_deal"]').val();
                var price_deal = $('#form_edit').find('input[name="price_deal"]').val();
                var quantity_deal = $('#form_edit').find('input[name="quantity_deal"]').val();
                var order_display = $('#form_edit').find('input[name="order_display"]').val();
                var describe = $('#form_edit').find('input[name="describe"]').val();
                var status_deal = 0;
                if($('#form_edit').find('input[name="status_deal"]').is(":checked")){
                    status_deal = 1;
                }
                var start_date =  $('#form_edit').find('input[name="start_time"]').val();
                var start_time =  $('#form_edit').find('input[name="start_time_hour"]').val();
                var end_date =  $('#form_edit').find('input[name="end_time"]').val();
                var end_time =  $('#form_edit').find('input[name="end_time_hour"]').val();
                var data = {
                    id: id,
                    name_deal: name_deal,
                    price_deal: price_deal,
                    quantity_deal: quantity_deal,
                    order_display: order_display,
                    describe: describe,
                    status_deal: status_deal,
                    start_date: start_date,
                    start_time: start_time,
                    end_date: end_date,
                    end_time: end_time,
                    _token: _token
                };
                $.ajax({
                    url: '{{ route('deals.update')}}',
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            $('#'+id).find('a .name_deal').html(data.item.name_deal);
                            $('#'+id).find('.price_deal').html(data.item.price_deal);
                            $('#'+id).find('.quantity_deal').html(data.item.quantity_deal);
                            $('#'+id).find('.datetime_deal').html('');
                            if(data.item.start_time){
                                $('#'+id).find('.datetime_deal').append('<p>BĐ: <span class="start_time_date"></span> | <span class="start_time_time"></span></p>')
                            }
                            if(data.item.end_time){
                                $('#'+id).find('.datetime_deal').append('<p>KT: <span class="end_time_date"></span> | <span class="end_time_time"></span></p>')
                            }
                            if(data.item.start_time && data.item.end_time){
                                $('#'+id).find('.datetime_deal').append('<p class="processing"></p>');
                            }
                            $('#'+id).find('.start_time_date').html(moment(data.item.start_time).format("YYYY-MM-DD"));
                            $('#'+id).find('.start_time_time').html(moment(data.item.start_time).format("HH:MM"));
                            $('#'+id).find('.end_time_date').html(moment(data.item.end_time).format("YYYY-MM-DD"));
                            $('#'+id).find('.end_time_time').html(moment(data.item.end_time).format("HH:MM"));
                            var d = moment().format('YYYY-MM-DD HH:MM::SS');
                            if(data.item.end_time < d && data.item.start_time < d){
                                $('#'+id).find('.processing').html("(Hết thời gian)");
                            }
                            else if(data.item.end_time > d && data.item.start_time < d){
                                $('#'+id).find('.processing').html("(Đang bắt đầu)");
                            }
                            else if(data.item.end_time > d && data.item.start_time > d){
                                $('#'+id).find('.processing').html("(Chưa bắt đầu)");
                            }
                            else{
                                $('#'+id).find('.processing').html("");
                            }
                            if(data.item.status_deal == 1 && $('#'+id).find('input[name="status_deal[]"]').not(':checked')){
                                $('#'+id).find('input[name="status_deal[]"]').attr('checked',true);
                                $('#'+id).find('input[name="status_deal[]"]').val(1);
                            }
                            else{
                                $('#'+id).find('input[name="status_deal[]"]').attr('checked',false);
                                $('#'+id).find('input[name="status_deal[]"]').val(0);
                            }
                        }
                    }
                });
            });
            // thay doi trang thai
            $(document).on('change' , 'input[name="status_deal[]"]', function (){
                var row_id = $(this).closest('tr').attr('id');
                let status_deal = 0;
                if($(this).is(':checked')){
                    status_deal = 1;
                }
                var data = {
                    id: row_id,
                    status_deal: status_deal,
                    _token: _token
                };
                $.ajax({
                    url: '{{ route('deals.update')}}',
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                    }
                })
            });
            // chon tat ca
            $(document).on('change' , 'input[name="checkall"]', function (){
                if($(this).is(':checked')){
                    $('input[name="product_selected[]"]').attr('checked',true);
                }
                else{
                    $('input[name="product_selected[]"]').attr('checked',false);
                }
            });
            $(document).on('click' , '#delete_selected', function (){
                var list = [];
                $('input[name="product_selected[]"]').each(function (){
                    if($(this).is(':checked')){
                        list.push($(this).val());
                    }
                });
                var data = {
                    list_id: list,
                    _token: _token
                };
                $.ajax({
                    url: '{{ route('multiple_destroy')}}',
                    method: "POST",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if(data.success){
                            $.each(list, function (k,v){
                                $('#'+v).empty();
                            })
                        }
                    }
                })
            });
        });
    </script>
@endsection
