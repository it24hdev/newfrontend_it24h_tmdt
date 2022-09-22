
@foreach($listcategories as $key => $list)
    <tr class=" overflow-x-auto scrollbar-hidden subid{{$sub_id}}" id="{{ $list->id }}" >
        <td class="text-left font-medium ">
        @php
            $str ='';
            for ($i=0; $i < $list->level; $i++) {
                echo $str;
                $str.='&nbsp';
            }
        @endphp
       {{$ma}}.{{$key+1}}
        </td>
        <td class="category_child_name">
            @php
            $str ='';
            for ($i=0; $i < $list->level; $i++) {
                echo $str;
                $str.='━';
            }
            @endphp
            {{$list->name}} 
        </td>
        <td class="overflow-hidden ">{{$list->slug}}</td>
        <td class="text-center">
            @if ($list->cat_parent)
            {{$list->cat_parent->name}}
            @endif
        </td>
        <td style="display:none;">{{$status = $list->status}}</td>
        <td>
            @if($status == '1')
            <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @else
            <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @endif
        </td>
        <td class="w-20">
            <div class="flex justify-center items-center">
                @can('updatepost',App\Models\Category::class)
                <a class="btn btn-sm btn-primary mr-2"
                href="{{route('categorypost.edit',['id'=>$list->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
                {{-- <i data-feather="check-square" class="w-4 h-4 mr-1"></i></a> --}}
                @endcan
                @can('deletepost',App\Models\Category::class)
                 <a title="Xóa" data-toggle="modal"
               data-value="{{$list->id}}"
               data-target="#delete-confirmation-modal"
               class="btn btn-danger py-1 px-2 btn-delete2"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
            </a>
                @endcan

            </div>
        </td>
    </tr>
   @endforeach