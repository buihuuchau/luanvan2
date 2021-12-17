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

class quanlychebienController extends Controller
{
    public function quanlychebien()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $chitiet = DB::table('chitiet')
            ->orderBy('trangthai')
            ->orderBy('id')
            ->join('hoadon', 'chitiet.idhoadon', '=', 'hoadon.id')
            ->join('thucdon', 'chitiet.idthucdon', '=', 'thucdon.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->where('hoadon.idquan', $thanhvien->idquan)
            ->where('hoadon.trangthai', 0)
            ->select('chitiet.*', 'thucdon.tenmon', 'khuvuc.tenkhuvuc', 'ban.tenban')
            ->get();

        return view('chebien.quanlychebien', compact('thanhvien', 'chitiet'));
    }
    public function checkthuchien(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $check = DB::table('chitiet')
            ->where('id', $request->id)
            ->first();
        if (!$check) {
            return back()->withErrors(['Khách hàng đã hủy món này']);
        }
        if ($check->soluong != $request->soluong) {
            return back()->withErrors(['Có thay đổi về số lượng']);
        }

        $chitiet['trangthai'] = 1;
        DB::table('chitiet')
            ->where('id', $request->id)
            ->update($chitiet);
        return back();
    }
    public function checkhoanthanh(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $check = DB::table('chitiet')
            ->where('id', $request->id)
            ->first();
        if ($check->soluong == $request->thuchien) {
            $chitiet['thuchien'] = $request->thuchien;
            $chitiet['trangthai'] = 2;
            $chitiet['phucvu'] = 1;
            DB::table('chitiet')
                ->where('id', $request->id)
                ->where('trangthai', 1)
                ->update($chitiet);
            return back();
        } else {
            if ($check->thuchien + $request->thuchien == $check->soluong) {
                $chitiet['thuchien'] = $check->thuchien + $request->thuchien;
                $chitiet['trangthai'] = 2;
                $chitiet['phucvu'] = 1;
                DB::table('chitiet')
                    ->where('id', $request->id)
                    ->where('trangthai', 1)
                    ->update($chitiet);
                return back();
            } else {
                $chitiet['thuchien'] = $check->thuchien + $request->thuchien;
                $chitiet['phucvu'] = 1;
                DB::table('chitiet')
                    ->where('id', $request->id)
                    ->where('trangthai', 1)
                    ->update($chitiet);
                return back();
            }
        }
    }
    public function baohuy($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $chitiet['trangthai'] = 3;
        $chitiet['ghichu'] = 'Hết nguyên liệu';
        DB::table('chitiet')
            ->where('id', $id)
            ->update($chitiet);
        return back();
    }
    public function baohetnguyenlieu()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $kho = DB::table('kho')
            ->where('kho.idquan', $thanhvien->idquan)
            ->where('trangthai', 1)
            ->join('nguyenlieu', 'kho.idnguyenlieu', '=', 'nguyenlieu.id')
            ->select('kho.*', 'nguyenlieu.tennguyenlieu', 'nguyenlieu.xuatxu', 'nguyenlieu.donvitinh')
            ->get();
        return view('chebien.baohetnguyenlieu', compact('thanhvien', 'kho'));
    }
    public function dobaohetnguyenlieu($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();
        $kho['trangthai'] = 2;
        DB::table('kho')
            ->where('idquan', $thanhvien->idquan)
            ->where('id', $id)
            ->update($kho);

        return back();
    }
}
