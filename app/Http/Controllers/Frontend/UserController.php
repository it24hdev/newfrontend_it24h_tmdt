<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Locationmenu;
use App\Models\Post;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\laravelmenu\src\Models\Menus;
use App\Http\Controllers\laravelmenu\src\Models\MenuItems;

class UserController extends Controller
{
    public function __construct()
    {

    }

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
    public function getcategoryblog(){
        $categoryblog = Category::where('taxonomy',1)
        ->where('status',1)
        ->limit(7)
        ->get();
        return $categoryblog;
    }

    public function account(){
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $locale = config('app.locale');
        if(!empty(Cookie::get('remember-me'))){
            Session::put('is_login', true);
            Session::put('user_id', Cookie::get('remember-me'));
        }
        if(Session::has('is_login') && Session::get('is_login') == true){
            $active_menu = "account";
            $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
            $locale             = config('app.locale');
            $Sidebars = $this->getmenu('sidebar');
            // $Menus = $this->getmenu('menu');
            $id = Session::get('user_id');
            $user = Customer::find($id);
            if(!empty($user)){
                $orders = $user->order;
                return \view('frontend.user.account', \compact('user', 'orders', 'Sidebars','locale', 'active_menu', 'posts_footer'))->with('agent', $ag);
            }else{
                return \redirect()->route('user_login_register');
            }
        }else{
            return \redirect()->route('user_login_register');
        }
    }

    public function login_register(){
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $locale = config('app.locale');
        $active_menu = "account";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $Sidebars = $this->getmenu('sidebar');
        // $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        $getcategoryblog    = $this->getcategoryblog();
        Session::forget('is_login');
        Session::forget('user_id');
        Cookie::queue(Cookie::forget('remember-me'));
        return \view('frontend.user.login-register', \compact('active_menu', 'posts_footer','Sidebars', 'getcategoryblog','locale'))->with('agent', $ag);
    }

    public function login(Request $request){
        $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password_login' => ['required', 'string'],
            ],
            [
                'required' => ':attribute kh??ng ???????c ????? tr???ng!',
            ],
            [
                'email' => 'Email',
                'password_login' => 'M???t kh???u',
            ],
        );
        $email = $request->email;
        $password = $request->password_login;
        $result = Customer::where('email', $email)->first();
        if(empty($request->email) || empty($result)){
            return \back()->with('error', 'Email kh??ng ch??nh x??c!');
        }else{
            if (!(Hash::check($password, $result->password))) {
                return \back()->with('error', "M???t kh???u kh??ng ch??nh x??c!");
            } else {
                if($request->remember_me == 1){
                    Cookie::queue('remember-me', $result->id, 1051200);
                }
                Session::put('is_login', true);
                Session::put('user_id', $result->id);
                return \redirect()->route('user_account');
            }
        }
    }

    public function register(Request $request){
        $request -> validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'new_email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
                'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,255}$/', 'min:8', 'confirmed'],
            ],
            [
                'required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'regex' => ':attribute d??i t??? 8 k?? tr??? l??n, c?? ??t nh???t m???t ch??? v?? m???t s???!',
                'confirmed' => ':attribute nh???p l???i kh??ng ch??nh x??c!',
                'max' => ':attribute d??i t???i ??a 255 k?? t???!',
                'unique' => ':attribute ???? t???n t???i tr??n h??? th???ng',
            ],
            [
                'name' => 'H??? t??n',
                'new_email' => 'Email',
                'password' => 'M???t kh???u',
            ],
        );

        $input = [
            'name' => $request->name,
            'email' => $request->new_email,
            'password' => Hash::make($request->password),
        ];
        $data = Customer::create($input);
        Session::put('is_login', true);
        Session::put('user_id', $data->id);
        return \redirect()->route('user_account');
    }

    public function logout(){
        Session::forget('is_login');
        Session::forget('user_id');
        Cookie::queue(Cookie::forget('remember-me'));
        return \redirect()->route('user_login_register');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone_number' => ['nullable', 'regex:/^(0[5|7|8|9])([0-9]{8})$/'],
                'birthday' => 'nullable|date',
                'avatar' =>  'nullable|image|mimes:jpeg,jpg,png|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
                'gender' => 'nullable',
            ],
            [
                'required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'max' => ':attribute c?? ????? d??i t???i ??a :max k?? t???!',
                'unique' => ':attribute ???? t???n t???i trong h??? th???ng!',
                'image' => ':attribute kh??ng ????ng ?????nh d???ng! (jpg, jpeg, png)',
                'regex' => ':attribute kh??ng ch??nh x??c!'
            ],
            [
                'name' => 'H??? t??n',
                'address' => '?????a ch???',
                'phone_number' => 'S??? ??i???n tho???i',
                'birthday' => 'Ng??y sinh',
                'avatar' => '???nh ?????i di???n',
                'gender' => 'Gi???i t??nh'
            ]
        );

        if ($request->hasFile('avatar')) {
            $thumb = $request->avatar;
            $name_avt = CommonHelper::convertTitleToSlug($request->name,'-').'-'.time().'.'.$thumb ->extension();
            $folder_upload = 'upload/images/user';
            CommonHelper::uploadImage($thumb, $name_avt, $folder_upload);
        }

        //T???o m???ng gi?? tr??? update
        $input = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
        ];

        //2 tr?????ng h???p c?? thay ?????i avatar v?? kh??ng thay ?????i avatar,
        //C??: ph???i x??a avatar c??
        if (!empty($name_avt)) {
            $input['avatar'] = $name_avt;
            $user = Customer::find($id);
            $avatar = $user->avatar;
            CommonHelper::deleteImage($avatar, '/upload/images/user/');
            if (Customer::where('id', $id)->update($input)) {
                return \back()->with('success', 'B???n ???? c???p nh???t t??i kho???n th??nh c??ng!');
            } else {
                return \back()->withInput();
            }
        } else {
            if (Customer::where('id', $id)->update($input)) {
                return \back()->with('success', 'B???n ???? c???p nh???t t??i kho???n th??nh c??ng!');
            } else {
                return \back()->withInput();
            }
        }
    }

    public function forgot_password(Request $request){
        $agent = new Agent();
        $ag = "";
        if($agent->isMobile()){
            $ag = "mobile";
        }
        else $ag = "desktop";
        $locale             = config('app.locale');
        $active_menu = "account";
        $posts_footer = Post::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $reset_token = $request->reset_token;
        $Sidebars = $this->getmenu('sidebar');
        // $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        if(empty($reset_token)){

            return \view('frontend.user.forgot-password', \compact('Sidebars' , 'locale', 'active_menu', 'posts_footer'))->with('agent', $ag);

        }else{
            $customer = Customer::where('reset_password', $reset_token)->first();
            // dd($customer);
            if(empty($customer)){
                Session::flash('error', 'Y??u c???u l???y l???i m???t kh???u kh??ng h???p l???!');
                return \view('frontend.user.forgot-password', \compact('Sidebars', 'locale', 'active_menu', 'posts_footer'))->with('agent', $ag);;
            }else{
                return \view('frontend.user.forgot-password', \compact('customer', 'Sidebars','locale', 'active_menu', 'posts_footer'))->with('agent', $ag);;
            }
        }
    }

    public function reset_password(Request $request, $id){
        $request->validate(
            [
                'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,255}$/', 'min:8'],
            ],
            [
                'required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'regex' => ':attribute d??i t??? 8 k?? tr??? l??n, c?? ??t nh???t m???t ch??? v?? m???t s???!',
                'max' => ':attribute d??i t???i ??a 255 k?? t???!',
            ],
            [
                'password' => 'M???t kh???u',
            ],
        );
        Customer::where('id', $id)->update(['password' => Hash::make($request->password)]);
        Session::put('is_login', true);
        Session::put('user_id', $id);
        return \redirect()->route('user_account');
    }

    public function sendmail_pw(Request $request){
        $request->validate(
            ['email' => 'required|string'],
            ['required' => ':attribute kh??ng ???????c ????? tr???ng!'],
            ['email' => 'Email'],
        );
        $result = Customer::where('email', $request->email)->first();
        if(empty($result)){
            return \back()->withInput()->with('error', '?????a ch??? email kh??ng t???n t???i!');
        }else{
            $token = \md5($request->email.\time());
            Customer::where('email', $request->email)->update(['reset_password' => $token]);
            $link = \route('forgot_password');
            $data = [
                'link' => $link."?reset_token={$token}",
            ];
            Mail::to($request->email)->send(new ForgotPasswordMail($data));
            return \back()->withInput()->with('alert', 'Tin nh???n ???? ???????c g???i t???i ?????a ch??? Email. Vui l??ng ki???m tra email c???a b???n!');
        }
    }

    public function update_password(Request $request)
    {
        $id = Session::get('user_id');
        $request->validate(
            [
                'pw_old' => 'required|string|min:8',
                'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,255}$/', 'min:8', 'different:pw_old'],
                'password_confirmation' => 'required|same:password|min:8',
            ],
            [
                'required' => ':attribute kh??ng ???????c ????? tr???ng!',
                'min' => ':attribute c?? ??t nh???t 8 k?? t???!',
                'same' => 'M???t kh???u nh???p l???i nh???n kh??ng ch??nh x??c!',
                'different' => ':attribute kh??ng ???????c gi???ng m???t kh???u c??!',
                'regex' => ':attribute d??i t??? 8 k?? tr??? l??n, c?? ??t nh???t m???t ch??? v?? m???t s???!'
            ],
            [
                'pw_old' => 'M???t kh???u c??',
                'password' => 'M???t kh???u m???i',
                'password_confirmation' => 'M???t kh???u nh???p l???i',
            ]
        );
        $user = Customer::find($id);

        if (!(Hash::check($request->pw_old, $user->password))) {
            return \back()->withInput()->with('error', 'M???t kh???u c?? kh??ng ch??nh x??c!');
        } else {
            Customer::where('id', $id)->update(['password' => Hash::make($request->input('password'))]);
            return \redirect()->route('user_account')->with('passSuccess', 'B???n ???? thay ?????i m???t kh???u th??nh c??ng!');
        }
    }

    public function user_login_ajax(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];
        $result = Customer::where('email', $email)->first();
        if(empty($email) || empty($password)){
            $db = ['error' => 'Email ho???c m???t kh???u kh??ng ch??nh x??c!'];
            echo \json_encode($db);
        }else{
            if(empty($result)){
                $db = ['error' => 'Email ho???c m???t kh???u kh??ng ch??nh x??c!'];
                echo \json_encode($db);
            }else{
                if (!(Hash::check($password, $result->password))) {
                    $db = ['error' => 'Email ho???c m???t kh???u kh??ng ch??nh x??c!'];
                    echo \json_encode($db);
                } else {
                    if($request->remember_me == 1){
                        Cookie::queue('remember-me', $result->id, 1051200);
                    }
                    Session::put('is_login', true);
                    Session::put('user_id', $result->id);
                    $db = ['success' => '????ng nh???p th??nh c??ng!'];
                    echo \json_encode($db);
                }
            }
        }
    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = Customer::where('id',$account->user)->first();
            if(!empty($account_name)){
                Session::put('is_login',\true);
                Session::put('user_id',$account_name->id);
                return redirect()->route('user_account')->with('message', '????ng nh???p th??nh c??ng');
            }else{
                return \redirect()->route('user_login_register');
            }

        }else{

            $input = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Customer::withTrashed()->where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Customer::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => Hash::make(\time()),
                ]);
            }
            $input->login()->associate($orang);
            $input->save();
            $account_name = Customer::where('id',$input ->user)->first();
            if(!empty($account_name)){
                Session::put('is_login', \true);
                Session::put('user_id',$account_name->id);
                return redirect()->route('user_account')->with('message', '????ng nh???p th??nh c??ng');
            }else{
                return \redirect()->route('user_login_register');
            }
        }
    }


    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Customer::where('id',$authUser->user)->first();
        if(empty($account_name)){
            return  redirect()->route('user_login_register');
        }else{
            Session::put('is_login', \true);
            Session::put('user_id',$account_name->id);
            return redirect()->route('user_account')->with('message', '????ng nh???p th??nh c??ng');
        }
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }else{
            $input = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Customer::withTrashed()->where('email',$users->email)->first();

                if(!$orang){
                    $orang = Customer::create([
                        'name' => $users->name,
                        'email' => $users->email,
                        'password' => Hash::make(time()),
                    ]);
                }
            $input->login()->associate($orang);
            $input->save();
            return $input;
        }

    }

}
