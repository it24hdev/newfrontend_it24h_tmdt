<?php

namespace App\Http\Controllers\Locationmenu;
use App\Models\Locationmenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationmenuController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'locationmenu', 'active' => 'Vị trí menu']);
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $this->authorize('viewAny', Locationmenu::class);
        $limit    =  $request->query('limit');
        $keywords =  $request->query('keywords');
        $orderby  =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if($limit   ==null){$limit   =1000;} 
        if($sort    ==null){$sort    ='asc';}
        if($keywords==null){$keywords="";}
        if($orderby ==null){$orderby ="position";}

        if($limit == 10 && $keywords=="" && $orderby== "position" && $sort =="asc"){
            $Locationmenu = Locationmenu::where('parent_id','=',0)->paginate($limit);
        }
        else
        {
            $Locationmenu = Locationmenu::where('name', 'like', '%' . $keywords . '%')
            ->where('parent_id','=',0)
            ->orderby($orderby,$sort)->Paginate($limit);
        }
        return view('admin.locationmenu.index',[
            'Locationmenu' => $Locationmenu,
            'title'    => 'Danh mục vị trí menu',
        ]);
    }

    public function edit($id)
    {
        $this->authorize('update', Locationmenu::class);
        $edit = Locationmenu::find($id);
        if ($edit !== null) {
            return view('admin.locationmenu.edit',[
                'title' => 'Sửa vị trí danh mục',
                'edit'  => $edit,
            ]);
        } else {
            \abort(404);
        }
    }
    public function update(Request $request, $id)
    {   
        $this->authorize('update', Locationmenu::class);
        $Locationmenus  = Locationmenu::find($id);
        $Locationmenu   = [
            'sidebar'   => $request->has('sidebar'),
            'footer'    => $request->has('footer'),
            'menu'      => $request->has('menu'),
            'rightmenu' => $request->has('rightmenu'),
        ];
        try {
            DB::beginTransaction();
            $Locationmenus->update($Locationmenu);
            DB::commit();
            return redirect()->route('locationmenu.index')->with('success','Cập nhật vị trí danh mục thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('locationmenu.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function resofting_category(Request $request)
    {
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $Locationmenu  = Locationmenu::find($value);
            $Locationmenu->position = $key;
            $Locationmenu->save();
        }
    }

    public function sort($id)
    {
        $Locationmenu = Locationmenu::where('parent_id','=',$id)->orderby('position','asc')->paginate();
        return view('admin.locationmenu.index',[
            'Locationmenu' => $Locationmenu,
            'title'        => 'ID menu cha: '.$id,
        ]);
    }
}
