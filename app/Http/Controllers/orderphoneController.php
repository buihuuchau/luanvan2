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

class orderphoneController extends Controller
{
    public function hoadonphone()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $khuvuc = DB::table('khuvuc')
            ->orderBy('tenkhuvuc')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            ->get();
        $khuvuc2 = DB::table('khuvuc')
            ->orderBy('tenkhuvuc')
            ->where('idquan', $thanhvien->idquan)
            ->first();
        $ban = DB::table('ban')
            ->orderBy('tenban')
            ->where('idquan', $thanhvien->idquan)
            ->where('idkhuvuc', $khuvuc2->id)
            ->where('hidden', 0)
            ->get();

        $idkhuvuc = $khuvuc2->id;

        return view('orderphone.hoadonphone', compact('thanhvien', 'khuvuc', 'ban', 'idkhuvuc'));
    }
    public function xembanphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');
        $idkhuvuc = $request->idkhuvuc;

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $khuvuc = DB::table('khuvuc')
            ->orderBy('tenkhuvuc')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            ->get();
        $ban = DB::table('ban')
            ->orderBy('tenban')
            ->where('idquan', $thanhvien->idquan)
            ->where('idkhuvuc', $request->idkhuvuc)
            ->where('hidden', 0)
            ->get();

        return view('orderphone.hoadonphone', compact('thanhvien', 'khuvuc', 'ban', 'idkhuvuc'));
    }



    public function taohoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();
        $hoadon['idquan'] = $thanhvien->idquan;
        $hoadon['idkhuvuc'] = $request->idkhuvuc;
        $hoadon['idban'] = $request->idban;
        $hoadon['idthanhvien'] = $thanhvien->id;
        $hoadon['thoigian'] = date('Y-m-d H:i:s');
        $check = DB::table('ban')
            ->where('idquan', $thanhvien->idquan)
            ->where('id', $request->idban)
            ->where('trangthai', 1)
            ->first();
        if ($check) {
            return back()->withErrors(['Bàn đang bận, không thể tạo hóa đơn']);
        } else {
            $ban['trangthai'] = 1;
            DB::table('ban')
                ->where('id', $request->idban)
                ->update($ban);
            $id = DB::table('hoadon')->insertGetID($hoadon);
            return back();
        }
    }
    public function deletehoadonphone($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $hoadon = DB::table('hoadon')
            ->where('idquan', $thanhvien->idquan)
            ->where('idban', $id)
            ->where('trangthai', 0)
            ->first();
        $id = $hoadon->id;
        $idban = $hoadon->idban;

        $check = DB::table('chitiet')
            ->where('idhoadon', $id)
            ->first();
        if ($check) {
            return back()->withErrors(['Hóa đơn này không thể xóa']);
        } else {
            $ban['trangthai'] = 0;
            DB::table('ban')
                ->where('id', $idban)
                ->update($ban);
            DB::table('hoadon')
                ->where('idquan', $thanhvien->idquan)
                ->where('id', $id)
                ->delete();
            return back();
        }
    }



    public function doibanhoadonphone($id)
    { //idban
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $hoadon = DB::table('hoadon')
            ->where('idquan', $thanhvien->idquan)
            ->where('idban', $id)
            ->where('trangthai', 0)
            ->first();

        $id = $hoadon->id; //idhoadon
        $idkhuvuc = $hoadon->idkhuvuc;
        $idbancu = $hoadon->idban;

        $khuvuc = DB::table('khuvuc')
            ->orderBy('tenkhuvuc')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            ->get();

        $ban = DB::table('ban')
            ->orderBy('tenban')
            ->where('idquan', $thanhvien->idquan)
            ->where('idkhuvuc', $idkhuvuc)
            ->where('hidden', 0)
            ->where('trangthai', 0)
            ->get();

        return view('orderphone.doibanhoadonphone', compact('thanhvien', 'khuvuc', 'ban', 'id', 'idkhuvuc', 'idbancu'));
    }
    public function doikhuvuchoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();
        $id = $request->id; //idhoadon
        $idkhuvuc = $request->idkhuvuc;
        $idbancu = $request->idbancu;

        $khuvuc = DB::table('khuvuc')
            ->orderBy('tenkhuvuc')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            ->get();

        $ban = DB::table('ban')
            ->orderBy('tenban')
            ->where('idquan', $thanhvien->idquan)
            ->where('idkhuvuc', $idkhuvuc)
            ->where('hidden', 0)
            ->where('trangthai', 0)
            ->get();

        return view('orderphone.doibanhoadonphone', compact('thanhvien', 'khuvuc', 'ban', 'id', 'idkhuvuc', 'idbancu'));
    }
    public function dodoibanhoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();
        $id = $request->id; //idhoadon
        $idkhuvuc = $request->idkhuvuc;
        $idbancu = $request->idbancu;
        $idbanmoi = $request->idban;
        $bancu['trangthai'] = 0;
        $banmoi['trangthai'] = 1;
        DB::table('ban')
            ->where('id', $idbancu)
            ->update($bancu);

        DB::table('ban')
            ->where('id', $idbanmoi)
            ->update($banmoi);

        $hoadon['idkhuvuc'] = $idkhuvuc;
        $hoadon['idban'] = $idbanmoi;
        DB::table('hoadon')
            ->where('id', $id)
            ->update($hoadon);

        return redirect()->route('hoadonphone');
    }



    public function doimonhoadonphone($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $hoadon = DB::table('hoadon')
            ->where('hoadon.idquan', $thanhvien->idquan)
            ->where('hoadon.idban', $id)
            ->where('hoadon.trangthai', 0)
            ->join('khuvuc', 'khuvuc.id', '=', 'hoadon.idkhuvuc')
            ->join('ban', 'ban.id', '=', 'hoadon.idban')
            ->select('hoadon.*', 'khuvuc.tenkhuvuc', 'ban.tenban')
            ->first();
        $id = $hoadon->id; //idhoadon
        $tenkhuvuc = $hoadon->tenkhuvuc;
        $tenban = $hoadon->tenban;

        $thucdon = DB::table('thucdon')
            // ->orderBy('loaimon')
            ->orderBy('tenmon')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            // ->get();
            ->simplepaginate(20);
        $chitiet = DB::table('chitiet')
            ->orderBy('trangthai', 'desc')
            ->where('idhoadon', $id)
            ->join('thucdon', 'chitiet.idthucdon', '=', 'thucdon.id')
            ->select('chitiet.*', 'thucdon.tenmon', 'thucdon.dongia', 'thucdon.loaimon')
            ->get();
        return view('orderphone.datmonphone', compact('thanhvien', 'id', 'tenkhuvuc', 'tenban', 'thucdon', 'chitiet'));
    }
    public function datmonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $thucdon = DB::table('thucdon')
            // ->orderBy('loaimon')
            ->orderBy('tenmon')
            ->where('idquan', $thanhvien->idquan)
            ->where('hidden', 0)
            ->get();
        $id = $request->id; // idhoadon
        $idthucdon = $request->idthucdon;
        $soluong = $request->soluong;
        $ghichu = $request->ghichu;
        $chitiet2['idhoadon'] = $id;
        $chitiet2['idthucdon'] = $idthucdon;
        $chitiet2['soluong'] = $soluong;
        $chitiet2['ghichu'] = $request->ghichu;

        $thucdon2 = DB::table('thucdon')
            ->where('idquan', $thanhvien->idquan)
            ->where('id', $idthucdon)
            ->first();

        $chitiet2['gia'] = $thucdon2->dongia * $soluong;
        DB::table('chitiet')->insert($chitiet2);

        $chitiet = DB::table('chitiet')
            ->orderBy('trangthai', 'desc')
            ->where('idhoadon', $id)
            ->join('thucdon', 'chitiet.idthucdon', '=', 'thucdon.id')
            ->select('chitiet.*', 'thucdon.tenmon', 'thucdon.dongia', 'thucdon.loaimon')
            ->get();

        return back();
    }
    public function xoamonhoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $chitiet = DB::table('chitiet')
            ->where('id', $request->id)
            ->first();
        $hoadon = DB::table('hoadon')
            ->where('id', $chitiet->idhoadon)
            ->first();
        $idban = $hoadon->idban;

        DB::table('chitiet')
            ->where('id', $request->id)
            ->where('trangthai', 0)
            ->orWhere('trangthai', 3)
            ->delete();

        return back();
    }
    public function phucvumonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $chitiet['phucvu'] = 0;
        DB::table('chitiet')
            ->where('id', $request->id)
            ->update($chitiet);

        return back();
    }
    public function dungphucvuphone(Request $request)
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
        $chitiet['soluong'] = $check->thuchien;
        $chitiet['trangthai'] = 2;
        DB::table('chitiet')
        ->where('id', $request->id)
            ->update($chitiet);
        return back();
    }
    public function doisoluongmonhoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $id = $request->id; //idchitiet
        $chitiet['soluong'] = $request->soluong;
        $chitiet['gia'] = $request->dongia * $request->soluong;
        DB::table('chitiet')
            ->where('id', $id)
            ->update($chitiet);

        $chitiet2 = DB::table('chitiet')
            ->where('id', $request->id)
            ->first();
        $hoadon = DB::table('hoadon')
            ->where('id', $chitiet2->idhoadon)
            ->first();
        $idban = $hoadon->idban;

        return back();
    }



    public function tamtinhhoadonphone($id)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name', 'users.diachiquan', 'users.website', 'users.sdtquan')
            ->first();

        $hoadon = DB::table('hoadon')
            ->where('hoadon.idquan', $thanhvien->idquan)
            ->where('hoadon.idban', $id)
            ->where('hoadon.trangthai', 0)
            ->join('thanhvien', 'hoadon.idthanhvien', '=', 'thanhvien.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->select('hoadon.*', 'ban.tenban', 'khuvuc.tenkhuvuc', 'thanhvien.hoten')
            ->first();
        $idban = $id;
        $id = $hoadon->id; //idhoadon
        $thoigian = $hoadon->thoigian;

        $idkhachhang = null;
        $diemkhachhang = null;
        $diem = 0;
        $tamtinh = 0;

        $chitiet = DB::table('chitiet')
            ->where('chitiet.idhoadon', $id)
            ->where('chitiet.trangthai', 2)
            ->join('hoadon', 'chitiet.idhoadon', '=', 'hoadon.id')
            ->join('thucdon', 'chitiet.idthucdon', 'thucdon.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('thanhvien', 'hoadon.idthanhvien', '=', 'thanhvien.id')
            ->select('chitiet.*', 'thucdon.tenmon', 'thucdon.dongia', 'khuvuc.tenkhuvuc', 'ban.tenban', 'thanhvien.hoten')
            ->get();
        foreach ($chitiet as $key => $row) {
            $tamtinh = $tamtinh + $row->gia;
        }

        $tilegiamgia = DB::table('giamgia')
            ->where('giamgia.idquan', $thanhvien->idquan)
            ->first();
        if ($tilegiamgia) {
            $hoadontodiem = $tilegiamgia->hoadontodiem;
            $diemtohoadon = $tilegiamgia->diemtohoadon;
        } else {
            $hoadontodiem = 0;
            $diemtohoadon = 0;
        }

        return view('orderphone.thanhtoanhoadonphone', compact('thanhvien', 'hoadon', 'chitiet', 'tamtinh', 'id', 'idban', 'thoigian', 'idkhachhang', 'diemkhachhang', 'diem', 'diemtohoadon'));
    }
    public function giamgiaphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name', 'users.diachiquan', 'users.website', 'users.sdtquan')
            ->first();

        $id = $request->id; //idhoadon
        $hoadon = DB::table('hoadon')
            ->where('hoadon.idquan', $thanhvien->idquan)
            ->where('hoadon.id', $id)
            ->where('hoadon.trangthai', 0)
            ->join('thanhvien', 'hoadon.idthanhvien', '=', 'thanhvien.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->select('hoadon.*', 'ban.tenban', 'khuvuc.tenkhuvuc', 'thanhvien.hoten')
            ->first();

        $thoigian = $hoadon->thoigian;
        $idban = $hoadon->idban;
        $sdt = $request->sdt;
        $diem = $request->diem;
        $tamtinh = 0;

        $chitiet = DB::table('chitiet')
            ->where('chitiet.idhoadon', $id)
            ->where('chitiet.trangthai', 2)
            ->join('hoadon', 'chitiet.idhoadon', '=', 'hoadon.id')
            ->join('thucdon', 'chitiet.idthucdon', 'thucdon.id')
            ->join('ban', 'hoadon.idban', '=', 'ban.id')
            ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
            ->join('thanhvien', 'hoadon.idthanhvien', '=', 'thanhvien.id')
            ->select('chitiet.*', 'thucdon.tenmon', 'thucdon.dongia', 'khuvuc.tenkhuvuc', 'ban.tenban', 'thanhvien.hoten')
            ->get();
        foreach ($chitiet as $key => $row) {
            $tamtinh = $tamtinh + $row->gia;
        }

        $tilegiamgia = DB::table('giamgia')
            ->where('giamgia.idquan', $thanhvien->idquan)
            ->first();
        if ($tilegiamgia) {
            $hoadontodiem = $tilegiamgia->hoadontodiem;
            $diemtohoadon = $tilegiamgia->diemtohoadon;
        } else {
            $hoadontodiem = 0;
            $diemtohoadon = 0;
        }

        $check = DB::table('khachhang')
            ->where('sdt', $sdt)
            ->first();


        if ($check == null) {
            return back()->withErrors(['Không có số này']);
        } else {
            $idkhachhang = $check->id;
            $diemkhachhang = $check->diem;
        }

        if ($diem > 0 && $diem >= $check->diem) { // dung so diem
            $diem = $check->diem;
        }

        if ($diem == 0) { //dung het so diem
            $diem = $check->diem;
        }

        if ($diem <= -1) { // khong dung diem
            $diem = 0;
        }

        if ($diem * $diemtohoadon > $tamtinh) {
            $diem = $tamtinh / $diemtohoadon;
        }

        return view('orderphone.thanhtoanhoadonphone', compact('thanhvien', 'hoadon', 'chitiet', 'tamtinh', 'id', 'idban', 'thoigian', 'idkhachhang', 'diemkhachhang', 'diem', 'diemtohoadon'));
    }
    public function thanhtoanhoadonphone(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name')
            ->first();

        $id = $request->id; //idhoadon
        $idban = $request->idban;
        $idkhachhang = $request->idkhachhang;
        $diemkhachhang = $request->diemkhachhang;
        $diem = $request->diem;
        $giamgia = $request->giamgia;
        $thanhtien = $request->thanhtien;
        if ($thanhtien <= 0 && $giamgia == 0) {
            return back()->withErrors('Không thể thanh toán hóa đơn rỗng');
        }
        if ($thanhtien < 0) {
            return back()->withErrors('Hóa đơn lỗi, xem lại điểm giảm giá');
        }
        $ban['trangthai'] = 0;
        DB::table('ban')
            ->where('id', $idban)
            ->update($ban);

        $hoadon['idkhachhang'] = $idkhachhang;
        $hoadon['giamgia'] = $giamgia;
        $hoadon['thanhtien'] = $thanhtien;
        $hoadon['trangthai'] = 1;
        DB::table('hoadon')
            ->where('id', $id)
            ->update($hoadon);

        $tilegiamgia = DB::table('giamgia')
            ->where('giamgia.idquan', $thanhvien->idquan)
            ->first();
        if ($tilegiamgia) {
            $hoadontodiem = $tilegiamgia->hoadontodiem;
            $diemtohoadon = $tilegiamgia->diemtohoadon;
        } else {
            $hoadontodiem = 0;
            $diemtohoadon = 0;
        }


        if ($hoadontodiem != 0 && $diem != 0) {
            $khachhang['diem'] = $diemkhachhang - $diem + $thanhtien / $hoadontodiem;
            DB::table('khachhang')
                ->where('id', $idkhachhang)
                ->update($khachhang);
        } else if ($hoadontodiem != 0 && $diem == 0) {
            $khachhang['diem'] = $diemkhachhang + $thanhtien / $hoadontodiem;
            DB::table('khachhang')
                ->where('id', $idkhachhang)
                ->update($khachhang);
        }



        // luu vao hoa don moi de luu tru
        $hoadonluu = DB::table('hoadon')
            ->where('id', $id)
            ->first();
        $idquan = $hoadonluu->idquan;
        $idhoadon = $id; //
        $thoigian = $hoadonluu->thoigian;

        $khuvucluu = DB::table('khuvuc')
            ->where('id', $hoadonluu->idkhuvuc)
            ->first();
        $tenkhuvuc = $khuvucluu->tenkhuvuc;

        $banluu = DB::table('ban')
            ->where('id', $idban)
            ->first();
        $tenban = $banluu->tenban;

        $thanhvienluu = DB::table('thanhvien')
            ->where('id', $hoadonluu->idthanhvien)
            ->first();
        $tenthanhvien = $thanhvienluu->hoten;

        if ($idkhachhang == null) {
            $tenkhachhang = null;
            $sdtkh = null;
        } else {
            $khachhangluu = DB::table('khachhang')
                ->where('id', $idkhachhang)
                ->first();
            $tenkhachhang = $khachhangluu->hotenkh;
            $sdtkh = $khachhangluu->sdt;
        }

        // luu ben ngoai hoa don, id tu tang, idhoadon cua hoa don cu
        $hoadonsave2['idquan'] = $idquan;
        $hoadonsave2['idhoadon'] = $idhoadon;
        $hoadonsave2['thoigian'] = $thoigian;
        $hoadonsave2['tenkhuvuc'] = $tenkhuvuc;
        $hoadonsave2['tenban'] = $tenban;
        $hoadonsave2['tenthanhvien'] = $tenthanhvien;
        $hoadonsave2['tenkhachhang'] = $tenkhachhang;
        $hoadonsave2['sdtkh'] = $sdtkh;
        $hoadonsave2['giamgia'] = $giamgia;
        $hoadonsave2['thanhtien'] = $thanhtien;
        $idhoadonluu = DB::table('hoadonluu')->insertgetID($hoadonsave2);

        //luu ben trong hoa don, cac chi tiet cung cha, idhoadonluu.
        $chitiethoadon = DB::table('chitiet')
            ->where('chitiet.idhoadon', $id)
            ->where('trangthai', 2) //mon da duoc phuc vu
            ->join('thucdon', 'chitiet.idthucdon', '=', 'thucdon.id')
            ->get();
        foreach ($chitiethoadon as $key => $row) {

            $hoadonsave['idquan'] = $idquan;
            $hoadonsave['idhoadon'] = $idhoadonluu;
            $hoadonsave['thoigian'] = $thoigian;
            $hoadonsave['loaimon'] = $row->loaimon;
            $hoadonsave['tenmon'] = $row->tenmon;
            $hoadonsave['dongia'] = $row->dongia;
            $hoadonsave['soluong'] = $row->soluong;
            $hoadonsave['gia'] = $row->gia;
            DB::table('hoadonluu')->insert($hoadonsave);
        }


        // luu vao hoa don moi de luu tru



        //xoa chi tiet va hoa don hien tai
        DB::table('chitiet')
            ->where('idhoadon', $idhoadon)
            ->delete();
        DB::table('hoadon')
            ->where('id', $idhoadon)
            ->delete();
        //xoa chi tiet va hoa don hien tai



        return redirect()->route('hoadonphone');
    }

    // public function xemmonphone()
    // {
    //     $ssidthanhvien = Session::get('ssidthanhvien');

    //     $thanhvien = DB::table('thanhvien')
    //         ->where('thanhvien.id', $ssidthanhvien)
    //         ->join('users', 'thanhvien.idquan', '=', 'users.id')
    //         ->select('thanhvien.*', 'users.hinhquan', 'users.name')
    //         ->first();

    //     $ngay = Carbon::now()->toDateString();
    //     $chitiet = DB::table('chitiet')
    //         ->orderBy('phucvu')
    //         ->orderBy('idhoadon')
    //         ->join('hoadon', 'chitiet.idhoadon', '=', 'hoadon.id')
    //         ->join('thucdon', 'chitiet.idthucdon', '=', 'thucdon.id')
    //         ->join('ban', 'hoadon.idban', '=', 'ban.id')
    //         ->join('khuvuc', 'hoadon.idkhuvuc', '=', 'khuvuc.id')
    //         ->where('hoadon.trangthai', 0)
    //         ->where('hoadon.idthanhvien', $thanhvien->id)
    //         ->where('hoadon.thoigian', 'like', $ngay . ' ' . '%%:%%:%%')
    //         ->select('chitiet.*', 'thucdon.tenmon', 'ban.tenban', 'khuvuc.tenkhuvuc')
    //         ->get();
    //     return view('order.xemmon', compact('thanhvien', 'chitiet'));
    // }
}
