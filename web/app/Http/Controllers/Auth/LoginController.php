<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * `Illuminate\Foundation\Auth\AuthenticatesUsers@authenticated` をオーバーライド。
     * ログイン成功後に実行すべき処理を実装する。
     * @return [type] [description]
     */
    protected function authenticated (Request $request, $user) {
        return $user;
    }

    /**
     * `Illuminate\Foundation\Auth\AuthenticatesUsers@loggedOut` をオーバーライド。
     * ログアウト成功後に実行すべき処理を実装する。
     * @param  Request $request
     * @return Response
     */
    public function loggedOut (Request $request) {
        // セッションIDを再生成する
        $request->session()->regenerate();
        return response()->json();
    }
}
