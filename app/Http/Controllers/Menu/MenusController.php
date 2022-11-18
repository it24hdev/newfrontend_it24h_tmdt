<?php

namespace App\Http\Controllers\Menu;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\admin_menu_items;
use App\Models\admin_menus;
use App\Models\Category;
use App\Models\Categoryproperties_manages;
use App\Models\Categoryproperty;
use App\Models\Detailproperties;
use App\Models\Brand;
use App\Models\Post;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MenuExport;
use App\Imports\MenuImport;

class MenusController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'menu', 'active' => 'Menu']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $listmenu = admin_menus::get();
        $menu ="";
        $listmenuitem = [];
        if(!empty($request->select_menu)){
            $menu =  admin_menu_items::orderby('stt','asc')->where('parent',0)->where('menu',$request->select_menu)->get();
            admin_menu_items::recursive($menu, $parents = 0, $level = 1, $listmenuitem);
            return view('admin.menu.index',[
                'menus' => $listmenuitem,
                'listmenu' => $listmenu,
                'menu' => $request->select_menu,
                'title' => 'Menu',
            ]);
        }
        else{
            return view('admin.menu.index',[
                'menus' => $listmenuitem,
                'listmenu' => $listmenu,
                'menu' => $menu,
                'title' => 'Menu',
            ]);
        }
    }

    public function addnewmenu(Request $request){
        $newmenu  = [
            'name'          => $request->new_menu
        ];
        try {
            DB::beginTransaction();
            $addmenu = admin_menus::create($newmenu);
            DB::commit();
            return redirect()->route('menu.index',['select_menu' => $addmenu->id])->with('success','Thêm menu thành công');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('menu.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function destroymenu(Request $request){
        $destroymenu = admin_menus::find($request->id_menu);
        $destroymenuitem = DB::table('admin_menu_items')->where('menu',$request->id_menu);
        if(!is_null($destroymenu)) {
            if(!is_null($destroymenuitem)){
                $destroymenuitem->delete();
                $destroymenu->delete();
            }
            return response()->json(['success'=>true]);
        }
        else{
            return response()->json(['error'=>true]);
//            return redirect()->back()->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function store(Request $request)
    {
        $category_code = $category_id = $filter_by = $filter_value = $brand = "";
        $price_from = $price_to = 0 ;
        if(!empty($request->price_from)){
            $price_from =  $request->price_from;
        }
        if(!empty($request->price_to)){
            $price_to =  $request->price_to;
        }
        if($request->type_menu  == 1){
            if(!empty($request->categories_product) && $request->categories_product!=0){
                $category_code  = Category::where('id',$request->categories_product)->first();
                if(!empty($category_code)){
                    $category_code  = $category_code->ma;
                    $category_id    = $request->categories_product;
                }
            }
            if(!empty($request->filter_by) && $request->filter_by!=0){
                $filter_by = $request->filter_by;
                if($filter_by == 1){
                    if(!empty($request->detailproperty) && $request->detailproperty!=0){
                        $filter_value = $request->detailproperty;
                    }
                }
                elseif ($filter_by == 2){
                       $filter_value = $price_from.";".$price_to;
                }
                elseif ($filter_by  == 3){
                    if(!empty($request->brand)){
                        $filter_value  = $request->brand;
                    }
                }
                else{
                }
            }
        }
        if($request->type_menu  == 2){
            if(!empty($request->categories_post) && $request->categories_post!=0){
                $category_code  = Category::where('id',$request->categories_post)->first();
                if(!empty($category_code)){
                    $category_code  = $category_code->ma;
                    $category_id    = $request->categories_post;
                }
            }
        }
        if($request->type_menu  == 3){
            if(!empty($request->post) && $request->type_menu!=0){
                $post  = Post::where('id',$request->post)->first();
                if(!empty($post)){
                    $category_id    = $post->id;
                }
            }
        }
        $Menuitem  = [
            'label'           => $request->label,
            'ma'              => $request->ma,
            'class'           => $request->class,
            'stt'             => $request->stt,
            'parent'          => $request->parent,
            'link'            => $request->link,
            'menu'            => $request->menu,
            'type_menu'       => $request->type_menu,
            'category_code'   => $category_code,
            'category_id'     => $category_id,
            'filter_by'       => $filter_by,
            'filter_value'    => $filter_value,
            'status'          => $request->has('status'),
        ];
        try {
            DB::beginTransaction();
            admin_menu_items::create($Menuitem);
            DB::commit();
            return redirect()->back()->with('success','Thêm thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }


    public function update(Request $request, $id)
    {
        $category_code = $category_id = $filter_by = $filter_value = $brand = "";
        $price_from = $price_to = 0 ;
        if(!empty($request->price_from)){
            $price_from =  $request->price_from;
        }
        if(!empty($request->price_to)){
            $price_to =  $request->price_to;
        }
        if($request->type_menu  == 1){
            if(!empty($request->categories_product) && $request->categories_product!=0){
                $category_code  = Category::where('id',$request->categories_product)->first();
                if(!empty($category_code)){
                    $category_code  = $category_code->ma;
                    $category_id    = $request->categories_product;
                }
            }
            if(!empty($request->filter_by) && $request->filter_by!=0){
                $filter_by = $request->filter_by;
                if($filter_by == 1){
                    if(!empty($request->detailproperty) && $request->detailproperty!=0){
                        $filter_value = $request->detailproperty;
                    }
                }
                elseif ($filter_by == 2){
                    $filter_value = $price_from.";".$price_to;
                }
                elseif ($filter_by  == 3){
                    if(!empty($request->brand)){
                        $filter_value  = $request->brand;
                    }
                }
                else{
                }
            }
        }
        if($request->type_menu  == 2){
            if(!empty($request->categories_post) && $request->categories_post!=0){
                $category_code  = Category::where('id',$request->categories_post)->first();
                if(!empty($category_code)){
                    $category_code  = $category_code->ma;
                    $category_id    = $request->categories_post;
                }
            }
        }
        if($request->type_menu  == 3){
            if(!empty($request->post) && $request->type_menu!=0){
                $post  = Post::where('id',$request->post)->first();
                if(!empty($post)){
                    $category_id    = $post->id;
                }
            }
        }
        $Menuitems = admin_menu_items::find($id);
        $Menuitem  = [
            'label'           => $request->label,
            'ma'              => $request->ma,
            'class'           => $request->class,
            'stt'             => $request->stt,
            'parent'          => $request->parent,
            'link'            => $request->link,
            'menu'            => $request->menu,
            'type_menu'       => $request->type_menu,
            'category_code'   => $category_code,
            'category_id'     => $category_id,
            'filter_by'       => $filter_by,
            'filter_value'    => $filter_value,
            'status'          => $request->has('status'),
        ];
        try {
            DB::beginTransaction();
            $Menuitems->update($Menuitem);
            DB::commit();
            return response()->json(['success'=>true,'idmenu' => $request->menu]);
//            return redirect()->route('menu.index',['select_menu'=>$request->menu])->with('success','Cập nhật thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error'=>true,'idmenu' => $request->menu]);
//            return redirect()->route('menu.index',['select_menu'=>$request->menu])->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function change_number_menuitem(Request $request){
        $menu = admin_menu_items::find($request->id);
        if($request->id!=null) {
            $menu->stt = $request->val;
            $menu->save();
            return response()->json(['success' => 'Hoàn thành']);
        }
        else{
            return response()->json(['error' => 'Đã có lỗi xảy ra']);
        }
    }
    public function get_menuitem_ajax(Request $request){
        $menu =  admin_menu_items::orderby('stt','asc')->where('menu',1)->where('parent',$request->id)->get();
        $listmenu = [];
        admin_menu_items::recursive($menu, $parents = $request->id, $level = 2, $listmenu);
        $view2     = view('admin.menu.childitems', [
            'menus' => $listmenu,
        ])->render();
        return response()->json(['html'=>$view2]);
    }

    public function get_location_menu(Request $request){
        $menu="";
        if(!is_null($request->id_menu)){
            $menu =  admin_menu_items::orderby('stt','asc')->where('menu',$request->id_menu)->get();
        }
        $listmenu = [];
        admin_menu_items::recursive($menu, $parents = 0, $level = 1, $listmenu);
        return response()->json(['listmenu' => $listmenu]);
    }

    public function get_categories_product(Request $request){
        $data = Category::where('taxonomy', '=', 0)->where('status',1)->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);
        return response()->json(['listcategory' => $listcategory]);
    }

    public function get_categories_post(Request $request){
        $data = Category::where('taxonomy', 1)->where('status',1)
            ->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);
        return response()->json(['listcategory' => $listcategory]);
    }
    public function get_post(Request $request){
        $data = Post::where('status',1)->get();
        return response()->json(['listpost' => $data]);
    }

    public function get_property(Request $request){
        $data = null;
        if(!empty($request->cat_id)){
            $data  = Categoryproperties_manages::where('category_id',$request->cat_id)->groupby('id')->get();
        }
        return response()->json(['listproperty' => $data]);
    }

    public function get_property_edit(Request $request){
        $data = null;
        $selected_data = null;
        $detailproperties_data = null;
        $filter_value = $request->filter_value;
        if(!empty($request->filter_value)){
            if(!empty($request->cat_id)) {
                $id_category_properties = Categoryproperty::select('categoryproperties.*')->leftjoin('detailproperties', 'categoryproperties.id', 'detailproperties.categoryproperties_id')
                    ->leftjoin('categoryproperties_manages','categoryproperties_manages.categoryproperties_id','categoryproperties.id')
                    ->where('categoryproperties_manages.category_id',$request->cat_id)
                    ->where('detailproperties.ma', $filter_value)
                    ->groupby('categoryproperties_manages.id')->first();
                $selected_data = Categoryproperties_manages::where('category_id', $request->cat_id)->where('categoryproperties_id',$id_category_properties->id)->groupby('id')->first();
                $data = Categoryproperties_manages::where('category_id', $request->cat_id)
                    ->where('id','<>',$selected_data->id)->groupby('id')->get();
                $detailproperties_data = Detailproperties::where('categoryproperties_id', function($query) use($filter_value){
                    $query->select('categoryproperties_id')->from('detailproperties')->where('ma',$filter_value);
                })->get();
                }
        }
        else{
            if(!empty($request->cat_id)){
                $data  = Categoryproperties_manages::where('category_id',$request->cat_id)->groupby('id')->get();
            }
        }

        return response()->json(['listproperty' => $data,'selected_property' => $selected_data,'detailproperties_data'=>$detailproperties_data]);
    }

    public function get_brand(Request $request){
        $data  = Brand::get();
        return response()->json(['listbrand' => $data]);
    }

    public function get_brand_edit(Request $request){
        $data = null;
        $selected_data = null;
        $filter_value = $request->filter_value;
        if(!empty($filter_value)){
            $selected_data  = Brand::where('name',$filter_value)->first();
            $data  = Brand::where('name','<>',$filter_value)->get();
        }
        else{
            $data  = Brand::get();
        }
        return response()->json(['listbrand' => $data,'selected_brand'=>$selected_data]);
    }

    public function get_detail_property(Request $request){
        $data = null;
        if(!empty($request->attr_id)){
            $data  = Detailproperties::where('categoryproperties_id',$request->attr_id)->groupby('id')->get();
        }
        return response()->json(['listdetailproperty' => $data]);
    }

    public function destroy(Request $request)
    {
        $menu_item     = admin_menu_items::find($request->id);
        if (!is_null($menu_item)){
            $menu_item->delete();
            $menu="";
            if(!is_null($request->id_menu)){
                $menu =  admin_menu_items::orderby('stt','asc')->where('menu',$request->id_menu)->get();
            }
            $listmenu = [];
            admin_menu_items::recursive($menu, $parents = 0, $level = 1, $listmenu);
            return response()->json(['success'=>true,'listmenu' => $listmenu]);
        }
        return \json_encode(array('success'=>false));
    }
    public function edit(Request $request, $id)
    {
        $admin_menu_items = admin_menu_items::find($id);
        if ($admin_menu_items !== null) {
            return view('admin.menu.edit', [
                'title' => 'Sửa menu',
                'admin_menu_items' => $admin_menu_items,
            ]);
        } else {
            \abort(404);
        }
    }

    public function export($menu)
    {
        return Excel::download(new MenuExport($menu), 'Menu.xlsx');
    }

    public function import($menu)
    {
        if(!empty(request()->file('file')))
            Excel::import(new MenuImport($menu),request()->file('file'));
        return back();
    }
}
