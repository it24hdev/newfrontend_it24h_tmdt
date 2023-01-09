<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;
use App\Mail\ContactMail;
use App\Mail\OrderMail;
use App\Models\City;
use App\Models\District;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Post;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
use function abort;
use function compact;
use function env;
use function implode;
use function json_encode;
use function redirect;
use function view;

class CartController extends Controller
{

    public function index()
    {
        try {
            $locale = config('app.locale');
            $agent = new Agent();
            $cart_data = "";
            $shopping_cart = Session::get('shopping_cart');
            if ($shopping_cart) {
                $data = Crypt::decryptString(Session::get('shopping_cart'));
                $cookie_data = stripslashes($data);
                $cart_data = json_decode($cookie_data, true);
            }
            if ($agent->isMobile()) {
                return view('frontend.mobile.cartmobile', compact('cart_data', 'locale'));
            } else {
                $Sidebars = $this->getmenu('sidebar');
                $active_menu = "product";
                return view('frontend.cart', compact('cart_data', 'locale','Sidebars','active_menu'));
            }
        } catch (Exception $exception) {
            abort(404);
        }
    }

    //menu
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

    //update gio hang
    public function update_shopping_cart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $shopping_cart = Session::get('shopping_cart');
        if ($shopping_cart) {
            $cookie_data = stripslashes(Crypt::decryptString(Session::get('shopping_cart')));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }
        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;
        $count = 0;
        $quantity = 0;

        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    if ($request->input('quantity')) {
                        if ($request->input('status') && $request->input('status') == 'plus') {
                            $cart_data[$keys]["item_quantity"] = $request->input('quantity') + 1;
                            $quantity = $cart_data[$keys]["item_quantity"];
                        } else {

                            $cart_data[$keys]["item_quantity"] = $request->input('quantity') - 1;
                            $quantity = $cart_data[$keys]["item_quantity"];
                        }
                    } else {
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + 1;
                        $quantity = $cart_data[$keys]["item_quantity"];
                    }
                    $item_data = json_encode($cart_data);
                    Session::put('shopping_cart', Crypt::encryptString($item_data));
                }
                $count = $count + $cart_data[$keys]["item_quantity"];
            }
            Session::put('count_cart', $count);
            return response()->json(['success' => true, 'count' => $count, 'quantity' => $quantity]);
        } else {
            $products = Products::find($prod_id);
            $prod_id = $products->id;
            $prod_slug = $products->slug;
            $prod_name = $products->name;
            $prod_image = $products->thumb;
            $price = $products->price;
            $price_onsale = $products->price_onsale;
            $onsale = $products->onsale;
            if ($products) {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_slug' => $prod_slug,
                    'item_name' => $prod_name,
                    'item_image' => $prod_image,
                    'item_price' => $price,
                    'item_onsale' => $onsale,
                    'item_quantity' => 1,
                    'item_price_onsale' => $price_onsale,
                );
                $cart_data[] = $item_array;
                $item_data = json_encode($cart_data);
                Session::put('shopping_cart', Crypt::encryptString($item_data));
                foreach ($cart_data as $keys => $values) {
                    $count = $count + $cart_data[$keys]["item_quantity"];
                }
                Session::put('count_cart', $count);
                return response()->json(['success' => true, 'count' => $count]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
    //xoa san pham khoi gio hang
    public function remove_cart_data(Request $request)
    {
        $prod_id = $request->input('product_id');
        $cookie_data = stripslashes(Crypt::decryptString(Session::get('shopping_cart')));
        $cart_data = json_decode($cookie_data, true);
        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;
        $count = 0;
        if (in_array($prod_id_is_there, $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    Session::put('shopping_cart', Crypt::encryptString($item_data));
                } else {
                    $count = $count + $cart_data[$keys]["item_quantity"];
                }
            }
            Session::put('count_cart', $count);
            return response()->json(['success' => true, 'count' => $count]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    //ham luu thong tin mat hang duoc chon dat hang -  chuyen sang form nhap thong tin khach hang
    public function order_processing(Request $request)
    {
        $list_cart_success = $request->input('list_cart_success');
        Session::forget('cart_success');
        if ($list_cart_success) {
            $list_item = json_encode($list_cart_success);
            Session::put('cart_success', Crypt::encryptString($list_item));
            return response()->json(['success' => true]);
        }
    }

    //Form thong tin cho khach hang nhap
    public function checkout(Request $request)
    {
        $agent = new Agent();
        $locale = config('app.locale');
        $active_menu = "product";
        $city = City::get();
        $district = District::where('matp', 31)->get();
        $data_cart_succes = Session::get('cart_success');
        $cart_success="";
        if($data_cart_succes){
            $cart_success = json_decode(Crypt::decryptString($data_cart_succes));
        }
        $shopping_cart = Session::get('shopping_cart');
        if ($shopping_cart) {
            $cookie_data = stripslashes(Crypt::decryptString(Session::get('shopping_cart')));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }
        $item_id_list = array_column($cart_data, 'item_id');
        $total_money = 0;
        if ($cart_success) {
            if (array_intersect($cart_success, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                    if (in_array($cart_data[$keys]["item_id"], $cart_success)) {
                        if ($cart_data[$keys]["item_price_onsale"] != 0 && $cart_data[$keys]["item_price_onsale"] != null) {
                            $total_money = $total_money + (($cart_data[$keys]["item_quantity"]) * ($cart_data[$keys]["item_price_onsale"]));
                        } else {
                            $total_money = $total_money + (($cart_data[$keys]["item_quantity"]) * ($cart_data[$keys]["item_price"]));
                        }
                    }
                }
                $active = 1;
                if ($agent->isMobile()) {
                    return view('frontend.mobile.orderinfomobile', ['total_money' => $total_money, 'active' => $active, 'city' => $city, 'district' => $district]);
                }
                else{
                    $Sidebars = $this->getmenu('sidebar');
                    return view('frontend.checkout',['total_money' => $total_money, 'active' => $active, 'city' => $city, 'district' => $district,
                       'active_menu' => $active_menu,'Sidebars' => $Sidebars,'locale' => $locale]);
                }
            } else {
                $active = 0;
                if ($agent->isMobile()) {
                    return view('frontend.mobile.orderinfomobile', ['active' => $active]);
                }
                else{
                    $Sidebars = $this->getmenu('sidebar');
                    return view('frontend.checkout',['active' => $active, 'active_menu' => $active_menu,'Sidebars' => $Sidebars,'locale' => $locale]);
                }
            }
        } else {
            $active = 0;
            if ($agent->isMobile()) {
                return view('frontend.mobile.orderinfomobile', ['active' => $active]);
            }
            else{
                $Sidebars = $this->getmenu('sidebar');
                return view('frontend.checkout',['active' => $active, 'active_menu' => $active_menu,'Sidebars' => $Sidebars,'locale' => $locale]);
            }
        }
    }

    //Ham hien thi quan/huyen sau khi chon tinh/tp
    public function get_district(Request $request)
    {
        $ma_tp = $request->ma_tp;
        $district = District::where('matp', $ma_tp)->get();
        if ($district) {
            return response()->json(['success' => true, 'district' => $district]);
        }
    }

    //luu thong tin hang dat-chuyen sang Hoan thanh
    public function complete_payment(Request $request)
    {
        $info_customer = [
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'note' => $request->note,
            'name_company' => $request->name_company,
            'address_company' => $request->address_company,
            'tax_code' => $request->tax_code,
            'email_company' => $request->email_company,
            'payment_method' => $request->payment_method,
            'status' => 1
        ];
        try {
            DB::beginTransaction();
            $order = Order::create($info_customer);
            Session::forget('info_customer');
            Session::put('info_customer', Crypt::encryptString($order->id));
            $cookie_data = stripslashes(Crypt::decryptString(Session::get('shopping_cart')));
            $cart_data = json_decode($cookie_data, true);
            $list_success = json_decode(Crypt::decryptString(Session::get('cart_success')));
            $total_money = $count = 0;
            foreach ($cart_data as $keys => $item) {
                if (in_array($item['item_id'], $list_success)) {
                    if ($item['item_price_onsale'] == 0 || $item['item_price_onsale'] == null) {
                        $price = $item['item_price'];
                    } else {
                        $price = $item['item_price_onsale'];
                    }
                    $order_items = [
                        'order_id' => $order->id,
                        'product_id' => $item['item_id'],
                        'product_name' => $item['item_name'],
                        'product_slug' => $item['item_slug'],
                        'quantity' => $item['item_quantity'],
                        'price' => number_format($price, 0, '', ''),
                    ];
                    Order_item::create($order_items);
                    unset($cart_data[$keys]);
                    $total_money = $total_money + ($item['item_quantity']) * $price;
                } else {
                    $count = $count + $item["item_quantity"];
                }
            }
            $item_data = json_encode($cart_data);
            Session::put('shopping_cart', Crypt::encryptString($item_data));
            Session::put('count_cart', $count);
            $updatOder = Order::find($order->id);
            $updatOder->total = $total_money;
            $updatOder->save();
            Session::forget('cart_success');
            DB::commit();
            $this->send_email_cart($order->id, $request->email);
            return response()->json(['success' => true]);
        } catch (Exception $exception) {
            DB::rollBack();
            Session::forget('info_customer');
            return response()->json(['success' => false]);
        }
    }

    //Hoan thanh - hien thi thong tin hang da dat
    public function successorder()
    {
        $data_info_customer = Session::get('info_customer');
        $id_customer_order ="";
        $agent = new Agent();
        if($data_info_customer){
            $id_customer_order = Crypt::decryptString($data_info_customer);
        }
        $customer_order = Order::find($id_customer_order);
        if ($customer_order) {
            $active = 1;
            if($agent->isPhone()){
                return view('frontend.mobile.successorder', ['customer_order' => $customer_order, 'active' => $active]);
            }
            else{
                $info_order = Order_item::select('order_items.*',DB::raw('products.thumb as thumb'))
                    ->leftjoin('products','products.id', 'order_items.product_id')
                    ->where('order_id',$id_customer_order)
                    ->get();
                $Sidebars = $this->getmenu('sidebar');
                $active_menu = "product";
                return view('frontend.successorder', ['customer_order' => $customer_order, 'Sidebars' => $Sidebars, 'active_menu' => $active_menu,
                    'info_order' => $info_order, 'active' => $active]);
            }

        } else {
            $active = 0;
            if($agent->isPhone()){
                return view('frontend.mobile.successorder', ['active' => $active]);
            }else{
                $Sidebars = $this->getmenu('sidebar');
                $active_menu = "product";
                return view('frontend.successorder', [ 'Sidebars' => $Sidebars, 'active_menu' => $active_menu, 'active' => $active]);
            }
        }
    }

    public function send_email_cart($id, $email){
        $mail_to_admin = "it24h.dev@gmail.com";
        if($id){
            Mail::to($email)->send(new OrderMail($id));
            Mail::to($mail_to_admin)->send(new OrderMail($id));
        }
    }
    public function list_wish()
    {
        $agent = new Agent();
        $ag = "";
        if ($agent->isMobile()) {
            $ag = "mobile";
        } else $ag = "desktop";
        // Cookie::queue(Cookie::forget('list_wish'));
        $active_menu = "cart";
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        $products = Products::whereIn('id', $list_id_wish)->where('status', 1)->get();
        Cookie::queue('count_wish', $products->count(), 1051200);
        $Sidebars = $this->getmenu('sidebar');
        // $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.wish-list', compact('Sidebars', 'active_menu', 'locale', 'products', 'posts_footer'))->with('agent', $ag);
    }

    public function add_wish(Request $request)
    {
        $id = $request->id;
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        if (!in_array($id, $list_id_wish)) {
            $list_id_wish[] = $id;
        }
        $list_wish = implode(' ', $list_id_wish);
        Cookie::queue('list_wish', $list_wish, 1051200);
        $count_product = Products::whereIn('id', $list_id_wish)->where('status', 1)->count();
        Cookie::queue('count_wish', $count_product, 1051200);
        $db = ['count_wish' => $count_product];
        $heart = '<i class="fas fa-heart" style="font-weight: 900 !important;"></i>';
        $db = [
            'heart' => $heart,
            'count_wish' => $count_product,
        ];
        echo json_encode($db);
    }

    public function remove_product_wish(Request $request)
    {
        $id = $request->id;
        $get_cookie = Cookie::get('list_wish');
        $list_id_wish = explode(' ', $get_cookie);
        foreach ($list_id_wish as $k => $v) {
            if ($v == $id) {
                unset($list_id_wish[$k]);
            }
        }
        $list_wish = implode(' ', $list_id_wish);
        Cookie::queue('list_wish', $list_wish, 1051200);
        $count_product = Products::whereIn('id', $list_id_wish)->where('status', 1)->count();
        Cookie::queue('count_wish', $count_product, 1051200);
        $db = ['count_wish' => $count_product];
        echo json_encode($db);
    }

    public function submit_contact(Request $request)
    {
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
        Mail::to(env('MAIL_ADMIN'))->send(new ContactMail($data));
        return redirect()->route('contact')->with('success', 'Thông tin liên hệ phải hồi của quý khách đã được gửi thành công!');
    }


}
