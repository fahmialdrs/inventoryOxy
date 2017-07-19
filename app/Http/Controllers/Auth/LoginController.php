<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Traits\ResponseTrait;
use Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    use Responsetrait;
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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function loginAPI() {
        $credentials = request()->only(['email', 'password']);
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->response(true, null, 'Email / Password Salah!');
            } else {
                $accountInfo = Auth::user();
                $accountInfo->token = $token;
                Log::alert($accountInfo->name . ', Logged in from Api Endpoint');
                return $this->response(false, $accountInfo, 'Login Berhasil');
            }
        } catch (JWTException $e) {
            return $this->response(true, null, $e->getMessage());
        }
    }
}
