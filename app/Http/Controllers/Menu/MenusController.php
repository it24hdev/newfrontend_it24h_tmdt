<?php

namespace App\Http\Controllers\Menu;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\admin_menu_items;
use App\Models\Category;
use App\Models\Categoryproperties_manages;
use App\Models\Detailproperties;
use App\Models\Brand;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenusController extends Controller
{
    public function index(Request $request){
        $menu =  admin_menu_items::orderby('stt','asc')->where('parent',0)->where('menu',4)->get();
        $listmenu = [];
        admin_menu_items::recursive($menu, $parents = 0, $level = 1, $listmenu);
        return view('admin.menu.index',[
            'menus' => $listmenu,
            'title' => 'Menu',
        ]);
    }

    public function store(Request $request)
    {
        $category_code ="";
        $category_id ="";
        $filter_by ="";
        $filter_value ="";
        if($request->type_menu  == 1){
            if(!empty($request->categories_product) && $request->categories_product!=0){
                $category_code  = Category::select('ma')->where('id',$request->categories_product)->first();
                $category_id  = $request->categories_product;
            }
            if(!empty($request->filter_by) && $request->filter_by!=0){
                $filter_by = $request->filter_by;
            }
            if(!empty($request->detailproperty) && $request->detailproperty!=0){
                $filter_value = $request->detailproperty;
            }
        }
        $Menuitem  = [
            'name'      => $request->label,
            'ma'        => $request->ma,
            'stt'        => $request->stt,
            'class'        => $request->class,
            'link'        => $request->link,
            'category_code'      => $category_code,
            'category_id'      => $category_id,
            'filter_by'        => $filter_by,
            'filter_value'        => $filter_value,

            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            Category::create($Category);

            DB::commit();
            //xu ly hinh anh danh muc sau khi luu
            $folder = 'upload/images/products/';
            $folder_thumb    = 'upload/images/products/thumb/';
            if ($request->hasFile('thumb')) {
                $file = CommonHelper::uploadImage($request->thumb, $nameFile, $folder);
                CommonHelper::cropImage2($file, $nameFile, 300, 300, $folder_thumb);
            }
            //xu ly luu vi tri danh muc sau khi luu danh muc
            if ($request->hasFile('banner')) {
                $file_banner = CommonHelper::uploadImage($request->banner, $nameFileBanner, $folder);
                CommonHelper::cropImage2($file_banner, $nameFileBanner, 180, 324, $folder_thumb);
            }
            return redirect()->route('category.index')->with('success','Thêm danh mục mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
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
        $menu =  admin_menu_items::orderby('stt','asc')->where('menu',4)->where('parent',$request->id)->get();
        $listmenu = [];
        admin_menu_items::recursive($menu, $parents = $request->id, $level = 2, $listmenu);
        $view2     = view('admin.menu.childitems', [
            'menus' => $listmenu,
        ])->render();
        return response()->json(['html'=>$view2]);
    }

    public function get_menu(Request $request){
        $menu =  admin_menu_items::orderby('stt','asc')->where('menu',4)->get();
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

    public function get_brand(Request $request){
        $data  = Brand::get();
        return response()->json(['listbrand' => $data]);
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
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }


}
