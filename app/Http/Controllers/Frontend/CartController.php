<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\OrderMail;
use App\Mail\ThongBaoCoDonHangMoi;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Locationmenu;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Post;
use App\Models\Products;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function getmenu($location){
        if($location == 'sidebar')  {$taxonomy = 0; }
        if($location == 'menu')  {$taxonomy = 3; }
        if($location == 'submenu')  {$taxonomy = 3; $location = 'menu';}
        $getmenu = Locationmenu::select('locationmenus.*','categories.*')
        ->leftJoin('categories', 'categories.id', '=', 'locationmenus.category_id')
        ->where('categories.taxonomy','=',$taxonomy)
        ->where('categories.status','=',1)
        ->where('locationmenus.'.$location,'=',1)
        ->orderby('position','asc')
        ->get();
        return $getmenu;
    }

     public function index(){
        $active_menu = "cart";
        if(Cart::count()>0){
            $products_id = array();
            foreach(Cart::content() as $item){
                $product = Products::find($item->id);
                foreach($product->category as $k){
                    foreach($k->product as $pro){
                        $products_id[]= $pro->id;
                    }
                }
            }
            $products = Products::where('status', 1)->whereIn('id', $products_id)->inRandomOrder()->limit(6)->get();
        }else{
            $products = 0;
        }
        $locale           = config('app.locale');
        $Sidebars         = $this->getmenu('sidebar');
        $Menus            = $this->getmenu('menu');
        $Sub_menus        = $this->getmenu('submenu');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $product_carts    = \collect();
        foreach(Cart::content() as $item){
            $product_carts[] = Products::find($item->id);
        }

        return \view('frontend.cart', \compact('products', 'Sidebars', 'Menus', 'product_carts','Sub_menus','locale', 'active_menu', 'posts_footer'));
    }
    public function getcategoryblog(){
        $categoryblog = Category::select('*')
        ->where('taxonomy','=', 1)
        ->where('status','=',1)
        ->limit(7)
        ->get();
        return $categoryblog;
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $product = Products::find($data['id']);
        $price = $product->price;
        if(!empty($product->onsale)){
            $price = $product->price_onsale;
        }
        if(!empty($data['qty'])){
            $qty = $data['qty'];
        }else{
            $qty = 1;
        }
        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $qty,
                'price' => $price,
                'options' => ['thumbnail' => $product->thumb,],
            ]
        );
        $result = ['count' => Cart::count()];
        echo \json_encode($result);
    }

    public function add_cart($id)
    {
        $product = Products::find($id);
        $price = $product->price;
        if(!empty($product->onsale)){
            $price = $product->price_onsale;
        }
        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $price,
                'options' => ['thumbnail' => $product->thumb,],
            ]
        );
        return \redirect()->route('list_cart');
    }

    public function remove_cart(Request $request)
    {
        $data = $request->all();
        $rowId = $data['row_id'];
        Cart::remove($rowId);
        $total = Cart::subtotal(0, '', '.');
        $html_empty = "";
        if(Cart::count() == 0){
            $html_empty = '<div class="row">
            <div class="entry-content">
                <p class="cart-empty">
                    <i class="fad fa-shopping-cart"></i><br>
                    Your cart is currently empty.
                </p>
                <a href="'.route('user').'">Return to shop</a>
            </div>
        </div>';
        }
        $db = [
            'total' => $total,
            'count_cart' => Cart::count(),
            'html_empty' => $html_empty,
        ];
        echo \json_encode($db);
    }

    public function update_ajax(Request $request){
        $rowId = $request->row_id;
        $qty_old = $request->qty_old;
        $change_number = $request->change_number;
        if($change_number == 1){
            $qty =  $qty_old + $change_number;
        }elseif($change_number == -1){
            if($qty_old>1){
                $qty =  $qty_old + $change_number;
            }else{
                $qty =  $qty_old;
            }
        }

        Cart::update($rowId, $qty);
            foreach (Cart::content() as $item) {
                if ($rowId == $item->rowId) {
                    $total = $item->subtotal;
                }
            }
            $total_cart = Cart::subtotal(0, '', '.');
            $subtotal_cart = $total_cart;
            $subtotal = number_format($total, 0, '', '.');
            $data = [
                'qty' => $qty,
                'subtotal' => $subtotal,
                'subtotal_cart' => $subtotal_cart,
            ];
            echo json_encode($data);
    }

    public function update_cart(Request $request)
    {
        // \dd($request->all());

        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return \redirect()->route('list_cart');
    }

    public function checkout(){
        $active_menu = "cart";
        if(Session::has('is_login') && Session::get('is_login') == true){
            $customer_id = Session::get('user_id');
            $customer = Customer::find($customer_id);
        }else{
            $customer = NULL;
        }
        $locale           = config('app.locale');
        $Sidebars = $this->getmenu('sidebar');
        $Menus = $this->getmenu('menu');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return \view('frontend.checkout', \compact('customer', 'Sidebars', 'Menus', 'locale', 'active_menu', 'posts_footer'));
    }

    public function sendmail(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:225',
                'email' => 'required|email|max:225',
                'address' => 'required|string',
                'phone_number' => ['required', 'regex:/^(0[5|7|8|9])([0-9]{8})$/'],
                'payment_method' => 'required',
                'note' => 'nullable|string|max:225',
            ],
            [
                'required' => 'Quý khách vui lòng điền thông tin :attribute !',
                'max' => ':attribute có độ dài tối đa :max ký tự!',
                'regex' => ':attribute không chính xác!'
            ],
            [
                'name' => 'Họ Tên',
                'email' => 'Email',
                'address' => 'Địa chỉ nhận hàng',
                'phone_number' => 'Số điện thoại',
                'payment_method' => 'thanh toán',
                'note' => 'Nội dung ghi chú'
            ]
        );
        if(Session::has('is_login') && Session::get('is_login') == true){
            $customer_id = Session::get('user_id');
        }else{
            $customer_id = NULL;
        }
        $info_order = [
            'customer_id' => $customer_id,
            'customer_name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'note' => $request->input('note'),
            'payment_method' => $request->input('payment_method'),
            'status' => 1,
            'total' => Cart::subtotal(0, '', ''),
        ];

        $order = Order::create($info_order);

        $order_items = [];
        foreach (Cart::content() as $item) {
            $order_items[] = [
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'quantity' => $item->qty,
                'price' => number_format($item->price, 0, '', ''),
            ];
        }
        $orders = array();
        foreach ($order_items as $order_item){
            $orders['products'][] = Order_item::create($order_item);
        }
        // dd( $orders['products']);
        $orders['code_order'] = $order->id;
        $data = [
            'info_order' => $info_order,
            'orders' => $orders
        ];
        if (!empty($info_order['email'])) {
            Mail::to($info_order['email'])->send(new OrderMail($data));
            Mail::to(\env('MAIL_ADMIN'))->send(new ThongBaoCoDonHangMoi($data));
        }
        Cart::destroy();
        Session::put('order_success', $order->id);
        return \redirect()->route('thanks');
    }

    public function thanks(){
        $active_menu = "cart";
        if(Session::has('order_success')){
            $locale           = config('app.locale');
            $Sidebars         = $this->getmenu('sidebar');
            $Menus            = $this->getmenu('menu');
            $order_id         = Session::get('order_success');
            $order            = Order::find($order_id);
            $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
            return \view('frontend.thankyou', \compact('order', 'Sidebars', 'Menus', 'active_menu', 'locale', 'posts_footer'));
        }else{
            return \redirect()->route('list_cart');
        }
    }

    public function list_wish(){
        // Cookie::queue(Cookie::forget('list_wish'));
        $active_menu = "cart";
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        $products = Products::whereIn('id', $list_id_wish)->where('status', 1)->get();
        Cookie::queue('count_wish', $products->count(), 1051200);
        $Sidebars = $this->getmenu('sidebar');
        $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return \view('frontend.wish-list', \compact('Sidebars', 'Menus', 'active_menu', 'locale', 'products', 'posts_footer'));
    }

    public function add_wish(Request $request){
        $id = $request->id;
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        if(!in_array($id, $list_id_wish)){
            $list_id_wish[] = $id;
        }
        $list_wish = \implode(' ', $list_id_wish);
        Cookie::queue('list_wish', $list_wish, 1051200);
        $count_product = Products::whereIn('id', $list_id_wish)->where('status', 1)->count();
        Cookie::queue('count_wish', $count_product, 1051200);
        $db = ['count_wish' => $count_product];
        $heart = '<i class="fas fa-heart" style="font-weight: 900 !important;"></i>';
        $db = [
            'heart' => $heart,
            'count_wish' => $count_product,
        ];
        echo \json_encode($db);
    }

    public function remove_product_wish(Request $request){
        $id = $request->id;
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        foreach($list_id_wish as $k => $v){
            if($v == $id){
                unset($list_id_wish[$k]);
            }
        }
        $list_wish = \implode(' ', $list_id_wish);
        Cookie::queue('list_wish', $list_wish, 1051200);
        $count_product = Products::whereIn('id', $list_id_wish)->where('status', 1)->count();
        Cookie::queue('count_wish', $count_product, 1051200);
        $db = ['count_wish' => $count_product];
        echo \json_encode($db);
    }

    public function submit_contact(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'content' => 'required',
            ],
            [
                'required' => 'Quý khách vui lòng điền thông tin :attribute !',
                'max' => ':attribute có độ dài tối đa :max ký tự!',
            ],
            [
                'name' => 'Họ tên',
                'email' => 'Địa chỉ email',
                'content' => 'nội dung liên hệ',
            ]
        );
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
        ];
        Mail::to(\env('MAIL_ADMIN'))->send(new ContactMail($data));
        return \redirect()->route('contact')->with('success', 'Thông tin liên hệ phải hồi của quý khách đã được gửi thành công!');
    }
}
