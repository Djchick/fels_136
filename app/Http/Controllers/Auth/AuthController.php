<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        $rule = config('common.user.rule');
        return Validator::make($data, [
            'name' => "required|max:{$rule['name_max']}",
            'email' => "required|email|max:{$rule['email_max']}|unique:users,email,NULL,id,deleted_at,NULL",
            'password' => "required|confirmed|min:{$rule['password_min']}",
            'password_confirmation' => "required|min:{$rule['password_min']}",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function getRegister ()
    {
        return view('auth.register');
    }

    public function getLogin ()
    {
        return view('auth.login');
    }

    public function postLogin (LoginRequest $request) {
        $loginUser = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        if ($this->auth->attempt($loginUser)) {
            return redirect()->route('home');
        }
        return redirect()->route('getLogin')->withMessage(trans('user/messages.user_not_found'));
    }
}