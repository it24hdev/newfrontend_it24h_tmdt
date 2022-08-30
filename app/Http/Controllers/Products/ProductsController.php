<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Category;
use App\Models\CategoryRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Helpers\CommonHelper;
use App\Models\Attribute_product;
use App\Models\Brand;
use App\Models\Tag_event;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['module_active' => 'products',  'active' => 'Sản phẩm']);
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $this->authorize('viewAny', Products::class);
        $limit    =  $request->query('limit');
        $keywords =  $request->query('search');
        $orderby  =  $request->query('orderby');
        $sort     =  $request->query('sort');
        if ($sort  == null) {
            $sort  = 'ASC';
        }
        if ($limit == null) {
            $limit = 10;
        }
        if ($keywords == null) {
            $keywords = "";
        }
        if ($orderby  == null) {
            $orderby  = "id";
        }
        if ($limit == 10 && $keywords == "" && $orderby == "id" && $sort =="asc") {
            $Products = Products::paginate($limit);
        } else
            $Products = Products::where('name', 'like', '%' . $keywords . '%')->orderby($orderby, $sort)->Paginate($limit);
        return view('admin.products.index', [
            'products' => $Products,
            'title'    => 'Sản phẩm',
            'colors'   => Attribute_product::where('attr', 'color')->get(),
            'sizes'    => Attribute_product::where('attr', 'size')->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', Products::class);
        $listcategory =  $this->categorylevel();
        $colors = Attribute_product::where('attr', 'color')->get();
        $sizes = Attribute_product::where('attr', 'size')->get();
        $brands = Brand::get();
        $tag_events = Tag_event::get();
        return view('admin.products.create', [
            'title'        => 'Thêm sản phẩm',
            'listcategory' => $listcategory,
            'colors' => $colors,
            'sizes' => $sizes,
            'brands' => $brands,
            'tag_events' => $tag_events,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('update', Products::class);
        $request->validate(
            [
                'name'          => 'required|max:300|unique:products',
                'thumb'         => 'image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
                'image'         => 'image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để bỏ trống.',
                'name.max'      => 'Tên sản phẩm có độ dài tối đa :max ký tự.',
                'name.unique'   => 'Tên sản phẩm đã tồn tại trong hệ thống',
                'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
                'image.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
            ]
        );

        $status   = Products::ACTIVE;
        $nameFile = Products::IMAGE;
        if ($request->status == null)
            $status   = Products::DISABLE;
        if ($request->thumb  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->thumb->extension();
        }
        //xu ly tien te va so luong
        $request->price             =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->price);
        $request->quantity          =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->quantity);
        $request->price_onsale      =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->price_onsale);
        if( $request->price        == "") $request->price        = 0;
        if( $request->quantity     == "") $request->quantity     = 0;
        if( $request->price_onsale == "") $request->price_onsale = 0;
        if( $request->onsale       == "") $request->onsale       = 0;

        $imgs     = $this->saveimg($request, '');
        if ($imgs === "null"){ $imgs = 'no-images.jpg'; }
        $cat_id   = json_encode($request->cat_id);
        $attr_id  = \json_encode($request->attr_id);
        if(!empty($request->specifications)){
            $specifications = \json_encode($request->specifications);
        }else{
            $specifications = NULL;
        }

        $Product  = [
            'name'         => $request->name,
            'slug'         => CommonHelper::convertTitleToSlug($request->name, '-'),
            'price'        => $request->price,
            'quantity'     => $request->quantity,
            'onsale'       => $request->onsale,
            'price_onsale' => $request->price_onsale,
            'unit'         => $request->unit,
            'content'      => $request->content,
            'short_content'=> $request->short_content,
            'thumb'        => $nameFile,
            'status'       => $status,
            'user_id'      => Auth::id(),
            'image'        => $imgs,
            'brand'        => $request->brand,
            'cat_id'       => $cat_id,
            'property'     => $request->property,
            'attr'         => $attr_id,
            'new'        => $request->new,
            'hot_sale'        => $request->hot_sale,
            'gift'        => $request->gift,
            'sold'        => $request->sold,
            'specifications'    => $specifications,
            'installment' => $request->installment,
            'year' => $request->year,
            'event' => $request->event,
            'still_stock' => $request->still_stock,
            'time_deal'    => $request->time_deal,
            'youtube' => $request->youtube,
        ];

        try {
            DB::beginTransaction();

            $product = Products::create($Product);
            // xu ly anh khong bi vo anh
            if ($request->thumb != null) {
                $folder_thumb    = 'upload/images/products/thumb/';
                $folder_medium   = 'upload/images/products/medium/';
                $folder_larage   = 'upload/images/products/large/';
                CommonHelper::cropImage2($request->thumb, $nameFile, 150, 150, $folder_thumb);
                CommonHelper::cropImage2($request->thumb, $nameFile, 300, 300, $folder_medium);
                CommonHelper::cropImage2($request->thumb, $nameFile, 600, 600, $folder_larage);
                $folder = 'upload/images/products';
                CommonHelper::uploadImage($request->thumb, $nameFile, $folder);
            }
            /* Chuyển cách insert cat_id qua bảng trung gian bằng cách này! */
            $product->category()->attach($request->input('cat_id'));
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Thêm sản phẩm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('products.index')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    public function edit($id)
    {
        $this->authorize('update', Products::class);
        $edit           = Products::find($id);
        if ($edit !== null) {
            $img            = json_decode($edit->image);
            $cat_id         = json_decode($edit->cat_id);
            $colors = Attribute_product::where('attr', 'color')->get();
            $sizes  = Attribute_product::where('attr', 'size')->get();
            $attr_ids        = json_decode($edit->attr);
            $brands = Brand::get();
            $tag_events = Tag_event::get();
            if(empty($attr_ids)){$attr_ids = [];}
            $listcategory    =  $this->categorylevel();
            return view('admin.products.edit', [
                'title'        => 'Sửa sản phẩm',
                'edit'         => $edit,
                'img'          => $img,
                'cat_id'       => $cat_id,
                'listcategory' => $listcategory,
                'colors'       => $colors,
                'sizes'        => $sizes,
                'attr_ids'     => $attr_ids,
                'brands' => $brands,
                'tag_events' => $tag_events,
            ]);
        } else {
            \abort(404);
        }
    }

    public function categorylevel()
    {
        $data = Category::where('taxonomy', '=', 0)->get();
        $listcategory = [];
        Category::recursive($data, $parents = 0, $level = 1, $listcategory);
        return $listcategory;
    }

    public function update(Request $request, $id)
    {

        $this->authorize('update', Products::class);
        $request->validate(
            [
                'name'  => 'required|max:300|unique:products,name,' . $id . ',id',
                'thumb' => 'image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:5048',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để bỏ trống.',
                'name.max'      => 'Tên sản phẩm có độ dài tối đa :max ký tự.',
                'name.unique'   => 'Tên sản phẩm đã tồn tại trong hệ thống',
                'thumb.image'   => 'Ảnh đại diện không đúng định dạng! (jpg, jpeg, png)',
            ]
        );
        $Products = Products::find($id);

        if (!is_null($Products)) {
            $status        = Products::ACTIVE;
            $nameFile      = Products::IMAGE;
            $nameFileOld   = $Products->thumb;
            if ($request->status == null)
                $status    = Products::DISABLE;
            if ($request->thumb  != null)
                $nameFile  = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->thumb->extension();
            else $nameFile = $nameFileOld;
            // xy ly du lieu dang number
            $request->price             =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->price);
            $request->quantity          =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->quantity);
            $request->price_onsale      =  preg_replace('/[^A-Za-z0-9\-]/', '', $request->price_onsale);
            if( $request->price        == "") $request->price        = 0;
            if( $request->quantity     == "") $request->quantity     = 0;
            if( $request->price_onsale == "") $request->price_onsale = 0;
            if( $request->onsale       == "") $request->onsale       = 0;

            // xu ly anh abum
            $oldimage = $Products->image;
            if ($request->image == null){
                $imgs = $oldimage;
            } else{
                $imgs = $this->saveimg($request, $oldimage);
            }

            $cat_id   = json_encode($request->cat_id);
            $attr_id = \json_encode($request->attr_id);
            if(!empty($request->specifications)){
                $specifications = \json_encode($request->specifications);
            }else{
                $specifications = NULL;
            }
            $Product  = [
                'name'         => $request->name,
                'slug'         => CommonHelper::convertTitleToSlug($request->name, '-'),
                'price'        => $request->price,
                'quantity'     => $request->quantity,
                'onsale'       => $request->onsale,
                'price_onsale' => $request->price_onsale,
                'unit'         => $request->unit,
                'content'      => $request->content,
                'short_content'=> $request->short_content,
                'thumb'        => $nameFile,
                'status'       => $status,
                'user_id'      => Auth::id(),
                'image'        => $imgs,
                'brand'        => $request->brand,
                'cat_id'       => $cat_id,
                'property'     => $request->property,
                'attr'         => $attr_id,
                'new'        => $request->new,
                'hot_sale'        => $request->hot_sale,
                'gift'        => $request->gift,
                'sold'        => $request->sold,
                'specifications'    => $specifications,
                'installment' => $request->installment,
                'year' => $request->year,
                'event' => $request->event,
                'still_stock' => $request->still_stock,
                'time_deal'    => $request->time_deal,
                'youtube' => $request->youtube,
            ];

            try {
                DB::beginTransaction();

                Products::where('id', $id)->update($Product);
                $product = Products::find($id);
                // xu ly anh khong bi vo anh
                if ($request->thumb != null) {
                    $folder_thumb  = 'upload/images/products/thumb/';
                    $folder_medium = 'upload/images/products/medium/';
                    $folder_larage = 'upload/images/products/large/';
                    $folder = 'upload/images/products';
                    CommonHelper::cropImage2($request->thumb,  $nameFile, 150, 150, $folder_thumb);
                    CommonHelper::cropImage2($request->thumb,  $nameFile, 300, 300, $folder_medium);
                    CommonHelper::cropImage2($request->thumb,  $nameFile, 600, 600, $folder_larage);
                    CommonHelper::uploadImage($request->thumb, $nameFile, $folder);

                //Xoá ảnh cũ khi có upload ảnh mới
                if ($nameFileOld != Products::IMAGE && $nameFile != Products::IMAGE) {
                        $path         = 'upload/images/products/';
                        $path_thumb   = 'upload/images/products/thumb/';
                        $path_medium  = 'upload/images/products/medium/';
                        $path_larage  = 'upload/images/products/large/';
                        CommonHelper::deleteImage($nameFileOld, $path);
                        CommonHelper::deleteImage($nameFileOld, $path_thumb);
                        CommonHelper::deleteImage($nameFileOld, $path_medium);
                        CommonHelper::deleteImage($nameFileOld, $path_larage);
                    }
                }
                /* Chuyển cách insert update cat_id qua bảng trung gian bằng cách này! */
                $product->category()->sync($request->input('cat_id'));
                DB::commit();
                return redirect()->route('products.index')->with('success', 'Sửa sản phẩm mới thành công.');
            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->route('products.index')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
            }
        } else \abort(404);
    }


    public function saveimg($request, $oldimage)
    {
        $image = \json_decode($oldimage);
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $image_name      = md5(rand(1000, 10000));
                $ext             =  strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $upload_path     = 'upload/images/products/';
                $image_url       = $upload_path . $image_full_name;
                $upload_path2    = 'upload/images/products/thumb/';
                $upload_path3    = 'upload/images/products/medium/';
                $upload_path4    = 'upload/images/products/large/';
                CommonHelper::cropImage($file, $image_full_name, 150, 150, $upload_path2);
                CommonHelper::cropImage($file, $image_full_name, 300, 300, $upload_path3);
                CommonHelper::cropImage($file, $image_full_name, 600, 600, $upload_path4);
                $file->move($upload_path, $image_full_name);
                $image[]         = $image_full_name;

            }
        }
        return json_encode($image);
    }

    public function destroy(Request $request)
    {
        $this->authorize('delete', Products::class);
        $Products = Products::find($request->id);
        if (!is_null($Products)) {
            $Products->delete();
            $delete_cat_ship =  CategoryRelationship::where('product_id',$request->id);
            $delete_cat_ship->delete();
            return \json_encode(array('success' => true));
        }
    }
    //xu ly xoa anh album
    public function deleteImgAjax(Request $request)
    {
        $data   = $request->all();
        $id     = $data['product_id'];
        $image  = $data['img'];
        $images = \json_decode(Products::find($id)->image);
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
        Products::where('id', $id)->update(['image' => $input]);
        return \json_encode(array('success' => \true));
    }
    //xu ly lay thuoc tinh san pham
    public function list_attr(){
        $this->authorize('viewAny', Products::class);
        $colors = Attribute_product::where('attr', 'color')->orderBy('name', 'DESC')->get();
        $sizes = Attribute_product::where('attr', 'size')->get();
        return \view('admin.products.list-attr', \compact('colors', 'sizes'));
    }
    //xu ly luu thuoc tinh san pham
    public function store_attr(Request $request){
        $this->authorize('create', Products::class);
        if($request->attr == 'color'){
            $color = $request->value;
        }elseif($request->attr == 'size'){
            $color = NULL;
        }
        $input = [
            'name'  => $request->name,
            'attr'  => $request->attr,
            'color' => $color,
        ];
        Attribute_product::create($input);
        return \redirect()->route('products.list_attr')->with('success', 'Thêm thuộc tính mới cho sản phẩm thành công!');
    }
    // xu ly cap nhat thuoc tinh san pham
    public function update_attr(Request $request){
        $this->authorize('update', Products::class);
        if($request->attr == 'color'){
            $input = [
                'name'  => $request->name,
                'color' => $request->value,
            ];
            Attribute_product::where('id', $request->id)->update($input);
            return \redirect()->route('products.list_attr')->with('success', 'Cập nhật thuộc tính thành công');
        }elseif($request->attr == 'size'){
            Attribute_product::where('id', $request->id)->update(['name' => $request->name]);
            return \back()->with('success', 'Cập nhật thuộc tính thành công');
        }
    }
    // xu ly xoa thuoc tinh san pham
    public function delete_attr(Request $request)
    {
        $this->authorize('delete', Products::class);
        $data = $request->all();
        $id = $data['id'];
        Attribute_product::where('id', $id)->delete();
    }
    //xu ly lay danh sac thuong hieu san pham
    public function list_brand(){
        $this->authorize('viewAny', Products::class);
        $brands = Brand::get();
        return \view('admin.products.list-brand', \compact('brands'));
    }
    //xu ly luu thuong hieu san pham
    public function store_brand(Request $request){
        $this->authorize('create', Products::class);
        $request->validate(
            [
                'name' => 'required|string|max:250',
                'image' => 'required|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'image' => ':attribute là định dạng png, jpg, jpeg - có dung lượng tối đa 2MB',
            ],
            [
                'name' => 'Tên thương hiệu',
                'image' => 'Ảnh thương hiệu',
            ],
        );
        $nameFile = Products::IMAGE;
        if ($request->image  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        }
        $input = [
            'name'  => $request->name,
            'image'  => $nameFile,
        ];
        try {
            DB::beginTransaction();

            $brand = Brand::create($input);
            // xu ly anh khong bi vo anh
            if ($request->image != null) {
                $folder_thumb    = 'upload/images/products/thumb/';
                $folder_medium   = 'upload/images/products/medium/';
                $folder_larage   = 'upload/images/products/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 100, 25, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 150, 37, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 200, 50, $folder_larage);
                $folder = 'upload/images/products';
                CommonHelper::uploadImage($request->image, $nameFile, $folder);
            }
            DB::commit();
            return redirect()->route('products.list_brand')->with('success', 'Thêm thương hiệu sản phẩm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('products.list_brand')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }

    // xu ly cap nhat thuong hieu san pham
    public function update_brand(Request $request){
        $this->authorize('update', Products::class);
        $request->validate(
            [
                'name' => 'required|string|max:250',
                'image' => 'image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'image' => ':attribute là định dạng png, jpg, jpeg - có dung lượng tối đa 2MB',
            ],
            [
                'name' => 'Tên thương hiệu',
                'image' => 'Ảnh thương hiệu',
            ],
        );
        $brand = Brand::find($request->id);

        $nameFile = Products::IMAGE;
        $nameFileOld = $brand->image;
        if ($request->image  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->image->extension();
        }else{
            $nameFile = $nameFileOld;
        }

        $input = [
            'name'  => $request->name,
            'image'  => $nameFile,
        ];
        try {
            DB::beginTransaction();

            $brand = Brand::where('id', $request->id)->update($input);
            // xu ly anh khong bi vo anh
            if ($request->image != null) {
                $folder_thumb    = 'upload/images/products/thumb/';
                $folder_medium   = 'upload/images/products/medium/';
                $folder_larage   = 'upload/images/products/large/';
                CommonHelper::cropImage2($request->image, $nameFile, 100, 25, $folder_thumb);
                CommonHelper::cropImage2($request->image, $nameFile, 150, 37, $folder_medium);
                CommonHelper::cropImage2($request->image, $nameFile, 200, 50, $folder_larage);
                $folder = 'upload/images/products';
                CommonHelper::uploadImage($request->image, $nameFile, $folder);
            }
            //Xoá ảnh cũ khi có upload ảnh mới
            if ($nameFileOld != Products::IMAGE && $nameFile != Products::IMAGE) {
                $path         = 'upload/images/products/';
                $path_thumb   = 'upload/images/products/thumb/';
                $path_medium  = 'upload/images/products/medium/';
                $path_larage  = 'upload/images/products/large/';
                CommonHelper::deleteImage($nameFileOld, $path);
                CommonHelper::deleteImage($nameFileOld, $path_thumb);
                CommonHelper::deleteImage($nameFileOld, $path_medium);
                CommonHelper::deleteImage($nameFileOld, $path_larage);
            }
            DB::commit();
            return redirect()->route('products.list_brand')->with('success', 'Cập nhật thương hiệu sản phẩm thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('products.list_brand')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    // xu ly xoa thuong hieu san pham
    public function delete_brand(Request $request)
    {
        $this->authorize('delete', Products::class);
        $data = $request->all();
        $id = $data['id'];
        $brand = Brand::find($id);
        $nameFile = $brand->image;
        $path = 'upload/images/products/';
        $path_thumb   = 'upload/images/products/thumb/';
        $path_medium  = 'upload/images/products/medium/';
        $path_large  = 'upload/images/products/large/';
        CommonHelper::deleteImage($nameFile, $path);
        CommonHelper::deleteImage($nameFile, $path_thumb);
        CommonHelper::deleteImage($nameFile, $path_medium);
        CommonHelper::deleteImage($nameFile, $path_large);
        Brand::where('id', $id)->delete();
    }

    public function list_tag_event(){
        $this->authorize('viewAny', Products::class);
        $tags = Tag_event::get();
        return \view('admin.products.list-tagEvents', \compact('tags'));
    }

    public function store_tag_event(Request $request){
        $this->authorize('create', Products::class);
        $request->validate(
            [
                'name' => 'required|string|max:250',
                'icon' => 'required|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'icon' => ':attribute là định dạng png, jpg, jpeg - có dung lượng tối đa 2MB',
            ],
            [
                'name' => 'Tiêu đề',
                'icon' => 'Ảnh icon',
            ],
        );
        if ($request->icon  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->icon->extension();
        }else{
            $nameFile = NULL;
        }
        $input = [
            'name'  => $request->name,
            'icon'  => $nameFile,
            'color_left' => $request->color_left,
            'color_right' => $request->color_right,
        ];
        try {
            DB::beginTransaction();

            $brand = Tag_event::create($input);
            // xu ly anh khong bi vo anh
            if ($request->icon != null) {
                $folder_thumb    = 'upload/images/products/thumb/';
                CommonHelper::cropImage2($request->icon, $nameFile, 50, 50, $folder_thumb);
                $folder = 'upload/images/products';
                CommonHelper::uploadImage($request->icon, $nameFile, $folder);
            }
            DB::commit();
            return redirect()->route('products.list_tag-event')->with('success', 'Thêm thẻ Tag mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('products.list_tag-event')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }


    public function update_tag_event(Request $request){
        $this->authorize('update', Products::class);
        $request->validate(
            [
                'name' => 'required|string|max:250',
                'icon' => 'image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'icon' => ':attribute là định dạng png, jpg, jpeg - có dung lượng tối đa 2MB',
            ],
            [
                'name' => 'Tiêu đề',
                'icon' => 'Ảnh icon',
            ],
        );
        $tag = Tag_event::find($request->id);

        $nameFileOld = $tag->icon;
        if ($request->icon  != null){
            $nameFile = CommonHelper::convertTitleToSlug($request->name, '-') . '-' . time() . '.' . $request->icon->extension();
        }else{
            $nameFile = $nameFileOld;
        }

        $input = [
            'name'  => $request->name,
            'icon'  => $nameFile,
            'color_left' => $request->color_left,
            'color_right' => $request->color_right,
        ];
        try {
            DB::beginTransaction();

            $brand = Tag_event::where('id', $request->id)->update($input);
            // xu ly anh khong bi vo anh
            if ($request->icon != null) {
                $folder_thumb    = 'upload/images/products/thumb/';
                CommonHelper::cropImage2($request->icon, $nameFile, 50, 50, $folder_thumb);
                $folder = 'upload/images/products';
                CommonHelper::uploadImage($request->icon, $nameFile, $folder);
                CommonHelper::deleteImage($nameFileOld, $folder);
                CommonHelper::deleteImage($nameFileOld, $folder_thumb);
            }
            DB::commit();
            return redirect()->route('products.list_tag-event')->with('success', 'Cập nhật thẻ Tag thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('products.list_tag-event')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại!');
        }
    }
    public function delete_tag_event(Request $request)
    {
        $this->authorize('delete', Products::class);
        $data = $request->all();
        $id = $data['id'];
        $tag = Tag_event::find($id);
        $nameFile = $tag->icon;
        $path = 'upload/images/products/';
        $path_thumb   = 'upload/images/products/thumb/';
        CommonHelper::deleteImage($nameFile, $path);
        CommonHelper::deleteImage($nameFile, $path_thumb);
        Tag_event::find($id)->delete();
    }
}
