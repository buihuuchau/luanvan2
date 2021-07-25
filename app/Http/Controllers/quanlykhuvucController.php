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

class quanlykhuvucController extends Controller
{
    public function quanlykhuvuc(){
        $ssidthanhvien = Session::get('ssidthanhvien');
        
        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();
        $khuvuc = DB::table('khuvuc')
                ->where('idquan',$thanhvien->idquan)
                ->get();
        $ban = DB::table('ban')
                ->where('idquan',$thanhvien->idquan)
                ->get();
        $lichlamviec = DB::table('lichlamviec')
                ->where('idquan',$thanhvien->idquan)
                ->get();
        $sudung = null;

        return view('khuvuc.quanlykhuvuc',compact('thanhvien','khuvuc','ban','lichlamviec','sudung'));
    }

    public function addkhuvuc(){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();
        return view('khuvuc.addkhuvuc',compact('thanhvien'));
    }

    public function doaddkhuvuc(Request $request){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();
        
        $check = DB::table('khuvuc')
            ->where('idquan',$thanhvien->idquan)
            ->where('tenkhuvuc',$request->tenkhuvuc)
            ->first();
        if($check){
            return back()->withErrors(['Khu vực đã tồn tại']);
        }
        else{
            $khuvuc['idquan'] = $thanhvien->idquan;
            $khuvuc['tenkhuvuc'] = $request->tenkhuvuc;
            DB::table('khuvuc')->insert($khuvuc);
            return back();
        }       
        
    }

    public function editkhuvuc($id){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();

        $khuvuc = DB::table('khuvuc')
            ->where('id',$id)
            ->first();
                
        return view('khuvuc.editkhuvuc',compact('thanhvien','khuvuc'));
    }

    public function doeditkhuvuc(Request $request){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();
        
        $check = DB::table('khuvuc')
            ->where('idquan',$thanhvien->idquan)
            ->where('tenkhuvuc',$request->tenkhuvuc)
            ->first();
        if($check){
            return back()->withErrors(['Khu vực đã tồn tại']);
        }
        else{
            $khuvuc['tenkhuvuc'] = $request->tenkhuvuc;
            $khuvuc = DB::table('khuvuc')
                ->where('id',$request->id)
                ->update($khuvuc);
            return redirect()->route('quanlykhuvuc');
        }
    }

    public function hiddenkhuvuc($id){
        $ssidthanhvien = Session::get('ssidthanhvien');
        $khuvuc['hidden'] = 1;

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();

        DB::table('khuvuc')
            ->where('id',$id)
            ->where('idquan',$thanhvien->idquan)
            ->update($khuvuc);
        
        return back();
    }
    public function showkhuvuc($id){
        $ssidthanhvien = Session::get('ssidthanhvien');
        $khuvuc['hidden'] = 0;

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();

        DB::table('khuvuc')
            ->where('id',$id)
            ->where('idquan',$thanhvien->idquan)
            ->update($khuvuc);
        
        return back();
    }

    public function deletekhuvuc($id){
        $ssidthanhvien = Session::get('ssidthanhvien');

        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id',$ssidthanhvien)
            ->join('users','thanhvien.idquan','=','users.id')
            ->select('thanhvien.*','users.hinhquan','users.name')
            ->first();

        DB::table('khuvuc')
            ->where('id',$id)
            ->where('idquan',$thanhvien->idquan)
            ->delete();
        
        return back();
    }
}
