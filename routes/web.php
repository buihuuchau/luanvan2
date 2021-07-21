<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';

// XAC THUC EMAIL
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// XAC THUC EMAIL

// QUAN LY QUAN
Route::prefix('/')->group(function () {
    Route::get('/dangnhapquan', function () {
        return view('auth.login');
    });

    // Route::get('/dangkyquan', [
    //     'as' => 'dangkyquan',
    //     'uses' => 'App\Http\Controllers\quanController@dangkyquan'
    // ]);
    // Route::post('/dodangkyquan', [
    //     'as' => 'dodangkyquan',
    //     'uses' => 'App\Http\Controllers\quanController@dodangkyquan'
    // ]);
    // Route::get('/dangnhapquan', [
    //     'as' => 'dangnhapquan',
    //     'uses' => 'App\Http\Controllers\quanController@dangnhapquan'
    // ]); 
    // Route::post('/dodangnhapquan', [
    //     'as' => 'dodangnhapquan',
    //     'uses' => 'App\Http\Controllers\quanController@dodangnhapquan'
    // ]);
    Route::get('/thongtinquan', [
        'as' => 'thongtinquan',
        'uses' => 'App\Http\Controllers\quanController@thongtinquan',
        'middleware' => (['auth','verified'])
    ]);
    // Route::get('/dangxuatquan', [
    //     'as' => 'dangxuatquan',
    //     'uses' => 'App\Http\Controllers\quanController@dangxuatquan'
    // ]);
    Route::post('/suathongtinquan', [
        'as' => 'suathongtinquan',
        'uses' => 'App\Http\Controllers\quanController@suathongtinquan',
        'middleware' => (['auth','verified'])
    ]);
    // Route::post('/doimatkhauquan', [
    //     'as' => 'doimatkhauquan',
    //     'uses' => 'App\Http\Controllers\quanController@doimatkhauquan'
    // ]);
});
// QUAN LY QUAN

// QUAN LY THANH VIEN
Route::prefix('/')->group(function () {
    Route::get('/quanlythanhvien', [
        'as' => 'quanlythanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@quanlythanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/addthanhvien', [
        'as' => 'addthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@addthanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::post('/doaddthanhvien', [
        'as' => 'doaddthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doaddthanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/editthongtinthanhvien/{id}', [
        'as' => 'editthongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@editthongtinthanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::post('/doeditthongtinthanhvien', [
        'as' => 'doeditthongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doeditthongtinthanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::post('/editmatkhau', [
        'as' => 'editmatkhau',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@editmatkhau',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/kichhoatthanhvien/{id}', [
        'as' => 'kichhoatthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@kichhoatthanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/vohieuhoathanhvien/{id}', [
        'as' => 'vohieuhoathanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@vohieuhoathanhvien',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/deletethongtinthanhvien/{id}', [
        'as' => 'deletethongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@deletethongtinthanhvien',
        'middleware' => (['auth','verified'])
    ]);


    Route::get('/', [
        'as' => 'dangnhapthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@dangnhapthanhvien'
    ]);
    Route::post('/dodangnhapthanhvien', [
        'as' => 'dodangnhapthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@dodangnhapthanhvien'
    ]);
    Route::get('/thongtinthanhvien', [
        'as' => 'thongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@thongtinthanhvien',
        'middleware' => 'Login::class'
    ]);
    Route::get('/dangxuatthanhvien', [
        'as' => 'dangxuatthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@dangxuatthanhvien',
        'middleware' => 'Login::class'
    ]);       
    Route::post('/suathongtinthanhvien', [
        'as' => 'suathongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@suathongtinthanhvien',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doimatkhau', [
        'as' => 'doimatkhau',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doimatkhau',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY THANH VIEN

// QUAN LY KHACH HANG
Route::prefix('/')->group(function () {
    Route::get('/quanlykhachhang', [
        'as' => 'quanlykhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@quanlykhachhang',
        'middleware' => 'XemKhachhang::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addkhachhang', [
    //     'as' => 'addkhachhang',
    //     'uses' => 'App\Http\Controllers\quanlykhachhangController@addkhachhang'
    // ]);
    Route::post('/doaddkhachhang', [
        'as' => 'doaddkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@doaddkhachhang',
        'middleware' => 'ThemKhachhang::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editkhachhang/{id}', [
        'as' => 'editkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@editkhachhang',
        'middleware' => 'SuaKhachhang::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditkhachhang', [
        'as' => 'doeditkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@doeditkhachhang',
        'middleware' => 'SuaKhachhang::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY KHACH HANG

// QUAN LY KHU VUC
Route::prefix('/')->group(function () {
    Route::get('/quanlykhuvuc', [
        'as' => 'quanlykhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@quanlykhuvuc',
        'middleware' => 'XemKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addkhuvuc', [
    //     'as' => 'addkhuvuc',
    //     'uses' => 'App\Http\Controllers\quanlykhuvucController@addkhuvuc'
    // ]);
    Route::post('/doaddkhuvuc', [
        'as' => 'doaddkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@doaddkhuvuc',
        'middleware' => 'ThemKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editkhuvuc/{id}', [
        'as' => 'editkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@editkhuvuc',
        'middleware' => 'SuaKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditkhuvuc', [
        'as' => 'doeditkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@doeditkhuvuc',
        'middleware' => 'SuaKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hiddenkhuvuc/{id}', [
        'as' => 'hiddenkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@hiddenkhuvuc',
        'middleware' => 'SuaKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/showkhuvuc/{id}', [
        'as' => 'showkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@showkhuvuc',
        'middleware' => 'SuaKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletekhuvuc/{id}', [
        'as' => 'deletekhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@deletekhuvuc',
        'middleware' => 'XoaKhuvuc::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY KHU VUC

// QUAN LY BAN
Route::prefix('/')->group(function () {
    Route::get('/quanlyban', [
        'as' => 'quanlyban',
        'uses' => 'App\Http\Controllers\quanlybanController@quanlyban',
        'middleware' => 'XemBan::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addban', [
    //     'as' => 'addban',
    //     'uses' => 'App\Http\Controllers\quanlybanController@addban'
    // ]);
    Route::post('/doaddban', [
        'as' => 'doaddban',
        'uses' => 'App\Http\Controllers\quanlybanController@doaddban',
        'middleware' => 'ThemBan::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editban/{id}', [
        'as' => 'editban',
        'uses' => 'App\Http\Controllers\quanlybanController@editban',
        'middleware' => 'SuaBan::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditban', [
        'as' => 'doeditban',
        'uses' => 'App\Http\Controllers\quanlybanController@doeditban',
        'middleware' => 'SuaBan::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hiddenban/{id}', [
        'as' => 'hiddenban',
        'uses' => 'App\Http\Controllers\quanlybanController@hiddenban',
        'middleware' => 'SuaBan::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/showban/{id}', [
        'as' => 'showban',
        'uses' => 'App\Http\Controllers\quanlybanController@showban',
        'middleware' => 'SuaBan::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deleteban/{id}', [
        'as' => 'deleteban',
        'uses' => 'App\Http\Controllers\quanlybanController@deleteban',
        'middleware' => 'XoaBan::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY BAN

// QUAN LY NGUYEN LIEU
Route::prefix('/')->group(function () {
    Route::get('/quanlynguyenlieu', [
        'as' => 'quanlynguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@quanlynguyenlieu',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addnguyenlieu', [
    //     'as' => 'addnguyenlieu',
    //     'uses' => 'App\Http\Controllers\quanlynguyenlieuController@addnguyenlieu'
    // ]);
    Route::post('/doaddnguyenlieu', [
        'as' => 'doaddnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@doaddnguyenlieu',
        'middleware' => 'ThemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editnguyenlieu/{id}', [
        'as' => 'editnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@editnguyenlieu',
        'middleware' => 'SuaNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditnguyenlieu', [
        'as' => 'doeditnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@doeditnguyenlieu',
        'middleware' => 'SuaNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hiddennguyenlieu/{id}', [
        'as' => 'hiddennguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@hiddennguyenlieu',
        'middleware' => 'SuaNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/shownguyenlieu/{id}', [
        'as' => 'shownguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@shownguyenlieu',
        'middleware' => 'SuaNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletenguyenlieu/{id}', [
        'as' => 'deletenguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@deletenguyenlieu',
        'middleware' => 'XoaNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
});   
// QUAN LY NGUYEN LIEU

// QUAN LY KHO
Route::prefix('/')->group(function () {
    Route::get('/quanlykho', [
        'as' => 'quanlykho',
        'uses' => 'App\Http\Controllers\quanlykhoController@quanlykho',
        'middleware' => 'XemKho::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addkho', [
    //     'as' => 'addkho',
    //     'uses' => 'App\Http\Controllers\quanlykhoController@addkho'
    // ]);
    Route::post('/doaddkho', [
        'as' => 'doaddkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@doaddkho',
        'middleware' => 'ThemKho::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hethangkho/{id}', [
        'as' => 'hethangkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@hethangkho',
        'middleware' => 'SuaKho::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/conhangkho/{id}', [
        'as' => 'conhangkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@conhangkho',
        'middleware' => 'SuaKho::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletekho/{id}', [
        'as' => 'deletekho',
        'uses' => 'App\Http\Controllers\quanlykhoController@deletekho',
        'middleware' => 'XoaKho::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY KHO

// QUAN LY CA LAM
Route::prefix('/')->group(function () {
    Route::get('/quanlycalam', [
        'as' => 'quanlycalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@quanlycalam',
        'middleware' => 'XemCalam::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addcalam', [
    //     'as' => 'addcalam',
    //     'uses' => 'App\Http\Controllers\quanlycalamController@addcalam'
    // ]);
    Route::post('/doaddcalam', [
        'as' => 'doaddcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@doaddcalam',
        'middleware' => 'ThemCalam::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editcalam/{id}', [
        'as' => 'editcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@editcalam',
        'middleware' => 'SuaCalam::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditcalam', [
        'as' => 'doeditcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@doeditcalam',
        'middleware' => 'SuaCalam::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hiddencalam/{id}', [
        'as' => 'hiddencalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@hiddencalam',
        'middleware' => 'SuaCalam::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/showcalam/{id}', [
        'as' => 'showcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@showcalam',
        'middleware' => 'SuaCalam::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletecalam/{id}', [
        'as' => 'deletecalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@deletecalam',
        'middleware' => 'XoaCalam::class',
        'middleware' => 'Login::class'
    ]);
});   
// QUAN LY CA LAM

// QUAN LY LICH LAM VIEC
Route::prefix('/')->group(function () {
    Route::get('/quanlylichlamviec', [
        'as' => 'quanlylichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@quanlylichlamviec',
        'middleware' => 'XemLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/xemlichlamviec', [
        'as' => 'xemlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@xemlichlamviec',
        'middleware' => 'XemLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/diemdanhcomatlichlamviec/{id}', [
        'as' => 'diemdanhcomatlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@diemdanhcomatlichlamviec',
        'middleware' => 'SuaLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/diemdanhvangmatlichlamviec/{id}', [
        'as' => 'diemdanhvangmatlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@diemdanhvangmatlichlamviec',
        'middleware' => 'SuaLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editlichlamviec', [
        'as' => 'editlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@editlichlamviec',
        'middleware' => 'ThemLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/addlichlamviec', [
        'as' => 'addlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@addlichlamviec',
        'middleware' => 'ThemLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/changelichlamviec', [
        'as' => 'changelichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@changelichlamviec',
        'middleware' => 'XoaLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/copylichlamviec', [
        'as' => 'copylichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@copylichlamviec',
        'middleware' => 'SuaLichlamviec::class',
        'middleware' => 'Login::class'
    ]);
});  
// QUAN LY LICH LAM VIEC

//QUAN LY VAI TRO
Route::prefix('/')->group(function () {
    Route::get('/quanlyvaitro', [
        'as' => 'quanlyvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@quanlyvaitro',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/addvaitro', [
        'as' => 'addvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@addvaitro',
        'middleware' => (['auth','verified'])
    ]);
    Route::post('/doaddvaitro', [
        'as' => 'doaddvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@doaddvaitro',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/editvaitro/{id}', [
        'as' => 'editvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@editvaitro',
        'middleware' => (['auth','verified'])
    ]);
    Route::post('/doeditvaitro', [
        'as' => 'doeditvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@doeditvaitro',
        'middleware' => (['auth','verified'])
    ]);
    Route::get('/deletevaitro/{id}', [
        'as' => 'deletevaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@deletevaitro',
        'middleware' => (['auth','verified'])
    ]);
});
//QUAN LY VAI TRO

// QUAN LY THUC DON
Route::prefix('/')->group(function () {
    Route::get('/quanlythucdon', [
        'as' => 'quanlythucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@quanlythucdon',
        'middleware' => 'XemThucdon::class',
        'middleware' => 'Login::class'
    ]);
    // Route::get('/addthucdon', [
    //     'as' => 'addthucdon',
    //     'uses' => 'App\Http\Controllers\quanlythucdonController@addthucdon'
    // ]);
    Route::post('/doaddthucdon', [
        'as' => 'doaddthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@doaddthucdon',
        'middleware' => 'ThemThucdon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/editthucdon/{id}', [
        'as' => 'editthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@editthucdon',
        'middleware' => 'SuaThucdon::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/doeditthucdon', [
        'as' => 'doeditthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@doeditthucdon',
        'middleware' => 'SuaThucdon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/hiddenthucdon/{id}', [
        'as' => 'hiddenthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@hiddenthucdon',
        'middleware' => 'SuaThucdon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/showthucdon/{id}', [
        'as' => 'showthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@showthucdon',
        'middleware' => 'SuaThucdon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletethucdon/{id}', [
        'as' => 'deletethucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@deletethucdon',
        'middleware' => 'XoaThucdon::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY THUC DON

// DAT BAN / DAT MON
Route::prefix('/')->group(function () {
    Route::get('/hoadon', [
        'as' => 'hoadon',
        'uses' => 'App\Http\Controllers\orderController@hoadon',
        'middleware' => 'XemHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/xemban', [
        'as' => 'xemban',
        'uses' => 'App\Http\Controllers\orderController@xemban',
        'middleware' => 'XemHoadon::class',
        'middleware' => 'Login::class'
    ]);



    Route::get('/taohoadon', [
        'as' => 'taohoadon',
        'uses' => 'App\Http\Controllers\orderController@taohoadon',
        'middleware' => 'ThemHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/deletehoadon/{id}', [
        'as' => 'deletehoadon',
        'uses' => 'App\Http\Controllers\orderController@deletehoadon',
        'middleware' => 'XoaHoadon::class',
        'middleware' => 'Login::class'
    ]);

    
    
    Route::get('/doibanhoadon/{id}', [//idban
        'as' => 'doibanhoadon',
        'uses' => 'App\Http\Controllers\orderController@doibanhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/doikhuvuchoadon', [
        'as' => 'doikhuvuchoadon',
        'uses' => 'App\Http\Controllers\orderController@doikhuvuchoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/dodoibanhoadon', [
        'as' => 'dodoibanhoadon',
        'uses' => 'App\Http\Controllers\orderController@dodoibanhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);



    Route::get('/doimonhoadon/{id}', [//idban
        'as' => 'doimonhoadon',
        'uses' => 'App\Http\Controllers\orderController@doimonhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/datmon', [
        'as' => 'datmon',
        'uses' => 'App\Http\Controllers\orderController@datmon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/xoamonhoadon', [//idchitiet
        'as' => 'xoamonhoadon',
        'uses' => 'App\Http\Controllers\orderController@xoamonhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/doisoluongmonhoadon', [
        'as' => 'doisoluongmonhoadon',
        'uses' => 'App\Http\Controllers\orderController@doisoluongmonhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);



    Route::get('/tamtinhhoadon/{id}', [//idban
        'as' => 'tamtinhhoadon',
        'uses' => 'App\Http\Controllers\orderController@tamtinhhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/giamgia', [
        'as' => 'giamgia',
        'uses' => 'App\Http\Controllers\orderController@giamgia',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/thanhtoanhoadon', [
        'as' => 'thanhtoanhoadon',
        'uses' => 'App\Http\Controllers\orderController@thanhtoanhoadon',
        'middleware' => 'SuaHoadon::class',
        'middleware' => 'Login::class'
    ]);
});
// DAT BAN / DAT MON

// QUAN LY CHE BIEN
Route::prefix('/')->group(function () {
    Route::get('/quanlychebien', [
        'as' => 'quanlychebien',
        'uses' => 'App\Http\Controllers\quanlychebienController@quanlychebien',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/checkhoanthanh/{id}', [
        'as' => 'checkhoanthanh',
        'uses' => 'App\Http\Controllers\quanlychebienController@checkhoanthanh',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/baohuy/{id}', [
        'as' => 'baohuy',
        'uses' => 'App\Http\Controllers\quanlychebienController@baohuy',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/baohetnguyenlieu', [
        'as' => 'baohetnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlychebienController@baohetnguyenlieu',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/dobaohetnguyenlieu/{id}', [
        'as' => 'dobaohetnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlychebienController@dobaohetnguyenlieu',
        'middleware' => 'XemNguyenlieu::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY CHE BIEN

// QUAN LY HOA DON
Route::prefix('/')->group(function () {
    Route::get('/quanlyhoadon', [
        'as' => 'quanlyhoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@quanlyhoadon',
        'middleware' => 'XemHoadon::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/xemhoadon/{id}', [
        'as' => 'xemhoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@xemhoadon',
        'middleware' => 'XemHoadon::class',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY HOA DON

// QUAN LY NGAN SACH
Route::prefix('/')->group(function () {
    Route::get('/quanlyngansach', [
        'as' => 'quanlyngansach',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlyngansach',
        'middleware' => 'Quanlyngansach::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/quanlynhaphang', [
        'as' => 'quanlynhaphang',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlynhaphang',
        'middleware' => 'Quanlynhaphang::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/quanlybanhang', [
        'as' => 'quanlybanhang',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlybanhang',
        'middleware' => 'Quanlybanhang::class',
        'middleware' => 'Login::class'
    ]);
    Route::post('/quanlyluong', [
        'as' => 'quanlyluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlyluong',
        'middleware' => 'Quanlyluongnhanvien::class',
        'middleware' => 'Login::class'
    ]);
    Route::get('/chitietluong', [
        'as' => 'chitietluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@chitietluong',
        'middleware' => 'Login::class'
    ]);
    Route::get('/xemchitietluong', [
        'as' => 'xemchitietluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@xemchitietluong',
        'middleware' => 'Login::class'
    ]);
});
// QUAN LY NGAN SACH