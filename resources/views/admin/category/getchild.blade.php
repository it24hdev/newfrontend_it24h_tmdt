
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
       {{$sub_id}}.{{$key+1}}
        </td>
        <td class="category_child_name">
            @php
            $str ='';
            for ($i=0; $i < $category_child->level; $i++) {
                echo $str;
                $str.='━';
            }
            @endphp
            {{$category_child->name}} </td>
        <td class="text-center">
            @if ($category_child->cat_parent)
             {{$category_child->cat_parent->name}}
            @endif
        </td>
        <td>
            @if($category_child->show_push_product == '1')
                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
            @else
                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
            @endif
        </td>
        <td style="display:none;">{{$status = $category_child->status}}</td>
        <td>
            @if($status == '1')
                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
            @else
                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></div>
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
                   class="btn btn-danger py-1 px-2 btn-delete"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
                </a>
            </div>
        </td>
    </tr>
@endforeach