<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\admin_menu_items;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $data = Category::where('taxonomy', '=', 0)->where('status',1)->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);

        return response()->json([
            'listmenu' => $listmenu,
            'listcategory' => $listcategory,
            ]);
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
