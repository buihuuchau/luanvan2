<?php

namespace App\Http\Controllers;

use DB;
// use App\Traits\StorageImageTrait;
use Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class quanlyhoadonController extends Controller
{
    public function quanlyhoadon()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $hoadonluu = DB::table('hoadonluu')
            ->orderBy('thoigian', 'desc')
            ->where('idquan', $thanhvien->idquan)
            ->get();

        return view('hoadon.quanlyhoadon', compact('thanhvien', 'hoadonluu'));
    }

    public function ghichuhoadon(Request $request)
    {
        $hoadonluu['ghichu'] = $request->ghichu;
        DB::table('hoadonluu')->where('id', $request->id)->update($hoadonluu);
        return back();
    }

    public function xemhoadon($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name', 'users.diachiquan', 'users.website', 'users.sdtquan')
            ->first();
        // lay ben ngoai hoa don
        $hoadonluu1 = DB::table('hoadonluu')
            ->where('idquan', $thanhvien->idquan)
            ->where('id', $id)
            ->first();
        //lay chi tiet hoa don
        $hoadonluu2 = DB::table('hoadonluu')
            ->where('idquan', $thanhvien->idquan)
            ->where('idhoadon', $id)
            ->get();

        return view('hoadon.xemhoadon', compact('thanhvien', 'hoadonluu1', 'hoadonluu2'));
    }
    public function trangthaihoadon()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
        ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $hoadon = DB::table('hoadon')
        ->where('hoadon.idquan', $thanhvien->idquan)
            ->join('thanhvien', 'hoadon.idthanhvien', '=', 'thanhvien.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->select('hoadon.*', 'ban.tenban', 'khuvuc.tenkhuvuc', 'thanhvien.hoten')
            ->get();

        return view('hoadon.trangthaihoadon', compact('thanhvien', 'hoadon'));
    }
}
