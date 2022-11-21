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
use App\Helpers\CommonHelper;
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
        $request->validate([
            'image'  => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
            [
                'image.image'   => 'Ảnh không đúng định dạng! (jpg, jpeg, png)',
            ]);
        $nameFile = Detailproperties::IMAGE;
        if ($request->image  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        }
        $Categoryproperty  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'explain'   => $request->explain,
            'stt'       => $request->stt,
            'image' => $nameFile,
            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            Categoryproperty::create($Categoryproperty);
            DB::commit();
            if ($request->image != null) {
                $folder = 'upload/images/properties';
                $folder_thumb    = 'upload/images/properties/thumb/';
                $folder_medium   = 'upload/images/properties/medium/';
                $folder_large   = 'upload/images/properties/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 150, 150, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 300, 300, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 600, 600, $folder_large);
                CommonHelper::uploadImage($request->image, $nameFile, $folder);
            }
            return redirect()->route('category_property.index')->with('success','Thêm mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function storedetail(Request $request, $id)
    {
        $request->validate([
            'image'  => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
        [
            'image.image'   => 'Ảnh không đúng định dạng! (jpg, jpeg, png)',
        ]);
        $Categoryproperty = Categoryproperty::find($id);
        $nameFile = Detailproperties::IMAGE;
        if ($request->image  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        }
        $detailproperty  = [
            'name'  => $request->name,
            'ma'  => $request->ma,
            'stt'   => $request->stt,
            'explain'   => $request->explain,
            'categoryproperties_id' => $id,
            'categoryproperties_code' => $Categoryproperty->ma,
            'image' => $nameFile,
        ];

        $detailproperties  = Detailproperties::where('categoryproperties_id',$id)->get();
        try {
            DB::beginTransaction();
            Detailproperties::create($detailproperty);
            DB::commit();
            // xu ly anh khong bi vo anh
            if ($request->image != null) {
                $folder = 'upload/images/detailproperties';
                $folder_thumb    = 'upload/images/detailproperties/thumb/';
                $folder_medium   = 'upload/images/detailproperties/medium/';
                $folder_large   = 'upload/images/detailproperties/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 150, 150, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 300, 300, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 600, 600, $folder_large);
                CommonHelper::uploadImage($request->image, $nameFile, $folder);
            }
            return redirect()->route('category_property.edit',$id)->with('detailproperties',$detailproperties)->with('success','Thêm mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.edit',$id)->with('detailproperties',$detailproperties)->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
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
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
            [
                'image.image'   => 'Ảnh không đúng định dạng! (jpg, jpeg, png)',
                ]);
        $category_properties = Categoryproperty::find($id);
        if(empty($category_properties)){
            return \abort(404);
        }
        $nameFile      = Categoryproperty::IMAGE;
        $nameFileOld   = $category_properties->image;
        if ($request->image  != null)
            $nameFile  = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        else $nameFile = $nameFileOld;
        $category_property  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'explain'   => $request->explain,
            'stt'       => $request->stt,
            'image'       => $nameFile,
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
            // xu ly anh khong bi vo anh
            if ($request->image != null) {
                $folder = 'upload/images/properties';
                $folder_thumb    = 'upload/images/properties/thumb/';
                $folder_medium   = 'upload/images/properties/medium/';
                $folder_large   = 'upload/images/properties/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 150, 150, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 300, 300, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 600, 600, $folder_large);
                CommonHelper::uploadImage($request->image, $nameFile, $folder);

                //Xoá ảnh cũ khi có upload ảnh mới
                if ($nameFileOld != Categoryproperty::IMAGE && $nameFile != Categoryproperty::IMAGE) {
                    $path         = 'upload/images/properties/';
                    $path_thumb   = 'upload/images/properties/thumb/';
                    $path_medium  = 'upload/images/properties/medium/';
                    $path_large  = 'upload/images/properties/large/';
                    CommonHelper::deleteImage($nameFileOld, $path);
                    CommonHelper::deleteImage($nameFileOld, $path_thumb);
                    CommonHelper::deleteImage($nameFileOld, $path_medium);
                    CommonHelper::deleteImage($nameFileOld, $path_large);
                }
            }
            return redirect()->route('category_property.index')->with('success','Cập nhật danh mục thuộc tính thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category_property.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function updatedetail(Request $request, $id)
    {
         $request->validate([
             'image' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
         ],
         [
             'image.image'   => 'Ảnh không đúng định dạng! (jpg, jpeg, png)',
         ]);
        $Detailproperties = Detailproperties::find($id);
        $nameFile      = Detailproperties::IMAGE;
        $nameFileOld   = $Detailproperties->image;
        if ($request->image  != null)
            $nameFile  = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        else $nameFile = $nameFileOld;
        $detailproperty  = [
            'name'  => $request->name,
            'ma'  => $request->ma,
            'stt'   => $request->stt,
            'explain'   => $request->explain,
            'image'     => $nameFile,
        ];
        $detailproperties_list  = Detailproperties::where('categoryproperties_id',$request->id)->get();
        try {
            DB::beginTransaction();
            $Detailproperties->update($detailproperty);
            DB::commit();
            // xu ly anh khong bi vo anh
            if ($request->image != null) {
                $folder = 'upload/images/detailproperties';
                $folder_thumb    = 'upload/images/detailproperties/thumb/';
                $folder_medium   = 'upload/images/detailproperties/medium/';
                $folder_large   = 'upload/images/detailproperties/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 150, 150, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 300, 300, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 600, 600, $folder_large);
                CommonHelper::uploadImage($request->image, $nameFile, $folder);

                //Xoá ảnh cũ khi có upload ảnh mới
                if ($nameFileOld != Detailproperties::IMAGE && $nameFile != Detailproperties::IMAGE) {
                    $path         = 'upload/images/detailproperties/';
                    $path_thumb   = 'upload/images/detailproperties/thumb/';
                    $path_medium  = 'upload/images/detailproperties/medium/';
                    $path_large  = 'upload/images/detailproperties/large/';
                    CommonHelper::deleteImage($nameFileOld, $path);
                    CommonHelper::deleteImage($nameFileOld, $path_thumb);
                    CommonHelper::deleteImage($nameFileOld, $path_medium);
                    CommonHelper::deleteImage($nameFileOld, $path_large);
                }
            }
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
            $nameFileOld = $Categoryproperty->image;
            $Categoryproperty->delete();
            if(!empty($nameFileOld))
            {
                $path         = 'upload/images/properties/';
                $path_thumb   = 'upload/images/properties/thumb/';
                $path_medium  = 'upload/images/properties/medium/';
                $path_large  = 'upload/images/properties/large/';
                CommonHelper::deleteImage($nameFileOld, $path);
                CommonHelper::deleteImage($nameFileOld, $path_thumb);
                CommonHelper::deleteImage($nameFileOld, $path_medium);
                CommonHelper::deleteImage($nameFileOld, $path_large);
            }
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
            $nameFileOld = $Detailproperty->image;
            $Detailproperty->delete();
            if(!empty($nameFileOld)){
                $path         = 'upload/images/detailproperties/';
                $path_thumb   = 'upload/images/detailproperties/thumb/';
                $path_medium  = 'upload/images/detailproperties/medium/';
                $path_large  = 'upload/images/detailproperties/large/';
                CommonHelper::deleteImage($nameFileOld, $path);
                CommonHelper::deleteImage($nameFileOld, $path_thumb);
                CommonHelper::deleteImage($nameFileOld, $path_medium);
                CommonHelper::deleteImage($nameFileOld, $path_large);
            }
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
