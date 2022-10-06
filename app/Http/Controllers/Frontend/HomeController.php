<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\CategoryRelationship;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Locationmenu;
use App\Models\Recruit;
use App\Models\Slider;
use App\Models\Recruit_register;
use App\Models\Detailproperties;
use App\Models\Categoryproperty;
use App\Models\Propertyproducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;

class HomeController extends Controller
{
    public function index(){

        $agent = new Agent();
        $ag = "";
        $isMobile = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";

        if($agent->isPhone())
        {
            $isMobile = "phone";
        }

        //lay danh muc cha len trang chu
        $get_cat_parents = Category::where('taxonomy', 0)
        ->where('parent_id', 0)
        ->where('status', 1)
        ->where('show_push_product', 1)
        ->get();
        $list_cat_id = array();
        foreach ($get_cat_parents as $cat){
            $list_cat_id[] = $cat->id;
        }
        $list_cat = \implode(' ', $list_cat_id);
        $Sidebars           = $this->getmenu('sidebar');
        $locale             = config('app.locale');
        $banner_1   = DB::table('sliders')->where('location',1)->where('status', 1)->inRandomOrder()->first();
        $banner_2   = DB::table('sliders')->where('location',2)->where('status', 1)->inRandomOrder()->first();
        $banner_3   = DB::table('sliders')->where('location',3)->where('status', 1)->inRandomOrder()->first();
        $banner_sidebar   = DB::table('sliders')->where('location',4)->where('status', 1)->inRandomOrder()->first();
        $sliders = DB::table('sliders')->where('location',9)->where('status', 1)->orderBy('position', 'ASC')->get();
        $list_post = DB::table('posts')->where('status',1)->whereNull('deleted_at')->limit(3)->get();
        
        return view('frontend.index',[
            'get_cat_parents' =>  $get_cat_parents,
            'Sidebars'        => $Sidebars,
            'banner_1'        => $banner_1,
            'banner_2'        => $banner_2,
            'banner_3'        => $banner_3,
            'banner_sidebar'  => $banner_sidebar,
            'sliders'         => $sliders,
            'list_post'       => $list_post,
            'list_cat'        => $list_cat,
            'locale'          => $locale,
            'agent'           => $ag,
            'isMobile'        => $isMobile,
        ]);
    }
    //lay danh muc cho blog tren menu
    public function getcategoryblog(){
        $categoryblog = Category::select('*')
        ->where('categories.taxonomy','=',1)
        ->where('categories.status','=',1)

        ->whereNull('deleted_at')
        ->limit(7)
        ->get();
        return $categoryblog;
    }
    // lay memu sidebar
    public function getmenu($location){
        if($location == 'sidebar')  {$location = "sidebar_location"; }
        if($location == 'menu')  {$location = "menu_location"; }
        if($location == 'footer')  {$location = "footer_location"; }
        $getmenu = MenuItems::select('admin_menu_items.*','detailproperties.ma as code_property','categoryproperties.name as name_categories_property', 'categoryproperties.ma as code_categoryproperties')
        ->leftJoin('locationmenus', 'locationmenus.'.$location, '=', 'admin_menu_items.menu')
        ->leftjoin('detailproperties','detailproperties.id','admin_menu_items.property')
        ->leftjoin('categoryproperties','categoryproperties.id','detailproperties.categoryproperties_id')
        ->where('locationmenus.'.$location,'<>','0')
        ->where('locationmenus.'.$location,'<>',null)
        ->get();
        return $getmenu;
    }
    
    public function arrcategory(){
        $arrCategory = DB::table('categories')->select('id','name','name2','slug', 'thumb', 'banner')
        ->where('taxonomy',Category::SAN_PHAM)
        ->where('parent_id',0)
        ->where('status',1)
        ->where('show_push_product','=',1)
        ->whereNull('deleted_at')
        ->get();
        return $arrCategory;
    }
    //lay san pham
    public function getProducts(Request $request){
        $locale       = config('app.locale');
        if (!is_null($request->id)){
            $cat_parent      = Category::find($request->id);
            $view     = view('frontend.get-products', [
                'cat_parent' => $cat_parent,
                'locale'   => $locale,
            ])->render();
        }
        return response()->json($view);
    }
    //lay san pham deal
    public function getdealProduct(Request $request){
        $dealProduct = Products::where('status',1)
        ->whereNull('deleted_at')->whereNotNull('time_deal')->where('time_deal', '>', date('Y-m-d').' 23:59:59')
        ->orderBy('time_deal', 'desc')->inRandomOrder()->limit(8)->get();
        $time_deal = NULL;
        $t=0;

        foreach($dealProduct as $k){
            $t++;
            $time_deal = $k->time_deal;
            if($t==1){ \false;}
        }

        $view2     = view('frontend.get-dealsproducts', [
            'dealProduct' => $dealProduct,
            'time_deal' => $time_deal,
        ])->render();
        return response()->json($view2);
    }
    // lay san pham moi
    public function getnewProduct(Request $request){
        $product_hot_sale    = Products::where('status',1)->where('hot_sale', 1)->whereNull('deleted_at')->inRandomOrder()->limit(10)->get();
        $product_new    = Products::where('status',1)->where('new', 1)->whereNull('deleted_at')->inRandomOrder()->limit(10)->get();

        $view2     = view('frontend.get-newproducts', [
            'product_new' => $product_new,
            'product_hot_sale' => $product_hot_sale,
        ])->render();
        return response()->json($view2);
    }

    public function loadfooter(Request $request){

        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $view2     = view('frontend.layouts.footer', [
            'posts_footer' => $posts_footer, 
        ])->render();
        return response()->json($view2);
    }

    public function loadsliderbottom(Request $request){

        $list_brand = Brand::get();

        $view2  = view('frontend.slider-bottom', [
            'list_brand' => $list_brand, 
        ])->render();
        return response()->json($view2);
    }

    //trang blog chung
    public function categoryBlogs(Request $request){
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $active_menu = "post";
        $locale       = config('app.locale');
        if($request->input('tim-kiem')){
            $search = $request->input('tim-kiem');
        }else{
            $search = '';
        }
        $Sidebars           = $this->getmenu('sidebar');
        $getcategoryblog    = $this->getcategoryblog();
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $arrCategory = DB::table('categories')->where('status',1)
        ->where('taxonomy',Category::BAI_VIET)
        ->where('parent_id',0)
        ->whereNull('deleted_at')
        ->get();

        $blogs = Post::where('status',1)
        ->where('title', 'LIKE', "%$search%")
        ->paginate(8)->withQueryString();

        $latest_blog = DB::table('posts')->where('status',1)
        ->whereNull('deleted_at')->limit(5)->get();
        return view('frontend.category-blog',[
            'arrCategory'     => $arrCategory,
            'blogs'           => $blogs,
            'latest_blog'     => $latest_blog,
            'Sidebars'        => $Sidebars,
            // 'Menus'           => $Menus,
            // 'Sub_menus'       => $Sub_menus,
            'getcategoryblog' => $getcategoryblog,
            'locale'          => $locale,
            'active_menu'   => $active_menu,
            'posts_footer' => $posts_footer,
            'agent' => $ag,

        ]);
    }
    // xu ly bai viet duoc tim kiem
    public function categoryBlog(Request $request, $slug){

        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $active_menu = "post";
        $locale     = config('app.locale');
        if($request->input('tim-kiem')){
            $search = $request->input('tim-kiem');
        }else{
            $search = '';
        }
        $Sidebars           = $this->getmenu('sidebar');
        // $Menus              = $this->getmenu('menu');
        // $Sub_menus          = $this->getmenu('submenu');
        $getcategoryblog    = $this->getcategoryblog();
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $blog_category = DB::table('categories')->where('slug',$slug)
        ->where('status',1)->where('taxonomy',Category::BAI_VIET)
        ->first();
        if (!is_null($blog_category)){
            $arrCategory   = DB::table('categories')->where('status',1)
            ->where('taxonomy',Category::BAI_VIET)
            ->where('parent_id',0)
            ->whereNull('deleted_at')
            ->get();
            $category_rela = CategoryRelationship::where('cat_id',$blog_category->id)
            ->whereNull('product_id')->get();
            $arrPost = [];
            foreach ($category_rela as $category){
                $arrPost[] = $category->post_id;
            }
            $blogs = Post::whereIn('id',$arrPost)
            ->where('status',1)
            ->where('title', 'LIKE', "%$search%")
            ->paginate(8)->withQueryString();
            $latest_blog = DB::table('posts')->where('status',1)
            ->whereNull('deleted_at')->limit(5)->get();
            return view('frontend.category-blog',[
                'arrCategory'     => $arrCategory,
                'blogs'           =>$blogs,
                'latest_blog'     => $latest_blog,
                'Sidebars'        => $Sidebars,
                'getcategoryblog' => $getcategoryblog,
                'locale'          => $locale,
                'active_menu'   => $active_menu,
                'posts_footer' => $posts_footer,
                'agent' => $ag,
            ]);
        }
        return abort(404);
    }
    //trang chi tiet bai viet
    public function singlePost(Request $request, $slug){
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $active_menu = "post";
        $locale       = config('app.locale');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $post = Post::where('slug',$slug)
        ->where('status',1)->whereNull('deleted_at')->first();
        if (!is_null($post)){
            $arrCategory = DB::table('categories')->where('status',1)
            ->where('taxonomy',Category::BAI_VIET)
            ->where('parent_id',0)
            ->whereNull('deleted_at')->get();

            $latest_blog = DB::table('posts')->where('status',1)
            ->whereNull('deleted_at')->limit(5)->get();

            $arrCategoryRela = [];
            foreach ($post->getCategoryRela as $item){
                $arrCategoryRela[] = $item->cat_id;
            }
            $category_post = DB::table('category_relationships')
            ->whereIn('cat_id',$arrCategoryRela)->get();
            $arrPost = [];
            foreach ($category_post as $category){
                $arrPost[] = $category->post_id;
            }

            $post_pre = Post::whereIn('id',$arrPost)
            ->where('id','<>',$post->id)
            ->first();
            $post_next = null;
            if (!is_null($post_pre)){
                $post_next = Post::whereIn('id',$arrPost)
                ->whereNotIn('id',[$post->id,$post_pre->id])
                ->first();
            }

            $count_vote = Vote::where('post_id',$post->id)->whereNull(['deleted_at','product_id'])->count();
            $votes = Vote::with('parentID')
            ->where('post_id',$post->id)
            ->where('parent_id',0)->whereNull(['deleted_at','product_id'])->get();
            $Sidebars           = $this->getmenu('sidebar');
            $getcategoryblog    = $this->getcategoryblog();
            return view('frontend.single-post',[
                'arrCategory'     => $arrCategory,
                'post'            => $post,
                'latest_blog'     => $latest_blog,
                'votes'           => $votes,
                'count_vote'      => $count_vote,
                'post_pre'        => $post_pre,
                'post_next'       => $post_next,
                'Sidebars'        => $Sidebars,
                'getcategoryblog' => $getcategoryblog,
                'locale'          => $locale,
                'active_menu'     => $active_menu,
                'posts_footer'    => $posts_footer,
                'agent'           => $ag,
            ]);
        }
        return abort(404);
    }

    public function product_cat(Request $request){
    
        ///////////////Tham so dau vao//////////////////]

        $val=  array_values($request->all());
            // $val=  ['ram' => '8g','16g'];


        // dd($request->all());

        $filter = $request->all();
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $active_menu = "product";
        $locale       = config('app.locale');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $Sidebars = $this->getmenu('sidebar');



        $cat = Category::where('slug', $request->slug)->first();
        if (empty($cat)) {
            return abort(404);
        }

        $categories = Category::where('taxonomy',Category::SAN_PHAM)
        ->where('parent_id',$cat->id)
        ->where('status',1)
        ->get();
        $cat_parent = Category::where('taxonomy',Category::SAN_PHAM)
        ->where('parent_id', 0)
        ->where('status',1)
        ->get();

        //////////////Dieu Kien loc//////////////////

        $attributes = Categoryproperty::select('categoryproperties.*', 'categories.slug as slug')
        ->leftjoin('categoryproperties_manages', 'categoryproperties.id', '=', 'categoryproperties_manages.categoryproperties_id')
        ->leftjoin('categories','categories.id','categoryproperties_manages.category_id')
        ->get();

        $filter_all = [];
        foreach ($filter as $key => $value) {
            $value  = explode(',',$value);
            $filter_all = array_merge($filter_all, $value);
        }
        $origin_url = $request->url();
        foreach ($attributes as $key_attr => $attr) {
            $detailproperties = Detailproperties::where('categoryproperties_id',$attr->id)->get();
            foreach ($detailproperties as $key_attr_dt => $attr_detail) {
                $Propertyproducts = Propertyproducts::select('propertyproducts.*','detailproperties.ma as ma')
                ->leftjoin('detailproperties','detailproperties.id','propertyproducts.detailproperties_id')
                ->leftjoin('products','products.id','propertyproducts.products_id')
                ->where('propertyproducts.detailproperties_id',$attr_detail->id)
                ->where('products.deleted_at',null)
                ->count();
                $attr_detail->setAttribute('count_product',$Propertyproducts);
                $url ="";
                $string_value='';
                $get_name_key_prev='';
                $name_pre="";
                $name_current="";
                $name="";
                if(in_array($attr_detail->ma,$filter_all)){
                    $attr_detail->setAttribute('attr_checked',1);
                    $value_url = $filter_all;
                    if (($key = array_search($attr_detail->ma, $value_url)) !== false) {
                        unset($value_url[$key]);
                    }
                    foreach ($value_url as $key => $value) {
                       $cate_properties = Categoryproperty::select('categoryproperties.ma')
                       ->leftjoin('detailproperties','detailproperties.categoryproperties_id','categoryproperties.id')
                       ->where('detailproperties.ma',$value)
                       ->first();
                       if(isset($cate_properties->ma)){
                        $name=$cate_properties->ma;
                       }
                        if(isset($value_url[$key-1])){
                        $get_name_key_prev = $value_url[$key-1];
                        $cate_properties_pre = Categoryproperty::select('categoryproperties.ma')
                       ->leftjoin('detailproperties','detailproperties.categoryproperties_id','categoryproperties.id')
                       ->where('detailproperties.ma',$get_name_key_prev)
                       ->first();
                           if(isset($cate_properties_pre->ma)){
                            $name_pre=$cate_properties_pre->ma;
                           }
                        }
                        if($name_pre == $name){
                            $string_value = trim($string_value, '&').','.$value;
                        }
                        else{
                        $string_value = $string_value.'&'.$name.'='.$value;
                       }
                    }
                    $url = $origin_url.'?'.trim($string_value, '&');
                    $attr_detail->setAttribute('fullurl',rtrim($url, '?'));
                }
                else{
                    $attr_detail->setAttribute('attr_checked',0);
                    // if (($key = array_search($attr_detail->ma, $filter_all)) == false) {
                    //     array_push($filter_all,$attr_detail->ma);
                    // }
                    foreach ($filter_all as $key => $value) {
                       $cate_properties = Categoryproperty::select('categoryproperties.ma')
                       ->leftjoin('detailproperties','detailproperties.categoryproperties_id','categoryproperties.id')
                       ->where('detailproperties.ma',$value)
                       // ->where('detailproperties.ma',$attr_detail->ma)
                       ->first();
                       if(isset($cate_properties->ma)){
                        $name=$cate_properties->ma;
                       }

                       $cate_properties_curren = Categoryproperty::select('categoryproperties.ma')
                       ->leftjoin('detailproperties','detailproperties.categoryproperties_id','categoryproperties.id')
                       ->where('detailproperties.ma',$attr_detail->ma)
                       ->first();

                       if(isset($cate_properties_curren->ma)){
                        $name_current=$cate_properties_curren->ma;
                       }

                        if(isset($filter_all[$key-1])){
                        $get_name_key_prev = $filter_all[$key-1];
                        $cate_properties_pre = Categoryproperty::select('categoryproperties.ma')
                       ->leftjoin('detailproperties','detailproperties.categoryproperties_id','categoryproperties.id')
                       ->where('detailproperties.ma',$get_name_key_prev)
                       ->first();
                           if(isset($cate_properties_pre->ma)){
                            $name_pre=$cate_properties_pre->ma;
                           }
                       }
                       if($name_pre != $name){
                        $string_value = $string_value.'&'.$name.'='.$value;
                        }
                       else{
                        $string_value = trim($string_value, '&').','.$value;
                        
                       }
                    }

                    $url = $origin_url.'?'.trim($string_value, '&');
                    if(Str::contains($url , $attr->ma)  == true)
                    {
                    $find = $attr->ma.'=';
                    $replacement =  $attr->ma.'='.$attr_detail->ma.',';
                    $url = str_replace($find,$replacement,$url);
                    }
                    else{
                        $url = $url.'&'.$attr->ma.'='.$attr_detail->ma;
                    }
                    $attr_detail->setAttribute('fullurl',rtrim($url, '?'));
                }
            }
            $attr->setAttribute('detailproperty', $detailproperties);
        }
        //////////////Cau Lenh Truy Van DL//////////////////
    $exists_property ="";
    $exists_property =  MenuItems::where('link',$request->slug)->whereIn('property',$val)->get();

    if($request->p){
    $products = Products::distinct()->select('products.*','detailproperties.ma as matt','categories.slug as url')
    ->leftjoin('category_relationships','category_relationships.product_id','products.id')
    ->leftjoin('categories','categories.id','category_relationships.cat_id')
    ->leftjoin('propertyproducts','propertyproducts.products_id','products.id')
    ->leftJoin('detailproperties','detailproperties.id','propertyproducts.detailproperties_id')
    ->whereIn('detailproperties.ma',$val)
    ->where('categories.slug',$request->slug)
    ->where('products.status',1)
    ->groupBy('products.id')
    ->paginate(20)->withQueryString();
    }
    else{
    $products = Products::where('status', 1)->whereIn('id', $list_id)
                ->orderBy('price_onsale', 'ASC')
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(20)->withQueryString();
    }

    $slug = $request->slug;

        //////////////Tra ve//////////////////


    return \view('frontend.product', \compact('products', 'categories',
        'cat', 'Sidebars','locale', 'active_menu', 'posts_footer','cat_parent','attributes','slug'))->with('agent',$ag);


}

    // /* ==== Xử lý dữ liệu trang danh sách sản phẩm */
    // public function list_product(Request $request){
    //     $agent = new Agent();
    //     $ag = "";
    //     if($agent->isMobile()){
    //         $ag = "mobile";
    //     }
    //     else $ag = "desktop";
    //     $active_menu = "product";
    //     $locale       = config('app.locale');
    //     $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
    //     $searchValues = '';
    //     if($request->query('searchs') !=""){
    //         $searchValues = preg_split('/\s+/', $request->query('searchs'), -1, PREG_SPLIT_NO_EMPTY);
    //     }
    //     $Sidebars = $this->getmenu('sidebar');
    //     $categories = Category::where('taxonomy',Category::SAN_PHAM)
    //         ->where('parent_id',0)
    //         ->where('status',1)
    //         ->get();
    //     $cat = NULL;
    //     $orderby = $request->input('sort');
    //         if(!empty($request->input('min-value')) && !empty($request->input('max-value'))){
    //             $min_price = $request->input('min-value');
    //             $max_price = $request->input('max-value');
    //         }else{
    //             $min_price = 0;
    //             $max_price = 1000000000;
    //         }
    //         if($orderby=='A-Z'){
    //             $products = Products::where('status', 1)
    //             ->where(function ($q) use ($searchValues) {
    //                     if($searchValues!="")
    //                       foreach ($searchValues as $value) {
    //                         $q->orWhere('name', 'like', '%'.$value.'%');
    //                       }
    //                 })
    //             ->orderBy('name', 'ASC')
    //             ->whereBetween('price_onsale', [$min_price, $max_price])
    //             ->paginate(20)->withQueryString();
    //         }elseif($orderby=='Z-A'){
    //             $products = Products::where('status', 1)
    //             ->where(function ($q) use ($searchValues) {
    //                     if($searchValues!="")
    //                       foreach ($searchValues as $value) {
    //                         $q->orWhere('name', 'like', '%'.$value.'%');
    //                       }
    //                 })
    //             ->orderBy('name', 'DESC')
    //             ->whereBetween('price_onsale', [$min_price, $max_price])
    //             ->paginate(20)->withQueryString();;
    //         }elseif($orderby=='gia-giam-dan'){
    //             $products = Products::where('status', 1)
    //             ->where(function ($q) use ($searchValues) {
    //                     if($searchValues!="")
    //                       foreach ($searchValues as $value) {
    //                         $q->orWhere('name', 'like', '%'.$value.'%');
    //                       }
    //                 })
    //             ->orderBy('price_onsale', 'DESC')
    //             ->whereBetween('price_onsale', [$min_price, $max_price])
    //             ->paginate(20)->withQueryString();
    //         }elseif($orderby=='gia-tang-dan'){
    //             $products = Products::where('status', 1)
    //             ->where(function ($q) use ($searchValues) {
    //                     if($searchValues!="")
    //                       foreach ($searchValues as $value) {
    //                         $q->orWhere('name', 'like', '%'.$value.'%');
    //                       }
    //                 })
    //             ->orderBy('price_onsale', 'ASC')
    //             ->whereBetween('price_onsale', [$min_price, $max_price])
    //             ->paginate(20)->withQueryString();
    //         }
    //         else{
    //             $products = Products::where('status', 1)
    //             ->where(function ($q) use ($searchValues) {
    //                     if($searchValues!="")
    //                       foreach ($searchValues as $value) {
    //                         $q->orWhere('name', 'like', '%'.$value.'%');
    //                       }
    //                 })
    //             ->whereBetween('price_onsale', [$min_price, $max_price])
    //             ->paginate(20)->withQueryString();
    //         }

    //     return \view('frontend.product', \compact('products', 'categories',
    //     'cat', 'Sidebars','locale', 'active_menu', 'posts_footer'))->with('agent',$ag);
    // }

    // // trang danh sach san pham khi loc
    // public function product_cat(Request $request, $slug){
    //     $agent = new Agent();
    //     $ag = "";
    //     if($agent->isMobile()){
    //         $ag = "mobile";
    //     }
    //     else $ag = "desktop";
    //     $active_menu = "product";
    //     $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

    //     $exists_property =  MenuItems::where('link',$slug)->where('property','<>',0)
    //     ->Where('property','<>',null)->first();
    //     $cat = Category::where('slug', $slug)->first();
    //     if (empty($cat)) {
    //         return abort(404);
    //     }

    //     $categories = Category::where('taxonomy',Category::SAN_PHAM)
    //         ->where('parent_id',$cat->id)
    //         ->where('status',1)
    //         ->get();

    //     $cat_parent = Category::where('taxonomy',Category::SAN_PHAM)
    //     ->where('parent_id', 0)
    //     ->where('status',1)
    //     ->get();


    //     $categoryproperties  =  DB::table('categoryproperties')->select('categoryproperties.*')
    //     ->leftjoin('categoryproperties_manages', 'categoryproperties.id', '=', 'categoryproperties_manages.categoryproperties_id')
    //     ->leftjoin('categories','categories.id', '=', 'categoryproperties_manages.category_id')
    //     ->where('categories.id',$cat->id)
    //     ->get();


    //     $detailproperty = Detailproperties::get();

    //     $Sidebars           = $this->getmenu('sidebar');
    //     $locale             = config('app.locale');
    //     $banner_1 = DB::table('sliders')->where('location',6)->first();
    //     $banner_2 = DB::table('sliders')->where('location',7)->first();
    //     $banner_3 = DB::table('sliders')->where('location',8)->first();

    //     if(!empty($exists_property)){
    //         $products = Products::select('products.*')
    //         ->leftJoin('propertyproducts','products.id', 'propertyproducts.products_id')
    //         ->leftJoin('category_relationships','products.id','category_relationships.product_id')
    //         ->where('propertyproducts.detailproperties_id',$exists_property->property)
    //         ->where('category_relationships.cat_id',$cat->id) 
    //         ->where('products.status', 1)->paginate(20)->withQueryString();

    //     }
    //     else{
    //         /* Xử lý đệ quy vòng lặp khi có danh mục cha xác định và lấy danh sách sản phẩm theo từng danh mục
    //         thực hiện hàm get_product_by_cat tại model category */
    //         $list_id = $cat->get_product_by_cat();
    //         $orderby = $request->input('sort');
    //             if(!empty($request->input('min-value')) && !empty($request->input('max-value'))){
    //                 $min_price = $request->input('min-value');
    //                 $max_price = $request->input('max-value');
    //             }else{
    //                 $min_price = 0;
    //                 $max_price = 1000000000;
    //             }
    //             if($orderby=='A-Z'){
    //                 $products = Products::where('status', 1)->whereIn('id', $list_id)
    //                 ->orderBy('name', 'ASC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(20)->withQueryString();
    //             }elseif($orderby=='Z-A'){
    //                 $products = Products::where('status', 1)->whereIn('id', $list_id)
    //                 ->orderBy('name', 'DESC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(20);
    //             }elseif($orderby=='gia-giam-dan'){
    //                 $products = Products::where('status', 1)->whereIn('id', $list_id)
    //                 ->orderBy('price_onsale', 'DESC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(20)->withQueryString();
    //             }elseif($orderby=='gia-tang-dan'){
    //                 $products = Products::where('status', 1)->whereIn('id', $list_id)
    //                 ->orderBy('price_onsale', 'ASC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(20)->withQueryString();
    //             }else{
    //                 $products = Products::where('status', 1)->whereIn('id', $list_id)->orderBy('id', 'DESC')
    //                 ->whereBetween('price_onsale', [$min_price, $max_price])->paginate(20)->withQueryString();
    //             }
    //         }
    //     return \view('frontend.product', \compact('products', 'categories', 'cat','Sidebars',
    //    'locale', 'active_menu', 'posts_footer', 'cat_parent', 'categoryproperties', 'detailproperty'))->with('agent', $ag);
    // }


    // lay comment
public function commentPost(Request $request){
    $post = Post::find($request->comment_post);
    if (!is_null($post)){
        $input = [
            'level'     => 0,
            'comment'   => $request->comment,
            'post_id'   => $request->comment_post,
            'product_id'=> null,
            'name_user' => $request->author,
            'user_id'   => null,
            'email'     => $request->email,
            'parent_id' => $request->comment_parent
        ];
        Vote::create($input);
        return redirect()->route('singlePost',['slug'=>$post->slug]);
    }
}
    //xu ly lay danh gia vote
public function getFormVote(Request $request){
    $locale            = config('app.locale');
    if ($request->type == 'reply'){
        $view = view('frontend.form_reply', [
            'post_id'   => $request->post_id,
            'parent_id' => $request->vote_id,
            'type'      => 'reply',
            'locale'    => $locale,

        ])->render();
    }else{
        $view = view('frontend.form_reply', [
            'post_id'   => $request->post_id,
            'parent_id' => $request->vote_id,
            'locale'    => $locale,
        ])->render();
    }
    return response()->json($view);
}
    //xu ly nhap thanh tim kiem ra san pham
public function autotypeahead(Request $request){
    $locale            = config('app.locale');
    $view ='';
    if($request->data!= null)
    {
        $data =  Products::where('name','like', '%' .$request->data. '%')->limit(15)->get();
        if($data !=null)
            $view = view('frontend.search', [
                'data'   => $data,
                'locale' => $locale,
            ])->render();
    }
    return response()->json(['html' => $view]);
}
    //lien he
public function contact(){
    $agent = new Agent();
    $ag = "";
    if($agent->isMobile()){
        $ag = "mobile";
    }
    else $ag = "desktop";
    $active_menu = "contact";
    $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
    $locale             = config('app.locale');
    $Sidebars           = $this->getmenu('sidebar');
        // $Menus              = $this->getmenu('menu');
    return \view('frontend.contact', \compact('Sidebars', 'locale', 'active_menu', 'posts_footer'))->with('agent',$ag);
}
public function changeLanguage($language)
{
    Session::put('website_language', $language);

    return redirect()->back();
}


public function recruit()
{
    $agent = new Agent();
    $ag = "";
    if($agent->isMobile()){
        $ag = "mobile";
    }
    else $ag = "desktop";
    $list_location = Recruit::where('status',1)->groupBy('location')->get();
    $list_vacancies = Recruit::where('status',1)->orderBy('created_at', 'ASC')->get();
    $active_menu = "contact";
    $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
    $Sidebars           = $this->getmenu('sidebar');
        // $Menus              = $this->getmenu('menu');
        // $Sub_menus          = $this->getmenu('submenu');
    return view('frontend.recruit', \compact('Sidebars',  'active_menu', 'posts_footer', 'list_location', 'list_vacancies' ))->with('agent',$ag);
}

public function recruit_register(Request $request)
{
    $agent = new Agent();
    $ag = "";
    if($agent->isMobile()){
        $ag = "mobile";
    }
    else $ag = "desktop";
    $list_location = Recruit::where('status',1)->groupBy('location')->get();
    $list_vacancies = Recruit::where('status',1)->orderBy('created_at', 'ASC')->get();
    $active_menu = "contact";
    $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
    $Sidebars           = $this->getmenu('sidebar');
        // $Menus              = $this->getmenu('menu');
        // $Sub_menus          = $this->getmenu('submenu');

    if ($request->fileupload == null) {
        $request->fileupload = "";
    }

    $recruit_register =[
        'first_name'    => $request->first_name,
        'phone_number'  => $request->phone_number,
        'email'         => $request->email,
        'vitriungtuyen' => $request->vitriungtuyen,
        'parent_id'     => $request->parent_id,
        'fileupload'    => $request->fileupload,
        'status'        => 0,
    ];


    try {
        DB::beginTransaction();
        Recruit_register::create($recruit_register);
        DB::commit();
        return redirect()->route('recruit',[
            'Sidebars' => $Sidebars,
            // 'Menus' => $Menus,
            // 'Sub_menus' => $Sub_menus,
            'active_menu' => $active_menu,
            'posts_footer' => $posts_footer,
            'list_location' => $list_location,
            'list_vacancies' => $list_vacancies,
            'agent' => $ag,
        ])->with('error','Ứng tuyển thành công!');
    }
    catch (\Exception $exception){
        DB::rollBack();
        return redirect()->route('recruit',[
            'Sidebars' => $Sidebars,
            // 'Menus' => $Menus,
            // 'Sub_menus' => $Sub_menus,
            'active_menu' => $active_menu,
            'posts_footer' => $posts_footer,
            'list_location' => $list_location,
            'list_vacancies' => $list_vacancies,
            'agent' => $ag,
        ])->with('error','Đăng kí thất bại!');
    }
}

public function about_us(){
    $agent = new Agent();
    $ag = "";
    if($agent->isMobile()){
        $ag = "mobile";
    }
    else $ag = "desktop";
    $active_menu = "about_us";
    $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
    $locale             = config('app.locale');
    $Sidebars           = $this->getmenu('sidebar');
        // $Menus              = $this->getmenu('menu');
    return \view('frontend.page.about-us', compact('Sidebars' ,'locale', 'active_menu', 'posts_footer'))->with('agent', $ag);
}

public function menucontent(Request $request){
    $Sidebars  = $this->getmenu('sidebar');
    $Sidebarid  = $request->id;
    $agent = new Agent();
    if($agent->isMobile()){
       $view2     = view('frontend.contentmenumobile', [
        'Sidebars'  => $Sidebars, 
    ])->render();
   }
   else{
    $view2     = view('frontend.contentmenu', [
        'Sidebars'  => $Sidebars, 
        'Sidebarid' => $Sidebarid, 
    ])->render();
}


return response()->json($view2);
}
}
