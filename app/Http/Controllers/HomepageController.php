<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function changeAvatar(Request $request)
    {
        try {
            // Xác thực yêu cầu
            $request->validate([
                'avatar' => 'required|image|max:10240', // Giới hạn kích thước 10MB
            ]);

            // Lấy file avatar từ request
            $avatarFile = $request->file('avatar');

            // Tạo tên file duy nhất cho avatar
            $avatarFileName = auth()->user()->id . '.' . $avatarFile->getClientOriginalExtension();

            // Upload avatar lên Azure Blob Storage
            $path = Storage::disk('azure_avatar')->putFileAs('', $avatarFile, $avatarFileName);

            // Lưu đường dẫn avatar vào database
            $user = auth()->user();
            $user->avatar = $path; // Lưu tên file vào database
            $user->save();

            return back()->with('status', 'Avatar has been updated!');
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
        }
    }
}
