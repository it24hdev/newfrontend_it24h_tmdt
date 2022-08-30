<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Locationmenu;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function getmenu($location){
        $getmenu = Locationmenu::select('locationmenus.*')
        ->leftJoin('categories', 'categories.id', '=', 'locationmenus.category_id')
        ->where('categories.taxonomy','=',0)
        ->where('categories.status','=',1)
        ->where('locationmenus.'.$location,'=',1)
        ->orderby('position','asc')
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
        $locale = config('app.locale');
        if(!empty(Cookie::get('remember-me'))){
            Session::put('is_login', true);
            Session::put('user_id', Cookie::get('remember-me'));
        }
        if(Session::has('is_login') && Session::get('is_login') == true){
            $locale             = config('app.locale');
            $Sidebars = $this->getmenu('sidebar');
            $Menus = $this->getmenu('menu');
            $getcategoryblog    = $this->getcategoryblog();
            $id = Session::get('user_id');
            $user = Customer::find($id);
            if(!empty($user)){
                $orders = $user->order;
                return \view('frontend.user.account', \compact('user', 'orders', 'Sidebars', 'Menus', 'getcategoryblog','locale'));
            }else{
                return \redirect()->route('user_login_register');
            }
        }else{
            return \redirect()->route('user_login_register');
        }
    }

    public function login_register(){
        $locale             = config('app.locale');
        $Sidebars = $this->getmenu('sidebar');
        $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        $getcategoryblog    = $this->getcategoryblog();
        Session::forget('is_login');
        Session::forget('user_id');
        Cookie::queue(Cookie::forget('remember-me'));
        return \view('frontend.user.login-register', \compact('Sidebars', 'Menus', 'getcategoryblog','locale'));
    }

    public function login(Request $request){
        $request->validate(
            [
                'email' => ['required', 'string', 'email'],
                'password_login' => ['required', 'string'],
            ],
            [
                'required' => ':attribute không được để trống!',
            ],
            [
                'email' => 'Email',
                'password_login' => 'Mật khẩu',
            ],
        );
        $email = $request->email;
        $password = $request->password_login;
        $result = Customer::where('email', $email)->first();
        if(empty($request->email) || empty($result)){
            return \back()->with('error', 'Email không chính xác!');
        }else{
            if (!(Hash::check($password, $result->password))) {
                return \back()->with('error', "Mật khẩu không chính xác!");
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
                'required' => ':attribute không được để trống!',
                'regex' => ':attribute dài từ 8 ký trở lên, có ít nhất một chữ và một số!',
                'confirmed' => ':attribute nhập lại không chính xác!',
                'max' => ':attribute dài tối đa 255 ký tự!',
                'unique' => ':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Họ tên',
                'new_email' => 'Email',
                'password' => 'Mật khẩu',
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
                'required' => ':attribute không được để trống!',
                'max' => ':attribute có độ dài tối đa :max ký tự!',
                'unique' => ':attribute đã tồn tại trong hệ thống!',
                'image' => ':attribute không đúng định dạng! (jpg, jpeg, png)',
                'regex' => ':attribute không chính xác!'
            ],
            [
                'name' => 'Họ tên',
                'address' => 'Địa chỉ',
                'phone_number' => 'Số điện thoại',
                'birthday' => 'Ngày sinh',
                'avatar' => 'Ảnh đại diện',
                'gender' => 'Giới tính'
            ]
        );

        if ($request->hasFile('avatar')) {
            $thumb = $request->avatar;
            $name_avt = CommonHelper::convertTitleToSlug($request->name,'-').'-'.time().'.'.$thumb ->extension();
            $folder_upload = 'upload/images/user';
            CommonHelper::uploadImage($thumb, $name_avt, $folder_upload);
        }

        //Tạo mảng giá trị update
        $input = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'birthday' => $request->input('birthday'),
        ];

        //2 trường hợp có thay đổi avatar và không thay đổi avatar,
        //Có: phải xóa avatar cũ
        if (!empty($name_avt)) {
            $input['avatar'] = $name_avt;
            $user = Customer::find($id);
            $avatar = $user->avatar;
            CommonHelper::deleteImage($avatar, '/upload/images/user/');
            if (Customer::where('id', $id)->update($input)) {
                return \back()->with('success', 'Bạn đã cập nhật tài khoản thành công!');
            } else {
                return \back()->withInput();
            }
        } else {
            if (Customer::where('id', $id)->update($input)) {
                return \back()->with('success', 'Bạn đã cập nhật tài khoản thành công!');
            } else {
                return \back()->withInput();
            }
        }
    }

    public function forgot_password(Request $request){
        $locale             = config('app.locale');
        $reset_token = $request->reset_token;
        $Sidebars = $this->getmenu('sidebar');
        $Menus = $this->getmenu('menu');
        $locale = config('app.locale');
        $getcategoryblog    = $this->getcategoryblog();
        if(empty($reset_token)){

            return \view('frontend.user.forgot-password', \compact('Sidebars', 'Menus', 'getcategoryblog' , 'locale'));

        }else{
            $customer = Customer::where('reset_password', $reset_token)->first();
            // dd($customer);
            if(empty($customer)){
                Session::flash('error', 'Yêu cầu lấy lại mật khẩu không hợp lệ!');
                return \view('frontend.user.forgot-password', \compact('Sidebars', 'Menus', 'getcategoryblog','locale'));
            }else{
                return \view('frontend.user.forgot-password', \compact('customer', 'Sidebars', 'Menus', 'getcategoryblog','locale'));
            }
        }
    }

    public function reset_password(Request $request, $id){
        $request->validate(
            [
                'password' => ['required', 'string', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,255}$/', 'min:8'],
            ],
            [
                'required' => ':attribute không được để trống!',
                'regex' => ':attribute dài từ 8 ký trở lên, có ít nhất một chữ và một số!',
                'max' => ':attribute dài tối đa 255 ký tự!',
            ],
            [
                'password' => 'Mật khẩu',
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
            ['required' => ':attribute không được để trống!'],
            ['email' => 'Email'],
        );
        $result = Customer::where('email', $request->email)->first();
        if(empty($result)){
            return \back()->withInput()->with('error', 'Địa chỉ email không tồn tại!');
        }else{
            $token = \md5($request->email.\time());
            Customer::where('email', $request->email)->update(['reset_password' => $token]);
            $link = \route('forgot_password');
            $data = [
                'link' => $link."?reset_token={$token}",
            ];
            Mail::to($request->email)->send(new ForgotPasswordMail($data));
            return \back()->withInput()->with('alert', 'Tin nhắn đã được gửi tới địa chỉ Email. Vui lòng kiểm tra email của bạn!');
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
                'required' => ':attribute không được để trống!',
                'min' => ':attribute có ít nhất 8 ký tự!',
                'same' => 'Mật khẩu nhập lại nhận không chính xác!',
                'different' => ':attribute không được giống mật khẩu cũ!',
                'regex' => ':attribute dài từ 8 ký trở lên, có ít nhất một chữ và một số!'
            ],
            [
                'pw_old' => 'Mật khẩu cũ',
                'password' => 'Mật khẩu mới',
                'password_confirmation' => 'Mật khẩu nhập lại',
            ]
        );
        $user = Customer::find($id);

        if (!(Hash::check($request->pw_old, $user->password))) {
            return \back()->withInput()->with('error', 'Mật khẩu cũ không chính xác!');
        } else {
            Customer::where('id', $id)->update(['password' => Hash::make($request->input('password'))]);
            return \redirect()->route('user_account')->with('passSuccess', 'Bạn đã thay đổi mật khẩu thành công!');
        }
    }

    public function user_login_ajax(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $password = $data['password'];
        $result = Customer::where('email', $email)->first();
        if(empty($email) || empty($password)){
            $db = ['error' => 'Email hoặc mật khẩu không chính xác!'];
            echo \json_encode($db);
        }else{
            if(empty($result)){
                $db = ['error' => 'Email hoặc mật khẩu không chính xác!'];
                echo \json_encode($db);
            }else{
                if (!(Hash::check($password, $result->password))) {
                    $db = ['error' => 'Email hoặc mật khẩu không chính xác!'];
                    echo \json_encode($db);
                } else {
                    if($request->remember_me == 1){
                        Cookie::queue('remember-me', $result->id, 1051200);
                    }
                    Session::put('is_login', true);
                    Session::put('user_id', $result->id);
                    $db = ['success' => 'Đăng nhập thành công!'];
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
                return redirect()->route('user_account')->with('message', 'Đăng nhập thành công');
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
                return redirect()->route('user_account')->with('message', 'Đăng nhập thành công');
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
            return redirect()->route('user_account')->with('message', 'Đăng nhập thành công');
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
