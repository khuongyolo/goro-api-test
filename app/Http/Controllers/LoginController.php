<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Library\LibCommon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ConfirmationMail;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;



class LoginController extends Controller
{
    function login()
    {
        return view('user.login');
    }

    public function register(UserRequest $request)
    {
        try {
            // ユーザ一覧画面に遷移する
            if ($request->method() ==  'GET') return view('user.register');

            $registerEmail = $request->email;

            // 同じメールアドレスで同じ権限を持つユーザが既に存在している場合、登録できない
            $existingUser =  User::where('email', $registerEmail)->first();
            if (!empty($existingUser)) return back()->withErrors(['error' => 'email đã tồn tại'])->withInput();

            $old_request = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];
            Session::put('user.register_request', $old_request);

            $verify_code = Str::random(32);

            $newUser = new User();
            DB::transaction(function () use ($request, &$newUser, $verify_code) {
                // 情報を設定する
                $newUser->name = $request->name;
                $newUser->email = $request->email;
                $newUser->password = Hash::make($request->password);
                $newUser->verify_code = $verify_code;
                $newUser->created_at = now();
                $newUser->create_user = 'GORO';
                // DB保存
                $newUser->save();
            });

            // メールを送信する
            $mailData = [
                'name'  => $request->name,
                'verify_code'   => $verify_code
            ];
            $mailKind = 'register';
            Mail::to($registerEmail)->send(new ConfirmationMail($mailData, $mailKind));


            // Session::put('user.verify_otp', $verify_);
            // 登録成功画面にリダイレクトする
            return redirect(route('user.login'));
        } catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
    }


    function showVerifyOtp() {
        return view('user.verify-otp');
    }

    // function verifyOtp(Request $request) {
    //     $verify_otp = Session::get('user.verify_otp');
    //     if ($request->otp != $verify_otp) return back()->withInput()->withErrors(['error' => 'Sai OTP']);

    //     // 登録情報を取得する
    //     $register_request = Session::get('user.register_request');

    //     // 同じメールアドレスで同じ権限を持つユーザが既に存在していない場合
    //     $newUser = new User();
    //     DB::transaction(function () use ($register_request, &$newUser) {
    //         // 情報を設定する
    //         $newUser->name = $register_request['name'];
    //         $newUser->email = $register_request['email'];
    //         $newUser->password = Hash::make($register_request['password']);
    //         $newUser->created_at = now();
    //         $newUser->create_user = $register_request['name'];
    //         // DB保存
    //         $newUser->save();
    //     });
    //     Session::put('user.info', 'Register successfully');
    //     return redirect(route('user.login'));
    // }

    function verify($verify_code) {
        $user = User::where('verify_code', $verify_code)->first();
        if (!$user->exists()) return redirect(route('user.login'))->withErrors(['error' => 'user không tồn tại']);
        $user->verify_code = null;
        $user->updated_at = now();
        $user->update_user = 'GORO';
        $user->save();
        Session::put('user.info', 'đăng kí thành công');
        return redirect(route('user.login'));
    }
}
