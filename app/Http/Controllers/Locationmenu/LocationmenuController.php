<?php

namespace App\Http\Controllers\Locationmenu;
use App\Models\Locationmenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;

class LocationmenuController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'menu', 'active' => 'Vị trí menu']);
            return $next($request);
        });
    }


    public function index(Request $request){}
    public function edit2()
    {
        $this->authorize('update', Locationmenu::class);
            $Menus =  Menus::get();
            $menu_locations = Locationmenu::find(1);
            $sidebar_locations = Locationmenu::find(2);
            $footer_locations = Locationmenu::find(3);
            $rightmenu_locations = Locationmenu::find(4);

            return view('admin.locationmenu.edit2',[
                'title' => 'Sửa vị trí menu',
                'Menus' => $Menus,
                'menu_locations' => $menu_locations->menu_location,
                'sidebar_locations' => $sidebar_locations->sidebar_location,
                'footer_locations' => $footer_locations->footer_location,
                'rightmenu_locations' => $rightmenu_locations->rightmenu_location,
            ]);
    }

    public function update(Request $request)
    {   
        $this->authorize('update', Locationmenu::class);

        $menu_locations  = Locationmenu::find(1);
        $menu_location   = [
            'menu_location'      => $request->menu_location,
        ];

        $sidebar_locations  = Locationmenu::find(2);
        $sidebar_location   = [
            'sidebar_location'      => $request->sidebar_location,
        ];

        $footer_locations  = Locationmenu::find(3);
        $footer_location   = [
            'footer_location'      => $request->footer_location,
        ];

        $rightmenu_locations  = Locationmenu::find(4);
        $rightmenu_location   = [
            'rightmenu_location'      => $request->rightmenu_location,
        ];
        try {
             DB::beginTransaction();
            $menu_locations->update($menu_location);
            $sidebar_locations->update($sidebar_location);
            $footer_locations->update($footer_location);
            $rightmenu_locations->update($rightmenu_location);
            DB::commit();
            return redirect()->route('locationmenu.edit')->with('success','Cập nhật vị trí menu thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('locationmenu.edit')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
}
