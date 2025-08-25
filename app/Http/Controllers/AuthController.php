<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // تنفيذ تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            session(['success' => 'تم تسجيل الدخول بنجاح ✅']);

            // تحويل لصفحة profile.blade.php
            return redirect()->route('profile')->with('success', 'تم تسجيل الدخول بنجاح ✅');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة ❌'
        ])->withInput();
    }

    // عرض صفحة التسجيل
    public function showSignup()
    {
        return view('auth.signup');
    }

    // تنفيذ عملية التسجيل
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120'
        ]);

        // رفع الصورة لو موجودة
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        // إنشاء المستخدم
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        // تسجيل الدخول تلقائياً
        Auth::login($user);

        return redirect()->route('profile')->with('success', 'تم تسجيل الدخول بنجاح ✅');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // تحويل للصفحة الرئيسية للّوجين بعد الخروج
        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح ✅');
    }
}
