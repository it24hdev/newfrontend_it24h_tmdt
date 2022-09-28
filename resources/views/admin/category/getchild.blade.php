
@foreach($listcategories as $key => $category_child)
    <tr class=" overflow-x-auto scrollbar-hidden subid{{$sub_id}}" id="{{ $category_child->id }}" >
        <td class="text-left font-medium ">
        @php
            $str ='';
            for ($i=0; $i < $category_child->level; $i++) {
                echo $str;
                $str.='&nbsp';
            }
        @endphp
        {{$ma}}.{{$key+1}}
        </td>
        <td class="category_child_name">
            @php
            $str ='';
            for ($i=0; $i < $category_child->level; $i++) {
                echo $str;
                $str.='━';
            }
            @endphp
            {{$category_child->name}} 
        </td>
        <td class="text-center">
            @if ($category_child->cat_parent)
             {{$category_child->cat_parent->name}}
            @endif
        </td>
        <td>
            @if($category_child->show_push_product == '1')
                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @else
                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @endif
        </td>
        <td style="display:none;">{{$status = $category_child->status}}</td>
        <td>
            @if($status == '1')
                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @else
                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></div>
            @endif
        </td>
        <td class="w-20">
            <div class="flex justify-center items-center">
                    <a class="btn btn-sm btn-primary mr-2"
                       href="{{route('category.edit',['id'=>$category_child->id])}}" data-bs-toggle="tooltip" title="Sửa" > <i class="fa-solid fa-pen-to-square"></i>
             
                    </a>
                <a title="Xóa" data-toggle="modal"
                   data-value="{{$category_child->id}}"
                   data-target="#delete-confirmation-modal"
                   class="btn btn-danger py-1 px-2 btn-delete2"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach