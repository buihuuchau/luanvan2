<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $hinhquan = $request->file('hinhquan')->store('public/hinhanh');
        $linkhinhquan = 'storage'.substr($hinhquan, 6);

        request()->validate([
            'hinhquan' => 'image|mimes:jpeg,png,jpg|max:4096',
        ],
        [
            'hinhquan.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
            'hinhquan.mimes' => 'Hình ảnh phải có dạng jpg,jpeg,png',
            'hinhquan.max' => 'Hình ảnh phải có độ phân giải dưới 4 mb',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hinhquan' => $linkhinhquan,
            'diachiquan' => $request->diachiquan,
            'website' => $request->website,
            'sdtquan' => $request->sdtquan,
            'ngaythanhlap' => $request->ngaythanhlap,
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);

        return redirect('login');
    }
}
