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
use Jenssegers\Agent\Agent;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;


class DetailproductController extends Controller
{

    public function index($slug)
    {

        $agent = new Agent();
        $ag = "";

        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        try{
            $active_menu = "product";
            $Sidebars           = $this->getmenu('sidebar');
            $getcategoryblog    = $this->getcategoryblog();
            $product           = Products::where('slug',$slug)->first();
            $imgs        = json_decode($product->image);
            $property   = $this->xulychuoi_thongsosanpham($product->property);
            $locale             = config('app.locale');
            $posts = Post::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
            $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
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
            if($agent->isMobile()){
                return view('frontend.mobile.detailproductmobile',[
                    'Sidebars'        => $Sidebars,
                    'product'        => $product,
                    'imgs'             => $imgs,
                    'property'        => $property,
                    'product_related' => $product_related,
                    'getcategoryblog' => $getcategoryblog,
                    'locale'          => $locale,
                    'posts' => $posts,
                    'product_watched' => $product_watched,
                    'active_menu' => $active_menu,
                    'posts_footer' => $posts_footer,
                    'agent' => $ag,
                ]);
            }
            else{
                return view('frontend.detailproduct',[
                    'Sidebars'        => $Sidebars,
                    'product'        => $product,
                    'imgs'             => $imgs,
                    'property'        => $property,
                    'product_related' => $product_related,
                    'getcategoryblog' => $getcategoryblog,
                    'locale'          => $locale,
                    'posts' => $posts,
                    'product_watched' => $product_watched,
                    'active_menu' => $active_menu,
                    'posts_footer' => $posts_footer,
                    'agent' => $ag,
                ]);
            }
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
       if($location == 'sidebar')  {$location = "sidebar_location"; }
        if($location == 'menu')  {$location = "menu_location"; }
        if($location == 'footer')  {$location = "footer_location"; }
        $getmenu = MenuItems::select('admin_menu_items.*')
        ->leftJoin('locationmenus', 'locationmenus.'.$location, '=', 'admin_menu_items.menu')
        ->where('locationmenus.'.$location,'<>','0')
        ->where('locationmenus.'.$location,'<>',null)
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
