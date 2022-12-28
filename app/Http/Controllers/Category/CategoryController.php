<?php

namespace App\Http\Controllers\Category;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Locationmenu;
use App\Models\Categoryproperty;
use App\Models\Categoryproperties_manages;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

use Validator;
use Response;
use Redirect;



class CategoryController extends Controller
{

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'products', 'active' => 'Sản phẩm']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        $keywords =  $request->query('keywords');
        $orderby  = $orderby_another =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if($sort    ==null) {$sort    ='asc';}
        if($orderby ==null || $orderby=="is_promotion") {$orderby ="id";}
        $data = Category::where('taxonomy', 0)
            ->where(function ($query) use ($keywords){
                if($keywords){
                    $query->where('name', 'like', '%' . $keywords . '%');
                }
            })
            ->where(function ($query) use ($orderby_another){
                if($orderby_another=="is_promotion"){
                    $query->where('is_promotion', 1);
                }
            })
            ->where(function ($query) use ($orderby_another){
                if($orderby_another=="show_push_product"){
                    $query->where('show_push_product', 1);
                }
            })
        ->orderby($orderby,$sort)->get();
        $listcategories = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategories);
        return view('admin.category.index',[
            'Categories' => $listcategories,
            'title'    => 'Danh mục sản phẩm',
        ]);
    }
    public function create()
    {
        $this->authorize('create', Category::class);
        $user_id      = Auth::user()->id;
        $categorieslv = $this->categorylevel();
        return view('admin.category.create',[
            'categorieslv' => $categorieslv,
            'title'        => 'Thêm danh mục',
            'user_id'      => $user_id,
        ]);
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->slug, '-');
        $request->validate([
            'ma'     => 'required|max:255|unique:categories,ma',
            'slug'   => 'required',
            'name'   => 'required',
            'thumb'  => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
        [
            'ma.required' => 'Mã danh mục không được phép bỏ trống',
            'ma.max'      => 'Mã danh mục không được phép vượt quá 255 ký tự',
            'ma.unique'   => 'Mã danh mục đã tồn tại',
            'name.required' => 'Tên danh mục không được phép bỏ trống',
            'slug.required' => 'Tên slug không được phép bỏ trống',
            'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
            'banner.image'  => 'Ảnh banner không đúng định dạng! (jpg, jpeg, png)',
        ]);
        $nameFile   = Category::IMAGE;
        $nameFileBanner   = Category::IMAGE;
        if ($request->hasFile('thumb')) {
            $thumb = $request->thumb;
            $nameFile = CommonHelper::convertTitleToSlug($request->name,'-').'-'.time().'.'.$thumb ->extension();
        }
        $imgs     = $this->saveimg($request, '');
        if (empty($imgs)){
            $imgs = 'no-images.jpg';
        }
        if (empty($request->slug)) {$request->slug = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}
        if(empty($request->content_category)){$request->content_category = '';}
        $Category  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'name2'     => $request->name2,
            'slug'      => $slug,
            'icon'      => $request->icon,
            'taxonomy'  => 0,
            'parent_id' => $request->parent_id,
            'user_id'   => Auth::user()->id,
            'thumb'     => $nameFile,
            'banner'    => $imgs,
            'status'    => $request->has('status'),
            'content'   => $request->content_category,
            'show_push_product'    => $request->has('show_push_product'),
            'is_promotion'    => $request->has('is_promotion')
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
            return redirect()->route('category.index')->with('success','Thêm danh mục mới thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function categorylevel()
    {
        $data = Category::where('taxonomy', '=', 0)->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);
        return $listcategory;
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('update', Category::class);
        $categoryproperties_manages = Categoryproperties_manages::where('category_id',$id)->get();
        $categoryproperty = Categoryproperty::where('status',1)->whereNotIn('id', function($query) use ($id) {
            $query->select('categoryproperties_id')->from('categoryproperties_manages')
            ->where('category_id',$id);
        })->get();

        $edit = Category::find($id);
        $img            = json_decode($edit->banner);
        if ($edit !== null) {
            $categorieslv = $this->categorylevel();
            return view('admin.category.edit',[
                'title'        => 'Sửa danh mục',
                'categorieslv' => $categorieslv,
                'edit'         => $edit,
                'img'         => $img,
                'categoryproperties_manages' => $categoryproperties_manages,
                'categoryproperty'           => $categoryproperty,
            ]);
        } else {
            \abort(404);
        }
    }

    public function update(Request $request, $id)
    {

        $request->slug = Str::slug($request->slug, '-');
        $request->validate([
            'ma'    => 'required|max:255|unique:categories,ma,'.$id.',id',
            'slug'  => 'required',
            'name'  => 'required',
            'thumb' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:5000',
        ],
        [
            'ma.required' => 'Tên danh mục không được phép bỏ trống',
            'ma.max'      => 'Tên danh mục không được phép vượt quá 255 ký tự',
            'ma.unique'   => 'Mã danh mục đã tồn tại',
            'slug.required' => 'Tên slug không được phép bỏ trống',
            'name.required' => 'Tên danh mục không được phép bỏ trống',
            'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
        ]);
        $slug = $request->slug;
        if (empty($request->slug)) {$request->slug = '';}
        if (empty($request->content_category)) {$request->content_category = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}

        $Categorys = Category::find($id);
        if(empty($Categorys)){
            return \abort(404);
        }

        $nameFileOld   = $Categorys->thumb;
        if ($request->hasFile('thumb')) {
            $thumb = $request->thumb;
            $nameFile = CommonHelper::convertTitleToSlug($request->name,'-').'-'.time().'.'.$thumb ->extension();
        }else{
            $nameFile = $nameFileOld;
        }

        // xu ly anh abum
        $oldimage = $Categorys->banner;

        if (empty($request->banner)){
            $imgs = $oldimage;
        } else{
            $imgs = $this->saveimg($request, $oldimage);
        }

        $Category  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'name2'     => $request->name2,
            'slug'      => $slug,
            'icon'      => $request->icon,
            'taxonomy'  => 0,
            'parent_id' => $request->parent_id,
            'user_id'   => Auth::user()->id,
            'thumb'     => $nameFile,
            'banner'    => $imgs,
            'status'    => $request->has('status'),
            'content'   => $request->content_category,
            'show_push_product'    => $request->has('show_push_product'),
            'is_promotion'    => $request->has('is_promotion')
        ];

        try {
            DB::beginTransaction();
            $Categorys->update($Category);
            DB::table('admin_menu_items')
                ->where('category_id','<>',null)
                ->where('category_id', $request->id)
                ->update([
                    'ma' => $request->ma,
                ]);
            $folder_thumb  = 'upload/images/products/thumb/';
            $folder = 'upload/images/products';
            if ($request->thumb != null) {
                CommonHelper::cropImage2($request->thumb,  $nameFile, 300, 300, $folder_thumb);
                CommonHelper::uploadImage($request->thumb, $nameFile, $folder);
                //Xoá ảnh cũ khi có upload ảnh mới
                if ($nameFileOld != Category::IMAGE && $nameFile != Category::IMAGE) {
                    $path         = 'upload/images/products/';
                    $path_thumb   = 'upload/images/products/thumb/';
                    CommonHelper::deleteImage($nameFileOld, $path);
                    CommonHelper::deleteImage($nameFileOld, $path_thumb);
                }
            }
            DB::commit();
            return redirect()->route('category.index')->with('success','Cập nhật danh mục thành công.');
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('category.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function destroy(Request $request)
    {
        $this->authorize('delete',Category::class);
        $Category     = Category::find($request->id);
        $menu = DB::table('admin_menu_items')->where('category_id', $request->id);
        if (!is_null($Category)){
            $Category->delete();
            if (!is_null($menu)){
            DB::table('admin_menu_items')->where('category_id', $request->id)
              ->update([
                'category_id'  =>   null,
                'category_code'=>   NUll,
              ]);
            }
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }
    //xu ly luu anh album
    public function saveimg($request, $oldimage)
    {
        $image = \json_decode($oldimage);
        if ($files = $request->file('banner')) {
            foreach ($files as $file) {
                $image_name      = md5(rand(1000, 10000));
                $ext             =  strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path     = 'upload/images/products/';
                $upload_path2    = 'upload/images/products/thumb/';
                $upload_path3    = 'upload/images/products/medium/';
                $upload_path4    = 'upload/images/products/large/';
                CommonHelper::cropImage($file, $image_full_name, 300, 50, $upload_path2);
                CommonHelper::cropImage($file, $image_full_name, 600, 100, $upload_path3);
                CommonHelper::cropImage($file, $image_full_name, 900, 150, $upload_path4);
                $file->move($upload_path, $image_full_name);
                $image[]         = $image_full_name;
            }
        }
        return json_encode($image);
    }

    //xu ly xoa anh album
    public function deleteImgAjax(Request $request)
    {
        $data   = $request->all();
        $id     = $data['id'];
        $image  = $data['img'];
        $images = \json_decode(Category::find($id)->banner);
        $db     = array();
        foreach ($images as $k) {
            if   ($image != $k) {
                $db[]   = $k;
            } else {
                File::delete('upload/images/products/' . $k);
                File::delete('upload/images/products/thumb/' . $k);
                File::delete('upload/images/products/medium/' . $k);
                File::delete('upload/images/products/large/' . $k);
            }
        }
        if (empty($db)) {
            $input = 'no-images.jpg';
        } else {
            $input =  json_encode($db);
        }
        Category::where('id', $id)->update(['banner' => $input]);
        return \json_encode(array('success' => \true));
    }
    public function getchild(Request $request){
        $id = $request->id;
        $data = Category::where('taxonomy', '=', 0)->get();

        $listcategories = [];
        Category::recursive_child($data, $id, 2, $listcategories);
        $view2     = view('admin.category.getchild', [
                'listcategories' => $listcategories,
                'sub_id' => $id,
            ])->render();
        return response()->json(['html'=>$view2]);
    }

    public function export()
    {
        return Excel::download(new CategoryExport, 'Categories.xlsx');
    }

    public function import()
    {
        if(!empty(request()->file('file')))
        Excel::import(new CategoryImport,request()->file('file'));
        return back();
    }

    public function addproperty(Request $request)
    {
        $properties_id =  $request->properties_id;
        $category_id   =  $request->category_id;

        if(!empty($properties_id)){
            foreach ($properties_id as $key => $value) {
            $properties    =  Categoryproperty::where('id', $value)->first();
            $Categoryproperties_manages =  new Categoryproperties_manages();
            $Categoryproperties_manages->category_id = $category_id;
            $Categoryproperties_manages->categoryproperties_id = $value;
            $Categoryproperties_manages->name = $properties->name;
            $Categoryproperties_manages->ma = $properties->ma;
            $Categoryproperties_manages->save();
            }
        }
        return response()->json(['id' => $category_id]);
    }

    public function destroyproperty(Request $request)
    {
        $this->authorize('delete',Category::class);
        $Categoryproperties_manages     = Categoryproperties_manages::find($request->id);
        if (!is_null($Categoryproperties_manages)){
            $Categoryproperties_manages->delete();
            return \json_encode(([
                'success'=>true,
                'id'=>$request->category_id,
            ]));
        }
        return \json_encode(([
            'success'=>false,
            'id'=>$request->category_id,
        ]));
    }
}
