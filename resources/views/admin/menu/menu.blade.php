@extends('admin.layouts.main')
@section('subcontent')
    <?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="{{asset('asset/menu/style.css')}}" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{asset('asset/lib/bootstrap/bootstrap.min.css')}}"> --}}
<div id="hwpwrap">
    <div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
        <div id="wpwrap">
            <div id="wpcontent">
                <div id="wpbody">
                    <div id="wpbody-content">
                    <div class="wrap">
                     <nav class="nav-tab-wrapper wp-clearfix top_w" aria-label="Menu thứ hai">
                                <a href="{{route('menu')}}" class="nav-tab nav-tab-active" aria-current="page">Sửa menu</a>
                                <a href="{{route('locationmenu.edit')}}" class="nav-tab">Quản lý vị trí menu</a>

                                @if(request()->has('menu')  && !empty(request()->input("menu")))
                                <form action="{{ route('menu.import',request()->input("menu")) }}" method="POST" enctype="multipart/form-data" style="display: contents;">
                                @csrf
                                <input type="file" name="file" class="" value="Chọn" style="height: 40px;width: 250px; border-width: 0;">
                                <button type="submit" class="button button-primary" >Import Data</button>
                                </form>
                                <a class="button button-primary" href="{{ route('menu.export',request()->input("menu")) }}">Export Data</a>

                                @endif
                    </nav>
                    <div class="manage-menus">
                        <form method="get" action="{{ $currentUrl }}">
                            <label for="menu" class="selected-menu">Chọn menu bạn muốn chỉnh sửa:</label>
                            <select name="menu">
                            @foreach($menulist as $key => $val)
                           <option value="{{$key}}" @if(request()->input('menu') == $key) selected="selected" @endif>{{ $val }}</option>
                            @endforeach
                            </select>
                            <span class="submit-btn">
                                <input type="submit" class="button-secondary" value="Chọn">
                            </span>
                            <span class="add-new-menu-action"> hoặc <a href="{{ $currentUrl }}?action=edit&menu=0">Tạo mới menu</a>. </span>
                        </form>
                    </div>
                    <div id="nav-menus-frame">
                    @if(request()->has('menu')  && !empty(request()->input("menu")))
                    <div id="menu-settings-column" class="metabox-holder">
                        <form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
                            <div id="side-sortables" class="accordion-container">
                                <ul class="outer-border">
                                    <li class="control-section accordion-section open add-page" id="add-page">
                                        <h3 class="accordion-section-title hndle" tabindex="0"> Liên kết tự tạo <span class="screen-reader-text">Press return or enter to expand</span></h3>
                                        <div class="accordion-section-content ">
                                            <div class="inside">
                                                <div class="customlinkdiv" id="customlinkdiv">
                                                    <p id="menu-item-url-wrap">
                                                        <label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
                                                            <input id="custom-menu-item-url" name="url" type="text" class="menu-item-textbox " placeholder="http://">
                                                        </label>
                                                    </p>

                                                    <p id="menu-item-name-wrap">
                                                        <label class="howto" for="custom-menu-item-name"> <span>Tên đường dẫn</span>&nbsp;
                                                            <input id="custom-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="">
                                                        </label>
                                                    </p>

                                                    @if(!empty($roles))
                                                    <p id="menu-item-role_id-wrap">
                                                        <label class="howto" for="custom-menu-item-name"> <span>Role</span>&nbsp;
                                                            <select id="custom-menu-item-role" name="role">
                                                                <option value="0">Select Role</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </p>
                                                    @endif
                                                    <p class="button-controls topitem">
                                                        <a  href="#" onclick="addcustommenu()"  class="button-secondary submit-add-to-menu right"  >Thêm</a>
                                                        <span class="spinner" id="spincustomu"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="control-section accordion-section add-page" >
                                        <h3 class="accordion-section-title hndle" tabindex="0"> Danh mục bài viết </h3>
                                        <div class="accordion-section-content ">
                                            <div class="inside">
                                                <div class="customlinkdiv" >
                                                    <div class="container">
                                                    <ul id="posttype-page-tabs" class="posttype-tabs add-menu-item-tabs">
                                                        <li class="tabs">
                                                            <a class="nav-tab-link" data-type="tabs-panel-posttype-page-most-recent" href="/wp-admin/nav-menus.php?page-tab=most-recent#tabs-panel-posttype-page-most-recent">
                                                                Tất cả                </a>
                                                        </li>
                                                    </ul>   

                                                    <div id="tabs-panel-posttype-page-most-recent" class="tabs-panel tabs-panel-active" role="region" aria-label="Mới nhất" tabindex="0">
                                                        <ul id="pagechecklist-most-recent" class="categorychecklist form-no-clear">
                                                            @foreach($categorypost as $cate2)
                                                            <li>
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="menu-item-checkbox" name="{{$cate2->id}}" value="">{{$cate2->name}}
                                                                </label>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <p class="button-controls topitem">

                                                        <a  href="#" onclick="addcustommenu2()"  class="button-secondary submit-add-to-menu right">Thêm</a>
                                                        <span class="spinner" id="spincustomu2"></span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="control-section accordion-section add-page" >
                                        <h3 class="accordion-section-title hndle" tabindex="0"> Danh mục sản phẩm </h3>
                                        <div class="accordion-section-content ">
                                            <div class="inside">
                                                <div class="customlinkdiv" >
                                                    <div class="container">
                                                    <ul id="posttype-page-tabs3" class="posttype-tabs add-menu-item-tabs">
                                                        <li class="tabs">
                                                            <a class="nav-tab-link" data-type="tabs-panel-posttype-page-most-recent3" href="/wp-admin/nav-menus.php?page-tab=most-recent#tabs-panel-posttype-page-most-recent3">
                                                                Tất cả               </a>
                                                        </li>
                                                    </ul>   
                                                    <div id="tabs-panel-posttype-page-most-recent3" class="tabs-panel tabs-panel-active" role="region" aria-label="Mới nhất" tabindex="0">
                                                        <ul id="pagechecklist-most-recent3" class="categorychecklist form-no-clear">
                                                            @foreach($category as $cate3)
                                                            <li>
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="menu-item-checkbox" name="{{$cate3->id}}" value="">{{$cate3->name}}
                                                                </label>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <p class="button-controls topitem">
                                                        <a  href="#" onclick="addcustommenu3()"  class="button-secondary submit-add-to-menu right">Thêm</a>
                                                        <span class="spinner" id="spincustomu3"></span>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div id="menu-management-liquid">
                        <div id="menu-management">
                        <form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
                        <div class="menu-edit ">
                        <div id="nav-menu-header">
                            <div class="major-publishing-actions">
                                <label class="menu-name-label howto open-label" for="menu-name"> <span>Tên menu</span>
                                    <input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
                                    <input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
                                </label>
                                @if(request()->has('action'))
                                <div class="publishing-action">
                                    <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Tạo mới</a>
                                </div>
                                @elseif(request()->has("menu"))
                                <div class="publishing-action">
                                    <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Lưu tên menu</a>
                                    <span class="spinner" id="spincustomu2"></span>
                                </div>
                                @else
                                <div class="publishing-action">
                                    <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Tạo mới menu</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div id="post-body">
                            <div id="post-body-content">
                                @if(request()->has("menu"))
                                <h3>Cấu trúc menu</h3>
                                <div class="drag-instructions post-body-plain" style="">
                                    <p>
                                       Kéo thả tùy theo ý muốn của bạn. Nhấp vào mũi tên bên phải để tùy chọn cấu hình
                                    </p>
                                </div>
                                @else
                                <h3>Tạo mới menu</h3>
                                <div class="drag-instructions post-body-plain" style="">
                                    <p>Nhập tên và nhấn "Tạo mới menu"</p>
                                </div>
                                @endif
                                <ul class="menu ui-sortable" id="menu-to-edit">
                                    @if(isset($menus))
                                    @foreach($menus as $m)
                                    <li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending m_id{{$m->id}}" style="display: list-item;">
                                    <dl class="menu-item-bar">
                                        <dt class="menu-item-handle">
                                            <span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
                                            <span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
                                        </dt>
                                    </dl>
                                    <div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
                                        <input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
                                    <p class="description description-thin">
                                        <label for="edit-menu-item-title-{{$m->id}}"> Tên hiển thị<br>
                                        <input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
                                        </label>
                                    </p>
                                    <p class="field-css-classes description description-thin">
                                    <label for="edit-menu-item-classes-{{$m->id}}"> Icon
                                        <br>
                                        <input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
                                    </label>
                                    </p>
                                    <p class="field-css-url description description-wide">
                                    <label for="edit-menu-item-url-{{$m->id}}"> Đường dẫn url<br>
                                    <input type="text" id="url_menu_{{$m->id}}" class="widefat code edit-menu-item-url" id="url_menu_{{$m->id}}" value="{{$m->link}}">
                                    </label>
                                    </p>

                                    @if(!empty($roles))
                                    <p class="field-css-role description description-wide">
                                    <label for="edit-menu-item-role-{{$m->id}}"> Role
                                        <br>
                                        <select id="role_menu_{{$m->id}}" class="widefat code edit-menu-item-role" name="role_menu_[{{$m->id}}]" >
                                            <option value="0">Select Role</option>
                                            @foreach($roles as $role)
                                                <option @if($role->id == $m->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    </p>
                                    @endif
                                    <p class="field-move hide-if-no-js description description-wide">
                                    <label> <span>Di chuyển</span> <a href="{{ $currentUrl }}" class="menus-move-up" style="display: none;">Lên trên</a> <a href="{{ $currentUrl }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Xuống dưới</a> <a href="{{ $currentUrl }}" class="menus-move-left" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-right" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-top" style="display: none;">Lên đầu</a> 
                                    </label>
                                    </p>
                                    <div style="margin-right: 10px;margin-top: 10px;">
                                    <label> Lọc theo </label>
                                    <select name="form_filter" id="checkfilter{{$m->id}}" class="form_filter">
                                    <option value="0" selected="selected">Chọn</option>
                                    <option value="1" {{$m->form_filter == 1 ? 'selected':false}}>Thuộc tính </option>
                                    <option value="2" {{$m->form_filter == 2 ? 'selected':false}}>Giá </option>
                                    </select>
                                    </div>
                                    <div id="form_filter{{$m->id}}" style="margin-right: 10px;margin-top: 10px;float: left;">
                                       {{--  <ul class="nav nav-tabs" id="myTab{{$m->id}}" role="tablist">
                                            <li class="nav-item" role="presentation">
                                            <button class="nav-link active bg-white px-4 text-gray-800 font-semibold py-2 rounded-t -mb-px" id="property_tab{{$m->id}}" data-bs-toggle="tab" data-bs-target="#properties{{$m->id}}" type="button" role="tab" aria-controls="properties{{$m->id}}" aria-selected="true">Thuộc tính</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                            <button class="nav-link bg-white px-4 text-gray-800 font-semibold py-2 rounded-t -mb-px" id="price_tab{{$m->id}}" data-bs-toggle="tab" data-bs-target="#price{{$m->id}}" type="button" role="tab" aria-controls="price{{$m->id}}" aria-selected="false">Giá</button>
                                            </li>
                                        </ul> --}}
                                        <div class="tab-content" id="myTabContent{{$m->id}}">
                                            <div class="" id="properties{{$m->id}}" role="tabpanel" aria-labelledby="property_tab{{$m->id}}">
                                        <select name="list_property" id="list_property{{$m->id}}" class="listcate">
                                            @if($m->property ==null || $m->property ==0)
                                                <option value="0">Chọn thuộc tính</option>
                                                @endif
                                                @foreach ($list_property as $val)
                                                @if($val->cate_id == $m->category_id)
                                                <option value="{{ $val->id}}" {{$m->property == $val->id ? 'selected':false}}>
                                                    {{ $val->name}}
                                                @endif
                                                @endforeach
                                        </select>
                                            </div>
                                            <div class="" id="price{{$m->id}}" role="tabpanel" aria-labelledby="price_tab{{$m->id}}">
                                                <input type="number" id="from_price{{$m->id}}" min="0" max="1000000000000" class="widefat code edit-menu-item-classes min_price" name="min_price" value="{{$m->min_price}}">
                                                <input type="number" id="to_price{{$m->id}}" min="0" max="1000000000000" class="widefat code edit-menu-item-classes max_price" name="max_price" value="{{$m->max_price}}">
                                                
                                            </div>
                                            <div>
                                                Thương hiệu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item-actions description-wide submitbox">
                                        <a class="item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Xóa</a>
                                        <span class="meta-sep hide-if-no-js"> | </span>
                                        <a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Hủy</a>
                                        <span class="meta-sep hide-if-no-js"> | </span>
                                        <a onclick="getmenus()" class="button button-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Cập nhật</a>
                                        <a class="button button-primary updatemenu"  href="https://fontawesome.com/v5/search" target="_blank">Lấy icon</a>
                                    </div>
                                    </div>
                                    <ul class="menu-item-transport"></ul>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="menu-settings">
                                </div>
                            </div>
                        </div>
                        <div id="nav-menu-footer">
                            <div class="major-publishing-actions">

                                @if(request()->has('action'))
                                <div class="publishing-action">
                                    <a name="save_menu" id="save_menu_header" class="button button-primary menu-save">Tạo mới menu</a>
                                </div>
                                @elseif(request()->has("menu"))
                                <span class="delete-action"> <a class="submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(9)">Xóa menu</a> </span>
                                <div class="publishing-action">

                                    <a onclick="getmenus()" name="save_menu" id="save_menu_header2" class="button button-primary menu-save">Lưu menu</a>
                                    <span class="spinner" id="spincustomu2"></span>
                                </div>

                                @else
                                <div class="publishing-action">
                                    <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Tạo mới menu</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    var menus = {
        "oneThemeLocationNoMenus" : "",
        "moveUp" : "Move up",
        "moveDown" : "Mover down",
        "moveToTop" : "Move top",
        "moveUnder" : "Move under of %s",
        "moveOutFrom" : "Out from under  %s",
        "under" : "Under %s",
        "outFrom" : "Out from %s",
        "menuFocus" : "%1$s. Element menu %2$d of %3$d.",
        "subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
    };
    var arraydata = [];     
    var addcustommenur= '{{ route("haddcustommenu") }}';
    var addcustommenur2= '{{ route("haddcustommenu2") }}';
    var updateitemr= '{{ route("hupdateitem")}}';
    var generatemenucontrolr= '{{ route("hgeneratemenucontrol") }}';
    var deleteitemmenur= '{{ route("hdeleteitemmenu") }}';
    var deletemenugr= '{{ route("hdeletemenug") }}';
    var createnewmenur= '{{ route("hcreatenewmenu") }}';
    var csrftoken="{{ csrf_token() }}";
    var menuwr = "{{ url()->current() }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrftoken
        }
    });

</script>
<script src="{{asset('asset/menu/scripts.js')}}"></script>
<script src="{{asset('asset/menu/scripts2.js')}}"></script>
<script src="{{asset('asset/menu/menu.js')}}"></script>
<script src="{{ asset('asset/lib/bootstrap/bootstrap.bundle.min.js') }}"></script>
@endsection