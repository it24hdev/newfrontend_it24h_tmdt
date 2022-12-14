<?php

namespace App\Http\Controllers\Categoryproperty;

use App\Http\Controllers\Controller;
use App\Models\Categoryproperty;
use App\Models\Categoryproperties_manages;
use App\Models\Detailproperties;
use App\Models\Products;
use App\Exports\PropertyExport;
use App\Imports\PropertyImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Validator;
use Response;
use Redirect;

class Category_propertyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'products', 'active' => 'Danh mục thuộc tính']);
            return $next($request);
        });
    }
    
    public function index(Request $request)
    {
        $keywords =  $request->query('keywords');
        $data ="";
        if(!empty($keywords)){
            $data = Categoryproperty::where('name', 'like', '%' . $keywords . '%')
            ->orwhere('ma', 'like', '%' . $keywords . '%')
            ->paginate(100);
        }
        else{
             $data = Categoryproperty::Paginate(15);
        }
        return view('admin.categoryproperty.index',[
            'category_propertys' => $data,
            'title'    => 'Danh mục thuộc tính',
        ]);
    }

    public function create()
    {
        return view('admin.categoryproperty.create',[
            'title' => 'Thêm thuộc tính',
        ]);
    }

    public function createdetail($id)
    {
        return view('admin.categoryproperty.createdetail',[
            'title' => 'Thêm thuộc tính chi tiết',
            'categoryproperty_id' => $id,
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'ma'     => 'required|max:255|unique:categories,ma',
        //     'slug'   => 'required',
        //     'name'   => 'required',
        //     'thumb'  => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        //     'banner' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        // ],
        // [
        //     'ma.required' => 'Mã danh mục không được phép bỏ trống',
        //     'ma.max'      => 'Mã danh mục không được phép vượt quá 255 ký tự',
        //     'ma.unique'   => 'Mã danh mục đã tồn tại',
        //     'name.required' => 'Tên danh mục không được phép bỏ trống',
        //     'slug.required' => 'Tên slug không được phép bỏ trống',
        //     'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
        //     'banner.image'  => 'Ảnh banner không đúng định dạng! (jpg, jpeg, png)',
        // ]);

        $Categoryproperty  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'explain'   => $request->explain,
            'stt'       => $request->stt,
            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            Categoryproperty::create($Categoryproperty);
            DB::commit();
            return redirect()->route('category_property.index')->with('success','Thêm mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }  
    }

    public function storedetail(Request $request, $id)
    {

        $Categoryproperty = Categoryproperty::find($id);
        $detailproperty  = [
            'name'  => $request->name,
            'ma'  => $request->ma,
            'stt'   => $request->stt,
            'explain'   => $request->explain,
            'categoryproperties_id' => $id,
            'categoryproperties_code' => $Categoryproperty->ma,
        ];

        $detailproperties  = Detailproperties::where('categoryproperties_id',$id)->get();

        // dd($detailproperties);

        try {
            DB::beginTransaction();
            Detailproperties::create($detailproperty);
            DB::commit();
            return redirect()->route('category_property.edit',$id)->with('detailproperties',$detailproperties)->with('success','Thêm mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.edit',$id)->with('detailproperties',$detailproperties)->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }  
    }
    
    public function show(category_property $category_property)
    {
        
    }

    public function edit(Request $request, $id)
    {

        $category_property = Categoryproperty::find($id);
        $detailproperties  = Detailproperties::where('categoryproperties_id',$category_property->id)->get();
        if ($category_property !== null) {
            return view('admin.categoryproperty.edit',[
                'title'  => 'Sửa thuộc tính',
                'category_property' => $category_property,
                'detailproperties'  => $detailproperties,
            ]);
        } else {
            \abort(404);
        }
    }

    public function editdetail(Request $request, $id, $id_categoryproperty)
    {
        $detail_property = Detailproperties::find($id);
        if ($detail_property !== null) {
            return view('admin.categoryproperty.editdetail',[
                'title'  => 'Sửa chi tiết thuộc tính',
                'detail_property'  => $detail_property,
                'id_detailproperty' => $id,
                'id_categoryproperty' => $id_categoryproperty,
            ]);
        } else {
            \abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'ma'    => 'required|max:255|unique:categories,ma,'.$id.',id',
        //     'slug'  => 'required',
        //     'name'  => 'required',
        //     'thumb' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        //     'banner' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        // ],
        // [
        //     'ma.required' => 'Tên danh mục không được phép bỏ trống',
        //     'ma.max'      => 'Tên danh mục không được phép vượt quá 255 ký tự',
        //     'ma.unique'   => 'Mã danh mục đã tồn tại',
        //     'slug.required' => 'Tên slug không được phép bỏ trống',
        //     'name.required' => 'Tên danh mục không được phép bỏ trống',
        //     // 'slug.max'      => 'Tên slug không được phép vượt quá 255 ký tự',
        //     // 'slug.unique'   => 'Tên slug đã tồn tại',
        //     'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
        //     'banner.image'   => 'Ảnh banner không đúng định dạng! (jpg, jpeg, png)',
        // ]); 
        $category_properties = Categoryproperty::find($id);
        if(empty($category_properties)){
            return \abort(404);
        }
     
        $category_property  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'explain'   => $request->explain,
            'stt'      => $request->stt,
            'status'    => $request->has('status'),
        ];
        try {
            DB::beginTransaction();
            $category_properties->update($category_property);
            DB::table('categoryproperties_manages')->where('categoryproperties_id', $id)
              ->update([
                'ma' => $request->ma,
                'name'=> $request->name,
              ]);
            Detailproperties::where('categoryproperties_id',$id)->update(['categoryproperties_code' => $request->ma]);
            DB::commit();
            return redirect()->route('category_property.index')->with('success','Cập nhật danh mục thuộc tính thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        } 
    }

    public function updatedetail(Request $request, $id)
    {

        $Detailproperties = Detailproperties::find($id);
        $detailproperty  = [
            'name'  => $request->name,
            'ma'  => $request->ma,
            'stt'   => $request->stt,
            'explain'   => $request->explain,
        ];

        $detailproperties_list  = Detailproperties::where('categoryproperties_id',$request->id)->get();

        try {
            DB::beginTransaction();
            $Detailproperties->update($detailproperty);
            DB::commit();
            return redirect()->route('category_property.edit',$request->id)->with('detailproperties',$detailproperties_list)->with('success','Cập nhật thuộc tính thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.edit',$request->id)->with('detailproperties',$detailproperties_list)->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }  
    }

    public function destroy(Request $request)
    {
        $Categoryproperty     = Categoryproperty::find($request->id);
        $detailproperties = DB::table('detailproperties')->where('categoryproperties_id', $request->id);
        $Categoryproperties_manages = DB::table('categoryproperties_manages')->where('categoryproperties_id', $request->id);
        if (!is_null($Categoryproperty)){
            $Categoryproperty->delete();
            if (!is_null($detailproperties)){
                $detailproperties_value = $detailproperties->get();
            foreach($detailproperties_value as $value){
                $Propertyproducts = DB::table('propertyproducts')->where('detailproperties_id', $value->id);
                $Propertyproducts->delete();
            }
            $detailproperties->delete();
            }
            if (!is_null($Categoryproperties_manages)){
            $Categoryproperties_manages->delete();
            }
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }

    public function destroydetail(Request $request)
    {
        $Detailproperty     = Detailproperties::find($request->id);
        $Propertyproducts = DB::table('propertyproducts')->where('detailproperties_id', $request->id);
        if (!is_null($Detailproperty)){
            $Detailproperty->delete();
            if (!is_null($Propertyproducts)){
            $Propertyproducts->delete();
            }
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }

    public function export() 
    {
        return Excel::download(new PropertyExport, 'property.xlsx');
    }

    public function import() 
    {
        if(!empty(request()->file('file')))
        Excel::import(new PropertyImport,request()->file('file')); 
        return back();
    }
}
