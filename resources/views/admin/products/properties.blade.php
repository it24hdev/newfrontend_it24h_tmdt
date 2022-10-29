@extends('admin.layouts.main')
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
<h2 class="text-lg font-medium mr-auto">
    {{ $title }}
</h2>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
    <a class="btn btn-primary shadow-md mr-2" href="{{ route('products.edit', ['id' => $product_id]) }}">Quay lại sản phẩm</a>
    <a class="btn btn-primary shadow-md mr-2" href="{{ route('products.index') }}">Danh sách sản phẩm</a>
</div>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12">
        <form action="{{ route('saveproductsproperties', ['id' => $product_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="col-span-12 mt-5 mb-3">
             @foreach($categoryproperties as $key => $category_property)
                <div class="justify-center grid grid-cols-12 border-2">
                    <div class="col-span-3 px-3 py-2 border-r-2 font-medium text-center">
                        <p>{{ $category_property->name }}</p><br>
                        <p>({{ $category_property->ma }})</p>
                    </div>
                    <div class="col-span-9 px-3 py-2">
                        <div class="justify-center grid grid-cols-12">
                            @foreach ($detailproperty as $key => $category_property_child)
                            @if($category_property_child->categoryproperties_id == $category_property->id)
                                <div class="form-check col-span-6 md:col-span-4 lg:col-span-3 2xl:col-span-2 px-3 py-2">
                                    
                                    <input name="property_product[]"class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{ $category_property_child->id }}"
                                    @if(!empty($list_checkbox_property))  {{in_array($category_property_child->id, $list_checkbox_property) ? 'checked':false}}> @endif
                                    <label class="form-check-label inline-block text-gray-800"
                                        for="flexCheckDefault-{{ $category_property_child->id }}"style="font-size: 1rem">
                                        {{ $category_property_child->name }}
                                    </label>
                                   
                                </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary w-24">Cập nhật</button>
        </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        
    });
</script>
@endsection
