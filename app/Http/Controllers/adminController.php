<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function adminlogin()
    {
        return view('admin.adminlogin');
    }
    public function admindologin(Request $request)
    {
        $check = DB::table('admin')
            ->where('acc', $request->acc)
            ->where('pass', md5($request->pass))
            ->first();
        if ($check) {
            $ssadmin = $check->id;
            Session::put('ssadmin', $ssadmin);
            return redirect()->route('adminview');
        } else {
            return back()->withErrors('Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function admindangxuat()
    {
        Session::forget('ssadmin');
        return redirect()->route('adminlogin');
    }
    public function adminview()
    {
        $ssadmin = Session::get('ssadmin');
        if (!$ssadmin) {
            return redirect()->route('adminlogin');
        }
        $users = DB::table('users')
            ->get();
        return view('admin.adminview', compact('users'));
    }
    public function adminkichhoat(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $users['email_verified_at'] = $dt->toDateTimeString();
        DB::table('users')
            ->where('id', $request->id)
            ->update($users);
        return back();
    }
    public function adminvohieuhoa(Request $request)
    {
        $users['email_verified_at'] = null;
        DB::table('users')
            ->where('id', $request->id)
            ->update($users);
        return back();
    }
    public function admindelete(Request $request)
    {
        $hoadon = DB::table('hoadon')
            ->where('idquan', $request->id)
            ->get();
        foreach ($hoadon as $rowhoadon) {
            DB::table('chitiet')
                ->where('idhoadon', $rowhoadon->id)
                ->delete();
        }
        DB::table('hoadon')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('ban')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('lichlamviec')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('calam')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('khuvuc')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('giamgia')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('khachhang')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('kho')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('nguyenlieu')
            ->where('idquan', $request->id)
            ->delete();

        DB::table('thucdon')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('luong')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('thanhvien')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('hoadonluu')
            ->where('idquan', $request->id)
            ->delete();
        $vaitro = DB::table('vaitro')
            ->where('idquan', $request->id)
            ->get();
        foreach ($vaitro as $rowvaitro) {
            DB::table('vaitro_quyen')
                ->where('idvaitro', $rowvaitro->id)
                ->delete();
        }
        DB::table('vaitro')
            ->where('idquan', $request->id)
            ->delete();
        DB::table('users')
            ->where('id', $request->id)
            ->delete();
        return back();
    }
}
