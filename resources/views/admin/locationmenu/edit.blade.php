@extends('admin.layouts.main')
@section('subcontent')
<div class="content">
<h2 class="intro-y text-lg font-medium mt-10">{{ $title}}</h2>
    <div class="form-group">
        <form action="{{ route('locationmenu.update',[$edit->id]) }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label>Menu</label><br>
                 <input type="checkbox" class="form-check-switch" name='menu' value="{{$edit->menu == true ? '1' : '0'}}" {{$edit->menu == true ? 'checked' : ' '}}>
            </div>
            <div class="form-group mb-4">
                <label>Right menu</label><br>
                 <input type="checkbox" class="form-check-switch" name='rightmenu' value="{{$edit->rightmenu == true ? '1' : '0'}}" {{$edit->rightmenu == true ? 'checked' : ' '}}>
            </div>
            <div class="form-group mb-4">
                <label>Sidebar</label><br>
                 <input type="checkbox" class="form-check-switch" name='sidebar' value="{{$edit->sidebar == true ? '1' : '0'}}" {{$edit->sidebar == true ? 'checked' : ' '}}>
            </div>
            <div class="form-group mb-4">
                <label>Footer</label><br>
                 <input type="checkbox" class="form-check-switch" name='footer' value="{{$edit->footer == true ? '1' : '0'}}" {{$edit->footer == true ? 'checked' : ' '}}>
            </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-default" href="{{ route('locationmenu.index')}}">Hủy</a>
            <input type="submit" class="btn btn-primary " value="Cập nhật">
        </div>
    </form>
</div>
</div>
@endsection
