<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    public function changeAvatar(Request $request)
    {
        try {
            // Xác thực yêu cầu
            $request->validate([
                'avatar' => 'required|image|max:102400', // Giới hạn kích thước 100MB
            ]);

            // Lấy file avatar từ request
            $avatarFile = $request->file('avatar');

            // Tạo tên file duy nhất cho avatar bằng GUID
            $avatarFileName = Str::uuid() . '.' . $avatarFile->getClientOriginalExtension();

            // Lấy user hiện tại
            $user = auth()->user();

            // Xóa ảnh cũ nếu có
            if ($user->avatar) {
                Storage::disk('azure_avatar')->delete($user->avatar);
            }

            // Upload avatar lên Azure Blob Storage
            $path = Storage::disk('azure_avatar')->putFileAs('', $avatarFile, $avatarFileName);

            // Lưu đường dẫn avatar vào database
            $user->avatar = $path; // Lưu tên file vào database
            $user->save();

            return back()->with('status', 'Avatar has been updated!');
        }
        catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
        }
    }
}
