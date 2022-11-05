@foreach($menus as $key => $menu)
    <tr id="{{$menu->id}}" class="overflow-x-auto scrollbar-hidden border-separate" @if($menu->parent != 0) style="display: table-row;" @endif>
        <td class="text-left  rowparent parent_{{$menu->parent}}" get-id="{{$menu->id}}">
            @php
                $str ='';
                for ($i=0; $i < $menu->depth; $i++) {
                    $str.='━━ ';
                }
                echo $str;
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
                <div class="flex items-center justify-center text-theme-9 mr-3" data-bs-toggle="tooltip" title="Kích hoạt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </div>
            @else
                <div class="flex items-center justify-center text-theme-6 mr-3"data-bs-toggle="tooltip" title="Vô hiệu hóa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </div>
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
@endforeach
