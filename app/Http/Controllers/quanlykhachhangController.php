<?php

namespace App\Http\Controllers;
use DB;
// use App\Traits\StorageImageTrait;
Use Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class quanlykhachhangController extends Controller
{
    public function quanlykhachhang(){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
                    ->where('thanhvien.id',$ssidthanhvien)
                    ->join('users', 'thanhvien.idquan', '=', 'users.id')
                    ->select('thanhvien.*','users.hinhquan','users.name')
                    ->first();

        $khachhang = DB::table('khachhang')
                    ->where('khachhang.idquan', $thanhvien->idquan)
                    ->get();

        $tilegiamgia = DB::table('giamgia')
            ->where('giamgia.idquan', $thanhvien->idquan)
            ->first();
        if($tilegiamgia){
            $hoadontodiem = $tilegiamgia->hoadontodiem;
            $diemtohoadon = $tilegiamgia->diemtohoadon;
        }
        else{
            $hoadontodiem = 0;
            $diemtohoadon = 0;
        }

        return view('khachhang.quanlykhachhang', compact('thanhvien','khachhang','hoadontodiem','diemtohoadon'));
    }

    // public function addkhachhang(){
    //     $ssidthanhvien = Session::get('ssidthanhvien');

    //     $thanhvien = DB::table('thanhvien')
    //                 ->where('thanhvien.id',$ssidthanhvien)
    //                 ->join('users', 'thanhvien.idquan', '=', 'users.id')
    //                 ->select('thanhvien.*','users.hinhquan','users.name')
    //                 ->first();

    //     return view('khachhang.addkhachhang',compact('thanhvien'));
    // }

    public function doaddkhachhang(Request $request){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
                    ->where('thanhvien.id',$ssidthanhvien)
                    ->join('users', 'thanhvien.idquan', '=', 'users.id')
                    ->select('thanhvien.*','users.hinhquan','users.name')
                    ->first();
        
        $check = DB::table('khachhang')
                    ->where('idquan', $thanhvien->idquan)
                    ->where('hotenkh', $request->hotenkh)
                    ->where('sdt', $request->sdt)
                    ->first();
        if($check){
            return back()->withErrors(['Kh??ch h??ng ???? c?? t??i kho???n']);
        }
        else{
            $khachhang['idquan'] = $thanhvien->idquan;
            $khachhang['hotenkh'] = $request->hotenkh;
            $khachhang['sdt'] = $request->sdt;
            $khachhang['ngaydangky'] = date('Y-m-d');
            DB::table('khachhang')->insert($khachhang);
            return back();
        }
    }
    public function editkhachhang($id){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
                    ->where('thanhvien.id',$ssidthanhvien)
                    ->join('users', 'thanhvien.idquan', '=', 'users.id')
                    ->select('thanhvien.*','users.hinhquan','users.name')
                    ->first();

        $khachhang = DB::table('khachhang')
                ->where('khachhang.id',$id)
                ->first();
        
        return view('khachhang.editkhachhang',compact('thanhvien','khachhang'));
    }

    public function doeditkhachhang(Request $request){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
                    ->where('thanhvien.id',$ssidthanhvien)
                    ->join('users', 'thanhvien.idquan', '=', 'users.id')
                    ->select('thanhvien.*','users.hinhquan','users.name')
                    ->first();
        
        $check = DB::table('khachhang')
                    ->where('idquan', $thanhvien->idquan)
                    ->where('hotenkh', $request->hotenkh)
                    ->where('sdt', $request->sdt)
                    ->first();
        if($check){
            return back()->withErrors(['T??n ho???c s??? ??i???n tho???i tr??ng l???p']);
        }
        else{
            $khachhang['hotenkh'] = $request->hotenkh;
            $khachhang['sdt'] = $request->sdt;
            DB::table('khachhang')
                ->where('id', $request->id)
                ->update($khachhang);
            return back();
        }
    }

    public function tilegiamgia(Request $request){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
                    ->where('thanhvien.id',$ssidthanhvien)
                    ->join('users', 'thanhvien.idquan', '=', 'users.id')
                    ->select('thanhvien.*','users.hinhquan','users.name')
                    ->first();
        
        $tilegiamgia = DB::table('giamgia')
            ->where('giamgia.idquan', $thanhvien->idquan)
            ->first();
        if($tilegiamgia){
            $giamgia['hoadontodiem']= $request->hoadontodiem;
            $giamgia['diemtohoadon']= $request->diemtohoadon;
            DB::table('giamgia')
                ->where('giamgia.idquan', $thanhvien->idquan)
                ->update($giamgia);
        }
        else{
            $giamgia['idquan']= $thanhvien->idquan;
            $giamgia['hoadontodiem']= $request->hoadontodiem;
            $giamgia['diemtohoadon']= $request->diemtohoadon;
            DB::table('giamgia')->insert($giamgia);
        }

        return back();
    }
}
