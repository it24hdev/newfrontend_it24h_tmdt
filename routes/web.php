<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Vote\VoteController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Categorypost\CategorypostController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Slider\SliderController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Frontend\DetailproductController;
use App\Http\Controllers\Locationmenu\LocationmenuController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;


Auth::routes();

/* ========== ADMIN =========== */

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    /*----------- USER ----------*/
    Route::prefix('admin/user')->group(function () {
        Route::get('/info', [UserController::class, 'info'])->name('user.info');
        Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/editPassword', [UserController::class, 'editPassword'])->name('user.editPassword');
        Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');

        Route::get('/list', [AdminController::class, 'index'])->name('user.list');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit-user/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/delete', [AdminController::class, 'delete'])->name('admin.delete');
        Route::post('/restore', [AdminController::class, 'restore'])->name('admin.restore');
        Route::post('/force-delete', [AdminController::class, 'forceDelete'])->name('admin.forceDelete');
        Route::post('/updatePassword-user/{id}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    });

    /* ------- CUSTOMER ------------ */
    Route::prefix('admin/customer')->group(function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('customer.list');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::post('/updatePassword/{id}', [CustomerController::class, 'updatePassword'])->name('customer.updatePassword');
        Route::post('/delete', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::post('/restore', [CustomerController::class, 'restore'])->name('customer.restore');
        Route::post('/force-delete', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');
    });
    /* ---------- ROLE ------------- */
    Route::prefix('admin/role')->group(function () {
        Route::get('/list', [RoleController::class, 'index'])->name('role.list');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::post('/delete', [RoleController::class, 'delete'])->name('role.delete');
    });

    /* ---------------- POST --------------- */
    Route::prefix('admin/post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/create', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::post('/delete', [PostController::class, 'destroy'])->name('post.delete');
        Route::post('/delete-img', [PostController::class, 'deleteImg'])->name('post.deleteImg');
    });

    /* ---------------- VOTE --------------- */
    Route::prefix('admin/vote')->group(function () {
        Route::prefix('post')->group(function (){
            Route::get('/', [VoteController::class, 'indexVotePost'])->name('vote.indexPost');
            Route::get('/create', [VoteController::class, 'createVotePost'])->name('vote.createPost');
            Route::post('/create', [VoteController::class, 'storeVotePost'])->name('vote.storePost');
            Route::get('/edit/{id}', [VoteController::class, 'editVotePost'])->name('vote.editPost');
            Route::post('/update/{id}', [VoteController::class, 'updateVotePost'])->name('vote.updatePost');
            Route::post('/delete', [VoteController::class, 'destroyVotePost'])->name('vote.deletePost');
            Route::get('/select-reply', [VoteController::class, 'selectReply'])->name('vote.selectReply');
            Route::get('/select-reply-edit', [VoteController::class, 'selectReplyEdit'])->name('vote.selectReplyEdit');
        });
        Route::prefix('product')->group(function (){
            Route::get('/', [VoteController::class, 'indexVoteProduct'])->name('vote.indexProduct');
            Route::get('/create', [VoteController::class, 'createVoteProduct'])->name('vote.createProduct');
            Route::post('/create', [VoteController::class, 'storeVoteProduct'])->name('vote.storeProduct');
            Route::get('/edit/{id}', [VoteController::class, 'editVoteProduct'])->name('vote.editProduct');
            Route::post('/update/{id}', [VoteController::class, 'updateVoteProduct'])->name('vote.updateProduct');
            Route::post('/delete', [VoteController::class, 'destroyVoteProduct'])->name('vote.deleteProduct');
        });

    });

    /* ---------------- PRODUCT--------------- */
    Route::prefix('admin/products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/create', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::post('/delete', [ProductsController::class, 'destroy'])->name('products.delete');
        Route::post('/delete-img', [ProductsController::class, 'deleteImgAjax'])->name('products.deleteImg');
        Route::get('/list-attr',  [ProductsController::class, 'list_attr'])->name('products.list_attr');
        Route::get('/create-attr',  [ProductsController::class, 'create_attr'])->name('products.create_attr');
        Route::post('/store-attr',  [ProductsController::class, 'store_attr'])->name('products.store_attr');
        Route::post('/update-attr',  [ProductsController::class, 'update_attr'])->name('products.update_attr');
        Route::post('/delete-attr',  [ProductsController::class, 'delete_attr'])->name('products.delete_attr');
        Route::get('/list-brand',  [ProductsController::class, 'list_brand'])->name('products.list_brand');
        Route::get('/create-brand',  [ProductsController::class, 'create_brand'])->name('products.create_brand');
        Route::post('/store-brand',  [ProductsController::class, 'store_brand'])->name('products.store_brand');
        Route::post('/update-brand',  [ProductsController::class, 'update_brand'])->name('products.update_brand');
        Route::post('/delete-brand',  [ProductsController::class, 'delete_brand'])->name('products.delete_brand');
        Route::get('/list-tag-event',  [ProductsController::class, 'list_tag_event'])->name('products.list_tag-event');
        Route::get('/create-tag-event',  [ProductsController::class, 'create_tag_event'])->name('products.create_tag-event');
        Route::post('/store-tag-event',  [ProductsController::class, 'store_tag_event'])->name('products.store_tag-event');
        Route::post('/update-tag-event',  [ProductsController::class, 'update_tag_event'])->name('products.update_tag-event');
        Route::post('/delete-tag-event',  [ProductsController::class, 'delete_tag_event'])->name('products.delete_tag-event');
    });


    /* --------- Slider ------------ */
    Route::prefix('admin/slider')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/create', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::post('/delete', [SliderController::class, 'destroy'])->name('slider.delete');
        Route::post('/delete-img', [SliderController::class, 'deleteImg'])->name('slider.deleteImg');
        Route::post('/get-data', [SliderController::class, 'getData'])->name('slider.getdata');
    });


    /* ---------- ORDER --------------- */
    Route::prefix('admin/order')->group(function () {
        Route::get('/list', [OrderController::class, 'index'])->name('order.list');
        Route::post('/delete', [OrderController::class, 'delete'])->name('order.delete');
        Route::post('/restore', [OrderController::class, 'restore'])->name('order.restore');
        Route::post('/force-delete', [OrderController::class, 'forceDelete'])->name('order.forceDelete');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('/update', [OrderController::class, 'update'])->name('order.update');
        Route::post('/updateCustomer', [OrderController::class, 'updateCustomer'])->name('order.updateCustomer');
        Route::post('/update-ajax', [OrderController::class, 'updateAjax'])->name('order.updateAjax');
    });

    /* ---------- Danh muc san pham --------------- */
    Route::prefix('admin/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/search', [CategoryController::class, 'search'])->name('category.search');
        Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/delete', [CategoryController::class, 'destroy'])->name('category.delete');
    });
    /* ---------- Danh muc bai viet --------------- */
    Route::prefix('admin/categorypost')->group(function () {
        Route::get('/', [CategorypostController::class, 'index'])->name('categorypost.index');
        Route::get('/create', [CategorypostController::class, 'create'])->name('categorypost.create');
        Route::get('/search', [CategorypostController::class, 'search'])->name('categorypost.search');
        Route::post('/create', [CategorypostController::class, 'store'])->name('categorypost.store');
        Route::post('/update/{id}', [CategorypostController::class, 'update'])->name('categorypost.update');
        Route::get('/edit/{id}', [CategorypostController::class, 'edit'])->name('categorypost.edit');
        Route::post('/delete', [CategorypostController::class, 'destroy'])->name('categorypost.delete');

    });

    /* ---------- Danh muc vi tri menu --------------- */
    Route::prefix('admin/locationmenu')->group(function () {
        Route::get('/', [LocationmenuController::class, 'index'])->name('locationmenu.index');
        Route::get('/create', [LocationmenuController::class, 'create'])->name('locationmenu.create');
        Route::post('/create', [LocationmenuController::class, 'store'])->name('locationmenu.store');
        Route::post('/update/{id}',[LocationmenuController::class, 'update'])->name('locationmenu.update');
        Route::get('/edit/{id}', [LocationmenuController::class, 'edit'])->name('locationmenu.edit');
        Route::post('/delete', [LocationmenuController::class, 'destroy'])->name('locationmenu.delete');
        Route::post('/resofting_category', [LocationmenuController::class, 'resofting_category'])->name('resofting_category');
        Route::get('/sort/{id}',[LocationmenuController::class, 'sort'])->name('locationmenu.sort');
    });

});

/* ========== Change language =========== */

Route::get('setLocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('app.setLocale');

/* ==== User ==== */
Route::get('/login-register', [FrontendUserController::class, 'login_register'])->name('user_login_register');
Route::post('/user-register', [FrontendUserController::class, 'register'])->name('user_register');
Route::post('/user-login', [FrontendUserController::class, 'login'])->name('user_login');
Route::get('/my-account', [FrontendUserController::class, 'account'])->name('user_account');
Route::get('/user-logout', [FrontendUserController::class, 'logout'])->name('user_logout');
Route::post('/user-update/{id}', [FrontendUserController::class, 'update'])->name('user_update');
Route::get('/forgot-password', [FrontendUserController::class, 'forgot_password'])->name('forgot_password');
Route::post('/sendmail-pw', [FrontendUserController::class, 'sendmail_pw'])->name('sendmail_pw');
Route::get('/token-reset-password/{token}', [FrontendUserController::class, 'getTokenPw'])->name('getTokenPw');
Route::post('/reset-password/{id}', [FrontendUserController::class, 'reset_password'])->name('reset_password');
Route::post('/change-password', [FrontendUserController::class, 'update_password'])->name('change_password');
Route::post('/login-ajax', [FrontendUserController::class, 'user_login_ajax'])->name('user_login_ajax');

/* ==== Cart ===== */
Route::get('/gio-hang', [CartController::class, 'index'])->name('list_cart');
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add_cart_ajax');
Route::get('/add-cart/{id}', [CartController::class, 'add_cart'])->name('add_cart');
Route::post('/remove-cart', [CartController::class, 'remove_cart'])->name('remove_cart');
Route::post('/updateAjax-cart', [CartController::class, 'update_ajax'])->name('update_ajax');
Route::post('/update-cart', [CartController::class, 'update_cart'])->name('cart.update');
Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('checkout');
Route::post('/thanh-toan', [CartController::class, 'sendmail'])->name('sendmail');
Route::get('/thanks', [CartController::class, 'thanks'])->name('thanks');
Route::get('/yeu-thich', [CartController::class, 'list_wish'])->name('list_wish');
Route::post('/add-wish', [CartController::class, 'add_wish'])->name('add_wish');
Route::post('/delete-wish', [CartController::class, 'remove_product_wish'])->name('remove_product_wish');

/** Frontend */
Route::get('/', [HomeController::class, 'index'])->name('user');
Route::post('/', [HomeController::class, 'getProducts'])->name('getProducts');

Route::get('/san-pham', [HomeController::class, 'list_product'])->name('list_product');
Route::get('/san-pham/{slug}', [HomeController::class, 'product_cat'])->name('product_cat');
Route::get('/bai-viet', [HomeController::class, 'categoryBlogs'])->name('categoryBlogs');
Route::get('/bai-viet/{slug}', [HomeController::class, 'categoryBlog'])->name('categoryBlog');
Route::get('/{slug}.html', [HomeController::class, 'singlePost'])->name('singlePost');
Route::post('/comment-blog', [HomeController::class, 'commentPost'])->name('commentPost');
Route::post('/form-vote', [HomeController::class, 'getFormVote'])->name('getFormVote');
Route::post('/autotypeahead', [HomeController::class, 'autotypeahead'])->name('autotypeahead');

Route::get('/chi-tiet-san-pham/{slug}',[DetailproductController::class,'index'])->name('detailproduct');
Route::post('/comment-product',[DetailproductController::class,'commentProduct'])->name('commentProduct');
Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');

//Login facebook
Route::get('/login-facebook',[FrontendUserController::class, 'login_facebook'])->name('login-facebook');
Route::get('/callback', [FrontendUserController::class, 'callback_facebook']);

//Login  google
Route::get('/login-google', [FrontendUserController::class, 'login_google'])->name('login-google');
Route::get('/google/callback', [FrontendUserController::class, 'callback_google']);
