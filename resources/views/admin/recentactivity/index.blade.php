@extends('admin.layouts.main')
@section('subcontent')
    <h2 class="intro-y text-lg font-medium mt-10">
        <a href="{{ route('recentactivity.index')}}">{{ $title}}</a>
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
    <div class="grid grid-cols-12 gap-6 mt-5 mb-4">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="dropdown">
                <a id="add_new_activity" class="btn btn-primary form-control ml-4 w-32" href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview" title="Thêm mới"> <span> Thêm mục mới</span></a>
            </div>
            <div  class="hidden md:block mx-auto text-gray-600">

            </div>
        </div>
    </div>
    @include('admin.recentactivity.create')
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible bg-white">
        <table class="table">
            <thead class="border-b">
            <tr >
                <th class="whitespace-nowrap">Tên hiển thị</th>
                <th class="whitespace-nowrap">Hoạt động</th>
                <th class="whitespace-nowrap">Thuộc tính</th>
                <th class="whitespace-nowrap text-center">Trạng thái</th>
                <th class="whitespace-nowrap">Chức năng</th>
            </tr>
            </thead>
            <tbody class="col-span-12" >
            @foreach($Recentactivity as $key => $value)
                    <tr id="{{$value->id}}" class="overflow-x-auto scrollbar-hidden border-separate">
                        <td class="text-left">
                            {{$value->name}}
                        </td>
                        <td class="text-left">
                            {{$value->activities}}
                        </td>
                        <td class="text-left">
                            {{$value->attr}}
                        </td>
                        <td class="text-center">
                            @if($value->status == '1')
                                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                            @else
                                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                            @endif
                        </td>
                        <td class="w-20">
                            <div class="flex justify-center items-center">
                                <a class="btn btn-sm btn-primary mr-2 btn-edit"
{{--                                   href="{{route('recentactivity.edit',['id'=>$value->id])}}" --}}
{{--                                   data-bs-toggle="tooltip"--}}
                                    data-value="{{$value->id}}"
                                   data-target="#edit-confirmation-modal"
                                   href="javascript:;" data-toggle="modal"
                                   title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a title="Xóa" data-toggle="modal"
                                   data-value="{{$value->id}}"
                                   data-target="#delete-confirmation-modal"
                                   class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        {!! $Recentactivity->links('admin.layouts.pagination') !!}
    </div>
    @include('admin.recentactivity.delete')
    @include('admin.recentactivity.edit')
@endsection
@section('js')
    <script>
        $(document).ready(function (){
            var _token = $('meta[name="csrf-token"]').attr('content');
            $(document).on('click', '.btn-edit', function (){
                $("input[name='name_edit']").val('');
                $("input[name='activities_edit']").val('');
                $("input[name='attr_edit']").val('');
                var id = $(this).attr('data-value');
                var data = {
                    id: id,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('recentactivity.edit_ajax')}}",
                    data: data,
                    method: "POST",
                    dataType: "json",
                    success: function(data){
                        $("input[name='id_edit']").val(data.id);
                        $("input[name='name_edit']").val(data.name);
                        $("input[name='activities_edit']").val(data.activities);
                        $("input[name='attr_edit']").val(data.attr);
                        if(data.status ==1){
                            $("input[name='status_edit']").attr('checked',true);
                        }
                        else{
                            $("input[name='status_edit']").attr('checked',false);
                        }
                    }
                })
            });

            // $(document).on('click', '.check_status', function (){
            //     if($(this).attr('checked')){
            //         $(this).removeAttr('checked');
            //     }
            //     else{
            //         $(this).attr('checked','checked');
            //     }
            // });
            $(document).on('click', '#update_recentactivity', function (){
                var name_edit = $("input[name='name_edit']").val();
                var id_edit = $("input[name='id_edit']").val();
                var activities_edit =  $("input[name='activities_edit']").val();
                var attr_edit  =$("input[name='attr_edit']").val();
                var status_edit = 0;
                if($("input[name='status_edit']").attr('checked',true)){
                    var status_edit = 1;
                }
                var data = {
                    id: id_edit,
                    name: name_edit,
                    activities: activities_edit,
                    attr: attr_edit,
                    status: status_edit,
                    _token: _token
                };
                $.ajax({
                    url: "{{route('recentactivity.update_ajax')}}",
                    data: data,
                    method: "POST",
                    dataType: "json",
                    success: function(data){
                        if(data.success){
                            alert('Cập nhật thành công');
                            var url = "{{route('recentactivity.index')}}"
                            window.location = url;
                        }
                        else{
                            alert('Đã có lỗi xảy ra! Xin vui lòng thử lại.');
                            var url = "{{route('recentactivity.index')}}"
                            window.location = url;
                        }
                    }
                });
            });
        });
    </script>
@endsection
