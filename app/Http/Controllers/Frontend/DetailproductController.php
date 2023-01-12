<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute_product;
use App\Models\CategoryRelationship;
use App\Models\Locationmenu;
use App\Models\Products;
use App\Models\Vote;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use Illuminate\Support\Facades\DB;


class DetailproductController extends Controller
{

    public function index($slug)
    {
        try{
            $active_menu = "product";
            $Sidebars           = $this->getmenu('sidebar');
            $getcategoryblog    = $this->getcategoryblog();
            $product            = Products::select('products.*', DB::raw("brands.image as img_brands"),
            DB::raw('count(votes.level) as votes_count'),DB::raw('sum(votes.level) as votes_sum'))
            ->leftjoin('brands', 'products.brand', 'brands.id')
            ->leftjoin('votes','products.id','votes.product_id')
            ->where('products.status',1)
            ->where('slug',$slug)->first();
            $imgs        = json_decode($product->image);
            $locale             = config('app.locale');
            $posts = Post::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
            Session::push('list_watched', $product->id);
            $comments = Vote::where('product_id',$product->id)->where('status', 1)->orderby('created_at','desc')->orderby('level', 'asc')->paginate(10);
            $agent = new Agent();
            if($agent->isPhone()){
                return view('frontend.mobile.detailproductmobile',[
                    'product'        => $product,
                    'imgs'           => $imgs,
                    'locale'         => $locale,
                    'comments'       => $comments,
                ]);
            }
            else{
                return view('frontend.detailproduct',[
                    'Sidebars'        => $Sidebars,
                    'product'         => $product,
                    'imgs'            => $imgs,
                    'getcategoryblog' => $getcategoryblog,
                    'locale'          => $locale,
                    'posts'           => $posts,
                    'active_menu'     => $active_menu,
                ]);
            }
        }
        catch(\Exception $exception){
            \abort(404);
        }
    }
    public function  get_review_more(Request $request){
        $number_page = $request->page;
        $last_page ="";
        $comments = Vote::where('product_id',$request->product_id)->where('status', 1)->orderby('created_at','desc')->orderby('level', 'asc')->paginate(10);
        if($number_page == $comments->lastPage()){
            $last_page = 1;
        }
        return response()->json([
            'comments' => $comments,
            'last_page' => $last_page
        ]);
    }
    //xu ly lay danh muc cho blog
    public function getcategoryblog(){
        $categoryblog = Category::select('*')
        ->where('taxonomy','=', 1)
        ->where('status','=',1)
        ->limit(7)
        ->get();
        return $categoryblog;
    }
    // xu ly lay menu
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
    // xy ly lay comment chi tiet san pham
    public function commentProduct(Request $request){
        $data = $request->all();
        $product = Products::find($data['id']);
        if (!empty($product)){
            $input = [
                'level'     => $data['rating'],
                'comment'   => $data['comment'],
                'post_id'   => null,
                'product_id'=> $data['id'],
                'name_user' => $data['author'],
                'user_id'   => null,
                'email'     => $data['email'],
                'parent_id' => 0,
                'status'    => 0
            ];
            $item = Vote::create($input);
            $agent = new Agent();
            if($agent->isPhone()){
                return \json_encode(array('success'=>true));
            }
            else{
                $view = \view('frontend.content-comment-ajax', \compact('item'))->render();
                return \response()->json($view);
            }

        }
    }
    //lay san pham da xem mobile ajax
    public  function get_product_watched(Request $request){
        $get_cookie = Session::get('list_watched');
        $list_id_watched = explode(' ', $get_cookie);
        if(!in_array($request->id, $list_id_watched)){
            $list_id_watched[] = $id;
        }
        $list_watched = \implode(' ', $list_id_watched);
        Session::put('list_watched', $list_watched);
        $product_watched = Products::select('products.*', DB::raw("brands.image as img_brands"))
            ->leftjoin('brands','products.brand','brands.id')
            ->whereIn('products.id', $list_id_watched)->where('products.status', 1)->inRandomOrder()->limit(6)->get();
        foreach($product_watched as $value){
            $value->setAttribute('count_vote',$value->count_vote());
            $value->setAttribute('list_wish',explode(' ', Cookie::get('list_wish')));
        }
        return response()->json([
            'data_product_mobile' => $product_watched,
        ]);
    }

    //cap nhat luot xem
    public  function product_views(Request $request){
        $product = Products::find($request->id);
        $data = [
            'view' => $request->view,
        ];
        $product->update($data);
        return response()->json(['success' => true]);
    }

    //load san pham lien quan
    public function get_related_products(Request $request){
        if($request->id){
            $categories_related_products = CategoryRelationship::where('product_id', $request->id)->get()->pluck('cat_id');
            $product = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
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
                ->whereIn('category_relationships.cat_id', $categories_related_products->all())
                ->groupby('products.id')
                ->orderby('products.created_at','desc')
                ->limit(10)
                ->get();
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }
        else{
            return response()->json();
        }
    }

    //load san pham da xem
    public function get_watched_products(){
        $list_id_watched_products = Session::get('list_watched');
        if($list_id_watched_products){
            $product = Products::select('products.id as id','products.ma as ma', 'products.name as name', 'products.thumb as thumb', 'products.price_onsale as price_onsale',
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
                ->whereIn('products.id', $list_id_watched_products)
                ->groupby('products.id')
                ->orderby('products.created_at','desc')
                ->limit(10)
                ->get();
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }
        else{
            return response()->json();
        }
    }
}
