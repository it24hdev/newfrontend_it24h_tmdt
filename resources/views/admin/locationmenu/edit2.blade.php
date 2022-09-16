@extends('admin.layouts.main')
@section('subcontent')
<div class="content">
<h2 class="intro-y text-lg font-medium mt-10">{{ $title}}</h2>
    <div class="form-group  w-1/2">
        <form action="{{ route('locationmenu.update')}}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label>Menu</label><br>
                 <select name="menu_location" class="form-control">   
                     @if($menu_locations == 0)
                     <option value="0" selected>Chọn Menu</option>
                     @endif
                     @foreach($Menus as $menu)
                     <option value="{{$menu->id}}"  {{old('menu_location') == $menu->id  ? 'selected':false}}>{{$menu->name}}</option>
                     @if($menu_locations != 0)
                     <option value="0">Chọn Menu</option>
                     @endif
                     @endforeach
                 </select>
            </div>
            <div class="form-group mb-4">
                <label>Sidebar</label><br>
                 <select name="sidebar_location" class="form-control">
                     @if($sidebar_locations == 0)
                     <option value="0" selected>Chọn Menu</option>
                     @endif
                     @foreach($Menus as $menu)
                     <option value="{{$menu->id}}" {{old('sidebar_location') == $menu->id  ? 'selected':false}}>{{$menu->name}}</option>
                     @if($sidebar_locations != 0)
                     <option value="0">Chọn Menu</option>
                     @endif
                     @endforeach
                 </select>
            </div>
            <div class="form-group mb-4">
                <label>Footer</label><br>
                 <select name="footer_location" class="form-control">
                     @if($footer_locations == 0)
                     <option value="0" selected>Chọn Menu</option>
                     @endif
                     @foreach($Menus as $menu)
                     <option value="{{$menu->id}}" {{old('footer_location') == $menu->id  ? 'selected':false}}>{{$menu->name}}</option>
                     @if($footer_locations != 0 )
                     <option value="0">Chọn Menu</option>
                     @endif
                     @endforeach
                 </select>
            </div>
            <div class="form-group mb-4">
                <label>Rightmenu</label><br>
                 <select name="rightmenu_location" class="form-control">
                    @if($rightmenu_locations == 0)
                    <option value="0" selected>Chọn Menu</option>
                    @endif
                    @foreach($Menus as $menu)
                    <option value="{{$menu->id}}" {{old('rightmenu_location') == $menu->id  ? 'selected':false}}>{{$menu->name}}</option>
                    @if($rightmenu_locations != 0)
                     <option value="0">Chọn Menu</option>
                     @endif
                    @endforeach
                 </select>
            </div>

        <div class="modal-footer">
            <a type="button" class="btn btn-default" href="{{ route('locationmenu.edit')}}">Hủy</a>
            <input type="submit" class="btn btn-primary " value="Cập nhật">
        </div>
    </form>
</div>
</div>
@endsection
