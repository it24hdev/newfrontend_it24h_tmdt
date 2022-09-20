<?php

namespace App\Http\Controllers\Category;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Locationmenu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use Validator;
use Response;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;


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

        if($limit == 10 && $keywords=="" && $orderby== "ma" && $sort =="asc"){
            $Category = Category::where('taxonomy', '=', 0)->paginate($limit);}
        else
        {
            $Category = Category::where('taxonomy', '=', 0)
                ->where('name', 'like', '%' . $keywords . '%')->orderby($orderby,$sort)->Paginate($limit);
        }

        $data = Category::where('taxonomy', '=', 0)
        ->where('taxonomy', '=', 0)
        ->where('name', 'like', '%' . $keywords . '%')
        ->orderby($orderby,$sort)
        ->Paginate($limit);

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

        $Category = new Category();
        $Category->ma        = $request->ma;
        $Category->name      = $request->name;
        $Category->name2     = $request->name2;
        $Category->slug      = $request->slug;
        $Category->icon      = $request->icon;
        $Category->taxonomy  = 0;
        $Category->parent_id = $request->parent_id;
        $Category->user_id   = Auth::user()->id;
        $Category->thumb     = $nameFile;
        $Category->banner    = $nameFileBanner;
        $Category->status    = $request->has('status');
        $Category->show_push_product    = $request->has('show_push_product');
        $Category->save();

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
        $edit = Category::find($id);
        if ($edit !== null) {
            $categorieslv = $this->categorylevel();
            return view('admin.category.edit',[
                'categorieslv' => $categorieslv,
                'title'        => 'Sửa danh mục',
                'edit'         => $edit,
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
                // 'slug.max'      => 'Tên slug không được phép vượt quá 255 ký tự',
                // 'slug.unique'   => 'Tên slug đã tồn tại',
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
        $Locationmenu = db::table('locationmenus')->where('category_id','=',$request->id);
        if (!is_null($Category)){
            $Category->delete();
            $Locationmenu->delete();
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
}
