<?php

namespace App\Http\Controllers\laravelmenu\src\Controllers;

use Harimayco\Menu\Facades\Menu;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;

class MenuController extends Controller
{

    public function index(Request $request)
    {
        $menu = new Menus();
        $menuitems = new MenuItems();
        $menulist = $menu->select(['id', 'name'])->get();
        $menulist = $menulist->pluck('name', 'id')->prepend('Chọn menu', 0)->all();
        $category = Category::select('id', 'name')
                    ->where('status',1)
                    ->where('taxonomy', 0)
                    ->get();
        $categorypost = Category::select('id', 'name')
                        ->where('status',1)
                        ->where('taxonomy', 1)
                        ->get();


        if ((request()->has("action") && empty(request()->input("menu"))) || request()->input("menu") == '0') {
            return view('admin.menu.menu')->with("menulist" , $menulist)->with("category",$category);
        } else {

            $menu = Menus::find(request()->input("menu"));
            $menus = $menuitems->getall(request()->input("menu"));

            $data = ['menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist];
            if( config('menu.use_roles')) {
                $data['roles'] = DB::table(config('menu.roles_table'))->select([config('menu.roles_pk'),config('menu.roles_title_field')])->get();
                $data['role_pk'] = config('menu.roles_pk');
                $data['role_title_field'] = config('menu.roles_title_field');
            }
            return view('admin.menu.menu', $data)->with('category',$category)->with('categorypost',$categorypost);
            // ->with('category_lastes', $category_lastes)->with('categorypost_lastes', $categorypost_lastes);
        }
    }


    public function select($name = "menu", $menulist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }


    /**
     * Returns empty array if menu not found now.
     * Thanks @sovichet
     *
     * @param $name
     * @return array
     */
    public static function getByName($name)
    {
        $menu = Menus::byName($name);
        return is_null($menu) ? [] : self::get($menu->id);
    }

    public static function get($menu_id)
    {
        $menuItem = new MenuItems;
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', (integer) $menu_id)->where('parent', 0);

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }


    public function createnewmenu()
    {

        $menu = new Menus();
        $menu->name = request()->input("menuname");
        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }

    public function deleteitemmenu()
    {
        $menuitem = MenuItems::find(request()->input("id"));

        $menuitem->delete();
    }

    public function deletemenug()
    {
        $menus = new MenuItems();
        $getall = $menus->getall(request()->input("id"));
        if (count($getall) == 0) {
            $menudelete = Menus::find(request()->input("id"));
            $menudelete->delete();

            return json_encode(array("resp" => "Xóa thành công mục này"));
        } else {
            return json_encode(array("resp" => "Bạn cần xóa tất cả các mục trong menu trước.", "error" => 1));

        }
    }

    public function updateitem()
    {
        $arraydata = request()->input("arraydata");
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
               
                $menuitem = MenuItems::find($value['id']);

                $menuitem->label = $value['label'];
                $menuitem->link  = $value['link'];
                $menuitem->class = $value['class'];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0 ;
                }
                $menuitem->save();
            }
            
        } else {
            $menuitem = MenuItems::find(request()->input("id"));


            $menuitem->label = request()->input("label");
            $menuitem->link = request()->input("url");
            $menuitem->class = request()->input("clases");
            if (config('menu.use_roles')) {
                $menuitem->role_id = request()->input("role_id") ? request()->input("role_id") : 0 ;
            }
            $menuitem->save();
        }
    }

    public function addcustommenu()
    {
        $menuitem = new MenuItems();
        $menuitem->label = request()->input("labelmenu");
        $menuitem->link = request()->input("linkmenu");
        if (config('menu.use_roles')) {
            $menuitem->role_id = request()->input("rolemenu") ? request()->input("rolemenu")  : 0 ;
        }
        $menuitem->menu = request()->input("idmenu");
        $menuitem->sort = MenuItems::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();
    }

    public function addcustommenu2()
    {         
        foreach (request()->input('list') as $value) {
        $categories = Category::find($value);
        $menuitem   = new MenuItems();
        $menuitem->label = $categories->name;
        $menuitem->link  = $categories->slug;
        $menuitem->class  = $categories->icon;
        $menuitem->menu = request()->input("idmenu");
        $menuitem->sort = MenuItems::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();
        }
    }

    public function generatemenucontrol()
    {
        $menu = Menus::find(request()->input("idmenu"));
        $menu->name = request()->input("menuname");

        $menu->save();
        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {
                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = request()->input("role_id");
                }
                $menuitem->save();
            }
        }
        echo json_encode(array("resp" => 1));

    }
}
