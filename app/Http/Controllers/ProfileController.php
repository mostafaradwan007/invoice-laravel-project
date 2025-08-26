<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // عرض صفحة البروفايل
    public function edit()
    {
        return view('auth.profile');
    }

    // تحديث بيانات البروفايل
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:5120'],
        ]);

        $user->name = $data['username'];
        $user->email = $data['email'];

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return back()->with(['message' => 'Profile updated successfully.', 'message_type' => 'success']);
    }

    // تحديث كلمة المرور
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'       => ['required'],
            'new_password'           => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(['message' => 'Current password is incorrect.', 'message_type' => 'danger']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with(['message' => 'Password changed successfully.', 'message_type' => 'success']);
    }

    // حذف الحساب
    public function destroy(Request $request)
    {
        $request->validate([
            'confirm_delete' => ['required', 'in:DELETE'],
        ]);

        $user = Auth::user();

        if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with(['message' => 'Your account has been deleted.', 'message_type' => 'success']);
    }
}
