<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Categoryproperty;
use App\Models\CategoryRelationship;
use App\Models\Detailproperties;
use App\Models\Post;
use App\Models\Products;
use App\Models\Propertyproducts;
use App\Models\Recentactivity;
use App\Models\Recruit;
use App\Models\Recruit_register;
use App\Models\Vote;
use App\Models\Deals;
use App\Models\Slider;
use Database\Seeders\categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use App\Models\admin_menu_items;
use function compact;
use function implode;
use function view;

class HomeController extends Controller
{
    public function index()
    {
        //lay danh muc cha co san pham
        $get_cat_parents = DB::table('categories')->select('categories.*')
        ->leftjoin('category_relationships','category_relationships.cat_id','categories.id')
        ->where('category_relationships.product_id','<>','')
        ->where('categories.parent_id',0)
        ->where('categories.show_push_product', 1)
        ->where('categories.status', 1)
        ->groupby('categories.id')
        ->get();
        $list_cat= $get_cat_parents->pluck('id')->all();
        $list_cat = implode('_', $list_cat);

        //slider banner header
        $sliders = DB::table('sliders')->where('location', 9)->where('status', 1)->orderBy('position', 'ASC')->get();

        //da ngon ngu
        $locale = config('app.locale');

        //phan biet mobile / desktop
        $agent = new Agent();
        if ($agent->isPhone()) {
            //lay sp deal
            $get_hot_sale_mobile = Products::select(DB::raw('deals.name_deal '),DB::raw('deals.price_deal ') ,DB::raw('products.*'))
                ->leftjoin('deals', 'products.id', 'deals.product_id')
                ->where('products.status',1)->where('deals.status_deal', 1)
                ->where('deals.start_time','<',now())->where('deals.end_time','>',now())
                ->orderBy('deals.end_time', 'asc')
                ->limit(8)->get();
            //lay thoi gian hot sale
            $time_sale = Deals::select(DB::raw('max(end_time) as time_sale'))->where('status_deal', 1)->first('time_sale');
            $deal_background = Slider::where('status', 1)->where('location',5)->first();
            $background = json_decode($deal_background->background);
            $count_is_hot = Products::where('is_hot',1)->where('status',1)->count();
            $count_is_new = Products::where('is_new',1)->where('status',1)->count();
            $count_is_promotion = Products::where('is_promotion',1)->where('status',1)->count();
            $category_promotion = Category::where('is_promotion',1)->where('status',1)->get();

            return view('frontend.mobile.indexmobile', [
                'list_cat' => $list_cat,
                'sliders' => $sliders,
                'locale' => $locale,
                'time_sale' => $time_sale,
                'get_cat_parents' => $get_cat_parents,
                'get_hot_sale_mobile' => $get_hot_sale_mobile,
                'background' => $background,
                'deal_background' => $deal_background,
                'count_is_hot' => $count_is_hot,
                'count_is_new' => $count_is_new,
                'count_is_promotion' => $count_is_promotion,
                'category_promotion' => $category_promotion,
            ]);
        } else {
            $Sidebars = $this->getmenu('sidebar');
            $list_cat_head = Category::where('taxonomy', 0)
                ->where('parent_id', 0)
                ->where('status', 1)
                ->where('show_push_product', 1)->limit(8)
                ->get();
            $recentactivity = Recentactivity::where('status', 1)->get();
            $banner_1 = DB::table('sliders')->where('location', 1)->where('status', 1)->inRandomOrder()->first();
            $banner_2 = DB::table('sliders')->where('location', 2)->where('status', 1)->inRandomOrder()->first();
            $banner_3 = DB::table('sliders')->where('location', 3)->where('status', 1)->inRandomOrder()->first();
            $banner_sidebar = DB::table('sliders')->where('location', 4)->where('status', 1)->inRandomOrder()->first();
            $list_post = DB::table('posts')->where('status', 1)->whereNull('deleted_at')->limit(3)->get();
            return view('frontend.index', [
                'get_cat_parents' => $get_cat_parents,
                'list_cat_head' => $list_cat_head,
                'Sidebars' => $Sidebars,
                'banner_1' => $banner_1,
                'banner_2' => $banner_2,
                'banner_3' => $banner_3,
                'banner_sidebar' => $banner_sidebar,
                'sliders' => $sliders,
                'list_post' => $list_post,
                'list_cat' => $list_cat,
                'locale' => $locale,
                'recentactivity' => $recentactivity,
            ]);
        }
    }
    // lay memu sidebar
    public function getmenu($location)
    {
        if ($location == 'sidebar') {
            $location = "sidebar_location";
        }
        $getmenu = MenuItems::select('admin_menu_items.*', DB::raw('categories.thumb as thumb'))
            ->leftJoin('locationmenus', 'locationmenus.' . $location, '=', 'admin_menu_items.menu')
            ->leftJoin('categories', 'categories.id', 'admin_menu_items.category_id')
            ->where('locationmenus.' . $location, '<>', '0')
            ->where('admin_menu_items.status', 1)
            ->where('admin_menu_items.depth', 0)->get();
        return $getmenu;
    }

    public function arrcategory()
    {
        $arrCategory = DB::table('categories')->select('id', 'name', 'name2', 'slug', 'thumb', 'banner')
            ->where('taxonomy', Category::SAN_PHAM)
            ->where('parent_id', 0)
            ->where('status', 1)
            ->where('show_push_product', '=', 1)
            ->whereNull('deleted_at')
            ->get();
        return $arrCategory;
    }

    //load san pham deal desktop
    public function get_deal(Request $request)
    {
        //lay san pham deal
        $get_deal = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
            'products.onsale as onsale', 'products.price as price', 'products.sold as sold', 'products.quantity as quantity', 'products.slug as slug', 'products.year as year',
            'products.installment as installment', 'products.event as event', 'products.specifications as specifications',
            DB::raw('deals.name_deal'),DB::raw('deals.price_deal') , DB::raw("brands.image as img_brands"),
            DB::raw("tag_events.color_left as event_color_left"), DB::raw("tag_events.color_right as event_color_right"),
            DB::raw("tag_events.icon as event_icon"),DB::raw("tag_events.name as event_name"),DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->leftjoin('tag_events', 'products.event', 'tag_events.id')
            ->leftjoin('deals', 'products.id', 'deals.product_id')
            ->leftjoin('votes','products.id','votes.product_id')
            ->where('products.status',1)->where('deals.status_deal', 1)
            ->where('deals.start_time','<',now())->where('deals.end_time','>',now())
            ->groupby('products.id')
            ->orderBy('deals.end_time', 'asc')
            ->limit(8)->get();
        //lay thoi gian hot sale
        $time_deal = Deals::select(DB::raw('max(end_time) as time_sale'))->where('status_deal', 1)->first('time_sale');
        return response()->json( [
            'deal' => $get_deal,
            'time_deal' => $time_deal->time_sale,
        ]);
    }

    //load san pham danh muc khuyen mai
    public function get_categories_promotion()
    {
        //lay danh muc khuyen mai
        $title = Category::where('status', 1)->where('is_promotion', 1)->limit(10)->get();
        //lay san pham danh muc khuyen mai
        $product_promotion = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
            'products.onsale as onsale', 'products.price as price', 'products.sold as sold', 'products.quantity as quantity', 'products.slug as slug', 'products.year as year',
            'products.installment as installment', 'products.event as event', 'products.specifications as specifications',  DB::raw('deals.name_deal'),DB::raw('deals.price_deal') , DB::raw("brands.image as img_brands"),
            DB::raw("tag_events.color_left as event_color_left"), DB::raw("tag_events.color_right as event_color_right"),
            DB::raw("tag_events.icon as event_icon"),DB::raw("tag_events.name as event_name"),DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->leftjoin('tag_events', 'products.event', 'tag_events.id')
            ->leftjoin('deals', 'products.id', 'deals.product_id')
            ->leftjoin('votes','products.id','votes.product_id')
            ->leftjoin('category_relationships','products.id','category_relationships.product_id')
            ->where('products.status', 1)
            ->where('category_relationships.cat_id', $title->pluck('id')->first())
            ->groupby('products.id')
            ->orderby('products.created_at','desc')
            ->limit(10)->get();
        return response()->json([
            'title' => $title,
            'product_promotion' => $product_promotion,
        ]);
    }

    //load san pham theo danh muc
    public function get_product_categories_loading(Request $request){
        $product_promotion = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
            'products.onsale as onsale', 'products.price as price', 'products.sold as sold', 'products.quantity as quantity', 'products.slug as slug', 'products.year as year',
            'products.installment as installment', 'products.event as event', 'products.specifications as specifications',
            'deals.name_deal','deals.price_deal' , 'brands.image as img_brands','tag_events.color_left as event_color_left', 'tag_events.color_right as event_color_right',
            'tag_events.icon as event_icon','tag_events.name as event_name',DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->leftjoin('tag_events', 'products.event', 'tag_events.id')
            ->leftjoin('deals', 'products.id', 'deals.product_id')
            ->leftjoin('votes','products.id','votes.product_id')
            ->leftjoin('category_relationships','products.id','category_relationships.product_id')
            ->where('products.status', 1)
            ->where('category_relationships.cat_id', $request->id)
            ->groupby('products.id')
            ->orderby('products.created_at','desc')
            ->limit(10)->get();
        return response()->json([
            'product_promotion' => $product_promotion,
        ]);
    }

    //load danh muc con
    public  function get_list_categories_child_loading(Request $request){
        $cat_child = Category::where('status',1)->where('parent_id',$request->id)->get();
        return response()->json($cat_child);
    }

    public function load_brand()
    {
        $list_brand = Brand::where('image','<>',"no-images.jpg")->inRandomOrder()->limit(10)->get();
        return response()->json($list_brand);
    }

    public function categoryBlogs(Request $request)
    {
        $agent = new Agent();
        $active_menu = "post";
        $locale = config('app.locale');
        if ($request->input('tim-kiem')) {
            $search = $request->input('tim-kiem');
        } else {
            $search = '';
        }
        $Sidebars = $this->getmenu('sidebar');
        $getcategoryblog = $this->getcategoryblog();
        $arrCategory = DB::table('categories')->where('status', 1)
            ->where('taxonomy', Category::BAI_VIET)
            ->where('parent_id', 0)
            ->whereNull('deleted_at')
            ->get();
        $blogs = Post::where('status', 1)
            ->where('title', 'LIKE', "%$search%")
            ->paginate(8)->withQueryString();

        $latest_blog = DB::table('posts')->where('status', 1)
            ->whereNull('deleted_at')->limit(5)->get();
        return view('frontend.category-blog', [
            'arrCategory' => $arrCategory,
            'blogs' => $blogs,
            'latest_blog' => $latest_blog,
            'Sidebars' => $Sidebars,
            'getcategoryblog' => $getcategoryblog,
            'locale' => $locale,
            'active_menu' => $active_menu,
        ]);
    }

    public function getcategoryblog()
    {
        $categoryblog = Category::select('*')
            ->where('categories.taxonomy', '=', 1)
            ->where('categories.status', '=', 1)
            ->whereNull('deleted_at')
            ->limit(7)
            ->get();
        return $categoryblog;
    }

    //trang blog chung

    public function categoryBlog(Request $request, $slug)
    {
        $agent = new Agent();
        $ag = "";
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $active_menu = "post";
        $locale = config('app.locale');
        if ($request->input('tim-kiem')) {
            $search = $request->input('tim-kiem');
        } else {
            $search = '';
        }
        $Sidebars = $this->getmenu('sidebar');
        $getcategoryblog = $this->getcategoryblog();
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $blog_category = DB::table('categories')->where('slug', $slug)
            ->where('status', 1)->where('taxonomy', Category::BAI_VIET)
            ->first();
        if (!is_null($blog_category)) {
            $arrCategory = DB::table('categories')->where('status', 1)
                ->where('taxonomy', Category::BAI_VIET)
                ->where('parent_id', 0)
                ->whereNull('deleted_at')
                ->get();
            $category_rela = CategoryRelationship::where('cat_id', $blog_category->id)
                ->whereNull('product_id')->get();
            $arrPost = [];
            foreach ($category_rela as $category) {
                $arrPost[] = $category->post_id;
            }
            $blogs = Post::whereIn('id', $arrPost)
                ->where('status', 1)
                ->where('title', 'LIKE', "%$search%")
                ->paginate(8)->withQueryString();
            $latest_blog = DB::table('posts')->where('status', 1)
                ->whereNull('deleted_at')->limit(5)->get();
            return view('frontend.category-blog', [
                'arrCategory' => $arrCategory,
                'blogs' => $blogs,
                'latest_blog' => $latest_blog,
                'Sidebars' => $Sidebars,
                'getcategoryblog' => $getcategoryblog,
                'locale' => $locale,
                'active_menu' => $active_menu,
                'posts_footer' => $posts_footer,
                'agent' => $ag,
            ]);
        }
        return abort(404);
    }

    // xu ly bai viet duoc tim kiem

    public function singlePost(Request $request, $slug)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $active_menu = "post";
        $locale = config('app.locale');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $post = Post::where('slug', $slug)
            ->where('status', 1)->whereNull('deleted_at')->first();
        if (!is_null($post)) {
            $arrCategory = DB::table('categories')->where('status', 1)
                ->where('taxonomy', Category::BAI_VIET)
                ->where('parent_id', 0)
                ->whereNull('deleted_at')->get();

            $latest_blog = DB::table('posts')->where('status', 1)
                ->whereNull('deleted_at')->limit(5)->get();

            $arrCategoryRela = [];
            foreach ($post->getCategoryRela as $item) {
                $arrCategoryRela[] = $item->cat_id;
            }
            $category_post = DB::table('category_relationships')
                ->whereIn('cat_id', $arrCategoryRela)->get();
            $arrPost = [];
            foreach ($category_post as $category) {
                $arrPost[] = $category->post_id;
            }

            $post_pre = Post::whereIn('id', $arrPost)
                ->where('id', '<>', $post->id)
                ->first();
            $post_next = null;
            if (!is_null($post_pre)) {
                $post_next = Post::whereIn('id', $arrPost)
                    ->whereNotIn('id', [$post->id, $post_pre->id])
                    ->first();
            }

            $count_vote = Vote::where('post_id', $post->id)->whereNull(['deleted_at', 'product_id'])->count();
            $votes = Vote::with('parentID')
                ->where('post_id', $post->id)
                ->where('parent_id', 0)->whereNull(['deleted_at', 'product_id'])->get();
            $Sidebars = $this->getmenu('sidebar');
            $getcategoryblog = $this->getcategoryblog();
            return view('frontend.single-post', [
                'arrCategory' => $arrCategory,
                'post' => $post,
                'latest_blog' => $latest_blog,
                'votes' => $votes,
                'count_vote' => $count_vote,
                'post_pre' => $post_pre,
                'post_next' => $post_next,
                'Sidebars' => $Sidebars,
                'getcategoryblog' => $getcategoryblog,
                'locale' => $locale,
                'active_menu' => $active_menu,
                'posts_footer' => $posts_footer,
                'agent' => $ag,
            ]);
        }
        return abort(404);
    }

    //trang chi tiet bai viet

    public function product_cat(Request $request)
    {
        ///////////////Tham so dau vao//////////////////]
        $requestall = $request->all();
        $price = $brand = $filter_price = "";
        $active_menu = "product";
        $locale = config('app.locale');
        $Sidebars = $this->getmenu('sidebar');
        $cat = Category::where('slug', $request->slug)->first();
        $sliders = "";
        $list_cat_child = array();
        $list_cat_childs = $attributes = "";
        if (!empty($cat)) {
            $list_cat1 = Category::where('status',1)->where('parent_id',$cat->id)->pluck('id');
            $list_cat2 = Category::where('status',1)->whereIn('parent_id',$list_cat1->all())->pluck('id');
            $list_cat3 = Category::where('status',1)->whereIn('parent_id',$list_cat2->all())->pluck('id');
            $arr[] = array_merge($list_cat1->all(),$list_cat2->all(),$list_cat3->all());
            array_push($arr[0], $cat->id);
            $list_cat_child = $arr[0];
            $list_cat_childs = Category::whereIn('id', $list_cat1->all())->where('show_push_product', 1)->get();
            //slider banner header
            $sliders = json_decode($cat->banner);
            //neu co danh muc thi loc theo danh muc
            $categories = Category::where('taxonomy', Category::SAN_PHAM)->where('parent_id', $cat->id)->where('status', 1)->get();
            $attributes = Categoryproperty::select('categoryproperties.*', 'categories.slug as slug')
                ->leftjoin('categoryproperties_manages', 'categoryproperties.id', '=', 'categoryproperties_manages.categoryproperties_id')
                ->leftjoin('categories', 'categories.id', 'categoryproperties_manages.category_id')
                ->where('categories.slug', $request->slug)
                ->get();
            $filter_all = [];
            if ($this->is_multi($requestall)) {
                $requestall = [];
                foreach ($request->all() as $key => $value) {
                    $requestall[$key] = implode(",", $value);
                }
            }
            foreach ($requestall as $key => $value) {
                $explode = explode(',', $value);
                if (!empty($explode)) {
                    $value = $explode;
                }
                $filter_all = array_merge($filter_all, $value);
            }
            $origin_url = $request->url();
            foreach ($attributes as $key_attr => $attr) {
                $count_attr = 0;
                $count_attr_active = 0;
                $detailproperties = Detailproperties::where('categoryproperties_id', $attr->id)->get();
                foreach ($detailproperties as $key_attr_dt => $attr_detail) {
                    $Propertyproducts = Propertyproducts::select('propertyproducts.*', 'detailproperties.ma as ma')
                        ->leftjoin('detailproperties', 'detailproperties.id', 'propertyproducts.detailproperties_id')
                        ->leftjoin('products', 'products.id', 'propertyproducts.products_id')
                        ->where('propertyproducts.detailproperties_id', $attr_detail->id)
                        ->where('products.deleted_at', null)
                        ->count();
                    $attr_detail->setAttribute('count_product', $Propertyproducts);
                    $count_attr = $count_attr + $Propertyproducts;
                    $value_url = $requestall;
                    foreach ($value_url as $key => $value) {
                        $explode = explode(',', $value);
                        if (!empty($explode)) {
                            $value_url[$key] = $explode;
                        }
                    }
                    $value_url2 = $value_url;
                    if (in_array($attr_detail->ma, $filter_all)) {
                        $attr_detail->setAttribute('attr_checked', 1);
                        $count_attr_active = $count_attr_active + 1;
                        foreach ($value_url as $key => $subArr) {
                            foreach ($subArr as $key2 => $value2) {
                                if (($value_url[$key][$key2]) == $attr_detail->ma) {
                                    unset($value_url[$key][$key2]);
                                }
                            }
                            if ($value_url[$key] == []) {
                                unset($value_url[$key]);
                            }
                        }
                        foreach ($value_url as $key => $value) {
                            $implode = implode(',', $value);
                            if (!empty($implode)) {
                                $value_url[$key] = $implode;
                            }
                        }
                        $this_attr = $attr->ma;
                        $this_attr_name = $attr->name;
                        $this_attr_detail = $attr_detail->ma;
                        $this_attr_detail_name = $attr_detail->name;
                        $url = $origin_url . '?' . http_build_query($value_url);
                        $attr_detail->setAttribute('fullurl', trim($url, '?'));
                        $attr->setAttribute('attr_name_code', $this_attr);
                        $attr_detail->setAttribute('this_attr_code', $this_attr);
                        $attr_detail->setAttribute('this_attr_detail_code', $this_attr_detail);
                        $attr_detail->setAttribute('this_attr_name', $this_attr_name);
                        $attr_detail->setAttribute('this_attr_detail_name', $this_attr_detail_name);
                    } else {
                        $attr_detail->setAttribute('attr_checked', 0);
                        foreach ($value_url2 as $key => $subArr) {
                            foreach ($subArr as $key2 => $value2) {
                                if ($key == $attr->ma) {
                                    array_push($subArr, $attr_detail->ma);
                                    $value_url2[$key] = $subArr;
                                } else {
                                    $value_url2[$attr->ma] = $attr_detail->ma;
                                }
                            }
                            if ($value_url2[$key] == []) {
                                unset($value_url2[$key]);
                            }
                        }
                        if (($value_url2) == []) {
                            $value_url2[$attr->ma] = $attr_detail->ma;
                        }
                        foreach ($value_url2 as $key => $value) {
                            if (is_array($value)) {
                                $implode = implode(',', $value);
                                if (!empty($implode)) {
                                    $value_url2[$key] = $implode;
                                }
                            } else {
                                $value_url2[$key] = $value;
                            }
                        }
                        $this_attr = $attr->ma;
                        $this_attr_name = $attr->name;
                        $this_attr_detail = $attr_detail->ma;
                        $this_attr_detail_name = $attr_detail->name;
                        $url = $origin_url . '?' . http_build_query($value_url2);
                        $attr_detail->setAttribute('fullurl', trim($url, '?'));
                        $attr->setAttribute('attr_name_code', $this_attr);
                        $attr_detail->setAttribute('this_attr_code', $this_attr);
                        $attr_detail->setAttribute('this_attr_detail_code', $this_attr_detail);
                        $attr_detail->setAttribute('this_attr_name', $this_attr_name);
                        $attr_detail->setAttribute('this_attr_detail_name', $this_attr_detail_name);
                    }
                }
                $attr->setAttribute('detailproperty', $detailproperties);
                $attr->setAttribute('count_attr', $count_attr);
                $attr->setAttribute('count_attr_active', $count_attr_active);
            }
            $property = $requestall;
            if (!empty($request->p)) {
                $price = $request->p;
                $filter = explode(';', $request->p);
                $filter_price = "từ " . number_format($filter[0], 0, ',', '.') . " đến " . number_format($filter[1], 0, ',', '.');
            }
            if (!empty($request->brand)) {
                $brand = $request->brand;
            }
            $orderby = "DESC";
            $order_name = "products.created_at";
            if (!empty($request->order)) {
                if ($request->order == "gia_cao_den_thap") {
                    $order_name = "NULLIF(products.price_onsale, 0), products.price";
                    $orderby = "DESC";
                }
                if ($request->order == "gia_thap_den_cao") {
                    $order_name = "NULLIF(products.price_onsale, 0), products.price";
                    $orderby = "ASC";
                }
            }
            $products = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
                    'products.onsale as onsale', 'products.price as price', 'products.sold as sold', 'products.quantity as quantity', 'products.slug as slug', 'products.year as year',
                    'products.installment as installment', 'products.event as event', 'products.specifications as specifications', 'detailproperties.ma as matt',
                    'categories.slug as url','brands.image as brand_img','tag_events.icon as event_icon','tag_events.name as event_name',
                    'tag_events.color_left as event_color_left', 'tag_events.color_right as event_color_right',DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
                ->leftjoin('category_relationships', 'category_relationships.product_id', 'products.id')
                ->leftjoin('categories', 'categories.id', 'category_relationships.cat_id')
                ->leftjoin('propertyproducts', 'propertyproducts.products_id', 'products.id')
                ->leftJoin('detailproperties', 'detailproperties.id', 'propertyproducts.detailproperties_id')
                ->leftJoin('brands', 'brands.id', 'products.brand')
                ->leftJoin('tag_events', 'tag_events.id', 'products.event')
                ->leftjoin('votes','products.id','votes.product_id')
                ->whereIn('categories.id', $list_cat_child)
                ->where(function ($query) use ($property) {
                    foreach ($property as $key => $value) {
                        if ($key == 'p' || $key == 'brand' || $key == 'order' || $key == 'page') {
                            unset($property[$key]);
                        }
                    }
                    $properties = [];
                    foreach ($property as $value) {
                        $explode = explode(',', $value);
                        if (!empty($explode)) {
                            $value = $explode;
                        }
                        $properties = array_merge($property, $value);
                    }
                    if ($properties != []) {
                        $query->whereIn('detailproperties.ma', $properties);
                    } else {
                        $query->where('products.status', 1);
                    }
                })
                ->where(function ($query) use ($price) {
                    if ($price != "") {
                        $p = explode(';', $price);
                        $min_price = $p[0];
                        $max_price = $p[1];
                        $query->whereBetween('products.price_onsale', [$min_price, $max_price]);
                    } else {
                        $query->where('products.status', 1);
                    }
                })
                ->where(function ($query) use ($brand) {
                    if ($brand != "") {
                        $query->where('brands.name', trim($brand));
                    } else {
                        $query->where('products.status', 1);
                    }
                })
                ->where('products.status', 1)
                ->groupBy('products.id')
                ->orderByRaw(DB::raw("coalesce($order_name) $orderby"))
                ->paginate(20)->withQueryString();
        }
        else {
            // Neu khong co danh muc thi lay san pham moi
            $categories = Category::where('taxonomy', Category::SAN_PHAM)->where('parent_id', 0)->where('status', 1)->get();
            if (!empty($request->p)) {
                $price = $request->p;
                $filter = explode(';', $request->p);
                $filter_price = "từ " . number_format($filter[0], 0, ',', '.') . " đến " . number_format($filter[1], 0, ',', '.');
            }
            $orderby = "DESC";
            $order_name = "products.created_at";
            if (!empty($request->order)) {
                if ($request->order == "gia_cao_den_thap") {
                    $order_name = "NULLIF(products.price_onsale, 0), products.price";
                    $orderby = "DESC";
                }
                if ($request->order == "gia_thap_den_cao") {
                    $order_name = "NULLIF(products.price_onsale, 0), products.price";
                    $orderby = "ASC";
                }
            }
            $promotion = $request->promotion;
            $search = $request->search;
            $products = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
                'products.onsale as onsale', 'products.price as price', 'products.sold as sold', 'products.quantity as quantity', 'products.slug as slug', 'products.year as year',
                'products.installment as installment', 'products.event as event', 'products.specifications as specifications', 'detailproperties.ma as matt',
                'categories.slug as url','brands.image as brand_img','tag_events.icon as event_icon','tag_events.name as event_name',
                'tag_events.color_left as event_color_left', 'tag_events.color_right as event_color_right',DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
                ->leftjoin('category_relationships', 'category_relationships.product_id', 'products.id')
                ->leftjoin('categories', 'categories.id', 'category_relationships.cat_id')
                ->leftjoin('propertyproducts', 'propertyproducts.products_id', 'products.id')
                ->leftJoin('detailproperties', 'detailproperties.id', 'propertyproducts.detailproperties_id')
                ->leftJoin('brands', 'brands.id', 'products.brand')
                ->leftJoin('tag_events', 'tag_events.id', 'products.event')
                ->leftjoin('votes','products.id','votes.product_id')
                ->where('products.status', 1)
                ->where(function ($query) use ($price) {
                    if ($price != "") {
                        $p = explode(';', $price);
                        $min_price = $p[0];
                        $max_price = $p[1];
                        $query->whereBetween('products.price_onsale', [$min_price, $max_price]);
                    } else {
                        $query->where('products.status', 1);
                    }
                })
                ->where(function ($query) use ($promotion) {
                    if ($promotion) {
                        if($promotion == "deal"){
                            $deal  = Deals::where('status_deal',1)->where('start_time','<',now())->where('end_time','>',now())->get();
                            $list_deals_id = array();
                            foreach ($deal as $value){
                                $list_deals_id[] = $value->product_id;
                            }
                            $query->whereIn('products.id',$list_deals_id);
                        }
                        else{
                            if ($promotion == "san-pham-hot") {
                                $promotion = 'products.is_hot';
                            }
                            if ($promotion == "san-pham-moi") {
                                $promotion = 'products.is_new';
                            }
                            if ($promotion == "san-pham-khuyen-mai") {
                                $promotion = 'products.is_promotion';
                            }
                            $query->where($promotion, 1);
                        }
                    }
                    else {
                        $query->where('products.status', 1);
                    }
                })
                ->where(function ($query) use ($search) {
                    if ($search) {
                        $query->where('products.name', 'like', '%' . $search . '%');
                    } else {
                        $query->where('products.status', 1);
                    }
                })
                ->groupBy('products.id')
                ->orderByRaw(DB::raw("coalesce($order_name) $orderby"))
                ->paginate(20)->withQueryString();
        }
        $cat_parent = Category::where('taxonomy', Category::SAN_PHAM)->where('parent_id', 0)->where('status', 1)->get();
        //////////////Tra ve//////////////////
        $agent = new Agent();
        dd($agent->isMobile());
        if ($agent->isMobile()) {
            $bard = Brand::where(function ($query) use ($list_cat_child) {
                $products_list_brand = Products::where('status', 1)
                    ->leftJoin('category_relationships', 'products.id', 'category_relationships.product_id')
                    ->whereIn('category_relationships.cat_id', $list_cat_child)
                    ->groupBy('products.brand')
                    ->get();
                $list = [];
                foreach ($products_list_brand as $key => $item) {
                    array_push($list, $item->brand);
                }
                $query->whereIn('id', $list);
            })->get();
            return view('frontend.mobile.productmobile',
                compact('sliders', 'products', 'categories', 'attributes', 'cat', 'filter_price', 'list_cat_childs', 'bard'));
        }
        else {
            return view('frontend.product', compact('products', 'categories',
                'cat', 'Sidebars', 'locale', 'active_menu', 'cat_parent', 'attributes'));
        }
    }

    public function is_multi($requestall)
    {

        $rv = array_filter($requestall, 'is_array');

        if (count($rv) > 0) return true;

        return false;
    }

    public function commentPost(Request $request)
    {
        $post = Post::find($request->comment_post);
        if (!is_null($post)) {
            $input = [
                'level' => 0,
                'comment' => $request->comment,
                'post_id' => $request->comment_post,
                'product_id' => null,
                'name_user' => $request->author,
                'user_id' => null,
                'email' => $request->email,
                'parent_id' => $request->comment_parent
            ];
            Vote::create($input);
            return redirect()->route('singlePost', ['slug' => $post->slug]);
        }
    }

    // lay comment
    public function getFormVote(Request $request)
    {
        $locale = config('app.locale');
        if ($request->type == 'reply') {
            $view = view('frontend.form_reply', [
                'post_id' => $request->post_id,
                'parent_id' => $request->vote_id,
                'type' => 'reply',
                'locale' => $locale,

            ])->render();
        } else {
            $view = view('frontend.form_reply', [
                'post_id' => $request->post_id,
                'parent_id' => $request->vote_id,
                'locale' => $locale,
            ])->render();
        }
        return response()->json($view);
    }

    //xu ly lay danh gia vote
    public function autotypeahead(Request $request)
    {
        $agent = new Agent();
        $isMobile = "";
        if ($agent->isPhone()) {
            $isMobile = "phone";
        }
        if ($isMobile) {
            if ($request->data) {
                $data = Products::where('name', 'like', '%' . $request->data . '%')->limit(10)->get();
                return response()->json(['result_search' => $data]);
            } else {
                return response()->json();
            }
        } else {
            $locale = config('app.locale');
            $view = '';
            if ($request->data != null) {
                $data = Products::where('name', 'like', '%' . $request->data . '%')->limit(15)->get();
                if ($data != null)
                    $view = view('frontend.search', [
                        'data' => $data,
                        'locale' => $locale,
                    ])->render();
            }
            return response()->json(['html' => $view]);
        }

    }

    //xu ly nhap thanh tim kiem ra san pham
    public function contact()
    {
        $agent = new Agent();
        $ag = "";
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $active_menu = "contact";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $locale = config('app.locale');
        $Sidebars = $this->getmenu('sidebar');
        return view('frontend.contact', compact('Sidebars', 'locale', 'active_menu', 'posts_footer'))->with('agent', $ag);
    }

    //lien he
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
        return redirect()->back();
    }
    public function recruit()
    {
        $agent = new Agent();
        $ag = "";
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $list_location = Recruit::where('status', 1)->groupBy('location')->get();
        $list_vacancies = Recruit::where('status', 1)->orderBy('created_at', 'ASC')->get();
        $active_menu = "contact";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $Sidebars = $this->getmenu('sidebar');
        return view('frontend.recruit', compact('Sidebars', 'active_menu', 'posts_footer', 'list_location', 'list_vacancies'))->with('agent', $ag);
    }

    public function recruit_register(Request $request)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $list_location = Recruit::where('status', 1)->groupBy('location')->get();
        $list_vacancies = Recruit::where('status', 1)->orderBy('created_at', 'ASC')->get();
        $active_menu = "contact";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $Sidebars = $this->getmenu('sidebar');

        if ($request->fileupload == null) {
            $request->fileupload = "";
        }

        $recruit_register = [
            'first_name' => $request->first_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'vitriungtuyen' => $request->vitriungtuyen,
            'parent_id' => $request->parent_id,
            'fileupload' => $request->fileupload,
            'status' => 0,
        ];
        try {
            DB::beginTransaction();
            Recruit_register::create($recruit_register);
            DB::commit();
            return redirect()->route('recruit', [
                'Sidebars' => $Sidebars,
                'active_menu' => $active_menu,
                'posts_footer' => $posts_footer,
                'list_location' => $list_location,
                'list_vacancies' => $list_vacancies,
                'agent' => $ag,
            ])->with('error', 'Ứng tuyển thành công!');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('recruit', [
                'Sidebars' => $Sidebars,
                // 'Menus' => $Menus,
                // 'Sub_menus' => $Sub_menus,
                'active_menu' => $active_menu,
                'posts_footer' => $posts_footer,
                'list_location' => $list_location,
                'list_vacancies' => $list_vacancies,
                'agent' => $ag,
            ])->with('error', 'Đăng kí thất bại!');
        }
    }

    public function about_us()
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        $active_menu = "about_us";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $locale = config('app.locale');
        $Sidebars = $this->getmenu('sidebar');
        return view('frontend.page.about-us', compact('Sidebars', 'locale', 'active_menu', 'posts_footer'))->with('agent', $ag);
    }

    public function menucontent(Request $request)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $Sidebars = $this->getmenu('sidebar');
            $view2 = view('frontend.contentmenumobile', ['Sidebars' => $Sidebars])->render();
            return response()->json($view2);
        } else {
            if($request->id){
                $arr = array();
                $data2 = admin_menu_items::where('status',1)->where('parent',$request->id)->pluck('id');
                $data3 = admin_menu_items::where('status',1)->whereIn('parent',$data2->all())->pluck('id');
                $data4 = admin_menu_items::where('status',1)->whereIn('parent',$data3->all())->pluck('id');
                $arr[] = array_merge( $data2->all(),$data3->all(),$data4->all());
                $list_menu = admin_menu_items::select('id', 'parent', 'label','link','depth')->whereIn('id',$arr[0])->get();
                return response()->json($list_menu);
            }
        }
    }

    //lay san pham moi mobile
    public function get_new_mobile(Request $request)
    {
        $get_new_mobile = Products::select('products.*', DB::raw("brands.image as img_brands"))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->where('status', 1)->where('is_new', 1)->inRandomOrder()->limit(6)->get();
        return response()->json([
            'data_product_mobile' => $get_new_mobile
        ]);
    }

    // lay san pham hot mobile
    public function get_hot_product(Request $request)
    {
        $get_new_mobile = Products::select('products.*', DB::raw("brands.image as img_brands"))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->where('status', 1)->where('is_hot', 1)->inRandomOrder()->limit(6)->get();
        return response()->json([
            'data_product_mobile' => $get_new_mobile
        ]);
    }

    // lay san pham khuyen mai
    public function get_promotion_mobile(Request $request)
    {
        $get_promotion_mobile = Products::select('products.*', DB::raw("brands.image as img_brands"))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->where('status', 1)->where('is_promotion', 1)->inRandomOrder()->limit(6)->get();
        return response()->json([
            'data_product_mobile' => $get_promotion_mobile
        ]);
    }

    // lay san danh muc khuyen mai
    public function get_category_promotion_mobile(Request $request)
    {
        if($request->category_id){
            $slug = Category::find($request->category_id);
            $get_category_promotion_mobile = Products::select('products.*', DB::raw("brands.image as img_brands"))
                ->leftjoin('brands', 'products.brand', 'brands.id')
                ->leftjoin('category_relationships', 'category_relationships.product_id', 'products.id')
                ->leftjoin('categories', 'category_relationships.cat_id', 'categories.id')
                ->where('categories.id',$request->category_id)
                ->where('products.status', 1)->inRandomOrder()->limit(6)->get();
            return response()->json([
                'data_product_mobile' => $get_category_promotion_mobile,
                'url_category' => $slug->slug
            ]);
        }
    }

    //lay san pham loading mobile
    public function get_product_mobile(Request $request)
    {
        if (!is_null($request->id)) {
            $cat_parent = Category::find($request->id);
            $list_cat_child = [];
            foreach ($cat_parent->cat_child as $cat_child) {
                $list_cat_child[] = $cat_child->id;
            }
            $list_cat_childs = Category::whereIn('id', $list_cat_child)->where('show_push_product', 1)->get();
            $Products = Products::select('products.*', DB::raw("brands.image as img_brands"))
                ->leftjoin('category_relationships', 'category_relationships.product_id', 'products.id')
                ->leftjoin('brands', 'products.brand', 'brands.id')
                ->where('category_relationships.cat_id', $request->id)
                ->where('products.status', 1)
                ->groupby('products.id')
                ->orderby('products.created_at', 'desc')
                ->limit(6)->get();
            foreach ($Products as $value) {
                $value->setAttribute('count_vote', $value->count_vote());
                $value->setAttribute('list_wish', explode(' ', Cookie::get('list_wish')));
            }
        }
        return response()->json([
            'list_cat_childs' => $list_cat_childs,
            'data_product_mobile' => $Products,
            'category_slug' => $cat_parent->slug,
        ]);
    }

    //chon san pham danh muc con mobile
    public function get_product_category_child_mobile(Request $request)
    {
        if (!is_null($request->id)) {
            $cat_parent = Category::find($request->id);
            $Products = Products::select('products.*', DB::raw("brands.image as img_brands"))
                ->leftjoin('category_relationships', 'category_relationships.product_id', 'products.id')
                ->leftjoin('brands', 'products.brand', 'brands.id')
                ->where('category_relationships.cat_id', $request->id)
                ->where('products.status', 1)
                ->groupby('products.id')
                ->orderby('products.created_at', 'desc')
                ->limit(6)->get();
            foreach ($Products as $value) {
                $value->setAttribute('count_vote', $value->count_vote());
                $value->setAttribute('list_wish', explode(' ', Cookie::get('list_wish')));
            }
        }
        return response()->json([
            'data_product_mobile' => $Products,
            'category_slug' => $cat_parent->slug,
        ]);
    }

    // lay menu ban mobile
    public function get_menu_mobile()
    {
        $get_parent = admin_menu_items::select('admin_menu_items.id','admin_menu_items.label',DB::raw("categories.thumb as img_cat"))
            ->leftJoin('locationmenus', 'locationmenus.sidebar_location', 'admin_menu_items.menu')
            ->leftjoin('categories', 'categories.id', 'admin_menu_items.category_id')
            ->where('locationmenus.sidebar_location', '<>', '0')
            ->where('admin_menu_items.depth', 0)
            ->where('admin_menu_items.status', 1)
            ->get();
        $id_parent_first = $get_parent->pluck('id')->first();
        $child_2 = admin_menu_items::where('status',1)->where('parent',$id_parent_first)->pluck('id');
        $child_3 = admin_menu_items::where('status',1)->whereIn('parent',$child_2->all())->pluck('id');
        $arr[] = array_merge($child_2->all(),$child_3->all());
        array_push($arr[0],$id_parent_first);
        $get_child = MenuItems::select('admin_menu_items.id', 'admin_menu_items.label','admin_menu_items.link','admin_menu_items.parent',
            'admin_menu_items.img_caption','admin_menu_items.depth','admin_menu_items.filter_by',
            DB::raw("brands.image as img_brand"), DB::raw("detailproperties.image as img_property"),DB::raw("categories.thumb as img_cat"))
            ->leftjoin('brands', 'brands.name', 'admin_menu_items.filter_value')
            ->leftjoin('detailproperties', 'detailproperties.ma', 'admin_menu_items.filter_value')
            ->leftjoin('categories', 'categories.id', 'admin_menu_items.category_id')
            ->whereIn('admin_menu_items.id', $arr[0])
            ->orderby('admin_menu_items.depth','asc')
            ->get();
        return response()->json([
            'menu_mobile' => $get_parent,
            'child' => $get_child,
        ]);
    }

    // lay menu con khi chon menu cha mobile
    public function get_menu_child(Request $request)
    {
        $child_2 = admin_menu_items::where('status',1)->where('parent',$request->id)->pluck('id');
        $child_3 = admin_menu_items::where('status',1)->whereIn('parent',$child_2->all())->pluck('id');
        $arr[] = array_merge($child_2->all(),$child_3->all());
        array_push($arr[0],$request->id);
        $get_child = MenuItems::select('admin_menu_items.id', 'admin_menu_items.label','admin_menu_items.link','admin_menu_items.parent',
            'admin_menu_items.img_caption','admin_menu_items.depth','admin_menu_items.filter_by',
            DB::raw("brands.image as img_brand"), DB::raw("detailproperties.image as img_property"),DB::raw("categories.thumb as img_cat"))
            ->leftjoin('brands', 'brands.name', 'admin_menu_items.filter_value')
            ->leftjoin('detailproperties', 'detailproperties.ma', 'admin_menu_items.filter_value')
            ->leftjoin('categories', 'categories.id', 'admin_menu_items.category_id')
            ->whereIn('admin_menu_items.id', $arr[0])
            ->orderby('admin_menu_items.depth','asc')
            ->get();
        return response()->json([
            'child' => $get_child,
        ]);
    }
}
