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
        $limit    =  $request->query('limit');
        $keywords =  $request->query('keywords');
        $orderby  =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if($limit   ==null) {$limit   =10;}
        if($sort    ==null) {$sort    ='asc';}
        if($keywords==null) {$keywords="";}
        if($orderby ==null) {$orderby ="ma";}


        $data = Category::where('taxonomy', 0)
        ->where('name', 'like', '%' . $keywords . '%')
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
            // |max:255|unique:categories,slug,'.$slug,
            'thumb'  => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
        [
            'ma.required' => 'Mã danh mục không được phép bỏ trống',
            'ma.max'      => 'Mã danh mục không được phép vượt quá 255 ký tự',
            'ma.unique'   => 'Mã danh mục đã tồn tại',
            'name.required' => 'Tên danh mục không được phép bỏ trống',
            // 'slug.unique'   => 'Tên slug đã tồn tại',
            // 'slug.max'      => 'Tên slug không được phép vượt quá 255 ký tự',
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
        if ($request->hasFile('banner')) {
            $thumbBanner = $request->banner;
            $nameFileBanner = CommonHelper::convertTitleToSlug($request->name,'-').'-banner-'.time().'.'.$thumbBanner ->extension();
        }
        if (empty($request->slug)) {$request->slug = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}

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
            'banner'    => $nameFileBanner,
            'status'    => $request->has('status'),
            'show_push_product'    => $request->has('show_push_product'),
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
        // $listproperty = [];
        // foreach ($categoryproperties_manages as $key => $value) {
        //     $listproperty[] = $value->categoryproperties_id;
        // }
        // $arr = implode(',', $listproperty);
        $categoryproperty = Categoryproperty::where('status',1)->whereNotIn('id', function($query) use ($id) {
            $query->select('categoryproperties_id')->from('categoryproperties_manages')
            ->where('category_id',$id);
        })->get();
        $edit = Category::find($id);
        if ($edit !== null) {
            $categorieslv = $this->categorylevel();
            return view('admin.category.edit',[
                'title'        => 'Sửa danh mục',
                'categorieslv' => $categorieslv,
                'edit'         => $edit,
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
            'thumb' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
        ],
        [
            'ma.required' => 'Tên danh mục không được phép bỏ trống',
            'ma.max'      => 'Tên danh mục không được phép vượt quá 255 ký tự',
            'ma.unique'   => 'Mã danh mục đã tồn tại',
            'slug.required' => 'Tên slug không được phép bỏ trống',
            'name.required' => 'Tên danh mục không được phép bỏ trống',
            'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
            'banner.image'   => 'Ảnh banner không đúng định dạng! (jpg, jpeg, png)',
        ]); 
        $slug = $request->slug;
        if (empty($request->slug)) {$request->slug = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}

        $Categorys = Category::find($id);
        if(empty($Categorys)){
            return \abort(404);
        }
        $nameFileOld   = $Categorys->thumb;
        $nameBannerOld   = $Categorys->banner;
        if ($request->hasFile('thumb')) {
            $thumb = $request->thumb;
            $nameFile = CommonHelper::convertTitleToSlug($request->name,'-').'-'.time().'.'.$thumb ->extension();
        }else{
            $nameFile = $nameFileOld;
        }
        if ($request->hasFile('banner')) {
            $thumbBanner = $request->banner;
            $nameFileBanner = CommonHelper::convertTitleToSlug($request->name,'-').'-banner-'.time().'.'.$thumbBanner ->extension();
        }else{
            $nameFileBanner = $nameBannerOld;
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
            'banner'    => $nameFileBanner,
            'status'    => $request->has('status'),
            'show_push_product'    => $request->has('show_push_product'),
        ];

        try {
            DB::beginTransaction();
            $Categorys->update($Category);
            DB::table('admin_menu_items')->where('category_id', $request->id)
            ->update([
            'ma' => $request->ma,
            'label' => $request->name,
            'link' => $request->slug
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
            if ($request->banner != null) {
                CommonHelper::cropImage2($request->banner,  $nameFileBanner, 180, 324, $folder_thumb);
                CommonHelper::uploadImage($request->banner, $nameFileBanner, $folder);

                //Xoá ảnh cũ khi có upload ảnh mới
                if ($nameBannerOld != Category::IMAGE && $nameFileBanner != Category::IMAGE) {
                        $path         = 'upload/images/products/';
                        $path_thumb   = 'upload/images/products/thumb/';
                        CommonHelper::deleteImage($nameBannerOld, $path);
                        CommonHelper::deleteImage($nameBannerOld, $path_thumb);
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
            $menu->delete();
            }
            return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
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

        $properties    =  Categoryproperty::where('id', $properties_id)->first();

        $Categoryproperties_manages =  new Categoryproperties_manages();

        $Categoryproperties_manages->category_id = $category_id;
        $Categoryproperties_manages->categoryproperties_id = $properties_id;
        $Categoryproperties_manages->name = $properties->name;
        $Categoryproperties_manages->ma = $properties->ma;
        $Categoryproperties_manages->save();

        $value =  Categoryproperties_manages::latest()->first();

        $view     = view('admin.category.addproperty', [
                'value' => $value,
            ])->render();
        return response()->json(['html'=>$view,'id' => $category_id]);

        // return redirect()->route('category.edit',$category_id)->with('success','Cập nhật thuộc tính thành công.');
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
