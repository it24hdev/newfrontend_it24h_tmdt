<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\CategoryRelationship;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Locationmenu;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
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
        $Menus              = $this->getmenu('menu');
        $Sub_menus          = $this->getmenu('submenu');
        $locale             = config('app.locale');
        $banner_1   = DB::table('sliders')->where('location',1)->where('status', 1)->inRandomOrder()->first();
        $banner_2   = DB::table('sliders')->where('location',2)->where('status', 1)->inRandomOrder()->first();
        $banner_3   = DB::table('sliders')->where('location',3)->where('status', 1)->inRandomOrder()->first();
        $banner_sidebar   = DB::table('sliders')->where('location',4)->where('status', 1)->inRandomOrder()->first();
        $sliders = DB::table('sliders')->where('location',9)->where('status', 1)->orderBy('position', 'ASC')->get();
        $product_hot_sale    = Products::where('status',1)->where('hot_sale', 1)->whereNull('deleted_at')->inRandomOrder()->limit(10)->get();
        $product_new    = Products::where('status',1)->where('new', 1)->whereNull('deleted_at')->inRandomOrder()->limit(10)->get();
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
        $list_post = DB::table('posts')->where('status',1)->whereNull('deleted_at')->limit(3)->get();
        $list_brand = Brand::get();
        return view('frontend.index',[
        'get_cat_parents' =>  $get_cat_parents,
        'time_deal' => $time_deal,
        'Sidebars'          => $Sidebars,
        'Menus'             => $Menus,
        'Sub_menus'         => $Sub_menus,
        'banner_1'  => $banner_1,
        'banner_2'  => $banner_2,
        'banner_3'  => $banner_3,
        'banner_sidebar'  => $banner_sidebar,
        'sliders'           => $sliders,
        'dealProduct'       => $dealProduct,
        'list_post' => $list_post,
        'list_cat'          => $list_cat,
        'list_brand' => $list_brand,
        'locale'            => $locale,
        'product_hot_sale' => $product_hot_sale,
        'product_new' => $product_new,
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
        if($location == 'sidebar')  {$taxonomy = 0; }
        if($location == 'menu')  {$taxonomy = 3; }
        if($location == 'submenu')  {$taxonomy = 3; $location = 'menu';}
        $getmenu = Locationmenu::select('locationmenus.*','categories.*')
        ->leftJoin('categories', 'categories.id', '=', 'locationmenus.category_id')
        ->where('categories.taxonomy','=', $taxonomy)
        ->where('categories.status','=',1)
        ->where('locationmenus.'.$location,'=',1)
        ->orderby('position','asc')
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

    //trang blog chung
    public function categoryBlogs(Request $request){
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'post']);
            return $next($request);
        });
        $locale       = config('app.locale');
        if($request->input('tim-kiem')){
            $search = $request->input('tim-kiem');
        }else{
            $search = '';
        }
        $Sidebars           = $this->getmenu('sidebar');
        $Menus              = $this->getmenu('menu');
        $Sub_menus          = $this->getmenu('submenu');
        $getcategoryblog    = $this->getcategoryblog();
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
            'Menus'           => $Menus,
            'Sub_menus'       => $Sub_menus,
            'getcategoryblog' => $getcategoryblog,
            'locale'          => $locale,
        ]);
    }
    // xu ly bai viet duoc tim kiem
    public function categoryBlog(Request $request, $slug){
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'post']);
            return $next($request);
        });
        $locale     = config('app.locale');
        if($request->input('tim-kiem')){
            $search = $request->input('tim-kiem');
        }else{
            $search = '';
        }
        $Sidebars           = $this->getmenu('sidebar');
        $Menus              = $this->getmenu('menu');
        $Sub_menus          = $this->getmenu('submenu');
        $getcategoryblog    = $this->getcategoryblog();
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
                'Menus'           => $Menus,
                'Sub_menus'       => $Sub_menus,
                'getcategoryblog' => $getcategoryblog,
                'locale'          => $locale,
            ]);
        }
        return abort(404);
    }
    //trang chi tiet bai viet
    public function singlePost(Request $request, $slug){
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'post']);
            return $next($request);
        });
        $locale       = config('app.locale');
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
            $Menus              = $this->getmenu('menu');
            $Sub_menus          = $this->getmenu('submenu');
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
                'Menus'           => $Menus,
                'Sub_menus'       => $Sub_menus,
                'getcategoryblog' => $getcategoryblog,
                'locale'          => $locale,
            ]);
        }
        return abort(404);
    }

    /* ==== Xử lý dữ liệu trang danh sách sản phẩm */
    public function list_product(Request $request){
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'product']);
            return $next($request);
        });
        $locale       = config('app.locale');
        $searchValues = '';
        if($request->query('searchs') !=""){
            $searchValues = preg_split('/\s+/', $request->query('searchs'), -1, PREG_SPLIT_NO_EMPTY);
        }

        $Sidebars = $this->getmenu('sidebar');
        $Menus    = $this->getmenu('menu');
        $Sub_menus          = $this->getmenu('submenu');
        $categories = Category::where('taxonomy',Category::SAN_PHAM)
            ->where('parent_id',0)
            ->where('status',1)
            ->get();
        $cat = NULL;
        $orderby = $request->input('sort');
            if(!empty($request->input('min-value')) && !empty($request->input('max-value'))){
                $min_price = $request->input('min-value');
                $max_price = $request->input('max-value');
            }else{
                $min_price = 0;
                $max_price = 1000000000;
            }
            if($orderby=='A-Z'){
                $products = Products::where('status', 1)
                ->where(function ($q) use ($searchValues) {
                        if($searchValues!="")
                          foreach ($searchValues as $value) {
                            $q->orWhere('name', 'like', '%'.$value.'%');
                          }
                    })
                ->orderBy('name', 'ASC')
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(12)->withQueryString();
            }elseif($orderby=='Z-A'){
                $products = Products::where('status', 1)
                ->where(function ($q) use ($searchValues) {
                        if($searchValues!="")
                          foreach ($searchValues as $value) {
                            $q->orWhere('name', 'like', '%'.$value.'%');
                          }
                    })
                ->orderBy('name', 'DESC')
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(12)->withQueryString();;
            }elseif($orderby=='gia-giam-dan'){
                $products = Products::where('status', 1)
                ->where(function ($q) use ($searchValues) {
                        if($searchValues!="")
                          foreach ($searchValues as $value) {
                            $q->orWhere('name', 'like', '%'.$value.'%');
                          }
                    })
                ->orderBy('price_onsale', 'DESC')
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(12)->withQueryString();
            }elseif($orderby=='gia-tang-dan'){
                $products = Products::where('status', 1)
                ->where(function ($q) use ($searchValues) {
                        if($searchValues!="")
                          foreach ($searchValues as $value) {
                            $q->orWhere('name', 'like', '%'.$value.'%');
                          }
                    })
                ->orderBy('price_onsale', 'ASC')
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(12)->withQueryString();
            }else{
                $products = Products::where('status', 1)
                ->where(function ($q) use ($searchValues) {
                        if($searchValues!="")
                          foreach ($searchValues as $value) {
                            $q->orWhere('name', 'like', '%'.$value.'%');
                          }
                    })
                ->whereBetween('price_onsale', [$min_price, $max_price])
                ->paginate(12)->withQueryString();
            }

        return \view('frontend.product', \compact('products', 'categories',
        'cat', 'Sidebars', 'Menus','Sub_menus', 'locale'));
    }

    // trang danh sach san pham khi loc
    public function product_cat(Request $request, $slug){
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'product']);
            return $next($request);
        });
        $categories = Category::where('taxonomy',Category::SAN_PHAM)
            ->where('parent_id',0)
            ->where('status',1)
            ->get();
        $cat = Category::where('slug', $slug)->first();
        if (empty($cat)) {
            return abort(404);
        }
        $Sidebars           = $this->getmenu('sidebar');
        $Menus              = $this->getmenu('menu');
        $Sub_menus          = $this->getmenu('submenu');

        $locale             = config('app.locale');
        $banner_1 = DB::table('sliders')->where('location',6)->first();
        $banner_2 = DB::table('sliders')->where('location',7)->first();
        $banner_3 = DB::table('sliders')->where('location',8)->first();
        /* Xử lý đệ quy vòng lặp khi có danh mục cha xác định và lấy danh sách sản phẩm theo từng danh mục
        thực hiện hàm get_product_by_cat tại model category */
        $list_id = $cat->get_product_by_cat();
        $orderby = $request->input('sort');
            if(!empty($request->input('min-value')) && !empty($request->input('max-value'))){
                $min_price = $request->input('min-value');
                $max_price = $request->input('max-value');
            }else{
                $min_price = 0;
                $max_price = 1000000000;
            }
            if($orderby=='A-Z'){
                $products = Products::where('status', 1)->whereIn('id', $list_id)
                ->orderBy('name', 'ASC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(12)->withQueryString();;
            }elseif($orderby=='Z-A'){
                $products = Products::where('status', 1)->whereIn('id', $list_id)
                ->orderBy('name', 'DESC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(12)->withQueryString();;
            }elseif($orderby=='gia-giam-dan'){
                $products = Products::where('status', 1)->whereIn('id', $list_id)
                ->orderBy('price_onsale', 'DESC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(12)->withQueryString();;
            }elseif($orderby=='gia-tang-dan'){
                $products = Products::where('status', 1)->whereIn('id', $list_id)
                ->orderBy('price_onsale', 'ASC')->whereBetween('price_onsale', [$min_price, $max_price])->paginate(12)->withQueryString();;
            }else{
                $products = Products::where('status', 1)->whereIn('id', $list_id)->orderBy('id', 'DESC')
                ->whereBetween('price_onsale', [$min_price, $max_price])->paginate(12)->withQueryString();;
            }
        return \view('frontend.product', \compact('products', 'categories', 'cat','Sidebars',
        'Menus','Sub_menus','locale'));
    }
    // xu ly lay comment
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
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'contact']);
            return $next($request);
        });
        $locale             = config('app.locale');
        $Sidebars           = $this->getmenu('sidebar');
        $Menus              = $this->getmenu('menu');
        $getcategoryblog    = $this->getcategoryblog();
        return \view('frontend.contact', \compact('Sidebars', 'Menus', 'getcategoryblog','locale'));
    }
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
