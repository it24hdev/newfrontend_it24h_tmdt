<?php

namespace App\Http\Controllers\Categorypost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\CategorypostExport;
use App\Imports\CategorypostImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Response;
use Redirect;

class CategorypostController extends Controller
{

    public function __construct()
    {
        ini_set('max_execution_time', 1800);
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'post', 'active' => 'Bài viết']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $this->authorize('viewAnypost', Category::class);
        $limit    =  $request->query('limit');
        $keywords =  $request->query('keywords');
        $orderby  =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if($limit   ==null){$limit   =10;}
        if($sort    ==null){$sort    ='asc';}
        if($keywords==null){$keywords="";}
        if($orderby ==null){$orderby ="ma";}

        if($limit == 10 && $keywords=="" && $orderby== "ma" && $sort =="asc"){
            $Category = Category::where('taxonomy', '=', 1)->paginate($limit);}
        else
        {
            $Category = Category::where('taxonomy', '=', 1)
            ->where('name', 'like', '%' . $keywords . '%')->orderby($orderby,$sort)->Paginate($limit);
        }
        return view('admin.categorypost.index',[
                'Category' => $Category,
                'title'    => 'Danh mục bài viết',
            ]);
    }
    public function create()
    {
        $this->authorize('createpost', Category::class);
        $user_id = Auth::user()->id;
        $categorieslv = $this->categorylevel();
        return view('admin.categorypost.create',[
            'categorieslv' => $categorieslv,
            'title'        => 'Thêm danh mục',
            'user_id'      => $user_id,
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $slug = Str::slug($request->slug, '-');
        $request->validate([
                'ma'   => 'required|max:255|unique:categories,ma',
                'name' => 'required',
                'slug' => 'required',
            ],
            [
                'ma.required' => 'Mã danh mục không được phép bỏ trống',
                'ma.max'      => 'Mã danh mục không được phép vượt quá 255 ký tự',
                'ma.unique'   => 'Mã danh mục đã tồn tại trong hệ thống',
                'name.required' => 'Tên danh mục không được phép bỏ trống',
                // 'name.unique'   => 'Tên danh mục đã tồn tại',
                // 'slug.unique'   => 'Tên slug đã tồn tại',
                // 'slug.max'      => 'Tên slug không được phép vượt quá 255 ký tự',
                'slug.required' => 'Tên slug không được phép bỏ trống',
            ]);
        if (empty($request->slug))      {$request->slug      = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}
        // if (empty($request->user_id))   {$request->user_id   = 0;}

        $Category = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'name2'     => $request->name2,
            'slug'      => $slug,
            'taxonomy'  => 1,
            'parent_id' => $request->parent_id,
            'user_id'   => Auth::user()->id,
            'status'    => $request->has('status'),
        ];
        try {
            DB::beginTransaction();
            Category::create($Category);
            DB::commit();
            return redirect()->route('categorypost.index')->with('success','Thêm danh mục mới thành công.');
            }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('categorypost.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function categorylevel()
    {
        $data = Category::where('taxonomy', '=', 1)->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);
        return $listcategory;
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('update', Category::class);
        $edit = Category::find($id);
        if ($edit !== null) {
            $categorieslv  = $this->categorylevel();
            return view('admin.categorypost.edit',[
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
                'ma'   => 'required|max:255|unique:categories,ma'.$id.',id',
                'name' => 'required',
                'slug' => 'required',
            ],
            [
                'ma.required' => 'Mã danh mục không được phép bỏ trống',
                'ma.max'      => 'Mã danh mục không được phép vượt quá 255 ký tự',
                'ma.unique'   => 'Mã danh mục đã tồn tại trong hệ thống',
                'name.required' => 'Tên danh mục không được phép bỏ trống',
                // 'name.unique'   => 'Tên danh mục đã tồn tại',
                // 'slug.unique'   => 'Tên slug đã tồn tại',
                // 'slug.max'      => 'Tên slug không được phép vượt quá 255 ký tự',
                'slug.required' => 'Tên slug không được phép bỏ trống',
            ]);
        $slug = $request->slug;
        if (empty($request->slug)) {$request->slug = '';}
        if (empty($request->parent_id)) {$request->parent_id = 0;}
        // if (empty($request->user_id)) {$request->user_id = 0;}

        $Categorys = Category::find($id);
        $Category  = [
            'ma'        => $request->ma,
            'name'      => $request->name,
            'name2'     => $request->name2,
            'slug'      => $slug,
            'taxonomy'  => 1,
            'parent_id' => $request->parent_id,
            'user_id'   => Auth::user()->id,
            'status'    => $request->has('status'),
        ];

        try {
            DB::beginTransaction();
            $Categorys->update($Category);
            DB::commit();
            return redirect()->route('categorypost.index')->with('success','Cập nhật danh mục thành công.');
            }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('categorypost.index')->with('error','Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function destroy(Request $request)
    {
        $this->authorize('deletepost',Category::class);
        $Category = Category::find($request->id);
        if (!is_null($Category)){
        $Category->delete();
        return \json_encode(array('success'=>true));
        }
        return \json_encode(array('success'=>false));
    }

    public function getchild(Request $request){
        $id = $request->id;
        $ma = Category::where('id',$id)->first();
        $data = Category::where('taxonomy', '=', 1)->get();

        $listcategories = [];
        Category::recursive_child($data, $id, 2, $listcategories);
         $view2     = view('admin.categorypost.getchild', [
                'Category' => $listcategories,
                'sub_id'   => $id,
                'ma'       => $ma,
            ])->render();
        return response()->json(['html'=>$view2]);
    }

    public function export() 
    {
        return Excel::download(new CategorypostExport, 'Categoriespost.xlsx');
    }

    public function import() 
    {
        if(!empty(request()->file('file')))
        Excel::import(new CategorypostImport,request()->file('file')); 
        return back();
    }
}
