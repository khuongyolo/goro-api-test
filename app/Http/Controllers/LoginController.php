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
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;



class LoginController extends Controller
{
    public function index()
    {
        try {
            Auth::logout();
            Session::flush();
            Session::invalidate();
            Session::regenerateToken();
            return view('user.login');
        } catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors(['ERROR'])->withInput();
        }
    }

    public function login(LoginRequest $request) {
        try {
            // ログイン情報を取得する
            $email = $request->email;
            $password = $request->password;
            // ログイン処理
            // ログインが成功する場合
            if (Auth::attempt(['email' => $email, 'password' => $password, 'verify_code' => '0'])) {
                // メニュー画面のルートにリダイレクト
                return redirect(route('user.homepage'));
            } else {
                // ログインが失敗する場合、エラーメッセージを表示する（処理中断）
                return back()->withErrors(['error' => 'ユーザIDまたはパスワードが正しくありません。'])->withInput();
            }
        } catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors(['エラーが発生しました。'])->withInput();
        }

    }



    public function register(UserRequest $request)
    {
        try {
            // ユーザ一覧画面に遷移する
            if ($request->method() ==  'GET') return view('user.register');

            $registerEmail = $request->email;

            // 同じメールアドレスで同じ権限を持つユーザが既に存在している場合、登録できない
            $existingUser =  User::where('email', $registerEmail)->first();
            if (!empty($existingUser)) return back()->withErrors(['error' => 'User does not exist'])->withInput();

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
            return redirect(route('user.register_success'));
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
        if (!$user->exists()) return redirect(route('user.login'))->withErrors(['error' => 'User does not exist']);
        $user->verify_code = '0';
        $user->updated_at = now();
        $user->update_user = 'GORO';
        $user->save();
        Session::put('user.info', 'Registered Successfully');
        return redirect(route('user.top'));
    }

    function register_success() {
        return view('user.register-success');
    }

    public function homepage() {
        return view('user.homepage');
    }

    public function logout()
    {
        try {
            Auth::logout();
            Session::flush();
            Session::invalidate();
            Session::regenerateToken();

            return redirect(route('user.top'));
        } catch (Exception $e) {
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors(['ERROR'])->withInput();
        }
    }

}
