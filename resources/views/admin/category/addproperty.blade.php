{{-- @if(!empty($values))
@foreach($values as $value)
<tr id="{{ $value->id }}">
    <td class="text-center"></td>
    <td class="text-center">{{$value->ma}}</td>
    <td class="text-center">{{$value->name}}</td>
    <td class="text-center"><a href="{{route('category_property.edit',$value->categoryproperties_id)}}">Quản lý giá trị</a></td>
    <td class="w-20">
        <div class="flex justify-center items-center">
            <a title="Xóa" data-toggle="modal"
               data-value="{{$value->id}}"
               data-target="#delete-confirmation-modal"
               class="btn btn-danger py-1 px-2 btn-delete2"><i class="fa-solid fa-trash-can"style="padding: 1px"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
@endif --}}