<?php

use Illuminate\Support\Facades\Route;

//Users
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProfileController;



//Admins
use App\Http\Controllers\Server\AdminsController;
use App\Http\Controllers\Server\UsersController;
use App\Http\Controllers\Server\ProvidersController;

use App\Http\Controllers\Server\PurchasesController;
use App\Http\Controllers\Server\OrdersController;

use App\Http\Controllers\Server\SizesController;
use App\Http\Controllers\Server\ColorsController;

use App\Http\Controllers\Server\ProductsController;
use App\Http\Controllers\Server\CommentsController;
use App\Http\Controllers\Server\DashBoardController;

use App\Http\Controllers\Server\DiscountsController;
use App\Http\Controllers\Server\CategoriesController;

use App\Http\Controllers\Server\SlideShowsController;
use App\Http\Controllers\Server\PaymentMethodsController;


// Route::get('/', function () {
//     return view('dashboard');
//     // return view('login');
// });


//Users Route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dang-ky', [UsersController::class, 'register'])->name('user_register');
Route::post('/dang-ky', [UsersController::class, 'registerHandle']);

Route::get('/dang-nhap', [UsersController::class, 'login'])->name('user_login');
Route::post('/dang-nhap', [UsersController::class, 'loginHandle']);

Route::get('/trang-ca-nhan', [UsersController::class, 'profile'])->name('user_profile')->middleware('auth:users');
Route::post('/trang-ca-nhan', [UsersController::class, 'updateProfile'])->name('updateProfile')->middleware('auth:users');

Route::get('auth/google', [UsersController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [UsersController::class, 'handleGoogleCallback']);

Route::post('/dang-xuat', [UsersController::class, 'logout'])->name('user_logout');

//
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart')->middleware('auth:users');
Route::post('/them-gio-hang/{id}', [CartController::class, 'add'])->name('add_cart')->middleware('auth:users');
Route::post('/cap-nhat-gio-hang/{id}', [CartController::class, 'update'])->name('update-cart')->middleware('auth:users');
Route::post('/xoa-gio-hang', [CartController::class, 'delete'])->name('delete_cart')->middleware('auth:users');
Route::post('/xoa-all-gio-hang', [CartController::class, 'clear'])->name('delete_all_cart')->middleware('auth:users');

//
Route::get('/yeu-thich', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth:users');
Route::get('/them-yeu-thich/{id}', [WishlistController::class, 'add'])->name('wishlist_add')->middleware('auth:users');
Route::post('/xoa-yeu-thich', [WishlistController::class, 'delete'])->name('wishlist_delete')->middleware('auth:users');

//
Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth:users');
Route::post('/thanh-toan', [CheckoutController::class, 'process'])->name('process_payment')->middleware('auth:users');
//
Route::get('/payment', [PaymentController::class, 'index'])->name('vnpay_payment');
Route::post('/vnpay/create-payment', [PaymentController::class, 'createPayment'])->name('create_payment');
Route::post('/vnpay/return-payment', [PaymentController::class, 'returnPayment'])->name('payment_handle');
//
Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'index'])->name('profile_user');
Route::post('/chinh-sua-thong-tin', [ProfileController::class, 'update_profile'])->name('update_profile_user');
Route::post('/chinh-sua-mat-khau', [ProfileController::class, 'update_password'])->name('update_password_profile_user');
Route::post('/chinh-sua-anh', [ProfileController::class, 'update_avatar'])->name('update_avatar_profile_user');

//
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
//
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
//
Route::get('/ve-chung-toi', [AboutController::class, 'index'])->name('about');
//
Route::get('/san-pham', [ProductController::class, 'index'])->name('products');
//
Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'detail'])->name('product_detail');


//Admins Route

Route::prefix('/admin')->group(function () {

    Route::middleware('guest:admins')->group(function () {

        Route::get('/dang-nhap', [AdminsController::class, 'login'])->name('login');
        Route::post('/dang-nhap', [AdminsController::class, 'loginHandle']);

        Route::get('/dang-ky', [AdminsController::class, 'register'])->name('register');
        Route::post('/dang-ky', [AdminsController::class, 'registerHandle']);

        Route::get('auth/google', [AdminsController::class, 'redirectToGoogle'])->name('auth.google');
        Route::get('auth/google/callback', [AdminsController::class, 'handleGoogleCallback']);
    });

    Route::middleware('auth:admins')->group(function () {

        Route::get('/', [DashBoardController::class, 'dashboard'])->name('dashboards');
        Route::get('/dang-xuat', [AdminsController::class, 'logout'])->name('logout');

        //Admins

        Route::prefix('/quan-ly-quan-tri-vien')->name('admins.')->group(function () {

            Route::get('/', [AdminsController::class, 'index'])->name('index');

            Route::get('/trang-ca-nhan', [AdminsController::class, 'profile'])->name('profile');
            Route::post('/trang-ca-nhan', [AdminsController::class, 'updateProfile'])->name('updateProfile');

            Route::get('/thung-rac', [AdminsController::class, 'trash'])->name('trash');
            Route::post('/search', [AdminsController::class, 'search'])->name('search');

            Route::get('/them-moi', [AdminsController::class, 'create'])->name('create');
            Route::post('/them-moi', [AdminsController::class, 'store'])->name('store');

            Route::get('/chi-tiet/{id}', [AdminsController::class, 'show'])->name('show');

            Route::get('/cap-nhat/{id}', [AdminsController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [AdminsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [AdminsController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [AdminsController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [AdminsController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [AdminsController::class, 'importExcel']);

            Route::get('/export-excel', [AdminsController::class, 'exportExcel'])->name('export-excel');
        });

        //endAdmins

        // Route::resource('/admins', AdminsController::class);

        //Users

        Route::prefix('/quan-ly-nguoi-dung')->name('users.')->group(function () {

            Route::get('/', [UsersController::class, 'index'])->name('index');

            Route::get('/thung-rac', [UsersController::class, 'trash'])->name('trash');
            Route::post('/search', [UsersController::class, 'search'])->name('search');

            Route::get('/chi-tiet/{id}', [UsersController::class, 'show'])->name('show');

            Route::get('/cap-nhat/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [UsersController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [UsersController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [UsersController::class, 'viewPDF'])->name('pdf');

            Route::get('/export-excel', [UsersController::class, 'exportExcel'])->name('export-excel');
        });

        //endUsers

        // Route::resource('/users', UsersController::class);

        //Products

        Route::prefix('/quan-ly-san-pham')->name('products.')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('index');

            Route::get('/thung-rac', [ProductsController::class, 'trash'])->name('trash');
            Route::post('/search', [ProductsController::class, 'search'])->name('search');

            Route::get('/them-moi', [ProductsController::class, 'create'])->name('create');
            Route::post('/them-moi', [ProductsController::class, 'store'])->name('store');

            Route::get('/chi-tiet/{id}', [ProductsController::class, 'show'])->name('show');
            Route::post('/quantity/{id}', [ProductsController::class, 'quantity'])->name('quantity');

            Route::get('/cap-nhat/{id}', [ProductsController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [ProductsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [ProductsController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [ProductsController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [ProductsController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [ProductsController::class, 'importExcel']);

            Route::get('/export-excel', [ProductsController::class, 'exportExcel'])->name('export-excel');
        });

        //endProducts

        // Route::resource('/products', ProductsController::class);

        //Providers

        Route::prefix('/quan-ly-nha-cung-cap')->name('providers.')->group(function () {

            Route::get('/', [ProvidersController::class, 'index'])->name('index');

            Route::get('/thung-rac', [ProvidersController::class, 'trash'])->name('trash');
            Route::post('/search', [ProvidersController::class, 'search'])->name('search');

            Route::get('/them-moi', [ProvidersController::class, 'create'])->name('create');
            Route::post('/them-moi', [ProvidersController::class, 'store'])->name('store');

            Route::get('/chi-tiet/{id}', [ProvidersController::class, 'show'])->name('show');

            Route::get('/cap-nhat/{id}', [ProvidersController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [ProvidersController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [ProvidersController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [ProvidersController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [ProvidersController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [ProvidersController::class, 'importExcel']);

            Route::get('/export-excel', [ProvidersController::class, 'exportExcel'])->name('export-excel');
        });

        //endProviders

        // Route::resource('/providers', ProvidersController::class);

        //Purchase

        Route::prefix('/quan-ly-nhap-hang')->name('purchases.')->group(function () {

            Route::get('/', [PurchasesController::class, 'index'])->name('index');

            Route::get('/thung-rac', [PurchasesController::class, 'trash'])->name('trash');
            Route::post('/search', [PurchasesController::class, 'search'])->name('search');

            Route::get('/chi-tiet/{id}', [PurchasesController::class, 'show'])->name('show');
            Route::get('/verify/{id}', [PurchasesController::class, 'verify'])->name('verify');

            Route::get('/them-moi', [PurchasesController::class, 'create'])->name('create');
            Route::post('/them-moi', [PurchasesController::class, 'store'])->name('store');

            Route::get('/delete/{id}', [PurchasesController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [PurchasesController::class, 'viewPDF'])->name('pdf');

            Route::get('/export-excel', [PurchasesController::class, 'exportExcel'])->name('export-excel');
        });

        //endPurchase

        // Route::resource('/purchases', PurchasesController::class);

        //Orders

        Route::prefix('/quan-ly-don-hang')->name('orders.')->group(function () {

            Route::get('/', [OrdersController::class, 'index'])->name('index');
            Route::get('/thung-rac', [OrdersController::class, 'trash'])->name('trash');

            Route::post('/search', [OrdersController::class, 'search'])->name('search');

            Route::get('/chi-tiet/{id}', [OrdersController::class, 'show'])->name('show');

            Route::get('/delete/{id}', [OrdersController::class, 'destroy'])->name('delete');

            Route::get('/status/{id}/{status}', [OrdersController::class, 'changeStatus'])->name('status');

            Route::get('/pdf', [OrdersController::class, 'viewPDF'])->name('pdf');

            Route::get('/export-excel', [OrdersController::class, 'exportExcel'])->name('export-excel');
        });

        //endOrders

        // Route::resource('/orders', OrdersController::class);

        //Comments

        Route::prefix('/quan-ly-danh-gia')->name('comments.')->group(function () {

            Route::get('/', [CommentsController::class, 'index'])->name('index');
            Route::get('/thung-rac', [CommentsController::class, 'trash'])->name('trash');

            Route::post('/search', [CommentsController::class, 'search'])->name('search');

            Route::get('/delete/{id}', [CommentsController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [CommentsController::class, 'viewPDF'])->name('pdf');

            Route::get('/export-excel', [CommentsController::class, 'exportExcel'])->name('export-excel');
        });

        //endComments

        // Route::resource('/comments', CommentsController::class);

        //Discounts

        Route::prefix('/quan-ly-ma-giam-gia')->name('discounts.')->group(function () {

            Route::get('/', [DiscountsController::class, 'index'])->name('index');

            Route::get('/thung-rac', [DiscountsController::class, 'trash'])->name('trash');
            Route::post('/search', [DiscountsController::class, 'search'])->name('search');

            Route::get('/them-moi', [DiscountsController::class, 'create'])->name('create');
            Route::post('/them-moi', [DiscountsController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [DiscountsController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [DiscountsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [DiscountsController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [DiscountsController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [DiscountsController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [DiscountsController::class, 'importExcel']);

            Route::get('/export-excel', [DiscountsController::class, 'exportExcel'])->name('export-excel');
        });

        //endDiscounts

        // Route::resource('/discounts', DiscountsController::class);

        //Categories

        Route::prefix('/quan-ly-danh-muc-san-pham')->name('categories.')->group(function () {

            Route::get('/', [CategoriesController::class, 'index'])->name('index');

            Route::get('/thung-rac', [CategoriesController::class, 'trash'])->name('trash');
            Route::post('/search', [CategoriesController::class, 'search'])->name('search');

            Route::get('/them-moi', [CategoriesController::class, 'create'])->name('create');
            Route::post('/them-moi', [CategoriesController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [CategoriesController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [CategoriesController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [CategoriesController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [CategoriesController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [CategoriesController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [CategoriesController::class, 'importExcel']);

            Route::get('/export-excel', [CategoriesController::class, 'exportExcel'])->name('export-excel');
        });

        //endCategories

        // Route::resource('/categories', CategoriesController::class);

        //PaymentMethods

        Route::prefix('/quan-ly-phuong-thuc-thanh-toan')->name('payment_methods.')->group(function () {

            Route::get('/', [PaymentMethodsController::class, 'index'])->name('index');

            Route::get('/thung-rac', [PaymentMethodsController::class, 'trash'])->name('trash');
            Route::post('/search', [PaymentMethodsController::class, 'search'])->name('search');

            Route::get('/them-moi', [PaymentMethodsController::class, 'create'])->name('create');
            Route::post('/themmoi', [PaymentMethodsController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [PaymentMethodsController::class, 'edit'])->name('edit');
            Route::post('/capnhat/{id}', [PaymentMethodsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [PaymentMethodsController::class, 'destroy'])->name('delete');

            Route::get('/pdf', [PaymentMethodsController::class, 'viewPDF'])->name('pdf');

            Route::get('/import-excel', [PaymentMethodsController::class, 'index'])->name('import-excel');
            Route::post('/import-excel', [PaymentMethodsController::class, 'importExcel']);

            Route::get('/export-excel', [PaymentMethodsController::class, 'exportExcel'])->name('export-excel');
        });

        //endPaymentMethods

        // Route::resource('/payment_methods', PaymentMethodsController::class);

        //SlideShows

        Route::prefix('/quan-ly-slideshow')->name('slideshows.')->group(function () {
            Route::get('/', [SlideShowsController::class, 'index'])->name('index');
            Route::get('/thung-rac', [SlideShowsController::class, 'trash'])->name('trash');

            Route::get('/them-moi', [SlideShowsController::class, 'create'])->name('create');
            Route::post('/them-moi', [SlideShowsController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [SlideShowsController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [SlideShowsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [SlideShowsController::class, 'destroy'])->name('delete');
        });

        //endSlideShows

        // Route::resource('/slideshows', SlideShows::class);

        //Colors

        Route::prefix('/quan-ly-mau-sac')->name('colors.')->group(function () {

            Route::get('/', [ColorsController::class, 'index'])->name('index');

            Route::get('/thung-rac', [ColorsController::class, 'trash'])->name('trash');
            Route::post('/search', [ColorsController::class, 'search'])->name('search');

            Route::get('/them-moi', [ColorsController::class, 'create'])->name('create');
            Route::post('/them-moi', [ColorsController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [ColorsController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [ColorsController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [ColorsController::class, 'destroy'])->name('delete');
        });

        //endColors

        // Route::resource('/colors', ColorsController::class);

        //Sizes

        Route::prefix('/quan-ly-kich-co')->name('sizes.')->group(function () {

            Route::get('/', [SizesController::class, 'index'])->name('index');

            Route::get('/thung-rac', [SizesController::class, 'trash'])->name('trash');
            Route::post('/search', [SizesController::class, 'search'])->name('search');

            Route::get('/them-moi', [SizesController::class, 'create'])->name('create');
            Route::post('/them-moi', [SizesController::class, 'store'])->name('store');

            Route::get('/cap-nhat/{id}', [SizesController::class, 'edit'])->name('edit');
            Route::post('/cap-nhat/{id}', [SizesController::class, 'update'])->name('update');

            Route::get('/delete/{id}', [SizesController::class, 'destroy'])->name('delete');
        });

        //endSizes

        // Route::resource('/sizes', SizesController::class);
    });
});
