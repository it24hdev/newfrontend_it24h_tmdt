@extends('admin.layouts.main')
@section('subcontent')
    <?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="{{asset('asset/menu/style.css')}}" rel="stylesheet">
<div id="hwpwrap">
    <div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
        <div id="wpwrap">
            <div id="wpcontent">
                <div id="wpbody">
                    <div id="wpbody-content">

                        <div class="wrap">

                            <nav class="nav-tab-wrapper wp-clearfix" aria-label="Menu thứ hai">
                                <a href="{{route('menu')}}" class="nav-tab nav-tab-active" aria-current="page">Sửa menu</a>
                                <a href="{{route('locationmenu.edit')}}" class="nav-tab">Quản lý vị trí menu</a>
                            </nav>
                            <div class="manage-menus">
                                <form method="get" action="{{ $currentUrl }}">
                                    <label for="menu" class="selected-menu">Select the menu you want to edit:</label>
                                    <select name="menu">
                                    @foreach($menulist as $key => $val)
                                   <option value="{{$key}}" @if(request()->input('menu') == $key) selected="selected" @endif>{{ $val }}</option>
                                    @endforeach
                                    </select>
                                    <span class="submit-btn">
                                        <input type="submit" class="button-secondary" value="Choose">
                                    </span>
                                    <span class="add-new-menu-action"> or <a href="{{ $currentUrl }}?action=edit&menu=0">Create new menu</a>. </span>
                                </form>
                            </div>
                            <div id="nav-menus-frame">

                                @if(request()->has('menu')  && !empty(request()->input("menu")))
                                <div id="menu-settings-column" class="metabox-holder">

                                    <div class="clear"></div>

                                    <form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
                                        <div id="side-sortables" class="accordion-container">
                                            <ul class="outer-border">
                                                <li class="control-section accordion-section open add-page" id="add-page">
                                                    <h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
                                                    <div class="accordion-section-content ">
                                                        <div class="inside">
                                                            <div class="customlinkdiv" id="customlinkdiv">
                                                                <p id="menu-item-url-wrap">
                                                                    <label class="howto" for="custom-menu-item-url"> <span>URL</span>&nbsp;&nbsp;&nbsp;
                                                                        <input id="custom-menu-item-url" name="url" type="text" class="menu-item-textbox " placeholder="url">
                                                                    </label>
                                                                </p>

                                                                <p id="menu-item-name-wrap">
                                                                    <label class="howto" for="custom-menu-item-name"> <span>Label</span>&nbsp;
                                                                        <input id="custom-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
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

                                                                <p class="button-controls">

                                                                    <a  href="#" onclick="addcustommenu()"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
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
                                                                            Mới nhất                </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="nav-tab-link" data-type="page-all" href="/wp-admin/nav-menus.php?page-tab=all#page-all">
                                                                            Xem tất cả              </a>
                                                                    </li>
                                                                    
                                                                </ul>   

                                                                <div id="tabs-panel-posttype-page-most-recent" class="tabs-panel tabs-panel-active" role="region" aria-label="Mới nhất" tabindex="0">
                                                                    <ul id="pagechecklist-most-recent" class="categorychecklist form-no-clear">
                                                                        @foreach($category_lastes as $cate_lastes)
                                                                        <li>
                                                                            <label class="menu-item-title">
                                                                                <input type="checkbox" class="menu-item-checkbox" name="{{$cate_lastes->id}}" value="">{{$cate_lastes->name}}
                                                                            </label>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                                <div id="page-all" class="tabs-panel tabs-panel-inactive" role="region" aria-label="Tất cả" tabindex="1">
                                                                    <ul id="pagechecklist-all-recent" class="categorychecklist form-no-clear">
                                                                        @foreach($category as $cate2)
                                                                        <li>
                                                                            <label class="menu-item-title">
                                                                                <input type="checkbox" class="menu-item-checkbox" name="{{$cate2->id}}" value="">{{$cate2->name}}
                                                                            </label>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>


                                                                <p class="button-controls">

                                                                    <a  href="#" onclick="addcustommenu2()"  class="button-secondary submit-add-to-menu right">Add menu item</a>
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
                                                                            Mới nhất                </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="nav-tab-link" data-type="page-all3" href="/wp-admin/nav-menus.php?page-tab=all#page-all3">
                                                                            Xem tất cả              </a>
                                                                    </li>
                                                                   
                                                                </ul>   

                                                                <div id="tabs-panel-posttype-page-most-recent3" class="tabs-panel tabs-panel-active" role="region" aria-label="Mới nhất" tabindex="0">
                                                                    <ul id="pagechecklist-most-recent3" class="categorychecklist form-no-clear">
                                                                        @foreach($categorypost_lastes as $cate_lastes3)
                                                                        <li>
                                                                            <label class="menu-item-title">
                                                                                <input type="checkbox" class="menu-item-checkbox" name="{{$cate_lastes3->id}}" value="">{{$cate_lastes3->name}}
                                                                            </label>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                                <div id="page-all3" class="tabs-panel tabs-panel-inactive" role="region" aria-label="Tất cả" tabindex="1">
                                                                    <ul id="pagechecklist-all-recent3" class="categorychecklist form-no-clear">
                                                                        @foreach($categorypost as $cate3)
                                                                        <li>
                                                                            <label class="menu-item-title">
                                                                                <input type="checkbox" class="menu-item-checkbox" name="{{$cate3->id}}" value="">{{$cate3->name}}
                                                                            </label>
                                                                        </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>


                                                                <p class="button-controls">

                                                                    <a  href="#" onclick="addcustommenu3()"  class="button-secondary submit-add-to-menu right">Add menu item</a>
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
                                                        <label class="menu-name-label howto open-label" for="menu-name"> <span>Name</span>
                                                            <input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
                                                            <input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
                                                        </label>

                                                        @if(request()->has('action'))
                                                        <div class="publishing-action">
                                                            <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
                                                        </div>
                                                        @elseif(request()->has("menu"))
                                                        <div class="publishing-action">
                                                            <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
                                                            <span class="spinner" id="spincustomu2"></span>
                                                        </div>

                                                        @else
                                                        <div class="publishing-action">
                                                            <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div id="post-body">
                                                    <div id="post-body-content">

                                                        @if(request()->has("menu"))
                                                        <h3>Menu Structure</h3>
                                                        <div class="drag-instructions post-body-plain" style="">
                                                            <p>
                                                                Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
                                                            </p>
                                                        </div>

                                                        @else
                                                        <h3>Menu Creation</h3>
                                                        <div class="drag-instructions post-body-plain" style="">
                                                            <p>
                                                                Please enter the name and select "Create menu" button
                                                            </p>
                                                        </div>
                                                        @endif

                                                        <ul class="menu ui-sortable" id="menu-to-edit">
                                                            @if(isset($menus))
                                                            @foreach($menus as $m)
                                                            <li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
                                                                <dl class="menu-item-bar">
                                                                    <dt class="menu-item-handle">
                                                                        <span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
                                                                        <span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
                                                                    </dt>
                                                                </dl>

                                                                <div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
                                                                    <input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
                                                                    <p class="description description-thin">
                                                                        <label for="edit-menu-item-title-{{$m->id}}"> Label
                                                                            <br>
                                                                            <input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
                                                                        </label>
                                                                    </p>

                                                                    <p class="field-css-classes description description-thin">
                                                                        <label for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)
                                                                            <br>
                                                                            <input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
                                                                        </label>
                                                                    </p>

                                                                    <p class="field-css-url description description-wide">
                                                                        <label for="edit-menu-item-url-{{$m->id}}"> Url
                                                                            <br>
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
                                                                        <label> <span>Move</span> <a href="{{ $currentUrl }}" class="menus-move-up" style="display: none;">Move up</a> <a href="{{ $currentUrl }}" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{ $currentUrl }}" class="menus-move-left" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-right" style="display: none;"></a> <a href="{{ $currentUrl }}" class="menus-move-top" style="display: none;">Top</a> </label>
                                                                    </p>

                                                                    <div class="menu-item-actions description-wide submitbox">

                                                                        <a class="item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
                                                                        <span class="meta-sep hide-if-no-js"> | </span>
                                                                        <a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$m->id}}" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Cancel</a>
                                                                        <span class="meta-sep hide-if-no-js"> | </span>
                                                                        <a onclick="getmenus()" class="button button-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update item</a>

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
                                                            <a name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
                                                        </div>
                                                        @elseif(request()->has("menu"))
                                                        <span class="delete-action"> <a class="submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(9)">Delete menu</a> </span>
                                                        <div class="publishing-action">

                                                            <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
                                                            <span class="spinner" id="spincustomu2"></span>
                                                        </div>

                                                        @else
                                                        <div class="publishing-action">
                                                            <a  name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
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

                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
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
@endsection