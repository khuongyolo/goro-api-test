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
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;



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
                return back()->withErrors(['error' => 'Wrong Password'])->withInput();
            }
        } catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors(['ERROR'])->withInput();
        }

    }



    public function register(UserRequest $request)
    {
        try {
            // ユーザ一覧画面に遷移する
            if ($request->method() ==  'GET') return view('user.register');

            $registerEmail = $request->email;

            // 同じメールアドレスで同じ権限を持つユーザが既に存在している場合、登録できない
            $existingUser =  User::where('email', $registerEmail)
                                ->whereRaw('LENGTH(verify_code) > 2') // real = 32
                                ->first();
            if (!empty($existingUser)) return back()->withErrors(['error' => 'Your account has been registered and is awaiting email verification.'])->withInput();

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
        try {
            $user = User::where('verify_code', $verify_code)->first();
            if (empty($user)) return redirect(route('user.top'))->withErrors(['error' => 'User does not exist']);
            $user->verify_code = '0';
            $user->updated_at = now();
            $user->update_user = 'GORO';
            $user->save();
            Session::put('user.info', 'Registered Successfully');
            Cache::put('user.info', 'Registered Successfully', 3600);
            return redirect(route('user.top'));
        } catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-LOGIN, ' . $e->getMessage());
            return back()->withErrors('error')->withInput();
        }
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

    /**
     * OAuthプロバイダへリダイレクトする
     *
     * @return RedirectResponse
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
        // return Socialite::driver('google')->redirect();
    }

    /**
     * OAuthプロバイダからのコールバックを処理する
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        // dd($googleUser);
        // 許可するドメインをここに記述
        // $allowedEmailDomains = ['example.com', 'example.co.jp'];

        // $userEmailDomain = substr(strrchr($googleUser->getEmail(), "@"), 1);

        // if (!in_array($userEmailDomain, $allowedEmailDomains)) {
        //     return redirect()->route('user.top');
        // }

        // User::updateOrCreate([
        //     'google_id' => $googleUser->getId(),
        // ], [
        //     'name' => $googleUser->getName(),
        //     'email' => $googleUser->getEmail(),
        //     'created_at' => now(),
        //     'create_user' => 'GORO',
        //     'updated_at' => now(),
        // ]);
        $user = User::where('google_id', $googleUser->getId())->first() ??
                User::where('email', $googleUser->getEmail())->first();
        if (empty($user)) {
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->created_at = now();
            $user->create_user = 'GORO';
            $user->save();
            // Lấy avatar URL từ Google
            $avatarUrl = $googleUser->getAvatar();
            // Tải ảnh avatar về và lưu vào azure
            if ($avatarUrl) {
                $avatarContents = Http::get($avatarUrl)->body(); // Tải ảnh từ URL

                // lấy extention
                // $extension = pathinfo($avatarUrl, PATHINFO_EXTENSION);

                // Tạo tên file duy nhất cho avatar
                $fileName = $user->id . '.png';

                // Lưu avatar vào Azure Blob Storage
                Storage::disk('azure_avatar')->put($fileName, $avatarContents);

                // dd($path);
                $user->avatar = $fileName;
            }
        }
        if (empty($user->google_id)) $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user);
        return redirect()->route('user.homepage');
    }

    /**
     * ログイン失敗時の画面を表示する
     *
     * @return View
     */
    public function failLogin(): View
    {
        return view('login.fail');
    }

    /**
     * ログアウトする
     *
     * @return RedirectResponse
     */
    // public function logout(): RedirectResponse
    // {
    //     Auth::logout();
    //     return redirect()->route('welcome');
    // }

}
