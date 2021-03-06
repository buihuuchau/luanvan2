<?php

namespace App\Http\Controllers;

use DB;
use Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class quanlythanhvienController extends Controller
{
    public function quanlythanhvien()
    {
        $ssidquan = auth()->user()->id;
        $quan = DB::table('users')
            ->where('id', $ssidquan)
            ->first();
        $thanhvien = DB::table('thanhvien')
            ->orderBy('hoten')
            ->where('thanhvien.idquan', $ssidquan)
            ->join('vaitro', 'thanhvien.idvaitro', '=', 'vaitro.id')
            ->select('thanhvien.*', 'vaitro.tenvaitro')
            ->get();
        $lichlamviec = DB::table('lichlamviec')
            ->where('idquan', $ssidquan)
            ->get();
        $hoadon = DB::table('hoadon')
            ->where('idquan', $ssidquan)
            ->get();
        $sudung = null;
        return view('thanhvien.quanlythanhvien', compact('quan', 'thanhvien', 'lichlamviec', 'hoadon', 'sudung'));
    }
    public function addthanhvien()
    {
        $ssidquan = auth()->user()->id;
        $vaitro = DB::table('vaitro')
            ->where('idquan', $ssidquan)
            ->get();
        return view('thanhvien.addthanhvien', compact('vaitro'));
    }
    public function doaddthanhvien(Request $request)
    {
        $ssidquan = auth()->user()->id;
        $thanhvien = array();
        $thanhvien['idquan'] = $ssidquan;
        $thanhvien['acc'] = $request->acc;
        $pwd = md5($request->pwd);
        $thanhvien['pwd'] = $pwd;
        $thanhvien['hoten'] = $request->hoten;
        $hinhtv = $request->file('hinhtv')->store('public/hinhanh');
        $linkhinhtv = 'storage' . substr($hinhtv, 6);
        $thanhvien['hinhtv'] = $linkhinhtv;

        $namsinh = $request->namsinh; // kieu chuoi
        $namsinh2 = strtotime('+18 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh3 = date('Y-m-d', $namsinh2); // dinh dang lai kieu chuoi
        $namsinh4 = strtotime('+60 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh5 = date('Y-m-d', $namsinh4); // dinh dang lai kieu chuoi
        $ngayvaolam = $request->ngayvaolam;
        $today = date("Y-m-d");
        if (strtotime($today) < strtotime($namsinh3)) {
            return back()->withInput()->withErrors('Ch??a ????? 18 tu???i !');
        } elseif (strtotime($today) > strtotime($namsinh5)) {
            return back()->withInput()->withErrors('????? tu???i kh??ng ph?? h???p !');
        } elseif (strtotime($namsinh3) > strtotime($ngayvaolam) || strtotime($today) < strtotime($ngayvaolam)) {
            return back()->withInput()->withErrors('Ng??y v??o l??m kh??ng h???p l???');
        } else {
            $thanhvien['namsinh'] = $request->namsinh;
            $thanhvien['ngayvaolam'] = $request->ngayvaolam;
        }

        $thanhvien['sex'] = $request->sex;
        $thanhvien['diachi'] = $request->diachi;
        $thanhvien['sdt'] = $request->sdt;
        $thanhvien['luong'] = $request->luong;
        $thanhvien['idvaitro'] = $request->idvaitro;



        request()->validate(
            [
                'hinhtv' => 'image|mimes:jpeg,png,jpg|max:4096',
            ],
            [
                'hinhtv.image' => 'H??nh ???nh ph???i c?? d???ng jpg,jpeg,png',
                'hinhtv.max' => 'H??nh ???nh ph???i c?? ????? ph??n gi???i d?????i 4 mb',
            ]
        );

        $check = DB::table('thanhvien')
            ->where('acc', $request->acc)
            ->first();
        if ($check) {
            return back()->withInput()->withErrors(['T??i kho???n ???? t???n t???i']);
        } else {
            $idthanhvien = DB::table('thanhvien')->insertGetId($thanhvien);
            $thanhvien2['idquan'] = $ssidquan;
            $thanhvien2['idthanhvien'] = $idthanhvien;
            $thanhvien2['mucluong'] = $request->luong;
            $thanhvien2['tu'] = date('Y-m-d');
            DB::table('luong')->insert($thanhvien2);
            return redirect()->route('dangnhapthanhvien');
        }
    }
    public function editthongtinthanhvien($id)
    {
        $ssidquan = auth()->user()->id;
        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $id)
            ->where('thanhvien.idquan', $ssidquan)
            ->join('vaitro', 'thanhvien.idvaitro', '=', 'vaitro.id')
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->select('thanhvien.*', 'vaitro.tenvaitro', 'users.hinhquan', 'users.name')
            ->first();
        $vaitro = DB::table('vaitro')
            ->where('vaitro.idquan', $thanhvien->idquan)
            ->get();
        return view('thanhvien.editthanhvien', compact('thanhvien', 'vaitro'));
    }
    public function doeditthongtinthanhvien(Request $request)
    {
        $ssidquan = auth()->user()->id;
        $id = $request->id;
        $thanhvien['hoten'] = $request->hoten;
        if ($request->file('hinhtv') != null) {
            request()->validate(
                [
                    'hinhtv' => 'image|mimes:jpeg,png,jpg|max:4096',
                ],
                [
                    'hinhtv.image' => 'H??nh ???nh ph???i c?? d???ng jpg,jpeg,png',
                    'hinhtv.max' => 'H??nh ???nh ph???i c?? ????? ph??n gi???i d?????i 4 mb',
                ]
            );
            $hinhtv = $request->file('hinhtv')->store('public/hinhanh');
            $linkhinhtv = 'storage' . substr($hinhtv, 6);
            $thanhvien['hinhtv'] = $linkhinhtv;
        }

        $namsinh = $request->namsinh; // kieu chuoi
        $namsinh2 = strtotime('+18 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh3 = date('Y-m-d', $namsinh2); // dinh dang lai kieu chuoi
        $namsinh4 = strtotime('+60 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh5 = date('Y-m-d', $namsinh4); // dinh dang lai kieu chuoi
        $ngayvaolam = $request->ngayvaolam;
        $today = date("Y-m-d");
        if (strtotime($today) < strtotime($namsinh3)) {
            return back()->withErrors('Ch??a ????? 18 tu???i !');
        } elseif (strtotime($today) > strtotime($namsinh5)) {
            return back()->withErrors('????? tu???i kh??ng ph?? h???p !');
        } elseif (strtotime($namsinh3) > strtotime($ngayvaolam) || strtotime($today) < strtotime($ngayvaolam)) {
            return back()->withErrors('Ng??y v??o l??m kh??ng h???p l???');
        } else {
            $thanhvien['namsinh'] = $request->namsinh;
            $thanhvien['ngayvaolam'] = $request->ngayvaolam;
        }

        $thanhvien['sex'] = $request->sex;
        $thanhvien['diachi'] = $request->diachi;
        $thanhvien['sdt'] = $request->sdt;
        $thanhvien['luong'] = $request->luong;
        $thanhvien['idvaitro'] = $request->idvaitro;
        DB::table('thanhvien')
            ->where('id', $id)
            ->where('idquan', $ssidquan)
            ->update($thanhvien);

        $luong = DB::table('luong')
            ->orderBy('id', 'desc')
            ->where('idthanhvien', $id)
            ->first();
        $mucluong = $luong->mucluong;
        $tu = $luong->tu;
        if ($mucluong != $request->luong || $tu != date('Y-m-d')) {
            $thanhvien2['idquan'] = $ssidquan;
            $thanhvien2['idthanhvien'] = $id;
            $thanhvien2['mucluong'] = $request->luong;
            $thanhvien2['tu'] = date('Y-m-d');
            DB::table('luong')->insert($thanhvien2);
        }

        return back();
    }
    public function editmatkhau(Request $request)
    {
        $ssidquan = auth()->user()->id;
        $thanhvien['pwd'] = md5($request->rnpwd);
        DB::table('thanhvien')
            ->where('idquan', $ssidquan)
            ->where('id', $request->id)
            ->update($thanhvien);
        return back();
    }
    public function vohieuhoathanhvien($id)
    {
        $ssidquan = auth()->user()->id;
        $thanhvien['hidden'] = 1;

        $thanhvien = DB::table('thanhvien')
            ->where('idquan', $ssidquan)
            ->where('id', $id)
            ->update($thanhvien);

        return back();
    }
    public function kichhoatthanhvien($id)
    {
        $ssidquan = auth()->user()->id;
        $thanhvien['hidden'] = 0;

        $thanhvien = DB::table('thanhvien')
            ->where('idquan', $ssidquan)
            ->where('id', $id)
            ->update($thanhvien);

        return back();
    }
    public function deletethongtinthanhvien($id)
    {
        $ssidquan = auth()->user()->id;
        DB::table('luong')
            ->where('idthanhvien', $id)
            ->where('idquan', $ssidquan)
            ->delete();
        DB::table('thanhvien')
            ->where('id', $id)
            ->where('idquan', $ssidquan)
            ->delete();
        return back();
    }
    public function dangnhapthanhvien()
    {
        return view('thanhvien.dangnhapthanhvien');
    }
    public function dodangnhapthanhvien(Request $request)
    {
        $acc = $request->acc;
        $pwd = md5($request->pwd);
        $check = DB::table('thanhvien')
            ->where('acc', $acc)
            ->where('pwd', $pwd)
            ->where('hidden', 0)
            ->first();
        if ($check) {
            Auth::guard('web')->logout(); // bo auth
            $ssidthanhvien = $check->id;
            Session::put('ssidthanhvien', $ssidthanhvien);
            return redirect()->route('thongtinthanhvien');
        } else {
            return back()->withErrors('T??i kho???n ho???c m???t kh???u kh??ng ch??nh x??c');
        }
    }
    public function thongtinthanhvien()
    {
        $ssidthanhvien = Session::get('ssidthanhvien');
        $thanhvien = DB::table('thanhvien')
            ->where('thanhvien.id', $ssidthanhvien)
            ->join('users', 'thanhvien.idquan', '=', 'users.id')
            ->join('vaitro', 'thanhvien.idvaitro', '=', 'vaitro.id')
            ->select('thanhvien.*', 'users.hinhquan', 'users.name', 'vaitro.tenvaitro')
            ->first();

        // $hoadon = DB::table('hoadon')
        //     ->where('hoadon.idquan', $thanhvien->idquan)
        //     ->where('hoadon.idthanhvien', $thanhvien->id)
        //     ->get();

        // $demdangcho = 0;
        // $demdangthuchien = 0;
        // $demdahoanthanh = 0;
        // $dembaohuy = 0;
        // if (count($hoadon) != 0) {
        //     foreach ($hoadon as $key => $rowhoadon) {
        //         $dangcho[$key] = DB::table('chitiet')
        //             ->where('idhoadon', $rowhoadon->id)
        //             ->where('trangthai', 0)
        //             ->get();
        //         $dangthuchien[$key] = DB::table('chitiet')
        //             ->where('idhoadon', $rowhoadon->id)
        //             ->where('trangthai', 1)
        //             ->get();
        //         $dahoanthanh[$key] = DB::table('chitiet')
        //             ->where('idhoadon', $rowhoadon->id)
        //             ->where('trangthai', 2)
        //             ->get();
        //         $baohuy[$key] = DB::table('chitiet')
        //             ->where('idhoadon', $rowhoadon->id)
        //             ->where('trangthai', 3)
        //             ->get();
        //     }
        //     foreach ($dangcho as $rowdangcho) {
        //         foreach ($rowdangcho as $rowrowdangcho) {
        //             $demdangcho = $demdangcho + 1;
        //         }
        //     }
        //     foreach ($dangthuchien as $rowdangthuchien) {
        //         foreach ($rowdangthuchien as $rowrowdangthuchien) {
        //             $demdangthuchien = $demdangthuchien + 1;
        //         }
        //     }
        //     foreach ($dahoanthanh as $rowdahoanthanh) {
        //         foreach ($rowdahoanthanh as $rowrowdahoanthanh) {
        //             $demdahoanthanh = $demdahoanthanh + 1;
        //         }
        //     }
        //     foreach ($baohuy as $rowbaohuy) {
        //         foreach ($rowbaohuy as $rowrowbaohuy) {
        //             $dembaohuy = $dembaohuy + 1;
        //         }
        //     }
        // }

        // return view('thanhvien.thongtinthanhvien', compact('thanhvien', 'demdangcho', 'demdangthuchien', 'demdahoanthanh', 'dembaohuy'));
        return view('thanhvien.thongtinthanhvien', compact('thanhvien'));
    }
    public function dangxuatthanhvien()
    {
        Session::forget('ssidthanhvien');
        return redirect()->route('dangnhapthanhvien');
    }
    public function suathongtinthanhvien(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');
        $thanhvien['hoten'] = $request->hoten;
        if ($request->file('hinhtv') != null) {
            request()->validate(
                [
                    'hinhtv' => 'image|mimes:jpeg,png,jpg|max:4096',
                ],
                [
                    'hinhtv.image' => 'H??nh ???nh ph???i c?? d???ng jpg,jpeg,png',
                    'hinhtv.max' => 'H??nh ???nh ph???i c?? ????? ph??n gi???i d?????i 4 mb',
                ]
            );
            $hinhtv = $request->file('hinhtv')->store('public/hinhanh');
            $linkhinhtv = 'storage' . substr($hinhtv, 6);
            $thanhvien['hinhtv'] = $linkhinhtv;
        }

        $namsinh = $request->namsinh; // kieu chuoi
        $namsinh2 = strtotime('+18 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh3 = date('Y-m-d', $namsinh2); // dinh dang lai kieu chuoi
        $namsinh4 = strtotime('+60 year', strtotime($namsinh)); // cong them nam, khong con la kieu chuoi
        $namsinh5 = date('Y-m-d', $namsinh4); // dinh dang lai kieu chuoi
        $today = date("Y-m-d");
        if (strtotime($today) < strtotime($namsinh3)) {
            return back()->withErrors('Ch??a ????? 18 tu???i !');
        } elseif (strtotime($today) > strtotime($namsinh5)) {
            return back()->withErrors('????? tu???i kh??ng ph?? h???p !');
        } else {
            $thanhvien['namsinh'] = $request->namsinh;
        }

        $thanhvien['sex'] = $request->sex;
        $thanhvien['diachi'] = $request->diachi;
        $thanhvien['sdt'] = $request->sdt;
        DB::table('thanhvien')
            ->where('id', $ssidthanhvien)
            ->update($thanhvien);
        return back();
    }
    public function doimatkhau(Request $request)
    {
        $ssidthanhvien = Session::get('ssidthanhvien');
        $check = DB::table('thanhvien')
            ->where('id', $ssidthanhvien)
            ->first();
        if ($check->pwd === md5($request->opwd)) {
            $thanhvien['pwd'] = md5($request->rnpwd);
            DB::table('thanhvien')
                ->where('id', $ssidthanhvien)
                ->update($thanhvien);
            return back();
        } else {
            return back()->withErrors('M???t kh???u sai');
        }
    }
}
