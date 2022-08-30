@extends('admin.layouts.main')
@section('subcontent')
    @csrf
    <!-- BEGIN: Content -->
    <div class="content">
        <div id="alerts">
            
        </div>
        <h2 class="intro-y text-lg font-medium mt-10">
            <a href="#">{{ $title}}</a>
        </h2>

        <div>
            <!-- BEGIN: Data List -->

            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr >
                        <th class="whitespace-nowrap text-center">ID</th>
                        <th class="whitespace-nowrap">TÊN DANH MỤC</th>
                        <th class="text-center whitespace-nowrap">STT</th>
                        <th class="text-center whitespace-nowrap w-30">Menu</th>
                        <th class="text-center whitespace-nowrap ">Sidebar</th>
                        <th class="text-center whitespace-nowrap ">Footer</th>
                        <th class="text-center whitespace-nowrap ">CHỨC NĂNG</th>
                    </tr>
                    </thead>
                    <tbody class="col-span-12 order_position" id="table1" >
                    @foreach($Locationmenu as $key => $list)
                        <tr class=" overflow-x-auto scrollbar-hidden" id="{{ $list->id }}">
                            <td class="text-center font-medium ">{{$list->id}}</td>
                            <td class="overflow-hidden">{{$list->name}} </td>
                            <td class="text-center font-medium">{{$list->position}} </td>
                            <td>
                                @if($list->menu == '1')
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td>
                                @if($list->sidebar == '1')
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td>
                                @if($list->footer == '1')
                                    <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @else
                                    <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
                                @endif
                            </td>
                            <td class="w-20">
                                <div class="flex justify-center items-center">
                                    @can('update',App\Models\Locationmenu::class)
                                        <a class="btn btn-sm btn-primary mr-2"
                                           href="{{route('locationmenu.edit',['id'=>$list->id])}}" data-bs-toggle="tooltip" title="Sửa" >
                                           <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                        <a class="btn btn-sm btn-primary mr-2"
                                           href="{{route('locationmenu.sort',['id'=>$list->parent_id])}}" data-bs-toggle="tooltip" title="Sắp xếp" >
                                           <i class="fa-solid fa-arrow-down-arrow-up"></i>
                                        </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"  >

                <ul class="pagination" >

                    <li> {{ $Locationmenu->withQueryString()->onEachSide(1)->links('admin.layouts.pagination') }}</li>
                </ul>
            </div>
            <!-- END: Pagination -->
        </div>
    </div>
    <!-- END: Content -->
@endsection
@section('js')
<script type="text/javascript">

$(document).ready(function () {
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('.order_position').sortable({
            placeholder : "ui-state-highlight",
            update: function(event,ui){
                var array_id = [];
                $('.order_position tr').each(function(){
                    array_id.push($(this).attr('id'));
                })
                $.ajax({
                    url: "{{ route('resofting_category') }}",
                    method:"post",
                    data:{ 
                        array_id:array_id,
                    },
                    success:function(data){
                        $('#alerts').html('');
                        $('#alerts').append('<div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert"><i class="fa-solid fa-bell mr-2 text-base"></i>ok<button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"><i class="fa-regular fa-circle-xmark text-base"></i></button> </div>');

                    }
                })
            }
        });
});
</script>
@endsection