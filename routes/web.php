<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\Controller@product') -> name('product');
Route::get('/product/categories/{id}','App\Http\Controllers\Controller@categories')->name('categories');
Route::get('/sale-off', 'App\Http\Controllers\Controller@saleoff') -> name('sale-off');
Route::get('/categories/detail/{id}','App\Http\Controllers\Controller@detail')->name('detail');
Route::get('/cart','App\Http\Controllers\Controller@cart') ->middleware(['auth'])->name('cart');
Route::get('/cartmain','App\Http\Controllers\Controller@cartmain')->name('cartmain');
Route::post('/cart/add','App\Http\Controllers\Controller@cartadd') ->middleware(['auth'])->name('cartadd');
Route::post('/cart/ad','App\Http\Controllers\Controller@cartad') ->middleware(['auth'])->name('cartad');
Route::post('/cart/delete','App\Http\Controllers\Controller@cartdelete') ->middleware(['auth'])->name('cartdelete');
Route::post('/order','App\Http\Controllers\Controller@order') ->middleware(['auth'])->name('order');
Route::post('/order/save1','App\Http\Controllers\Controller@store_user') ->middleware(['auth'])->name('store_user');
Route::post('/order/save2','App\Http\Controllers\Controller@store_order')->middleware(['auth'])->name('ordersave');
Route::get('/about-us', 'App\Http\Controllers\Controller@aboutus') -> name('about-us');
Route::get('/baoquan', 'App\Http\Controllers\Controller@baoquan') -> name('baoquan');
Route::get('/doitra', 'App\Http\Controllers\Controller@doitra') -> name('doitra');
Route::get('/chinhsachthanhtoan', 'App\Http\Controllers\Controller@chinhsachtt') -> name('chinhsachtt');
Route::get('/baomat', 'App\Http\Controllers\Controller@baomat') -> name('baomat');

//khách hàng quản lý thông tin cá nhân
Route::get('/profile', 'App\Http\Controllers\Controller@manager_user') ->middleware(['auth']) -> name('manager_user');
Route::get('/profile/edit', 'App\Http\Controllers\Controller@editProfile')->middleware(['auth'])->name('editProfile');
Route::post('/profile/update', 'App\Http\Controllers\Controller@updateProfile')->middleware(['auth'])->name('updateProfile');
require __DIR__.'/auth.php';

//comment
Route::post('/comment/{id}','App\Http\Controllers\Controller@postcomment')->middleware(['auth'])->name('comment');
//Route::post('/comment/blog/{id}','App\Http\Controllers\Controller@blogcomment')->middleware(['auth'])->name('blogcomment');

//google
Route::get('auth/google',[GoogleController::class,'googlepage'])->name('facebookpage');
Route::get('auth/google/callback',[GoogleController::class,'googlecallback'])->name('googlecallback');

//facebook
Route::get('auth/facebook',[FacebookController::class,'facebookpage'])->name('facebookpage');
Route::get('auth/facebook/callback',[FacebookController::class,'facebookcallback'])->name('facebookcallback');

//admin quản lý sản phẩm
Route::get('/admin/product','App\Http\Controllers\Controller@adminproduct') ->middleware('auth')->name('adminproduct');
Route::get('/product/add','App\Http\Controllers\Controller@productadd') ->middleware('auth')->name("productadd");
Route::post('/product/save/{action}','App\Http\Controllers\Controller@productsave') ->middleware('auth')->name("productsave");
Route::get('/product/edit/{id}','App\Http\Controllers\Controller@productedit') ->middleware('auth')->name("productedit");
Route::post('/product/delete','App\Http\Controllers\Controller@productdelete') ->middleware('auth')->name("productdelete");

//search
Route::get('/search','App\Http\Controllers\Controller@search') ->name('searchproduct');

// admin quản lý khách hàng
Route::get('/user/list','App\Http\Controllers\Controller@list_user') ->middleware('auth')->name('list_user');

// quản lý admin
Route::get('/admin/list','App\Http\Controllers\Controller@list_admin') ->middleware('auth')->name('list_admin');
Route::get('/admin/create','App\Http\Controllers\Controller@admincreate') ->middleware('auth')->name("admincreate");
Route::post('/admin/save/{action}','App\Http\Controllers\Controller@adminsave') ->middleware('auth')->name("adminsave");
Route::get('/admin/edit/{id}','App\Http\Controllers\Controller@adminedit') ->middleware('auth')->name("adminedit");
Route::post('/admin/delete','App\Http\Controllers\Controller@admindelete') ->middleware('auth')->name("admindelete");

//danh mục blog
Route::get('/blog/cat/{id}','App\Http\Controllers\Controller@cate_blog')->name('cate_blog');
Route::get('/blog/detail/{id}', 'App\Http\Controllers\Controller@blogDetail')->name('blogDetail');

//quản lý đơn hàng
Route::get('/admin/order','App\Http\Controllers\Controller@quanlyorder')->middleware(['auth'])->name("quanlyorder");
Route::post('/order/delete','App\Http\Controllers\Controller@order_delete')->middleware(['auth'])->name("order_delete");
Route::get('/order/edit','App\Http\Controllers\Controller@order_edit')->middleware(['auth'])->name("order_edit");
Route::post('/order/save','App\Http\Controllers\Controller@order_save')->middleware(['auth'])->name("order_save");


//quản lý blog
Route::get('/admin/blog','App\Http\Controllers\Controller@quanlyblog') ->middleware('auth')->name("quanlyblog");
Route::get('/blog/add','App\Http\Controllers\Controller@blogadd') ->middleware('auth')->name("blogadd");
Route::post('/blog/save/{action}','App\Http\Controllers\Controller@blogsave') ->middleware('auth')->name("blogsave");
Route::get('/blog/edit/{id}','App\Http\Controllers\Controller@blogedit') ->middleware('auth')->name("blogedit");
Route::post('/blog/delete','App\Http\Controllers\Controller@blogdelete') ->middleware('auth')->name("blogdelete");


//quản lý liên hệ
Route::get('/admin/contact','App\Http\Controllers\Controller@quanlycontact') ->middleware('auth')->name("quanlycontact");

//THỐNG KẾ
Route::get('/admin/dashboard','App\Http\Controllers\AdminController@dashboard') ->middleware('auth')->name('qldashboard');

//liên hệ
Route::get('/contact', 'App\Http\Controllers\Controller@contact')->name('contact');
Route::post('/contact/save', 'App\Http\Controllers\Controller@savecontact')->name('savecontact');

//Export Excel
Route::get('/export-product','App\Http\Controllers\ExcelController@exportproduct')->middleware('auth')->name('exportproduct');
Route::get('/export-user','App\Http\Controllers\ExcelController@exportuser')->middleware('auth')->name('exportuser');
Route::get('/export-order','App\Http\Controllers\ExcelController@exportorder')->middleware('auth')->name('exportorder');