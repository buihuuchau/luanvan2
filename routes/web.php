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

require __DIR__ . '/auth.php';

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
        'middleware' => (['auth', 'verified'])
    ]);
    // Route::get('/dangxuatquan', [
    //     'as' => 'dangxuatquan',
    //     'uses' => 'App\Http\Controllers\quanController@dangxuatquan'
    // ]);
    Route::post('/suathongtinquan', [
        'as' => 'suathongtinquan',
        'uses' => 'App\Http\Controllers\quanController@suathongtinquan',
        'middleware' => (['auth', 'verified'])
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
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/addthanhvien', [
        'as' => 'addthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@addthanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/doaddthanhvien', [
        'as' => 'doaddthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doaddthanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/editthongtinthanhvien/{id}', [
        'as' => 'editthongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@editthongtinthanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/doeditthongtinthanhvien', [
        'as' => 'doeditthongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doeditthongtinthanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/editmatkhau', [
        'as' => 'editmatkhau',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@editmatkhau',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/kichhoatthanhvien/{id}', [
        'as' => 'kichhoatthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@kichhoatthanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/vohieuhoathanhvien/{id}', [
        'as' => 'vohieuhoathanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@vohieuhoathanhvien',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/deletethongtinthanhvien/{id}', [
        'as' => 'deletethongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@deletethongtinthanhvien',
        'middleware' => (['auth', 'verified'])
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
        'middleware' => (['Login'])
    ]);
    Route::get('/dangxuatthanhvien', [
        'as' => 'dangxuatthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@dangxuatthanhvien',
        'middleware' => (['Login'])
    ]);
    Route::post('/suathongtinthanhvien', [
        'as' => 'suathongtinthanhvien',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@suathongtinthanhvien',
        'middleware' => (['Login'])
    ]);
    Route::post('/doimatkhau', [
        'as' => 'doimatkhau',
        'uses' => 'App\Http\Controllers\quanlythanhvienController@doimatkhau',
        'middleware' => (['Login'])
    ]);
});
// QUAN LY THANH VIEN

// QUAN LY KHACH HANG
Route::prefix('/')->group(function () {
    Route::get('/quanlykhachhang', [
        'as' => 'quanlykhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@quanlykhachhang',
        'middleware' => (['Login', 'XemKhachhang'])
    ]);
    // Route::get('/addkhachhang', [
    //     'as' => 'addkhachhang',
    //     'uses' => 'App\Http\Controllers\quanlykhachhangController@addkhachhang'
    // ]);
    Route::post('/doaddkhachhang', [
        'as' => 'doaddkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@doaddkhachhang',
        'middleware' => (['Login', 'ThemKhachhang'])
    ]);
    Route::get('/editkhachhang/{id}', [
        'as' => 'editkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@editkhachhang',
        'middleware' => (['Login', 'SuaKhachhang'])
    ]);
    Route::post('/doeditkhachhang', [
        'as' => 'doeditkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@doeditkhachhang',
        'middleware' => (['Login', 'SuaKhachhang'])
    ]);
    Route::post('/doeditkhachhang', [
        'as' => 'doeditkhachhang',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@doeditkhachhang',
        'middleware' => (['Login', 'SuaKhachhang'])
    ]);
    Route::post('/tilegiamgia', [
        'as' => 'tilegiamgia',
        'uses' => 'App\Http\Controllers\quanlykhachhangController@tilegiamgia',
        'middleware' => (['Login', 'Quanlyngansach'])
    ]);
});
// QUAN LY KHACH HANG

// QUAN LY KHU VUC
Route::prefix('/')->group(function () {
    Route::get('/quanlykhuvuc', [
        'as' => 'quanlykhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@quanlykhuvuc',
        'middleware' => (['Login', 'XemKhuvuc'])
    ]);
    // Route::get('/addkhuvuc', [
    //     'as' => 'addkhuvuc',
    //     'uses' => 'App\Http\Controllers\quanlykhuvucController@addkhuvuc'
    // ]);
    Route::post('/doaddkhuvuc', [
        'as' => 'doaddkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@doaddkhuvuc',
        'middleware' => (['Login', 'ThemKhuvuc'])
    ]);
    // Route::get('/editkhuvuc/{id}', [
    //     'as' => 'editkhuvuc',
    //     'uses' => 'App\Http\Controllers\quanlykhuvucController@editkhuvuc',
    //     'middleware' => (['Login','SuaKhuvuc'])
    // ]);
    Route::post('/doeditkhuvuc', [
        'as' => 'doeditkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@doeditkhuvuc',
        'middleware' => (['Login', 'SuaKhuvuc'])
    ]);
    Route::get('/hiddenkhuvuc/{id}', [
        'as' => 'hiddenkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@hiddenkhuvuc',
        'middleware' => (['Login', 'SuaKhuvuc'])
    ]);
    Route::get('/showkhuvuc/{id}', [
        'as' => 'showkhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@showkhuvuc',
        'middleware' => (['Login', 'SuaKhuvuc'])
    ]);
    Route::get('/deletekhuvuc/{id}', [
        'as' => 'deletekhuvuc',
        'uses' => 'App\Http\Controllers\quanlykhuvucController@deletekhuvuc',
        'middleware' => (['Login', 'XoaKhuvuc'])
    ]);
});
// QUAN LY KHU VUC

// QUAN LY BAN
Route::prefix('/')->group(function () {
    Route::get('/quanlyban', [
        'as' => 'quanlyban',
        'uses' => 'App\Http\Controllers\quanlybanController@quanlyban',
        'middleware' => (['Login', 'XemBan'])
    ]);
    // Route::get('/addban', [
    //     'as' => 'addban',
    //     'uses' => 'App\Http\Controllers\quanlybanController@addban'
    // ]);
    Route::post('/doaddban', [
        'as' => 'doaddban',
        'uses' => 'App\Http\Controllers\quanlybanController@doaddban',
        'middleware' => (['Login', 'ThemBan'])
    ]);
    // Route::get('/editban/{id}', [
    //     'as' => 'editban',
    //     'uses' => 'App\Http\Controllers\quanlybanController@editban',
    //     'middleware' => (['Login','SuaBan'])
    // ]);
    Route::post('/doeditban', [
        'as' => 'doeditban',
        'uses' => 'App\Http\Controllers\quanlybanController@doeditban',
        'middleware' => (['Login', 'SuaBan'])
    ]);
    Route::get('/hiddenban/{id}', [
        'as' => 'hiddenban',
        'uses' => 'App\Http\Controllers\quanlybanController@hiddenban',
        'middleware' => (['Login', 'SuaBan'])
    ]);
    Route::get('/showban/{id}', [
        'as' => 'showban',
        'uses' => 'App\Http\Controllers\quanlybanController@showban',
        'middleware' => (['Login', 'SuaBan'])
    ]);
    Route::get('/deleteban/{id}', [
        'as' => 'deleteban',
        'uses' => 'App\Http\Controllers\quanlybanController@deleteban',
        'middleware' => (['Login', 'XoaBan'])
    ]);
});
// QUAN LY BAN

// QUAN LY NGUYEN LIEU
Route::prefix('/')->group(function () {
    Route::get('/quanlynguyenlieu', [
        'as' => 'quanlynguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@quanlynguyenlieu',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    // Route::get('/addnguyenlieu', [
    //     'as' => 'addnguyenlieu',
    //     'uses' => 'App\Http\Controllers\quanlynguyenlieuController@addnguyenlieu'
    // ]);
    Route::post('/doaddnguyenlieu', [
        'as' => 'doaddnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@doaddnguyenlieu',
        'middleware' => (['Login', 'ThemNguyenlieu'])
    ]);
    // Route::get('/editnguyenlieu/{id}', [
    //     'as' => 'editnguyenlieu',
    //     'uses' => 'App\Http\Controllers\quanlynguyenlieuController@editnguyenlieu',
    //     'middleware' => (['Login','SuaNguyenlieu'])
    // ]);
    Route::post('/doeditnguyenlieu', [
        'as' => 'doeditnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@doeditnguyenlieu',
        'middleware' => (['Login', 'SuaNguyenlieu'])
    ]);
    Route::get('/hiddennguyenlieu/{id}', [
        'as' => 'hiddennguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@hiddennguyenlieu',
        'middleware' => (['Login', 'SuaNguyenlieu'])
    ]);
    Route::get('/shownguyenlieu/{id}', [
        'as' => 'shownguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@shownguyenlieu',
        'middleware' => (['Login', 'SuaNguyenlieu'])
    ]);
    Route::get('/deletenguyenlieu/{id}', [
        'as' => 'deletenguyenlieu',
        'uses' => 'App\Http\Controllers\quanlynguyenlieuController@deletenguyenlieu',
        'middleware' => (['Login', 'XoaNguyenlieu'])
    ]);
});
// QUAN LY NGUYEN LIEU

// QUAN LY KHO
Route::prefix('/')->group(function () {
    Route::get('/quanlykho', [
        'as' => 'quanlykho',
        'uses' => 'App\Http\Controllers\quanlykhoController@quanlykho',
        'middleware' => (['Login', 'XemKho'])
    ]);
    // Route::get('/addkho', [
    //     'as' => 'addkho',
    //     'uses' => 'App\Http\Controllers\quanlykhoController@addkho'
    // ]);
    Route::post('/doaddkho', [
        'as' => 'doaddkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@doaddkho',
        'middleware' => (['Login', 'ThemKho'])
    ]);
    Route::get('/hethangkho/{id}', [
        'as' => 'hethangkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@hethangkho',
        'middleware' => (['Login', 'SuaKho'])
    ]);
    Route::get('/conhangkho/{id}', [
        'as' => 'conhangkho',
        'uses' => 'App\Http\Controllers\quanlykhoController@conhangkho',
        'middleware' => (['Login', 'SuaKho'])
    ]);
    Route::get('/deletekho/{id}', [
        'as' => 'deletekho',
        'uses' => 'App\Http\Controllers\quanlykhoController@deletekho',
        'middleware' => (['Login', 'XoaKho'])
    ]);
});
// QUAN LY KHO

// QUAN LY CA LAM
Route::prefix('/')->group(function () {
    Route::get('/quanlycalam', [
        'as' => 'quanlycalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@quanlycalam',
        'middleware' => (['Login', 'XemCalam'])
    ]);
    // Route::get('/addcalam', [
    //     'as' => 'addcalam',
    //     'uses' => 'App\Http\Controllers\quanlycalamController@addcalam'
    // ]);
    Route::post('/doaddcalam', [
        'as' => 'doaddcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@doaddcalam',
        'middleware' => (['Login', 'ThemCalam'])
    ]);
    // Route::get('/editcalam/{id}', [
    //     'as' => 'editcalam',
    //     'uses' => 'App\Http\Controllers\quanlycalamController@editcalam',
    //     'middleware' => (['Login','SuaCalam'])
    // ]);
    Route::post('/doeditcalam', [
        'as' => 'doeditcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@doeditcalam',
        'middleware' => (['Login', 'SuaCalam'])
    ]);
    Route::get('/hiddencalam/{id}', [
        'as' => 'hiddencalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@hiddencalam',
        'middleware' => (['Login', 'SuaCalam'])
    ]);
    Route::get('/showcalam/{id}', [
        'as' => 'showcalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@showcalam',
        'middleware' => (['Login', 'SuaCalam'])
    ]);
    Route::get('/deletecalam/{id}', [
        'as' => 'deletecalam',
        'uses' => 'App\Http\Controllers\quanlycalamController@deletecalam',
        'middleware' => (['Login', 'XoaCalam'])
    ]);
});
// QUAN LY CA LAM

// QUAN LY LICH LAM VIEC
Route::prefix('/')->group(function () {
    Route::get('/quanlylichlamviec', [
        'as' => 'quanlylichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@quanlylichlamviec',
        'middleware' => (['Login', 'XemLichlamviec'])
    ]);
    Route::get('/xemlichlamviec', [
        'as' => 'xemlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@xemlichlamviec',
        'middleware' => (['Login', 'XemLichlamviec'])
    ]);
    Route::get('/diemdanhcomatlichlamviec/{id}', [
        'as' => 'diemdanhcomatlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@diemdanhcomatlichlamviec',
        'middleware' => (['Login', 'SuaLichlamviec'])
    ]);
    Route::get('/diemdanhvangmatlichlamviec/{id}', [
        'as' => 'diemdanhvangmatlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@diemdanhvangmatlichlamviec',
        'middleware' => (['Login', 'SuaLichlamviec'])
    ]);
    Route::get('/editlichlamviec', [
        'as' => 'editlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@editlichlamviec',
        'middleware' => (['Login', 'ThemLichlamviec'])
    ]);
    Route::get('/addlichlamviec', [
        'as' => 'addlichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@addlichlamviec',
        'middleware' => (['Login', 'ThemLichlamviec'])
    ]);
    Route::get('/changelichlamviec', [
        'as' => 'changelichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@changelichlamviec',
        'middleware' => (['Login', 'XoaLichlamviec'])
    ]);
    Route::get('/copylichlamviec', [
        'as' => 'copylichlamviec',
        'uses' => 'App\Http\Controllers\quanlylichlamviecController@copylichlamviec',
        'middleware' => (['Login', 'SuaLichlamviec'])
    ]);
});
// QUAN LY LICH LAM VIEC

//QUAN LY VAI TRO
Route::prefix('/')->group(function () {
    Route::get('/quanlyvaitro', [
        'as' => 'quanlyvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@quanlyvaitro',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/addvaitro', [
        'as' => 'addvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@addvaitro',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/doaddvaitro', [
        'as' => 'doaddvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@doaddvaitro',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/editvaitro/{id}', [
        'as' => 'editvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@editvaitro',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::post('/doeditvaitro', [
        'as' => 'doeditvaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@doeditvaitro',
        'middleware' => (['auth', 'verified'])
    ]);
    Route::get('/deletevaitro/{id}', [
        'as' => 'deletevaitro',
        'uses' => 'App\Http\Controllers\quanlyvaitroController@deletevaitro',
        'middleware' => (['auth', 'verified'])
    ]);
});
//QUAN LY VAI TRO

// QUAN LY THUC DON
Route::prefix('/')->group(function () {
    Route::get('/quanlythucdon', [
        'as' => 'quanlythucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@quanlythucdon',
        'middleware' => (['Login', 'XemThucdon'])
    ]);
    // Route::get('/addthucdon', [
    //     'as' => 'addthucdon',
    //     'uses' => 'App\Http\Controllers\quanlythucdonController@addthucdon'
    // ]);
    Route::post('/doaddthucdon', [
        'as' => 'doaddthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@doaddthucdon',
        'middleware' => (['Login', 'ThemThucdon'])
    ]);
    // Route::get('/editthucdon/{id}', [
    //     'as' => 'editthucdon',
    //     'uses' => 'App\Http\Controllers\quanlythucdonController@editthucdon',
    //     'middleware' => (['Login','SuaThucdon'])
    // ]);
    Route::post('/doeditthucdon', [
        'as' => 'doeditthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@doeditthucdon',
        'middleware' => (['Login', 'SuaThucdon'])
    ]);
    Route::get('/hiddenthucdon/{id}', [
        'as' => 'hiddenthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@hiddenthucdon',
        'middleware' => (['Login', 'SuaThucdon'])
    ]);
    Route::get('/showthucdon/{id}', [
        'as' => 'showthucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@showthucdon',
        'middleware' => (['Login', 'SuaThucdon'])
    ]);
    Route::get('/deletethucdon/{id}', [
        'as' => 'deletethucdon',
        'uses' => 'App\Http\Controllers\quanlythucdonController@deletethucdon',
        'middleware' => (['Login', 'XoaThucdon'])
    ]);
});
// QUAN LY THUC DON

// DAT BAN / DAT MON
Route::prefix('/')->group(function () {
    Route::get('/hoadon', [
        'as' => 'hoadon',
        'uses' => 'App\Http\Controllers\orderController@hoadon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::get('/xemban', [
        'as' => 'xemban',
        'uses' => 'App\Http\Controllers\orderController@xemban',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::get('/xemmon', [
        'as' => 'xemmon',
        'uses' => 'App\Http\Controllers\orderController@xemmon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);


    Route::get('/taohoadon', [
        'as' => 'taohoadon',
        'uses' => 'App\Http\Controllers\orderController@taohoadon',
        'middleware' => (['Login', 'ThemHoadon'])
    ]);
    Route::get('/deletehoadon/{id}', [
        'as' => 'deletehoadon',
        'uses' => 'App\Http\Controllers\orderController@deletehoadon',
        'middleware' => (['Login', 'XoaHoadon'])
    ]);



    Route::get('/doibanhoadon/{id}', [ //idban
        'as' => 'doibanhoadon',
        'uses' => 'App\Http\Controllers\orderController@doibanhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/doikhuvuchoadon', [
        'as' => 'doikhuvuchoadon',
        'uses' => 'App\Http\Controllers\orderController@doikhuvuchoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/dodoibanhoadon', [
        'as' => 'dodoibanhoadon',
        'uses' => 'App\Http\Controllers\orderController@dodoibanhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);



    Route::get('/doimonhoadon/{id}', [ //idban
        'as' => 'doimonhoadon',
        'uses' => 'App\Http\Controllers\orderController@doimonhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/datmon', [
        'as' => 'datmon',
        'uses' => 'App\Http\Controllers\orderController@datmon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/xoamonhoadon', [ //idchitiet
        'as' => 'xoamonhoadon',
        'uses' => 'App\Http\Controllers\orderController@xoamonhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/phucvumon', [ //idchitiet
        'as' => 'phucvumon',
        'uses' => 'App\Http\Controllers\orderController@phucvumon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/doisoluongmonhoadon', [
        'as' => 'doisoluongmonhoadon',
        'uses' => 'App\Http\Controllers\orderController@doisoluongmonhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);



    Route::get('/tamtinhhoadon/{id}', [ //idban
        'as' => 'tamtinhhoadon',
        'uses' => 'App\Http\Controllers\orderController@tamtinhhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/giamgia', [
        'as' => 'giamgia',
        'uses' => 'App\Http\Controllers\orderController@giamgia',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::post('/thanhtoanhoadon', [
        'as' => 'thanhtoanhoadon',
        'uses' => 'App\Http\Controllers\orderController@thanhtoanhoadon',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
});
// DAT BAN / DAT MON

// DAT BAN / DAT MON PHONE
Route::prefix('/')->group(function () {
    Route::get('/hoadonphone', [
        'as' => 'hoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@hoadonphone',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::get('/xembanphone', [
        'as' => 'xembanphone',
        'uses' => 'App\Http\Controllers\orderphoneController@xembanphone',
        'middleware' => (['Login', 'XemHoadon'])
    ]);



    Route::get('/taohoadonphone', [
        'as' => 'taohoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@taohoadonphone',
        'middleware' => (['Login', 'ThemHoadon'])
    ]);
    Route::get('/deletehoadonphone/{id}', [
        'as' => 'deletehoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@deletehoadonphone',
        'middleware' => (['Login', 'XoaHoadon'])
    ]);



    Route::get('/doibanhoadonphone/{id}', [ //idban
        'as' => 'doibanhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@doibanhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/doikhuvuchoadonphone', [
        'as' => 'doikhuvuchoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@doikhuvuchoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/dodoibanhoadonphone', [
        'as' => 'dodoibanhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@dodoibanhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);



    Route::get('/doimonhoadonphone/{id}', [ //idban
        'as' => 'doimonhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@doimonhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/datmonphone', [
        'as' => 'datmonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@datmonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/xoamonhoadonphone', [ //idchitiet
        'as' => 'xoamonhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@xoamonhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/phucvumonphone', [ //idchitiet
        'as' => 'phucvumonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@phucvumonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/doisoluongmonhoadonphone', [
        'as' => 'doisoluongmonhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@doisoluongmonhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);



    Route::get('/tamtinhhoadonphone/{id}', [ //idban
        'as' => 'tamtinhhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@tamtinhhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::get('/giamgiaphone', [
        'as' => 'giamgiaphone',
        'uses' => 'App\Http\Controllers\orderphoneController@giamgiaphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
    Route::post('/thanhtoanhoadonphone', [
        'as' => 'thanhtoanhoadonphone',
        'uses' => 'App\Http\Controllers\orderphoneController@thanhtoanhoadonphone',
        'middleware' => (['Login', 'SuaHoadon'])
    ]);
});
// DAT BAN / DAT MON PHONE

// QUAN LY CHE BIEN
Route::prefix('/')->group(function () {
    Route::get('/quanlychebien', [
        'as' => 'quanlychebien',
        'uses' => 'App\Http\Controllers\quanlychebienController@quanlychebien',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    Route::get('/checkthuchien/{id}', [
        'as' => 'checkthuchien',
        'uses' => 'App\Http\Controllers\quanlychebienController@checkthuchien',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    Route::get('/checkhoanthanh/{id}', [
        'as' => 'checkhoanthanh',
        'uses' => 'App\Http\Controllers\quanlychebienController@checkhoanthanh',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    Route::get('/baohuy/{id}', [
        'as' => 'baohuy',
        'uses' => 'App\Http\Controllers\quanlychebienController@baohuy',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    Route::get('/baohetnguyenlieu', [
        'as' => 'baohetnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlychebienController@baohetnguyenlieu',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
    Route::get('/dobaohetnguyenlieu/{id}', [
        'as' => 'dobaohetnguyenlieu',
        'uses' => 'App\Http\Controllers\quanlychebienController@dobaohetnguyenlieu',
        'middleware' => (['Login', 'XemNguyenlieu'])
    ]);
});
// QUAN LY CHE BIEN

// QUAN LY HOA DON
Route::prefix('/')->group(function () {
    Route::get('/quanlyhoadon', [
        'as' => 'quanlyhoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@quanlyhoadon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::post('/ghichuhoadon', [
        'as' => 'ghichuhoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@ghichuhoadon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::get('/xemhoadon/{id}', [
        'as' => 'xemhoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@xemhoadon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
    Route::get('/trangthaihoadon', [
        'as' => 'trangthaihoadon',
        'uses' => 'App\Http\Controllers\quanlyhoadonController@trangthaihoadon',
        'middleware' => (['Login', 'XemHoadon'])
    ]);
});
// QUAN LY HOA DON

// QUAN LY NGAN SACH
Route::prefix('/')->group(function () {
    Route::get('/quanlyngansach', [
        'as' => 'quanlyngansach',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlyngansach',
        'middleware' => (['Login', 'Quanlyngansach'])
    ]);
    Route::get('/quanlynhaphang', [
        'as' => 'quanlynhaphang',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlynhaphang',
        'middleware' => (['Login', 'Quanlynhaphang'])
    ]);
    Route::get('/quanlybanhang', [
        'as' => 'quanlybanhang',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlybanhang',
        'middleware' => (['Login', 'Quanlybanhang'])
    ]);
    Route::get('/quanlyluong', [
        'as' => 'quanlyluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@quanlyluong',
        'middleware' => (['Login', 'Quanlyluongnhanvien'])
    ]);
    Route::get('/chitietluong', [
        'as' => 'chitietluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@chitietluong',
        'middleware' => (['Login'])
    ]);
    Route::get('/xemchitietluong', [
        'as' => 'xemchitietluong',
        'uses' => 'App\Http\Controllers\quanlyngansachController@xemchitietluong',
        'middleware' => (['Login'])
    ]);
});
// QUAN LY NGAN SACH