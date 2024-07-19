<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function login(Request $request)
    {
        try {
            $UserID = $request->id;
            $Password = $request->password;
            if (Auth::guard('member')->attempt(['UserId' => $UserID, 'password' => $Password])) {
                return redirect(route('menu'));
            } else {
                return back()->withErrors(['error' => 'ユーザIDまたはパスワードが正しくありません。'])->withInput();
            }
        } catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors(['エラーが発生しました。'])->withInput();
        }
    }

}
