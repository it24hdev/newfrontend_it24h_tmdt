<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute_product;
use App\Models\Locationmenu;
use App\Models\Products;
use App\Models\Vote;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class DetailproductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            \session(['page_active' => 'product']);
            return $next($request);
        });
    }
    public function index($slug)
    {

        try{
        $Sidebars           = $this->getmenu('sidebar');
        $Menus              = $this->getmenu('menu');
        $getcategoryblog    = $this->getcategoryblog();
        $product           = Products::where('slug','=',$slug)->first();
        $locale             = config('app.locale');
        $posts = Post::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        // $attrs              = \json_decode($product->attr);
        // if(empty($attrs)){$attrs = [];}
        // $colors = Attribute_product::where('attr', 'color')->whereIn('id', $attrs)->orderBy('name', 'ASC')->get();
        // $sizes  = Attribute_product::where('attr', 'size')->whereIn('id', $attrs)->get();

        $products_id= array();
        foreach($product->category as $k){
            foreach($k->product as $pro){
                $products_id[]= $pro->id;
            }
        }
        if(empty($products_id)){
            $product_related = Products::where('status', 1)->limit(10)->get();
        }else{
            $product_related = Products::whereIn('id', $products_id)->where('status', 1)->limit(10)->get();
        }

        $imgs        = json_decode($product->image);
        $property   = $this->xulychuoi_thongsosanpham($product->property);

        /* XỬ LÝ LƯU SP ĐÃ XEM */
        $id = $product->id;
        $get_cookie = Session::get('list_watched');
        $list_id_watched = explode(' ', $get_cookie);
        if(!in_array($id, $list_id_watched)){
            $list_id_watched[] = $id;
        }
        $list_watched = \implode(' ', $list_id_watched);
        Session::put('list_watched', $list_watched);
        $product_watched = Products::whereIn('id', $list_id_watched)->where('status', 1)->inRandomOrder()->limit(10)->get();
        return view('frontend.detailproduct',[
            'Sidebars'        => $Sidebars,
            'Menus'           => $Menus,
            'product'        => $product,
            'imgs'             => $imgs,
            'property'        => $property,
            'product_related' => $product_related,
            'getcategoryblog' => $getcategoryblog,
            'locale'          => $locale,
            'posts' => $posts,
            'product_watched' => $product_watched,
        ]);
        }
        catch(\Exception $exception){
            \abort(404);
        }
    }

    public function xulychuoi_thongsosanpham($String){

        //loaibo space va enter
        if($String !=null){
        $String =  preg_replace("/[\n\r]/", "", $String);
        //loai bo ky tu ; cuoi cung
        if(mb_substr($String,-1) == ";")
        $String = mb_substr($String, 0,-1);
        //tach chuoi chan le
        $key    = array_chunk(preg_split('/(:|;)/', $String), 20);
        foreach ($key as $value) {
            foreach($value as $k=> $v){if($k%2==0){$arr1[] = $v;}
            }
        }
        foreach ($key as $value) {
            foreach($value as $k=> $v){if($k%2!=0){$arr2[] = $v;}
            }
        }
        //ghep chuoi
        $property   = array_combine($arr1 , $arr2);

        return $property;
        }
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
                'parent_id' => 0
            ];
            $item = Vote::create($input);
            $view = \view('frontend.content-comment-ajax', \compact('item'))->render();
            return \response()->json($view);
        }
    }

}
