<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function changeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation của ảnh
        ]);

        $user = Auth::user();

        // Mã hóa ảnh thành base64 và lưu vào database
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageData = base64_encode(file_get_contents($image->path()));

            // Cập nhật avatar của user
            $user->avatar = $imageData;
            $user->save();
        }

        return redirect()->back()->with('user.info', 'Avatar has been updated!');
    }
}
